<?php
require_once('./includes/imports.php');
require_once('./includes/config.php');
require_once('./includes/classes/Account.php');
require_once('./includes/classes/Constants.php');

$account = new Account($conn);

$id = $_GET["user_id"];
$userInfo = $account->getUser($id);
require_once('./includes/components/navbar.php');

function iconColors($element) {
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

$getInfo = $account->getInfo();
if (isset($_SESSION["userLoggedIn"]) && $isAdmin = $getInfo["role_name"] == 'Admin' || 'Nurse' || 'Doctor') {
    // echo $_SESSION["userLoggedIn"];
?>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.7/css/all.css">
    <link rel="stylesheet" href="./includes/css/style.user-details.css">
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
                                <th scope='col'>Trouble Breathing</th>
                                <th scope='col'>Cough</th>
                                <th scope='col'>Nasal Congestion/Running</th>
                                <th scope='col'>Lost Sense</th>
                                <th scope='col'>Sore Throat</th>
                                <th scope='col'>Contacted COVID Positive</th>
                                <th scope='col'>Positive</th>
                                <th scope='col'>Travelled</th>
                                <th scope='col'>Tiredness</th>
                                <th scope='col'>Diarrhea</th>
                                <th scope='col'>Chills</th>
                                <th scope='col'>Told to be Quarantine</th>
                                <th scope='col'>Tested At</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($rows as $row) {
                            ?>
                                <tr>
                                    <th scope='row'><button class="form-control"><i class="fa fa-thermometer-half icons <?php echo iconColors($row['fever_s']) ?>" aria-hidden="true"></i></button></th>
                                    <th scope='row'> <input type="checkbox" class="form-control" disabled <?php echo $row['trouble_breathing'] == 0 ? "checked" : ""; ?> /> </th>
                                    <th scope='row'> <input type="checkbox" class="form-control" disabled <?php echo $row['cough'] == 0 ? "checked" : ""; ?> /> </th>
                                    <th scope='row'> <input type="checkbox" class="form-control" disabled <?php echo $row['congestion'] == 0 ? "checked" : ""; ?> /> </th>
                                    <th scope='row'> <input type="checkbox" class="form-control" disabled <?php echo $row['sense_loss'] == 0 ? "checked" : ""; ?> /> </th>
                                    <th scope='row'> <input type="checkbox" class="form-control" disabled <?php echo $row['sore_throat'] == 0 ? "checked" : ""; ?> /> </th>
                                    <th scope='row'> <input type="checkbox" class="form-control" disabled <?php echo $row['contact_positive'] == 0 ? "checked" : ""; ?> /> </th>
                                    <th scope='row'> <input type="checkbox" class="form-control" disabled <?php echo $row['is_positive'] == 0 ? "checked" : ""; ?> /> </th>
                                    <th scope='row'> <input type="checkbox" class="form-control" disabled <?php echo $row['travelled'] == 0 ? "checked" : ""; ?> /> </th>
                                    <th scope='row'> <input type="checkbox" class="form-control" disabled <?php echo $row['tiredness'] == 0 ? "checked" : ""; ?> /> </th>
                                    <th scope='row'> <input type="checkbox" class="form-control" disabled <?php echo $row['diarrhea'] == 0 ? "checked" : ""; ?> /> </th>
                                    <th scope='row'> <input type="checkbox" class="form-control" disabled <?php echo $row['chills'] == 0 ? "checked" : ""; ?> /> </th>
                                    <th scope='row'> <input type="checkbox" class="form-control" disabled <?php echo $row['quarantine'] == 0 ? "checked" : ""; ?> /> </th>
                                    <th scope='row'> <?php echo $row['date_tested']; ?> </th>
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