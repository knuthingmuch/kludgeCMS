<?php
$PAGETITLE="NSS Goa | Post";
require_once 'lib/mysql-lib.php';
session_start();
if(!isset($_GET['postid']))
	header('location: '.$_SERVER['HTTP_REFERER']) or header('location: index.php');	//ERROR PAGE??TODO

?>

<?php
	$SYSCONN=db_sysconnect();
	$result=mysqli_query($SYSCONN,"SELECT * FROM posts WHERE postid='".$_GET['postid']."';") or systemlog("SQL query error: ".mysqli_error($SYSCONN));
	$postinfo=mysqli_fetch_array($result);
	$result=mysqli_query($SYSCONN,"SELECT fullname FROM users WHERE uid='".$postinfo['authoruid']."';") or systemlog("SQL query error: ".mysqli_error($SYSCONN));
	$result=mysqli_fetch_array($result);
	$authorname=$result['fullname'];
	$result=mysqli_query($SYSCONN,"SELECT content FROM postdata WHERE postid='".$_GET['postid']."';") or systemlog("SQL query error: ".mysqli_error($SYSCONN));
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
	echo "<div id='posttitle'>".$postinfo['title']."</div>";
	if(isset($_SESSION['uid']) and ($_SESSION['uid']==$postinfo['authoruid'] or isSiteAdmin($_SESSION['uid'])))
	{
?>
	<div class='edit'><a href='editpost.php?postid=<?php echo $postinfo['postid']; ?>'><span class='edit'>EDIT</span></a>
	</div>
<?php
	}
	echo "<span id='authorname'> ".$authorname." </span><span id='posttime'> ".$postinfo['posttime']." </span>";
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
