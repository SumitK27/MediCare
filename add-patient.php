<title>Add Patients</title>
<?php
require_once('./includes/imports.php');
require_once('./includes/config.php');
require_once('./includes/classes/Account.php');
require_once('./includes/classes/Constants.php');
require_once('./includes/classes/FormSanitizer.php');

$account = new Account($conn);
$getInfo = $account->getInfo();
$userInfo = $getInfo;
require_once('./includes/components/navbar.php');

if (isset($_POST["submit"])) {
    $firstName = FormSanitizer::sanitizeFormString($_POST["firstName"]);
    $lastName = FormSanitizer::sanitizeFormString($_POST["lastName"]);
    $email = FormSanitizer::sanitizeFormEmail($_POST["email"]);

    $success = $account->addUser($firstName, $lastName, $email, $userInfo['user_id'], 1);

    if ($success) {
        echo "<div class='alert alert-success'>User Added Successfully</div>";
    }
}
function getInputValue($name)
{
    if (isset($_POST[$name])) {
        echo $_POST[$name];
    }
}
if (isset($_SESSION["userLoggedIn"]) && $isAdmin = $getInfo["role_name"] == "Nurse") {
?>

    <div class="container">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h2 class="center">Add a Patient</h2>
                    </div>
                    <div class="card-body">
                    <form action="" method="post" class="form-group">
                <?php echo $account->getError(Constants::$nameCharacters); ?>
                    <input type="text" name="firstName" placeholder="Enter First Name" class="form-control" value="<?php getInputValue("firstName") ?>" maxlength="25" required>
                    <?php echo $account->getError(Constants::$nameCharacters); ?>
                    <input type="text" name="lastName" placeholder="Enter Last Name" class="form-control" value="<?php getInputValue("lastName") ?>" maxlength="25" required>
                    <?php echo $account->getError(Constants::$aadhaarInvalid); ?>
                    <?php echo $account->getError(Constants::$aadhaarTaken); ?>
                    <input type="email" name="email" placeholder="Enter Email ID" class="form-control" value="<?php getInputValue("email") ?>" maxlength="25" required>
                    <!-- Submit button -->
                    <button class="btn btn-info my-4 btn-block" type="submit" name="submit">submit</button>
                </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
} else {
    header("location:index.php");
}
require_once('./includes/importsAfter.php');
?>