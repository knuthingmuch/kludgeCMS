<?php
$PAGETITLE="NSS Goa | Posts";
require_once 'lib/mysql-lib.php';
session_start();
require_once 'markup/template_top.php';
$perpage=5;	//posts to display per page

if(isset($_GET['colgcode']) and isset($_GET['page']))
{
?>
	<link rel="stylesheet" type="text/css" href="css/listposts.css">
<?php
	$SYSCONN=db_sysconnect();
	$result=mysqli_query($SYSCONN,"SELECT collegename FROM colleges WHERE collegecode='".$_GET['colgcode']."';") or systemlog($_SERVER['PHP_SELF']."  SQL query error: ".mysqli_error($SYSCONN));	//collegecode is primary, so only 1 returned.
	$result=mysqli_fetch_array($result);
	db_sysclose($SYSCONN);
?>
	<div id="collegename"><?php echo $result['collegename']; ?></div>
	<span id='page'>Page: <?php echo $_GET['page']+1 ?></span>

<?php
	$beginaft=$perpage*$_GET['page'];
	getColgPostList($beginaft,$perpage,$_GET['colgcode']);
	$totalPages=ceil(totalPosts($_GET['colgcode'])/$perpage);
?>
	<nav id="pages">&nbsp;Page:
<?php
	for ($i=0;$i<$totalPages;$i++)
	{
		echo "<a href='listposts.php?colgcode=$_GET[colgcode]&page=$i'>".($i+1)."</a>";
	}
?>
	</nav>
<?
}
else
{
	echo "<div id='error'>Requested page does not exist.</div>";		//TODO? better message?
}
?> 



<?php
require_once 'markup/template_botm.php';
?> 