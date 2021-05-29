<?php
require_once('./includes/imports.php');
require_once('./includes/config.php');
require_once('./includes/classes/Account.php');
require_once('./includes/classes/Constants.php');
require_once('./includes/classes/FormSanitizer.php');

$account = new Account($conn);

$id = $_GET["user_id"];
$userInfo = $account->getUser($id);
require_once('./includes/components/navbar.php');

if (isset($_POST['submit'])) {
    $aadhaar_no = $_POST['aadhaarCard'] = FormSanitizer::sanitizeFormAadhaar($_POST['aadhaarCard']);
    $mobile_no = FormSanitizer::sanitizeFormContact($_POST['mobileNo']);
    $address = FormSanitizer::sanitizeFormString($_POST["address"]);
    $dob = FormSanitizer::sanitizeFormDOB($_POST["dob"]);
    $gender = "";
    $email = FormSanitizer::sanitizeFormEmail($_POST["email"]);

    print_r($_POST);
    $contacted = "";
    $severity = "";
}

$getInfo = $account->getInfo();
if (isset($_SESSION["userLoggedIn"]) && $isAdmin = $getInfo["role_name"] == 'Admin' || 'Nurse' || 'Doctor') {
?>
    <title>Patient Details</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="./includes/css/style.details.css" />
    <script src="./includes/js/multi-step.js"></script>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="
                        col-xl-5
                        text-center
                        p-0
                        mt-3
                        mb-2
                    ">
                <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                    <!--Start Patients Info-->
                    <h2 id="heading">Patient's Symptoms Information</h2>
                    <p>Fill all form field to go to next step</p>
                    <!--End Patients Info-->

                    <form id="form" method="POST">
                        <!--Start Progress bar-->
                        <div class="progress">
                            <div class="progress-bar progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <!--End Progress bar-->

                        <br />

                        <!--Aadhaar Card-->
                        <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">
                                            Aadhaar Card:
                                        </h2>
                                    </div>
                                    <div class="col-5">
                                        <h2 class="steps">Step 1 - 5</h2>
                                    </div>
                                </div>
                                <label>Enter Aadhaar Card Number:
                                </label>
                                <input type="text" data-type="aadhaar-number" name="aadhaarCard" placeholder="Aadhaar Card Number" maxlength="14" required />
                            </div>
                            <input type="button" name="next" class="next action-button" value="Next" />
                        </fieldset>
                        <!--end Aadhaar card-->

                        <!--start Personal Information-->
                        <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">
                                            Personal Information:
                                        </h2>
                                    </div>
                                    <div class="col-5">
                                        <h2 class="steps">Step 2 - 5</h2>
                                    </div>
                                </div>
                                <label>Name:</label>
                                <input type="text" name="name" placeholder="Full Name" value="<?php echo $userInfo['first_name'] . ' ' . $userInfo['last_name']; ?>" />
                                <label>Email:</label>
                                <input type="text" name="email" placeholder="Email ID" value="<?php echo $userInfo['email']; ?>" />
                                <label>Mobile No.:</label>
                                <input type="text" data-type="mobile-no" name="mobileNo" placeholder="Mobile Number" maxlength="10" />
                                <label>Address:</label>
                                <textarea name="address" rows="3" placeholder="Address"></textarea>
                                <label>Date of Birth:</label>
                                <input type="date" name="dob" placeholder="DOB" />
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
                            </div>
                            <input type="button" name="next" class="next action-button" value="Next" />
                            <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                        </fieldset>
                        <!--end Personal Information-->

                        <!--Symptoms fieldset -->
                        <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">
                                            List of Symptoms:
                                        </h2>
                                    </div>
                                    <div class="col-5">
                                        <h2 class="steps">Step 3 - 5</h2>
                                    </div>
                                </div>
                                <div class="
                                            custom-control custom-checkbox
                                            mb-3
                                        ">
                                    <input type="checkbox" class="custom-control-input" id="feverCheck" name="fever" value="1" />
                                    <label class="custom-control-label" for="feverCheck">Fever</label>
                                </div>
                                <div class="
                                            custom-control custom-checkbox
                                            mb-3
                                        ">
                                    <input type="checkbox" class="custom-control-input" id="tirednessCheck" name="tiredness" value="1" />
                                    <label class="custom-control-label" for="tirednessCheck">Tiredness</label>
                                </div>
                                <div class="
                                            custom-control custom-checkbox
                                            mb-3
                                        ">
                                    <input type="checkbox" class="custom-control-input" id="dryCoughCheck" name="dry-cough" value="1" />
                                    <label class="custom-control-label" for="dryCoughCheck">Dry Cough</label>
                                </div>
                                <div class="
                                            custom-control custom-checkbox
                                            mb-3
                                        ">
                                    <input type="checkbox" class="custom-control-input" id="difficultyBreathingCheck" name="difficulty-breathing" value="1" />
                                    <label class="custom-control-label" for="difficultyBreathingCheck">Difficulty in Breathing</label>
                                </div>
                                <div class="
                                            custom-control custom-checkbox
                                            mb-3
                                        ">
                                    <input type="checkbox" class="custom-control-input" id="soreThroatCheck" name="sore-throat" value="1" />
                                    <label class="custom-control-label" for="soreThroatCheck">Sore Throat</label>
                                </div>
                                <div class="
                                            custom-control custom-checkbox
                                            mb-3
                                        ">
                                    <input type="checkbox" class="custom-control-input" id="painsCheck" name="pains" value="1" />
                                    <label class="custom-control-label" for="painsCheck">Pains</label>
                                </div>
                                <div class="
                                            custom-control custom-checkbox
                                            mb-3
                                        ">
                                    <input type="checkbox" class="custom-control-input" id="nasalCongestionCheck" name="nasal-congestion" value="1" />
                                    <label class="custom-control-label" for="nasalCongestionCheck">Nasal Congestion</label>
                                </div>
                                <div class="
                                            custom-control custom-checkbox
                                            mb-3
                                        ">
                                    <input type="checkbox" class="custom-control-input" id="runnyNoseCheck" name="runny-nose" value="1" />
                                    <label class="custom-control-label" for="runnyNoseCheck">Runny Nose</label>
                                </div>
                                <div class="
                                            custom-control custom-checkbox
                                            mb-3
                                        ">
                                    <input type="checkbox" class="custom-control-input" id="diarrheaCheck" name="diarrhea" value="1" />
                                    <label class="custom-control-label" for="diarrheaCheck">Diarrhea</label>
                                </div>
                                <div class="
                                            custom-control custom-checkbox
                                            mb-3
                                        ">
                                    <input type="checkbox" class="custom-control-input" id="noneExperiencingCheck" name="none-experiencing" value="1" />
                                    <label class="custom-control-label" for="noneExperiencingCheck">None Experiencing</label>
                                </div>
                                <div class="
                                            custom-control custom-checkbox
                                            mb-3
                                        ">
                                    <input type="checkbox" class="custom-control-input" id="noneSymptomCheck" name="none-symptom" value="1" />
                                    <label class="custom-control-label" for="noneSymptomCheck">None Symptom</label>
                                </div>
                            </div>

                            <input type="button" name="next" class="next action-button" value="Next" />
                            <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                        </fieldset>
                        <!--end Symptoms fieldset -->

                        <!--start Contact-->
                        <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">
                                            Severity & Contact:
                                        </h2>
                                    </div>
                                    <div class="col-5">
                                        <h2 class="steps">Step 4 - 5</h2>
                                    </div>
                                </div>
                                <label>Severity of your selected
                                    Symptoms:</label>
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="mildCheck" name="severity" value="Mild" />
                                    <label class="custom-control-label" for="mildCheck">Mild</label>
                                </div>

                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="moderateCheck" name="severity" value="Moderate" />
                                    <label class="custom-control-label" for="moderateCheck">Moderate</label>
                                </div>

                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="severeCheck" name="severity" value="Sever" />
                                    <label class="custom-control-label" for="severeCheck">Severe</label>
                                </div>

                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="noneCheck" name="severity" value="None" />
                                    <label class="custom-control-label" for="noneCheck">None</label>
                                </div>

                                <label>Got in contact with someone tested
                                    positive</label>
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="yesCheck" name="contact" value="Yes" />
                                    <label class="custom-control-label" for="yesCheck">Yes</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="noCheck" name="contact" value="No" />
                                    <label class="custom-control-label" for="noCheck">No</label>
                                </div>

                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="dontKnowCheck" name="contact" value="Don't Know" />
                                    <label class="custom-control-label" for="dontKnowCheck">Don't Know</label>
                                </div>
                            </div>
                            <input type="submit" name="submit" class="next action-button" value="Submit" />
                            <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                        </fieldset>
                        <!--end Contact-->

                        <!--finish-->
                        <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">Finish:</h2>
                                    </div>
                                    <div class="col-5">
                                        <h2 class="steps">Step 5 - 5</h2>
                                    </div>
                                </div>
                                <br /><br />
                                <br /><br />
                                <div class="row justify-content-center">
                                    <div class="col-7 text-center">
                                        <h6 class="green-text text-center">
                                            You Have Successfully Submitted
                                            the form!!
                                        </h6>

                                        <?php print_r($_POST); ?>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <!--end finish-->
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
} else {
    //  if not logged in
    header("Location: login.php");
}
require_once('./includes/importsAfter.php');
?>