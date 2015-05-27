<?php

class PagesController
{
    private $pageId;
    private $slug;
    private $pageTitle;
    private $content;

    public function __construct($id = NULL)
    {
        $this->id = $id;

        if ($this->id <> null) {
            $this->refreshData();
        }
    }

    public function setData()
    {

    }

    public function show($slug)
    {
        $db = MysqliDb::giveNewDbConnection();

        $db->where('slug', $this->slug);
        $result = $db->get('tblPages');

        if($db->count> 0) {
            foreach ($result as $row) {
                $this->setData($row);
            }
        }
    }
}