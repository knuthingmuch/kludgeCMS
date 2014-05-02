<?php
session_start();
require_once '../lib/mysql-lib.php';
require_once '../lib/users-lib.php';

if(isset($_SESSION['uid']) and isColgAdmin($_SESSION['uid']) or isSiteAdmin($_SESSION['uid']))
{
	$SYSCONN = db_sysconnect();
	mysqli_query($SYSCONN,"UPDATE colleges SET about='".$_POST['aboutdata']."' WHERE collegecode='".$_SESSION['collegecode']."';") or systemlog("SQL query error: ".mysql_error()); //and die?? TODO
	
	db_sysclose($SYSCONN);
	header('location: ../colgmainpage.php?colgcode='.$_SESSION['collegecode']);
}
else
{
	header('location: '.$_SERVER['HTTP_REFERER']) or header('location: ../index.php');	//ERROR PAGE/ACCESS DENIED	TODO
}
?> 
