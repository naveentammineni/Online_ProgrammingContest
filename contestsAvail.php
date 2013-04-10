<?php
session_start();
if(!isset($_SESSION['myusername'])){
header("location:index.php");
}
?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title>Contest Page of UT Dallas</title>
<link rel="stylesheet" type="text/css" href="default.css" />
</head>
<body>

<div id="outer">

	<div id="upbg"></div>

	<div id="inner">

		<div id="header">
			<h1><span>Contest Page of UT Dallas</span></h1>
			<h2></h2>
		</div>
	
		<div id="splash"></div>
	
		<div id="menu">
			<ul>
				<li class="first"><a href="AdminHome.php">Home</a></li>
				<li><a href="MyAccount.php">My Account</a></li>
				<li><a href="contestsAvail.php">Contests Available</a></li>
				<li><a href="AddUser.php">Add User</a></li>
                <li><a href="AddJudge.php">Add Judge</a></li>
				<li><a href="logout.php">Logout</a></li>
			</ul>

	
		</div> 
		
  <div class="content">
  <?php
  	//Reading from config file
	$ini_array = parse_ini_file("Config/config.ini");

  if(isset($_GET['success'])){
			$message =$_GET['success'];
			if(isset($message)) { 
				echo $message; 
			}
	}
	if(isset($_GET['err'])){
		$err =$_GET['err'];
		if(isset($err)) { 
			echo $err;
		}
	}
	
mysql_select_db($ini_array["db_name"])or die("cannot select DB");
$query = "SELECT * FROM contest "; 
$result = mysql_query($query) or die(mysql_error());
echo  "<form id=\"form2\" name=\"form2\" method=\"post\" action=\"ContestOperation.php\"><table border=\"1\"><tr>
	   <th>Selection</th>
	   <th>Contest Id</th>
	   <th>Contest Type</th>
	   <th>Contest Start Time</th>
	   <th>Contest End Time</th>
	   <th>Description</th>
   	   <th>No of Questions</th>
	   </tr>";

while($row = mysql_fetch_array($result)){
	echo  "<tr><td> <input type='radio' name = 'selection' value='".$row['ContestId']."'></td> <td>".  $row['ContestId']. "</td><td>". $row['ContestType']. "</td><td>". $row['Contest_Start_time']. "</td><td>". $row['Contest_End_Time']. "</td><td>". $row['Description']. "</td><td>". $row['No_of_Questions']. "</td></tr>";
}
echo "</table>";

if($_SESSION['UserType']=="JUDGE") {
	echo "<h1><p>Registered Contests(for grading)</p></h1>";
	$user = $_SESSION['myusername'];
	$query1 = "SELECT * FROM contest_register WHERE UserName='$user' "; 
	$result1 = mysql_query($query1) or die(mysql_error());
	echo "<table border=\"1\"><tr>
      <th>Contest Id</th>
	  <th>Scores</th>
	  </tr>";
	while($row = mysql_fetch_array($result1)){
	     echo "<tr>". "<td>". "<h1>". $row['contestId']. "</td>". "<td>". $row['scores']. "</h1>". "</td>". "</tr>";
	}
	echo "</table>";
}
else if($_SESSION['UserType']=="ADMIN") {
	echo "<br/>";
	echo " <input type='submit' value=' Add Contest ' name='add'>";
	echo " <input type='submit' value=' Delete Contest ' name='delete'>";
	echo "  <input type='submit' value=' Edit Contest  ' name='edit'>";
	echo "<input type='submit' value='View Scores' name='view'>";
}
echo "</form>";


	 ?>
	 </br>
    <!-- end .content --></div>
    </div>
  <!-- end .container --></div>
  <div id="footer">
	&copy; My Website. All rights reserved. 
   </div>

</body>
</html>