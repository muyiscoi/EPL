<?php
require_once 'includes/header.php';
require_once 'includes/checklogin.php';
if ($_GET){
if ($_GET['edit'] != '') {
$pub_id = $_GET['edit'];
}
}
//remove this after editing the pageif (!$_POST) {
//header('location:editpub.php?r=nopost');
//}

//insert this correctly
$_SESSION['which'] = "new";
//do it
echo "<div class='container col-md-offset-3 col-md-6 col-md-offset-3'>
<h2> Edit Publication: Add new Author </h2>
    <form method='post' action='editpub3.php?edit=".$pub_id."'>
<div class='form-inline'>".
  "</div>
</br>";
echo "<div class='form-inline'>
    <label for='author'>Select Author</label>
<select class='form-control' name='authorselect' id='authorselect'>";

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
<option disabled>──────────────</option>
<option>Add New Author</option>
</select>
  </div>

<div id='newauthor'>
<div class='form-inline'>
 <label for='authortitle'>Title</label>
  <select class='form-control' name='authortitle' id='authortitle'>
	<option>Mr. </option>    
	<option>Mrs. </option>
    <option>Miss. </option>
    <option>Ms. </option>
    <option>Dr. </option>
    <option>Professor </option>
  </select>
</div>
<div class='form-group'>
    <label for='authorfirstname'>First Name</label>
    <input type='text' class='form-control' name='authorfirstname' id='authorfirstname' placeholder='Enter first name'>
   <label for='authormiddlename'>Middle Name</label>
    <input type='text' class='form-control' name='authormiddlename' id='authormiddlename' placeholder='Enter middle name'>
<label for='authorlastname'>Last Name</label>
    <input type='text' class='form-control' name='authorlastname' id='authorlastname' placeholder='Enter Last name'>
<label for='authoremail'>Email Address</label>
<input type='email' class='form-control' name='authoremail' id='authoremail' placeholder='Enter email address'>
<label for='authorphone'>Phone number</label>
    <input type='tel' class='form-control' name='authorphone' id='authorphone' placeholder='Enter phone number'>
<label for='authorinstitution'>University/Institution Affiliation</label>
    <input type='text' class='form-control' name='authorinstitution' id='authorinstitution' placeholder='Enter Institution/Affiliation'>
<label for='authorpostal'>Postal Address</label>
  <textarea name='authorpostal' placeholder='Enter postal address' class='form-control' id='authorpostal'></textarea>
</div>
</div>
   <button type='submit' name='next' class='btn btn-primary' style='float:right' value='next'>Next</button>
</form>
<?require_once 'includes/footer.php';?>
