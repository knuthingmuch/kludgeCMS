<?php
session_start();
require_once '../lib/mysql-lib.php';
require_once '../lib/users-lib.php';

if(isset($_SESSION['uid']) and (isColgAdmin($_SESSION['uid']) or isSiteAdmin($_SESSION['uid'])))
{
	//aboutdata is already converted into html entities by ckeditor.
	$colgname=htmlspecialchars($_POST['colgname'],ENT_QUOTES);	//otherwise might have problems displaying
	
	$CONN = db_sysconnect();
	$colgname=mysqli_real_escape_string($CONN,$colgname);
	$aboutdata=mysqli_real_escape_string($CONN,$_POST['aboutdata']);
	
	mysqli_query($CONN,"UPDATE colleges SET about='".$aboutdata."',collegename='".$colgname."' WHERE collegecode='".$_SESSION['tempcolgcode']."';") or systemlog($_SERVER['PHP_SELF']."  SQL query error: ".mysqli_error($CONN)); //and die?? TODO
	
	db_sysclose($CONN);
	header('location: ../colgmainpage.php?colgcode='.$_SESSION['tempcolgcode']);	//temp since collegecode not set for siteadmin
}
else
{
	header('location: '.$_SERVER['HTTP_REFERER']) or header('location: ../index.php');	//ERROR PAGE/ACCESS DENIED	TODO
}
unset($_SESSION['tempcolgcode']);
?> 
