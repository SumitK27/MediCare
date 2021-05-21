<title>Add Patients</title>
<?php
require_once('./includes/imports.php');
require_once('./includes/config.php');
require_once('./includes/classes/Account.php');
require_once('./includes/classes/Constants.php');
require_once('./includes/classes/FormSanitizer.php');

require_once('./includes/components/navbar.php');
$account = new Account($conn);
$getInfo = $account->getInfo();

if (isset($_POST["submit"])) {
    $firstName = FormSanitizer::sanitizeFormString($_POST["firstName"]);
    $lastName = FormSanitizer::sanitizeFormString($_POST["lastName"]);
    $email = FormSanitizer::sanitizeFormEmail($_POST["email"]);

    $success = $account->addUser($firstName, $lastName, $email, 1);

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
                <form action="" method="post" class="form-group">
                    <?php echo $account->getError(Constants::$nameCharacters); ?>
                    <input type="text" name="firstName" placeholder="Enter First Name" class="form-control">
                    <?php echo $account->getError(Constants::$nameCharacters); ?>
                    <input type="text" name="lastName" placeholder="Enter Last Name" class="form-control">
                    <?php echo $account->getError(Constants::$emailInvalid); ?>
                    <?php echo $account->getError(Constants::$emailTaken); ?>
                    <input type="email" name="email" placeholder="Enter Email ID" class="form-control">
                    <!-- Submit button -->
                    <button class="btn btn-info my-4 btn-block" type="submit" name="submit">submit</button>
                </form>
            </div>
        </div>
    </div>

<?php
} else {
?>
    <h1>You are Not allowed to access this Page</h1>
<?php
}
?>