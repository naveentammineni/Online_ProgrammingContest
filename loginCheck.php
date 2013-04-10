<?php
ob_start();
//Reading from config file
$ini_array = parse_ini_file("Config/config.ini");

$tbl_name="authentication"; // Table name 
// Connect to server and select databse.
mysql_pconnect($ini_array["host"], $ini_array["username"], $ini_array["password"])or die("cannot connect"); 
mysql_select_db($ini_array["db_name"])or die("cannot select DB");

// username and password sent from form 
$myusername=$_POST['emailid']; 
$mypassword=$_POST['password']; 

// To protect MySQL injection 
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysql_real_escape_string($myusername);
$mypassword = mysql_real_escape_string($mypassword);
$sql="SELECT * FROM $tbl_name WHERE emailId='$myusername' and password='$mypassword'";
$result=mysql_query($sql);

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);
// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1){
	// Register $myusername, $mypassword and redirect to file "UserMain.html"
	session_start();
	while($row = mysql_fetch_assoc($result)){
		$userType = $row['usertype'];
		$_SESSION['UserType'] = $userType;
		//session_register("myusername");
		$_SESSION['myusername'] = $myusername;
		if($userType == "JUDGE")
			header("location:JudgeHome.php");
		else if ($userType == "ADMIN")
			header("location:AdminHome.php");
		else if ($userType == "USER")
			header("location:UserHome.php");
	}
}
else {
	header("location:index.php?success=Invalid+Username+or+Password");
}
ob_end_flush();
?>