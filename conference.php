<?php
require_once 'includes/header.php';

echo "<div class='container col-md-offset-3 col-md-6 col-md-offset-3'>";
echo "<a href='#' onclick='history.back();'>Back</a><hr>".
    "<h2> All Conference Papers </h2>";

$query =  "SELECT * FROM publications WHERE pub_type='Conference Paper'";
$result = queryMysql($query);
echo "<table class='table table-condensed'><th>#</th><th>Title</th><th>Abstract</th><th>Availability</th>";
$rows = $result->num_rows;
for ($j = 0 ; $j < $rows ; ++$j)
{
$result->data_seek($j);
$num = $j+1;
$row = $result->fetch_assoc();
$pub_id = $row['pub_id'];
echo "<tr><td>".$num."</td>";
echo "<td><a title='View publication details' href='viewpub.php?pubid=".$pub_id."'>".$row['title']."</a></td>";
echo "<td>".$row['abstract']."</td>";
if ($row['public'] == 1){
echo "<td><i>Publicly Available</i></tr>";
}
if ($row['public'] == 0){
echo "<td><i>Users only</i></td></tr>";
}
}
echo "</tbody></table>";
require_once 'includes/footer.php';
?>
