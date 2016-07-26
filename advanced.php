<?php
require_once 'includes/header.php';
echo "<div class='container col-xs-offset-2 col-xs-8 col-xs-offset-2'>";
echo "<a href='#' onclick='history.back();'>Back</a><hr>";
echo "<h3>Advanced Search</h3><i>Enter atleast one search criteria.</i>";

echo "<form method='post' action='advanced.php#search'>
<div class='col-xs-2'><b>Title</b></div>
<div class='col-xs-4'><input type='text' class='form-control' name='title' id='title' placeholder='Search by title' ></div>
<div class='col-xs-2'><b>Abstract</b></div>
<div class='col-xs-4'><input type='text' class='form-control' name='abstract' id='abstract' placeholder='Search by abstract' ></div></div>";
echo "<div><br></div><div class='container col-xs-offset-2 col-xs-8 col-xs-offset-2'>
<div class='col-xs-2'><b>Author</b></div>
<div class='col-xs-4'><input type='text' class='form-control' name='author' id='author' placeholder='Search by author' ></div>
<div class='col-xs-2'><b>Publication Type</b></div>
<div class='col-xs-4'><select class='form-control' id='pub_type' name='pub_type'><option selected>All</option><option>Journal</option><option>Research Report</option><option>Student Report</option><option>Conference Paper</option><option>Other Publications</option></select></div></div>";
echo "<div><br></div><div class='container col-xs-offset-2 col-xs-8 col-xs-offset-2'>
<div class='col-xs-2'><b>Format</b>
</div><div class='col-xs-4'><select class='form-control' id='format' name='format'><option selected>All</option><option>Electronic</option><option>Printed</option></select></div>
<div class='col-xs-2'><b>Subjects</b>
</div><div class='col-xs-4'><input type='text' class='form-control' name='subject' id='subject' placeholder='Search by keywords'></div>
<div class='col-xs-2'><b>ISBN</b></div>
<div class='col-xs-4'><input type='text' class='form-control' name='isbn' id='isbn' placeholder='Search by ISBN'></div>
  <div col-xs-12>&nbsp;</div><br>
<div><button type='submit' class='btn btn-primary' style='float:right'>Search</button></div></div>
</form>";
echo "<div class='container col-md-offset-3 col-md-6 col-md-offset-3'>";

if($_POST) {
echo "<h4>Search Results </h4>";
$title = trim(sanitizeString($_POST['title']));
$abstract = trim(sanitizeString($_POST['abstract']));
$author = trim(sanitizeString($_POST['author']));
$pub_type = trim(sanitizeString($_POST['pub_type']));
$format = trim(sanitizeString($_POST['format']));
$subject = trim(sanitizeString($_POST['subject']));
$isbn = trim(sanitizeString($_POST['isbn']));

if ($author != ''){
$query1 = "SELECT * FROM authors WHERE firstName LIKE '%$author%' OR middleName LIKE '%$author%' OR lastName LIKE '%$author%';";
$result1 = queryMysql($query1);
$rows1 = $result1->num_rows;
for ($k=0;$k<$rows1;$k++){
$result1->data_seek($k);
$row1 = $result1->fetch_assoc();
$author_id=$row1['author_id'];
$query2 = "SELECT * FROM pub_aut WHERE author_id='$author_id';";
$result2 = queryMysql($query2);
$rows2 = $result2->num_rows;
for ($l=0;$l<$rows2;$l++){
$result2->data_seek($l);
$row2 = $result2->fetch_assoc();
$pub_id = $row2['pub_id'];
$query3 = "SELECT * FROM publications WHERE pub_id='$pub_id';";
$result3 = queryMysql($query3);
$rows3 = $result3->num_rows;
for ($i=0;$i<$rows3;$i++){
$result3->data_seek($i);
$row3= $result3->fetch_assoc();
echo "<h4><a href='viewpub.php?pubid=".$pub_id."'>".$row3['title']."</a></h4>";
$query1 = "SELECT * FROM pub_aut WHERE pub_id='$pub_id'";
echo "<i>Author(s): </i>";
$firstname = $row1['firstName'];
  $lastname = $row1['lastName'];
$pub_type = $row3['pub_type'];
$subject = $row3['subject'];
$format = $row3['format'];
echo "<a href='viewauthors.php?author=".$author_id."'>".$firstname." ".$lastname." </a>";
  echo "/ ";
echo "<b>|</b> <i>Publication Type: </i>".$pub_type." <b>|</b> <i>Subject(s): </i>".$subject."<br> <i>Format:</i> ".$format;
echo "<hr>";
}
}
}
}

if ($title == '' && $abstract == '' && $pub_type == 'All' && $subject == '' && $isbn == ''){
if ($format == 'All'){
$query = "SELECT * FROM publications;";
}
else {
$query = "SELECT * FROM publications WHERE format= '$format';";
}
}
if ($title == '' && $abstract == '' && $pub_type == 'All' && $subject == '' && $format !='All'  && $isbn == ''){

$query = "SELECT * FROM publications WHERE format = '$format'";
}

if ($title != '' && $abstract == '' && $pub_type == 'All' && $subject == ''  && $isbn == ''){
if ($format == 'All'){
$query = "SELECT * FROM publications WHERE title LIKE '%$title%';";
}
else {
$query = "SELECT * FROM publications WHERE title LIKE '%$title%' AND format = '$format';";
}
}
if ($title == '' && $abstract != '' && $pub_type == 'All' && $subject == ''  && $isbn == ''){
if ($format == 'All'){
$query = "SELECT * FROM publications WHERE abstract LIKE '%$abstract%';";
}
else{
$query = "SELECT * FROM publications WHERE abstract LIKE '%$abstract%' AND format = '$format';";
}
}
if ($title == '' && $abstract == '' && $pub_type != 'All' && $subject == ''  && $isbn == ''){
if ($format == 'All'){
$query = "SELECT * FROM publications WHERE pub_type = '$pub_type';";
}
else {
$query = "SELECT * FROM publications WHERE pub_type = '$pub_type' AND format = '$format';";
}
}
if ($title == '' && $abstract == '' && $pub_type == 'All' && $subject != ''  && $isbn == ''){
if ($format == 'All'){
$query = "SELECT * FROM publications WHERE subject LIKE '%$subject%';";
}
else {
$query = "SELECT * FROM publications WHERE subject LIKE '%$subject%' AND format = '$format';";
}
}
if ($title == '' && $abstract == '' && $pub_type == 'All' && $subject == ''  && $isbn != ''){
if ($format == 'All'){
$query = "SELECT * FROM publications WHERE isbn LIKE '%$isbn%';";
}
else {
$query = "SELECT * FROM publications WHERE isbn LIKE '%$isbn%' AND format = '$format';";
}
}
if ($title != '' && $abstract != '' && $pub_type == 'All' && $subject == '' && $isbn == ''){
if ($format == 'All'){
$query = "SELECT * FROM publications WHERE title LIKE '%$title%' AND abstract LIKE '%$abstract%';";
}
else {
$query = "SELECT * FROM publications WHERE title LIKE '%$title%' AND abstract LIKE '%$abstract%' AND format = '$format';";
}
}
if ($title != '' && $abstract == '' && $pub_type != 'All' && $subject == ''  && $isbn == ''){
if ($format == 'All'){
$query = "SELECT * FROM publications WHERE title LIKE '%$title%' AND pub_type LIKE '%$pub_type%';";
}
else {
$query = "SELECT * FROM publications WHERE title LIKE '%$title%' AND pub_type LIKE '%$pub_type%' AND format = '$format';";
}
}
if ($title != '' && $abstract == '' && $pub_type != 'All' && $subject != ''  && $isbn == ''){
if ($format == 'All'){
$query = "SELECT * FROM publications WHERE title LIKE '%$title%' AND pub_type LIKE '%$pub_type%' AND subject LIKE '%$subject%';";
}
else {
$query = "SELECT * FROM publications WHERE title LIKE '%$title%' AND pub_type LIKE '%$pub_type%' AND format = '$format' AND subject LIKE '%$subject%';";
}
}

if ($title != '' && $abstract == '' && $pub_type == 'All' && $subject != '' && $isbn == ''){
if ($format == 'All'){
$query = "SELECT * FROM publications WHERE title LIKE '%$title%' AND subject LIKE '%$subject%';";
}
else {
$query = "SELECT * FROM publications WHERE title LIKE '%$title%' AND subject LIKE '%$subject%' AND format = '$format';";
}
}
if ($title != '' && $abstract == '' && $pub_type == 'All' && $subject == ''  && $isbn != ''){
if ($format == 'All'){
$query = "SELECT * FROM publications WHERE title LIKE '%$title%' AND isbn LIKE '%$isbn%';";
}
else {
$query = "SELECT * FROM publications WHERE title LIKE '%$title%' AND isbn LIKE '%$isbn%' AND format = '$format';";
}
}
if ($title == '' && $abstract != '' && $pub_type != 'All' && $subject == '' &&  $isbn == ''){
if ($format == 'All'){
$query = "SELECT * FROM publications WHERE abstract LIKE '%$abstract%' AND pub_type LIKE '%$pub_type%';";
}
else {
$query = "SELECT * FROM publications WHERE abstract LIKE '%$abstract%' AND pub_type LIKE '%$pub_type%' AND format = '$format';";
}
}
if ($title == '' && $abstract != '' && $pub_type == 'All' && $subject != '' &&  $isbn == ''){
if ($format == 'All'){
$query = "SELECT * FROM publications WHERE abstract LIKE '%$abstract%' AND subject LIKE '%$subject%';";
}
else {
$query = "SELECT * FROM publications WHERE abstract LIKE '%$abstract%' AND subject LIKE '%$subject%' AND format = '$format';";
}
}
if ($title == '' && $abstract != '' && $pub_type == 'All' && $subject == ''  && $isbn != ''){
if ($format == 'All'){
$query = "SELECT * FROM publications WHERE abstract LIKE '%$abstract%' AND isbn LIKE '%$isbn%';";
}
else {
$query = "SELECT * FROM publications WHERE abstract LIKE '%$abstract%' AND isbn LIKE '%$isbn%' AND format = '$format';";
}
}
if ($title == '' && $abstract == '' && $pub_type != 'All' && $subject != '' &&  $isbn == ''){
if ($format == 'All'){
$query = "SELECT * FROM publications WHERE pub_type LIKE '%$pub_type%' AND subject LIKE '%$subject%';";
}
else {
$query = "SELECT * FROM publications WHERE pub_type LIKE '%$pub_type%' AND subject LIKE '%$subject%' AND format = '$format';";
}
}
if ($title == '' && $abstract == '' && $pub_type != 'All' && $subject == '' &&  $isbn != ''){
if ($format == 'All'){
$query = "SELECT * FROM publications WHERE pub_type LIKE '%$pub_type%' AND isbn LIKE '%$isbn%';";
}
else {
$query = "SELECT * FROM publications WHERE pub_type LIKE '%$pub_type%' AND isbn LIKE '%$isbn%' AND format = '$format';";
}
}
if ($title == '' && $abstract == '' && $pub_type == 'All' && $subject != '' &&  $isbn != ''){
if ($format == 'All'){
$query = "SELECT * FROM publications WHERE isbn LIKE '%$isbn%' AND subject LIKE '%$subject%';";
}
else {
$query = "SELECT * FROM publications WHERE isbn LIKE '%$isbn%' AND subject LIKE '%$subject%' AND format = '$format';";
}
}
if ($title != '' && $abstract != '' && $pub_type != 'All' && $subject == '' &&  $isbn == ''){
if ($format == 'All'){
$query = "SELECT * FROM publications WHERE title LIKE '%$title%' AND abstract LIKE '%$abstract%' AND pub_type LIKE '%$pub_type%';";
}
else {
$query = "SELECT * FROM publications WHERE title LIKE '%$title%' AND abstract LIKE '%$abstract%' AND pub_type LIKE '%$pub_type%' AND format = '$format';";
}
}
if ($title != '' && $abstract != '' && $pub_type == 'All' && $subject != '' &&  $isbn == ''){
if ($format == 'All'){
$query = "SELECT * FROM publications WHERE title LIKE '%$title%' AND abstract LIKE '%$abstract%' AND subject LIKE '%$subject%';";
}
else {
$query = "SELECT * FROM publications WHERE title LIKE '%$title%' AND abstract LIKE '%$abstract%' AND subject LIKE '%$subject%' format = '$format';";
}
}
if ($title != '' && $abstract != '' && $pub_type == 'All' && $subject == '' &&  $isbn != ''){
if ($format == 'All'){
$query = "SELECT * FROM publications WHERE title LIKE '%$title%' AND abstract LIKE '%$abstract%' AND isbn LIKE '%$isbn%';";
}
else {
$query = "SELECT * FROM publications WHERE title LIKE '%$title%' AND abstract LIKE '%$abstract%' AND isbn LIKE '%$isbn%' format = '$format';";
}
}
if ($title != '' && $abstract != '' && $pub_type != 'All' && $subject != '' &&  $isbn == ''){
if ($format == 'All'){
$query = "SELECT * FROM publications WHERE title LIKE '%$title%' AND abstract LIKE '%$abstract%' AND pub_type LIKE '%$pub_type%' AND subject LIKE '%$subject%';";
}
else {
$query = "SELECT * FROM publications WHERE title LIKE '%$title%' AND abstract LIKE '%$abstract%' AND pub_type LIKE '%$pub_type%' AND subject LIKE '%$subject%' AND format = '$format';";
}
}
if ($title != '' && $abstract != '' && $pub_type != 'All' && $subject == '' &&  $isbn != ''){
if ($format == 'All'){
$query = "SELECT * FROM publications WHERE title LIKE '%$title%' AND abstract LIKE '%$abstract%' AND pub_type LIKE '%$pub_type%' AND isbn LIKE '%$isbn%';";
}
else {
$query = "SELECT * FROM publications WHERE title LIKE '%$title%' AND abstract LIKE '%$abstract%' AND pub_type LIKE '%$isbn%' AND subject LIKE '%$isbn%' AND format = '$format';";
}
}
if ($title != '' && $abstract != '' && $pub_type != 'All' && $subject != '' &&  $isbn != ''){
if ($format == 'All'){
$query = "SELECT * FROM publications WHERE title LIKE '%$title%' AND abstract LIKE '%$abstract%' AND pub_type LIKE '%$pub_type%' AND subject LIKE '%$subject%' AND isbn LIKE '%$isbn%';";
}
else {
$query = "SELECT * FROM publications WHERE title LIKE '%$title%' AND abstract LIKE '%$abstract%' AND pub_type LIKE '%$pub_type%' AND subject LIKE '%$subject%' AND isbn LIKE '%$isbn%' AND format = '$format';";
}
}
$result = queryMysql($query);
$rows = $result->num_rows;
for ($j=0;$j<$rows;$j++){
$result->data_seek($j);
$row = $result->fetch_assoc();
$pub_id = $row['pub_id'];
echo "<h4><a href='viewpub.php?pubid=".$pub_id."'>".$row['title']."</a></h4>";
$query1 = "SELECT * FROM pub_aut WHERE pub_id='$pub_id'";
echo "<i>Author(s): </i>";
$query2 = "SELECT * FROM pub_aut WHERE pub_id = '$pub_id';";
$result2 = queryMysql($query2);
$rows2 = $result2->num_rows;
for ($g=0;$g<$rows2;$g++){
$result2->data_seek($g);
$row2 = $result2->fetch_assoc();
$author_id = $row2['author_id'];
$query3 = "SELECT * FROM authors WHERE author_id='$author_id';";
$result3 = queryMysql($query3);
$row3 = $result3->fetch_assoc();
$firstname = $row3['firstName'];
$lastname = $row3['lastName'];

$pub_type = $row['pub_type'];
$subject = $row['subject'];
$format = $row['format'];
echo "<a href='viewauthors.php?author=".$author_id."'>".$firstname." ".$lastname." </a>";
  echo "/ ";
}
echo "<b>|</b> <i>Publication Type: </i>".$pub_type." <b>|</b> <i>Keyword(s): </i>".$subject."<br> <i>Format:</i> ".$format."<i> <b>|</b> Availability: </i>";
if ($row['public'] == 0){
echo "Users only";
}
else {
echo "Publicly Available";
}
echo "<hr>";
}
}
require_once 'includes/footer.php';
?>
