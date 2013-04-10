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
<div class="content">
    <h1>Add Team</h1>
     <?php
		if(isset($_GET['message'])){
            $success =$_GET['message'];
			if(isset($success)) { echo $success; }
		}
        ?>
    <form name="form1" method="post" action="registrationCheck.php">
      <p>&nbsp;</p>
      <table width="372" border="0">
        <tr>
          <td width="181">User Email :</td>
          <th width="175" nowrap="nowrap"> <div align="left">
            <input type="text" name="emailid" />
          </div></th>
        </tr>
        <tr>
          <td>Password : </td>
          <th nowrap="nowrap"> <div align="left">
            <input type="password" name="password1" />
          </div></th>
        </tr>
        <tr>
          <td>Re-Enter Password:</td>
          <th nowrap="nowrap"><div align="left">
            <input type="password" name="password2" />
          </div></th>
        </tr>
        <tr>
          <td>Team  Name:</td>
          <th nowrap="nowrap"><div align="left">
            <input type="text" name="team" />
          </div></th>
        </tr>
        <tr>
          <td>Total Members:</td>
          <th nowrap="nowrap"><div align="left">
            <input type="text" name="members" />
          </div></th>
        </tr>
      </table>
      <p>&nbsp; </p>
      <p>
        <input type="submit" name="Submit" value="Submit" />
        <input type="reset" name="Submit2" value="Reset" />
      </p>
    </form>
    <form>
        <input type="submit" name="Submit3" value="Cancel"   onclick="form.action='AdminHome.php';"/>
 </form>
    <!-- end .content --></div>
  <div id="footer">
		
			&copy; My Website. All rights reserved. 
		
		</div>

  <!-- end .container --></div>
  <!-- end .content --></div>
  </div>
  <!-- end .container --></div>
</body>
</html>
