<?php

class News {

    // PROPERTIES
    private $id;
    private $title;
    private $content;
    private $dateCreated;
    private $dateModified;
    private $publishFrom;
    private $publishTo;
    private $publish;

    // SETTERS AND GETTERS
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * @param mixed $dateCreated
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;
    }

    /**
     * @return mixed
     */
    public function getDateModified()
    {
        return $this->dateModified;
    }

    /**
     * @param mixed $dateModified
     */
    public function setDateModified($dateModified)
    {
        $this->dateModified = $dateModified;
    }
    /**
     * @return mixed
     */
    public function getPublishFrom()
    {
        return $this->publishFrom;
    }

    /**
     * @param mixed $publishFrom
     */
    public function setPublishFrom($publishFrom)
    {
        $this->publishFrom = $publishFrom;
    }

    /**
     * @return mixed
     */
    public function getPublishTo()
    {
        return $this->publishTo;
    }

    /**
     * @param mixed $publishTo
     */
    public function setPublishTo($publishTo)
    {
        $this->publishTo = $publishTo;
    }

    /**
     * @return mixed
     */
    public function getPublish()
    {
        return $this->publish;
    }

    /**
     * @param mixed $publish
     */
    public function setPublish($publish)
    {
        $this->publish = $publish;
    }

    // CONSTRUCTOR
    function __construct($id = NULL)
    {
        $this->id = $id;

        if ($this->id <> null)
        {
            $this->refreshData();
        } else {
            $this->dateCreated = new DateTime();
        }
        // -- altijd deze datum meewijzigen
        $this->dateModified = new DateTime();
    }

    public function refreshData()
    {
        $db = MysqliDb::giveNewDbConnection();

        $db->where('ID', $this->id);
        $result = $db->get('tblNews');

        if($db->count> 0) {
            foreach ($result as $row) {
                $this->setData($row);
            }
        }
    }

    private function setData($row)
    {
        $this->id = $row['ID'];
        $this->title = $row['Title'];
        $this->content = $row['Content'];
        $this->dateCreated = new DateTime($row['DateCreated']);
        $this->dateModified = isset($row['DateModified']) ? new DateTime($row['DateModified']) : null;
        $this->publishFrom = isset($row['PublishFrom']) ? new DateTime($row['PublishFrom']) : null;
        $this->publishTo = isset($row['PublishTo']) ? new DateTime($row['PublishTo']) : null;
        $this->publish = isset($row['Publish']) ? $row['Publish'] : 0;
    }

    private function save() {
        try {
            $db = MysqliDb::giveNewDbConnection();
            $data = array(
                'Title' => $this->title,
                'Content' => $this->content,
                'DateCreated' => $this->dateCreated->format('Y-m-d H:i:s'),
                'DateModified' => $this->dateModified->format('Y-m-d H:i:s'),
                'PublishFrom' => (!empty($this->publishFrom)) ? $this->publishFrom->format('Y-m-d') : null,
                'PublishTo' => (!empty($this->publishTo)) ? $this->publishTo->format('Y-m-d') : null,
                'Publish' => $this->publish
            );

            if ($this->id <> null) {
                $db->where('ID', $this->id);
                if ($db->update('tblNews', $data)) {
                    echo 'success';
                } else {
                    echo 'error_saving';
                }
            }
            //Insert
            else {
                $id = $db->insert('tblNews', $data);
                if($id > 0) {
                    echo 'success';
                } else {
                    echo 'error_saving';
                }
            }
        } catch (Exception $e) {
            echo $e->getTraceAsString();
            echo 'error_saving';
        }
    }

    public static function saveNews() {
        $news = new News(isset($_POST['id']) ? $_POST['id'] : null);

        $publishFrom = isset($_POST['publishFrom']) ? trim($_POST['publishFrom']) : null;
        if(!empty($publishFrom)) {
            $news->publishFrom = DateTime::createFromFormat('d-m-Y', $publishFrom);
        }
        $publishTo = isset($_POST['publishTo']) ? trim($_POST['publishTo']) : null;
        if(!empty($publishTo)) {
            $news->publishTo = DateTime::createFromFormat('d-m-Y', $publishTo);
        }
        $news->title = isset($_POST['title']) ? trim($_POST['title']) : '';
        $news->content = isset($_POST['content']) ? $_POST['content'] : '';
        $news->publish = isset($_POST['publish']) ? 1 : 0;

        $news->save();
    }

    private function delete() {
        $db = MysqliDb::giveNewDbConnection();

        if($this->id <> null) {
            $db->where('ID', $this->id);
            if($db->delete('tblNews')) {
                echo 'true';
            } else {
                echo 'false';
            }
        }
    }

    public static function deleteNews($id) {
        if (isset($id)) {
            $news = new News($id);
            $news->delete();
        }
    }

    //get all newsitems
    public static function getNews($publish = true, $fromTo = false, $orderby = 'DESC', $limit = null)
    {
        $db = MysqliDb::giveNewDbConnection();
        $sql = 'SELECT * FROM tblNews WHERE 1 = 1';

        if ($publish == true) {
            $sql .= ' AND Publish = 1';
        }
        if ($fromTo == true) {
            $now = new DateTime();
            $sql .= ' AND IFNULL(PublishFrom, CURDATE() - INTERVAL 1 DAY) <= "' . $now->format('Y-m-d') . '" AND IFNULL(PublishTo, CURDATE() + INTERVAL 1 DAY) >= "' . $now->format('Y-m-d').'"';
        }
        $sql .= ' ORDER BY DateCreated ' . $orderby;
        if ($limit <> null) {
            $sql .= ' LIMIT ' . $limit;
        }

        $result = $db->rawQuery($sql, null, false);

        if ($db->count > 0) {
            $items = array();
            foreach ($result as $row) {
                $news = new News();
                $news->setData($row);
                $items[] = $news;
            }
            return $items;
        }
    }
}