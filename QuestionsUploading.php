<?php
session_start();
//Reading from config file
$ini_array = parse_ini_file("Config/config.ini");

if(!isset($_SESSION['myusername']))
	header("location:index.php");
else if(isset($_SESSION['myusername'])&&$_SESSION['UserType'] != "ADMIN"){
	header("location:index.php");
}
else {
	ob_start();
	
	// Values sent from form 
	$contestId=$_POST['ContestId'];
	$questions=$_POST['Questions']; 
	$path =array();
	$type = array();
	
	//Setting the Contest Upload path
	$upload_path = "Questions/".$contestId."/";
	
	if (!is_dir($upload_path)) {
    	mkdir($upload_path);
	}
	//reading the Question files
	for($k =0;$k<$questions;$k++){
		$path[$k] = $upload_path.$_FILES['ufile']['name'][$k];
		$type[$k] = $_FILES['ufile']['type'][$k];
		$weightage[$k] = $_POST['weightage_'.($k+1)];
	}
	
	//copy file to where you want to store file
	for($j = 0;$j<$questions;$j++){
		if($_FILES['ufile']['error'][$j] > 0)
		{
			 $errmsg = "problem+in+reading+question+no+".$i;
			 continue;
		}
		copy($_FILES['ufile']['tmp_name'][$j], $path[$j]);
		echo $path[$j];
	}
	
	// select databse.
	mysql_select_db($ini_array["db_name"])or die("cannot select DB");
	
	$errmsg ="";
	if($contestId >0 && $questions >0)
	{
		for($i=0;$i<$questions;$i++){
			$sql="INSERT INTO QUESTIONS (`questionId` ,`questionType` ,`weightage` ,`filePath` ,`contestId`)
			 VALUES ('".$i."','".$type[$i]."','".$weightage[$i]."','".$path[$i]."', '".$contestId."');";
			 $result = mysql_query($sql);
		}
	}
	
	ob_end_flush();
	if($errmsg !="")
		header('location:contestsAvail.php?success='.$errmsg);
	else
		header('location:contestsAvail.php?success=Contest+Created+Successfully');
}
?>