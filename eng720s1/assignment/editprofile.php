<?php
require_once 'includes/header.php';
require_once 'includes/profile.php';
//preliminary block
if ($level_id >= 3) {
if ($_GET){
if ($_GET['user']){
 $user_id = $_GET['user'];
}
}
}
$query1 = "SELECT * FROM user_info WHERE user_id='$user_id'";
$result1 = queryMysql($query1);
$row1 = $result1->fetch_assoc();
$login_id = $row1['login_id'];
$query20 = "SELECT * FROM login WHERE login_id = '$login_id';";
$result20 = queryMysql($query20);
$row20 = $result20->fetch_assoc();
$username = $row20['username'];
	//personal info block
			//HTML
echo "<form method='post' action='editprofile.php'>".
	"<h2>Edit Profile for user: (".$username.")</h2>".
	"<hr><h3>Personal Information</h3><hr>".
	"<label for='title'>Title </label>".
	"<select class='form-control' id='title' name='title'>".
	"<option selected>".$row1['title']." </option>".
	"<option> Mr. </option>".
	"<option> Miss. </option>".
	"<option> Mrs. </option>".
	"<option> Dr. </option>".
	"<option> Professor </option></select>".
	"<div class='form-group'>".
	"<label for='firstname'> First Name </label>".
	"<input type='text' name='firstname' id='firstname' required value='".$row1['firstName']."' class='form-control' />".
	"<label for='middlename'> Middle Name </label>".
"<input type='text' name='middlename' id='middlename' value='".$row1['middleName']."' class='form-control' />".
	"<label for='last'> Last Name </label>".
	"<input type='text' name='lastname' id='lastname' required value='".$row1['lastName']."' class='form-control' />".
"<label for='dob'> Date of Birth </label>".
	"<input type='date' name='dob' id='dob' required value='".$row1['dob']."' class='form-control' /><hr>";
			//PHP
if($_POST){
//sanitizing text input
	//personal info variables
$title = sanitizeString($_POST['title']);
$firstname = sanitizeString($_POST['firstname']);
$middlename = sanitizeString($_POST['middlename']);
$lastname = sanitizeString($_POST['lastname']);
$dob = sanitizeString($_POST['dob']);
	//update personal details 
if ($title != $row1['title'] || $firstname != $row1['firstName'] || $middlename!= $row1['middleName'] || $lastname != $row1['lastName'] || $dob != $row1['dob']){//checking for changes
$query2 = "UPDATE user_info SET title = '$title', firstName = '$firstname', middleName = '$middlename', lastName = '$lastname', dob = '$dob' WHERE user_id = '$user_id';";
queryMysql($query2);
}
}
	//phone block
		//school
$query2 = "SELECT * FROM phone WHERE user_id='$user_id' AND type='school'";
$result2 = queryMysql($query2);
$rows2 = $result2->num_rows;
$row2 = $result2->fetch_assoc();
			//HTML
echo "<h3>Phone Numbers</h3><hr>".
"<label for='phoneschool'> Phone number: School</label>".
	"<input type='tel' name='phoneschool' id='phoneschool' required value='".$row2['phone_no']."' class='form-control' />";
		//home
$query3 = "SELECT * FROM phone WHERE user_id='$user_id' AND type='home'";
$result3 = queryMysql($query3);
$rows3 = $result3->num_rows;
$row3 = $result3->fetch_assoc();
			//HTML
echo "<label for='phonehome'> Phone number: Home</label>".
	"<input type='tel' name='phonehome' id='phonehome' value='".$row3['phone_no']."' class='form-control' />";
		//other
$query4 = "SELECT * FROM phone WHERE user_id='$user_id' AND type='other'";
$result4 = queryMysql($query4);
$rows4 = $result4->num_rows;
$row4 = $result4->fetch_assoc();
			//HTML
echo "<label for='phoneother'> Phone number: Other</label>".
	"<input type='tel' name='phoneother' id='phoneother' value='".$row4['phone_no']."' class='form-control' />";
			//PHP
if($_POST){
	//phone variables
$phoneschool = sanitizeString($_POST['phoneschool']);
$phonehome = sanitizeString($_POST['phonehome']);
$phoneother = sanitizeString($_POST['phoneother']);

if ($rows2 == 0) {
	if ($phoneschool !=''){
$query5 = "INSERT INTO phone (phone_no,type,user_id) VALUES ('$phoneschool','school','$user_id')";
queryMysql($query5);
}
}
else {
$query5 = "UPDATE phone SET phone_no = '$phoneschool' WHERE user_id = '$user_id' AND type='school'";
queryMysql($query5);
}
		//home phone
if ($rows3 == 0) {
	if ($phonehome != ''){
$query6 = "INSERT INTO phone (phone_no,type,user_id) VALUES ('$phonehome','home','$user_id')";
queryMysql($query6);
}
}
else {
$query6 = "UPDATE phone SET phone_no = '$phonehome' WHERE user_id = '$user_id' AND type='home'";
queryMysql($query6);
}
		//other phone
if ($rows4 == 0) {
	if ($phoneother!= ''){
$query7 = "INSERT INTO phone (phone_no,type,user_id) VALUES ('$phoneother','other','$user_id')";
queryMysql($query7);
}
}
else {
$query7 = "UPDATE phone SET phone_no = '$phoneother' WHERE user_id = '$user_id' AND type='other'";
queryMysql($query7);
}
}
	//end phone block
	//email block
		//school
$query8 = "SELECT * FROM email WHERE user_id='$user_id' AND type='school'";
$result8 = queryMysql($query8);
$rows8 = $result8->num_rows;
$row8 = $result8->fetch_assoc();
			//HTML
echo "<hr><h3>Email Addresses</h3><hr>".
"<label for='schoolemail'> Email Address: School</label>".
	"<input type='email' name='emailschool' id='emailschool' required value='".$row8['email_address']."' class='form-control' />";
		//home
$query9 = "SELECT * FROM email WHERE user_id='$user_id' AND type='home'";
$result9 = queryMysql($query9);
$rows9 = $result9->num_rows;
$row9 = $result9->fetch_assoc();
			//HTML
echo "<label for='homeemail'> Email Address: Home</label>".
	"<input type='email' name='emailhome' id='emailhome' value='".$row9['email_address']."' class='form-control' />";
		//other
$query10 = "SELECT * FROM email WHERE user_id='$user_id' AND type='other'";
$result10 = queryMysql($query10);
$rows10 = $result10->num_rows;
$row10 = $result10->fetch_assoc();
			//HTML
echo "<label for='otheremail'> Email Address: Other</label>".
"<input type='email' name='emailother' id='emailother' value='".$row10['email_address']."' class='form-control' /></div>";
			//PHP
if($_POST){
	//email variables
$emailschool = sanitizeString($_POST['emailschool']);
$emailhome = sanitizeString($_POST['emailhome']);
$emailother = sanitizeString($_POST['emailother']);

	//update email details
		//school email
if ($rows8 == 0) {
	if($emailschool != ''){
$query11 = "INSERT INTO email (email_address,type,user_id) VALUES ('$emailschool','school','$user_id');";
queryMysql($query11);
}
}
else {
$query11 = "UPDATE email SET email_address = '$emailschool' WHERE user_id = '$user_id' AND type='school';";
queryMysql($query11);
}
		//home email
if ($rows9 == 0) {
	if($emailhome != ''){
$query12 = "INSERT INTO email (email_address,type,user_id) VALUES ('$emailhome','home','$user_id')";
queryMysql($query12);
}
}
else {
$query12 = "UPDATE email SET email_address = '$emailhome' WHERE user_id = '$user_id' AND type= 'home'";
queryMysql($query12);
}
		//other email
if ($rows10 == 0) {
	if($emailother != ''){
$query13 = "INSERT INTO email (email_address,type,user_id) VALUES ('$emailother','other','$user_id')";
queryMysql($query13);
}
}
else {
$query13 = "UPDATE email SET email_address = '$emailother' WHERE user_id = '$user_id' AND type='other';";
queryMysql($query13);
}
header('Location: viewprofile.php');
}
	//end email block
	//Address block
"<h3>Address</h3><hr>";
		//school
$query14 = "SELECT * FROM address WHERE user_id='$user_id' AND type='school'";
$result14 = queryMysql($query14);
$rows14 = $result14->num_rows;
$row14 = $result14->fetch_assoc();
			//HTML
echo	"<h4>&emsp;School/Term Time Address </h4>".
"<label for='houseno'> House Number </label>".
	"<input type='text' name='housenoschool' id='housenoschool' required value='".$row14['house_no']."' class='form-control' />".
"<label for='street'> Street </label>".
	"<input type='text' name='streetschool' id='streetschool' required value='".$row14['street']."' class='form-control' />".
"<label for='city'> City </label>".
	"<input type='text' name='cityschool' id='cityschool' required value='".$row14['city']."' class='form-control' />".
"<label for='county'> County </label>".
	"<input type='text' name='countyschool' id='countyschool' required value='".$row14['county']."' class='form-control' />".
"<label for='country'> Country </label>".
	"<input type='text' name='countryschool' id='countryschool' required value='".$row14['country']."' class='form-control' />".
"<label for='postcode'> PostCode </label>".
	"<input type='text' name='postcodeschool' id='postcodeschool' required value='".$row14['postcode']."' class='form-control' />";
		//home
$query15 = "SELECT * FROM address WHERE user_id='$user_id' AND type='home'";
$result15 = queryMysql($query15);
$rows15 = $result15->num_rows;
$row15 = $result15->fetch_assoc();
			//HTML
echo "<hr><h4>&emsp;Home Address </h4>".
"<label for='houseno'> House Number </label>".
	"<input type='text' name='housenohome' id='housenohome' value='".$row15['house_no']."' class='form-control' />".
"<label for='street'> Street </label>".
	"<input type='text' name='streethome' id='streethome' value='".$row15['street']."' class='form-control' />".
"<label for='city'> City </label>".
	"<input type='text' name='cityhome' id='cityhome' value='".$row15['city']."' class='form-control' />".
"<label for='county'> County </label>".
	"<input type='text' name='countyhome' id='countyhome' value='".$row15['county']."' class='form-control' />".
"<label for='country'> Country </label>".
	"<input type='text' name='countryhome' id='countryhome' value='".$row15['country']."' class='form-control' />".
"<label for='postcode'> PostCode </label>".
	"<input type='text' name='postcodehome' id='postcodehome' value='".$row15['postcode']."' class='form-control' />".
"<div class='checkbox'></div>";
		//other
$query16 = "SELECT * FROM address WHERE user_id='$user_id' AND type='other'";
$result16 = queryMysql($query16);
$rows16 = $result16->num_rows;
$row16 = $result16->fetch_assoc();
			//HTML
echo "<hr><h4>&emsp;Other Address </h4>".
"<div>".
"<label for='houseno'> House Number </label>".
	"<input type='text' name='housenoother' id='housenoother' value='".$row16['house_no']."' class='form-control' />".
"<label for='street'> Street </label>".
	"<input type='text' name='streetother' id='streetother' value='".$row16['street']."' class='form-control' />".
"<label for='city'> City </label>".
	"<input type='text' name='cityother' id='cityother' value='".$row16['city']."' class='form-control' />".
"<label for='county'> County </label>".
	"<input type='text' name='countyother' id='countyother' value='".$row16['county']."' class='form-control' />".
"<label for='country'> Country </label>".
	"<input type='text' name='countryother' id='countryother' value='".$row16['country']."' class='form-control' />".
"<label for='postcode'> PostCode </label>".
	"<input type='text' name='postcodeother' id='postcodeother' value='".$row16['postcode']."' class='form-control' />".
"<div class='checkbox'></div>";
			//PHP
if($_POST){
	//School address variables
$housenoschool = sanitizeString($_POST['housenoschool']);
$streetschool = sanitizeString($_POST['streetschool']);
$cityschool = sanitizeString($_POST['cityschool']);
$countyschool = sanitizeString($_POST['countyschool']);
$countryschool = sanitizeString($_POST['countryschool']);
$postcodeschool = sanitizeString($_POST['postcodeschool']);
	//Home address variables
$housenohome = sanitizeString($_POST['housenohome']);
$streethome = sanitizeString($_POST['streethome']);
$cityhome = sanitizeString($_POST['cityhome']);
$countyhome = sanitizeString($_POST['countyhome']);
$countryhome = sanitizeString($_POST['countryhome']);
$postcodehome = sanitizeString($_POST['postcodehome']);
if (isset($_POST['homedelete'])){
echo $_POST['homedelete'];
}
	//other address variables
$housenoother = sanitizeString($_POST['housenoother']);
$streetother = sanitizeString($_POST['streetother']);
$cityother = sanitizeString($_POST['cityother']);
$countyother = sanitizeString($_POST['countyother']);
$countryother = sanitizeString($_POST['countryother']);
$postcodeother = sanitizeString($_POST['postcodeother']);
	//update address info
		//school address
if ($rows14 == 0){
$query17 = "INSERT INTO address (house_no,street,city,postcode,county,country,type,user_id) VALUES ('$housenoschool','$streetschool','$cityschool','$postcodeschool','$countyschool','$countryschool','school','$user_id');";
queryMysql($query17);
}
else {
$query17 = "UPDATE address SET house_no = '$housenoschool', street = '$streetschool', city = '$cityschool', postcode = '$postcodeschool', county = '$countyschool', country = '$countryschool' WHERE user_id = '$user_id' AND type = 'school';";
queryMysql($query17);
}
		//home address
if ($rows15 == 0){
	if ($housenohome != '' && $streethome != '' && $cityhome !='' && $countyhome !='' && $countryhome !='' && $postcodehome != ''){
$query18 = "INSERT INTO address (house_no,street,city,postcode,county,country,type,user_id) VALUES ('$housenohome','$streethome','$cityhome','$postcodehome','$countyhome','$countryhome','home','$user_id');";
queryMysql($query18);
}
}
else {
$query18 = "UPDATE address SET house_no = '$housenohome', street = '$streethome', city = '$cityhome', postcode = '$postcodehome', county = '$countyhome' , country = '$countryhome' WHERE user_id = '$user_id' AND type= 'home';";
queryMysql($query18);
}
		//other address
if ($rows16 == 0){
	if ($housenoother != '' && $streetother != '' && $cityother !='' && $countyother !='' && $countryother !='' && $postcodeother != ''){
$query19 = "INSERT INTO address (house_no,street,city,postcode,county,country,type,user_id) VALUES ('$housenoother','$streetother','$cityother','$postcodeother','$countyother','$countryother','other','$user_id');";
queryMysql($query19);
}
}
else {
$query19 = "UPDATE address SET house_no = '$housenoother', street = '$streetother', city = '$cityother', postcode = '$postcodeother', county = '$countyother' ,country = '$countryother' WHERE user_id = '$user_id' AND type= 'other';";
queryMysql($query19);
}
}
	//end address block
//HTML button
echo "<br><button style='float:right' class='btn btn-default'> Update Profile </button></form><br><br><br><br><br>";
require_once 'includes/footer.php';
?>
