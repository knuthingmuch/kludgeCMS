<?php
session_start();
require_once '../lib/mysql-lib.php';
require_once '../lib/users-lib.php';

if(isset($_SESSION['uid']) and isColgAdmin($_SESSION['uid']) or isSiteAdmin($_SESSION['uid']))
{
	//aboutdata is already converted into html entities by ckeditor.
	$colgname=htmlspecialchars($_POST['colgname'],ENT_QUOTES);
	
	$CONN = db_sysconnect();
	$colgname=mysqli_real_escape_string($CONN,$colgname);
	$aboutdata=mysqli_real_escape_string($CONN,$_POST['aboutdata']);
	
	mysqli_query($CONN,"UPDATE colleges SET about='".$aboutdata."',collegename='".$colgname."' WHERE collegecode='".$_SESSION['tempcolgcode']."';") or systemlog("SQL query error: ".mysql_error()); //and die?? TODO
	
	db_sysclose($CONN);
	header('location: ../colgmainpage.php?colgcode='.$_SESSION['tempcolgcode']);	//not set for siteadmin
}
else
{
	header('location: '.$_SERVER['HTTP_REFERER']) or header('location: ../index.php');	//ERROR PAGE/ACCESS DENIED	TODO
}
unset($_SESSION['tempcolgcode']);
?> 
