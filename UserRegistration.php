<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>User Registration</title>
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
<script type="text/javascript">
	function display_div(show){
	   document.getElementById('1').style.display = "none";
	   document.getElementById('2').style.display = "none";
	   document.getElementById('3').style.display = "none";
	   document.getElementById(show).style.display = "block";
	
	}
</script>

</head>

<body>

<div class="content">
</div>
  <div class="content">
    <ul class="nav">
      <li><a href="index.php">Login</a></li>
    </ul>
    <!-- end .sidebar1 --></div>
    
  <div class="content"><br /><br /><br />
  
  <br /><br /><br />
  <?php
  		if(isset($_GET['message'])){
			$message =$_GET['message'];
			if(isset($message)) { 
				echo "<div id='error_msg'>".$message."</div>"; 
			}
		}
	?>
    <form method="post" action="registrationCheck.php" name="form1" class="style1">
       <p>&nbsp;</p>
       <h1> User Registration</h1><br /><br />
       <FONT FACE="arial" SIZE="2">
      <table width="372" border="0">
        <tr>
          <td width="181">User Email :</td>
          <th width="175" nowrap="nowrap"> <div align="left">
            <input type="text"  name="emailid" />
          </div></th>
        </tr>
        <tr>
          <td>Password : </td>
          <th nowrap="nowrap"> <div align="left">
            <input type="password"  name="password1" />
          </div></th>
        </tr>
        <tr>
          <td>Re-Enter Password:</td>
          <th nowrap="nowrap"><div align="left">
            <input type="password"  name="password2" />
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
         
<select id="members" name="members">
  <option selected="selected"> </option>
  <?php
  for($var =1;$var<=5;$var++)
  {
  echo "<option value=\"$var\">$var</option>";
  }
  ?>
</select>
          </div></th>
        </tr>
      </table>
      <p>&nbsp; </p>
      <p>
        <input type="submit" name="Submit" value="Submit" />
        <input type="reset" name="Submit2" value="Reset" />

      </p>
      </FONT>
    </form>
    <form >
        <input type="submit" name="Submit3" value="Cancel"   onclick="form.action='index.php';"/>
        </form>
    <h1>&nbsp;</h1>
    <!-- end .content --></div>
  <div class="footer">
    <p>Copyrights</p>
    <!-- end .footer --></div>
<!-- end .container --></div>
<div id="footer">
		
			&copy; My Website. All rights reserved. 
		
		</div>

</body>
</html>