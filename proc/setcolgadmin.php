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
		if(mysqli_num_rows($result)==0 or isSiteAdmin($row['uid']) or $row['collegecode']!=$_SESSION['collegecode'])	//make sure user exists & is from same colg, and not siteadmin.
			$_SESSION['temp_invalid']=1;	//username invalid
		else
		{
			mysqli_query($CONN,"UPDATE users SET utype='CADMIN' WHERE uname='".$uname."';") or systemlog($_SERVER['PHP_SELF']."  SQL query error: ".mysqli_error($CONN));
			$_SESSION['temp_success']=1;	//success
		}
	}
	else if(isset($_POST['removeuname']))
	{
		$uname=mysqli_real_escape_string($CONN,$_POST['removeuname']);
		$result = mysqli_query($CONN,"SELECT uid,collegecode FROM users WHERE uname='".$uname."';") or systemlog($_SERVER['PHP_SELF']."  SQL query error: ".mysqli_error($CONN));
		$row=mysqli_fetch_array($result);
		if($uname!=$_SESSION['uname'])	//can't unset yourself.
		{
			if(mysqli_num_rows($result)==0 or isSiteAdmin($row['uid']) or $row['collegecode']!=$_SESSION['collegecode'])	//make sure user exists & is from same colg, and not siteadmin.
				$_SESSION['temp_invalid']=1;	//username invalid
			else
			{
				if($_SESSION['collegecode']==$row['collegecode'])		//can only set user from his own colg as co-admin.
				{
					mysqli_query($CONN,"UPDATE users SET utype='BASIC' WHERE uname='".$uname."';") or systemlog($_SERVER['PHP_SELF']."  SQL query error: ".mysqli_error($CONN));
					$_SESSION['temp_success']=1;	//success
				}
				else
					$_SESSION['temp_invalid']=1;	//username invalid
			}
		}
		else
			$_SESSION['temp_isown']=1;	//can't unset oneself.
	}
	db_sysclose($CONN);
	header('location: ../colgadmin_users.php?colgcode='.$_SESSION['collegecode']);
}
else if(userIsSiteAdmin())
{
	$CONN = db_sysconnect();
	
	if(isset($_POST['setuname']) and isset($_POST['colgcode']))
	{
		//no mysqli escape str for siteAdmin.
		$result = mysqli_query($CONN,"SELECT uid,collegecode FROM users WHERE uname='".$_POST['setuname']."';") or systemlog($_SERVER['PHP_SELF']."  SQL query error: ".mysqli_error($CONN));
		$row = mysqli_fetch_array($result);
		if($row['collegecode']==$_POST['colgcode'] and !isSiteAdmin($row['uid']))	//user should exist and belong to college, and not be site admin.
		{
			mysqli_query($CONN,"UPDATE users SET utype='CADMIN' WHERE uname='".$_POST['setuname']."';") or systemlog($_SERVER['PHP_SELF']."  SQL query error: ".mysqli_error($CONN));
			$_SESSION['temp_success']=1;	//success
		}
		else
			$_SESSION['temp_invalid']=1;	//user not found in college
	}
	else if(isset($_POST['removeuname']))
	{
		$uname=mysqli_real_escape_string($CONN,$_POST['removeuname']);
		$result = mysqli_query($CONN,"SELECT uid,collegecode FROM users WHERE uname='".$uname."';") or systemlog($_SERVER['PHP_SELF']."  SQL query error: ".mysqli_error($CONN));
		$row=mysqli_fetch_array($result);
		if(mysqli_num_rows($result)==0 or isSiteAdmin($row['uid']) or $row['collegecode']!=$_POST['colgcode'])	//make sure user exists & is from specified colg, and is not siteadmin.
			$_SESSION['temp_invalid']=1;	//username invalid
		else
		{
			mysqli_query($CONN,"UPDATE users SET utype='BASIC' WHERE uname='".$uname."';") or systemlog($_SERVER['PHP_SELF']."  SQL query error: ".mysqli_error($CONN));
			$_SESSION['temp_success']=1;	//success
		}
	}
	db_sysclose($CONN);
	header('location: ../siteadmin_users.php');
}
else
	header('location: '.$_SERVER['HTTP_REFERER']) or header('location: ../index.php');
?>