<?php
session_start();
require_once '../lib/mysql-lib.php';
require_once '../lib/users-lib.php';

$CONN = db_sysconnect();

if(isset($_POST['setuname']))
{
	$uname=mysqli_real_escape_string($CONN,$_POST['setuname']);
	$result = mysqli_query($CONN,"SELECT collegecode FROM users WHERE uname='".$uname."';") or systemlog($_SERVER['PHP_SELF']."  SQL query error: ".mysqli_error($CONN));
	$result=mysqli_fetch_array($result);
	if(userIsColgAdmin() and $_SESSION['collegecode']==$result['collegecode'])		//can only set user from his own colg as co-admin.
	{
		mysqli_query($CONN,"UPDATE users SET utype='CADMIN' WHERE uname='".$uname."'") or systemlog($_SERVER['PHP_SELF']."  SQL query error: ".mysqli_error($CONN));
	}
}
else if(isset($_POST['removeuname']))
{
	$uname=mysqli_real_escape_string($CONN,$_POST['removeuname']);
	$result = mysqli_query($CONN,"SELECT collegecode FROM users WHERE uname='".$uname."';") or systemlog($_SERVER['PHP_SELF']."  SQL query error: ".mysqli_error($CONN));
	$result=mysqli_fetch_array($result);
	if(userIsColgAdmin() and $_SESSION['collegecode']==$result['collegecode'])		//can only set user from his own colg as co-admin.
	{
		mysqli_query($CONN,"UPDATE users SET utype='BASIC' WHERE uname='".$uname."'") or systemlog($_SERVER['PHP_SELF']."  SQL query error: ".mysqli_error($CONN));
	}
}

db_sysclose($CONN);
header('location: '.$_SERVER['HTTP_REFERER']);
?>