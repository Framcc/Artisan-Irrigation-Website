<?php
    session_start();
    require_once('../controller/user.php'); 
    require_once('../controller/user_controller.php');
    require_once('../util/security.php');

    Security::checkHTTPS();

    $user_logged_in = isset($_SESSION['user']);
    $admin_logged_in = isset($_SESSION['admin']);
    $tech_logged_in = isset($_SESSION['technician']);

    $login_msg = isset($_SESSION['logout_msg']) ?
        $_SESSION['logout_msg'] : '';

    if(isset($_POST['email']) & isset($_POST['pw'])) {
        $user_level = UserController::validUser($_POST['email'], $_POST['pw']);
        $_SESSION['user_id'] = UserController::getUserIdByEmail($_POST['email']);
        if($user_level === '1') {
            $_SESSION['admin'] = true;
            $_SESSION['user'] = false;
            $_SESSION['technician'] = false;
            
            header("Location: home.php");
        }
        else if($user_level === '2') {
            $_SESSION['admin'] = false;
            $_SESSION['user'] = true;
            $_SESSION['technician'] = false;
            header("Location: home.php");
        }
        else if($user_level === '3') {
            $_SESSION['admin'] = false;
            $_SESSION['user'] = false;
            $_SESSION['technician'] = true;
            header("Location: home.php");
        }
        else {
            $login_msg = "Failed Authentication - try again.";
        }
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
            <a href="home.php">Home</a>
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
        <h2>Login</h2>
        <form method='POST'>
            <h3>E-Mail: <input type="text" name="email"></h3>
            <h3>Password: <input type='password' name='pw'></h3>
            <input type='submit' value='Login' name='login'>
        </form>
        <h2><?php echo $login_msg; ?></h2>
        <p>Don't have an account? <a href='signup.php'>Register Now</a></p>
    </body>
    <footer></footer>
</html>