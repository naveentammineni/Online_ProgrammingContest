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
  <?php
  if(isset($_GET['err'])){
		$err =$_GET['err'];
		if(isset($err)) { 
			echo $err;
		}
  }
  ?>
    <h2>
      </br>
      <strong>Password Change</strong>:</h2>
    <p>&nbsp;</p>
    <form name="form1" method="post" action="UpdatePwd.php">
    <table width="313" border="0">
      <tr>
        <td width="148">Current Password: </td>
        <td width="149"><input type="password" name="CurPwd" id="CurPwd"></td>
      </tr>
      <tr>
        <td>New Password:</td>
        <td><input type="password" name="NewPwd" id="NewPwd"></td>
      </tr>
      <tr>
        <td>Re-Type Password:</td>
        <td><input type="password" name="RetypePwd" id="RetypePwd"></td>
      </tr>
      <tr>
        <td><input type="submit" name="Change" id="Change" value="Change"></td>
        <td><input type="submit" name="Cancel" id="Cancel" value="Cancel"></td>
      </tr>
</table></form>
    <p>&nbsp;</p>
   
  </div>
    </div>
  <!-- end .container --></div>
  <div id="footer">
	&copy; My Website. All rights reserved. 
   </div>

</body>
</html>