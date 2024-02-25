<?php

session_start();

require_once('../util/security.php');
require_once('../controller/user.php');
require_once('../controller/user_controller.php');

Security::checkAuthority('user');

$user_logged_in = isset($_SESSION['user']);

if(isset($_POST['logout'])) {
    Security::logout();
}

if(isset($_SESSION['user_id'])) {
    $res = UserController::getUserById($_SESSION['user_id']);

}

?>
<html>
    <head>
        <link rel="stylesheet" href="styles.css">
        <title>Artisan Irrigation</title>
    </head>
    <body>
         
        <div class="topNav">
            <div class="logo">
                <img src='imgs/artisan_logo.png' alt="Artisan Irrigation" width="319" height="112">
            </div>
            <?php if($user_logged_in) {
            echo '<form method="POST">
            <input type="submit" value="Logout" name="logout" id="logout">
            </form>';
            }
            else {
                echo '<form action="login.php">
                <input type="submit" value="Login" name="login" id="login">
                </form>';
            }
            ?>
            <a href="home.php">Home</a>
            <a href='services.php'>Services</a>
            <a href='about.php'>About Us</a>
            <?php
                if($user_logged_in && $_SESSION['user'] === true) {
                    echo '<a href="maintenance_ticket.php">Maintenance Request</a>';
                    echo '<a class="active" href="manage_account.php">Account</a>';
                    
                } 
            ?>
        </div>
        <div class="user_info">
                <h1>Manage User Account</h1>
                <h3>First Name: <?php echo $res->getFirstName();?></h3>
                <h3>Last Name: <?php echo $res->getLastName();?></h3>
                <h3>E-Mail: <?php echo $res->getEMail();?></h3>
                <h3>Password: <span id="password"><?php echo $res->getPassword();?></span>  <form action="change_password.php"><input type="submit" value="Change Password" name="changePassword" ></form></h3>
                <h3>Registration Date: <?php echo $res->getRegistrationDate();?></h3>
        </div>
    </body>
    <footer></footer>
</html>
<?php
    //JavaScript to hide password
    echo "<script>";
    echo "const passwordSpan = document.getElementById('password');";
    echo "const password = passwordSpan.innerHTML;";
    echo "passwordSpan.innerHTML = password.charAt(0) + '*'.repeat(password.length - 1); ";
    echo "</script>";
?>