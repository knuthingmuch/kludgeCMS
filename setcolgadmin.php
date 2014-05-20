<?php
$PAGETITLE="NSS Goa | Set Administrator";
session_start();
require_once 'markup/template_top.php';

if(isset($_GET['colgcode']))
{
	if(userIsColgAdmin() and $_GET['colgcode']==$_SESSION['collegecode'])
	{
?>
	<span>All college admins may post under their own college sections but cannot edit each others posts.</span>
	<br/><br/>
	<form action="proc/colgadminset.php" method="post">
	<span>Set the following user as your college co-administrator.</span>
	<br/>
	Username: <input type="text" name="setuname">
	<input type="submit" value="Set">
	</form>
	<hr/>
	<span>Remove the following user as your college co-administrator.</span>
	<br/>
	<form action="proc/colgadminset.php" method="post">
	Username: <input type="text" name="removeuname">
	<input type="submit" value="Unset">
	</form>
<?php
	if(isset($_GET['msgcode']))
	{
		if($_GET['msgcode']==1)
			echo "The username you typed is invalid.";
		else if($_GET['msgcode']==2)
			echo "You can't unset youself, ask another admin to do so.";
	}
?>
	<br/>
	<span>Note: These changes won't take effect until the specified user logs out.</span>
	<br/>
	<hr/>
	<br/><br/>
	<table id="adminlist">
	
<?php
	$CONN = db_sysconnect();
	$result = mysqli_query($CONN,"SELECT uname,fullname FROM users WHERE uid!=".$_SESSION['uid']." and utype='CADMIN' and collegecode='".$_SESSION['collegecode']."';") or systemlog($_SERVER['PHP_SELF']."  SQL query error: ".mysqli_error($CONN));	//own name not displayed
	
	if(mysqli_num_rows($result)!=0)
	{
		echo "<span>Your college co-administrators are:</span><tr><th>Username</th><th>Full name</th></tr>";
		while($row = mysqli_fetch_array($result))
		{
			echo "<tr><td>".$row['uname']."</td><td>".$row['fullname']."</td></tr>";
		}
		echo "</table>";
	}
	else
		echo "You are the only admin from your college.";

	$result = mysqli_query($CONN,"SELECT COUNT(*) as count FROM users WHERE collegecode='".$_SESSION['collegecode']."';") or systemlog($_SERVER['PHP_SELF']."  SQL query error: ".mysqli_error($CONN));
	$result = mysqli_fetch_array($result);
	db_sysclose($CONN);
?>
	</table>
	<hr/>
	Total registered users from your college: <?php echo $result['count']; ?>
<?php
	}
	else
	{
	?>
		<div id="error">
		You do not have the priviledges required to access this page or requested resource does not exist.
		</div>
<?php
	}
}

require_once 'markup/template_botm.php';
?>