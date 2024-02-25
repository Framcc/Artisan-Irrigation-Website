<?php
    session_start();
    require_once('../util/security.php');

    Security::checkAuthority('admin');

    $admin_logged_in = isset($_SESSION['admin']);

    if(isset($_POST['logout'])) {
        Security::logout();
    }
?>
<html>
    <head>
        <link rel='stylesheet' href='styles.css'>
        <title>Artisan Irrigation Admin</title>
    </head>
    <body>
    <div class="topNav">
            <div class="logo">
                <img src='imgs/artisan_logo.png' alt="Artisan Irrigation" width="319" height="112">
            </div>
            <?php if($admin_logged_in) {
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
                if($admin_logged_in && $_SESSION['admin'] === true) {
                   echo '<a class="active" href="admin.php">Admin</a>';
                }
            ?>
        </div>
        <h2>Administrator Options</h2>
        <ul>
            <li><a href='dbconn_status.php'>Database Status</a></li>
        </ul>
    </body>
    <footer></footer>
</html>