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
<script language="JavaScript" src="ts_picker.js">
</script>
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
    <h1>Add Contest:</h1>
    <p>&nbsp;</p>
    <form id="form1" name="form1" method="post" action="addingContest.php">
      <table width="473" height="199" border="0">
        <tr>
          <td width="178" height="36"><p>
            <label for="ContestType">ContestType</label>: </p></td>
          <td width="285"><p>
            <select name="ContestType" id="ContestType">
              <option>Online</option>
              <option>Offline</option>
            </select>
          </p></td>
        </tr>
        <tr>
          <td>Start Date:</td>
          <td><input type="text" name="StartDate" id="startDate" />
          <a href="javascript:show_calendar('form1.StartDate', form1.StartDate.value);"><img src="cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the timestamp"></a></td>
        </tr>
        <tr>
          <td>End Date :</td>
          <td><input type="text" name="EndDate" id="EndDate" />
          <a href="javascript:show_calendar('form1.EndDate', form1.EndDate.value);"><img src="cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the timestamp"></a>
          </td>
        </tr>
        <tr>
          <td>Description:</td>
          <td><textarea name="Description" id="Description" cols="45" rows="5"></textarea></td>
        </tr>
         <tr>
          <td>No.of Questions :</td>
          <td><input type="text" name="questions" id="questions" />
          </td>
        </tr>
        <td>
        .
        </td>
        <tr>
          <td><input type="submit" name="Add" id="Add" style="width: 80px"  value="Add" /></td>
          <td><input type="reset" name="Cancel" style="width: 80px" id="Cancel" value="Cancel" /></td>
        </tr>
        
      </table>
      <p>&nbsp;</p>
     
    </form>
    <p>&nbsp;</p>
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
