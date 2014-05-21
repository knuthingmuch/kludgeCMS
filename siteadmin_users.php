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
<?php
	if(isset($_GET['msgcode']))
	{
		if($_GET['msgcode']==11)
			echo "Successful.";
		elseif($_GET['msgcode']==12)
			echo "User does not belong to specified college, cannot grant admin priviledges.";
	}
?>
	<br/>
	<a href="siteadmin_users.php">REFRESH</a>
	<hr/>
<?
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
