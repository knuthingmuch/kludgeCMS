<?php
session_start();
require_once '../lib/mysql-lib.php';

if(isset($_SESSION['uid']))
{
	$CONN=db_sysconnect();
	$result = mysqli_query($CONN,"SELECT uid,passwd_hash FROM users WHERE uid='".$_SESSION['uid']."';") or systemlog($_SERVER['PHP_SELF']."  SQL query error: ".mysqli_error($CONN));
	
	$givenpasswd_hash=hash('sha256', $_POST['currentpass']);
	
	if($result)
	{
		$row = mysqli_fetch_array($result);
		
		if($row['passwd_hash']==$givenpasswd_hash)
		{
			if(isset($_POST['newpass1']) and isset($_POST['newpass2']) and hash('sha256', $_POST['newpass1'])==hash('sha256', $_POST['newpass2']))
			{
				if(strlen($_POST['newpass2'])>=$MIN_PASSWD_LEN)
				{
					$newpasswd_hash=hash('sha256', $_POST['newpass2']);
					mysqli_query($CONN,"UPDATE users SET passwd_hash='$newpasswd_hash' WHERE uid='".$_SESSION['uid']."';") or systemlog($_SERVER['PHP_SELF']."  SQL query error: ".mysqli_error($CONN));
					$_SESSION['temp_success']=1;	//success
				}
				else
					$_SESSION['temp_minlen']=1;	//password should be at least MIN_PASSWD_LEN characters in length., value set in mysql-lib.php
			}
			else
				$_SESSION['temp_nomatch']=1;	//do not match
		}
		else
			$_SESSION['temp_wrongpass']=1;	//wrong passwd
	}
	db_sysclose($CONN);
	header('location: ../accountinfo.php?msgcode='.$msgcode);
}
else
	header('location: '.$_SERVER['HTTP_REFERER']) or header('location: ../index.php');
?>
