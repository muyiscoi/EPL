<?php
require_once 'includes/header.php';
echo "<div class='container col-md-offset-3 col-md-6 col-md-offset-3'>";
if(!isset($_GET['search']))
die ("Search Query not found");
$var = $_GET['search'];
$trimmed = trim($var);

if (!isset($var)){
echo "No search parameter";
exit;
}
if ($trimmed ==''){
$query = "SELECT * FROM publications";
echo "<h3>All Publications</h3>";
}
else {
$query = "SELECT * FROM publications WHERE title LIKE '%$trimmed%' OR abstract LIKE '%$trimmed%' ORDER BY title DESC";
echo "<h3>Search Query: <small><i>".$var."</i></small></h3>";
}
$result = queryMysql($query);
$rows = $result->num_rows;

if ($rows == 0){
echo "<h4>Sorry, search query provided no results. Please <a href='index.php'>try a different keyword</a> or use <a href='advanced.php'>Advanced search</a>";
}
else{
echo "<h4>Search Results </h4>
Didn't find what you're looking for? Try<a href='advanced.php'> Advanced Search</a><hr>";
}

for ($j = 0 ; $j < $rows ; ++$j){
$result->data_seek($j);
$row = $result->fetch_assoc();
$title = $row['title'];
$pub_id = $row['pub_id'];
$publisher = $row['publisher'];
$format = $row['format'];
$pubtype = $row['pub_type'];
$subject = $row['subject'];
echo "<h4><a href='viewpub.php?pubid=".$pub_id."'>".$title."</a></h4>";
$query1 = "SELECT * FROM pub_aut WHERE pub_id='$pub_id'";
$result1 = queryMysql($query1);
$rows1 = $result1->num_rows;
echo "<i>Author(s): </i>";
 for ($k = 0; $k < $rows1; ++$k) {
  $result1->data_seek($k);
  $row1 = $result1->fetch_assoc();
  $author_id = $row1['author_id'];
 $query2 = "SELECT * FROM authors WHERE author_id='$author_id';";
  $result2 = queryMysql($query2);
  $row2 = $result2->fetch_assoc();
  
  $firstname = $row2['firstName'];
  $lastname = $row2['lastName'];
  echo "<a href='viewauthors.php?author=".$author_id."'>".$firstname." ".$lastname." </a>";
  echo "/ ";
}
echo "<b>|</b> <i>Publisher: </i>".$publisher." <b>|</b> <i>Subject(s): </i>".$subject."<br> <i>Format:</i> ".$format."<i> <b>| Availability: </i>";
if ($row['public'] == 0){
echo "Users only</b>";
}
else {
echo "Publicly Available</b>";
}
echo "<hr>";
}
echo "</div>";
require_once 'includes/footer.php';
?>
