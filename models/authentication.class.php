<?php
class Authentication
{
    public static function login($username, $password)
    {
        $user = User::selectByUserName($username);

        if (!is_null($user)) {
            $userID = $user->getId();
            $salt = $user->getSalt();
            $db_password = $user->getPassword();

            // hash the password with the unique salt.
            $password = hash('sha512', $password . $salt);

            // If the user exists we check if the account is locked
            // from too many login attempts
            if (LoginAttempts::checkBrute($userID) == true) {
                // Account is locked
                // Send an email to user saying their account is locked
                return false;
            } else {
                // Check if the password in the database matches
                // the password the user submitted.
                if ($db_password == $password) {
                    // Password is correct!
                    // Get the user-agent string of the user.
                    $user_browser = $_SERVER['HTTP_USER_AGENT'];
                    // XSS protection as we might print this value
                    $userID = preg_replace("/[^0-9]+/", "", $userID);
                    $_SESSION['userid'] = $userID;
                    // XSS protection as we might print this value
                    $username = preg_replace("/[^a-zA-Z0-9_]+/", "", $username);
                    $_SESSION['username'] = $username;
                    $_SESSION['login_string'] = hash('sha512', $password . $user_browser);
                    // Login successful.
                    return true;
                } else {
                    // Password is not correct
                    // We record this attempt in the database
                    $li = new LoginAttempts($userID);
                    $li->save();
                    return false;
                }
            }
        } else {
            // No user exists.
            return false;
        }
    }

    public static function login_check()
    {
        // Check if all session variables are set
        if (isset($_SESSION['userid'], $_SESSION['username'], $_SESSION['login_string'])) {
            // Get the sessiondata
            $userID = $_SESSION['userid'];
            $login_string = $_SESSION['login_string'];
            $user_browser = $_SERVER['HTTP_USER_AGENT'];

            // Get the userdata
            $user = new User($userID);
            if (!is_null($user)) {
                $password = $user->getPassword();
                $login_check = hash('sha512', $password . $user_browser);

                // Check if session is valid
                if ($login_check == $login_string) {
                    // Logged In!!!!
                    return true;
                } else {
                    // Not logged in
                    return false;
                }
            } else {
                // Not logged in
                return false;
            }
        } else {
            // Not logged in
            return false;
        }
    }

    public static function loginFromForm()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['username']) && isset($_POST['password'])) {
                $username = htmlentities(trim($_POST['username']));
                $password = htmlentities(trim($_POST['password']));

                if (Authentication::login($username, $password) == true) {
                    //Login success
                    echo 'true';
                } else {
                    echo 'false';
                }
            } else {
                // The correct POST variables were not sent to this page.
                return 'false';
            }
        }
    }

    public static function logout()
    {
        // Unset all session values
        $_SESSION = array();

        // get session parameters
        $params = session_get_cookie_params();

        // Delete the actual cookie.
        setcookie(session_name(),
            '', time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]);

        // Destroy session
        session_destroy();
        echo 'true';
    }

    public static function changePasswordFromForm($newSession)
    {
        if (Authentication::checkCredentialsByID($_POST['id'], trim($_POST['oldpass'])) == true) {
            if (Authentication::savePassword($_POST['id'], trim($_POST['newpass1']), $newSession)) {
                echo 'true';
            } else {
                echo 'false';
            }
        } else {
            echo 'false';
        }
    }

    public static function resetPasswordFromProfile($userID)
    {
        if (Authentication::savePassword($userID, 'abcdef') == true) {
            echo 'true';
        } else {
            echo 'false';
        }
    }

    public static function setNewPasswordFromMail()
    {
        if (!IsNullOrEmptyString($_POST['memberid']) && !IsNullOrEmptyString($_POST['newpass1']) && !IsNullOrEmptyString($_POST['charstring'])) {
            if (Authentication::savePassword($_POST['memberid'], $_POST['newpass1'], null, $_POST['charstring']) == true) {
                if (PasswordRequest::updateRequest($_POST['memberid'], $_POST['charstring']) == true) {
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

    public static function savePassword($userID, $newPW, $newSession = false)
    {
        //salt & wachtwoord encrypteren
        $secure = generatePassword($newPW);
        $salt = $secure['salt'];
        $password = $secure['password'];

        //salt & wachtwoord wegschrijven
        $user = new User($userID);
        $user->setPassword($password);
        $user->setSalt($salt);

        if ($user->save()) {
            //login_string van de sessie wijzigen
            if ($newSession == true) {
                if (!session_id()) {
                    sec_session_start();
                }
                $user_browser = $_SERVER['HTTP_USER_AGENT'];
                $_SESSION['login_string'] = hash('sha512', $password . $user_browser);
            }
            return true;
        } else {
            return false;
        }
    }

    public static function checkCredentialsByID($userID, $password_form)
    {
        $user = new User($userID);
        if (!is_null($user)) {
            $password_db = $user->getPassword();
            $salt = $user->getSalt();
            $password = hash('sha512', $password_form . $salt);
            //compare passwords
            if ($password_db == $password) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function checkCredentialsByLogin($login, $password_form)
    {
        $user = User::selectByUserName($login);
        if (!is_null($user)) {
            $password_db = $user->getPassword();
            $salt = $user->getSalt();
            $password = hash('sha512', $password_form . $salt);

            //compare passwords
            if ($password_db == $password) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}