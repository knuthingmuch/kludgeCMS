<?php
session_start();
require_once '../lib/mysql-lib.php';
require_once '../lib/users-lib.php';

if(userIsColgAdmin())
{
	$CONN = db_sysconnect();

	if(isset($_POST['setuname']))
	{
		$uname=mysqli_real_escape_string($CONN,$_POST['setuname']);
		$result = mysqli_query($CONN,"SELECT uid,collegecode FROM users WHERE uname='".$uname."';") or systemlog($_SERVER['PHP_SELF']."  SQL query error: ".mysqli_error($CONN));
		$row=mysqli_fetch_array($result);
		if(mysqli_num_rows($result)==0 or isSiteAdmin($row['uid']))
			$msgcode=1;
		else
		{
			mysqli_query($CONN,"UPDATE users SET utype='CADMIN' WHERE uname='".$uname."';") or systemlog($_SERVER['PHP_SELF']."  SQL query error: ".mysqli_error($CONN));
		}
	}
	else if(isset($_POST['removeuname']))
	{
		$uname=mysqli_real_escape_string($CONN,$_POST['removeuname']);
		$result = mysqli_query($CONN,"SELECT uid,collegecode FROM users WHERE uname='".$uname."';") or systemlog($_SERVER['PHP_SELF']."  SQL query error: ".mysqli_error($CONN));
		$row=mysqli_fetch_array($result);
		if($uname!=$_SESSION['uname'])	//can't unset yourself.
		{
			if(mysqli_num_rows($result)==0 or isSiteAdmin($row['uid']))
				$msgcode=1;
			else
			{
				if($_SESSION['collegecode']==$row['collegecode'])		//can only set user from his own colg as co-admin.
				{
					mysqli_query($CONN,"UPDATE users SET utype='BASIC' WHERE uname='".$uname."';") or systemlog($_SERVER['PHP_SELF']."  SQL query error: ".mysqli_error($CONN));
				}
				else
					$msgcode=1;
			}
		}
		else
			$msgcode=2;
	}
	db_sysclose($CONN);
	header('location: ../setcolgadmin.php?colgcode='.$_SESSION['collegecode'].'&msgcode='.$msgcode);
}
else
	header('location: '.$_SERVER['HTTP_REFERER']) or header('location: ../index.php');
?>