<title>Add Nurse Details</title>
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
    $adh = FormSanitizer::sanitizeFormAadhaar($_POST["aadhaar-id"]);
    $mob = FormSanitizer::sanitizeFormContact($_POST["mob-no"]);
    $addr = $_POST["address"];
    $dob = $_POST["dob"];
    $gen = $_POST["gender"];

    $success = $account->addUser($firstName, $lastName, $email, $adh, $mob, $addr, $dob, $gen, $userInfo['user_id'], 2);

    if ($success) {
        echo "<div class='alert alert-success'>Patient Added Successfully</div>";
        header("location:dashboard.php", true, 303);
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
        <div class="text-center mt-5">
            <h1>Add Nurse Details</h1>
        </div>

        <div class="row">
            <div class="col-lg-7 mx-auto">
                <div class="card mt-2 mx-auto p-4 bg-light">
                    <div class="card-body bg-light">
                        <div class="container">
                            <form id="contact-form" role="form" method="POST">
                                <div class="controls">
                                    <!-- Name row -->
                                    <div class="row">
                                        <?php echo $account->getError(Constants::$nameCharacters); ?>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="form_name">First Name</label>
                                                <input type="text" id="firstName" name="firstName" class="form-control" placeholder="Enter Your
                                                    First Name" required data-error="First name is
                                                    required." value="<?php getInputValue("firstName") ?>" maxlength="25">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="lastName">Last Name</label>
                                                <input type="text" name="lastName" class="form-control" placeholder="Enter Your Last Name" required data-error="Last name is required." value="<?php getInputValue("lastName") ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End of Name row -->

                                    <!-- Email + Mobile No -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <?php echo $account->getError(Constants::$emailInvalid); ?>
                                                <?php echo $account->getError(Constants::$emailTaken); ?>
                                                <label for="email">Email</label>
                                                <input id="email" type="email" name="email" class="form-control" placeholder="Enter your email" value="<?php getInputValue("email") ?>" required />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Mobile No.:</label>
                                                <?php echo $account->getError(Constants::$contactInvalid); ?>
                                                <input type="tel" name="mob-no" placeholder="Enter Mobile No." class="form-control" value="<?php getInputValue("mob-no") ?>" maxlength="10" required />
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End of Email + Mobile No-->

                                    <!-- DOB + Aadhaar No-->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Aadhaar No.:</label>
                                                <?php echo $account->getError(Constants::$aadhaarInvalid); ?>
                                                <?php echo $account->getError(Constants::$aadhaarTaken); ?>
                                                <input type="text" name="aadhaar-id" placeholder="Enter Aadhaar ID" class="form-control" value="<?php getInputValue("aadhaar-id") ?>" maxlength="12" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Date of Birth:</label>
                                                <input type="date" name="dob" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End of DOB + Aadhaar No -->

                                    <!-- Address -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <?php echo $account->getError(Constants::$addressInvalid); ?>
                                                <label for="address">Address</label>
                                                <textarea id="address" name="address" class="form-control" placeholder="Write your Address here." rows="3" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End of Address -->

                                    <!-- Gender -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="form_gender">Gender</label>
                                                <div class="
                                                            custom-control
                                                            custom-radio
                                                        ">
                                                    <input type="radio" class="
                                                                custom-control-input
                                                            " id="maleCheck" name="gender" value="Male" />
                                                    <label class="
                                                                custom-control-label
                                                            " for="maleCheck">Male</label>
                                                </div>

                                                <div class="
                                                            custom-control
                                                            custom-radio
                                                        ">
                                                    <input type="radio" class="
                                                                custom-control-input
                                                            " id="femaleCheck" name="gender" value="Female" />
                                                    <label class="
                                                                custom-control-label
                                                            " for="femaleCheck">Female</label>
                                                </div>

                                                <div class="
                                                            custom-control
                                                            custom-radio
                                                        ">
                                                    <input type="radio" class="
                                                                custom-control-input
                                                            " id="transgenderCheck" name="gender" value="Transgender" />
                                                    <label class="
                                                                custom-control-label
                                                            " for="transgenderCheck">Transgender</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <input type="submit" name="submit" class="
                                                                btn
                                                                btn-success
                                                                pt-2
                                                                btn-block
                                                            " value="Add Nurse" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End of Gender -->
                                </div>
                            </form>
                        </div>
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