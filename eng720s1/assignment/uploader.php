<?php
require_once 'includes/header.php';
require_once 'includes/checklogin.php';
?>

<div class="container col-md-offset-3 col-md-6 col-md-offset-3">
	<h2> Upload Publication </h2>
<div id="file upload" class="form-inline">
<form enctype="multipart/form-data" action="uploader.php" method="POST">
<input type="hidden" name="MAX_FILE_SIZE" value="19000000" />
    <label for="upload">Choose a file to upload:</label>
<input name="uploadedfile" type="file"/> <br>
<input type="submit" value="Upload File" style="float:right" />
</form>
</div>
</br>
<div class="form-inline">
<?php
$id = $_SESSION['id'];

echo "</div>";
#start session and connect to db


$target_path = "publications/";


if ($_POST){
$target_path = $target_path.basename($_FILES['uploadedfile']['name']);

if($_FILES['uploadedfile']['size'] > (20480000)){
$valid_file = false;
$message = 'File is too large. Please choose a file less than 20MB.';
}
else {
$valid_file = true;

}
if($valid_file) {
move_uploaded_file($_FILES['uploadedfile']['tmp_name'],$target_path);
#echo "The file ". basename($_FILES['uploadedfile']['name'])."has been uploaded";
} 
else {
echo "The following error occured : ".$message ;
}

$query = "UPDATE publications SET url='$target_path' WHERE pub_id= '$id'";
queryMysql($query);
if ($target_path !='publications/'){
echo "File uploaded!.<h2><a href='viewpub.php?pubid=".$id."'>Finish</a>
</h2>";
}
else{
echo "No file Uploaded. Please try again";
}
}
require_once 'includes/footer.php';
?>
