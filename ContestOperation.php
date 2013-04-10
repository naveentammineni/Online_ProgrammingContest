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
// select databse.
mysql_select_db($ini_array["db_name"])or die("cannot select DB");

// Values sent from form 
$contestId=$_POST['selection']; 

if(isset($_POST['add'])){
	header('location:ContestAdd.php');
}
else if(isset($_POST['delete'])){
	header('location:ContestDelete.php?message='.$contestId);
}
else if(isset($_POST['edit'])){
	header('location:ContestEdit.php?message='.$contestId);
}
else if(isset($_POST['view'])){
	header('location:ContestScores.php?message='.$contestId);
}
ob_end_flush();
}
?>