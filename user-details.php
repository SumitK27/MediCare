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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.7/css/all.css">
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1><?php echo $userInfo["first_name"] . " " . $userInfo["last_name"] ?> Details</h1>
                </h1>
            </div>
            <div class="card-body">
                <div class="row">
                    <h3>Personal Details</h3>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="firstName">Name</label>
                        <input type="text" class="form-control" name="firstName" value="<?php echo $userInfo['first_name'] . " " . $userInfo['last_name'];?>">
                    </div>
                    <div class="col">
                        <label for="lastName">Last Name</label>
                        <input type="text" class="form-control" name="lastName" value="<?php echo $userInfo['last_name'] ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="mobileNumber">Mobile Number</label>
                        <input type="text" class="form-control" name="mobileNumber" value="1234567890">
                    </div>
                    <div class="col">
                        <label for="address">Address</label>
                        <textarea type="text" class="form-control" name="address">5th Street, ABC, YZ"</textarea>
                    </div>
                    <div class="col">
                        <label for="pinCode">Mobile Number</label>
                        <input type="text" class="form-control" name="pinCode" value="123456">
                    </div>
                </div>
                <hr>
                <div class="row">
                    <h3>Medical Details</h3>
                </div>

                <hr>
                <div class="row">
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