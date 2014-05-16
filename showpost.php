<?php
$PAGETITLE="NSS Goa | Post";
require_once 'lib/mysql-lib.php';
session_start();
if(!isset($_GET['postid']))
	header('location: '.$_SERVER['HTTP_REFERER']) or header('location: index.php');	//ERROR PAGE??TODO

?>

<?php
	$SYSCONN=db_sysconnect();
	$result=mysqli_query($SYSCONN,"SELECT * FROM posts WHERE postid='".$_GET['postid']."';") or systemlog("SQL query error: ".mysql_error());
	$postinfo=mysqli_fetch_array($result);
	$result=mysqli_query($SYSCONN,"SELECT fullname FROM users WHERE uid='".$postinfo['authoruid']."';") or systemlog("SQL query error: ".mysql_error());
	$result=mysqli_fetch_array($result);
	$authorname=$result['fullname'];
	$result=mysqli_query($SYSCONN,"SELECT content FROM postdata WHERE postid='".$_GET['postid']."';") or systemlog("SQL query error: ".mysql_error());
	$result=mysqli_fetch_array($result);
	$postcontent=$result['content'];
	db_sysclose($SYSCONN);
	
	if($postinfo['postid'])
	{
		$PAGETITLE="NSS Goa | ".$postinfo['title'];
		require_once 'markup/template_top.php';
?>
	<link rel="stylesheet" type="text/css" href="css/showpost.css">
	<div id='posthead'>
<?php	
	echo $postinfo['title'];
	//span
	echo "<br/><span id='authorname'> ".$authorname." </span><span id='posttime'> ".$postinfo['postdate']." at ".$postinfo['posttime']." </span>";
	//span
?>
	</div>

	<div id='postcontent'>
<?php
	echo $postcontent;
?>
	</div>

<?php
	}
	else
	{
		require_once 'markup/template_top.php';
		echo "<div id='error'>Requested page does not exist.</div>";		//TODO? better message?
	}
?>

<?php
require_once 'markup/template_botm.php';
?> 
