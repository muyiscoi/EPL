<?php
$servername = "mysql_server";
$username = "username";
$password = "password";
$dbname = "db_name";
$sitename = "Engineering Publication Library"; 
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

//mysql query function
function queryMysql($query) {
global $conn;
$result = $conn->query($query);
if (!$result) die($conn->query($query));
return $result;
mysql_info();
}

function destroySession() {
$_SESSION=array();

if (session_id() != '' || isset($_COOKIE[session_name()]))
 setcookie(session_name(), '', time()-2592000, '/');

session_destroy();
}

function sanitizeString($var) {
global $conn;
$var = strip_tags($var);
$var = htmlentities($var);
$var = stripslashes($var);
return $conn->real_escape_string($var);
}

//download function
function download($file) {
  if (file_exists($file)) {
set_time_limit(0);
        header('Connection: Keep-Alive');
    header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($file).'"');
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            ob_clean();
            flush();
            readfile($file);
}
else {
      header("HTTP/1.1 404 Not Found");
} 
} //download script from the internet http://stackoverflow.com/questions/10145067/why-my-downloaded-file-is-alwayes-damaged-or-corrupted

//block users function for admin
function blockuser($user_id) {
$query1 = "SELECT * FROM user_info WHERE user_id = '$user_id';";
$result1 = queryMysql($query1);
$row1 = $result1->fetch_assoc();
$login_id = $row1['login_id'];

$query2 = "SELECT * FROM login WHERE login_id = '$login_id';";
$result2 = queryMysql($query2);
$row2 = $result2->fetch_assoc();
$block = $row2['block'];

 if ($block == 0){
$query = "UPDATE login SET block='1' WHERE login_id = '$login_id';";
queryMysql($query);
  }
 if ($block == 1){
$query = "UPDATE login SET block='0' WHERE login_id = '$login_id';";
queryMysql($query);
}
}

//delete users function for admin
function deleteuser($user_id) {
 $query = "SELECT * FROM user_info WHERE user_id = '$user_id'";
 $result = queryMysql($query);
 $row = $result->fetch_assoc();
 $login_id = $row['login_id'];
 $query1 = "DELETE FROM user_info WHERE user_id = '$user_id';";
 queryMysql($query1); 
 $query2 = "DELETE FROM login WHERE login_id = '$login_id';";
 queryMysql($query2);
 $query3 = "DELETE FROM address WHERE user_id = '$user_id';";
 queryMysql($query3);
 $query4 = "DELETE FROM download_count WHERE user_id = '$user_id';";
 queryMysql($query4);

 $query = "SELECT * FROM user_info WHERE user_id = '$user_id'";
 $result = queryMysql($query);
 $rows = $result->num_rows;
 return $rows;
}
//address functions
//view phone number info
function phoneno($user_id,$type) {
$query2 = "SELECT * FROM phone WHERE user_id='$user_id' AND type='$type'";
$result2 = queryMysql($query2);
$rows2 = $result2->num_rows;
$row2 = $result2->fetch_assoc();
return $row2;
}
//add new phone number
function phoneadd($phoneno,$type,$user_id) {
$query5 = "INSERT INTO phone (phone_no,type,user_id) VALUES ('$phoneno','$type','$user_id')";
queryMysql($query5);
}

function phoneupdate($phoneno,$user_id,$type){
$query5 = "UPDATE phone SET phone_no = '$phoneschool' WHERE user_id = '$user_id' AND type='$type'";
queryMysql($query5);
}
//function to reset user account based on a userid as input
function resetpass($user_id) {
$query = "SELECT * FROM user_info WHERE user_id='$user_id';";
$result = queryMysql($query);
$row = $result->fetch_assoc();
$login_id = $row['login_id'];
$password = substr(uniqid($user_id), -8);
$hash = password_hash($password, PASSWORD_DEFAULT);
$query1 = "UPDATE login SET password='$hash' WHERE login_id='$login_id';";
queryMysql($query1);
return $password;
}
