<?php
require_once 'includes/header.php';
require_once 'includes/checklogin.php';
if ($_GET){
if($_GET['edit'] != '') {
$pub_id = $_GET['edit'];
$query = "SELECT * FROM publications WHERE pub_id='$pub_id';";
$result = queryMysql($query);
$row = $result->fetch_assoc();

$query1 = "SELECT * FROM journals WHERE pub_id='$pub_id';";
$result1 = queryMysql($query1);
$rows1 = $result1->num_rows;
$pagesnumber = $issue = '';
if ($rows1 > 0) {
$row1 = $result1->fetch_assoc();
$pagesnumber = $row1['pages_number'];
$issue = $row1['issue'];
}

$confadd = '';
$query2 = "SELECT * FROM conf_paper WHERE pub_id='$pub_id';";
$result2 = queryMysql($query2);
$rows2 = $result2->num_rows;
if ($rows2 > 0){
$row2 = $result2->fetch_assoc();
$confadd = $row2['conf_add'];
}

$supervisor = $supervisoremail = $studentdegree = '';
$query3 = "SELECT * FROM student_report WHERE pub_id='$pub_id';";
$result3 = queryMysql($query3);
$rows3 = $result3->num_rows;
if ($rows3 > 0){
$row3 = $result3->fetch_assoc();
$supervisor = $row3['supervisor'];
$supervisoremail = $row3['supervisor_email'];
$studentdegree = $row3['student_degree'];
}

$durationstart = $durationend = '';
$query4 = "SELECT * FROM res_report WHERE pub_id='$pub_id';";
$result4 = queryMysql($query4);
$rows4 = $result4->num_rows;
if ($rows4 > 0 ){
$row4 = $result4->fetch_assoc();
$durationstart = $row4['duration_start'];
$durationend = $row4['duration_end'];
}
$otherpubtype = '';
$query5 = "SELECT * FROM other WHERE pub_id='$pub_id';";
$result5 = queryMysql($query5);
$rows5 = $result5->num_rows;
if ($rows5 > 0){
$row5 = $result5->fetch_assoc();
$otherpubtype = $row5['pub_type'];
}


echo "<div class='container col-md-offset-3 col-md-6 col-md-offset-3'>".
    "<h2> Edit Publication </h2><form method='post' action='editpub2.php?edit=".$pub_id."'>".
	"<div class='form-group'><label for='pubtype'>Type of Publication</label><select class='form-control' name='pubtype' id='pubtype'><option selected>".$row['pub_type']."</option><option>Journal</option>".
"<option>Conference Paper</option><option>Student Report</option>".
"<option>Research Report</option><option>Other Publications</option></select></div>".
"<div class='form-group'><label for='pubtitle'>Publication Title</label>".
    "<input type='text' class='form-control' name='title' id='title' value='".$row['title']."' required></div>".
  "<div class='form-group'><label for='pubabstract'>Abstract</label>".
"<textarea class='form-control' id='abstract' name='abstract' required >".$row['abstract']."</textarea></div>".
"<div class='form-group'><label for='publisher'>Publisher/Institution</label>".
  "<input type='text' name='publisher' class='form-control' id='publisher' value='".$row['publisher']."' required></div>".

  "<div class='form-group'><label for='isbn'>ISBN Number</label>
  <input type='text' name='isbn' class='form-control' id='isbn' value='".$row['isbn']."' required></div>".
"<div class='form-group' id='subject'>
    <label for='subject'>Keyword(s)</label>
    <input type='text' class='form-control' name='subject' id='subject' value='".$row['subject']."' required>
  </div>".
  "<div class='form-group'>
  <label for='pubdate'>Date of Publication</label>
  <input type='date' name='pubdate' value = '".$row['date']."' class='form-control' id='pubdate' required></div>".
"<!-- Journal Form entry -->
<div class='form-group' id='journal'>
  <label for='pagesnumber'>Journal Pages</label>".
  "<input type='text' name='pagesnumber' class='form-control' id='pagesnumber' value='$pagesnumber'>".

"<label for='journalissue'>Journal Issue</label>
  <input type='text' name='journalissue' class='form-control' id='journalissue' value='$issue'>
</div>".
  

"<!-- Conference paper form entry -->
<div class='form-group' id='conferencepaper'>
  <label for='confaddress'>Conference Address</label>
  <textarea name='confaddress' class='form-control' id='confaddress'> $confadd </textarea>
</div>".


"<!-- Student report form entry -->
<div class='form-group' id='studentreport'>
  <label for='supervisor'>Student Report Supervisor</label>
  <input type='text' name='supervisor' class='form-control' id='supervisor' value='$supervisor'>".

"<label for='supervisoremail'>Email address of supervisor</label>
  <input type='email' name='supervisoremail' class='form-control' id='supervisoremail' value='$supervisoremail'>".

"<label for='studentdegree'>Enter student degree type</label>
  <input type='text' name='studentdegree' class='form-control' id='studentdegree' value='$supervisoremail'>
</div>".

"<!-- Research report form entry -->
<div class='form-group' id='researchreport'>
  <label for='researchstart'>Start of Research</label>
  <input type='date' name='researchstart' class='form-control' id='researchstart' value='$durationstart'>".

"<label for='publisher'>End of Research</label>
  <input type='date' name='researchend' class='form-control' id='researchend' value='$durationend'>
</div>".

"<!-- Other reports form entry -->
<div class='form-group' id='otherpub'>
  <label for='otherpubtype'>Publication Type</label>
  <input type='text' name='otherpubtype' class='form-control' id='otherpubtype' value='$otherpubtype'>
</div>".

   "<button type='submit' name='next' class='btn btn-primary' style='float:right' value='next'>Next</button>
</div>
</form>
</div>
</div>";
}
}
else {
header('location:userpage.php?r=noauth');
}
require_once 'includes/footer.php';
?>
