<?php
if (!$loggedin){
header("Location:login.php?location=" . urlencode($_SERVER['REQUEST_URI']));
}
else {
$query = "SELECT * FROM login WHERE username='$stduser'";
$result = queryMysql($query);
$row = $result->fetch_assoc();
$login_id = $row['login_id'];
$level_id = $row['level_id'];
$block = $row['block'];

$query1 = "SELECT * FROM user_info WHERE login_id='$login_id'";
$result1 = queryMysql($query1);
$row1 = $result1->fetch_assoc();
$user_id = $row1['user_id'];


// level
$query2 = "SELECT * FROM level WHERE level_id='$level_id'";
$result2 = queryMysql($query2);
$row2 = $result2->fetch_assoc();
$level = $row2['level'];
$max_downloads = $row2['max_downloads'];
}
?>
