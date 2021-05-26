<title>Patient Details</title>
<link rel="stylesheet" href="./includes/css/style.details.css" />
<script src="./includes//js/multi-step.js"></script>
<?php
    require_once('./includes/imports.php');
    require_once('./includes/config.php');
    require_once('./includes/classes/Account.php');
    require_once('./includes/classes/Constants.php');
    
    $account = new Account($conn);
    
    $id = $_GET["user_id"];
    $userInfo = $account->getUser($id);
    require_once('./includes/components/navbar.php');

    $getInfo = $account->getInfo();
	if (isset($_SESSION["userLoggedIn"]) && $isAdmin = $getInfo["role_name"] == 'Admin' || 'Nurse' || 'Doctor') {
        // echo $_SESSION["userLoggedIn"];
?>
    <div class="container-fluid">
            <div class="row justify-content-center">
                <div
                    class="
                        col-11 col-sm-9 col-md-7 col-lg-6 col-xl-5
                        text-center
                        p-0
                        mt-3
                        mb-2
                    "
                >
                    <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                        <!--Start Patients Info-->
                        <h2 id="heading">Patient's Symptoms Information</h2>
                        <p>Fill all form field to go to next step</p>
                        <!--End Patients Info-->

                        <form id="msform" action="" method="post">
                            <!--Start Progress bar-->
                            <div class="progress">
                                <div
                                    class="progress-bar progress-bar-animated"
                                    role="progressbar"
                                    aria-valuemin="0"
                                    aria-valuemax="100"
                                ></div>
                            </div>
                            <!--End Progress bar-->

                            <br />

                            <!--Aadhar Card-->
                            <fieldset>
                                <div class="form-card">
                                    <div class="row">
                                        <div class="col-7">
                                            <h2 class="fs-title">
                                                Aadhar Card:
                                            </h2>
                                        </div>
                                        <div class="col-5">
                                            <h2 class="steps">Step 1 - 5</h2>
                                        </div>
                                    </div>
                                    <label class="fieldlabels"
                                        >Enter Aadhar Card Number:
                                    </label>
                                    <input
                                        type="text"
                                        data-type="adhaar-number"
                                        name="adharcard"
                                        placeholder="Aadhar Card Number"
                                        maxlength="12"
                                        required
                                    />
                                </div>
                                <input
                                    type="button"
                                    name="next"
                                    class="next action-button"
                                    value="Next"
                                />
                            </fieldset>
                            <!--end Aadhar card-->

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
                                    <label class="fieldlabels">Name:</label>
                                    <input
                                        type="text"
                                        name="name"
                                        placeholder="Full Name"
                                        value="<?php echo $userInfo['first_name'] . ' ' . $userInfo['last_name']; ?>"
                                    />
                                    <label class="fieldlabels">Email:</label>
                                    <input
                                        type="text"
                                        name="email"
                                        placeholder="Email ID"
                                    />
                                    <label class="fieldlabels"
                                        >Mobile No.:
                                    </label>
                                    <input
                                        type="text"
                                        data-type="mobile-no"
                                        name="mobileno"
                                        placeholder="Mobile Number"
                                        maxlength="10"
                                    />
                                    <label class="fieldlabels">Address:</label>
                                    <textarea
                                        name="address"
                                        rows="3"
                                        placeholder="Address"
                                    ></textarea>
                                    <label class="fieldlabels"
                                        >Date of Birth:</label
                                    >
                                    <input
                                        type="date"
                                        name="birthday"
                                        placeholder="DOB"
                                    />
                                    <label class="fieldlabels">Gender:</label>
                                    <div class="custom-control custom-radio">
                                        <input
                                            type="radio"
                                            class="custom-control-input"
                                            id="maleCheck"
                                            name="gender"
                                        />
                                        <label
                                            class="custom-control-label"
                                            for="maleCheck"
                                            >Male</label
                                        >
                                    </div>

                                    <div class="custom-control custom-radio">
                                        <input
                                            type="radio"
                                            class="custom-control-input"
                                            id="femaleCheck"
                                            name="gender"
                                        />
                                        <label
                                            class="custom-control-label"
                                            for="femaleCheck"
                                            >Female</label
                                        >
                                    </div>

                                    <div class="custom-control custom-radio">
                                        <input
                                            type="radio"
                                            class="custom-control-input"
                                            id="transgenderCheck"
                                            name="gender"
                                        />
                                        <label
                                            class="custom-control-label"
                                            for="transgenderCheck"
                                            >Transgender</label
                                        >
                                    </div>
                                </div>
                                <input
                                    type="button"
                                    name="next"
                                    class="next action-button"
                                    value="Next"
                                />
                                <input
                                    type="button"
                                    name="previous"
                                    class="previous action-button-previous"
                                    value="Previous"
                                />
                            </fieldset>
                            <!--end Personal Information-->

                            <!--Symptoms fieldsets -->
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
                                    <div
                                        class="
                                            custom-control custom-checkbox
                                            mb-3
                                        "
                                    >
                                        <input
                                            type="checkbox"
                                            class="custom-control-input"
                                            id="feverCheck"
                                            name="fever"
                                        />
                                        <label
                                            class="custom-control-label"
                                            for="feverCheck"
                                            >Fever</label
                                        >
                                    </div>
                                    <div
                                        class="
                                            custom-control custom-checkbox
                                            mb-3
                                        "
                                    >
                                        <input
                                            type="checkbox"
                                            class="custom-control-input"
                                            id="tirednessCheck"
                                            name="tiredness"
                                        />
                                        <label
                                            class="custom-control-label"
                                            for="tirednessCheck"
                                            >Tiredness</label
                                        >
                                    </div>
                                    <div
                                        class="
                                            custom-control custom-checkbox
                                            mb-3
                                        "
                                    >
                                        <input
                                            type="checkbox"
                                            class="custom-control-input"
                                            id="dryCoughCheck"
                                            name="dry-cough"
                                        />
                                        <label
                                            class="custom-control-label"
                                            for="dryCoughCheck"
                                            >Dry Cough</label
                                        >
                                    </div>
                                    <div
                                        class="
                                            custom-control custom-checkbox
                                            mb-3
                                        "
                                    >
                                        <input
                                            type="checkbox"
                                            class="custom-control-input"
                                            id="difficultyBreathingCheck"
                                            name="difficulty-breathing"
                                        />
                                        <label
                                            class="custom-control-label"
                                            for="difficultyBreathingCheck"
                                            >Difficulty in Breathing</label
                                        >
                                    </div>
                                    <div
                                        class="
                                            custom-control custom-checkbox
                                            mb-3
                                        "
                                    >
                                        <input
                                            type="checkbox"
                                            class="custom-control-input"
                                            id="soreThroatCheck"
                                            name="sore-throat"
                                        />
                                        <label
                                            class="custom-control-label"
                                            for="soreThroatCheck"
                                            >Sore Throat</label
                                        >
                                    </div>
                                    <div
                                        class="
                                            custom-control custom-checkbox
                                            mb-3
                                        "
                                    >
                                        <input
                                            type="checkbox"
                                            class="custom-control-input"
                                            id="painsCheck"
                                            name="pains"
                                        />
                                        <label
                                            class="custom-control-label"
                                            for="painsCheck"
                                            >Pains</label
                                        >
                                    </div>
                                    <div
                                        class="
                                            custom-control custom-checkbox
                                            mb-3
                                        "
                                    >
                                        <input
                                            type="checkbox"
                                            class="custom-control-input"
                                            id="nasalCongestionCheck"
                                            name="nasal-congestion"
                                        />
                                        <label
                                            class="custom-control-label"
                                            for="nasalCongestionCheck"
                                            >Nasal Congestion</label
                                        >
                                    </div>
                                    <div
                                        class="
                                            custom-control custom-checkbox
                                            mb-3
                                        "
                                    >
                                        <input
                                            type="checkbox"
                                            class="custom-control-input"
                                            id="runnyNoseCheck"
                                            name="runny-nose"
                                        />
                                        <label
                                            class="custom-control-label"
                                            for="runnyNoseCheck"
                                            >Runny Nose</label
                                        >
                                    </div>
                                    <div
                                        class="
                                            custom-control custom-checkbox
                                            mb-3
                                        "
                                    >
                                        <input
                                            type="checkbox"
                                            class="custom-control-input"
                                            id="diarrheaCheck"
                                            name="diarrhea"
                                        />
                                        <label
                                            class="custom-control-label"
                                            for="diarrheaCheck"
                                            >Diarrhea</label
                                        >
                                    </div>
                                    <div
                                        class="
                                            custom-control custom-checkbox
                                            mb-3
                                        "
                                    >
                                        <input
                                            type="checkbox"
                                            class="custom-control-input"
                                            id="noneExperiencingCheck"
                                            name="none-experiencing"
                                        />
                                        <label
                                            class="custom-control-label"
                                            for="noneExperiencingCheck"
                                            >None Experiencing</label
                                        >
                                    </div>
                                    <div
                                        class="
                                            custom-control custom-checkbox
                                            mb-3
                                        "
                                    >
                                        <input
                                            type="checkbox"
                                            class="custom-control-input"
                                            id="noneSymptomCheck"
                                            name="none-symptom"
                                        />
                                        <label
                                            class="custom-control-label"
                                            for="noneSymptomCheck"
                                            >None Symptom</label
                                        >
                                    </div>
                                </div>

                                <input
                                    type="button"
                                    name="next"
                                    class="next action-button"
                                    value="Next"
                                />
                                <input
                                    type="button"
                                    name="previous"
                                    class="previous action-button-previous"
                                    value="Previous"
                                />
                            </fieldset>
                            <!--end Symptoms fieldsets -->

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
                                    <label class="fieldlabels"
                                        >Severity of your selected
                                        Symptoms:</label
                                    >
                                    <div class="custom-control custom-radio">
                                        <input
                                            type="radio"
                                            class="custom-control-input"
                                            id="mildCheck"
                                            name="severity"
                                        />
                                        <label
                                            class="custom-control-label"
                                            for="mildCheck"
                                            >Mild</label
                                        >
                                    </div>

                                    <div class="custom-control custom-radio">
                                        <input
                                            type="radio"
                                            class="custom-control-input"
                                            id="moderateCheck"
                                            name="severity"
                                        />
                                        <label
                                            class="custom-control-label"
                                            for="moderateCheck"
                                            >Moderate</label
                                        >
                                    </div>

                                    <div class="custom-control custom-radio">
                                        <input
                                            type="radio"
                                            class="custom-control-input"
                                            id="severeCheck"
                                            name="severity"
                                        />
                                        <label
                                            class="custom-control-label"
                                            for="severeCheck"
                                            >Severe</label
                                        >
                                    </div>

                                    <div class="custom-control custom-radio">
                                        <input
                                            type="radio"
                                            class="custom-control-input"
                                            id="noneCheck"
                                            name="severity"
                                        />
                                        <label
                                            class="custom-control-label"
                                            for="noneCheck"
                                            >None</label
                                        >
                                    </div>

                                    <label class="fieldlabels"
                                        >Got in contact with someone tested
                                        positive</label
                                    >
                                    <div class="custom-control custom-radio">
                                        <input
                                            type="radio"
                                            class="custom-control-input"
                                            id="yesCheck"
                                            name="contact"
                                        />
                                        <label
                                            class="custom-control-label"
                                            for="yesCheck"
                                            >Yes</label
                                        >
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input
                                            type="radio"
                                            class="custom-control-input"
                                            id="noCheck"
                                            name="contact"
                                        />
                                        <label
                                            class="custom-control-label"
                                            for="noCheck"
                                            >No</label
                                        >
                                    </div>

                                    <div class="custom-control custom-radio">
                                        <input
                                            type="radio"
                                            class="custom-control-input"
                                            id="dontknowCheck"
                                            name="contact"
                                        />
                                        <label
                                            class="custom-control-label"
                                            for="dontknowCheck"
                                            >Don't Know</label
                                        >
                                    </div>
                                </div>
                                <input
                                    type="button"
                                    name="next"
                                    class="next action-button"
                                    value="Submit"
                                />
                                <input
                                    type="button"
                                    name="previous"
                                    class="previous action-button-previous"
                                    value="Previous"
                                />
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