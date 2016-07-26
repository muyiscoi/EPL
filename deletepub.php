<?php
require_once 'includes/header.php';
require_once 'includes/checklogin.php';

if ($_GET) {
	if ($_GET['edit'] != ''){
	$pub_id = $_GET['edit'];
}
}

if ($level_id > 1) {
 $query = "SELECT * FROM publications WHERE pub_id = '$pub_id'";
 $result = queryMysql($query);
 $row = $result->fetch_assoc();
 $owner = $row['user_id'];
 if ($owner == $user_id || $level_id >= 3 ){
  $query1 = "DELETE FROM publications WHERE pub_id = '$pub_id'";
  queryMysql($query1);
  $query2 = "DELETE FROM pub_aut WHERE pub_id = '$pub_id'";
  queryMysql($query2);
  $query3 = "DELETE FROM downloads WHERE pub_id ='$pub_id'";
  queryMysql($query3);
   if ($level_id >= 3){
  header('location:managepub.php?r=success');
  }
  else {
  header('location:userpage.php?r=success');
}
}
}
else {
 header('location:userpage.php?r=noauth');
}

?>
