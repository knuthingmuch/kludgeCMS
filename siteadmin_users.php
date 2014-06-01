<?php
$PAGETITLE="NSS Goa | User Management";
session_start();
require_once 'markup/template_top.php';
require_once 'lib/mysql-lib.php';

if(userIsSiteAdmin())
{
	$CONN=db_sysconnect();
	$result=mysqli_query($CONN,"SELECT collegecode,collegename FROM colleges;") or systemlog($_SERVER['PHP_SELF']."  SQL query error: ".mysqli_error($CONN));
?>
	<br/>
	<span>Set user as college admin.</span>
	<form action="proc/setcolgadmin.php" method="post">
	Username:<input type="text" name="setuname">
	College:<select name="colgcode">
<?php
	while($row=mysqli_fetch_array($result))
	{
		echo "<option value='".$row['collegecode']."'>".$row['collegename']."</option>";
	}
?>
	</select>
	<input type="submit" value="Set">
	</form>
	<hr/>
	<span>Remove user as college admin.</span>
	<form action="proc/setcolgadmin.php" method="post">
	Username:<input type="text" name="removeuname">
	College:<select name="colgcode">
<?php
	$result=mysqli_query($CONN,"SELECT collegecode,collegename FROM colleges;") or systemlog($_SERVER['PHP_SELF']."  SQL query error: ".mysqli_error($CONN));
	while($row=mysqli_fetch_array($result))
	{
		echo "<option value='".$row['collegecode']."'>".$row['collegename']."</option>";
	}
?>
	</select>
	<input type="submit" value="Remove">
	</form>
	<hr/>
<?php
	if(isset($_SESSION['temp_success']))
	{
		echo "Successful.";
		unset($_SESSION['temp_success']);
	}
	elseif(isset($_SESSION['temp_invalid']))
	{
		echo "User does not exist or belong to specified college, cannot change priviledges.";
		unset($_SESSION['temp_invalid']);
	}
?>
	<br/>
	<a href="siteadmin_users.php">REFRESH PAGE</a>
	<hr/>
	
	<span>Reset password for user:</span>
	<form action="proc/resetpasswd.php" method="post">
	Username:<input type="text" name="resetuname">
	<input type="submit" value="Reset">
	</form>
<?php
	if(isset($_SESSION['temp_reset_passwd']))
	{
		echo "Password successfuly reset. New password is:&nbsp; ".$_SESSION['temp_reset_passwd']." &nbsp;(all lowercase)";
		unset($_SESSION['temp_reset_passwd']);
	}
	elseif(isset($_SESSION['temp_reset_invalid']))
	{
		echo "Invalid username. User does not exist, or doesn't belong to your college.";
		unset($_SESSION['temp_reset_invalid']);
	}
	elseif(isset($_SESSION['temp_reset_isown']))
	{
		echo "Cannot reset your own password.";
		unset($_SESSION['temp_reset_isown']);
	}
?>
<?
	db_sysclose($CONN);
}
else
{
?>
	<div id="error">
	You do not have the priviledges required to access this page.
	</div>
<?php
}

require_once 'markup/template_botm.php';
?>
