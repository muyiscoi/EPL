<?php
require_once 'includes/header.php';
require_once 'includes/checklogin.php';
if ($_GET){
if ($_GET['message']){
$message_id = $_GET['message'];
}
}
echo $message_id."<br>";
echo $user_id;
$query = "SELECT * FROM message_user WHERE message_id = '$message_id';";
$result = queryMysql($query);
$row = $result->fetch_assoc();
$user = $row['user_id'];

$query1 = "SELECT * FROM messages WHERE message_id = '$message_id';";
$result1 = queryMysql($query1);
$row1 = $result1->fetch_assoc();
$messageowner = $row1['user_id'];

if ($user_id == $user || $user_id == $messageowner){
$query2 = "DELETE from message_user WHERE message_id = '$message_id';";
$query3 = "DELETE from messages WHERE message_id = '$message_id';";
queryMysql($query2);
queryMysql($query3);
  header('location:messages.php?r=success');
}
else {
  header('location:messages.php?r=noauth');
}
?>

