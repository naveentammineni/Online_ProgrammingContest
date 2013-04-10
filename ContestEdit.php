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
<?php
	//Reading from config file
	$ini_array = parse_ini_file("Config/config.ini");

if(isset($_GET['message']) && $_GET['message']!="")
{
	mysql_select_db($ini_array["db_name"])or die("cannot select DB");
	$contestId = $_GET['message'];
	$query = "select * from contest where ContestId =".$contestId;
	$result = mysql_query($query) or die(mysql_error());
	
	$row = mysql_fetch_array($result);
	$contestType = $row['ContestType'];
	$contestST = $row['Contest_Start_time'];
	$contestET = $row['Contest_End_Time'];
	$contestDesc = $row['Description'];
	$questions = $row['No_of_Questions'];

}
else
{
	header('location:contestsAvail.php?err=No+Contest+Selected');
}
if(isset($_GET['mode']) && $_GET['mode']=="V"){
	$dom = new DOMDocument();

	$dom->loadHTML($html);

	$xpath = new DOMXPath($dom);
	$divContent = $xpath->query('//div[id="content"]');
	
}
?>
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
    <h1>Editing Contest:</h1>
    <p>&nbsp;</p>
    <form id="form1" name="form1" method="post" action="addingContest.php">

      <table width="473" height="199" border="0">
        <tr>
          <td>Contest Id:</td>
          <td><input type="text" name="ContestId" id="ContestId" value = "<?php echo htmlentities($contestId); ?>" readonly>
          </td>
        </tr>
        <tr>
          <td width="178" height="36"><p>
          	  <label for="ContestType">ContestType</label>: </p></td>
          <td width="285"><p>
            <select name="ContestType" id="ContestType">
			 <option value="Online">Online</option>
			<?php 
			if($contestType=="Offline"){
	          echo "<option selected>Offline</option>";
			}
			else
              echo "<option>Offline</option>";
			  ?>
            </select>
          </p></td>
        </tr>
        <tr>
          <td>Start Date:</td>
          <td><input type="text" name="StartDate" id="startDate" value = "<?php echo htmlentities($contestST); ?>">
          <a href="javascript:show_calendar('form1.StartDate', form1.StartDate.value);"><img src="cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the timestamp"></a></td>
        </tr>
        <tr>
          <td>End Date :</td>
          <td><input type="text" name="EndDate" id="EndDate" value = "<?php echo htmlentities($contestET); ?>"/>
          <a href="javascript:show_calendar('form1.EndDate', form1.EndDate.value);"><img src="cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the timestamp"></a>
          </td>
        </tr>
        <tr>
          <td>Description:
            </td>
          <td>
          <textarea name="Description" id="Description" cols="45" rows="5"><?php echo htmlentities($contestDesc); ?></textarea></td>
        </tr>
        <tr>
          <td>No.of Questions :</td>
          <td><input type="text" name="questions" id="questions" value = "<?php echo htmlentities($questions); ?>"/>
          </td>
        </tr>
        <td>
        .
        </td>
        
        <tr>
          <td><input type="submit" name="Edit" id="Edit" value="Edit Questions" /></td>
          <td><input type="reset" name="Cancel" style="width: 80px" id="Cancel" value="Cancel" /></td>
        </tr>
      </table>
      <p>&nbsp;</p>
      <p>
        <label for="startDate"></label>
      </p>
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
