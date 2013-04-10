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

  if(isset($_GET['message'])){
	$contestId =$_GET['message'];
  }
$orderBy = array('submissionId', 'teamId', 'score');

$order = 'submissionId';
if (isset($_GET['orderBy']) && in_array($_GET['orderBy'], $orderBy)) {
    $order = $_GET['orderBy'];
}

mysql_select_db($ini_array["db_name"])or die("cannot select DB");
$query = "SELECT * FROM submission_score WHERE ContestId = '".$contestId."' ORDER BY ".$order; 
$result = mysql_query($query) or die(mysql_error());
echo  "<form id='form2' name='form2' method='post' action='ContestOperation.php'><table border='1'><tr>
	   <th><a href='?orderBy=submissionId'>SubmissionId</a></th>
	   <th><a href='?orderBy=teamId'>TeamId</a></th>
	   <th><a href='?orderBy=score'>Score</a></th>
	   </tr>";

while($row = mysql_fetch_array($result)){
	echo  "<tr><td>".  $row['submissionId']. "</td><td>".$row['teamId']."</td><td>". $row['score']. "</td></tr>";
}
echo "</table>";
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