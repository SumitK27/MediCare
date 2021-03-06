<title>Dashboard</title>

<?php
require_once('./includes/imports.php');
require_once('./includes/config.php');
require_once('./includes/classes/Account.php');
require_once('./includes/classes/Constants.php');

$account = new Account($conn);
$getInfo = $userInfo = $account->getInfo();
require_once('./includes/components/navbar.php');

function iconColors($element)
{
    if ($element == 0) {
        return 'text-dark';
    } else if ($element == 1) {
        return 'text-info';
    } else if ($element == 2) {
        return 'text-warning';
    } else {
        return 'text-danger';
    }
}

function hasSymptom($element)
{
    if ($element == 0) {
        return 'text-dark';
    } else {
        return 'text-danger';
    }
}

function displayDate($element)
{
    if ($element == '0000-00-00 00:00:00') {
        return '-';
    }
    return substr($element, 0, 10);
}

function getContactType($type)
{
    if ($type == "Feedback") {
        return "bg-success";
    } elseif ($type == "Report a bug") {
        return "bg-danger";
    } elseif ($type == "Feature Request") {
        return "bg-info";
    } elseif ($type == "Other") {
        return "bg-dark";
    }
}

?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link rel="stylesheet" href="./includes/css/style.dashboard.css">

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<?php


/* ------------------------------ Patient Dashboard ------------------------------*/
if (isset($_SESSION["userLoggedIn"]) && $userInfo["role_name"] == "Patient") {
?>
    <div class="row flex-row flex-nowrap" style="min-height:100vh; margin-right:0;">
        <div id="sidebar-container" class="sidebar-expanded">
            <div class=" nav flex-column nav-pills text-white" id="n-pills-tab" role="tablist">
                <div class="loggedIn">
                    Logged In as:<br>
                    <?php
                    echo $userInfo['first_name'] . " " . $userInfo['last_name'];
                    ?>
                </div>

                <a href="#p-pills-profile" aria-expanded="false" class="bg-dark text-light list-group-item list-group-item-action flex-column align-items-start" class="nav-link active text-white mb-4" id="p-pills-profile-tab" data-toggle="pill" role="tab" aria-controls="p-pills-profile" aria-selected="true">
                    <div class="icon">
                        <span class="fa fa-user fa-fw mr-3"></span>
                        <span class="menu-collapsed">Profile</span>
                    </div>
                </a>

                <a href="#p-pills-records" aria-expanded="false" class="bg-dark text-light list-group-item list-group-item-action flex-column align-items-start" class="nav-link text-white mb-4" id="p-pills-records-tab" data-toggle="pill" role="tab" aria-controls="p-pills-records" aria-selected="true">
                    <div class="icon">
                        <span class="fas fa-hospital-user fa-fw mr-3"></span>
                        <span class="menu-collapsed">Records</span>
                    </div>
                </a>

                <a href="#p-pills-report" aria-expanded="false" class="bg-dark text-light list-group-item list-group-item-action flex-column align-items-start" class="nav-link text-white mb-4" id="p-pills-report-tab" data-toggle="pill" role="tab" aria-controls="p-pills-report" aria-selected="true">
                    <div class="icon">
                        <span class="fas fa-notes-medical fa-fw mr-3"></span>
                        <span class="menu-collapsed">Reports</span>
                    </div>
                </a>

                <a href="#top" data-toggle="sidebar-collapse" class="bg-dark text-light list-group-item list-group-item-action d-flex align-items-center">
                    <div class="icon">
                        <span id="collapse-icon" class="fas fa-angle-double-left mr-3"></span>
                        <span id="collapse-text" class="menu-collapsed">Collapse</span>
                    </div>
                </a>
            </div>
        </div>

        <div class="col" style="overflow: auto;">
            <div class="tab-content" id="p-pills-tabContent">
                <div class="tab-pane fade show active" id="p-pills-profile" role="tabpanel" aria-labelledby="p-pills-profile-tab">
                    <div class="card">
                        <div class="card-header bg-dark text-light">
                            <h1>Welcome,
                                <?php
                                echo $userInfo['first_name'] . " " . $userInfo['last_name'];
                                ?>
                            </h1>
                        </div>
                        <div class="card-body">

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
                                            <div class="col-md-6">
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
                                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your Email Address" value="<?php echo $userInfo['email'] ?>" required>
                                                </div>
                                                <button type="submit" class="btn btn-primary col-12" name="updateInfo">Save</button>
                                            </div>


                                            <div class="col-md-6">
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
                    </div>
                </div>
                <div class="tab-pane fade show" id="p-pills-records" role="tabpanel" aria-labelledby="p-pills-records-tab">
                    <button class="btn btn-primary float-right" onclick="location.href='note-symptoms.php?user_id=<?php echo $userInfo['user_id'] ?>'"><i class="fa fa-user-plus"></i>Add Symptoms</button>
                    <br><br>
                    <?php
                    $rows = $account->getUserSymptoms($userInfo['user_id']);
                    if (count($rows) > 0) {
                    ?>
                        <table class="table table-responsive table-fluid myTable">
                            <thead>
                                <tr>
                                    <th scope='col'>Fever</th>
                                    <th scope='col'>Cough</th>
                                    <th scope='col'>Tiredness</th>
                                    <th scope='col'>Chest Pain</th>
                                    <th scope='col'>Head Ache</th>
                                    <th scope='col'>Stomach Ache</th>
                                    <th scope='col'>Oxygen Level</th>
                                    <th scope='col'>Sore Throat</th>
                                    <th scope='col'>Congestion</th>
                                    <th scope='col'>Sense Loss</th>
                                    <th scope='col'>Trouble Breathing</th>
                                    <th scope='col'>Travelled</th>
                                    <th scope='col'>Kidney Failure</th>
                                    <th scope='col'>Heart Problem</th>
                                    <th scope='col'>Diabetes</th>
                                    <th scope='col'>Malignancy Cancer</th>
                                    <th scope='col'>Hypertension</th>
                                    <th scope='col'>Liver Disease</th>
                                    <th scope='col'>Immunocompromised Condition</th>
                                    <th scope='col'>Vomiting</th>
                                    <th scope='col'>Consume Steroids</th>
                                    <th scope='col'>Diarrhea</th>
                                    <th scope='col'>Skin Rash Discoloration</th>
                                    <th scope='col'>Chills</th>
                                    <th scope='col'>Contacted COVID Positive</th>
                                    <th scope='col'>COVID Positive</th>
                                    <th scope='col'>1st Dose</th>
                                    <th scope='col'>2nd Dose</th>
                                    <th scope='col'>Quarantine</th>
                                    <th scope='col'>Tested At</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($rows as $row) {
                                ?>
                                    <tr>
                                        <th scope='row'><button class="form-control"><i class="fa fa-thermometer-half icons <?php echo iconColors($row['fever_s']) ?>" aria-hidden="true"></i></button></th>

                                        <th scope='row'><button class="form-control"><i class="fa fa-head-side-cough icons <?php echo iconColors($row['cough_s']) ?>" aria-hidden="true"></i></button></th>

                                        <th scope='row'><button class="form-control"><i class="fa fa-tired icons <?php echo iconColors($row['tiredness_s']) ?>" aria-hidden="true"></i></button></th>

                                        <th scope='row'><button class="form-control"><i class="fab fa-creative-commons-sampling icons <?php echo iconColors($row['chest_pain_s']) ?>" aria-hidden="true"></i></button></th>

                                        <th scope='row'><button class="form-control"><i class="fa fa-head-side-virus icons <?php echo iconColors($row['head_ache_s']) ?>" aria-hidden="true"></i></button></th>

                                        <th scope='row'><button class="form-control"><i class="fab fa-creative-commons-sampling icons <?php echo iconColors($row['stomach_ache_s']) ?>" aria-hidden="true"></i></button></th>

                                        <th scope='row'><button class="form-control"><i class="fab fa-creative-commons-sampling icons <?php echo iconColors($row['less_oxygen_level_s']) ?>" aria-hidden="true"></i></button></th>

                                        <th scope='row'><button class="form-control"><i class="fab fa-creative-commons-sampling icons <?php echo iconColors($row['sore_throat_s']) ?>" aria-hidden="true"></i></button></th>

                                        <th scope='row'><button class="form-control"><i class="fab fa-creative-commons-sampling icons <?php echo iconColors($row['congestion_s']) ?>" aria-hidden="true"></i></button></th>

                                        <th scope='row'><button class="form-control"><i class="fas fa-heartbeat icons <?php echo iconColors($row['sense_loss_s']) ?>" aria-hidden="true"></i></button></th>

                                        <th scope='row'><button class="form-control"><i class="fas fa-heartbeat icons <?php echo iconColors($row['trouble_breathing_s']) ?>" aria-hidden="true"></i></button></th>

                                        <th scope='row'><button class="form-control"><i class="fas fa-map-marked-alt icons <?php echo hasSymptom($row['travelled']) ?>" aria-hidden="true"></i></button></th>

                                        <th scope='row'><button class="form-control"><i class="fab fa-creative-commons-sampling icons <?php echo hasSymptom($row['kidney_failure']) ?>" aria-hidden="true"></i></button></th>

                                        <th scope='row'><button class="form-control"><i class="fas fa-heartbeat icons <?php echo iconColors($row['heart_problem_s']) ?>" aria-hidden="true"></i></button></th>

                                        <th scope='row'><button class="form-control"><i class="fab fa-creative-commons-sampling icons <?php echo iconColors($row['diabetes_s']) ?>" aria-hidden="true"></i></button></th>

                                        <th scope='row'><button class="form-control"><i class="fab fa-creative-commons-sampling icons <?php echo iconColors($row['malignancy_cancer_s']) ?>" aria-hidden="true"></i></button></th>

                                        <th scope='row'><button class="form-control"><i class="fab fa-creative-commons-sampling icons <?php echo iconColors($row['hypertension_s']) ?>" aria-hidden="true"></i></button></th>

                                        <th scope='row'><button class="form-control"><i class="fab fa-creative-commons-sampling icons <?php echo hasSymptom($row['liver_disease']) ?>" aria-hidden="true"></i></button></th>

                                        <th scope='row'><button class="form-control"><i class="fas fa-ban icons <?php echo iconColors($row['immunocompromised_condition_s']) ?>" aria-hidden="true"></i></button></th>

                                        <th scope='row'><button class="form-control"><i class="fab fa-creative-commons-sampling icons <?php echo iconColors($row['vomiting_s']) ?>" aria-hidden="true"></i></button></th>

                                        <th scope='row'><button class="form-control"><i class="fas fa-capsules icons <?php echo hasSymptom($row['consume_steroids']) ?>" aria-hidden="true"></i></button></th>

                                        <th scope='row'><button class="form-control"><i class="fab fa-creative-commons-sampling icons <?php echo iconColors($row['diarrhea_s']) ?>" aria-hidden="true"></i></button></th>

                                        <th scope='row'><button class="form-control"><i class="fas fa-allergies icons <?php echo hasSymptom($row['skin_rash_discoloration']) ?>" aria-hidden="true"></i></button></th>

                                        <th scope='row'><button class="form-control"><i class="fas fa-snowflake icons <?php echo iconColors($row['chills_s']) ?>" aria-hidden="true"></i></button></th>

                                        <th scope='row'><button class="form-control"><i class="fas fa-people-arrows icons <?php echo hasSymptom($row['contact_positive']) ?>" aria-hidden="true"></i></button></th>

                                        <th scope='row'><button class="form-control"><i class="fas fa-virus icons <?php echo hasSymptom($row['is_positive']) ?>" aria-hidden="true"></i></button></th>

                                        <th scope='row'> <?php echo displayDate($row['is_vaccinated_d']); ?> </th>

                                        <th scope='row'> <?php echo displayDate($row['is_vaccinated_2_d']); ?> </th>

                                        <th scope='row'><button class="form-control"><i class="fas fa-procedures icons <?php echo hasSymptom($row['quarantine']) ?>" aria-hidden="true"></i></button></th>

                                        <th scope='row'> <?php echo $row['date_tested']; ?> </th>
                                    </tr>
                                <?php
                                }
                                ?>
                        </table>
                        <div class="indication-group">
                            <div class="text-group">
                                <div class="cube bg-dark"></div>
                                <div class="text">None</div>
                            </div>
                            <div class="text-group">
                                <div class="cube bg-info"></div>
                                <div class="text">Low</div>
                            </div>
                            <div class="text-group">
                                <div class="cube bg-warning"></div>
                                <div class="text">Medium</div>
                            </div>
                            <div class="text-group">
                                <div class="cube bg-danger"></div>
                                <div class="text">High</div>
                            </div>
                        </div>
                    <?php
                    } else {
                    ?>
                        <strong>
                            <span class='alert alert-danger row justify-content-center align-items-center'>0
                                Results<span>
                        </strong>
                    <?php
                    }
                    ?>
                </div>
                <div class="tab-pane fade" id="p-pills-report" role="tabpanel" aria-labelledby="p-pills-report-tab">
                    <div class="card">
                        <div class="card-header">
                            <h1><?php echo $userInfo["first_name"] . " " . $userInfo["last_name"] ?> Details</h1>
                            </h1>
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-center bg-dark text-light">
                                <h3>Personal Details</h3>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="firstName">First Name</label>
                                    <input type="text" class="form-control" name="firstName" value="<?php echo $userInfo['first_name']; ?>">
                                </div>
                                <div class="col">
                                    <label for="lastName">Last Name</label>
                                    <input type="text" class="form-control" name="lastName" value="<?php echo $userInfo['last_name'] ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="mobileNumber">Mobile Number</label>
                                    <input type="text" class="form-control" name="mobileNumber" value="<?php echo $userInfo['mobile'] ?>">
                                </div>
                                <div class="col">
                                    <label for="address">Address</label>
                                    <textarea type="text" class="form-control" name="address"><?php echo $userInfo['address'] ?></textarea>
                                </div>
                                <div class="col">
                                    <label for="mob-no">Aadhaar No</label>
                                    <input type="text" class="form-control" name="aadhaar-no" value="<?php echo $userInfo['aadhaar_no'] ?>">
                                </div>
                            </div>
                            <hr>
                            <div class="row justify-content-center bg-dark text-light">
                                <h3>Medical Details</h3>
                            </div>
                            <?php
                            $rows = $account->getUserSymptoms($userInfo['user_id']);
                            if (count($rows) > 0) {
                            ?>
                                <table class="table table-responsive table-fluid myTable">
                                    <thead>
                                        <tr>
                                            <th scope='col'>Fever</th>
                                            <th scope='col'>Cough</th>
                                            <th scope='col'>Tiredness</th>
                                            <th scope='col'>Chest Pain</th>
                                            <th scope='col'>Head Ache</th>
                                            <th scope='col'>Stomach Ache</th>
                                            <th scope='col'>Oxygen Level</th>
                                            <th scope='col'>Sore Throat</th>
                                            <th scope='col'>Congestion</th>
                                            <th scope='col'>Sense Loss</th>
                                            <th scope='col'>Trouble Breathing</th>
                                            <th scope='col'>Travelled</th>
                                            <th scope='col'>Kidney Failure</th>
                                            <th scope='col'>Heart Problem</th>
                                            <th scope='col'>Diabetes</th>
                                            <th scope='col'>Malignancy Cancer</th>
                                            <th scope='col'>Hypertension</th>
                                            <th scope='col'>Liver Disease</th>
                                            <th scope='col'>Immunocompromised Condition</th>
                                            <th scope='col'>Vomiting</th>
                                            <th scope='col'>Consume Steroids</th>
                                            <th scope='col'>Diarrhea</th>
                                            <th scope='col'>Skin Rash Discoloration</th>
                                            <th scope='col'>Chills</th>
                                            <th scope='col'>Contacted COVID Positive</th>
                                            <th scope='col'>COVID Positive</th>
                                            <th scope='col'>1st Dose</th>
                                            <th scope='col'>2nd Dose</th>
                                            <th scope='col'>Quarantine</th>
                                            <th scope='col'>Tested At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($rows as $row) {
                                        ?>
                                            <tr>
                                                <th scope='row'><button class="form-control"><i class="fa fa-thermometer-half icons <?php echo iconColors($row['fever_s']) ?>" aria-hidden="true"></i></button></th>

                                                <th scope='row'><button class="form-control"><i class="fa fa-head-side-cough icons <?php echo iconColors($row['cough_s']) ?>" aria-hidden="true"></i></button></th>

                                                <th scope='row'><button class="form-control"><i class="fa fa-tired icons <?php echo iconColors($row['tiredness_s']) ?>" aria-hidden="true"></i></button></th>

                                                <th scope='row'><button class="form-control"><i class="fab fa-creative-commons-sampling icons <?php echo iconColors($row['chest_pain_s']) ?>" aria-hidden="true"></i></button></th>

                                                <th scope='row'><button class="form-control"><i class="fa fa-head-side-virus icons <?php echo iconColors($row['head_ache_s']) ?>" aria-hidden="true"></i></button></th>

                                                <th scope='row'><button class="form-control"><i class="fab fa-creative-commons-sampling icons <?php echo iconColors($row['stomach_ache_s']) ?>" aria-hidden="true"></i></button></th>

                                                <th scope='row'><button class="form-control"><i class="fab fa-creative-commons-sampling icons <?php echo iconColors($row['less_oxygen_level_s']) ?>" aria-hidden="true"></i></button></th>

                                                <th scope='row'><button class="form-control"><i class="fab fa-creative-commons-sampling icons <?php echo iconColors($row['sore_throat_s']) ?>" aria-hidden="true"></i></button></th>

                                                <th scope='row'><button class="form-control"><i class="fab fa-creative-commons-sampling icons <?php echo iconColors($row['congestion_s']) ?>" aria-hidden="true"></i></button></th>

                                                <th scope='row'><button class="form-control"><i class="fas fa-heartbeat icons <?php echo iconColors($row['sense_loss_s']) ?>" aria-hidden="true"></i></button></th>

                                                <th scope='row'><button class="form-control"><i class="fas fa-heartbeat icons <?php echo iconColors($row['trouble_breathing_s']) ?>" aria-hidden="true"></i></button></th>

                                                <th scope='row'><button class="form-control"><i class="fas fa-map-marked-alt icons <?php echo hasSymptom($row['travelled']) ?>" aria-hidden="true"></i></button></th>

                                                <th scope='row'><button class="form-control"><i class="fab fa-creative-commons-sampling icons <?php echo hasSymptom($row['kidney_failure']) ?>" aria-hidden="true"></i></button></th>

                                                <th scope='row'><button class="form-control"><i class="fas fa-heartbeat icons <?php echo iconColors($row['heart_problem_s']) ?>" aria-hidden="true"></i></button></th>

                                                <th scope='row'><button class="form-control"><i class="fab fa-creative-commons-sampling icons <?php echo iconColors($row['diabetes_s']) ?>" aria-hidden="true"></i></button></th>

                                                <th scope='row'><button class="form-control"><i class="fab fa-creative-commons-sampling icons <?php echo iconColors($row['malignancy_cancer_s']) ?>" aria-hidden="true"></i></button></th>

                                                <th scope='row'><button class="form-control"><i class="fab fa-creative-commons-sampling icons <?php echo iconColors($row['hypertension_s']) ?>" aria-hidden="true"></i></button></th>

                                                <th scope='row'><button class="form-control"><i class="fab fa-creative-commons-sampling icons <?php echo hasSymptom($row['liver_disease']) ?>" aria-hidden="true"></i></button></th>

                                                <th scope='row'><button class="form-control"><i class="fas fa-ban icons <?php echo iconColors($row['immunocompromised_condition_s']) ?>" aria-hidden="true"></i></button></th>

                                                <th scope='row'><button class="form-control"><i class="fab fa-creative-commons-sampling icons <?php echo iconColors($row['vomiting_s']) ?>" aria-hidden="true"></i></button></th>

                                                <th scope='row'><button class="form-control"><i class="fas fa-capsules icons <?php echo hasSymptom($row['consume_steroids']) ?>" aria-hidden="true"></i></button></th>

                                                <th scope='row'><button class="form-control"><i class="fab fa-creative-commons-sampling icons <?php echo iconColors($row['diarrhea_s']) ?>" aria-hidden="true"></i></button></th>

                                                <th scope='row'><button class="form-control"><i class="fas fa-allergies icons <?php echo hasSymptom($row['skin_rash_discoloration']) ?>" aria-hidden="true"></i></button></th>

                                                <th scope='row'><button class="form-control"><i class="fas fa-snowflake icons <?php echo iconColors($row['chills_s']) ?>" aria-hidden="true"></i></button></th>

                                                <th scope='row'><button class="form-control"><i class="fas fa-people-arrows icons <?php echo hasSymptom($row['contact_positive']) ?>" aria-hidden="true"></i></button></th>

                                                <th scope='row'><button class="form-control"><i class="fas fa-virus icons <?php echo hasSymptom($row['is_positive']) ?>" aria-hidden="true"></i></button></th>

                                                <th scope='row'> <?php echo displayDate($row['is_vaccinated_d']); ?> </th>

                                                <th scope='row'> <?php echo displayDate($row['is_vaccinated_2_d']); ?> </th>

                                                <th scope='row'><button class="form-control"><i class="fas fa-procedures icons <?php echo hasSymptom($row['quarantine']) ?>" aria-hidden="true"></i></button></th>

                                                <th scope='row'> <?php echo $row['date_tested']; ?> </th>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                </table>
                                <div class="indication-group">
                                    <div class="text-group">
                                        <div class="cube bg-dark"></div>
                                        <div class="text">None</div>
                                    </div>
                                    <div class="text-group">
                                        <div class="cube bg-info"></div>
                                        <div class="text">Low</div>
                                    </div>
                                    <div class="text-group">
                                        <div class="cube bg-warning"></div>
                                        <div class="text">Medium</div>
                                    </div>
                                    <div class="text-group">
                                        <div class="cube bg-danger"></div>
                                        <div class="text">High</div>
                                    </div>
                                </div>
                            <?php
                            } else {
                            ?>
                                <strong>
                                    <span class='alert alert-danger row justify-content-center align-items-center'>0
                                        Results<span>
                                </strong>
                            <?php
                            }
                            ?>
                            <hr>
                            <div class="row justify-content-center bg-dark text-light">
                                <h3>Report History</h3>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary float-right"><i class="fa fa-print" onclick="window.print();"></i> Print</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
}
/* ------------------------------ End of Patient Dashboard ------------------------------*/

/* ------------------------------ Nurse Dashboard ------------------------------*/ 
elseif (isset($_SESSION["userLoggedIn"]) && $userInfo["role_name"] == "Nurse") {
?>
    <div class="row flex-row flex-nowrap" style="min-height:100vh; margin-right:0;">
        <div id="sidebar-container" class="sidebar-expanded">
            <div class=" nav flex-column nav-pills text-light" id="n-pills-tab" role="tablist">
                <div class="loggedIn">
                    Logged In as:<br>
                    <?php
                    echo $userInfo['first_name'] . " " . $userInfo['last_name'];
                    ?>
                </div>

                <a href="#n-pills-profile" aria-expanded="false" class="bg-dark text-light list-group-item list-group-item-action flex-column align-items-start" class="nav-link active text-white mb-4" id="n-pills-profile-tab" data-toggle="pill" role="tab" aria-controls="n-pills-profile" aria-selected="true">
                    <div class="icon">
                        <span class="fa fa-user fa-fw mr-3"></span>
                        <span class="menu-collapsed">Profile</span>
                    </div>
                </a>

                <a href="#n-pills-patient" aria-expanded="false" class="bg-dark text-light list-group-item list-group-item-action flex-column align-items-start" class="nav-link text-white mb-4" id="n-pills-patient-tab" data-toggle="pill" role="tab" aria-controls="n-pills-patient" aria-selected="true">
                    <div class="icon">
                        <span class="fas fa-hospital-user fa-fw mr-3"></span>
                        <span class="menu-collapsed">Patients</span>
                    </div>
                </a>

                <a href="#n-pills-report" aria-expanded="false" class="bg-dark text-light list-group-item list-group-item-action flex-column align-items-start" class="nav-link text-white mb-4" id="n-pills-report-tab" data-toggle="pill" role="tab" aria-controls="n-pills-report" aria-selected="true">
                    <div class="icon">
                        <span class="fas fa-notes-medical fa-fw mr-3"></span>
                        <span class="menu-collapsed">Report</span>
                    </div>
                </a>

                <a href="#top" data-toggle="sidebar-collapse" class="bg-dark text-light list-group-item list-group-item-action d-flex align-items-center">
                    <div class="icon">
                        <span id="collapse-icon" class="fas fa-angle-double-left mr-3"></span>
                        <span id="collapse-text" class="menu-collapsed">Collapse</span>
                    </div>
                </a>
            </div>
        </div>

        <div class="col" style="overflow: auto;">
            <div class="tab-content" id="n-pills-tabContent">
                <div class="tab-pane fade show active" id="n-pills-profile" role="tabpanel" aria-labelledby="n-pills-profile-tab">
                    <div class="card">
                        <div class="card-header bg-dark text-light">
                            <h1>Welcome,
                                <?php
                                echo $userInfo['first_name'] . " " . $userInfo['last_name'];
                                ?>
                            </h1>
                        </div>
                        <div class="card-body">

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
                                            <div class="col-md-6">
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
                                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your Email Address" value="<?php echo $userInfo['email'] ?>" required>
                                                </div>
                                                <button type="submit" class="btn btn-primary col-12" name="updateInfo">Save</button>
                                            </div>


                                            <div class="col-md-6">
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
                    </div>
                </div>
                <div class="tab-pane fade show" id="n-pills-patient" role="tabpanel" aria-labelledby="n-pills-patient-tab">
                    <button class="btn btn-primary float-right" onclick="location.href='add-patient.php'"><i class="fas fa-hospital-user"></i>Add Patient</button>
                    <br><br>
                    <?php
                    $rows = $account->getUserTypeCreatedByMe($getInfo['user_id'], "Patient");
                    /* Rows > 0 */
                    if ($rows > 0) {
                    ?>

                        <table class="table table-striped table-fluid myTable">
                            <thead class='thead-dark'>
                                <tr>
                                    <th scope='col'>ID</th>
                                    <th scope='col'>First Name</th>
                                    <th scope='col'>Last Name</th>
                                    <th scope='col'>Email</th>
                                    <th scope='col'>User Type</th>
                                    <th scope='col'>More Details</th>
                                    <th scope='col'>Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($rows as $row) {
                                ?>
                                    <tr>
                                        <th scope='row'> <?php echo $row['user_id'] ?> </th>
                                        <th scope='row'> <?php echo $row['first_name'] ?> </th>
                                        <th scope='row'> <?php echo $row['last_name'] ?> </th>
                                        <th scope='row'> <?php echo $row['email'] ?> </th>
                                        <th scope='row'> <?php echo $row['role_name'] ?> </th>
                                        <th scope='row'>
                                            <div class="row">
                                                <div class="col">
                                                    <a href='user-details.php?user_id=<?php echo $row['user_id'] ?>'><i class="fas fa-id-card-alt" aria-hidden="true"></i></a>
                                                </div>
                                                <div class="col">
                                                    <a href='note-symptoms.php?user_id=<?php echo $row['user_id'] ?>'><i class="fas fa-calendar-plus" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                        </th>
                                        <th scope='row'>
                                            <div class="row">
                                                <div class="col">
                                                    <a href='edit.php?user_id=<?php echo $row["user_id"] ?>'><i class="fa fa-edit"></i></a>
                                                </div>
                                                <div class="col">
                                                    <a href="delete.php?user_id=<?php echo $row["user_id"] ?>"><i class="fa fa-trash"></i></a>
                                                </div>
                                            </div>
                                        </th>
                                    </tr>
                                <?php
                                }
                                ?>
                        </table>
                    <?php
                    } else {
                    ?>
                        <strong>
                            <span class='alert alert-danger row justify-content-center align-items-center'>0 Results<span>
                        </strong>
                    <?php
                    }
                    ?>
                </div>
                <div class="tab-pane fade" id="n-pills-report" role="tabpanel" aria-labelledby="n-pills-report-tab">
                    <h5 class="text-center">Blank Page</h5>
                </div>
            </div>
        </div>
    </div>
<?php
}
/* ------------------------------ End of Nurse Dashboard ------------------------------*/


/* ------------------------------ Doctor Dashboard ------------------------------ */ 
elseif (isset($_SESSION["userLoggedIn"]) && $userInfo["role_name"] == "Doctor") {
?>
    <div class="row flex-row flex-nowrap" style="min-height:100vh; margin-right:0;">
        <div id="sidebar-container" class="sidebar-expanded">
            <div class=" nav flex-column nav-pills text-white" id="n-pills-tab" role="tablist">
                <div class="loggedIn">
                    Logged In as:<br>
                    <?php
                    echo $userInfo['first_name'] . " " . $userInfo['last_name'];
                    ?>
                </div>

                <a href="#d-pills-profile" aria-expanded="false" class="bg-dark text-light list-group-item list-group-item-action flex-column align-items-start" class="nav-link active text-white mb-4" id="d-pills-profile-tab" data-toggle="pill" role="tab" aria-controls="d-pills-profile" aria-selected="true">
                    <div class="icon">
                        <span class="fa fa-user fa-fw mr-3"></span>
                        <span class="menu-collapsed">Profile</span>
                    </div>
                </a>

                <a href="#d-pills-patient" aria-expanded="false" class="bg-dark text-light list-group-item list-group-item-action flex-column align-items-start" class="nav-link text-white mb-4" id="d-pills-patient-tab" data-toggle="pill" role="tab" aria-controls="d-pills-patient" aria-selected="true">
                    <div class="icon">
                        <span class="fas fa-hospital-user fa-fw mr-3"></span>
                        <span class="menu-collapsed">Patients</span>
                    </div>
                </a>

                <a href="#d-pills-nurse" aria-expanded="false" class="bg-dark text-light list-group-item list-group-item-action flex-column align-items-start" class="nav-link text-white mb-4" id="d-pills-nurse-tab" data-toggle="pill" role="tab" aria-controls="d-pills-nurse" aria-selected="true">
                    <div class="icon">
                        <span class="fas fa-notes-medical fa-fw mr-3"></span>
                        <span class="menu-collapsed">Nurses</span>
                    </div>
                </a>

                <a href="#top" data-toggle="sidebar-collapse" class="bg-dark text-light list-group-item list-group-item-action d-flex align-items-center">
                    <div class="icon">
                        <span id="collapse-icon" class="fas fa-angle-double-left mr-3"></span>
                        <span id="collapse-text" class="menu-collapsed">Collapse</span>
                    </div>
                </a>
            </div>
        </div>
        <div class="col" style="overflow: auto;">
            <div class="tab-content" id="d-pills-tabContent">
                <div class="tab-pane fade show active" id="d-pills-profile" role="tabpanel" aria-labelledby="d-pills-profile-tab">
                    <div class="card">
                        <div class="card-header bg-dark text-light">
                            <h1>Welcome,
                                <?php
                                echo $userInfo['first_name'] . " " . $userInfo['last_name'];
                                ?>
                            </h1>
                        </div>
                        <div class="card-body">

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
                                            <div class="col-md-6">
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
                                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your Email Address" value="<?php echo $userInfo['email'] ?>" required>
                                                </div>
                                                <button type="submit" class="btn btn-primary col-12" name="updateInfo">Save</button>
                                            </div>


                                            <div class="col-md-6">
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
                    </div>
                </div>
                <div class="tab-pane fade show" id="d-pills-patient" role="tabpanel" aria-labelledby="d-pills-patient-tab">
                    <button class="btn btn-primary float-right" onclick="location.href='add-patient.php'"><i class="fas fa-hospital-user"></i> Add Patient</button>
                    <br><br>
                    <?php
                    // $rows = $account->getUserType("Patient");
                    $nurses = $account->getUserTypeCreatedByMe($getInfo['user_id'], "Nurse");
                    $rows = [];
                    ?>
                    <table class="table table-striped table-fluid myTable">
                        <thead class='thead-dark'>
                            <tr>
                                <th scope='col'>ID</th>
                                <th scope='col'>First Name</th>
                                <th scope='col'>Last Name</th>
                                <th scope='col'>Email</th>
                                <th scope='col'>User Type</th>
                                <th scope='col'>More Details</th>
                                <th scope='col'>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($nurses as $nurse) {
                                $rows = $account->getUserTypeCreatedByMe($nurse['user_id'], "Patient");
                                /* Rows > 0 */
                                if ($rows > 0) {
                                    foreach ($rows as $row) {
                            ?>
                                        <tr>
                                            <th scope='row'> <?php echo $row['user_id'] ?> </th>
                                            <th scope='row'> <?php echo $row['first_name'] ?> </th>
                                            <th scope='row'> <?php echo $row['last_name'] ?> </th>
                                            <th scope='row'> <?php echo $row['email'] ?> </th>
                                            <th scope='row'> <?php echo $row['role_name'] ?> </th>
                                            <th scope='row' class="text-center">
                                                <div class="row">
                                                    <div class="col">
                                                        <a href='user-details.php?user_id=<?php echo $row['user_id'] ?>'><i class="fas fa-id-card-alt" aria-hidden="true"></i></a>
                                                    </div>
                                                    <div class="col">
                                                        <a href='note-symptoms.php?user_id=<?php echo $row['user_id'] ?>'><i class="fas fa-calendar-plus" aria-hidden="true"></i></a>
                                                    </div>
                                                </div>
                                            </th>
                                            <th scope='row'>
                                                <div class="row">
                                                    <div class="col">
                                                        <a href='edit.php?user_id=<?php echo $row["user_id"] ?>'><i class="fa fa-edit"></i></a>
                                                    </div>
                                                    <div class="col">
                                                        <a href="delete.php?user_id=<?php echo $row["user_id"] ?>"><i class="fa fa-trash"></i></a>
                                                    </div>
                                                </div>
                                            </th>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                <?php
                                } else {
                                ?>
                                    <strong>
                                        <span class='alert alert-danger row justify-content-center align-items-center'>0 Results<span>
                                    </strong>
                            <?php
                                }
                            }
                            ?>
                    </table>

                </div>
                <div class="tab-pane fade" id="d-pills-nurse" role="tabpanel" aria-labelledby="d-pills-nurse-tab">
                    <div class="col">
                        <div class="tab-pane fade show active" id="d-pills-nurse" role="tabpanel" aria-labelledby="d-pills-nurse-tab">
                            <button class="btn btn-primary float-right" onclick="location.href='add-nurse.php'"><i class="fas fa-user-nurse"></i> Add Nurse</button>
                            <br><br>
                            <?php
                            $rows = $account->getUserTypeCreatedByMe($getInfo['user_id'], "Nurse");
                            /* Rows > 0 */
                            if ($rows > 0) {
                            ?>
                                <table class="table table-striped table-fluid myTable">
                                    <thead class='thead-dark'>
                                        <tr>
                                            <th scope='col'>ID</th>
                                            <th scope='col'>First Name</th>
                                            <th scope='col'>Last Name</th>
                                            <th scope='col'>Email</th>
                                            <th scope='col'>User Type</th>
                                            <th scope='col'>More Details</th>
                                            <th scope='col'>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($rows as $row) {
                                        ?>
                                            <tr>
                                                <th scope='row'> <?php echo $row['user_id'] ?> </th>
                                                <th scope='row'> <?php echo $row['first_name'] ?> </th>
                                                <th scope='row'> <?php echo $row['last_name'] ?> </th>
                                                <th scope='row'> <?php echo $row['email'] ?> </th>
                                                <th scope='row'> <?php echo $row['role_name'] ?> </th>
                                                <th scope='row' class="text-center">
                                                    <div class="row">
                                                        <div class="col">
                                                            <a href='user-details.php?user_id=<?php echo $row['user_id'] ?>'><i class="fas fa-id-card-alt" aria-hidden="true"></i></a>
                                                        </div>
                                                        <div class="col">
                                                            <a href='note-symptoms.php?user_id=<?php echo $row['user_id'] ?>'><i class="fas fa-calendar-plus" aria-hidden="true"></i></a>
                                                        </div>
                                                    </div>
                                                </th>
                                                <th scope='row'>
                                                    <div class="row">
                                                        <div class="col">
                                                            <a href='edit.php?user_id=<?php echo $row["user_id"] ?>'><i class="fa fa-edit"></i></a>
                                                        </div>
                                                        <div class="col">
                                                            <a href="delete.php?user_id=<?php echo $row["user_id"] ?>"><i class="fa fa-trash"></i></a>
                                                        </div>
                                                    </div>
                                                </th>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                </table>
                            <?php
                            } else {
                            ?>
                                <strong>
                                    <span class='alert alert-danger row justify-content-center align-items-center'>0
                                        Results<span>
                                </strong>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
}
/* ------------------------------ End of Doctor Dashboard ------------------------------ */

/* ------------------------------ Admin Dashboard ------------------------------ */ 
elseif (isset($_SESSION["userLoggedIn"]) && $userInfo["role_name"] == "Admin") {
?>
    <div class="row flex-row flex-nowrap" style="min-height:100vh; margin-right:0;">
        <div id="sidebar-container" class="sidebar-expanded">
            <div class=" nav flex-column nav-pills text-white" id="n-pills-tab" role="tablist">
                <div class="loggedIn">
                    Logged In as:<br>
                    <?php
                    echo $userInfo['first_name'] . " " . $userInfo['last_name'];
                    ?>
                </div>

                <a href="#a-pills-profile" aria-expanded="false" class="bg-dark text-light list-group-item list-group-item-action flex-column align-items-start" class="nav-link active text-white mb-4" id="a-pills-profile-tab" data-toggle="pill" role="tab" aria-controls="a-pills-profile" aria-selected="true">
                    <div class="icon">
                        <span class="fa fa-user fa-fw mr-3"></span>
                        <span class="menu-collapsed">Profile</span>
                    </div>
                </a>

                <a href="#a-pills-patient" aria-expanded="false" class="bg-dark text-light list-group-item list-group-item-action flex-column align-items-start" class="nav-link text-white mb-4" id="a-pills-patient-tab" data-toggle="pill" role="tab" aria-controls="a-pills-patient" aria-selected="true">
                    <div class="icon">
                        <span class="fas fa-hospital-user fa-fw mr-3"></span>
                        <span class="menu-collapsed">Patients</span>
                    </div>
                </a>

                <a href="#a-pills-nurse" aria-expanded="false" class="bg-dark text-light list-group-item list-group-item-action flex-column align-items-start" class="nav-link text-white mb-4" id="a-pills-nurse-tab" data-toggle="pill" role="tab" aria-controls="a-pills-nurse" aria-selected="true">
                    <div class="icon">
                        <span class="fas fa-notes-medical fa-fw mr-3"></span>
                        <span class="menu-collapsed">Nurses</span>
                    </div>
                </a>

                <a href="#a-pills-doctor" aria-expanded="false" class="bg-dark text-light list-group-item list-group-item-action flex-column align-items-start" class="nav-link text-white mb-4" id="a-pills-doctor-tab" data-toggle="pill" role="tab" aria-controls="a-pills-doctor" aria-selected="true">
                    <div class="icon">
                        <span class="fas fa-notes-medical fa-fw mr-3"></span>
                        <span class="menu-collapsed">Doctors</span>
                    </div>
                </a>

                <a href="#a-pills-contact" aria-expanded="false" class="bg-dark text-light list-group-item list-group-item-action flex-column align-items-start" class="nav-link text-white mb-4" id="a-pills-contact-tab" data-toggle="pill" role="tab" aria-controls="a-pills-contact" aria-selected="true">
                    <div class="icon">
                        <span class="fas fa-notes-medical fa-fw mr-3"></span>
                        <span class="menu-collapsed">Contact Forms</span>
                    </div>
                </a>

                <a href="#top" data-toggle="sidebar-collapse" class="bg-dark text-light list-group-item list-group-item-action d-flex align-items-center">
                    <div class="icon">
                        <span id="collapse-icon" class="fas fa-angle-double-left mr-3"></span>
                        <span id="collapse-text" class="menu-collapsed">Collapse</span>
                    </div>
                </a>
            </div>
        </div>

        <div class="col" style="overflow: auto;">
            <div class="tab-content" id="a-pills-tabContent">
                <div class="tab-pane fade show active" id="a-pills-profile" role="tabpanel" aria-labelledby="a-pills-profile-tab">
                    <div class="card">
                        <div class="card-header bg-dark text-light">
                            <h1>Welcome,
                                <?php
                                echo $userInfo['first_name'] . " " . $userInfo['last_name'];
                                ?>
                            </h1>
                        </div>
                        <div class="card-body">

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
                                            <div class="col-md-6">
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
                                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your Email Address" value="<?php echo $userInfo['email'] ?>" required>
                                                </div>
                                                <button type="submit" class="btn btn-primary col-12" name="updateInfo">Save</button>
                                            </div>


                                            <div class="col-md-6">
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
                    </div>
                </div>
                <div class="tab-pane fade" id="a-pills-patient" role="tabpanel" aria-labelledby="a-pills-patient-tab">
                    <div class="col">
                        <button class="btn btn-primary float-right" onclick="location.href='add-patient.php'"><i class="fas fa-hospital-user"></i> Add Patient</button>
                        <br><br>
                        <?php
                        $rows = $account->getUserType("Patient");
                        /* Rows > 0 */
                        if ($rows > 0) {
                        ?>
                            <table class="table table-striped table-fluid myTable">
                                <thead class='thead-dark'>
                                    <tr>
                                        <th scope='col'>ID</th>
                                        <th scope='col'>First Name</th>
                                        <th scope='col'>Last Name</th>
                                        <th scope='col'>Email</th>
                                        <th scope='col'>User Type</th>
                                        <th scope='col'>More Details</th>
                                        <th scope='col'>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($rows as $row) {
                                    ?>
                                        <tr>
                                            <th scope='row'> <?php echo $row['user_id'] ?> </th>
                                            <th scope='row'> <?php echo $row['first_name'] ?> </th>
                                            <th scope='row'> <?php echo $row['last_name'] ?> </th>
                                            <th scope='row'> <?php echo $row['email'] ?> </th>
                                            <th scope='row'> <?php echo $row['role_name'] ?> </th>
                                            <th scope='row' class="text-center">
                                                <div class="row">
                                                    <div class="col">
                                                        <a href='user-details.php?user_id=<?php echo $row['user_id'] ?>'><i class="fas fa-id-card-alt" aria-hidden="true"></i></a>
                                                    </div>
                                                    <div class="col">
                                                        <a href='note-symptoms.php?user_id=<?php echo $row['user_id'] ?>'><i class="fas fa-calendar-plus" aria-hidden="true"></i></a>
                                                    </div>
                                                </div>
                                            </th>
                                            <th scope='row'>
                                                <div class="row">
                                                    <div class="col">
                                                        <a href='edit.php?user_id=<?php echo $row["user_id"] ?>'><i class="fa fa-edit"></i></a>
                                                    </div>
                                                    <div class="col">
                                                        <a href="delete.php?user_id=<?php echo $row["user_id"] ?>"><i class="fa fa-trash"></i></a>
                                                    </div>
                                                </div>
                                            </th>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                            </table>
                        <?php
                        } else {
                        ?>
                            <strong>
                                <span class='alert alert-danger row justify-content-center align-items-center'>0
                                    Results<span>
                            </strong>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="tab-pane fade" id="a-pills-nurse" role="tabpanel" aria-labelledby="a-pills-nurse-tab">
                    <div class="col">
                        <button class="btn btn-primary float-right" onclick="location.href='add-nurse.php'"><i class="fas fa-user-nurse"></i> Add Nurse</button>
                        <br><br>
                        <?php
                        $rows = $account->getUserType("Nurse");
                        /* Rows > 0 */
                        if ($rows > 0) {
                        ?>
                            <table class="table table-striped table-fluid myTable">
                                <thead class='thead-dark'>
                                    <tr>
                                        <th scope='col'>ID</th>
                                        <th scope='col'>First Name</th>
                                        <th scope='col'>Last Name</th>
                                        <th scope='col'>Email</th>
                                        <th scope='col'>User Type</th>
                                        <th scope='col'>More Details</th>
                                        <th scope='col'>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($rows as $row) {
                                    ?>
                                        <tr>
                                            <th scope='row'> <?php echo $row['user_id'] ?> </th>
                                            <th scope='row'> <?php echo $row['first_name'] ?> </th>
                                            <th scope='row'> <?php echo $row['last_name'] ?> </th>
                                            <th scope='row'> <?php echo $row['email'] ?> </th>
                                            <th scope='row'> <?php echo $row['role_name'] ?> </th>
                                            <th scope='row' class="text-center">
                                                <a href='user-details.php?user_id=<?php echo $row['user_id'] ?>'><i class="fa fa-chevron-circle-down" aria-hidden="true"></i></a>
                                            </th>
                                            <th scope='row'>
                                                <div class="row">
                                                    <div class="col">
                                                        <a href='edit.php?user_id=<?php echo $row["user_id"] ?>'><i class="fa fa-edit"></i></a>
                                                    </div>
                                                    <div class="col">
                                                        <a href="delete.php?user_id=<?php echo $row["user_id"] ?>"><i class="fa fa-trash"></i></a>
                                                    </div>
                                                </div>
                                            </th>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                            </table>
                        <?php
                        } else {
                        ?>
                            <strong>
                                <span class='alert alert-danger row justify-content-center align-items-center'>0
                                    Results<span>
                            </strong>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="tab-pane fade" id="a-pills-doctor" role="tabpanel" aria-labelledby="a-pills-doctor-tab">
                    <div class="col">
                        <button class="btn btn-primary float-right" onclick="location.href='add-doctor.php'"><i class="fas fa-user-md"></i> Add Doctor</button>
                        <br><br>
                        <?php
                        $rows = $account->getUserType("Doctor");
                        /* Rows > 0 */
                        if ($rows > 0) {
                        ?>
                            <table class="table table-striped table-fluid myTable">
                                <thead class='thead-dark'>
                                    <tr>
                                        <th scope='col'>ID</th>
                                        <th scope='col'>First Name</th>
                                        <th scope='col'>Last Name</th>
                                        <th scope='col'>Email</th>
                                        <th scope='col'>User Type</th>
                                        <th scope='col'>More Details</th>
                                        <th scope='col'>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($rows as $row) {
                                    ?>
                                        <tr>
                                            <th scope='row'> <?php echo $row['user_id'] ?> </th>
                                            <th scope='row'> <?php echo $row['first_name'] ?> </th>
                                            <th scope='row'> <?php echo $row['last_name'] ?> </th>
                                            <th scope='row'> <?php echo $row['email'] ?> </th>
                                            <th scope='row'> <?php echo $row['role_name'] ?> </th>
                                            <th scope='row' class="text-center">
                                                <a href='user-details.php?user_id=<?php echo $row['user_id'] ?>'><i class="fa fa-chevron-circle-down" aria-hidden="true"></i></a>
                                            </th>
                                            <th scope='row'>
                                                <div class="row">
                                                    <div class="col">
                                                        <a href='edit.php?user_id=<?php echo $row["user_id"] ?>'><i class="fa fa-edit"></i></a>
                                                    </div>
                                                    <div class="col">
                                                        <a href="delete.php?user_id=<?php echo $row["user_id"] ?>"><i class="fa fa-trash"></i></a>
                                                    </div>
                                                </div>
                                            </th>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                            </table>
                        <?php
                        } else {
                        ?>
                            <strong>
                                <span class='alert alert-danger row justify-content-center align-items-center'>0
                                    Results<span>
                            </strong>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="tab-pane fade" id="a-pills-contact" role="tabpanel" aria-labelledby="a-pills-doctor-tab">
                    <div class="contacts">
                        <?php
                        $contacts = $account->getContacts();
                        /* Contacts > 0 */
                        if ($contacts > 0) {
                            foreach ($contacts as $contact) {
                        ?>
                                <div class="card contact-card">
                                    <div class="card-header text-light <?php echo getContactType($contact['type']) ?>">
                                        From: <?php echo $contact['first_name'] . " " . $contact['last_name'] ?><br>
                                        Mail: <a class="text-dark" href="mailto:<?php echo $contact['email'] ?>"><?php echo $contact['email'] ?></a>
                                    </div>
                                    <div class="card-body">
                                        <p><?php echo $contact['message'] ?></p>
                                    </div>
                                    <div class="card-footer <?php echo getContactType($contact['type']) ?>">
                                    </div>
                                </div>
                            <?php
                            }
                        } else {
                            ?>
                            <div class="alert alter-danger">There are no Contact Form Responses</div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
}
/* ------------------------------ End of Admin Dashboard ------------------------------ */


/* ------------------------------ If Not Logged In ------------------------------ */ 
else {
    //  if not logged in
    header("Location: login.php");
    print_r($_SESSION["userLoggedIn"]);
}
require_once('./includes/importsAfter.php');
?>
<script src="./includes/js/dashboard.js"></script>