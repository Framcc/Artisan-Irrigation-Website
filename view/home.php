<?php
    session_start();

    require_once('../util/security.php');

    $user_logged_in = isset($_SESSION['user']);
    $admin_logged_in = isset($_SESSION['admin']);
    $tech_logged_in = isset($_SESSION['technician']);

    if(isset($_POST['logout'])) {
        Security::logout();
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
            <?php if($user_logged_in || $admin_logged_in || $tech_logged_in) {
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
            <a class="active" href="home.php">Home</a>
            <a href='services.php'>Services</a>
            <a href='about.php'>About Us</a>
            <?php
                if($user_logged_in && $_SESSION['user'] === true) {
                    echo '<a href="maintenance_ticket.php">Maintenance Request</a>';
                    echo '<a href="manage_account.php">Account</a>';
                    
                } 
                if($admin_logged_in && $_SESSION['admin'] === true) {
                   echo '<a href="admin.php">Admin</a>';
                }
                if($tech_logged_in && $_SESSION['technician'] === true) {
                    echo '<a href="ticket_management.php">Manage Tickets</a>'; 
                }
            ?>
        </div>

        <div class='hero'>
            <h2>The One Stop For All Your Irrigation and Outddor Lighting Needs</h2>
            <h1>Artisan Irrigation</h1>
            <h2>Help your green spaces grow!</h2>
            <form action="services.php">
                <input type="submit" value="Our Services" />
            </form>
            <img src="imgs/sprinkler.jpg" alt="Sprinkler Operating" width="612" height="480">
        </div>
        
    </body>
    <footer></footer>
</html>