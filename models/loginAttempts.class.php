<?php
class LoginAttempts {
    protected $userID;
    protected $time;

    public function __construct($userID) {
        $this->userID = $userID;
        $now = new DateTime();
        $this->time = $now->getTimestamp();
    }

    public function save() {
        try {
            $db = MysqliDb::giveNewDbConnection();
            $data = array(
                'UserID' => $this->userID,
                'Time' => $this->time
            );

            if ($this->userID <> null) {
                if ($db->insert('tblLoginAttempts', $data)) {
                    return true;
                } else {
                    return false;
                }
            }
        } catch (Exception $e) {
            echo $e->getTraceAsString();
            return false;
        }
    }

    public static function checkBrute($userID) {
        // Get timestamp of current time
        $now = time();

        // All login attempts are counted from the past 2 hours.
        $valid_attempts = $now - (2 * 60 * 60);

        $db = MysqliDb::giveNewDbConnection();
        $db->where('UserID', $userID);
        $db->where('Time > '.$valid_attempts);
        if ($result = $db->get('tblLoginAttempts', null, 'Time')) {
            // If there have been more than 5 failed logins
            if ($db->count > 5) {
                return true;
            } else {
                return false;
            }
        }
    }
}