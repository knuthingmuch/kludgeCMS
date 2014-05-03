<?php
$PAGETITLE="NSS Goa | ".$_GET['colgcode'];	//replace with name
session_start();
require_once 'markup/template_top.php';
?>

<div id='colgname'>
<?php
	$SYSCONN=db_sysconnect();
	$result=mysqli_query($SYSCONN,"SELECT collegename,about FROM colleges WHERE collegecode='".$_GET['colgcode']."';") or systemlog("SQL query error: ".mysql_error());
	$result=mysqli_fetch_array($result);
	echo $result['collegename'];
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