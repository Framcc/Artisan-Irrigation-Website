<?php
    class Security {
        public static function checkHTTPS() {
            if(!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] != 'on') {
                echo "<h1>HTTPS is Required!</h1>";
                exit();
            }
        }
        
        public static function logout() {
            unset($_SESSION['user']);
            unset($_SESSION['admin']);
            unset($_SESSION['technician']);
            unset($_SESSION['user_id']);

            unset($_POST);

            $_SESSION['logout_msg'] = 'Successfully logged out.';
            header('Location: ../view/login.php');
            exit();
        }

        public static function checkAuthority($auth) {
            if(!isset($_SESSION[$auth]) || !$_SESSION[$auth]) {
                $_SESSION['logout_msg'] = "Current login unauthorized for this page.";
                header("Location: ../view/login.php");
                exit();
            }
        }
    }
?>