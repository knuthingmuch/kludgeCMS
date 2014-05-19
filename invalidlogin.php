<?php
$PAGETITLE="Invalid";
session_start();
if(isset($_SESSION['uid']))
{
	if(isset($_SESSION['collegecode']))
	{
		$collegecode=$_SESSION['collegecode'];
		header('location: colgmainpage.php?colgcode='.$collegecode);
	}
	else
		header('location: index.php');
}
require_once 'markup/template_top.php';
?>

<div id="error">Invalid username or password.<br/>Try again.</div>

<?php
require_once 'markup/template_botm.php';
?>
