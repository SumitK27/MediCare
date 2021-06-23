<title>Register</title>
<?php
require_once('./includes/imports.php');
require_once('./includes/components/navbar.php');
require_once('./includes/config.php');
require_once('./includes/classes/FormSanitizer.php');
require_once('./includes/classes/Account.php');
require_once('./includes/classes/Constants.php');

$account = new Account($conn);

if (isset($_POST["submit"])) {
    $firstName = FormSanitizer::sanitizeFormString($_POST["firstName"]);
    $lastName = FormSanitizer::sanitizeFormString($_POST["lastName"]);
    $email = FormSanitizer::sanitizeFormEmail($_POST["email"]);
    $adh = FormSanitizer::sanitizeFormAadhaar($_POST["aadhaar-id"]);
    $mob = FormSanitizer::sanitizeFormContact($_POST["mob-no"]);
    $password = FormSanitizer::sanitizeFormPassword($_POST["password"]);
    $password2 = FormSanitizer::sanitizeFormPassword($_POST["password2"]);
    $addr = $_POST["address"];
    $dob = $_POST["dob"];
    $gen = $_POST["gender"];

    $success = $account->register($firstName, $lastName, $email, $password, $password2, $adh, $mob, $addr, $dob, $gen, 4);

    if ($success) {
        header("Location: login.php");
    }
}
function getInputValue($name)
{
    if (isset($_POST[$name])) {
        echo $_POST[$name];
    }
}
?>
<div class="container">
    <div class="text-center mt-5">
        <h1>Add Your Details</h1>
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
                                    <?php echo $account->getError(Constants::$emailInvalid); ?>
                                    <?php echo $account->getError(Constants::$emailTaken); ?>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
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

                                <!-- Password + Confirm Password -->
                                <div class="row">
                                    <?php echo $account->getError(Constants::$passwordsDontMatch); ?>
                                    <?php echo $account->getError(Constants::$passwordLength); ?>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password">Enter your password</label>
                                            <input type="password" id="password" name="password" class="form-control mb-4" placeholder="Password" aria-describedby="password" maxlength="25" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password2">Re-enter your password</label>
                                            <input type="password" id="password2" name="password2" class="form-control mb-4" placeholder="Re-enter Your Password" aria-describedby="password2" maxlength="25" required>
                                        </div>
                                    </div>
                                </div>
                                <!-- End of Password + Confirm Password-->

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
                                                            " value="Submit" />
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
require_once('./includes/importsAfter.php');
?>