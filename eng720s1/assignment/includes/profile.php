<?php
require_once 'includes/header.php';
require_once 'includes/checklogin.php';
//nav
$GLOBALS['home'] = $home;
$url = $_SERVER['REQUEST_URI'];
$array = explode ('/', $url);
$page = $array[2];
$home = '';
$profile = '';
if ($page == 'userpage.php' || $page == 'userpage.php?r=noauth' || $page == 'userpage.php?r=success'){
$home = "class = 'active'";
}
else {
$home = '';
}
if ($page == 'viewprofile.php' || $page =='editprofile.php'){
$profile = "class = 'active'";
}
else {
$profile = '';
}
if ($page =='messages.php' || $page =='messages.php?r=noauth' || $page =='messages.php?r=success'){
$messages = "class = 'active'";
}
else {
$messages = '';
}
if ($page =='managepub.php' || $page =='managepub.php?r=noauth' || $page =='managepub.php?r=success'){
$managepub = "class = 'active'";
}
else {
$managepub = '';
}
if ($page == 'manageusers.php' || $page == 'manageusers.php?r=noauth' || $page == 'manageusers.php?r=noauth'){
$manageuser = "class = 'active'";
}
else {
$manageuser = '';
}

$query5 = "SELECT * FROM message_user WHERE user_id='$user_id';";
$result5 = queryMysql($query5);
$rows5 = $result5->num_rows;
	//HTML
echo "<div class='container col-md-offset-2 col-md-8 col-md-offset-2'>";
echo "<h3> Welcome <i>".$stduser." (".$level.")</i> </h3>";
echo "<ul class='nav nav-tabs'>".
  "<li role='presentation'".$home."><a href='userpage.php'>Home</a></li>".
  "<li role='presentation'".$profile."><a href='viewprofile.php'>Profile</a></li>";
if ($level_id == 3){
echo "<li role='presentation'".$managepub."><a href='managepub.php'>Manage Publications</a></li>
<li role='presentation'".$manageuser."><a href='manageusers.php'>Manage Users</a></li>";
  if($rows5 > 0){
echo "<li role='presentation'".$messages."><a href='messages.php'>Messages (".$rows5.")</a></li></ul>";
}
else {
echo "<li role='presentation'".$messages."><a href='messages.php'>Messages </a></li></ul>";
}
}
else {
 if($rows5 > 0){
echo "<li role='presentation'".$messages."><a href='messages.php'>Messages (".$rows5.")</a></li></ul>";
}
else {
echo "<li role='presentation'".$messages."><a href='messages.php'>Messages </a></li></ul>";
}
}
?>
