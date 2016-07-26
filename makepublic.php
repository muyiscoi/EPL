<?php
require_once 'includes/header.php';
require_once 'includes/checklogin.php';

if ($level_id >=3) {
$pub_id = $_GET['pubid'];
$query = "SELECT * FROM publications WHERE pub_id = '$pub_id';";
$result = queryMysql($query);
$row = $result->fetch_assoc();
$public = $row['public'];
if ($public == 0){
$query1 = "UPDATE publications SET public = '1' WHERE pub_id = '$pub_id';";
}
else {
$query1 = "UPDATE publications SET public = '0' WHERE pub_id = '$pub_id';";
}
queryMysql($query1);
header('location:managepub.php?r=success');
}
else {
header('location:userpage.php?r=noauth');
}
?>

