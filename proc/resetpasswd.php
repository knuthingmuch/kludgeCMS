<?php
session_start();
require_once '../lib/mysql-lib.php';
require_once '../lib/users-lib.php';

$random_str=substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, $MIN_PASSWD_LEN);
$random_hash=hash('sha256',$random_str);

if(userIsColgAdmin() and isset($_POST['resetuname']))
{
	if($_POST['resetuname']!=$_SESSION['uname'])
	{
		$CONN = db_sysconnect();
		$result = mysqli_query($CONN,"SELECT uid,collegecode FROM users WHERE uname='".$_POST['resetuname']."';") or systemlog($_SERVER['PHP_SELF']."  SQL query error: ".mysqli_error($CONN));
		$row = mysqli_fetch_array($result);
		
		if($row['collegecode']==$_SESSION['collegecode'] and !isSiteAdmin($row['uid']))	//user should exist and belong to same college,not be self, and not be site admin.
		{
			mysqli_query($CONN,"UPDATE users SET passwd_hash='$random_hash' WHERE uid='".$row['uid']."';") or systemlog($_SERVER['PHP_SELF']."  SQL query error: ".mysqli_error($CONN));
			$_SESSION['temp_reset_passwd']=$random_str;	//SUCCESS;
		}
		else
			$_SESSION['temp_reset_invalid']=1;	//invalid username
		db_sysclose($CONN);
	}
	else
		$_SESSION['temp_reset_isown']=1;	//can't reset own.
	header('location: ../colgadmin_users.php?colgcode='.$_SESSION['collegecode']);	//IMPLEMENT A SECURE WAY TO SEND PASSWD, use GET for now. TODO
}
else if(userIsSiteAdmin() and isset($_POST['resetuname']))
{
	if($_POST['resetuname']!=$_SESSION['uname'])
	{
		$CONN = db_sysconnect();
		$result = mysqli_query($CONN,"SELECT uid,collegecode FROM users WHERE uname='".$_POST['resetuname']."';") or systemlog($_SERVER['PHP_SELF']."  SQL query error: ".mysqli_error($CONN));
		
		if(mysqli_num_rows($result)!=0)
		{
			$row = mysqli_fetch_array($result);
			mysqli_query($CONN,"UPDATE users SET passwd_hash='$random_hash' WHERE uid='".$row['uid']."';") or systemlog($_SERVER['PHP_SELF']."  SQL query error: ".mysqli_error($CONN));
			$_SESSION['temp_reset_passwd']=$random_str;	//SUCCESS
		}
		else
			$_SESSION['temp_reset_invalid']=1;	//invalid username
		db_sysclose($CONN);
	}
	else
		$_SESSION['temp_reset_isown']=1;	//can't reset own.
	header('location: ../siteadmin_users.php');	//IMPLEMENT A SECURE WAY TO SEND PASSWD, use GET for now. TODO
}
else
	header('location: '.$_SERVER['HTTP_REFERER']) or header('location: index.php');
?> 
