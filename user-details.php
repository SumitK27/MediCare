<title>User Info</title>
<?php
require_once('./includes/imports.php');
require_once('./includes/config.php');
require_once('./includes/classes/Account.php');
require_once('./includes/classes/Constants.php');

$account = new Account($conn);

$id = $_GET["user_id"];
$userInfo = $account->getUser($id);
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

$getInfo = $account->getInfo();
if (isset($_SESSION["userLoggedIn"]) && $isAdmin = $getInfo["role_name"] == 'Admin' || 'Nurse' || 'Doctor') {
    // echo $_SESSION["userLoggedIn"];
?>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css">
    <link rel="stylesheet" href="./includes/css/style.user-details.css">
    <style>
        .cube {
            width: 10px;
            height: 10px;
        }
        .text {
            margin-left: 5px;
        }
        .text-group {
            display: flex;
            align-items: center;
        }
        .indication-group {
            display: flex;
            justify-content: space-evenly;
        }
    </style>

    <div class="container">
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
                $rows = $account->getUserSymptoms($id);
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
        <?php
        if (isset($_POST["updateInfo"])) {
            $firstName = $_POST["firstName"];
            $lastName = $_POST["lastName"];
            $email = $_POST["email"];
            $userType = $_POST["userType"];
            $account->updateUser($id, $firstName, $lastName, $email, $userType);
        }
        ?>
        <br>
    <?php
} else {
    //  if not logged in
    header("Location: login.php");
}
require_once('./includes/importsAfter.php');
    ?>