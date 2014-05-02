<?php
require_once 'mysql-lib.php';
require_once 'system-lib.php';

function isSiteAdmin($uid)	//isASiteAdmin???
{
	$SYSCONN=db_sysconnect();
	
	$result = mysqli_query($SYSCONN,"SELECT utype FROM users WHERE uid=$uid") or systemlog("SQL query error: ".mysql_error());
	db_sysclose($SYSCONN);
	
	if ($result)
	{
		$row = mysqli_fetch_array($result);		//uid is primary, so only one row returned.
		if($row['utype']=='SADMIN')
			return true;
		else
			return false;
	}
	else
		return false;
}

function isColgAdmin($uid)
{
	$SYSCONN=db_sysconnect();
	
	$result = mysqli_query($SYSCONN,"SELECT utype FROM users WHERE uid=$uid") or systemlog("SQL query error: ".mysql_error());
	db_sysclose($SYSCONN);
	
	if ($result)
	{
		$row = mysqli_fetch_array($result);		//uid is primary, so only one row returned.
		if($row['utype']=='CADMIN')
			return true;
		else
			return false;
	}
	else
		return false;
}

function login($uname,$passwd)
{
	$SYSCONN=db_sysconnect();
	
	$passwd_hash = hash('sha256', $passwd);
	
	$result = mysqli_query($SYSCONN,"SELECT uid,uname,fullname,passwd_hash,collegecode FROM users WHERE uname='$uname';") or systemlog("SQL query error: ".mysql_error());

	db_sysclose($SYSCONN);
	
	if($result)
	{
		$row = mysqli_fetch_array($result);		//uname is unique, so only one row returned.
		
		if($row['uname']==$uname and $row['passwd_hash']==$passwd_hash)
		{
			session_start();
			$_SESSION['uid']=$row['uid'];
			$_SESSION['uname']=$row['uname'];
			$_SESSION['fullname']=$row['fullname'];
			$_SESSION['collegecode']=$row['collegecode'];
			return true;
		}
		else
			return false;
	}
	else
		return false;
}
?>
