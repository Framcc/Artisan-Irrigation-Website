<?php
    require_once('../model/user_db.php');
    require_once('user.php');

    class UserController {
        private static function rowToUser($row) {
            $user = new User($row['FirstName'], 
                $row['LastName'],
                $row['EMail'],
                $row['Password'],
                $row['RegistrationDate'],
                $row['UserLevel'],
                $row['UserId']);
            return $user;
        }

        public static function validUser($email, $password) {
            $queryRes = UsersDB::getUserByEMail($email);

            if($queryRes) {
                $user = self::rowToUser($queryRes);
                if($user->getPassword() === $password) {
                    return $user->getUserLevel();
                }
                else {
                    return false;
                }
            }
            else {
                return false;
            }
        }
        
        public static function getUser($email) {
            $queryRes = UsersDB::getUserByEMail($email);

            if($queryRes) {
                $user = self::rowToUser($queryRes);
                
                return $user->getEMail();
            }
            else {
                return false;
            }
        }

        public static function getUserById($userId) {
            $queryRes = UsersDB::getUserById($userId);

            if($queryRes) {
                return self::rowToUser($queryRes);
            }
            else {
                return false;
            }
        }

        public static function getUsersByLevel($levelNo) {
            $queryRes = UsersDB::getUsersByLevel($levelNo);

            if($queryRes) {
                $users = array();
                foreach ($queryRes as $row) {
                    $users[] = self::rowToUser($row);
                }

                return $users;
            }
            else {
                return false;
            }
        }

        public static function getUserIdByEmail($email) {
            $queryRes = UsersDB::getUserByEMail($email);

            if($queryRes) {
                 $user = self::rowToUser($queryRes);
                return $user->getUserId();
            }
            else {
                return false;
            }
        }


        public static function deleteUser($userNo) {
            return UsersDB::deleteUser($userNo);
        }

        public static function addUser($user) {
            return UsersDB::addUser(
                $user->getFirstName(),
                $user->getLastName(),
                $user->getEMail(),
                $user->getPassword(),
                $user->getRegistrationDate(),
                $user->getUserLevel()
            );         
        }

        public static function updateUser($user) {
            return UsersDB::updateUser(
                $user->getUserId(),
                $user->getFirstName(),
                $user->getLastName(),
                $user->getEMail(),
                $user->getPassword(),
                $user->getRegistrationDate(),
                $user->getUserLevel()
            );             
        }
    }

?>