<?php
session_start();
echo "<!DOCTYPE html>\n<html lang='en'>\n<head>";
require_once 'functions.php';
$stduser = ' (Guest)';

if (isset($_SESSION['user'])) {
$user = $_SESSION['user'];
$loggedin = TRUE;
$stduser = $user;
}
else $loggedin = FALSE;
echo "<title>$sitename | $stduser</title>".
"<script src='js/jquery-1.11.3.min.js'></script>".
"<script src='js/bootstrap.min.js'></script>".
"<script src='js/custom.js'></script>".
"<link rel='stylesheet' href='css/custom.css'>".
"<link rel='stylesheet' href='css/bootstrap.min.css'></head>";
echo "<body><nav class='navbar navbar-default'>".
	"<div class='container-fluid'>".
	"<div class='navbar-header'>".
        "<button type='button' class='navbar-toggle' data-toggle='collapse' data-target='#mainNavBar'>".
        "<span class='icon-bar'></span>".
        "<span class='icon-bar'></span>".
        "<span class='icon-bar'></span>".
              "</button>".
      "<a href='index.php' class='navbar-brand'>EPL</a>".
    "</div>".
    "<div class='collapse navbar-collapse' id='mainNavBar'>".
      "<ul class='nav navbar-nav'>".
        "<li class='active'><a href='index.php'> Home </a></li>".
        #dropdown menu
        "<li class='dropdown'>".
          "<a href='#' class='dropdown-toggle' data-toggle='dropdown'>Browse Publications<span class='caret'></span></a>".
          "<ul class='dropdown-menu'>".
            "<li><a href='journals.php'> Journals </a></li>".
            "<li><a href='studentreport.php'> Student Reports </a></li>".
            "<li><a href='conference.php'> Conference Papers</a></li>".
            "<li><a href='research.php'> Research Papers </a></li>".
            "<li><a href='other.php'> Other Papers </a></li>".
          "</ul></li>".
            "<li><a href='authors.php'> Browse Authors</a></li>".
		"<li><a href='about.php'>About EPL</a></li></ul>";
      #right nav
if ($loggedin) {
$query = "SELECT * FROM login WHERE username='$stduser'";
$result = queryMysql($query);
$row = $result->fetch_assoc();
$login_id = $row['login_id'];
$level_id = $row['level_id'];
$block = $row['block'];
if ($level_id > 0) {
echo "<ul class='nav navbar-nav navbar-right'>".
"<li><a href='addpub.php'> Add Publications</a></li>";
  if ($level_id >= 3){
echo "<li><a href='userpage.php'>Admin Panel</a></li>";
}
else {
echo "<li><a href='userpage.php'>User Profile</a></li>";
}
   echo "<li ><a href='logout.php'> Logout(".$stduser.") </a></li></ul></div></div></nav>";
}
else {
echo "<ul class='nav navbar-nav navbar-right'>";
echo "<li><a href='userpage.php'>User Profile</a></li>";
echo "<li ><a href='logout.php'> Logout(".$stduser.") </a></li></ul></div></div></nav>";
}
}
else {
echo "<ul class='nav navbar-nav navbar-right'>".
   "<li ><a href='login.php'> Login </a></li>".
   "<li ><a href='signup.php'> Register </a></li></ul></div></div></nav>";
}
?>

