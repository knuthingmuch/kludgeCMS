<?php
$PAGETITLE="NSS Goa | ".$_GET['colgcode'];
require_once 'lib/mysql-lib.php';
session_start();
if(!isset($_GET['colgcode']))		//to avoid undefined variable(?)
	header('location: '.$_SERVER['HTTP_REFERER']) or header('location: index.php');
?>

<div id='colgname'>
<?php
	$SYSCONN=db_sysconnect();
	$result=mysqli_query($SYSCONN,"SELECT collegename,about FROM colleges WHERE collegecode='".$_GET['colgcode']."';") or systemlog("SQL query error: ".mysql_error());
	$result=mysqli_fetch_array($result);
	if(isset($result['collegename']))	//only if collegecode is valid. else page DNE.
	{
		$PAGETITLE="NSS Goa | ".$result['collegename'];
		require_once 'markup/template_top.php';
		echo $result['collegename'];
	}
	else
	{
		require_once 'markup/template_top.php';
		echo "You have not specified your college or </br> requested page does not exist.";		//TODO? better message?
	}
?>
</div>

<div id='about'>
<?php
	echo $result['about'];
	db_sysclose($SYSCONN);
?>
</div>

<div id='gist'>
<?php
	
?>
</div>

<?php
require_once 'markup/template_botm.php';
?>