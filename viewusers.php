<?php
require_once 'includes/header.php';
require_once 'includes/checklogin.php';
if ($level_id >= 3){
if ($_GET){
	if($_GET['user'] != ''){
	$user_id = $_GET['user'];
}
}
$query8 = "SELECT * FROM user_info WHERE user_id = '$user_id';";
$result8 = queryMysql($query8);
$row8 = $result8->fetch_assoc();
$login_id = $row8['login_id'];


$query = "SELECT * FROM login WHERE login_id= '$login_id';";
$result = queryMysql($query);
$row = $result->fetch_assoc();
$level_id = $row['level_id'];
$username = $row['username'];
$block = $row['block'];

$query1 = "SELECT * FROM level WHERE level_id=$level_id;";
$result1 = queryMysql($query1);
$row1 = $result1->fetch_assoc();
$level = $row1['level'];
$max_downloads = $row1['max_downloads'];

echo "<div class='container col-md-offset-2 col-md-8 col-md-offset-2'>";
echo "<a href='#' onclick='history.back();'>Back</a><hr>";
echo "<h3> Viewing User: <i>(".$username.") </i></h3>";
if ($block == 1){
echo "<div class='alert alert-warning' role='alert'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
Note: This User account is suspended</div>";
}
else {
echo "<div class='alert alert-success' role='alert'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
User account is active</div>";
}
echo "<br><div><div class='panel panel-default'>".
  	"<div class='panel-heading'><h3 class='panel-title'>User details".
"</h3></div><div>";

$query2 = "SELECT * FROM download_count WHERE user_id=$user_id;";
$result2 = queryMysql($query2);
$row2 = $result2->fetch_assoc();
$count = $row2['count'];

$rem = $max_downloads - $count;

$query3 = "SELECT * FROM publications WHERE user_id=$user_id ORDER BY date_added DESC;";
$result3 = queryMysql($query3);
$rows3 = $result3->num_rows;
$uploaded = $rows3;

   echo "<label>Class of user: </label><i> ".$level."</i> <b>|</b> 
<label> Total downloads: </label><i> ".$count."</i> <b>|</b>
<label> Downloads remaining: </label><i> ".$rem."</i> <b>|</b>
<label> No of publications uploaded: </label><i> ".$uploaded."</i><br>";
$query20 = "SELECT * FROM user_info WHERE user_id='$user_id'";
$result20 = queryMysql($query20);
$row20 = $result20->fetch_assoc();
echo "<hr><a href='admineditprofile.php?user=".$user_id."'>Edit Profile</a>
<h4>User Profile</h4>

<p><b>Full Name: </b>".$row20['title']." ".$row20['firstName']." ".$row20['middleName']." ".$row20['lastName'].
" <b> | Date of Birth: </b>";
if($row20['dob']==0){
echo "none";
}
else{
echo $row20['dob']."</p>";
	}
echo "<h4>Address</h4>".
//school 

"<h4>Term Time/School </h4>";
$query2 = "SELECT * FROM address WHERE user_id='$user_id' AND type='school'";
$result2 = queryMysql($query2);
$rows2 = $result2->num_rows;
$row2 = $result2->fetch_assoc();
if ($rows2 == 0){
echo "No address info found";
}
else {
echo "<p>No. ".$row2['house_no']." ".$row2['street'].", ".$row2['city'].", ".$row2['county'].", ".$row2['country'].". <b>Postcode: </b>".$row2['postcode'];
}

//school email
$query21 = "SELECT * FROM email WHERE user_id='$user_id' AND type='school'";
$result21 = queryMysql($query21);
$rows21 = $result21->num_rows;
$row21 = $result21->fetch_assoc();
if ($row21['email_address'] != '') {
echo "<p><b>Email Address: </b><a href='mailto: ".$row21['email_address']."'>".$row21['email_address']."</a></p>";
}

//school phone
$query4 = "SELECT * FROM phone WHERE user_id='$user_id' AND type='school'";
$result4 = queryMysql($query4);
$rows4 = $result4->num_rows;
$row4 = $result4->fetch_assoc();
if ($row4['phone_no'] != '') {
echo "<p><b>Phone Number: </b>".$row4['phone_no']."</p>";
}

//home
echo "<h4>Home </h4>";
$query5 = "SELECT * FROM address WHERE user_id='$user_id' AND type='home'";
$result5 = queryMysql($query5);
$rows5 = $result5->num_rows;
$row5 = $result5->fetch_assoc();
if ($rows5 == 0){
echo "No address info found";
}
else {
echo "<p>No. ".$row5['house_no']." ".$row5['street'].", ".$row5['city'].", ".$row5['county'].", ".$row5['country'].". <b>Postcode: </b>".$row5['postcode'];
}
//home email
$query6 = "SELECT * FROM email WHERE user_id='$user_id' AND type='home'";
$result6 = queryMysql($query6);
$rows6 = $result6->num_rows;
$row6 = $result6->fetch_assoc();
if ($row6['email_address'] != '') {
echo "<p><b>Email Address: </b><a href='mailto: ".$row6['email_address']."'>".$row6['email_address']."</a></p>";
}
//home phone
$query7 = "SELECT * FROM phone WHERE user_id='$user_id' AND type='home'";
$result7 = queryMysql($query7);
$rows7 = $result7->num_rows;
$row7 = $result7->fetch_assoc();
if ($row7['phone_no'] != '') {
echo "<p><b>Phone Number: </b>".$row7['phone_no']."</p>";
}



//other
echo "<h4>Other </h4>";
$query8 = "SELECT * FROM address WHERE user_id='$user_id' AND type='other'";
$result8 = queryMysql($query8);
$rows8 = $result8->num_rows;
$row8 = $result8->fetch_assoc();
if ($rows8 == 0 ){
echo "No address info found";
}
else {
echo "<p>No. ".$row8['house_no']." ".$row8['street'].", ".$row8['city'].", ".$row8['county'].", ".$row8['country'].". <b>Postcode: </b>".$row8['postcode'];
}

//other email
$query9 = "SELECT * FROM email WHERE user_id='$user_id' AND type='other'";
$result9 = queryMysql($query9);
$rows9 = $result9->num_rows;
$row9 = $result9->fetch_assoc();
if ($row9['email_address'] != '') {
echo "<p><b>Email Address: </b><a href='mailto: ".$row9['email_address']."'>".$row9['email_address']."</a></p>";
}
//other phone
$query10 = "SELECT * FROM phone WHERE user_id='$user_id' AND type='other'";
$result10 = queryMysql($query10);
$rows10 = $result10->num_rows;
$row10 = $result10->fetch_assoc();
if ($row10['phone_no'] != '') {
echo "<p><b>Phone Number: </b>".$row10['phone_no']."</p>";
}
echo "</div></div>


<div><div class='panel panel-default'>


<div class='panel-heading'><h3 class='panel-title'> Publications added by User: ". $row8['firstName']."</h3></div><div>";
if ($rows3 == 0) {
echo "User has not uploaded any publication";
}
else {
echo "<table class='table table-fixed'><thead><tr><th class='col-xs-2'>S/N</th><th class='col-xs-4'>Title</th><th class='col-xs-3'>Date Added </th><th class='col-xs-1'>Edit</th><th class='col-xs-2'>Delete</th></tr></thead><tbody>";
for($j = 0; $j<$rows3; ++$j) 
{
$result3->data_seek($j);
$num = $j+1;
$row3 = $result3->fetch_assoc();
$date_added = explode(' ',$row3['date_added']);

echo "<tr><td class='col-xs-2'>".$num."</td><td class='col-xs-4'><a href='viewpub.php?pubid=".$row3['pub_id']."'>".$row3['title']."</a></td> <td class='col-xs-3'>".$date_added[0]."</td>";
if ($level_id > 1) {
echo "<td class='col-xs-1'><a href='editpub.php?edit=".$row3['pub_id']."'> Edit</a></td>
<td class='col-xs-2'><a href='deletepub.php?edit=".$row3['pub_id']."'> Delete</a></td></tr>";
}

}
  echo "</tbody></table></div></div></div>";
}
$query4 = "SELECT * FROM publications";
$result4 = queryMysql($query4);
$rows4 = $result4->num_rows;

$query5 = "SELECT * FROM publications WHERE public = 1";
$result5 = queryMysql($query5);
$rows5 = $result5->num_rows;

$query6 = "SELECT * FROM downloads";
$result6 = queryMysql($query6);
$rows6 = $result6->num_rows;

$query7 = "SELECT * FROM login";
$result7 = queryMysql($query7);
$rows7 = $result7->num_rows;
}
else {
header('location:userpage.php?r=noauth');
}
echo "</div>";
require_once 'includes/footer.php';
?>
