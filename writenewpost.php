<?php
session_start();

require_once 'lib/users-lib.php';
require_once 'lib/mysql-lib.php';

if(isset($_SESSION['uid'],$_GET['colgcode']) and (isColgAdmin($_SESSION['uid']) and $_SESSION['collegecode']==$_GET['colgcode'] or isSiteAdmin($_SESSION['uid'])))	//only if user is admin of colg for which new post is to be made, or is siteadmin.
{
	$PAGETITLE="NSS Goa | New post";
	require_once 'markup/template_top.php';
	
	$CONN = db_sysconnect();
	$result = mysqli_query($CONN,"SELECT collegename FROM colleges WHERE collegecode='".$_GET['colgcode']."';") or systemlog("SQL query error: ".mysql_error());
	$result=mysqli_fetch_array($result);
	
	db_sysclose($CONN);
	
	if($result)
	{
?>
		<link rel="stylesheet" type="text/css" href="css/editorpage.css">
		<h3>New Post: <?php echo $result['collegename']; ?></h3>
		<br/>
		<form action="proc/newpost.php" method="post">
		Title: <input type="text" name="posttitle" style="min-width:760px;" placeholder="Post title">
		<br/><br/>
		<span id="note">Note: It is highly recommended that you demarcate the intro by using the 'insert more break' button(top, extreme right), so that only the section before the break is shown when list of posts is displayed.</span>
		<br/><br/>
		<textarea name='postdata' id='postdata'>  
		</textarea>
		<div style="float:right;font-size:12px;">Drag to resize editor.&#8593;</div>
		<script>
			CKEDITOR.replace( 'postdata' );
		</script>
		<br/><br/>
		Tags(optional): <input type="text" name="tags" style="min-width:695px;" placeholder="separate tags with commas(e.g. rally,panaji)">
		<br/><br/>
		<div class='submitbutton'><input id='submitbutton' type='submit' value='POST'></div>
		</form>
		<div class="resetbutton"><a id="resetbutton" href="writenewpost.php?colgcode=<?php echo $_GET['colgcode'] ?>">RESET</a></div>
<?php
		$_SESSION['tempcolgcode']=$_GET['colgcode'];	//since $_SESSION[collegecode] won't be set for siteadmin but colgcode info is required for update query in updateaboutcolg.php
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
