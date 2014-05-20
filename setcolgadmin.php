<?php
$PAGETITLE="NSS Goa | Set Administrator";
session_start();
require_once 'markup/template_top.php';

if(isset($_GET['colgcode']))
{
	if(userIsColgAdmin() and $_GET['colgcode']==$_SESSION['collegecode'])
	{
?>
	<span>Note: All college admins may post under their own college sections but cannot edit each others posts.</span>
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
	<hr/>
	<br/><br/>
	<span>Your college co-administrators are:</span>
	<br/>
	<table id="adminlist">
	<tr>
	<th>Username</th><th>Full name</th>
	</tr>
<?php
	$CONN = db_sysconnect();
	$result = mysqli_query($CONN,"SELECT uname,fullname FROM users WHERE uid!=".$_SESSION['uid']." and utype='CADMIN' and collegecode='".$_SESSION['collegecode']."';") or systemlog($_SERVER['PHP_SELF']."  SQL query error: ".mysqli_error($CONN));	//own name not displayed
	if(mysqli_num_rows($result)!=0)
	{
		while($row = mysqli_fetch_array($result))
		{
			echo "<tr><td>".$row['uname']."</td><td>".$row['fullname']."</td></tr>";
		}
		echo "</table>";
	}
	else
		echo "<tr><td>-----</td><td>-----</td></tr></table>You are the only admin from your college.";

	}
}

require_once 'markup/template_botm.php';
?>