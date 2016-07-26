<?php
require_once 'includes/header.php';
require_once 'includes/profile.php';
if ($_GET){
if ($_GET['r']) {
 if ($_GET['r'] == 'success') {
echo "<div class='alert alert-success' role='alert'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
Operation Successful!</div>";
}
if ($_GET['r'] == 'noauth') {
echo "<div class='alert alert-warning' role='alert'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
Sorry, You are not authorized to do that</div>";
}
}
}
if ($level_id == 3){
echo "<h3> Manage Publications </h3><a href='addpub.php'>Add new publication</a>";
echo "<div><form id='custom-search-form' class='form-search form-horizontal pull-right' action='managepub.php' method='post'>
                <div class='input-append span12'>
                    <input type='text' name='search' id='search' class='search-query' placeholder='Search'>
                    <button type='submit' class='btn'><i><span class='glyphicon glyphicon-search' aria-hidden='true'></span></i></button>
                </div>
            </form></div><br>";

echo "<div class='row'><div class='panel panel-default' id='publications'>";
if ($_POST){
$search = sanitizeString($_POST['search']);
 if($_POST['search'] != '') {
echo "
  <div class='panel-heading'><h3 class='panel-title'>Publications matching search term: ".$search."</h3></div><div>";
}
else {
echo "<div class='panel-heading'><h3 class='panel-title'>All Publications</h3></div><div>";
}
}
else {
echo "<div class='panel-heading'><h3 class='panel-title'>All Publications</h3></div><div>";
}
echo "<table class='table table-fixed'><thead><tr>
<th class='col-xs-1'>S/N</th>
<th class='col-xs-2'>Title</th>
<th class='col-xs-2'>Publication Type</th>
<th class='col-xs-2'>Date Added</th>
<th class='col-xs-2'>Status</th>
<th class='col-xs-1'>Edit</th>
<th class='col-xs-1'>Delete</th></tr></thead><tbody style='height: 350px;'>";
if ($_POST) {
$query4 = "SELECT * FROM publications WHERE title LIKE '%$search%'";
$result4 = queryMysql($query4);
$rows4 = $result4->num_rows;
}
else {
$query4 = "SELECT * FROM publications ORDER BY date_added DESC";
$result4 = queryMysql($query4);
$rows4 = $result4->num_rows;
}
for($j = 0; $j<$rows4; ++$j) 
{
$result4 ->data_seek($j);
$num = $j+1;
$row4 = $result4->fetch_assoc();
$date_added = explode(' ',$row4['date_added']);

echo "<tr><td class='col-xs-1'>".$num."</td>
<td class='col-xs-2'><a href='viewpub.php?pubid=".$row4['pub_id']."'>".$row4['title']." </a></td> 
<td class='col-xs-2'>".$row4['pub_type']." (".$row4['format'].")</td>	
<td class='col-xs-2'>".$date_added[0]."</td>
<td class='col-xs-2'>";
if ($row4['public'] == '0'){
echo "Users only<br><a href='makepublic.php?pubid=".$row4['pub_id']."'>Make Public</a></td>";
}
else {
echo "Public<br><a href='makepublic.php?pubid=".$row4['pub_id']."'>Restrict access</a></td>";
}
echo "<td class='col-xs-2'><a href='editpub.php?edit=".$row4['pub_id']."'><span class='glyphicon glyphicon-edit' title='Click to edit publication.' aria-hidden='true'></span></a></td>
<td class='col-xs-2'><a href='deletepub.php?edit=".$row4['pub_id']."'onclick='return confirm(\"Are you sure you want to delete this publication: ".$row4['title']."?\")'><span class='glyphicon glyphicon-trash' title='Click to delete publication.' aria-hidden='true'></span></a></td></tr>";

}
  echo "</tbody></table></div></div></div>";
}
else {
header('location:userpage.php?r=noauth');
}
require_once 'includes/footer.php';
?>
