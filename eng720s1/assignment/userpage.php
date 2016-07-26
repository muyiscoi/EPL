<?php
error_reporting(0);
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

   echo "<label>Class of user: </label><i> ".$level."</i> | <label>Total downloads: </label><i> ".$count."</i><br><label> Downloads remaining: </label><i> ".$rem."</i> | ";
if ($level_id > 0){ echo "<label> No of publications uploaded: </label><i> ".$uploaded."</i>";}
echo"<br> <a href='changepass.php'>Change Password</a></div></div></div>";
if ($level_id < 3 && $level_id > 0){
echo "<div><div class='panel panel-default'>".
  	"<div class='panel-heading'><h3 class='panel-title'>My Publications".
"</h3></div><div>";
if ($rows3 == 0) {
echo "You have not uploaded any publications";
}
else {
if ($level_id > 1) {
echo "<table class='table table-fixed'><thead><tr><th class='col-xs-2'>S/N</th><th class='col-xs-4'>Title</th><th class='col-xs-3'>Date Added </th><th class='col-xs-1'>Edit</th><th class='col-xs-2'>Delete</th></tr></thead><tbody>";
}
else {
echo "<table class='table table-fixed'><thead><tr><th class='col-xs-2'>S/N</th><th class='col-xs-6'>Title</th><th class='col-xs-4'>Date Added </th></tr></thead><tbody>";
}
for($j = 0; $j<$rows3; ++$j) 
{
$result3->data_seek($j);
$num = $j+1;
$row3 = $result3->fetch_assoc();
$date_added = explode(' ',$row3['date_added']);

if ($level_id > 1) {
echo "<tr><td class='col-xs-2'>".$num."</td><td class='col-xs-4'><a href='viewpub.php?pubid=".$row3['pub_id']."'>".$row3['title']."</a></td> <td class='col-xs-3'>".$date_added[0]."</td><td class='col-xs-1'><a href='editpub.php?edit=".$row3['pub_id']."'><span class='glyphicon glyphicon-edit' title='Click to edit publication.' aria-hidden='true'></span></a></td>
<td class='col-xs-2'><a href='deletepub.php?edit=".$row3['pub_id']."'onclick='return confirm(\"Are you sure you want to delete this publication: ".$row3['title']."?\")'><span class='glyphicon glyphicon-trash' title='Click to delete publication.' aria-hidden='true'></span></a></td></tr>";
}
else {
echo "<tr><td class='col-xs-2'>".$num."</td><td class='col-xs-4'><a href='viewpub.php?pubid=".$row3['pub_id']."'>".$row3['title']."</a></td> <td class='col-xs-3'>".$date_added[0]."</td>";
}
}
  echo "</tbody></table></div></div></div>";
}
}
if ($level_id == 3){
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

echo "<div><div class='panel panel-default'>
  <div class='panel-heading'><h3 class='panel-title'>Website Statistics
</h3></div><div>
<h4>Publications</h4>
<label> Total Number of publications: </label><i> ".$rows4." </i> |
<label> Publicly available: </label><i> ".$rows5." </i> |
<label> Total Downloads: </label><i>".$rows6." </i> 
<br><a href='managepub.php'>Manage Publications </a>
<h4> Users </h4>
<label> Total Number of users: </label><i> ".$rows7." </i> | 
<label> Number of active users:  </label>";
$active = $notactive = 0;
for($i=0;$i<$rows7;$i++){
$result7->data_seek($i);
$row7 = $result7->fetch_assoc();
if ($row7['block'] == 0){
$active = $active+1;
}
else {
$notactive = $notactive+1;
}
}
echo " ".$active." |
<label> Number of blocked users: </label> ".$notactive."
<br><a href='manageusers.php'>Manage Users </a>
</div></div></div>";
}
echo "</div>";
require_once 'includes/footer.php';
?>
