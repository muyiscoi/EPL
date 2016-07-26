<?php
require_once 'includes/header.php';
require_once 'includes/checklogin.php';
if ($_GET){
if ($_GET['edit'] != '') {
$pub_id = $_GET['edit'];
$_SESSION['pubid'] = $pub_id;
$query6 = "SELECT * FROM pub_aut WHERE pub_id='$pub_id';";
$result6 = queryMysql($query6);
$rows6 = $result6->num_rows;
}
}

echo "<div class='container col-md-offset-3 col-md-6 col-md-offset-3'>
<h2> Add Publication </h2>
<form action='editpub4.php'>
   <button type='submit' name='edit' class='btn btn-primary' style='float:left' value='".$pub_id."'>Add another Author</button>
</form>
<form action='replace.php?edit=".$pub_id."'>
   <button type='submit' name='edit' class='btn btn-primary' style='float:right' value='$pub_id'>Replace Publication</button>
</form><br> <h3><a href='viewpub.php?pubid=".$pub_id."'> Finish </a></h3>";
if ($_SESSION['which'] == "update"){
for ($j=0; $j<$rows6; ++$j) {
$result6->data_seek($j);
$num = $j+1;
$row6 = $result6->fetch_assoc();
$author_id = $row6['author_id'];
$query7 = "SELECT * FROM authors WHERE author_id='$author_id';";
$result7 = queryMysql($query7);
$row7 = $result7->fetch_assoc();
#from second page of form
$title = "authortitle".$num;
$firstname = "authorfirstname".$num;
$middlename = "authormiddlename".$num;
$lastname = "authorlastname".$num;
$email = "authoremail".$num;
$phone = "authorphone".$num;
$institution = "authorinstitution".$num;
$postal = "authorpostal".$num;
$authortitle = sanitizeString($_POST[$title]);
$authorfirstname = sanitizeString($_POST[$firstname]);
$authormiddlename = sanitizeString($_POST[$middlename]);
$authorlastname = sanitizeString($_POST[$lastname]);
$authoremail = sanitizeString($_POST[$email]);
$authorphone = sanitizeString($_POST[$phone]);
$authorinstitution = sanitizeString($_POST[$institution]);
$authorpostal = sanitizeString($_POST[$postal]);

if ($authorfirstname == '' && $authormiddlename == '' && $authorlastname == '' && $authoremail == '' && $authorphone == '' && $authorinstitution == '' && $authorpostal == '') {
$query2 = "DELETE FROM pub_aut WHERE author_id='$author_id';";
queryMysql($query2);
}
else {
$query6 = "
UPDATE authors SET title = '$authortitle', firstName = '$authorfirstname' , middleName = '$authormiddlename' , lastName = '$authorlastname' , email = '$authoremail' , phone = '$authorphone' , institution = '$authorinstitution' , postalAddress = '$authorpostal' WHERE author_id='$author_id';";
queryMysql($query6);
}
}
}

if ($_SESSION['which'] == "new") {
$authortitle = sanitizeString($_POST['authortitle']);
$authorfirstname = sanitizeString($_POST['authorfirstname']);
$authormiddlename = sanitizeString($_POST['authormiddlename']);
$authorlastname = sanitizeString($_POST['authorlastname']);
$authoremail = sanitizeString($_POST['authoremail']);
$authorphone = sanitizeString($_POST['authorphone']);
$authorinstitution = sanitizeString($_POST['authorinstitution']);
$authorpostal = sanitizeString($_POST['authorpostal']);
$authorselect = sanitizeString($_POST['authorselect']);

if ($authorselect!=''){
$authorarray = explode (' ',$authorselect);
$firstname = $authorarray[1];
$lastname = $authorarray[2];
$query5 = "SELECT * FROM authors WHERE firstName='$firstname' AND lastName='$lastname'";
$result5 = queryMysql($query5);
$row5 = $result5->fetch_assoc();
$authorid = $row5['author_id'];
$query4 = "
INSERT INTO pub_aut (pub_id,author_id) 
VALUES ('$pub_id','$authorid');";

queryMysql($query4);
}
else {
$query3 = "INSERT INTO authors (title,firstName,middleName,lastName,email,phone,institution,postalAddress) VALUES ($authortitle, $authorfirstname, $authormiddlename, $authorlastname, $authoremail, $authorphone, $authorinstitution, $authorpostal)";
$result4 = queryMysql($query4);
$authorid = $result4->insert_id;
$query4 = "
INSERT INTO pub_aut (pub_id,author_id) 
VALUES ('$pub_id','$authorid');";
queryMysql($query3);

}
}
require_once 'includes/footer.php';
?>
