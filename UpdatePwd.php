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
	 $currPwd =$_POST['CurPwd'];
	 $newPwd = $_POST['NewPwd'];
	 $retypePwd = $_POST['RetypePwd'];
	
	$query = "SELECT * FROM AUTHENTICATION WHERE  EmailId='".$userName."'";
	$result = mysql_query($query) or die(mysql_error());

	$row = mysql_fetch_array($result);
	if($row['password'] != $currPwd){
		header('location:forgotPwd.php?err=Current+Password+Not+Matching');
	}
	else{
		if( $newPwd == $retypePwd){
			$query = "UPDATE AUTHENTICATION SET password = '".$newPwd."' WHERE  EmailId='".$userName."'";
			$result = mysql_query($query) or die(mysql_error());
			header('location:forgotPwd.php?err=Password+Change+Successful');
		}
		else{
			header('location:forgotPwd.php?err=Both+Passwords+Doesnt+Match');
		}
	}
	ob_end_flush();
 }
?>