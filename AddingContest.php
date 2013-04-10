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

// select databse.
mysql_select_db($ini_array["db_name"])or die("cannot select DB");

// Values sent from form 
$contestId=0;
if(isset($_POST['ContestId']))
	$contestId = $_POST['ContestId'];
$contestType=$_POST['ContestType']; 
$startDate=$_POST['StartDate']; 
$endDate=$_POST['EndDate']; 
$desc = $_POST['Description'];
$no_of_questions = $_POST['questions'];

if($contestId !=0)
{
	$sql="UPDATE contest SET ContestType='".$contestType."',Contest_Start_time='".$startDate."',Contest_End_time='".$endDate."', 	      Description='".$desc."',No_of_Questions=$no_of_questions WHERE contestId=".$contestId;
}
else{
	$sql="INSERT INTO contest (ContestType,Contest_Start_time,Contest_End_time,Description,No_of_Questions)VALUES  
	('".$contestType."','".$startDate."','".$endDate."','".$desc."',".$no_of_questions.")";
}
echo $sql;
mysql_query($sql);
if($contestId == 0){
	$sql = "select max(ContestId) as max from contest";
	$result = mysql_query($sql) or die(mysql_error());
	
	$row = mysql_fetch_array($result);
	$contestId = $row['max'];
}
ob_end_flush();
	header('location:QuestionsUpload.php?id='.$contestId);
}
?>