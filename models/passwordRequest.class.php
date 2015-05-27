<?php
class PasswordRequest {
    var $id;
    var $datetime;
    var $ip;
    var $memberID;
    var $char_string;
    var $valid;
    
    function __construct($ID = NULL) {
        $this->id = $ID;
        if ($this->id <> null) {
            $this->refreshData();
        }
    }
    
    public function refreshData() {
        $db = MysqliDb::giveNewDbConnection();
        $db->where('ID', $this->id);
        $db->where('MemberID', $this->memberID);
        $result = $db->get('tblPasswordRequest');
        
        if($db->count> 0) {
            foreach ($result as $row) {
                $this->setData($row);
            }
        }
    }
    
    public function setData($row) {
        $this->memberID = $row['MemberID'];
        $this->char_string = $row['CharString'];
        $this->valid = $row['Valid'];
    } 
    
    public function save() {        
        try {          
            $db = MysqliDb::giveNewDbConnection();
            $data = array("DateTime" => $this->datetime,
                "IP" => $this->ip,
                "MemberID" => $this->memberID,
                "CharString" => $this->char_string,
                "Valid" => $this->valid);
            
            //Insert          
            if ($db->insert('tblPasswordRequest', $data)) {
                return true;
            } else {
                return false;
            }
        }
        catch (Exception $e) {
            return false;
        }
    }
    
    public static function askNewPassword() {
        // Check if all session variables are set
        if(isset($_POST['riziv'], $_POST['email'])) {
            $riziv = $_POST['riziv'];
            $email = $_POST['email'];
            
            $db = MysqliDb::giveNewDbConnection();
            
            $db->where('RIZIV', $riziv);
            $db->where('PracticeEmail', $email);
            $result = $db->getOne('tblMember', 'ID, Firstname');
            
            if ($db->count == 1) {
                //genereer een lange string
                $char_string = generateSalt();
                if (PasswordRequest::enterRequest($result['ID'], $char_string) == true) {
                    //Generate mail with password;
                    $subject = "Aanvraag voor een nieuw wachtwoord";
                    $fullmail =  "Beste ".$result['Firstname'].",<br><br>"
                            ."vanop de website werd een aanvraag gedaan om een nieuw wachtwoord in te voeren.<br>"
                            ."Dit gebeurde waarschijnlijk naar aanleiding van het vergeten van uw wachtwoord"
                            ."<br><br>"
                            ."Indien U deze aanvraag <span class=\"remark\">niet zelf</span> gedaan hebt, mag u deze mail negeren en verwijderen.<br>"
                            ."Als dit vaak voorvalt, mag u daarvan de webmaster op de hoogte brengen via volgend e-mailadres: <a href=\"mailto:info@bflydesign.be\">info@bflydesign.be</a>."
                            ."<br><br>"
                            ."Ga naar <a href=\"http://www.hijw.be/admin/formPassword_setnew.php?action=setnewpw&memberid=".$result['ID']."&charstr=".$char_string."\" target=\"_blank\">deze pagina</a> en voer een nieuw wachtwoord in."
                            ."<br><br>"
                            ."Met vriendelijke groet,"
                            ."<br>"
                            ."de webmaster";
                    Mail::sendMail('info@hijw.be', $email, null, null, $subject, $fullmail);
                    echo 'true';
                } else {
                    echo 'false';
                }                
            } else {
                echo 'false';
            }
        } else {
            echo 'false';
        }
    }
    
    public static function enterRequest($memberID, $char_string) {
        $request = new PasswordRequest();
        $request->datetime = date('Y-m-d H:i:s');
        $request->ip = $_SERVER['REMOTE_ADDR'];
        $request->memberID = $memberID;
        $request->char_string = $char_string;
        $request->valid = 1;
        return $request->save();
    }
    
    public static function isRequestValid($memberID, $charstring) {
        $db = MysqliDb::giveNewDbConnection();
        $db->where('MemberID', $memberID);
        $db->where('CharString', $charstring);
        $result = $db->getOne('tblPasswordRequest', 'Valid');
        if ($db->count == 1) {
            if ($result['Valid'] == 1) {
                echo 'true';
            } else {
                echo 'false';
            }
        } else {
            echo 'false';
        }
    }
    
    public static function updateRequest($memberID, $charstring) {
        //set valid to 0
        if (isset($memberID) && isset($charstring)) {
            $db = MysqliDb::giveNewDbConnection();
            $data = array("Valid" => 0);
            $db->where('MemberID', $memberID);
            $db->where('CharString', $charstring);
            if ($db->update('tblPasswordRequest', $data)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}