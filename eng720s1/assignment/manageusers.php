<?php
error_reporting(0);
require_once 'includes/header.php';
require_once 'includes/profile.php';

if ($_GET){
 if ($_GET['r']) {
  if ($_GET['r'] == 'success'){
 echo "<div class='alert alert-success' role='alert'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Operation successful!</div>";
}
}
 if ($_GET['pass']) {
 $password = $_GET['pass'];
 echo "<div class='alert alert-success' role='alert'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Password reset successful!. New password: <b>".$password."</b></div>";
}
}
if ($level_id == 3){
echo "<h3> Manage Users </h3><a href='signup.php'>Add new user</a>";
echo "<div><form id='custom-search-form' class='form-search form-horizontal pull-right' action='manageusers.php' method='post'>
                <div class='input-append span12'>
                    <input type='text' name='search' id='search' class='search-query' placeholder='Search'>
                    <button type='submit' class='btn'><i><span class='glyphicon glyphicon-search' aria-hidden='true'></span></i></button>
                </div>
            </form></div><br>";
echo "<div class='row'>
<div class='panel panel-default'>
  <div class='panel-heading'>
  <h3 class='panel-title'>All Users</h3></div><div>
<table class='table table-fixed'><thead><tr>
<th class='col-xs-1'>S/N</th>
<th class='col-xs-1'>Username</th>
<th class='col-xs-2'>Full Name</th>
<th class='col-xs-2'>User Class </th>
<th class='col-xs-2'>Reset Pass</th>
<th class='col-xs-2'>Contact User</th>
<th class='col-xs-1'>Suspend</th>
<th class='col-xs-1'>Delete</th></tr></thead><tbody style='height: 350px;'>";
if ($_POST) {
$search = sanitizeString($_POST['search']);
$query4 = "SELECT * FROM user_info WHERE firstName LIKE '%$search%' OR middleName LIKE '%$search%' OR lastName LIKE '%$search%'";
$result4 = queryMysql($query4);
$rows4 = $result4->num_rows;
}
else {
$query4 = "SELECT * FROM user_info";
$result4 = queryMysql($query4);
$rows4 = $result4->num_rows;
}

for($j = 0; $j<$rows4; ++$j) 
{
$result4 ->data_seek($j);
$num = $j+1;
$row4 = $result4->fetch_assoc();
$login_id = $row4['login_id'];
$query5 = "SELECT * FROM login WHERE login_id = '$login_id';";
$result5 = queryMysql($query5);
$row5 = $result5->fetch_assoc();
$block = $row5['block'];
$level_id = $row5['level_id'];
$query6 = "SELECT * FROM level WHERE level_id = '$level_id';";
$result6 = queryMysql($query6);
$row6 = $result6->fetch_assoc();
$level = $row6['level'];
echo "
<tr><td class='col-xs-1'>".$num."</td>
<td class='col-xs-1'><a href='viewusers.php?user=".$row4['user_id']."' title='click to view details about user'>".$row5['username']."</a></td>
<td class='col-xs-2'>".$row4['firstName']." ".$row4['middleName']." ".$row4['lastName']." (<a href='admineditprofile.php?user=".$row4['user_id']."'>Edit</a>)</td></td> 
<td class='col-xs-2'>";
echo "$level"."<br>(<a href='changeclass.php?user=".$row4['user_id']."'>Change class</a>)</td>";
echo "<td class='col-xs-2'><a href='resetpass.php?user=".$row4['user_id']."'onclick='return confirm(\"Are you sure you want to reset password for user ".$row5['username']."?\")'><span class='glyphicon glyphicon-refresh' title='Click here to reset password' aria-hidden='true'></span></a></td>
<td class='col-xs-2'><a href='contact.php?user=".$row4['user_id']."'><span class='glyphicon glyphicon-envelope' title='Click to contact user' aria-hidden='true'></span></a></td>
<td class='col-xs-1'><a href='blockuser.php?user=".$row4['user_id'];

if ($block == 0){
echo "'onclick='return confirm(\"Are you sure you want to block user ".$row5['username']."?\")'<span class='glyphicon glyphicon-pause' title='user is active. click here to suspend.' aria-hidden='true'></span>";
}
else {
echo "'onclick='return confirm(\"Are you sure you want to unblock user ".$row5['username']."?\")'<span class='glyphicon glyphicon-play-circle' title='user is suspended. click here to activate' aria-hidden='true'></span>";
}
echo "</a></td>
<td class='col-xs-1'><a href='deleteusers.php?user=".$row4['user_id']."'onclick='return confirm(\"Are you sure you want to delete user ".$row5['username']."?\")'><span class='glyphicon glyphicon-trash' title='Click here to delete user account completely' aria-hidden='true'></span></a></td></tr>";

}
  echo "</tbody></table></div></div></div>";
}
else {
header('location:userpage.php?r=noauth');
}
require_once 'includes/footer.php';
?>
