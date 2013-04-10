<?php
session_start();
//Reading from config file
$ini_array = parse_ini_file("Config/config.ini");
if(!isset($_SESSION['myusername']))
	header("location:index.php");
else if(isset($_SESSION['myusername'])&&$_SESSION['UserType'] != "ADMIN"){
	header("location:index.php");
}
else {
ob_start();
$contestId=0;

if(isset($_GET['message'])){
	$contestId = $_GET['message'];
}
// select databse.
mysql_select_db($ini_array["db_name"])or die("cannot select DB");

// Values sent from form 

if($contestId > 0){
	$sql="DELETE FROM contest where ContestId=".$contestId;
	mysql_query($sql);
	ob_end_flush();
	header('location:contestsAvail.php?success=Contest+Deleted+successfully');
}
else{
	header('location:contestsAvail.php?success=Invalid+Contest+Id');
}
}
?>