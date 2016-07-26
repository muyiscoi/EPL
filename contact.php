<?php
require_once 'includes/header.php';
require_once 'includes/checklogin.php';
if ($level_id >= 3) {
	if ($_GET){
		if($_GET['user']){
	$user = $_GET['user'];
		}
	}
	if ($_POST){
		$title = sanitizeString($_POST['messagetitle']);
		$message = sanitizeString($_POST['message']);
		$query = "INSERT INTO messages (title,message,date,user_id) VALUES ('$title','$message',CURRENT_TIMESTAMP,'$user_id');";
		queryMysql($query);
		$message_id = $conn->insert_id;

		$query1 = "INSERT INTO message_user (message_id,user_id) VALUES ('$message_id','$user');";
		queryMysql($query1);
		header('location:manageusers.php?r=success');
		}
		$query2 = "SELECT * FROM user_info WHERE user_id = $user;";
		$result2 = queryMysql($query2);
		$row2 = $result2->fetch_assoc();
		$firstname = $row2['firstName'];
		$lastname = $row2['lastName'];

	echo "<div class='container col-md-offset-3 col-md-6 col-md-offset-3'>";
	echo "<a href='#' onclick='history.back();'>Back</a><hr>";
	echo "<div id='contact'>
	<h3>Contact user: <i>".$firstname." ".$lastname."</i></h3>

	<form action='contact.php?user=".$user."' method='post'>
	<label for='title'>Title</label>
	  <input type='text' name='messagetitle' placeholder='Enter message title' class='form-control' id='messagetitle'>
	<label for'body'>Message</label>
	<textarea class='form-control' name='message' id = 'message' placeholder='Enter message here'></textarea>
	<br><button type='submit' name='submit' name='contact' class='btn btn-primary' style='float:right' value='contact'>Send Message</button></form>
	</div><br><br><br><br>";


	require_once 'includes/footer.php';
}
else {
header('location:userpage.php?r=noauth');
}
?>

