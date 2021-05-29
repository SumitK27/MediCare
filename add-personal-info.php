<?php
    require_once('./includes/imports.php');
    require_once('./includes/config.php');
    require_once('./includes/classes/Account.php');
    require_once('./includes/classes/Constants.php');
    
    $account = new Account($conn);
    
    $id = $_GET["user_id"];
    $userInfo = $account->getUser($id);
    require_once('./includes/components/navbar.php');
    
    if (isset($_POST['submit'])) {
        $aadhaar_no = FormSanitizer::sanitizeFormContact($_POST['aadhaarCard']);
        $mobile_no = FormSanitizer::sanitizeFormContact($_POST['mobileNo']);
        $address = FormSanitizer::sanitizeFormString($_POST["address"]);
        $dob = FormSanitizer::sanitizeFormDOB($_POST["dob"]);
        $gender = "";
    }

    $getInfo = $account->getInfo();
    if (isset($_SESSION["userLoggedIn"]) && $isAdmin = $getInfo["role_name"] == 'Admin' || 'Nurse' || 'Doctor') {
?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-xl-5 text-center p-0 mt-3 mb-2">
            <form action="" method="post">
                <input class="form-control" type="text" name="aadhaar_no" placeholder="Aadhaar Card No">
                <input class="form-control" type="tel" name="mobile_no" placeholder="Mobile No.">
                <input class="form-control" type="date" name="dob">
                <textarea class="form-control" name="address" cols="30" rows="3" placeholder="Address"></textarea>
                <input class="btn btn-primary" type="submit" value="Submit">
            </form>
        </div>
    </div>
</div>
<?php
    } else {

    }
?>