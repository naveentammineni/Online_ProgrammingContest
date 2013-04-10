<?php
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
				<li><a href="MyAccount.php">My Account</a></li>
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

$result = mysql_query("
SELECT a.teamid, a.contestid, a.questionid, a.judgeid, a.score, b.submissiontime, b.submissioncount
FROM submission_score a, submission_history b
WHERE a.submissionid = b.submissionid
AND a.questionid = b.questionid
AND a.teamid = b.teamid AND a.contestid = '" . mysql_real_escape_string($_GET["contestId"]) . "'");

echo "<table border='1'>
<tr>
 <th>Team Name</th>
 <th>Contest Name</th>
 <th>Problem</th>
 <th>Judge</th>
 <th>Score</th>
 <th>Submission Time</th>
 <th>Submission Count</th>
</tr>";

while($row = mysql_fetch_array($result))
  {
	echo "<tr>";
  echo "<td>" . $row[0] . "</td>";
  echo "<td>" . $row[1] . "</td>";
  echo "<td>" . $row[2] . "</td>";
  echo "<td>" . $row[3] . "</td>";
  echo "<td>" . $row[4] . "</td>";
  echo "<td>" . $row[5] . "</td>";
  echo "<td>" . $row[6] . "</td>";
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