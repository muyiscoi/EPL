<?php
require_once 'includes/header.php';
require_once 'includes/profile.php';
echo "<p><h3>Personal Information</h3>".
"<a style='text-align: right' role='button' href='editprofile.php'>Update profile </a></p><hr>";
echo "<p><b>Full Name: </b>".$row1['title']." ".$row1['firstName']." ".$row1['middleName']." ".$row1['lastName'].
"</p>".
"<p><b>Date of Birth: </b>";
if($row1['dob']==0){
echo "none";
}
else{
echo $row1['dob']."</p>";
	}
echo "<hr><h3>Address</h3><hr>".
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
$query3 = "SELECT * FROM email WHERE user_id='$user_id' AND type='school'";
$result3 = queryMysql($query3);
$rows3 = $result3->num_rows;
$row3 = $result3->fetch_assoc();
if ($row3['email_address'] != '') {
echo "<p><b>Email Address: </b><a href='mailto: ".$row3['email_address']."'>".$row3['email_address']."</a></p>";
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
require_once 'includes/footer.php';
?>
