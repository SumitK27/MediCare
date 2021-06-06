<?php
require_once('./includes/imports.php');
require_once('./includes/config.php');
require_once('./includes/classes/Account.php');

$account = new Account($conn);

$id = $_GET["user_id"];
$userInfo = $account->getUser($id);
require_once('./includes/components/navbar.php');

if (isset($_POST['submit'])) {
    $fever = yesOrNo($_POST['fever']);
    $fever_s = $_POST['fever_s'];

    $cough = yesOrNo($_POST['cough']);
    $cough_s = $_POST['cough_s'];

    $tiredness = yesOrNo($_POST['tiredness']);
    $tiredness_s = $_POST['tiredness_s'];

    $chest_pain = yesOrNo($_POST['chest_pain']);
    $chest_pain_s = $_POST['chest_pain_s'];

    $head_ache = yesOrNo($_POST['head_ache']);
    $head_ache_s = $_POST['head_ache_s'];

    $stomach_ache = yesOrNo($_POST['stomach_ache']);
    $stomach_ache_s = $_POST['stomach_ache_s'];

    $kidney_failure = yesOrNo($_POST['kidney_failure']);

    $heart_problem = yesOrNo($_POST['heart_problem']);
    $heart_problem_s = $_POST['heart_problem_s'];

    $diabetes = yesOrNo($_POST['diabetes']);
    $diabetes_s = $_POST['diabetes_s'];

    $less_oxygen_level = yesOrNo($_POST['less_oxygen_level']);
    $less_oxygen_level_s = $_POST['less_oxygen_level_s'];

    $malignancy_cancer = yesOrNo($_POST['malignancy_cancer']);
    $malignancy_cancer_s = $_POST['malignancy_cancer_s'];

    $hypertension = yesOrNo($_POST['hypertension']);
    $hypertension_s = $_POST['hypertension_s'];

    $liver_disease = yesOrNo($_POST['liver_disease']);
    $liver_disease_s = $_POST['liver_disease_s'];

    $immunocompromised_condition = yesOrNo($_POST['immunocompromised_condition']);
    $immunocompromised_condition_s = $_POST['immunocompromised_condition_s'];

    $vomiting = yesOrNo($_POST['vomiting']);
    $vomiting_s = $_POST['vomiting_s'];

    $consume_steroids = yesOrNo($_POST['consume_steroids']);
    $consume_steroids_s = $_POST['consume_steroids_s'];

    $sore_throat = yesOrNo($_POST['sore_throat']);
    $sore_throat_s = $_POST['sore_throat_s'];

    $diarrhea = yesOrNo($_POST['diarrhea']);
    $diarrhea_s = $_POST['diarrhea_s'];

    $congestion = yesOrNo($_POST['congestion']);
    $congestion_s = $_POST['congestion_s'];

    $sense_loss = yesOrNo($_POST['sense_loss']);
    $sense_loss_s = $_POST['sense_loss_s'];

    $skin_rash_discoloration = yesOrNo($_POST['skin_rash_discoloration']);
    $skin_rash_discoloration_s = $_POST['skin_rash_discoloration_s'];

    $trouble_breathing = yesOrNo($_POST['trouble_breathing']);
    $trouble_breathing_s = $_POST['trouble_breathing_s'];

    $contact_positive = yesOrNo($_POST['contact_positive']);
    $contact_positive_s = $_POST['contact_positive_s'];

    $is_positive = yesOrNo($_POST['is_positive']);
    $is_positive_s = $_POST['is_positive_s'];

    $is_vaccinated = yesOrNo($_POST['is_vaccinated']);
    $is_vaccinated_d = $_POST['is_vaccinated_d'];

    $is_vaccinated_2 = yesOrNo($_POST['is_vaccinated_2']);
    $is_vaccinated_2_d = $_POST['is_vaccinated_2_d'];

    $travelled = yesOrNo($_POST['travelled']);

    $chills = yesOrNo($_POST['chills']);
    $chills_s = $_POST['chills_s'];

    $quarantine = yesOrNo($_POST['quarantine']);

    $success = $account->addMedicalRecords($id, $fever, $fever_s, $cough, $cough_s, $tiredness, $tiredness_s, $chest_pain, $chest_pain_s, $head_ache, $head_ache_s, $stomach_ache, $stomach_ache_s, $kidney_failure, $heart_problem, $heart_problem_s, $diabetes, $diabetes_s, $less_oxygen_level, $less_oxygen_level_s, $malignancy_cancer, $malignancy_cancer_s, $hypertension, $hypertension_s, $liver_disease, $liver_disease_s, $immunocompromised_condition, $immunocompromised_condition_s, $vomiting, $vomiting_s, $consume_steroids, $sore_throat, $sore_throat_s, $diarrhea, $diarrhea_s, $congestion, $congestion_s, $sense_loss, $sense_loss_s, $skin_rash_discoloration, $skin_rash_discoloration_s, $trouble_breathing, $trouble_breathing_s, $contact_positive, $is_positive, $is_vaccinated, $is_vaccinated_d, $is_vaccinated_2, $is_vaccinated_2_d, $travelled, $chills, $chills_s, $quarantine);
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

    <script src="./includes/js/symptoms.js"></script>

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
                            <div class="form-card symptoms-1">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">
                                            Symptoms:
                                        </h2>
                                    </div>
                                    <div class="col-5">
                                        <h2 class="steps">Step 1 - 3</h2>
                                    </div>
                                </div>
                            </div>
                            <input type="button" name="next" class="next action-button" value="Next" />
                        </fieldset>
                        <!--end Symptoms fieldset -->
                        <!--Symptoms fieldset -->
                        <fieldset>
                            <div class="form-card symptoms-2">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">
                                            Other Diseases:
                                        </h2>
                                    </div>
                                    <div class="col-5">
                                        <h2 class="steps">Step 2 - 3</h2>
                                    </div>
                                </div>
                            </div>
                            <input type="button" name="next" class="next action-button" value="Next" />
                            <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                        </fieldset>
                        <!--end Symptoms fieldset -->
                        <!--Symptoms fieldset -->
                        <fieldset>
                            <div class="form-card symptoms-3">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">
                                            Contact & Vaccine:
                                        </h2>
                                    </div>
                                    <div class="col-5">
                                        <h2 class="steps">Step 3 - 3</h2>
                                    </div>
                                </div>
                            </div>
                            <input type="submit" name="submit" class="next action-button" value="Submit" />
                            <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                        </fieldset>
                        <!--end Symptoms fieldset -->
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
} else {
    //  if not logged in
    header("Location: ./login.php");
}
require_once('./includes/importsAfter.php');
?>