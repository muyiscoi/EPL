<?php
require_once 'includes/header.php';

echo "<div class='container col-md-offset-3 col-md-6 col-md-offset-3'>".
    "<h2> Browse by Authors </h2>";

$query =  "SELECT * FROM authors";
$result = queryMysql($query);
echo "<table class='table table-condensed'><th>#</th><th>Name</th><th>Institution</th><th>Publication(s)</th>";
$rows = $result->num_rows;
for ($j = 0 ; $j < $rows ; ++$j)
{
$result->data_seek($j);
$num = $j+1;
$row = $result->fetch_assoc();
$author_id = $row['author_id'];
echo "<tr><td>".$num."</td>";
echo "<td><a href='viewauthors.php?author=".$author_id."'>".$row['title']." ".$row['firstName']." ".$row['middleName']." ".$row['lastName']."</a></td>";
echo "<td>".$row['institution']."</td>";
$query2 = "SELECT * FROM pub_aut WHERE author_id='$author_id'";
$result2 = queryMysql($query2);
$rows2 = $result2->num_rows;
echo "<td>";
for ($j1 = 0 ; $j1 < $rows2 ; ++$j1)
{
$result2->data_seek($j);
$row2 = $result2->fetch_assoc();
$pub_id = $row2['pub_id'];
$query3 = "SELECT * FROM publications WHERE pub_id='$pub_id'";
$result3 = queryMysql($query3);
$row1 = $result3->fetch_assoc();
echo "<a href=viewpub.php?pubid=".$pub_id.">".$row1['title']."</a><br/>";
}
echo "</td>";
}
echo "</tbody></table>";
require_once 'includes/footer.php';
?>
