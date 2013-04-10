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
<script type="text/javascript">
    function jsFunction(contestNo){
		var url = "Submissions.php?contestId="+contestNo;
		alert(url);
		document.forms["myForm"].action = url;
		
		document.forms["myForm"].submit();
}
</script>
<body>
<form name="myForm" id="myForm" method="GET">
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
				<li><a href="#">My Account</a></li>
                <li><a href="UserAvailableContest.php">Contest Available</a></li>
				<li><a href="UserScores.php">Scores</a></li>
				<li><a href="logout.php">Logout</a></li>
			</ul>

	
		</div> 
		
  <div class="content">
  <?php
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("test", $con);
	$user = $_SESSION['myusername'];
$result = mysql_query("SELECT a.contestid,submissionid,sum(score) 
                       FROM submission_score as a, team as b
					   WHERE b.TeamUserName='$user' and a.TeamId = b.TeamId and a.contestid=b.contestid  
					   group by a.teamid,a.contestid,questionid,submissionid");

echo "<table border='1'>
<tr>
 <th>Contest Name</th>
 <th>Submission</th>
 <th>Scores</th>  
</tr>";

while($row = mysql_fetch_array($result))
  {
	echo "<tr>";
  //echo "<td><a href=# onClick='jsFunction(" . $row[0] . ");'>" . $row[0] . "</a></td>";
  echo "<td><a href='Submissions.php?contestId=" . $row[0] . "'>" . $row[0] . "</a></td>";
  echo "<td>" . $row[1] . "</td>";
  echo "<td>" . $row[2] . "</td>";
   echo "</tr>";
  }
echo "</table>";



mysql_close($con);
?>   
	
    <!-- end .content --></div>
    </div>
  <!-- end .container --></div>
  </form>
</body>
</html>