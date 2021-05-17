<?php  
    require_once('./includes/config.php');
    require_once('./includes/classes/Account.php');
    $account = new Account($conn);
    $userInfo = $account->getInfo();
    
    $curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
?> 

<nav class="navbar navbar-expand-lg navbar-dark bg-dark navbar-custom sticky-top">
    <a href="./index.php" class="navbar-brand"><b>MediCare</b></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar1">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-center navbar-collapse collapse" id="navbar1">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item <?php echo $curPageName == 'index.php'? 'active' : ''; ?>">
                <a class="nav-link mr-2" href="./index.php">Home</a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link mr-2" href="#Department">Department</a>
            </li>
            <li class="nav-item">
                <a class="nav-link mr-2" href="#Services">Services</a>
            </li> -->
            <li class="nav-item <?php echo $curPageName == 'about.php'? 'active' : ''; ?>">
                <a class="nav-link mr-2" href="./about.php">About</a>
            </li>
            <li class="nav-item <?php echo $curPageName == 'contact.php'? 'active' : ''; ?>">
                <a class="nav-link mr-2" href="./contact.php">Contact Us</a>
            </li>
            
            <?php
                if(isset($_SESSION["userLoggedIn"])) {
            ?>
                <li class="nav-item avatar dropdown">
                    <a class="nav-link dropdown-toggle" id="avatarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="https://mdbootstrap.com/img/Photos/Avatars/avatar-2.jpg" class="rounded-circle z-depth-0" alt="avatar image" style="width: 36px; height: 36px;">
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg-right dropdown-secondary" aria-labelledby="avatarDropdown">
                        <a class="dropdown-item" href="./dashboard.php">My Profile</a>
                        <a class="dropdown-item" href="<?php 
                            if ($userInfo['name'] == 'Admin') {
                                echo './admin-dashboard.php'; 
                            } elseif ($userInfo['name'] == 'Doctor') {
                                echo './doctor-dashboard.php';
                            } elseif ($userInfo['name'] == 'Patient') {
                                echo './dashboard.php';
                            }
                        ?>">Dashboard</a>
                        <a class="dropdown-item" href="./logout.php">Log out</a>
                    </div>
                </li>
            <?php
                } else {
            ?>
                <li class="nav-item">
                    <button type="button" class="nav-link mr-2 btn btn-dark" onclick="location.href='login.php'">Login</button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link mr-2 btn btn-dark" onclick="location.href='register.php'" style="margin: 0 5px;">Sign Up</button>
                </li>
            <?php
                }
            ?>
        </ul>
    </div>
</nav>