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
<title>Admin Page of UT Dallas</title>
<link rel="stylesheet" type="text/css" href="default.css" />
</head>
<body>

<div id="outer">

	<div id="upbg"></div>

	<div id="inner">

		<div id="header">
			<h1><span>Admin Page of UT Dallas</span></h1>
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
    <p><h1>Welcome 
	<?php
	echo (strtok($_SESSION['myusername'],"@"));
	?>
	,</h1></p><br>
	<?php
	if(isset($_GET['success']))
		echo " ".$_GET['success'];
	?>
    <p><h2>Links for you </h2></p>
   <div class="list">
        <ul>
           <li><h4><em><strong><a href="MyAccount.php">My Account</a></strong></em></h4></li>
    	   <li><h4><em><strong><a href="contestsAvail.php">Contests Available</a></strong></em></h4></li>
    	   <li><h4><em><strong><a href="AddUser.php">Add User</a></strong></em></h4></li>
    	   <li><h4><em><strong><a href="AddJudge.php">Add Judge</a></strong></em></h4></li>
    		<li><h4><em><strong><a href="logout.php">Logout</a></strong></em></h4></li>
	    </ul>
   	</div>
   <!-- end .content --></div>
  </div>
  <!-- end .container --></div>
  <div id="footer">
		
			&copy; My Website. All rights reserved. 
		
		</div>

</body>
</html>
