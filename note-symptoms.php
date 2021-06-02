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
    $fever = yesOrNo($_POST['fever']);
    $breath = yesOrNo($_POST['difficultyBreathing']);
    $cough = yesOrNo($_POST['dryCough']);
    $nose = yesOrNo($_POST['nasalCongestion']);
    $sense = yesOrNo($_POST['lostSense']);
    $throat = yesOrNo($_POST['soreThroat']);
    $cont_pos = yesOrNo($_POST['gotInContact']);
    $pos = yesOrNo($_POST['isPositive']);
    $travelled = yesOrNo($_POST['travelled']);
    $tiredness = yesOrNo($_POST['tiredness']);
    $diarrhea = yesOrNo($_POST['diarrhea']);
    $chills = yesOrNo($_POST['chills']);
    $quarantine = yesOrNo($_POST['quarantine']);
    $severity = $_POST['severity'];

    $success = $account->addMedicalRecords($id, $fever, $breath, $cough, $nose, $sense, $throat, $cont_pos, $pos, $travelled, $tiredness, $diarrhea, $chills, $quarantine);
}

function yesOrNo($value)
{
    if ($value == "Yes") {
        return TRUE;
    }
    return FALSE;
}

$getInfo = $account->getInfo();
if (isset($_SESSION["userLoggedIn"]) && $getInfo["role_name"] == 'Admin' || 'Nurse' || 'Doctor' || 'Patient') {
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
                                        <h2 class="steps">Step 1 - 2</h2>
                                    </div>
                                </div>
                                <!--fever row-->
                                <div>
                                    <label class="col-md-6 radioLabel">Fever:</label>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" value="Yes" id="feverYes" name="fever">
                                        <label class="custom-control-label" for="feverYes">Yes</label>
                                    </div>

                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" value="No" checked id="feverNo" name="fever">
                                        <label class="custom-control-label" for="feverNo">No</label>
                                    </div>
                                </div>
                                <!--End fever row-->

                                <!--Difficulty in Breathing row-->
                                <div>
                                    <label class="col-md-6 radioLabel">Difficulty in Breathing:</label>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" value="Yes" id="difficultyBreathingYes" name="difficultyBreathing">
                                        <label class="custom-control-label" for="difficultyBreathingYes">Yes</label>
                                    </div>

                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" value="No" checked id="difficultyBreathingNo" name="difficultyBreathing">
                                        <label class="custom-control-label" for="difficultyBreathingNo">No</label>
                                    </div>
                                </div>
                                <!--End Difficulty in Breathing row-->

                                <!--Dry Cough row-->
                                <div>
                                    <label class="col-md-6 radioLabel">Dry Cough:</label>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" value="Yes" id="dryCoughYes" name="dryCough">
                                        <label class="custom-control-label" for="dryCoughYes">Yes</label>
                                    </div>

                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" value="No" checked id="dryCoughNo" name="dryCough">
                                        <label class="custom-control-label" for="dryCoughNo">No</label>
                                    </div>
                                </div>
                                <!--End Dry Cough row-->

                                <!--Nasal Congestion/Running row-->
                                <div>
                                    <label class="col-md-6 radioLabel">Nasal Congestion/Running:</label>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" value="Yes" id="nasalCongestionYes" name="nasalCongestion">
                                        <label class="custom-control-label" for="nasalCongestionYes">Yes</label>
                                    </div>

                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" value="No" checked id="nasalCongestionNo" name="nasalCongestion">
                                        <label class="custom-control-label" for="nasalCongestionNo">No</label>
                                    </div>
                                </div>
                                <!--End Nasal Congestion row-->

                                <!--Lost Sense row-->
                                <div>
                                    <label class="col-md-6 radioLabel">Lost Sense:</label>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" value="Yes" id="lostSenseYes" name="lostSense">
                                        <label class="custom-control-label" for="lostSenseYes">Yes</label>
                                    </div>

                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" value="No" checked id="lostSenseNo" name="lostSense">
                                        <label class="custom-control-label" for="lostSenseNo">No</label>
                                    </div>
                                </div>
                                <!--End Lost Sense row-->

                                <!--Sore Throat row-->
                                <div>
                                    <label class="col-md-6 radioLabel">Sore Throat:</label>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" value="Yes" id="soreThroatYes" name="soreThroat">
                                        <label class="custom-control-label" for="soreThroatYes">Yes</label>
                                    </div>

                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" value="No" checked id="soreThroatNo" name="soreThroat">
                                        <label class="custom-control-label" for="soreThroatNo">No</label>
                                    </div>
                                </div>
                                <!--End Sore Throat row-->

                                <!--Is Positive row-->
                                <div>
                                    <label class="col-md-6 radioLabel">Are you tested as Positive:</label>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" value="Yes" id="isPositiveYes" name="isPositive">
                                        <label class="custom-control-label" for="isPositiveYes">Yes</label>
                                    </div>

                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" value="No" checked id="isPositiveNo" name="isPositive">
                                        <label class="custom-control-label" for="isPositiveNo">No</label>
                                    </div>
                                </div>
                                <!--End Is Positive row-->

                                <!--Travelled row-->
                                <div>
                                    <label class="col-md-6 radioLabel">Travelled:</label>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" value="Yes" id="travelledYes" name="travelled">
                                        <label class="custom-control-label" for="travelledYes">Yes</label>
                                    </div>

                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" value="No" checked id="travelledNo" name="travelled">
                                        <label class="custom-control-label" for="travelledNo">No</label>
                                    </div>
                                </div>
                                <!--End Travelled row-->

                                <!--Tiredness row-->
                                <div>
                                    <label class="col-md-6 radioLabel">Tiredness:</label>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" value="Yes" id="tirednessYes" name="tiredness">
                                        <label class="custom-control-label" for="tirednessYes">Yes</label>
                                    </div>

                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" value="No" checked id="tirednessNo" name="tiredness">
                                        <label class="custom-control-label" for="tirednessNo">No</label>
                                    </div>
                                </div>
                                <!--End Tiredness row-->

                                <!--Diarrhea row-->
                                <div>
                                    <label class="col-md-6 radioLabel">Diarrhea:</label>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" value="Yes" id="diarrheaYes" name="diarrhea">
                                        <label class="custom-control-label" for="diarrheaYes">Yes</label>
                                    </div>

                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" value="No" checked id="diarrheaNo" name="diarrhea">
                                        <label class="custom-control-label" for="diarrheaNo">No</label>
                                    </div>
                                </div>
                                <!--End Diarrhea row-->

                                <!--Chills row-->
                                <div>
                                    <label class="col-md-6 radioLabel">Chills:</label>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" value="Yes" id="chillsYes" name="chills">
                                        <label class="custom-control-label" for="chillsYes">Yes</label>
                                    </div>

                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" value="No" checked id="chillsNo" name="chills">
                                        <label class="custom-control-label" for="chillsNo">No</label>
                                    </div>
                                </div>
                                <!--End Chills row-->

                                <!--Quarantine row-->
                                <div>
                                    <label class="col-md-6 radioLabel">Told to be Quarantine:</label>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" value="Yes" id="quarantineYes" name="quarantine">
                                        <label class="custom-control-label" for="quarantineYes">Yes</label>
                                    </div>

                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" value="No" checked id="quarantineNo" name="quarantine">
                                        <label class="custom-control-label" for="quarantineNo">No</label>
                                    </div>
                                </div>
                                <!--End Quarantine row-->
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
                                        <h2 class="steps">Step 2 - 2</h2>
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
                                    <input type="radio" class="custom-control-input" id="yesCheck" name="gotInContact" value="Yes" />
                                    <label class="custom-control-label" for="yesCheck">Yes</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="noCheck" name="gotInContact" value="No" checked />
                                    <label class="custom-control-label" for="noCheck">No</label>
                                </div>

                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="dontKnowCheck" name="gotInContact" value="No" />
                                    <label class="custom-control-label" for="dontKnowCheck">Don't Know</label>
                                </div>
                            </div>
                            <input type="submit" name="submit" class="next action-button" value="Submit" />
                            <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                        </fieldset>
                        <!--end Contact-->
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