<?php
 session_start();
 //Reading from config file
 $ini_array = parse_ini_file("Config/config.ini");

 if(!isset($_SESSION['myusername'])){
	header("location:index.php");
 }
 else {
	 ob_start();
	 $userName = $_SESSION['myusername'];
	 
	 // select databse.
	 mysql_select_db($ini_array["db_name"])or die("cannot select DB");

	 // Values sent from form 
	 $name =$_POST['Name'];

 	 if($_SESSION['UserType']=="JUDGE" || $_SESSION['UserType']=="ADMIN"){
		$query = "UPDATE ADMIN SET Name ='".$name."' WHERE EmailId = '".$userName."'";
	 	mysql_query($query);
		echo $query;
		if($_SESSION['UserType']=="JUDGE" )
			header('location:JudgeHome.php?success=Details+Updated+successfully');
		else
			header('location:AdminHome.php?success=Details+Updated+successfully');
	}
	else if($_SESSION['UserType']=="USER"){
		$query = "UPDATE TEAM SET Name ='".$name."' WHERE EmailId = '".$userName."'";
	 	mysql_query($query);
		header('location:UserHome.php?success=Details+Updated+successfully');
	}
	ob_end_flush();
 }
?>