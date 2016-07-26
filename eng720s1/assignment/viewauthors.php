<?php
require_once 'includes/header.php';
echo "<div class='container col-md-offset-3 col-md-6 col-md-offset-3'>";
if ($_GET){
$author_id = $_GET['author'];
$query = "SELECT * FROM authors WHERE author_id='$author_id'";
$result = queryMysql($query);
$row = $result->fetch_assoc();
echo "<h3> Viewing Author:<small> <i>".$row['firstName']." ".$row['lastName']."</small></i></h3>";
echo "<p> <b> Author Name: </b>";
echo $row['title']." ".$row['firstName']." ".$row['lastName']." </p>";
echo "<p><b> Email Address: </b>". $row['email']." </p>";
echo "<p><b> Phone Number: </b>". $row['phone']." </p>";
echo "<p><b> Institution: </b>". $row['institution']." </p>";
echo "<b> Postal Address: </b>". $row['postalAddress']." </p>";
$query2 = "SELECT * FROM pub_aut WHERE author_id='$author_id'";
$result2 = queryMysql($query2);
$rows = $result2->num_rows;
echo "<p><b> Publications(s): </b></p>";
for ($j = 0 ; $j < $rows ; ++$j)
{
$result2->data_seek($j);
$row = $result2->fetch_assoc();
$pub_id = $row['pub_id'];
$query3 = "SELECT * FROM publications WHERE pub_id='$pub_id'";
$result3 = queryMysql($query3);
$row1 = $result3->fetch_assoc();
echo "<p><a href=viewpub.php?pubid=".$pub_id.">".$row1['title']."</a><br />";
}
}
else {
die('Sorry, no author info found! :(');
}
echo "</p>";
require_once 'includes/footer.php';
?>
