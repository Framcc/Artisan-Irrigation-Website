<?php
    require_once('database.php');

    class UsersDB {
        public static function getUserByEMail($email) {
            $db = new Database();
            $dbConn = $db->getDbConn();

            if($dbConn) {
                $query = "SELECT * FROM users
                            WHERE users.EMail = '$email'";

                $result = $dbConn->query($query);
                return $result->fetch_assoc();
            }
            else {
                return false;
            }
        }

        public static function getUserById($userId) {
            $db = new Database();
            $dbConn = $db->getDbConn();

            if($dbConn) {
                $query = "SELECT * FROM users
                        WHERE UserId = '$userId'";
                $result = $dbConn->query($query);
                return $result->fetch_assoc();
            }
            else {
                return false;
            }
        }

        public static function getUsersByLevel($userLevel) {
            $db = new Database();
            $dbConn = $db->getDbConn();

            if($dbConn) {
                $query = "SELECT * FROM users
                        INNER JOIN user_levels
                            ON users.UserLevel = user_levels.UserLevelNo
                        WHERE users.UserLevel = '$userLevel'";
                return $dbConn->query($query);
            }
            else {
                return false;
            }
        }

        public static function deleteUser($userId) {
            $db = new Database();
            $dbConn = $db->getDbConn();

            if($dbConn) {
                $query = "DELETE FROM users
                        WHERE UserId = '$userId'";
                return $dbConn->query($query) === TRUE;
            }
            else {
                return false;
            }
        }

        public static function addUser($fName, $lName, $email, $password, $registrationDate, $userLevel) {
            $db = new Database();
            $dbConn = $db->getDbConn();

            if($dbConn) {
                $query = "INSERT INTO users (FirstName, LastName, EMail, Password, RegistrationDate, UserLevel)
                            VALUES ('$fName', '$lName', '$email', '$password', '$registrationDate', '$userLevel' )";
                return $dbConn->query($query) === TRUE;
            }
            else {
                return false;
            }
        }

        public static function updateUser($userId, $fName, $lName, $email, $password, $registrationDate, $userLevel) {
            $db = new Database();
            $dbConn = $db->getDbConn();

            if($dbConn) {
                $query = "UPDATE users SET
                            FirstName = '$fName',
                            LastName = '$lName',
                            EMail = '$email',
                            Password = '$password',
                            RegistrationDate = '$registrationDate',
                            UserLevel = '$userLevel'
                        WHERE UserId = '$userId'";
                return $dbConn->query($query) === TRUE;
            }
            else {
                return false;
            }
        }
    }
?>