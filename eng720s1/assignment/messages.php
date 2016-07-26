<?php
require_once 'includes/header.php';
require_once 'includes/profile.php';
if ($_GET){
	if($_GET['r']=='noauth'){
	echo "<div class='alert alert-warning' role='alert'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
Sorry, You are not authorized to do that</div>";
}
	if($_GET['r']=='success'){
	echo "<div class='alert alert-success' role='alert'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
Operation Successful!</div>";
}
}
if ($level_id >= 3){
$query5 = "SELECT * FROM messages WHERE user_id = '$user_id' ORDER BY date DESC;";
$result5 = queryMysql($query5);
$rows5 = $result5->num_rows;
if ($rows5 > 0){
echo "<h3>My Sent messages</h3>";
echo "<div class='list-group'>";

for($i=0; $i<$rows5; $i++){
$result5->data_seek($i);
$row5 = $result5->fetch_assoc();
$title = $row5['title'];
$message = $row5['message'];
$message_id = $row5['message_id'];
$query6 = "SELECT * FROM message_user WHERE message_id='$message_id';";
$result6 = queryMysql($query6);
$row6 = $result6->fetch_assoc();
$user = $row6['user_id'];

$query7 = "SELECT * FROM user_info WHERE user_id='$user';";
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

echo "<a href='viewmessage.php?message=".$message_id."' class='list-group-item'>
    <h4 class='list-group-item-heading'>".$title."</h4>
    <p class='list-group-item-text'>".$message."</p>
	<footer>Sent to: ".$firstname." ".$lastname." (".$level.") on ".$row5['date']."</footer>
  </a>";
}
echo "</div>";
}
else {
echo "<i>You have not sent any messages</i><br>";
}
}
$query = "SELECT * FROM message_user WHERE user_id='$user_id';";
$result = queryMysql($query);
$rows = $result->num_rows;
if ($rows > 0){
echo "<h3>Messages Recieved</h3>";
echo "<div class='list-group'>";

for($j=0;$j<$rows;$j++){
$result->data_seek($j);
$row = $result->fetch_assoc();
$message_id = $row['message_id'];

$query1 = "SELECT * FROM messages WHERE message_id='$message_id' ORDER BY date DESC;";
$result1 = queryMysql($query1);
$rows1 = $result1->num_rows;
for($k=0;$k<$rows1;$k++){
$result1->data_seek($k);
$row1 = $result1->fetch_assoc();
$title = $row1['title'];
$message = $row1['message'];
$user = $row1['user_id'];

$query2 = "SELECT * FROM user_info WHERE user_id='$user';";
$result2 = queryMysql($query2);
$row2 = $result2->fetch_assoc();
$firstname = $row2['firstName'];
$lastname = $row2['lastName'];
$login_id = $row2['login_id'];

$query3 = "SELECT * FROM login WHERE login_id = '$login_id';";
$result3 = queryMysql($query3);
$row3 = $result3->fetch_assoc();
$level_id = $row3['level_id'];

$query4 = "SELECT * FROM level WHERE level_id = '$level_id';";
$result4 = queryMysql($query4);
$row4 = $result4->fetch_assoc();
$level = $row4['level'];

echo "<a href='viewmessage.php?message=".$message_id."' class='list-group-item'>
    <h4 class='list-group-item-heading'>".$title."</h4>
    <p class='list-group-item-text'>".$message."</p>
	<footer>Sent from: ".$firstname." ".$lastname." (".$level.") on ".$row5['date']."</footer>
  </a>";
}
}
echo "</div>";
}
else {
echo "<i>You have not recieved any messages</i>";
}


require_once 'includes/footer.php';
?>

</body>
</html>
