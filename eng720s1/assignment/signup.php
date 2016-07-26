<?php
require_once 'includes/header.php';

$error = $user = $pass = $class = '';
$class_id = 0;
$title = $firstname = $middlename = $lastname = '';
$query = "SELECT * FROM login WHERE username='$stduser'";
$result = queryMysql($query);
$row = $result->fetch_assoc();
$login_id = $row['login_id'];
$level_id = $row['level_id'];
if (!$loggedin || $level_id <3){
if (isset($_SESSION['user'])) destroySession();
}

if (isset($_POST['username'])) {
 $user = sanitizeString($_POST['username']);
 $pass = sanitizeString($_POST['password']);
 $title = sanitizeString($_POST['title']);
 $firstname = sanitizeString($_POST['firstname']);
 $middlename = sanitizeString($_POST['middlename']);
 $lastname = sanitizeString($_POST['lastname']);
 $email = sanitizeString($_POST['email']);
 $hash =  password_hash($pass,PASSWORD_DEFAULT);
if ($level_id >=3){
 $class = sanitizeString($_POST['class']);
}
 if ($class !=''){
   if ($class == 'Registered User'){
        $class_id = 0;
}
  if ($class == 'Student'){
        $class_id = 1;
}
  if ($class == 'Staff') {
        $class_id = 2;
}
  if ($class == 'Library Staff') {
        $class_id = 3;
}
}

  if ($user == '' || $pass == ''){
  $error = "Not all fields were entered<br><br>";
}
 $query = "SELECT * FROM login WHERE username='$user'";
 $result = queryMysql($query);
  if ($result->num_rows){
   echo "That username already exists<br><br>". "Please click <a href='login.php'> here</a> to login or <a href='signup.php'> here </a> to sign up";
die();
}
  else {
   $query = "INSERT INTO login (username,password,level_id) VALUES ('$user', '$hash','$class_id')";
   queryMysql($query);
   $loginid = $conn->insert_id;
  }
$query = "INSERT INTO user_info (title, firstName, middleName, lastName, login_id) VALUES ('$title', '$firstname', '$middlename', '$lastname', '$loginid')";

queryMysql($query);
$userid = $conn->insert_id;

$query1 = "INSERT INTO email (email_address,user_id) VALUES ('$email','$userid')";
queryMysql($query1);
if ($level_id >= 3){
header('location:manageusers.php?r=success');
}
else {
die ("User account <b>".$_POST['username']."</b> Created successfully. Please click <a href='login.php'> here </a> to login");
}
}
echo <<<_END
<div class="container col-md-offset-3 col-md-6 col-md-offset-3">
<h2> Create User account </h2>
    <form method="post" action="#">
<label for="title">Title </label>
<select class="form-control" id='title' name='title'>
<option> Mr. </option>
<option> Miss. </option>
<option> Mrs. </option>
<option> Dr. </option>
<option> Professor </option>
</select>
<div class="form-group">
<label for="firstname"> First Name </label>
<input type="text" name="firstname" id="firstname" required placeholder="Enter First name" class="form-control" />
<label for="middlename"> Middle Name </label>
<input type="text" name="middlename" id="middlename" placeholder="Enter Middle name" class="form-control" />
<label for="last"> Last Name </label>
<input type="text" name="lastname" id="lastname" required placeholder="Enter Last name" class="form-control" />
</div>
<div class="form-group">
<label for="last"> Email Address </label>
<input type="email" name="email" id="email" required placeholder="Enter email address" class="form-control" />
<label for="username"> Username </label>
<input type="text" name="username" id="username" required maxlenght="15" placeholder="Enter user name" class="form-control" />
<label for="password"> Password </label>
<input type="password" name="password" id="password" required placeholder="Enter Password" class="form-control" />
</div>
<div>
_END;
if ($level_id >=3){
echo "<label>Select User class</label><select class='form-control' name='class' id='class'>";
$query2 = "SELECT * FROM level";
$result2 = queryMysql($query2);
$rows2 = $result2->num_rows;
for ($j=0;$j<$rows2;$j++){
$result->data_seek($j);
$row2 = $result2->fetch_assoc();
echo "<option selected>".$row2['level']."</option>";
}
}
echo "</select><br>
<button style='float:right' class='btn btn-default'> Create Account </button>
</div>
</form>";



require_once 'includes/footer.php';
?>

