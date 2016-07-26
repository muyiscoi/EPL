<?php
require_once 'includes/header.php';
require_once 'includes/checklogin.php';
?>
<div class="container col-md-offset-3 col-md-6 col-md-offset-3">
<h2> Add Publications:Authors </h2>
    <form method="post" action="addpub3.php">
<div class="form-inline">
    <label for="author">Select Author</label>
<select class="form-control" name="authorselect" id="authorselect">
<?php
$authorquery = "SELECT * FROM authors";
$result = queryMysql($authorquery);

$rows = $result->num_rows;
for ($j = 0 ; $j < $rows ; ++$j)
{
$result->data_seek($j);
$row = $result->fetch_assoc();
echo '<option>'. $row['title'] . ' ' .$row['firstName'] . ' '. $row['lastName'].'</option>'.'<br>';
}
?>
<option disabled>---------------</option>
<option>Add New Author</option>
</select>
  </div>
</br>
<div id="newauthor">
<div class="form-inline">
 <label for="authortitle">Title</label>
  <select class="form-control" name="authortitle" id="authortitle">
	<option>Mr. </option>
	<option>Mrs. </option>
    <option>Miss. </option>
    <option>Ms. </option>
    <option>Dr. </option>
    <option>Professor </option>
  </select>
</div>
<div class="form-group">
    <label for="authorfirstname">First Name</label>
    <input type="text" class="form-control" name="authorfirstname" id="authorfirstname" placeholder="Enter First Name">
   <label for="authormiddlename">Middle Name</label>
    <input type="text" class="form-control" name="authormiddlename" id="authormiddlename" placeholder="Enter Middle Name">
<label for="authorlastname">Last Name</label>
    <input type="text" class="form-control" name="authorlastname" id="authorlastname" placeholder="Enter Last Name">
<label for="authoremail">Email Address</label>
<input type="email" class="form-control" name="authoremail" id="authoremail" placeholder="Enter Email address">
<label for="authorphone">Phone number</label>
    <input type="tel" class="form-control" name="authorphone" id="authorphone" placeholder="Enter Phone Number">
<label for="authorinstitution">University/Institution Affiliation</label>
    <input type="text" class="form-control" name="authorinstitution" id="authorinstitution" placeholder="Enter University/Institution Affiliation">
<label for="authorpostal">Postal Address</label>
  <textarea name="authorpostal" class="form-control" id="authorpostal" placeholder="Enter postal address of Author"></textarea>
</div>
</div>
   <button type="submit" name="next" class="btn btn-primary" style="float:right" value="next">Next</button>
</form>
<?php

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
$pubformat = sanitizeString($_POST['format']);
$subject = sanitizeString($_POST['subject']);
#database insert for publications table
if ($pubtitle!='' && $pubabstract!='' && $pubpublisher!=''){
$query = "
INSERT INTO publications (title,abstract,publisher,isbn,date,date_added,pub_type,subject,format,user_id)
VALUES ('$pubtitle','$pubabstract','$pubpublisher','$pubisbn','$pubdate',CURRENT_TIMESTAMP,'$pubtype','$subject','$pubformat','$user_id');";

queryMysql($query);
$id = $conn->insert_id;
$_SESSION['id'] = $id;
}
#database insert for journal table
if ($pagesnumber!='' && $journalissue!=''){
$query1 = "
INSERT INTO journals (pages_number,issue,pub_id)
VALUES ('$pagesnumber','$journalissue','$id');";

queryMysql($query1);
}
#database insert for conference paper table
if ($confaddress!=''){
$query2 = "
INSERT INTO conf_paper (conf_add,pub_id)
VALUES ('$confaddress','$id');";

queryMysql($query2);
}
#database insert for student report table
if ($supervisor!='' && $supervisoremail!='' && $studentdegree!=''){
$query3 = "
INSERT INTO student_report (supervisor,supervisor_email,student_degree,pub_id)
VALUES ('$supervisor','$supervisoremail','$studentdegree','$id');";

queryMysql($query3);
}
#database insert for research report table
if ($researchstart!='' && $researchend!=''){
$query4 = "
INSERT INTO res_report (duration_start,duration_end,pub_id)
VALUES ('$researchstart','$researchend','$id');";

queryMysql($query4);
}
#database insert for other publications table
if ($otherpubtype!=''){
$query5 = "
INSERT INTO other (pub_type,pub_id)
VALUES ('$otherpubtype','$id');";

queryMysql($query5);
}
}
require_once 'includes/footer.php';
?>
