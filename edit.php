<?php
    require_once('./includes/imports.php');
    require_once('./includes/config.php');
    require_once('./includes/classes/Account.php');
    require_once('./includes/classes/Constants.php');
    
    $account = new Account($conn);
    require_once('./includes/components/navbar.php');

    $id = $_GET["user_id"];
    $userInfo = $account->getUser($id);

    $getInfo = $account->getInfo();
	if (isset($_SESSION["userLoggedIn"]) && $isAdmin = $getInfo["role_name"] == 'Admin' || 'Nurse' || 'Doctor') {
        // echo $_SESSION["userLoggedIn"];
?>
<div class="container-fluid">
    <button class="btn btn-primary" onclick="document.location='<?php 
    if(isset($_SERVER['HTTP_REFERER']))
        echo $_SERVER['HTTP_REFERER'];
    else
        echo 'dashboard.php';
    ?>'"><i class="fas fa-arrow-circle-left"></i> Back</button>
    <?php
        if (isset($_POST["updateInfo"])) {
            $firstName = $_POST["firstName"];
            $lastName = $_POST["lastName"];
            $email = $_POST["email"];
            $userType = $_POST["userType"];
            $account->updateUser($id, $firstName, $lastName, $email, $userType);
        }
        // print_r($userInfo);
    ?>

    <br>

    <div>
        <h1>Editing <em><?php echo $userInfo["first_name"] . " " . $userInfo["last_name"]?></em> Details</h1>
        <hr>
        <div class="form-container-admin">
            <form action="" method="POST">
                <div class="form-group">
                    <label for="user_id">User ID</label>
                    <input type="text" class="form-control" name="user_id" placeholder="Enter User ID" value="<?php echo $userInfo['user_id'] ?>" required disabled>
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="firstName">First Name</label>
                            <?php echo $account->getError(Constants::$nameCharacters); ?>
                            <input type="text" class="form-control" name="firstName" placeholder="Enter First Name" maxlength="25" value="<?php echo $userInfo['first_name'] ?>" required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="lastName">Last Name</label>
                            <?php echo $account->getError(Constants::$nameCharacters); ?>
                            <?php echo $account->getError(Constants::$nameCharacters); ?>
                            <input type="text" class="form-control" name="lastName" placeholder="Enter Last Name" maxlength="25" value="<?php echo $userInfo['last_name'] ?>" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <?php echo $account->getError(Constants::$emailInvalid); ?>
                            <?php echo $account->getError(Constants::$emailTaken); ?>
                            <input type="email" class="form-control" name="email" placeholder="Enter your Email Address" maxlength="25" value="<?php echo $userInfo['email'] ?>" required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="userType">User Type</label>
                            <input type="tel" class="form-control" name="userType" placeholder="userType: 1 User: 0" maxlength="1" value="<?php echo $userInfo['role_name'] ?>" required>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary" name="updateInfo">Save</button>
            </form>
        </div>
    </div>
    <?php
    } else {
        //  if not logged in
        header("Location: login.php");
    }
    require_once('./includes/importsAfter.php');
?>