<title>Dashboard</title>

<?php
require_once('./includes/imports.php');
require_once('./includes/config.php');
require_once('./includes/classes/Account.php');
require_once('./includes/classes/Constants.php');

$account = new Account($conn);
$userInfo = $account->getInfo();
$getInfo = $userInfo;
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
        return 'text-success';
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

?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<?php


/* ------------------------------ Nurse Dashboard ------------------------------*/
if (isset($_SESSION["userLoggedIn"]) && $userInfo["role_name"] == "Nurse") {
?>
    <div class="row flex-row flex-nowrap" style="height:100vh; margin-right:0;">
        <div class="bg-dark mt-6">
            <div class="nav flex-column nav-pills" id="n-pills-tab" role="tablist">
                <nav class="sb-sidenav accordion text-white text-left" id="n-sidenavAccordion">
                    <div class="col-12 sb-sidenav-menu" style="min-width: 170px;">
                        <div class="col-12 sb-sidenav-footer pt-5">
                            <div class="small">Logged in as:</div>
                            <?php
                            echo $userInfo['first_name'] . " " . $userInfo['last_name'];
                            ?>
                        </div>
                        <div class="col-12 nav flex-column nav-pills text-white" id="n-pills-tab" role="tablist">
                            <a class="nav-link text-white" href="#n-pills-profile">

                                <a class="nav-link active text-white mb-4" id="n-pills-profile-tab" data-toggle="pill" href="#n-pills-profile" role="tab" aria-controls="n-pills-profile" aria-controls="n-pills-profile" aria-selected="true"><i class="fa fa-user-circle mr-3"></i>Profile</a>

                                <a class="nav-link text-white mb-4" id="n-pills-patient-tab" data-toggle="pill" href="#n-pills-patient" role="tab" aria-controls="n-pills-patient" aria-controls="n-pills-patient" aria-selected="true"><i class="fas fa-hospital-user mr-3"></i>Patients</a>

                                <a class="nav-link text-white mb-4" id="n-pills-nurse-tab" data-toggle="pill" href="#n-pills-nurse" role="tab" aria-controls="n-pills-patient" aria-controls="n-pills-nurse" aria-selected="true"><i class="fas fa-notes-medical mr-3"></i>Report</a>
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>

        <div class="col">
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
                                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your Email Address" maxlength="25" value="<?php echo $userInfo['email'] ?>" required>
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
                    <button class="btn btn-primary float-right" onclick="location.href='add-patient.php'"><i class="fa fa-user-plus"></i>Add user</button>
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
                                                    <a href="delete.php?user_id=<?php echo $row["user_id"] ?>'"><i class="fa fa-trash"></i></a>
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
                <div class="tab-pane fade" id="n-pills-nurse" role="tabpanel" aria-labelledby="n-pills-nurse-tab">
                    <div class="col">
                        <div class="tab-content" id="n-pills-tabContent">
                            <div class="tab-pane fade show active" id="n-pills-nurse" role="tabpanel" aria-labelledby="n-pills-nurse-tab">
                                <h5 class="text-center">Blank Page</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
}
/* ------------------------------ End of Nurse Dashboard ------------------------------*/


/* ------------------------------ Doctor Dashboard ------------------------------ */ 
else if (isset($_SESSION["userLoggedIn"]) && $userInfo["role_name"] == "Doctor") {
?>

    <div class="row flex-row flex-nowrap" style="height:100vh; margin-right:0;">
        <div class="bg-dark mt-6">
            <div class="nav flex-column nav-pills" id="d-pills-tab" role="tablist">
                <nav class="sb-sidenav accordion text-white text-left" id="d-sidenavAccordion">
                    <div class="col-12 sb-sidenav-menu" style="min-width: 170px;">
                        <div class="col-12 sb-sidenav-footer p-3" style="width: 250px; height: 100px; ">
                            <div class="small">Logged in as:</div>
                            <?php
                            echo $userInfo['first_name'] . " " . $userInfo['last_name'];
                            ?>
                        </div>

                        <div class="col-12 nav flex-column nav-pills text-white" id="d-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active text-white mb-4" id="d-pills-profile-tab" data-toggle="pill" href="#d-pills-profile" role="tab" aria-controls="d-pills-profile" aria-selected="false"><i class="fa fa-user-circle mr-3"></i>Profile</a>

                            <a class="nav-link text-white mb-4" id="d-pills-patient-tab " data-toggle="pill" href="#d-pills-patient" role="tab" aria-controls="d-pills-patient" aria-selected="true"><i class="fas fa-hospital-user mr-3"></i>Patients</a>

                            <a class="nav-link text-white" id="d-pills-nurse-tab" data-toggle="pill" href="#d-pills-nurse" role="tab" aria-controls="d-pills-nurse" aria-selected="true"><i class="fa fa-user-md mr-3"></i>Nurses</a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <div class="col-10">
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
                                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your Email Address" maxlength="25" value="<?php echo $userInfo['email'] ?>" required>
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
                    <button class="btn btn-primary float-right" onclick="location.href='add-patient.php'"><i class="fa fa-user-plus"></i>Add user</button>
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
                                                    <a href='note-symptoms.php?user_id=<?php echo $row['user_id'] ?>'><i class="fas fa-id-card-alt" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                        </th>
                                        <th scope='row'>
                                            <div class="row">
                                                <div class="col">
                                                    <a href='edit.php?user_id=<?php echo $row["user_id"] ?>'><i class="fa fa-edit"></i></a>
                                                </div>
                                                <div class="col">
                                                    <a href="delete.php?user_id=<?php echo $row["user_id"] ?>'"><i class="fa fa-trash"></i></a>
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
                <div class="tab-pane fade" id="d-pills-nurse" role="tabpanel" aria-labelledby="d-pills-nurse-tab">
                    <div class="col">
                        <div class="tab-content" id="d-pills-tabContent">
                            <div class="tab-pane fade show active" id="d-pills-nurse" role="tabpanel" aria-labelledby="d-pills-nurse-tab">
                                <button class="btn btn-primary float-right" onclick="location.href='add-patient.php'"><i class="fa fa-user-plus"></i>Add user</button>
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
                                                        <div class="row">
                                                            <div class="col">
                                                                <a href='user-details.php?user_id=<?php echo $row['user_id'] ?>'><i class="fas fa-id-card-alt" aria-hidden="true"></i></a>
                                                            </div>
                                                            <div class="col">
                                                                <a href='note-symptoms.php?user_id=<?php echo $row['user_id'] ?>'><i class="fas fa-id-card-alt" aria-hidden="true"></i></a>
                                                            </div>
                                                        </div>
                                                    </th>
                                                    <th scope='row'>
                                                        <div class="row">
                                                            <div class="col">
                                                                <a href='edit.php?user_id=<?php echo $row["user_id"] ?>'><i class="fa fa-edit"></i></a>
                                                            </div>
                                                            <div class="col">
                                                                <a href="delete.php?user_id=<?php echo $row["user_id"] ?>'"><i class="fa fa-trash"></i></a>
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
    </div>
<?php
}
/* ------------------------------ End of Doctor Dashboard ------------------------------ */

/* ------------------------------ Admin Dashboard ------------------------------ */ 
else if (isset($_SESSION["userLoggedIn"]) && $userInfo["role_name"] == "Admin") {
?>

    <div class="row flex-row flex-nowrap" style="height:100vh; margin-right:0;">
        <div class="bg-dark mt-6">
            <div class="nav flex-column nav-pills" id="a-pills-tab" role="tablist">
                <nav class="sb-sidenav accordion text-white text-left" id="a-sidenavAccordion">
                    <div class="col-12 sb-sidenav-menu" style="min-width: 170px;">
                        <div class="col-12 sb-sidenav-footer pt-5">
                            <div class="small">Logged in as:</div>
                            <?php
                            echo $userInfo['first_name'] . " " . $userInfo['last_name'];
                            ?>
                        </div>
                        <div class="col-12 nav flex-column nav-pills text-white" id="a-pills-tab" role="tablist">
                            <a class="nav-link text-white" href="#a-pills-profile"></a>

                            <a class="nav-link active text-white mb-4" id="a-pills-profile-tab" data-toggle="pill" href="#a-pills-profile" role="tab" aria-controls="a-pills-profile" aria-controls="a-pills-profile" aria-selected="true"><i class="fa fa-user-circle mr-3"></i>Home</a>

                            <a class="nav-link text-white mb-4" id="a-pills-patient-tab" data-toggle="pill" href="#a-pills-patient" role="tab" aria-controls="a-pills-patient" aria-controls="a-pills-patient" aria-selected="true"><i class="fas fa-hospital-user mr-3"></i>Patients</a>

                            <a class="nav-link text-white mb-4" id="a-pills-nurse-tab" data-toggle="pill" href="#a-pills-nurse" role="tab" aria-controls="a-pills-patient" aria-controls="a-pills-nurse" aria-selected="true"><i class="fa fa-user-nurse mr-3"></i>Nurse</a>

                            <a class="nav-link text-white mb-4" id="a-pills-doctor-tab" data-toggle="pill" href="#a-pills-doctor" role="tab" aria-controls="a-pills-patient" aria-controls="a-pills-doctor" aria-selected="true"><i class="fa fa-user-md mr-3"></i>Doctor</a>

                        </div>
                    </div>
                </nav>
            </div>
        </div>

        <div class="col">
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
                                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your Email Address" maxlength="25" value="<?php echo $userInfo['email'] ?>" required>
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
                        <div class="tab-content" id="a-pills-tabContent">
                            <div class="tab-pane fade show active" id="a-pills-patient" role="tabpanel" aria-labelledby="a-pills-patient-tab">
                                <button class="btn btn-primary float-right" onclick="location.href='add-patient.php'"><i class="fa fa-user-plus"></i>Add user</button>
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
                                                        <a href='user-details.php?user_id=<?php echo $row['user_id'] ?>'><i class="fas fa-id-card-alt" aria-hidden="true"></i></a>
                                                    </th>
                                                    <th scope='row'>
                                                        <div class="row">
                                                            <div class="col">
                                                                <a href='edit.php?user_id=<?php echo $row["user_id"] ?>'><i class="fa fa-edit"></i></a>
                                                            </div>
                                                            <div class="col">
                                                                <a href="delete.php?user_id=<?php echo $row["user_id"] ?>'"><i class="fa fa-trash"></i></a>
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
                <div class="tab-pane fade" id="a-pills-nurse" role="tabpanel" aria-labelledby="a-pills-nurse-tab">
                    <div class="col">
                        <div class="tab-content" id="a-pills-tabContent">
                            <div class="tab-pane fade show active" id="a-pills-nurse" role="tabpanel" aria-labelledby="a-pills-nurse-tab">
                                <button class="btn btn-primary float-right" onclick="location.href='add-patient.php'"><i class="fa fa-user-plus"></i>Add user</button>
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
                                                                <a href="delete.php?user_id=<?php echo $row["user_id"] ?>'"><i class="fa fa-trash"></i></a>
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
                <div class="tab-pane fade" id="a-pills-doctor" role="tabpanel" aria-labelledby="a-pills-doctor-tab">
                    <div class="col">
                        <div class="tab-content" id="a-pills-tabContent">
                            <div class="tab-pane fade show active" id="a-pills-doctor" role="tabpanel" aria-labelledby="a-pills-doctor-tab">
                                <button class="btn btn-primary float-right" onclick="location.href='add-patient.php'"><i class="fa fa-user-plus"></i>Add user</button>
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
                                                                <a href="delete.php?user_id=<?php echo $row["user_id"] ?>'"><i class="fa fa-trash"></i></a>
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
    </div>
<?php
}
/* ------------------------------ End of Admin Dashboard ------------------------------ */

/* ------------------------------ Patient Dashboard ------------------------------*/ 
else if (isset($_SESSION["userLoggedIn"]) && $userInfo["role_name"] == "Patient") {
?>
    <div class="row flex-row flex-nowrap" style="height:100vh; margin-right:0;">
        <div class="bg-dark mt-6">
            <div class="nav flex-column nav-pills" id="p-pills-tab" role="tablist">
                <nav class="sb-sidenav accordion text-white text-left" id="p-sidenavAccordion">
                    <div class="col-12 sb-sidenav-menu" style="min-width: 170px;">
                        <div class="col-12 sb-sidenav-footer pt-5">
                            <div class="small">Logged in as:</div>
                            <?php
                            echo $userInfo['first_name'] . " " . $userInfo['last_name'];
                            ?>
                        </div>
                        <div class="col-12 nav flex-column nav-pills text-white" id="p-pills-tab" role="tablist">
                            <a class="nav-link active text-white mb-4" id="p-pills-profile-tab" data-toggle="pill" href="#p-pills-profile" role="tab" aria-controls="p-pills-profile" aria-controls="p-pills-profile" aria-selected="true"><i class="fa fa-user-circle mr-3"></i>Home</a>

                            <a class="nav-link text-white mb-4" id="p-pills-patient-tab" data-toggle="pill" href="#p-pills-patient" role="tab" aria-controls="p-pills-patient" aria-controls="p-pills-patient" aria-selected="true"><i class="fa fa-user mr-3"></i>My Records</a>

                            <a class="nav-link text-white mb-4" id="p-pills-nurse-tab" data-toggle="pill" href="#p-pills-nurse" role="tab" aria-controls="p-pills-patient" aria-controls="p-pills-nurse" aria-selected="true"><i class="fas fa-notes-medical mr-3"></i>Report</a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>

        <div class="col">
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
                                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your Email Address" maxlength="25" value="<?php echo $userInfo['email'] ?>" required>
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
                <div class="tab-pane fade show" id="p-pills-patient" role="tabpanel" aria-labelledby="p-pills-patient-tab">
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
                <div class="tab-pane fade" id="p-pills-nurse" role="tabpanel" aria-labelledby="p-pills-nurse-tab">
                    <div class="col">
                        <div class="tab-content" id="p-pills-tabContent">
                            <div class="tab-pane fade show active" id="p-pills-nurse" role="tabpanel" aria-labelledby="p-pills-nurse-tab">
                                <h5 class="text-center">Blank Page</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>

<?php
}
/* ------------------------------ End of Patient Dashboard ------------------------------*/

/* ------------------------------ If Not Logged In ------------------------------ */ 
else {
    //  if not logged in
    header("Location: login.php");
    print_r($_SESSION["userLoggedIn"]);
}
require_once('./includes/importsAfter.php');
?>
<script>
    $('.myTable').DataTable({
        pagingType: 'full_numbers',
        lengthMenu: [
            [5, 10, 20, 50, 100, -1],
            [5, 10, 20, 50, 100, "All"]
        ]
    });
</script>