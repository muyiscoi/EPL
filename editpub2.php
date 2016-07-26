<?php
require_once 'includes/header.php';
require_once 'includes/checklogin.php';
if ($_GET){
if ($_GET['edit'] != '') {
$pub_id = $_GET['edit'];
$query6 = "SELECT * FROM pub_aut WHERE pub_id='$pub_id';";
$result6 = queryMysql($query6);
$rows6 = $result6->num_rows;
}
}
//remove this after editing the pageif (!$_POST) {
//header('location:editpub.php?r=nopost');
//}
echo "<div class='container col-md-offset-3 col-md-6 col-md-offset-3'>
<h2> Edit Publications: Authors </h2>
    <form method='post' action='editpub3.php?edit=".$pub_id."'>
<div class='form-inline'></div></br>";
$_SESSION['which'] = "update";
for ($j=0; $j<$rows6; ++$j) {
$result6->data_seek($j);
$num = $j+1;
$row6 = $result6->fetch_assoc();
$author_id = $row6['author_id'];
echo $author_id;
$query7 = "SELECT * FROM authors WHERE author_id='$author_id';";
$result7 = queryMysql($query7);
$row7 = $result7->fetch_assoc();
echo "<div id='editauthor'>
	<h3> Author ".$num."</h3>
<div class='form-inline'>
 <label for='authortitle'>Title</label>
  <select class='form-control' name='authortitle".$num."' id='authortitle".$num."'>
	<option>".$row7['title']."</option>
	<option>Mr. </option>    
	<option>Mrs. </option>
    <option>Miss. </option>
    <option>Ms. </option>
    <option>Dr. </option>
    <option>Professor </option>
  </select>
</div>".
"<div class='form-group'>
    <label for='authorfirstname'>First Name</label>
    <input type='text' class='form-control' name='authorfirstname".$num."' id='authorfirstname".$num."' value='".$row7['firstName']."'>
   <label for='authormiddlename'>Middle Name</label>
    <input type='text' class='form-control' name='authormiddlename".$num."' id='authormiddlename".$num."' value='".$row7['middleName']."'>
<label for='authorlastname'>Last Name</label>
    <input type='text' class='form-control' name='authorlastname".$num."' id='authorlastname".$num."' value='".$row7['lastName']."'>
<label for='authoremail'>Email Address</label>
<input type='email' class='form-control' name='authoremail".$num."' id='authoremail".$num."' value='".$row7['email']."'>
<label for='authorphone'>Phone number</label>
    <input type='tel' class='form-control' name='authorphone".$num."' id='authorphone".$num."' value='".$row7['phone']."'>
<label for='authorinstitution'>University/Institution Affiliation</label>
    <input type='text' class='form-control' name='authorinstitution".$num."' id='authorinstitution".$num."' value='".$row7['institution']."'>
<label for='authorpostal'>Postal Address</label>
  <textarea name='authorpostal".$num."' class='form-control' id='authorpostal".$num."'>".$row7['postalAddress']."</textarea>
</div>
</div>";
}
echo "<button type='submit' name='next' class='btn btn-primary' style='float:right' value='next'>Next</button>
</form>";

if ($_POST ){
$pubtitle = sanitizeString($_POST['title']);
$pubabstract = sanitizeString($_POST['abstract']);
$pubpublisher = sanitizeString($_POST['publisher']);
$pubisbn = sanitizeString($_POST['isbn']);
$pubdate = sanitizeString($_POST['pubdate']);
$pubtype = sanitizeString($_POST['pubtype']);
$pagesnumber = sanitizeString($_POST['pagesnumber']);
$journalissue = sanitizeString($_POST['journalissue']);
$pubtype = sanitizeString($_POST['pubtype']);
$confaddress = sanitizeString($_POST['confaddress']);
$supervisor = sanitizeString($_POST['supervisor']);
$supervisoremail = sanitizeString($_POST['supervisoremail']);
$studentdegree = sanitizeString($_POST['studentdegree']);
$researchstart = sanitizeString($_POST['researchstart']);
$researchend = sanitizeString($_POST['researchend']);
$otherpubtype = sanitizeString($_POST['otherpubtype']);
$subject = sanitizeString($_POST['subject']);


#database insert for publications table
$query = "
UPDATE publications SET title = '$pubtitle', abstract = '$pubabstract', publisher = '$pubpublisher', isbn = '$pubisbn', date = '$pubdate', pub_type = '$pubtype', user_id= '$user_id', subject='$subject' WHERE pub_id='$pub_id';";
queryMysql($query);

#database insert for journal table
if ($pubtype == 'Journal'){
$query8 = "SELECT * FROM journals WHERE pub_id='$pub_id'";
$result8 = queryMysql($query8);
$rows8 = $result8->num_rows;
if ($rows8 > 0){
$query1 = "
UPDATE journals SET pages_number = '$pagesnumber', issue = '$journalissue' WHERE pub_id = '$pub_id'";
queryMysql($query1);
}
else {
$query1 = "INSERT INTO journals (pages_number, issue, pub_id) VALUES ('$pagesnumber', '$journalissue', '$pub_id')";
queryMysql($query1);
}
}
#database insert for conference paper table
if ($pubtype == 'Conference Paper'){
$query9 = "SELECT * FROM conf_paper WHERE pub_id='$pub_id'";
$result9 = queryMysql($query9);
$rows9 = $result9->num_rows;
if ($rows9 > 0) {
$query2 = "UPDATE conf_paper SET conf_add = '$confaddress' WHERE pub_id = '$pub_id';"; 
queryMysql($query2);
}
else {
$query2 = "INSERT INTO conf_paper (conf_add, pub_id) VALUES ('$conf_address', '$pub_id');";
queryMysql($query2);
}
}
#database insert for student report table
if ($pubtype == 'Student Report'){
$query10 = "SELECT * FROM student_report WHERE pub_id='$pub_id'";
$result10 = queryMysql($query10);
$rows10 = $result10->num_rows;
if ($rows10 > 0){
$query3 = "UPDATE student_report SET supervisor = '$supervisor', supervisor_email = '$supervisoremail', student_degree = '$studentdegree' WHERE pub_id='$pub_id';";
queryMysql($query3);
}
else {
$query3 = "
INSERT INTO student_report (supervisor,supervisor_email,student_degree,pub_id) 
VALUES ('$supervisor','$supervisoremail','$studentdegree','$pub_id');";
queryMysql($query3);
}
}

#database insert for research report table
if ($pubtype=='Research Report'){
$query11 = "SELECT * FROM res_report WHERE pub_id='$pub_id'";
$result11 = queryMysql($query11);
$rows11 = $result11->num_rows;
if ($rows11 > 0){
$query4 = "UPDATE res_report SET duration_start = '$researchstart', duration_end = '$researchend' WHERE pub_id= '$pub_id';";
queryMysql($query4);
}
else {
$query4 = "INSERT INTO res_report (duration_start,duration_end,pub_id) 
VALUES ('$researchstart','$researchend','$pub_id');";
queryMysql($query4);
}
}
#database insert for other publications table
if ($pubtype == 'Other Publications'){
$query12 = "SELECT * FROM other WHERE pub_id='$pub_id'";
$result12 = queryMysql($query12);
$rows12 = $result12->num_rows;
if ($rows12 > 0){
$query5 = "UPDATE other SET pub_type = '$otherpubtype' WHERE pub_id='$pub_id';";
queryMysql($query5);
}
else {
$query5 = "INSERT INTO other (pub_type,pub_id) 
VALUES ('$otherpubtype','$pub_id');";
queryMysql($query5);
}
}
}
require_once 'includes/footer.php';
?>
