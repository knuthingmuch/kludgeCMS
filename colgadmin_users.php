<?php
$PAGETITLE="NSS Goa | User Management";
session_start();

if(isset($_GET['colgcode']))
{
	require_once 'markup/template_top.php';
	if(userIsColgAdmin() and $_GET['colgcode']==$_SESSION['collegecode'])
	{
?>
	<div>User Management: <?php echo $_SESSION['collegecode'] ?></div>
	<span>All college admins may post under their own college sections but cannot edit each others posts.</span>
	<br/><br/>
	<form action="proc/setcolgadmin.php" method="post">
	<span>Set the following user as your college co-administrator.</span>
	<br/>
	Username: <input type="text" name="setuname">
	<input type="submit" value="Set">
	</form>
	<hr/>
	<span>Remove the following user as your college co-administrator.</span>
	<br/>
	<form action="proc/setcolgadmin.php" method="post">
	Username: <input type="text" name="removeuname">
	<input type="submit" value="Unset">
	</form>
<?php
	if(isset($_SESSION['temp_success']))
	{
		echo "User priviledges successfully changed.";
		unset($_SESSION['temp_success']);
	}
	else if(isset($_SESSION['temp_invalid']))
	{
		echo "The username you typed is invalid.";
		unset($_SESSION['temp_invalid']);
	}
	else if(isset($_SESSION['temp_isown']))
	{
		echo "You can't unset youself, ask another admin to do so.";
		unset($_SESSION['temp_isown']);
	}
?>
	<br/>
	<a href="colgadmin_users.php?colgcode=<?php echo $_GET['colgcode']; ?>">REFRESH PAGE</a>
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
else
	header('location: '.$_SERVER['HTTP_REFERER']) or header('location: index.php'); //TODO

require_once 'markup/template_botm.php';
?>