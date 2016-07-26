<?php
require_once 'includes/header.php';
require_once 'includes/checklogin.php';

if ($_GET){
if($_GET['message']){
$message_id = $_GET['message'];
}
}
$query = "SELECT * FROM message_user WHERE message_id = '$message_id';";
$result = queryMysql($query);
$row = $result->fetch_assoc();
$user = $row['user_id'];

$query1 = "SELECT * FROM messages WHERE message_id = '$message_id';";
$result1 = queryMysql($query1);
$row1 = $result1->fetch_assoc();
$messageowner = $row1['user_id'];
$title = $row1['title'];
$message = $row1['message'];

if ($user_id == $user || $user_id == $messageowner){
$query7 = "SELECT * FROM user_info WHERE user_id='$messageowner';";
$result7 = queryMysql($query7);
$row7 = $result7->fetch_assoc();
$firstname = $row7['firstName'];
$lastname = $row7['lastName'];
$login_id = $row7['login_id'];

$query8 = "SELECT * FROM login WHERE login_id = '$login_id';";
$result8 = queryMysql($query8);
$row8 = $result8->fetch_assoc();
$level_id = $row8['level_id'];

$query9 = "SELECT * FROM level WHERE level_id = '$level_id';";
$result9 = queryMysql($query9);
$row9 = $result9->fetch_assoc();
$level = $row9['level'];

echo "<div class='container col-md-offset-3 col-md-6 col-md-offset-3'>
<a href='#' onclick='history.back();'>Back</a><hr>
<h3> Viewing Message from: ".$firstname." ".$lastname." (".$level.")</h3>
<h4><b>Title: </b>".$title."<br></h4>
<h4><b>Message: </b>".$message."</br></h4>
<a href='deletemessage.php?message=".$message_id."'> Delete Message </a>

";
}
else {
header('location:userpage.php?r=noauth');
}
require_once 'includes/footer.php';
?>

