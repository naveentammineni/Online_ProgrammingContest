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
				<li><a href="MyAccount.php">My Account</a></li>
				<li><a href="UserAvailableContest.php">Contest Available</a></li>
				<li><a href="UserScores.php">Scores</a></li>
				<li><a href="logout.php">Logout</a></li>
			</ul>

	
		</div> 
		
  <div class="content">
    <p>Welcome 
	<?php
	echo ($_SESSION['myusername']);
	?>
	,</p>
    <p>User details   </p>
  <!-- end .content --></div>
  </div>
  <!-- end .container --></div>
</body>
</html>
