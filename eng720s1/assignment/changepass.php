<?php
require_once 'includes/header.php';
require_once 'includes/checklogin.php';
echo "<div class='container col-md-offset-2 col-md-8 col-md-offset-2'>";
echo "<h3>Change Password for user: ".$stduser."</h3>
<br><br><br>
<form method='post' action='changepass.php'>
<div>
<div class='col-xs-2'><b>New Password</b></div>
<div class='col-xs-4'><input required type='password' class='form-control' name='newpass' id='newpass' placeholder='Enter New password'></div>
<div class='col-xs-2'><b>Confirm New Password</b></div>
<div class='col-xs-4'><input required type='password' class='form-control' name='newpass2' id='newpass2' placeholder='Enter New password again'></div><br>
<br><br><div><button type='submit' class='btn btn-primary' style='float:right'>Change Password</button></div></div></form>";

if($_POST) {
if ($_POST['newpass'] != $_POST['newpass2']){
echo "Sorry, two passwords don't match";
}
else {
$password = sanitizeString($_POST['newpass']);
$hash =  password_hash($password,PASSWORD_DEFAULT);
$query = "UPDATE login SET password='$hash' WHERE login_id = $login_id";
queryMysql($query);
destroySession();
die("Password changed successfully. Please <a href='login.php'>Login with new password");
}
}
require_once 'includes/footer.php';
?>

