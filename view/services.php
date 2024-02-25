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
            <a class="active" href='services.php'>Services</a>
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
        <h1 style="color: rgba(73,115,152,225);"> Our Services</h1>
        <button class='accordion'>Irrigation System Installation</button>
        <div class='panel'>
            <p>Installing an irrigation system is a smart investment in the health and beauty of your landscape.
                Our professional team will design and install a system tailored to your property's specific needs, ensuring omptimal water distribution and conservation.
                Our pricing is competitive and transparent, with no hidden fees. Contact us today for a free consultation and take the first step towards a greener, more vibrant landscape!</p>
            <h4>Description of Installation Serivce: </h4>
            <p>After the customer consultation, our expert team begins by conducting a thorough assessment of your landscape to determine the best placement for irrigation lines and sprinklers.
                We then carefully excavate the necessary areas, taking care to minimize disruption to your property. Next, we install high-quality piping and components, ensuring durability and efficient water distribution.
                Finally, we test the system to ensure everything is functioning perfectly. Any township, city, or state required inspections will be called in and carried out by their respective departments.
                 Our goal is to provide you with a hassle-free installation process that results in a lush, healthly landscape.</p>
            <img src="imgs/install.jpg" alt="Irrgation Installation" width="650" height="867" style="padding: 20px; margin-right: auto; margin-left: auto;">
        </div>
        <button class='accordion'>Seasonal Irrigation Maintenance Program</button>
        <div class='panel'>
            <p>Artisan Irrigation is offering annual seaonal maintenance programs to serve your irrigation needs.
                 By taking advantage of one of these programs, your work will be done at a discounted rate and scheduled as a priority customer.</p>
            <h3>Programs Offered</h3>
            <ul>
                <h4>Basic: Charge - 6 zones or less $220.00, $10.00 ea. Zones over 6</h4>
                <li><p>Two visits per year</p></li>
                <li><p>Winterization in November or December</p></li>
                <li><p>Spring activation in March or April</p></li>
                <li><p>Discounted service rate of $95.00 per hour, plus materials, for any additional services rendered throughout the year beyond the scope of the basic program</p></li>
            </ul>
            <ul>
                <h4>Standard: Charge - 6 zones or less $465.00, $25.00 ea. Zones over 6</h4>
                <li><p>Four visits per year</p></li>
                <li><p>Winterization in November or December</p></li>
                <li><p>Spring activation in March or April</p></li>
                <li><p>System performance monitoring during June or July, and August or September</p></li>
                <li><p>Discounted service rate of $93.00 per hour, plus materials, for any additional services rendered throughout the year beyond the scope of the standard program</p></li>
            </ul>
            <ul>
                <h4>Premium: Charge - 6 zones or less $980.00, $60.00 ea. Zones over 6</h4>
                <li><p>Eight visits per year</p></li>
                <li><p>Winterization in November or December</p></li>
                <li><p>Spring activation in March or April</p></li>
                <li><p>System performance monitoring once a month April through November</p></li>
                <li><p>Discounted service rate of $90.00 per hour, plus materials, for any additional services rendered throughout the year beyond the scope of the premium program</p></li>
            </ul>

            <h3>Definition of Services Described Above</h3>
            <ul>
                <h4>Winterization</h4>
                <li><p>Cut off water supply to system</p></li>
                <li><p>Drain existing water from sprinklers and valves</p></li>
                <li><p>Drain and/or remove Backflow Preventer or Pump</p></li>
            </ul>
            <ul>
                <h4>Spring Activation</h4>
                <li><p>Re-Activation of Backflow Preventer or Pump</p></li>
                <li><p>Pressuriation of system to determine any system leaks</p></li>
                <li><p>Check all sprinklers for correct orientation and distribution</p></li>
                <li><p>Resseting of controller based upon any water restriction in the area (homeowner and/or maintenace personnel may choose to make adjustments as seasonal changes dictate)</p></li>
                <li><p>Check drip tubing for leaks and/or damage where applicable</p></li>
                <li><p>Notify owner of possible problem areas, alterations, or upgrades</p></li>
            </ul>
            <ul>
                <h4>Performance Monitoring</h4>
                <li><p>Checking system operation</p></li>
                <li><p>Adjusting and cleaning heads as necessary</p></li>
                <li><p>Checking controller functions</p></li>
                <li><p>Evaluating if further services repairs are necessary</p></li>
            </ul>
            <p>*Current 2023-2024 labor rates are Technicion-$100.00 per hour & Assistant-$55.00 exclusive of speacial programs offered above.
                Rates are based on a one-hour minimum (which includes travel time one way) and are billed in quarter hour increments. Seasonal maintenance clients will not be subjected to a 1-hour minimum.
                Service does not include any materials unless covered under warranty (those warranty items installed by Artisan Irrigation, Inc.).
            </p>
        </div>
        <button class='accordion'>Outdoor Lighting</button>
        <div class='panel'>
            <h2>Outdoor Lighting</h2>
            <p>Illuminate your outdoor space with our expert lighting installation services.
                 From pathway lighting to accentuating architectural features, our team will create a custom lighting design that meets your needs and enhances the beauty of your property. 
                 Our transparent pricing and commitment to quality ensure you get a stunning outdoor lighting setup that lasts. Get in touch with us today to schedule a consultation!</p>
            <h4>Description of Installation Serivce: </h4>
            <p>Our professional installation process begins with a detailed assessment of your outdoor space to determine the best placement for lighting fixtures.
                 We then carefully install the fixtures, taking care to conceal wiring and ensure everything is securely in place.
                  Finally, we test the system to ensure proper functionality and adjust as needed to achieve the desired lighting effect.
                 Trust us to enhance your outdoor space with expertly installed lighting that adds beauty and functionality to your property.</p>
            <img src="imgs/lighting.jpg" alt="Lighting Showcase" width="1300" height="651" style="padding: 20px; margin-right: auto; margin-left: auto;">
        </div>
    </body>
    <footer></footer>
</html>
<?php
//JavaScript for Accordion Buttons
    echo "<script>";
    echo "var accordion = document.getElementsByClassName('accordion');
            var i;
            for (i=0; i<accordion.length; i++) {
                accordion[i].addEventListener('click', function() {
                    this.classList.toggle('active');
                    var panel = this.nextElementSibling;
                    if (panel.style.maxHeight) {
                        panel.style.maxHeight = null;
                    }
                    else {
                        panel.style.maxHeight = panel.scrollHeight + 'px';
                    }
                });
            }";
    echo "</script>";
?>