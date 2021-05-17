<?php
require_once('./includes/imports.php');
require_once('./includes/config.php');
require_once('./includes/classes/Account.php');
require_once('./includes/classes/Constants.php');

$account = new Account($conn);
require_once('./includes/components/navbar.php');

if (isset($_SESSION["userLoggedIn"])) {
    // echo $_SESSION["userLoggedIn"];
?>
    <div class="container-fluid">
    <h1>Welcome, 
        <?php 
            $userInfo = $account->getInfo();
            echo $userInfo['first_name'] . " " . $userInfo['last_name'];
        ?>
    </h1>

    <?php
        if (isset($_POST["updateInfo"])) {
            $firstName = $_POST["firstName"];
            $lastName = $_POST["lastName"];
            $email = $_POST["email"];
            $account->updateProfile($userInfo, $firstName, $lastName, $email);
        }
    ?>
    <?php
        if (isset($_POST["updatePwd"])) {
            $oldPassword = $_POST["oldPw"];
            $newPassword = $_POST["password"];
            $newPassword2 = $_POST["password2"];
            $account->updatePwd($userInfo, $oldPassword, $newPassword, $newPassword2);
        }
    ?>

    <br>

    <div>
        <h1>Edit Your Details</h1>
        <hr>
        <div class="form-container-user">
            <form action="" method="POST">
                <div class="row">
                    <div class="col-6">
                       <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="firstName">First Name</label>
                                    <?php echo $account->getError(Constants::$nameCharacters); ?>
                                    <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Enter your First Name" maxlength="25" value="<?php echo $userInfo['first_name'] ?>" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="lastName">Last Name</label>
                                    <?php echo $account->getError(Constants::$nameCharacters); ?>
                                    <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Enter your Last Name" maxlength="25" value="<?php echo $userInfo['last_name'] ?>" required>
                                </div>
                            </div>
                       </div>
    
    
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <?php echo $account->getError(Constants::$emailInvalid); ?>
                            <?php echo $account->getError(Constants::$emailTaken); ?>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your Email Address" maxlength="25" value="<?php echo $userInfo['email'] ?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary col-12" name="updateInfo">Save</button>
                    </div>
    
                    
                    <div class="col-6">
                        <div class="form-group">
                            <label for="oldPw">Old Password</label>
                            <?php echo $account->getError(Constants::$passwordIncorrect); ?>
                            <input type="password" class="form-control" id="oldPw" name="oldPw" placeholder="Enter your Old Password" maxlength="25">
                        </div>

                        <div class="row">
                            <div class="col-6">
                            <div class="form-group">
                                <label for="password">New Password</label>
                                <?php echo $account->getError(Constants::$passwordsDontMatch); ?>
                                <?php echo $account->getError(Constants::$passwordLength); ?>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter New Password" maxlength="25">
                            </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="password2">Confirm Password</label>
                                    <input type="password" class="form-control" id="password2" name="password2" placeholder="Enter New Password Again" maxlength="25">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary col-12" name="updatePwd">Update</button>
                    </div>

                </div>
            </form>
        </div>
    </div>


</div>
    <?php
} else {
    //  if not logged in
    header("Location: login.php");
    print_r($_SESSION["userLoggedIn"]);
}
require_once('./includes/importsAfter.php');
    ?>