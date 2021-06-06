<?php
require_once('./includes/imports.php');
require_once('./includes/config.php');
require_once('./includes/classes/Account.php');
$account = new Account($conn);
$userInfo = $account->getInfo();
require_once('./includes/components/navbar.php');
require_once('./includes/importsAfter.php');
?>
<title>About</title>