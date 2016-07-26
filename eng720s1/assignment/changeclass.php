<?php
require_once 'includes/header.php';
require_once 'includes/checklogin.php';
echo "<div class='container col-md-offset-2 col-md-8 col-md-offset-2'>";
if ($_GET){
if ($_GET['user']){
$user_id = $_GET['user'];
}
}
if ($level_id >= 3){
$query = "SELECT * FROM user_info WHERE user_id='$user_id';";
$result = queryMysql($query);
$row = $result->fetch_assoc();
$login_id = $row['login_id'];
$firstname = $row['firstName'];
$lastname = $row['lastName'];

$query3 = "SELECT * FROM login WHERE login_id='$login_id';";
$result3 = queryMysql($query3);
$row3 = $result3->fetch_assoc();
$levelid_old = $row3['level_id'];
$username = $row3['username'];

$query4 = "SELECT * FROM level WHERE level_id = '$levelid_old';";
$result4 = queryMysql($query4);
$row4 = $result4->fetch_assoc();
$level_old = $row4['level'];
if ($_POST){
$newlevel = $_POST['level'];
echo $newlevel;
$query1 = "SELECT * FROM level WHERE level = '$newlevel'";
$result1 = queryMysql($query1);
$row1 = $result1->fetch_assoc();
$newlevelno = $row1['level_id'];
echo $newlevelno;
$query21 = "UPDATE login SET level_id='$newlevelno' WHERE login_id='$login_id'";
queryMysql($query21);
header('location:manageusers.php?r=success');
}
}
else {
header('location:userpage.php?=noauth');
}

echo "<div class='form-group'><form action='changeclass.php?user=".$user_id."' method='post'>
<div col-xs-6><h4>Change User Class for user: ".$firstname." ".$lastname." (".$username.") </h4></div>
<div col-xs-6><select class='form-control' id='level' name='level'>";
$query11 = "SELECT * FROM level";
$result11 = queryMysql($query11);
$rows11 = $result11->num_rows;
for ($i=0;$i<$rows11;$i++){
$result11->data_seek($i);
$row11 = $result11->fetch_assoc();
if ($level_old == $row11['level']) {
echo "<option selected>".$row11['level']."</option>";
}
else{
echo "<option>".$row11['level']."</option>";
}
}

echo "</select></div></div><button type='submit' name='submit' class='btn btn-primary' style='float:right' value='next'>Change Class</button></form>

<br><br>";
?>

