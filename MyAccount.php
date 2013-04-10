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

	<div id="upbg"></div>b

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
    <p>
<?php
  	//Reading from config file
	$ini_array = parse_ini_file("Config/config.ini");
	
	$userName = $_SESSION['myusername'];
	
	mysql_select_db($ini_array["db_name"])or die("cannot select DB");
	echo  "<form id='form2' name='form2' method='post' action='UpdateDetails.php'><table border='0'>";
	
	if($_SESSION['UserType']=="JUDGE" || $_SESSION['UserType']=="ADMIN"){
		$query = "SELECT * FROM ADMIN where EmailId = '".$userName."'";
		 $result = mysql_query($query) or die(mysql_error());
		 $row = mysql_fetch_array($result);
		 echo"<tr><td> EmailId : </td><td> <input type='text' name = 'EmailId' value='".$row['EmailId']."' disabled></td></tr>";
		 echo"<tr><td> Name : </td><td> <input type='text' name = 'Name' value='".$row['Name']."'></td></tr>";
	}
	else if($_SESSION['UserType']=="USER"){
	     $query = "SELECT * FROM Team where EmailId = '".$userName."'";
		 $result = mysql_query($query) or die(mysql_error());
		 $row = mysql_fetch_array($result);
		 echo"<tr><td> TeamId : </td><td> <input type='text' name = 'TeamId' value='".$row['TeamId']."' disabled></td></tr>";
		 echo"<tr><td> EmailId : </td><td> <input type='text' name = 'EmailId' value='".$row['EmailId']."' disabled></td></tr>";
		 echo"<tr><td> Name : </td><td> <input type='text' name = 'Name' value='".$row['Name']."'></td></tr>";
		 echo"<tr><td> No. of Participants : </td><td> <input type='text' name = 'TotalNo' value='".$row['TotalNo']."' disabled></td></tr>";
	}
	echo "</table>";
	echo "<br><input type='submit' name='update' value='  Update  ' >&nbsp;&nbsp;&nbsp;";
	echo "<input type='submit' name='cancel' value='  Cancel  ' ></form>";
	echo "<br><h2><a href='forgotPwd.php'>Change Password</a></h2><br>";
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
?>
      </br>
      <!-- end .content --></p>
   
  </div>
    </div>
  <!-- end .container --></div>
  <div id="footer">
	&copy; My Website. All rights reserved. 
   </div>

</body>
</html>