<?php
class User {
    private $id;
    private $lastname;
    private $firstname;
    private $username;
    private $password;
    private $salt;
    private $email;

    // SETTER AND GETTERS
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
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * @param mixed $salt
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
    }

    /**
 * @return mixed
 */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $password
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    // CONSTRUCTOR
    function __construct($id = null)
    {
        $this->id = $id;

        if ($this->id <> null) {
            $this->refreshData();
        }
    }

    public function refreshData()
    {
        $db = MysqliDb::giveNewDbConnection();

        $db->where('ID', $this->id);
        $result = $db->get('tblUser');

        if($db->count > 0) {
            foreach ($result as $row) {
                $this->setData($row);
            }
        }
    }

    private function setData($row)
    {
        $this->id = $row['ID'];
        $this->username = $row['UserName'];
        $this->lastname = $row['LastName'];
        $this->firstname = $row['FirstName'];
        $this->password = $row['Password'];
        $this->salt = $row['Salt'];
        $this->email = $row['Email'];
    }

    public static function selectByUserName($username) {
        $db = MysqliDb::giveNewDbConnection();
        $db->where('UserName', $username);
        $result = $db->getOne('tblUser', 'ID');

        if ($db->count > 0) {
            $id = $result['ID'];
            $user = new User($id);
            return $user;
        }
    }

    public function save() {
        try {
            $db = MysqliDb::giveNewDbConnection();
            $data = array(
              'ID' => $this->id,
                'UserName' => $this->username,
                'LastName' => $this->lastname,
                'FirstName' => $this->firstname,
                'Password' => $this->password,
                'Salt' => $this->salt,
                'Email' => $this->email
             );

            if ($this->id <> null) {
                $db->where('ID', $this->id);
                if ($db->update('tblUser', $data)) {
                    echo 'success';
                } else {
                    echo 'error_saving';
                }
            }
            //Insert
            else {
                $id = $db->insert('tblUser', $data);
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

    public static function userExists($userID) {
        $db = MysqliDb::giveNewDbConnection();
        $db->where('ID', $userID);
        $result = $db->getOne('tblUser');

        if ($db->count > 0) {
            return true;
        } else {
            return false;
        }
    }
}