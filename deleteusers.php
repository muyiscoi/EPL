<?php
require_once 'includes/header.php';
require_once 'includes/checklogin.php';

if ($_GET) {
	if ($_GET['user'] != ''){
	$user_id = $_GET['user'];
}
}

if ($level_id >= 3) {
 deleteuser($user_id);
 header ('location:manageusers.php?r=success');
}
else {
 header('location:userpage.php?r=noauth');
}
?>

