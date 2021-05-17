<title>Administrator's Dashboard</title>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">

<?php
    require_once('./includes/imports.php');
    require_once('./includes/components/navbar.php');
    require_once('./includes/config.php');
	require_once('./includes/classes/Account.php');

    $account = new Account($conn);
    // IF LOGGED IN AS DOCTOR, SHOW THE BELLOW HTML PAGE
	$getInfo = $account->getInfo();
	if (isset($_SESSION["userLoggedIn"]) && $isAdmin = $getInfo["name"] == "Admin") {
?>

<!-- Your Page -->
<div class="container">
	<?php 
		$rows = $account->getAllUsers();		
		/* Rows > 0 */
		if ($rows > 0) {
	?>
			<table id="table" class='table table-striped table-bordered table-hover table-condensed'>
				<thead class='thead-dark'>
					<tr>
						<th scope='col'>ID</th>
						<th scope='col'>First Name</th>
						<th scope='col'>Last ame</th>
						<th scope='col'>User Type</th>
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
							<th scope='row'> <?php echo $row['last_name'] ?> </th>>
							<th scope='row'> <?php echo $row['email'] ?> </th>
							<th scope='row'> 
								<button class="btn btn-primary" onclick="document.location='edit.php?user_id=<?php echo $row["user_id"] ?>'">Edit</button>
								<button class="btn btn-primary" onclick="document.location='delete.php?user_id=<?php echo $row["user_id"] ?>'">Delete</button>
							</th>
						</tr>
	<?php
					}
	?>
				</tbody>
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

<?php
    }
    else {
        header("location:index.php");
    }
    require_once('./includes/importsAfter.php');
?>