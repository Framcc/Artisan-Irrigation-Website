<?php 
    session_start();
    require_once('../util/file_utilities.php');
    require_once('../util/security.php');

    Security::checkAuthority('technician');

    $tech_logged_in = isset($_SESSION['technician']);

    if(isset($_POST['logout'])) {
        Security::logout();
    }

    $dir = getcwd() . "/tickets/";
    $viewFile = '';
    $editFile = '';

    if(isset($_POST['view'])) {
        $fName = $_POST['fileToView'];
        $viewFile = FileUtilities::GetFileContents($dir . $fName);
        $editFile = '';
    }

    if(isset($_POST['load'])) {
        $fName = $_POST['fileToUpdate'];
        $editFile = FileUtilities::GetFileContents($dir . $fName);
        $viewFile = '';
    }

    if(isset($_POST['save'])) {
        $fName = $_POST['fileToUpdate'];
        $content = $_POST['editFile'];
        FileUtilities::WriteFile($dir . $fName, $content);
        $editFile = '';
        $viewFile = '';
    }

    if(isset($_POST['create'])) {
        $fName = $_POST['newFileName'];
        $content = $_POST['createFile'];
        FileUtilities::WriteFile($dir . $fName, $content);
        $editFile = '';
        $viewFile = '';
    }

    if(isset($_POST['delete'])) {
        $fName = $_POST['fileToDelete'];
        FileUtilities::DeleteFile($dir . $fName);
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
            <?php if($tech_logged_in) {
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
                if($tech_logged_in && $_SESSION['technician'] === true) {
                    echo '<a class="active" href="ticket_management.php">Manage Tickets</a>';
                }
            ?>
        </div>
        <h1>Maintenance Ticket Management</h1>
        <h4>Instructions:</h4>
        <p>
            Search a file name using the provided search bars including the file extension ".txt". For example if I wanted a file named Test, I would search for Test.txt in the search bar.
             For creating files make sure to include the file extension ".txt" at the end of the file name.
        </p>
        <h3>Ticket Files Available:</h3>
        <form method="POST">
            <ul>
                <?php foreach(FileUtilities::GetFileList($dir) as $file) : ?>
                <li><?php echo $file ?></li>
                <?php endforeach; ?>
            </ul>
            <h3>View Ticket File: 
                <input type="search" name="fileToView" placeholder="Enter file name"> 
                <input type="submit" value="View File" name="view">
            </h3>
            <textarea id="viewFile" name="viewFile" rows="5" cols="50"
                    disabled><?php echo $viewFile ?></textarea>
            <h3>Update Ticket File:
                <input type="search" name="fileToUpdate" placeholder="Enter file name"
                    value="<?php echo isset($_POST['fileToUpdate']) ? htmlspecialchars($_POST['fileToUpdate']) : ''; ?>">
                <input type="submit" value="Load File" name="load">
                <input type="submit" value="Save" name="save">
            </h3>
            <textarea id="editFile" name="editFile" rows="5" cols="50"
                ><?php echo $editFile ?></textarea>
            <h3>Create Ticket File:
                <input type="text" name="newFileName" placeholder="Enter file name">
                <input type="submit" value="Create" name="create">
            </h3>
            <textarea id="createFile" name="createFile" rows="5" cols="50"></textarea>
            <h3>Delete Ticket File:
                <input type="search" name="fileToDelete" placeholder="Enter file name">
                <input type="submit" value="Delete File" name="delete">
            </h3>
        </form>
    </body>
    <footer></footer>
</html>