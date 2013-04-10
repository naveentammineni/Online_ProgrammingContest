<?php
session_start();
if(!isset($_SESSION['myusername']))
	header("location:index.php");
else if(isset($_SESSION['myusername'])&&$_SESSION['UserType'] != "ADMIN"){
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

 	if(isset($_GET['id']) && $_GET['id']!=""){
		$contestId =$_GET['id'];
		mysql_select_db($ini_array["db_name"])or die("cannot select DB");
		$sql ="select * from contest where ContestId=".$contestId;
		$result = mysql_query($sql) or die(mysql_error());
		$row = mysql_fetch_array($result);
		$questions = $row['No_of_Questions'];
		echo  "<form enctype='multipart/form-data' id='form1' name='form1' method='POST' action='QuestionsUploading.php'>";

		echo "<input type='hidden' name='Questions' value='".$questions."' />";
		echo "<input type='hidden' name='ContestId' value='".$contestId."' />";
		echo  "<table border='1'><tr><th>Question No</th><th>Question File Upload</th><th>Weightage</th></tr>";
		for($i=1;$i<=$questions;$i++){
			echo "<tr><td>Question $i :</td>";
			echo "<td> 
			Choose a file to upload: <input name='ufile[]' type='file' id='ufile[]' size='50' /><br /></td>";
			echo "<td> <input type='text'  name='weightage_$i' /></td></tr>";
		}
		echo "</table><br><input type='submit' value='Upload Files' /></form>";
	}
	
  ?>
	
	 </br>
    <!-- end .content --></div>
    </div>
    
  <div id="footer">
	&copy; My Website. All rights reserved. 
   </div>
  <!-- end .container --></div>

</body>
</html>