<?php
$PAGETITLE="NSS Goa | Edit College Information";
session_start();
// $SITEROOT=$_SERVER['DOCUMENT_ROOT'].'/nsssite/';
require_once 'lib/users-lib.php';
require_once 'lib/mysql-lib.php';

if(!isset($_GET['postid']))
		header('location: '.$_SERVER['HTTP_REFERER']) or header('location: index.php');
require_once 'markup/template_top.php';

$CONN = db_sysconnect();
$result = mysqli_query($CONN,"SELECT * FROM posts,postdata WHERE posts.postid=postdata.postid and posts.postid=".$_GET['postid'].";") or systemlog("SQL query error: ".mysql_error());
$post=mysqli_fetch_array($result);

if(isset($_SESSION['uid']) and (isColgAdmin($_SESSION['uid']) and $_SESSION['uid']==$post['authoruid'] or isSiteAdmin($_SESSION['uid'])))
{
?>
	<link rel="stylesheet" type="text/css" href="css/editorpage.css">
	<br/><br/>
	<span id="edittitle">Edit post: <?php echo $post['title']; ?></span>
	<br/><br/>
	<span id="note">Note: It is highly recommended that you demarcate the intro by using the 'insert more break' button(top, extreme right), so that only the section before the break is shown when list of posts is displayed.</span>
	<br/><br/>
	<form action="proc/editpost.php" method="post">
	<textarea name='postdata' id='postdata'>
	<?php echo $post['content']; ?>
	</textarea>
	<div style="float:right;font-size:12px;">Drag to resize editor.&#8593;</div>
	<script>
		CKEDITOR.replace( 'postdata' );
	</script>
	<br/><br/>
	Tags(optional): <input type="text" name="tags" style="min-width:695px;" placeholder="separate tags with commas(e.g. rally,panaji)" value="<?php echo $post['tags']; ?>">
	<br/><br/>
	<div class='submitbutton'><input id='submitbutton' type='submit' value='POST'></div>
	</form>
	<div class="resetbutton"><a id="resetbutton" href="writenewpost.php?colgcode=<?php echo $_GET['colgcode'] ?>">RESET</a></div>
<?php
}
?>

<?php
require_once 'markup/template_botm.php';
?>
