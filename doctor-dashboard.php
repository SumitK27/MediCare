<title>Doctor's Dashboard</title>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">

<?php
    require_once('./includes/imports.php');
    require_once('./includes/components/navbar.php');
    require_once('./includes/config.php');
	require_once('./includes/classes/Account.php');

    $account = new Account($conn);
    // IF LOGGED IN AS DOCTOR, SHOW THE BELLOW HTML PAGE
	$getInfo = $account->getInfo();
	if (isset($_SESSION["userLoggedIn"]) && $isAdmin = $getInfo["name"] == "Doctor") {
?>

<!-- Your Page -->
You got the Access!

<?php
    }
    else {
        header("location:index.php");
    }
    require_once('./includes/importsAfter.php');
?>