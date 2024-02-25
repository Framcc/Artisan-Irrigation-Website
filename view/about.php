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
            <a href="home.php">Home</a>
            <a href='services.php'>Services</a>
            <a class="active" href='about.php'>About Us</a>
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
        <div class="about">
            <h1>About Us</h1>
            <h2>Artisan Irrigation Since 1996</h2>
            <p>Artisan Irrigation Inc. Co. has been faithfully serving the state of North Carolina since 1996. Headquartered in Cary, North Carolina,
                 our goal has been and will always will be to provide North Carolina and its citizens irrigation infrastructure to grow and support it's green spaces.
                We work with our water-conserving product partners to deliver a water-saving system to save water for not only our customers, but our planet too.</p>
            <h2>Awards</h2>
            <ul>
                <li><p>Toro™ Water Smart Partner 2010</p></li>
                <li><p>Toro™ Water Smart Partner 2011</p></li>
            </ul>
            <h2>Artisan Irrigation's Mission</h2>
            <ul>
                <h3>Our mission at Artisan Irrigation is to be the North Carolina irrigation industry leader by:</h3>
                <li><p>Achieving customer satisfaction by always meeting expectations</p></li>
                <li><p>Profitably provide irrigation and outdoor lighting services that promote energy and water efficency</p></li>
                <li><p>Being a responsible company that is respected by its employees and community</p></li>
            </ul>
        </div>
        <div class="contact">
            <h1>Contact Artisan Irrigation</h1>
            <p>Arritisan Irrigation is commited to providing you with the best service and support possible. Please help us direct you to our different contact options. </p>
            <h2>Phone and Email Contacts</h2>
            <p>Please call us toll-free if you need assistance. If you are unable to get in contact with one of our representatives, leave us a phone message or email with your name, phone number,and a brief description of the issue. We will try to get back to you as soon as possible.</p>
            <ul>
                <li><h3>Office Phone: 919-480-7501</h3>
                <li><h3>Mobile Phone: 919-812-7597</h3></li>
                <li><h3>E-Mail: artisansm@aol.com</h3></li>
            </ul>
            <h2>Postal Box</h2>
            <p>PO Box 387</p>
            <p>Cary, NC 27512</p>
        </div>
    </body>
    <footer></footer>
</html>