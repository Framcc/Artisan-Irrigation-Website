<?php
    require_once('../model/database.php');

    error_reporting(E_ERROR);

    $db = new Database();
?>

<html>
    <head>
        <title>Artisan Irrigation</title>
    </head>
    <body>
        <h1>Database Connection Status</h1>
        <?php if(strlen($db->getDbError())) : ?>

            <ul>
                <li><?php echo "Database Name: " . $db->getDbName(); ?></li>
                <li><?php echo "Database Host: " . $db->getDbHost(); ?></li>
                <li><?php echo "Database User: " . $db->getDbUser(); ?></li>
                <li><?php echo "Database User Password: " . $db->getDbUserPw(); ?></li>
            </ul>
            <h2><?php echo "Connection Unsuccessful: " . $db->getDbError(); ?></h2>
        <?php else : ?>
            <ul>
                <li><?php echo "Database Name: " . $db->getDbName(); ?></li>
                <li><?php echo "Database Host: " . $db->getDbHost(); ?></li>
                <li><?php echo "Database User: " . $db->getDbUser(); ?></li>
                <li><?php echo "Database User Password: " . $db->getDbUserPw(); ?></li>
            </ul>
            <h2><?php echo "Successfully connected to " . $db->getDbName(); ?></h2>
        <?php endif; ?>
        <h3><a href="../admin.php">Back to Admin Menu</a></h3>
    </body>
</html>