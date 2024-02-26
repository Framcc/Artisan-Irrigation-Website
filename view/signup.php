<?php
    session_start();
    require_once('../controller/user.php');
    require_once('../controller/user_controller.php');
    require_once('../controller/level.php');
    require_once('../controller/level_controller.php');
    require_once('../util/security.php');

    $user_logged_in = isset($_SESSION['user']);
    $admin_logged_in = isset($_SESSION['admin']);
    $tech_logged_in = isset($_SESSION['technician']);

    if(isset($_POST['logout'])) {
        Security::logout();
    }

    

    $user = new User('','','','','','');
    $user->setUserId(-1);
    $pageTitle = "Sign up";

    //Error Message Varibles
    $validation_error = '';
    $password_error = '';
    $fName_error = '';
    $lName_error = '';
    $email_error = '';
    $level_error = '';



    if(isset($_POST['save'])) {
       $user = new user( $fName = $_POST['fName'], $lName = $_POST['lName'],$email = $_POST['email'], $pass = $_POST['password'],  $registrationDate= date('y-m-d'), $level = '2');
    


    //password validation
    if(!strlen($password) == '') {
        if(strlen($pass) < 4 || strlen($pass) > 20 ) {
            $password_error .= ' Must be at least 4-20 characters.';
        }
        if(!preg_match('/[A-Z]/', $pass)) {
            $password_error .= ' Must contain a capital letter.';
        }
        if(!preg_match('/[a-z]/', $pass)) {
            $password_error .= ' Must contain a lowercase letter.';
        }
        if(!preg_match('/\d/', $pass)) {
            $password_error .= ' Must contain a number.';
        }
    }
    else {
        $password_error = 'Required';
    }

    //first name validation
    if(!strlen($fName) == '') {
        if(strlen($fName) < 2) {
            $fName_error = 'Must be at least 2 characters';
        }
    }
    else {
        $fName_error = 'Required';
    }

    //last name validation
    if(!strlen($lName) == '') {
        if(strlen($lName) < 2) {
            $lName_error = 'Must be at least 2 characters';
        }
    }
    else {
        $lName_error = 'Required';
    }


    //email validation
    if(!strlen($email) == '') {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_error = 'Must be valid E-Mail address';
        }
    }
    else {
        $email_error = 'Required';
    }






        if(strlen($password_error) > 0 || strlen($fName_error) > 0 || strlen($lName_error) > 0 
             || strlen($email_error) > 0 || strlen($level_error) > 0 ) {
                $validation_error = 'There are validation errors!';
        }
        else {
                UserController::addUser($user);  
        header('Location: ./login.php');
        }
    }
    

    if(isset($_POST['cancel'])) {
        header('Location: ./login.php');
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
                if($admin_logged_in && $_SESSION['admin'] === true) {
                   echo '<a href="admin.php">Admin</a>';
                }
                if($tech_logged_in && $_SESSION['technician'] === true) {
                    echo '<a href="ticket_management.php">Manage Tickets</a>';
                }
            ?>
        </div>

        <h2><?php echo $pageTitle; ?></h2>
        <form method='POST'>
            <h3>First Name: <input type='text' name='fName' value="<?php echo $user->getFirstName(); ?>"> 
                <?php if(strlen($fName_error) > 0)
                    echo "<span style = 'color: red;'>{$fName_error}</span>"; ?>
            </h3>
            <h3>Last Name: <input type='text' name='lName' value="<?php echo $user->getLastName(); ?>"> 
                <?php if(strlen($lName_error) > 0)
                    echo "<span style = 'color: red;'>{$lName_error}</span>"; ?>
            </h3>
            <h3>E-Mail: <input type='text' name='email' value="<?php echo $user->getEmail(); ?>"> 
                <?php if(strlen($email_error) > 0)
                    echo "<span style = 'color: red;'>{$email_error}</span>"; ?>
            </h3>

            <h3>Password: <input type='text' name='password' value="<?php echo $user->getPassword(); ?>">
                <?php if(strlen($password_error) > 0)
                    echo "<span style = 'color: red;'>{$password_error}</span>"; ?>
            </h3>

            <h3><?php echo "<span style = 'color: red;'>{$validation_error}</span>" ?></h3>
            <input type='hidden'
                value="<?php echo $user->getUserId(); ?>" name="uId">
            <input type="submit" value="Save" name="save">
            <input type="submit" value="Cancel" name="cancel">
        </form>
    </body>
    <footer></footer>
</html>