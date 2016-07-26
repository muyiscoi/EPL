<?php
require_once 'includes/header.php';
if ($loggedin) {
require_once 'includes/checklogin.php';
}
if ($_GET){
echo "<div class='container col-md-offset-3 col-md-6 col-md-offset-3'>";
$pub_id = $_GET['pubid'];
$query = "SELECT * FROM publications WHERE pub_id='$pub_id'";
$result = queryMysql($query);
$row = $result->fetch_assoc();
$url = $row['url'];
$public = $row['public'];
if ($loggedin && $level_id >= 3) {
echo "<a href='managepub.php'>Manage all Publications </a>";
}
else {
echo "<a href='index.php'>Search for another publication</a>";
}
echo" >> Viewing Publication<hr>";
echo "<h3> Viewing Publication: <small><i>".$row['title']." <b>(".$row['format'].")</b></small></i></h3>";
if ($loggedin || $public == 1){
echo "<p> <b> Title: </b>";
echo $row['title']." </p>";
echo "<p><b> Abstract: </b>". $row['abstract']." </p>";
echo "<p><b> Publisher: </b>". $row['publisher']." </p>";
echo "<p><b> Keyword(s): </b>". $row['subject']." </p>";
echo "<p><b> ISBN: </b>". $row['isbn']." </p>";
echo "<b> Date of Publication: </b>". $row['date']." </p>";
echo "<b> Publication Type: </b>". $row['pub_type']." </p>";
if ($row['pub_type'] == 'Journal'){
$query1 = "SELECT * FROM journals WHERE pub_id='$pub_id'";
$result1 = queryMysql($query1);
$row1 = $result1->fetch_assoc();
echo "<b> Journal Issue: </b>". $row1['issue']." </p>";
echo "<b> Journal Pages: </b>". $row1['pages_number']." </p>";
}
if ($row['pub_type'] == 'Research Report'){
$query1 = "SELECT * FROM res_report WHERE pub_id='$pub_id'";
$result1 = queryMysql($query1);
$row1 = $result1->fetch_assoc();
echo "<b> Start of Project: </b>". $row1['duration_start']." </p>";
echo "<b> End of Project: </b>". $row1['duration_end']." </p>";
}
if ($row['pub_type'] == 'Student Report'){
$query1 = "SELECT * FROM student_report WHERE pub_id='$pub_id'";
$result1 = queryMysql($query1);
$row1 = $result1->fetch_assoc();
echo "<b> Project Supervisor: </b>". $row1['supervisor']." </p>";
echo "<b> Supervisor Email: </b><a href='mailto:".$row1['supervisor_email']."'></a> </p>";
}
if ($row['pub_type'] == 'Conference Paper'){
$query1 = "SELECT * FROM conf_paper WHERE pub_id='$pub_id'";
$result1 = queryMysql($query1);
$row1 = $result1->fetch_assoc();
echo "<b> Conference Address </b>". $row1['conf_add']." </p>";
}
if ($row['pub_type'] == 'Other Publications'){
$query1 = "SELECT * FROM other WHERE pub_id='$pub_id'";
$result1 = queryMysql($query1);
$row1 = $result1->fetch_assoc();
echo "<b> Name of Publication Type: </b>". $row1['pub_type']." </p>";
}
$query2 = "SELECT * FROM pub_aut WHERE pub_id='$pub_id'";
$result2 = queryMysql($query2);
$rows = $result2->num_rows;
echo "<p><b> Author(s): </b>";
for ($j = 0 ; $j < $rows ; ++$j)
{
$result2->data_seek($j);
$row = $result2->fetch_assoc();
$author_id = $row['author_id'];
$query3 = "SELECT * FROM authors WHERE author_id='$author_id'";
$result3 = queryMysql($query3);
$row1 = $result3->fetch_assoc();
echo "<a href='viewauthors.php?author=".$author_id."'>".$row1['title'].' '.$row1['firstName'].' '.$row1['lastName']." </a></p>";
}
echo "<p><label>Availability: </label>";
if ($public == 0){
echo " <i> Users only </i>";
}
if ($public == 1){
echo " <i> Publicly available </i>";
}
echo "</p>";
$row2 = $result2->fetch_assoc();
if ($url != '') {
if ($loggedin || $public == 1){
echo "<form action='download.php' method='get'><button type='submit' name='id' class='btn btn-primary' style='float:right' value='".$pub_id."'>Download</button></form>";
}
else {
echo "<p>Please <a href='login.php?location=".urlencode($_SERVER['REQUEST_URI'])."'>Login </a> to download</p>";
}
}
}
else {
echo "<i><b>NOTE: </b>Sorry, This publication is only available to registered users. Please <a href='login.php?location=".urlencode($_SERVER['REQUEST_URI'])."'>Login </a> to view/download</i>";
}
echo "</div>";
}

require_once 'includes/footer.php';
?>
