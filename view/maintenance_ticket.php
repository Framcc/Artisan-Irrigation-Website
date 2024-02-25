<?php
    session_start();
    require_once('../util/file_utilities.php');
    require_once('../util/security.php');

    Security::checkAuthority('user');

    $user_logged_in = isset($_SESSION['user']);

    if(isset($_POST['logout'])) {
        Security::logout();
    }


    $dir = getcwd() . "/tickets/";
    $viewFile = '';
    $editFile = '';


    if(isset($_POST['create'])) {
        $fName = $_POST['newFileName'];
        $content = $_POST['createFile'];
        FileUtilities::WriteFile($dir . $fName, $content);
        $editFile = '';
        $viewFile = '';
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
                    echo '<a class="active" href="maintenance_ticket.php">Maintenance Request</a>';
                    echo '<a href="manage_account.php">Account</a>';
                } 
            ?>
        </div>
        
        
        <h3>Maintenance Ticket Request Form:</h3>
        <p>Instructions: Please enter your name, phone number, address, and a brief description of the requested maintenance in the text box below.</p>
        <form method="POST">
            <h3>Create Maintenance Ticket:
                <input type="text" name="newFileName" placeholder='Enter "Your_Name.txt"'>
                <input type="submit" value="Create" name="create">
            </h3>
            <textarea id="createFile" name="createFile" rows="15" cols="100">
Name:
Phone:
Address:
Description:
            </textarea>
        </form>
    </body>
    <footer></footer>
</html>