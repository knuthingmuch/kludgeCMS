<?php
$PAGETITLE="NSS Goa | Edit"; //TODO
session_start();
// $SITEROOT=$_SERVER['DOCUMENT_ROOT'].'/nsssite/';
require_once 'lib/users-lib.php';
require_once 'lib/mysql-lib.php';

if(isset($_SESSION['uid'],$_GET['colgcode']) and isColgAdmin($_SESSION['uid']) and $_SESSION['collegecode']==$_GET['colgcode'] or isSiteAdmin($_SESSION['uid']))	//only if user is admin of colg of which info he's trying to modify, or is siteadmin.
{
	require_once 'markup/template_top.php';
	
	$SYSCONN = db_sysconnect();
	$result = mysqli_query($SYSCONN,"SELECT about FROM colleges WHERE collegecode='".$_GET['colgcode']."';") or systemlog("SQL query error: ".mysql_error());
	$result=mysqli_fetch_array($result);
	
	db_sysclose($SYSCONN);
	
	if($result)
	{
// 		include 'markup/ckeditor_aboutdata.php';
		echo 
<<<EOT
	<form action='proc/updateaboutcolg.php' method='post'>
	<textarea name='aboutdata' id='aboutdata'>  
EOT;
	echo $result['about'].
<<<EOT
	</textarea>
	<script>
		CKEDITOR.replace( 'aboutdata' );
	</script>
	<div class='submitbutton'><input id='submitbutton' type='submit' value='UPDATE'><div>
	<form>
EOT;
	}
	//----------else ERROR PAGE TODO
}
else
{
	header('location: '.$_SERVER['HTTP_REFERER']) or header('location: index.php');	//ACCESS DENIED TODO
}
?>


<?php
require_once 'markup/template_botm.php';
?>
