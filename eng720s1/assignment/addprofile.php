<?php
require_once 'includes/header.php';
$query = "SELECT * FROM login WHERE username='$stduser'";
$result = queryMysql($query);
$row = $result->fetch_assoc();
$login_id = $row['login_id'];
$query1 = "SELECT * FROM user_info WHERE login_id='$login_id'";
$result1 = queryMysql($query1);
$row1 = $result1->fetch_assoc();
$user_id = $row1['user_id'];
$query2 = "SELECT * FROM address WHERE user_id='$user_id'";
$result2 = queryMysql($query2);
$rows2 = $result2->num_rows;
$row2 = $result2->fetch_assoc();

if($_POST){
$title = sanitizeString($_POST['title']);
$firstname = sanitizeString($_POST['firstname']);
$middlename = sanitizeString($_POST['middlename']);
$lastname = sanitizeString($_POST['lastname']);
$dob = sanitizeString($_POST['dob']);
$houseno = sanitizeString($_POST['houseno']);
$street = sanitizeString($_POST['street']);
$city = sanitizeString($_POST['city']);
$county = sanitizeString($_POST['county']);
$country = sanitizeString($_POST['country']);
$postcode = sanitizeString($_POST['postcode']);
echo $title. $firstname. $middlename.$user_id.$houseno.$country;
$query3 = "UPDATE user_info SET title = '$title', firstName = '$firstname', middleName = '$middlename', lastName = '$lastname', dob = '$dob' WHERE user_id = '$user_id';"; //something wrong with these queries. look into it
$query4 = "INSERT INTO address (house_no,street,city,postcode,county,country,user_id) VALUES ('$houseno','$street','$city','$postcode','$county','$country','$user_id');";
queryMysql($query3);
queryMysql($query4);
}
echo "<div class='container col-md-offset-3 col-md-6 col-md-offset-3'>";
echo "<h3> Welcome <i>".$stduser."</i> </h3>";
echo "<ul class='nav nav-tabs'>".
  "<li role='presentation' ><a href='userpage.php'>Home</a></li>".
  "<li role='presentation' class='active'><a href='#'>Profile</a></li>".
  "<li role='presentation'><a href='#'>Messages</a></li></ul>";
if(!$_GET){
echo "<h4>Personal Information</h4>";
echo "<p><b>Full Name: </b>".$row1['title']." ".$row1['firstName']." ".$row1['middleName']." ".$row1['lastName'].
"</p>".
"<p><b>Date of Birth: </b>";
if($row1['dob']==0){
echo "none";
}
else{
echo $row1['dob']."</p>";
	}
echo "<hr><h4>Address</h4>";
if ($rows2 == 0){
echo "No address info found";
}
else {
echo "<p>No. ".$row2['house_no']." ".$row2['street'].", ".$row2['city'].", ".$row2['county'].", ".$row2['country'].". <b>Postcode: </b>".$row2['postcode'];
}
echo "<hr><a style='text-align: right' role='button' href='userprofile.php?p=edit'>Update profile </a>";
}
if ($_GET){
//personal information bit
echo "<form method='post' action='userprofile.php'>".
	"<h4>Personal Information</h4>".
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
"<input type='text' name='middlename' id='middlename' required value='".$row1['middleName']."' class='form-control' />".
	"<label for='last'> Last Name </label>".
	"<input type='text' name='lastname' id='lastname' required value='".$row1['lastName']."' class='form-control' />".
"<label for='dob'> Date of Birth </label>".
	"<input type='date' name='dob' id='dob' required value='".$row1['dob']."' class='form-control' /><hr> <button style='float:right' class='btn btn-default'> Update Profile </button></form>";
//address bit
	echo "<h4>Address</h4>".
"<label for='houseno'> House Number </label>".
	"<input type='text' name='houseno' id='houseno' required value='".$row2['house_no']."' class='form-control' />".
"<label for='street'> Street </label>".
	"<input type='text' name='street' id='street' required value='".$row2['street']."' class='form-control' />".
"<label for='city'> City </label>".
	"<input type='text' name='city' id='city' required value='".$row2['city']."' class='form-control' />".
"<label for='county'> County </label>".
	"<input type='text' name='county' id='county' required value='".$row2['county']."' class='form-control' />".
"<label for='country'> Country </label>".
	"<input type='text' name='country' id='country' required value='".$row2['country']."' class='form-control' />".
"<label for='postcode'> PostCode </label>".
	"<input type='text' name='postcode' id='postcode' required value='".$row2['postcode']."' class='form-control' /><hr>".
"<h4> Change Password </h4>".
"<label for='username'> Username </label>".
"<input type='text' name='username' id='username' required maxlenght='15' disabled value='".$stduser."' class='form-control' />".
"<label for='newpassword'> New Password </label>".
"<input type='password' name='newpassword' id='newpassword' placeholder='leave blank to retain existing password' class='form-control' />".
"<label for='newpassword2'> Re-enter new Password </label>".
"<input type='password' name='newpassword2' id='newpassword2' placeholder='leave blank to retain existing password' class='form-control' /></div><div>".
"<button style='float:right' class='btn btn-default'> Update Profile </button></div></form>";
}
require_once 'includes/footer.php';
?>

