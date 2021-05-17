<?php
    require_once('./includes/imports.php');
    require_once('./includes/config.php');
    require_once('./includes/classes/Account.php');
    require_once('./includes/classes/Constants.php');
    
    $account = new Account($conn);

    $id = $_GET["user_id"];

    $getInfo = $account->getInfo();
	if (isset($_SESSION["userLoggedIn"]) && $isAdmin = $getInfo["name"] == "Admin") {

		$id = $_GET["user_id"];

		// sql to delete a record
		$query = $conn->prepare("DELETE FROM users WHERE user_id=:id");
		$query->bindValue(":id", $id);
		$query->execute();
		

		if ($query->execute() === TRUE) {
			//echo "Record deleted successfully";
			header("location: dashboard.php");	//Redirect to previous page after success.
		} else {
			echo "Error deleting record: ";
		}
	} else {
		header("Location: index.php");
	}
?>