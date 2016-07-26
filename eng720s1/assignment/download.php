<h3> Downloads </h3>
<?php
require_once 'includes/header.php';

if ($_GET){

$pub_id = $_GET['id'];
$query = "SELECT * FROM publications WHERE pub_id='$pub_id'";
$result = queryMysql($query);
$row = $result->fetch_assoc();
$file = $row['url'];
$status = $row['public'];
}
else {
header("location:index.php?r=nopub");
}

if ($status == '0'){ // 0 means the publication is available only to logged in users
	if ($loggedin) {
		$query9 = "SELECT * FROM login WHERE username='$stduser'";
		$result9 = queryMysql($query9);
		$row9 = $result9->fetch_assoc();
		$login_id = $row9['login_id'];
		$level_id = $row9['level_id'];
		$query1 = "SELECT * FROM user_info WHERE login_id='$login_id'";
		$result1 = queryMysql($query1);
		$row1 = $result1->fetch_assoc();
		$user = $row1['user_id'];
		$query3 = "SELECT * FROM download_count WHERE user_id='$user';";
		$result3 = queryMysql($query3);
		$rows3 = $result3->num_rows;
		$row3 = $result3->fetch_assoc();
	if ($rows3 == 0){ //meaning the publication hasn't been downloaded before
		$count = 1;
		$query4 = "INSERT INTO download_count (user_id,count) VALUES ('$user','$count');";
		queryMysql($query4);
		$query7 = "INSERT INTO downloads (pub_id, user_id, date) VALUES ('$pub_id','$user_id',CURRENT_TIMESTAMP);";
		queryMysql($query7);
		download($file);
	}
	else {
	$query5 = "SELECT * FROM level WHERE level_id='$level_id';";
	$result5 = queryMysql($query5);
	$row5 = $result5->fetch_assoc();
	$max_downloads = $row5['max_downloads'];
	$count = $row3['count'];
	if ($count < $max_downloads) {
	$count = $count + 1;
	$query6 = "UPDATE download_count SET count='$count' WHERE user_id='$user';";
	queryMysql($query6);
	$query8 = "INSERT INTO downloads (pub_id, user_id, date) VALUES ('$pub_id','$user',CURRENT_TIMESTAMP);";
	queryMysql($query8);
	download($file);
	}	
	else {
	echo "You have reached your maximum download limit for your level for this month";
	}
}
}
else {
header("Location:login.php?location=" . urlencode($_SERVER['REQUEST_URI']));
}
}
if ($status == 1){

	if ($loggedin) {
		$query10 = "SELECT * FROM login WHERE username='$stduser'";
		$result10 = queryMysql($query10);
		$row10 = $result10->fetch_assoc();
		$login_id = $row10['login_id'];
		$level_id = $row10['level_id'];
		$query11 = "SELECT * FROM user_info WHERE login_id='$login_id'";
		$result11 = queryMysql($query11);
		$row11 = $result11->fetch_assoc();
		$user_id = $row11['user_id'];
		$query12 = "INSERT INTO downloads (pub_id, user_id, date) VALUES ('$pub_id','$user_id',CURRENT_TIMESTAMP);";
	queryMysql($query12);
	download($file);
}
else {
download($file);
}
}
require_once 'includes/footer.php';	
?>
