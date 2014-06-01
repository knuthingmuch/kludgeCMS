<?php
$PAGETITLE="NSS Goa | Home";
session_start();
// $SITEROOT=$_SERVER['DOCUMENT_ROOT'].'/nsssite/';
require_once 'markup/template_top.php';

if(isset($_SESSION['uid']))
{
?>
	<h2> Account Settings </h2>
	<h3>Change password.</h3>
	<form action="proc/setpasswd.php" method="post">
	Current password:<input type="password" name="currentpass">	<?php if(isset($_GET['msgcode']) and $_GET['msgcode']==1) echo "Wrong password."; ?>
	<br/>
	New password:<input type="password" name="newpass1">	<?php if(isset($_GET['msgcode']) and $_GET['msgcode']==3) echo "Password should be at least $MIN_PASSWD_LEN characters long."; ?>
	<br/>
	Retype new password:<input type="password" name="newpass2">	<?php if(isset($_GET['msgcode']) and $_GET['msgcode']==2) echo "Passwords do not match."; ?>
	<br/>
	<input type="submit" value="Change">
	</form>
	<a href="accountinfo.php">REFRESH</a>
	<br/>
	<?php if(isset($_GET['msgcode']) and $_GET['msgcode']==0) echo "Password successfully changed."; ?>

<?php
}
else
{
?>
	<div id="error">
	You have to be logged in to access this page.
	</div>
<?php
}
require_once 'markup/template_botm.php';
?> 
