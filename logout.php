<?php
	session_start();
	unset($_SESSION['userLoggedIn']);
	setcookie('email', '', time() - 3600);
	setcookie('password', '', time() - 3600);
	header("location:index.php");
?>