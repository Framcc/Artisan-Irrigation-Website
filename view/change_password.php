<?php
    session_start();

    require_once('../util/security.php');
    require_once('../controller/user_controller.php');

    Security::checkAuthority('user');

    $user_logged_in = isset($_SESSION['user']);
    $password_error = '';
    $validation_error = '';
    $current_error = '';
    $confirm_error = '';

    if(isset($_SESSION['user_id'])) {
        $user = UserController::getUserById($_SESSION['user_id']);
    
    } 

    if(isset($_POST['logout'])) {
        Security::logout();
    }

    
    if(isset($_POST['save'])) {
        $userUpdated = clone $user;
        $password = $_POST['new'];

        if($user->getPassword() !== $_POST['current']) {
            $current_error = "Does not match current password.";
        } 

        if($password !== $_POST['confirm']) {
            $confirm_error = 'Confirmed Password and New Password do not match!';
        }

        if(!strlen($password) == '') {
            if(strlen($password) < 4 || strlen($password) > 20 ) {
                $password_error .= ' Must be at least 4-20 characters.';
            }
            if(!preg_match('/[A-Z]/', $password)) {
                $password_error .= ' Must contain a capital letter.';
            }
            if(!preg_match('/[a-z]/', $password)) {
                $password_error .= ' Must contain a lowercase letter.';
            }
            if(!preg_match('/\d/', $password)) {
                $password_error .= ' Must contain a number.';
            }
        }
        else {
            $password_error = 'Required';
        }

        
        if(strlen($password_error) > 0 || strlen($current_error) > 0 || strlen($confirm_error) > 0 ) {
                $validation_error = 'There are validation errors!';
        }
        else { 
            $userUpdated->setPassword($password);
            UserController::updateUser($userUpdated);
            header('Location: ../view/manage_account.php');
        }   

 
         
     }
 
     if(isset($_POST['cancel'])) {
         header('Location: ../view/manage_account.php');
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
            <a href="home.php">Home</a>
            <a href='services.php'>Services</a>
            <a href='about.php'>About Us</a>
            <?php
                if($user_logged_in && $_SESSION['user'] === true) {
                    echo '<a href="maintenance_ticket.php">Maintenance Request</a>';
                    echo '<a href="manage_account.php">Account</a>';
                    
                } 
            ?>
        </div>
        <div class="password_form">
            <h2>Password Change Form</h2>
            <form method="POST">
                <h3>Current Password: <input type='text' name='current' value="" > 
                <?php if(strlen($current_error) > 0)
                    echo "<span style = 'color: red;'>{$current_error}</span>"; ?>
                </h3>
                <h3>New Password: <input type='text' name='new' value="" > 
                <?php if(strlen($password_error) > 0)
                    echo "<span style = 'color: red;'>{$password_error}</span>"; ?>
                </h3>
                <h3>Confirm New Password: <input type='text' name='confirm' value="" > 
                <?php if(strlen($confirm_error) > 0)
                    echo "<span style = 'color: red;'>{$confirm_error}</span>"; ?>
                </h3>
                <input type="submit" value="Confirm" name="save">
                <input type="submit" value="Cancel" name="cancel">
                <h3><?php echo "<span style = 'color: red;'>{$validation_error}</span>" ?></h3>
            </form>
        </div>
    </body>
    <footer></footer>
</html>
