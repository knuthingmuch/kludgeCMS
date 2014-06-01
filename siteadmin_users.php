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
	if(isset($_GET['msgcode']))
	{
		if($_GET['msgcode']==11)
			echo "Successful.";
		elseif($_GET['msgcode']==12)
			echo "User does not exist or belong to specified college, cannot change priviledges.";
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
	if(isset($_GET['msgcode']))
	{
		if($_GET['msgcode']==90)
			echo "Successfuly reset. New password is:&nbsp; ".$_GET['p']." &nbsp;(all lowercase)";
		elseif($_GET['msgcode']==91)
			echo "Invalid username.";
		elseif($_GET['msgcode']==93)
			echo "Cannot reset your own password.";
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
