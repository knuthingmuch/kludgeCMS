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
	Current password:<input type="password" name="currentpass"><?php if(isset($_SESSION['temp_wrongpass'])) { echo "Wrong password.";unset($_SESSION['temp_wrongpass']); } ?>
	<br/>
	New password:<input type="password" name="newpass1"><?php if(isset($_SESSION['temp_minlen'])) { echo "Password should be at least $MIN_PASSWD_LEN characters long.";unset($_SESSION['temp_minlen']); } ?>
	<br/>
	Retype new password:<input type="password" name="newpass2"><?php if(isset($_SESSION['temp_nomatch'])) { echo "Passwords do not match.";unset($_SESSION['temp_nomatch']); } ?>
	<br/>
	<input type="submit" value="Change">
	</form>
	<a href="accountinfo.php">REFRESH</a>
	<br/>
	<?php if(isset($_SESSION['temp_success'])) { echo "Password successfully changed.";unset($_SESSION['temp_success']); } ?>

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
