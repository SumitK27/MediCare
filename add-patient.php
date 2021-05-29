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

    $adh = $mob = $addr = $dob = $gen = "";

    $success = $account->addUser($firstName, $lastName, $email, $adh, $mob, $addr, $dob, $gen, $userInfo['user_id'], 1);

    if ($success) {
        echo "<div class='alert alert-success'>Patient Added Successfully</div>";
    }
}
function getInputValue($name)
{
    if (isset($_POST[$name])) {
        echo $_POST[$name];
    }
}
if (isset($_SESSION["userLoggedIn"]) && $isAdmin = $getInfo["role_name"] == "Nurse" || "Doctor") {
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
                            <!-- First Name -->
                            <label>First Name:</label>
                            <?php echo $account->getError(Constants::$nameCharacters); ?>
                            <input type="text" name="firstName" placeholder="Enter First Name" class="form-control" value="<?php getInputValue("firstName") ?>" maxlength="25" required>

                            <!-- Last Name -->
                            <label>Last Name:</label>
                            <?php echo $account->getError(Constants::$nameCharacters); ?>
                            <input type="text" name="lastName" placeholder="Enter Last Name" class="form-control" value="<?php getInputValue("lastName") ?>" maxlength="25" required>

                            <!-- Email -->
                            <label>Email ID:</label>
                            <?php echo $account->getError(Constants::$emailInvalid); ?>
                            <?php echo $account->getError(Constants::$emailTaken); ?>
                            <input type="email" name="email" placeholder="Enter Email ID" class="form-control" value="<?php getInputValue("email") ?>" maxlength="25" required>

                            <!-- Aadhaar Card -->
                            <label>Aadhaar No.:</label>
                            <?php echo $account->getError(Constants::$aadhaarInvalid); ?>
                            <?php echo $account->getError(Constants::$aadhaarTaken); ?>
                            <input type="text" name="aadhaar-id" placeholder="Enter Aadhaar ID" class="form-control" value="<?php getInputValue("email") ?>" maxlength="25" required>

                            <!-- Mobile No -->
                            <label>Mobile No.:</label>
                            <?php echo $account->getError(Constants::$contactInvalid); ?>
                            <input type="tel" name="mob-no" placeholder="Enter Mobile No." class="form-control" value="<?php getInputValue("email") ?>" maxlength="25" required>

                            <!-- Address -->
                            <label>Address:</label>
                            <?php echo $account->getError(Constants::$aadhaarInvalid); ?>
                            <?php echo $account->getError(Constants::$aadhaarTaken); ?>
                            <input type="email" name="email" placeholder="Enter Email ID" class="form-control" value="<?php getInputValue("email") ?>" maxlength="25" required>

                            <!-- Date of Birth -->
                            <label>Date of Birth:</label>
                            <input type="date" name="dob" class="form-control" />

                            <!-- Gender -->
                            <label>Gender:</label>
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="maleCheck" name="gender" value="Male" />
                                <label class="custom-control-label" for="maleCheck">Male</label>
                            </div>

                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="femaleCheck" name="gender" value="Female" />
                                <label class="custom-control-label" for="femaleCheck">Female</label>
                            </div>

                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="transgenderCheck" name="gender" value="Transgender" />
                                <label class="custom-control-label" for="transgenderCheck">Transgender</label>
                            </div>

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