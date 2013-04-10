<?php
session_start();
ob_start();
if(!isset($_SESSION['myusername']))
	header("location:index.php");
else if(isset($_SESSION['myusername'])&&$_SESSION['UserType'] != "ADMIN"){
	header("location:index.php");
}
else{
//Reading from config file
$ini_array = parse_ini_file("Config/config.ini");

// select databse.
mysql_select_db($ini_array["db_name"])or die("cannot select DB");

// Values sent from form 
$emailId=$_POST['emailid']; 
$password1=$_POST['password1']; 
$password2=$_POST['password2']; 
$name = $_POST['name'];

// To protect MySQL injection 
$emailId= stripslashes($emailId);
$password1 = stripslashes($password1);
$password2 = stripslashes($password2);
$name = stripslashes($name);

$emailId = mysql_real_escape_string($emailId);
$password1 = mysql_real_escape_string($password1);
$password2 = mysql_real_escape_string($password2);
$name = mysql_real_escape_string($name);

if (!filter_var($emailId, FILTER_VALIDATE_EMAIL)) {
		header("location:AddJudge.php?message=Invalid+Email");
}
else if($password1 != $password2)
{
	header("location:AddJudge.php?message=Passwords+Mismatch");
}

else {
	$sqlSelect = "select count(*) as number from authentication where emailId = '".$emailId."'";
	$result = mysql_query($sqlSelect);
	$row = mysql_fetch_array($result);
	$count = $row["number"];
	echo "$count:".$count;
	if($count == 0)
	{
		$sql="INSERT INTO AUTHENTICATION VALUES  ('".$emailId."','".$password1."','JUDGE',now(),now())";
		mysql_query($sql);
		$sql = "INSERT INTO ADMIN (EmailId, Name, UserType )  VALUES ('".$emailId."','".$name."','JUDGE')";
		mysql_query($sql);
		header("location:AddJudge.php?message=Judge+created+successfully");
	}
	else{
		header("location:AddJudge.php?message=Judge+already+exists");
	}
	
}
ob_end_flush();
}
?>