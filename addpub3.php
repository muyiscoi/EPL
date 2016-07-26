<?php
require_once 'includes/header.php';
require_once 'includes/checklogin.php';
if ($level_id < 1 || !$_POST) {
header('location:userpage.php?r=noauth');
}
#from second page of form
$authortitle = sanitizeString($_POST['authortitle']);
$authorfirstname = sanitizeString($_POST['authorfirstname']);
$authormiddlename = sanitizeString($_POST['authormiddlename']);
$authorlastname = sanitizeString($_POST['authorlastname']);
$authoremail = sanitizeString($_POST['authoremail']);
$authorphone = sanitizeString($_POST['authorphone']);
$authorinstitution = sanitizeString($_POST['authorinstitution']);
$authorpostal = sanitizeString($_POST['authorpostal']);
$authorselect = sanitizeString($_POST['authorselect']);
$id = $_SESSION['id'];
//getting the format
$query2 = "SELECT * FROM publications WHERE pub_id='$id';";
$result2 = queryMysql($query2);
$row2 = $result2->fetch_assoc();
$format = $row2['format'];
?>
 <div class="container col-md-offset-3 col-md-6 col-md-offset-3">
<h2> Add Publication </h2>
<form action=addpub2.php>
   <button type="submit" name="next" class="btn btn-primary" style="float:left" value="add another author">Add another Author</button>
</form>
<?php
if ($format == 'Electronic'){
echo "<form action='uploader.php'>
   <button type='submit' name='next' class='btn btn-primary' style='float:right' value='Upload Publication'>Upload Publication</button>
</form>";
}
else {
echo "<form action='viewpub.php'>
   <button type='submit' name='pubid' class='btn btn-primary' style='float:right' value='".$id."'>Finish</button>
</form>";
}

if ($authorselect!='' && $authorselect != 'Add New Author'){
$authorarray = explode (' ',$authorselect);
$firstname = $authorarray[1];
$lastname = $authorarray[2];
$query = "SELECT * FROM authors WHERE firstName='$firstname' AND lastName='$lastname'";
$result = queryMysql($query);
$row = $result->fetch_assoc();
$authorid = $row['author_id'];
$query1 = "
INSERT INTO pub_aut (pub_id,author_id) 
VALUES ('$id','$authorid');";

queryMysql($query1);
}
if ($authorfirstname!='' && $authorlastname!=''){
$query6 = "
INSERT INTO authors (title,firstName,middleName,lastName,email,phone,institution,postalAddress) 
VALUES ('$authortitle','$authorfirstname','$authormiddlename','$authorlastname',
'$authoremail','$authorphone','$authorinstitution','$authorpostal');";

queryMysql($query6);

$authorid = $conn->insert_id;
if ($authorid!='' && $id!=''){
$query7 = "
INSERT INTO pub_aut (pub_id,author_id) 
VALUES ('$id','$authorid');";

queryMysql($query7);
}

}
$conn->close();
require_once 'includes/footer.php';
?>
