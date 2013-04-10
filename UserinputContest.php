<?php
session_start();
$contestid = $_POST['contestid'];
$myusername = $_SESSION['myusername'];
mysql_select_db("test")or die("cannot select DB");
$query1 = "SELECT ContestId FROM contest"; 
$result1 = mysql_query($query1) or die(mysql_error());
while($row = mysql_fetch_array($result1))
{
$temp = $row['ContestId'];
if($contestid==$temp)
{
$sql="INSERT INTO contest_register VALUES ('$contestid','$myusername','USER','0')";
$result = mysql_query($sql);
}
}
$_SESSION['result'] = $result;
header("location:UserAvailableContest.php")	 
?>