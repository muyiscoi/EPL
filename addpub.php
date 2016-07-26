<?php
require_once 'includes/header.php';
require_once 'includes/checklogin.php';
if ($level_id < 1) {
header('location:userpage.php?r=noauth');
}
?>
<div class="container col-md-offset-3 col-md-6 col-md-offset-3">
    <h2> Add Publications </h2>
    <form method="post" action="addpub2.php">
	<div class="form-group">
  <label for="pubtype">Type of Publication</label>
  <select class="form-control" name="pubtype" id="pubtype">
	<option>Journal</option>
    <option>Conference Paper</option>
    <option>Student Report</option>
    <option>Research Report</option>
    <option>Other Publications</option>
  </select>
</div>
<div class="form-group">
  <label for="format">Publication Format</label>
    <select required class="form-control" name="format" id="format">
	<option selected>Electronic</option>
    <option>Printed</option>
  </select>
  </div>
      <div class="form-group">
    <label for="pubtitle">Publication Title</label>
    <input type="text" class="form-control" name="title" id="title" placeholder="Publication Title" required>
  </div>
  <div class="form-group">
    <label for="pubabstract">Abstract</label>
<textarea class="form-control" id="abstract" name="abstract" required placeholder="Enter abstract here" >
 </textarea>
</div>
  <div class="form-group">
  <label for="publisher">Publisher/Institution</label>
  <input type="text" name="publisher" class="form-control" id="publisher" placeholder="Enter Publisher/Institution" required>
</div>
  <div class="form-group">
  <label for="isbn">ISBN Number</label>
  <input type="text" name="isbn" class="form-control" id="isbn" placeholder="Enter ISBN number" required></div>
  <div class="form-group">
<div class="form-group" id="subject">
    <label for="subject">Enter Keyword(s)</label>
    <input type="text" class="form-control" name="subject" id="subject" placeholder="Enter keywords relevant to publication" required>
  </div>
  <label for="pubdate">Date of Publication (YYYY/MM/DD)</label>
  <input type="date" name="pubdate" class="form-control" id="pubdate" required></div>
<!-- Journal Form entry -->
<div class="form-group" id="journal">
  <label for="pagesnumber">Journal Pages</label>
  <input type="text" name="pagesnumber" class="form-control" id="pagesnumber" placeholder="Pages in the journal where the article can be found">

<label for="journalissue">Journal Issue</label>
  <input type="text" name="journalissue" class="form-control" id="journalissue" placeholder="Enter Journal Issue number">
</div>
  

<!-- Conference paper form entry -->
<div class="form-group" id="conferencepaper">
  <label for="confaddress">Conference Address</label>
  <textarea name="confaddress" class="form-control" id="confaddress" placeholder="Enter Address of the conference"></textarea>
</div>


<!-- Student report form entry -->
<div class="form-group" id="studentreport">
  <label for="supervisor">Student Report Supervisor</label>
  <input type="text" name="supervisor" class="form-control" id="supervisor" placeholder="Enter the name of the project supervisor">

<label for="supervisoremail">Email address of supervisor</label>
  <input type="email" name="supervisoremail" class="form-control" id="supervisoremail" placeholder="Enter email address of supervisor">

<label for="studentdegree">Enter student degree type</label>
  <input type="text" name="studentdegree" class="form-control" id="studentdegree" placeholder="Enter student degree type">
</div>

<!-- Research report form entry -->
<div class="form-group" id="researchreport">
  <label for="researchstart">Start of Research</label>
  <input type="date" name="researchstart" class="form-control" id="researchstart">

<label for="publisher">End of Research</label>
  <input type="date" name="researchend" class="form-control" id="researchend">
</div>

<!-- Other reports form entry -->
<div class="form-group" id="otherpub">
  <label for="otherpubtype">Publication Type</label>
  <input type="text" name="otherpubtype" class="form-control" id="otherpubtype" placeholder="Enter Type of Publication">
</div>

   <button type="submit" name="next" class="btn btn-primary" style="float:right" value="next">Next</button>
</div>
</form>
</div>
</div>
<?require_once 'includes/footer.php';?>
