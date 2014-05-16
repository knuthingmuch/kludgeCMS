<?php
$PAGETITLE="NSS Goa | College main page.";
require_once 'lib/mysql-lib.php';
session_start();
if(!isset($_GET['colgcode']))		//to avoid undefined variable(?)
	header('location: '.$_SERVER['HTTP_REFERER']) or header('location: index.php');
?>

<?php
	$SYSCONN=db_sysconnect();
	$result=mysqli_query($SYSCONN,"SELECT collegename,about FROM colleges WHERE collegecode='".$_GET['colgcode']."';") or systemlog("SQL query error: ".mysql_error());
	$result=mysqli_fetch_array($result);
	db_sysclose($SYSCONN);
	
	if(isset($result['collegename']))	//only if collegecode is valid. else page DNE.
	{
		$PAGETITLE="NSS Goa | ".$result['collegename'];
		require_once 'markup/template_top.php';
?>
	<link rel="stylesheet" type="text/css" href="css/aboutcolg.css">
	<div id='colgname'>
<?php
	echo $result['collegename'];
?>
	</div>

	<div id='about'>
<?php
		echo $result['about'];
?>
	</div>
	
	<div id='postlist'>
<?php
	getColgPostList(0,3,$_GET['colgcode']);
?>
	</div>

<?php
	}
	else
	{
		require_once 'markup/template_top.php';
		echo "<div id='error'>You have not specified your college or <br/> requested page does not exist.</div>";		//TODO? better message?
	}
?>

<?php
require_once 'markup/template_botm.php';
?>