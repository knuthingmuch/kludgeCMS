<?php
require_once 'mysql-lib.php';
require_once 'system-lib.php';

function isSiteAdmin($uid)	//isASiteAdmin???
{
	$CONN=db_sysconnect();
	
	$result = mysqli_query($CONN,"SELECT utype FROM users WHERE uid=$uid") or systemlog("SQL query error: ".mysqli_error($CONN));
	db_sysclose($CONN);
	
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

function userIsSiteAdmin()
{
	if(isset($_SESSION['utype']) and $_SESSION['utype']=='SADMIN')
		return true;
	else
		return false;
}

function isColgAdmin($uid)
{
	$CONN=db_sysconnect();
	
	$result = mysqli_query($CONN,"SELECT utype FROM users WHERE uid=$uid") or systemlog("SQL query error: ".mysqli_error($CONN));
	db_sysclose($CONN);
	
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

function userIsColgAdmin()
{
	if(isset($_SESSION['utype']) and $_SESSION['utype']=='CADMIN')
		return true;
	else
		return false;
}

function login($uname,$passwd)
{
	$CONN=db_sysconnect();
	
	$passwd_hash = hash('sha256', $passwd);
	
	$result = mysqli_query($CONN,"SELECT uid,uname,utype,fullname,passwd_hash,collegecode FROM users WHERE uname='$uname';") or systemlog("SQL query error: ".mysqli_error($CONN));

	db_sysclose($CONN);
	
	if($result)
	{
		$row = mysqli_fetch_array($result);		//uname is unique, so only one row returned.
		
		if($row['uname']==$uname and $row['passwd_hash']==$passwd_hash)
		{
			session_start();
			$_SESSION['uid']=$row['uid'];
			$_SESSION['uname']=$row['uname'];
			$_SESSION['utype']=$row['utype'];
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
