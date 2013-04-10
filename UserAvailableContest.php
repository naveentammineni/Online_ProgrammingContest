<?php
session_start();
if(!isset($_SESSION['myusername']))
	header("location:index.php");
else if(isset($_SESSION['myusername'])&&$_SESSION['UserType'] != "USER"){
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
				<li class="first"><a href="Userindex.php">Home</a></li>
				<li><a href="UserHome.php">My Account</a></li>
				<li><a href="UserAvailableContest.php">Contests Available</a></li>
				<li><a href="UserScores.php">Scores</a></li>
				<li><a href="logout.php">Logout</a></li>
			</ul>

	
		</div> 
		
  <div class="content">
<?php
	mysql_select_db("test")or die("cannot select DB");
	$query = "SELECT * FROM contest "; 
	$result = mysql_query($query) or die(mysql_error());
	echo       "<table border=\"1\"><tr>
		   <th>Contest Id</th>
		   <th>Contest Type</th>
		   <th>Contest Start Time</th>
		   <th>Contest End Time</th>
		   <th>Contest Description</th>
		   </tr>";
	while($row = mysql_fetch_array($result)){
		echo  "<tr>". "<td>".  $row['ContestId']. "</td>". "<td>". $row['ContestType']. "</td>". "<td>". $row['Contest_Start_time']. "</td>". "<td>". $row['Contest_End_Time']. "</td>". "<td>". $row['ContestDescription']. "</td>". "</tr>";
	}
	echo "</table>";
?>
 </br>
    <h1><p>Registered Contests</p></h1>
	<?php
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
	 ?>
	 </br>
	 <form name="form1" method="post" action="UserinputContest.php">
      <label>Enter the contestID that you want to register:
        <input type="text" name="contestid" />
      </label>
	        <label>
        <input type="submit" name="Submit" value="Submit" size="3" />
      </label>
	</form>
	 </br>
	 </br>
	<?php
	$exist = $_SESSION['result'];
	if(!($exist==1)){ echo ("The contest does not exist");}	 ?>
    <!-- end .content --></div>
    </div>
  <!-- end .container --></div>
</body>
</html>