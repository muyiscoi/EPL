<?php
require_once 'includes/header.php';
echo "
<div class='container col-md-offset-3 col-md-6 col-md-offset-3'>";
if ($_GET){
if ($_GET['location'] != ''){
  $location = $_GET['location'];
  echo "<div class='alert alert-danger' role='alert'>
      <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
  You cannot view this page as guest. Please login to continue</div>";
  }
$block = 1;
}
   if ($_POST){
    $user = sanitizeString($_POST['username']);
    $pass = sanitizeString($_POST['password']);
    if ($user == '' || $pass == ''){
    echo "<div class='alert alert-danger' role='alert'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
    You have to enter both username and password to login</div>";
   }
   else {
    $query = "SELECT username,password,count,block FROM login WHERE username='$user'";
    $result = queryMysql($query);
    $row = $result->fetch_assoc();
    $rows = $result->num_rows;
    $count = $row['count'];
    $block = $row['block'];
    $hash = $row['password'];
   }
   if (password_verify($pass,$hash) && $block == 0) {
    $_SESSION['user'] = $user;
    if ($count == 0){
    $count = $count+1;
    $query2 = "UPDATE login SET count='$count' WHERE username='$user'";
    queryMysql($query2);
     if ($location != ''){
     header("location:".$location);
    }
    header('location:editprofile.php');
   }
   else {
    $count = $count+1;
    $query2 = "UPDATE login SET count='$count' WHERE username='$user'";
    queryMysql($query2);
     if ($location != ''){
     header("location:".$location);
    }
   else {
    header("location:userpage.php");
   }
  }
 }
 else {
  if ($rows == 0 || !password_verify($pass,$hash)){
  echo "<div class='alert alert-danger' role='alert'>
      <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
  Sorry, Username or password is not correct.</div>";
}
 if ($block == 1) {
echo "<div class='alert alert-danger' role='alert'>
      <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
  Sorry, This account has been suspended. Please contact Administrator.</div>";
} 
}
}
echo "<h2> Login </h2>
    <form method='post' action='#'>
<div class='form-group'>
<label for='username'> Username </label>
<input type='text' name='username' id='username' required maxlenght='15' placeholder='Enter user name' class='form-control' />
<label for='password'> Password </label>
<input type='password' name='password' id='password' required placeholder='Enter Password' class='form-control' />
</div>
<div>
<button style='float:right' class='btn btn-default'> Login </button>
</div></form>";
require_once 'includes/footer.php';
?>
