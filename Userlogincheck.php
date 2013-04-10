<?php
ob_start();
$host="localhost"; // Host name 
$username="test"; // Mysql username 
$password=""; // Mysql password 
$db_name="test"; // Database name 
$tbl_name="authentication"; // Table name 
// Connect to server and select databse.
mysql_pconnect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");

// username and password sent from form 
$myusername=$_POST['emailid']; 
$mypassword=$_POST['password']; 
$type='USER';
// To protect MySQL injection 
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysql_real_escape_string($myusername);
$mypassword = mysql_real_escape_string($mypassword);
$sql="SELECT * FROM $tbl_name WHERE emailId='$myusername' and password='$mypassword' and userType='$type' ";
$result=mysql_query($sql);

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);
// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1){
// Register $myusername, $mypassword and redirect to file "UserMain.html"
session_start();
//session_register("myusername");
$_SESSION['myusername'] = $myusername;
//session_register("mypassword"); 
header("location:Userhome.php");
}
else {
echo "Wrong Username or Password";
header("location:userindex.php");
}
ob_end_flush();
?>