<?php
ob_start();
session_start();
// Reading from the config.ini file
$ini_array = parse_ini_file("Config/config.ini");

// Connect to server and select databse.
mysql_pconnect($ini_array["host"], $ini_array["username"], $ini_array["password"])or die("cannot connect"); 
mysql_select_db($ini_array["db_name"])or die("cannot select DB");

// Values sent from form 
$emailId=$_POST['emailid'];
$password1=$_POST['password1'];
$password2=$_POST['password2'];
$team = $_POST['team'];
$members = $_POST['members'];

// To protect MySQL injection 
$emailId= stripslashes($emailId);
$password1 = stripslashes($password1);
$password2 = stripslashes($password2);
$team = stripslashes($team);
$members = stripslashes($members);

$emailId = mysql_real_escape_string($emailId);
$password1 = mysql_real_escape_string($password1);
$password2 = mysql_real_escape_string($password2);
$team = mysql_real_escape_string($team);
$members= mysql_real_escape_string($members);

if (!filter_var($emailId, FILTER_VALIDATE_EMAIL)) {
	if(isset($_SESSION['myusername']) && $_SESSION['UserType'] == "ADMIN") {
		header("location:AddUser.php?message=Invalid+Email");
	}
	else {
		header("location:UserRegistration.php?message=Invalid+Email");
	}
}
else if($password1 != $password2)
{
	if(isset($_SESSION['myusername']) && $_SESSION['UserType'] == "ADMIN") {
		header("location:AddUser.php?message=Passwords+Mismatch");
	}
	else {
		header("location:UserRegistration.php?message=Passwords+Mismatch");
	}
}

else {
	$sqlSelect = "select count(*) as number from authentication where emailId = '".$emailId."'";
	$result = mysql_query($sqlSelect);
	$row = mysql_fetch_array($result);
	$count = $row["number"];
	echo "count:".$count;
	if($count == 0)
	{
		echo "entered";
		$sql="INSERT INTO AUTHENTICATION VALUES  ('".$emailId."','".$password1."','USER',now(),now())";
		mysql_query($sql);
		$sql = "INSERT INTO TEAM (EmailId, TeamName, TotalNo )  VALUES ('".$emailId."','".$team."',".$members.")";
		mysql_query($sql);
		
		if(isset($_SESSION['myusername']) && $_SESSION['UserType'] == "ADMIN") {
			header("location:AddUser.php?message=User+created+successfully");
		}
		else {
			header('location:index.php?success=User+created+successfully');
		}
	}
	else{
		if(isset($_SESSION['myusername']) && $_SESSION['UserType'] == "ADMIN") {
			header("location:AddUser.php?message=User+already+exists");
		}
		else {
			header('location:index.php?success=User+already+exists');
		}
	}
}
ob_end_flush();
?>