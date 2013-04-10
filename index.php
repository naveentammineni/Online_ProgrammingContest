<?php
session_start();
if(isset($_SESSION['myusername'])){
	if($_SESSION['UserType']=="JUDGE"){
		header("location:JudgeHome.php");
	}
	else if($_SESSION['UserType']=="ADMIN"){
		header("location:AdminHome.php");
	}
	else if($_SESSION['UserType']=="USER"){
		header("location:UserHome.php");
	}

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
			<h1><span>Contest Page of <br>
            UT Dallas</span></h1>
			<h2></h2>
		</div>
	
		<div id="splash"></div>
	
<div id="menu">
<h1> Welcome to Contest Page of UT Dallas </h1>
</div>
		<div id="primarycontent">
		    <div class="content" align="center">
		<?php
		if(isset($_GET['success'])){
            $success =$_GET['success'];
			if(isset($success)) { echo $success; }
		}
        ?>
  <form name="form1" method="post" action="loginCheck.php">
	<p>&nbsp;</p>
	<table width="312" height="107" border="0">
	  <tr>
	    <td><label>Email: </label></td>
	    <td><input type="text" name="emailid" /></td>
	    </tr>
	  <tr>
	    <td>Password :</td>
	    <td><input type="password" name="password" /></td>
	    </tr>
	  <tr>
	    <td><input type="submit" name="Submit" value="Submit" /></td>
	    <td><input type="reset" name="Submit2" value="Reset" /></td>
	    </tr>
	  </table>
	<p>&nbsp;</p>
    <h3><strong>Not a Member yet? <a href="UserRegistration.php">Register </a></strong></h3>
      <p>&nbsp;</p>
	</div>
    </div>
	</form>
		<div id="footer">
		
			&copy; My Website. All rights reserved. 
		
		</div>

	</div>

</div>

</body>
</html>