<?php
$PAGETITLE="NSS Goa | Edit College Information";
session_start();
// $SITEROOT=$_SERVER['DOCUMENT_ROOT'].'/nsssite/';
require_once 'lib/users-lib.php';
require_once 'lib/mysql-lib.php';

if(isset($_SESSION['uid'],$_GET['colgcode']) and isColgAdmin($_SESSION['uid']) and $_SESSION['collegecode']==$_GET['colgcode'] or isSiteAdmin($_SESSION['uid']))	//only if user is admin of colg of which info he's trying to modify, or is siteadmin.
{
	require_once 'markup/template_top.php';
	
	$CONN = db_sysconnect();
	$result = mysqli_query($CONN,"SELECT collegename,about FROM colleges WHERE collegecode='".$_GET['colgcode']."';") or systemlog("SQL query error: ".mysql_error());
	$result=mysqli_fetch_array($result);
	
	db_sysclose($CONN);
	
	if($result)
	{
?>
		<h3>College Information</h3>
		<u>Please be careful, any changes made here will be reflected across the website.</u>
		</br></br>
		<form action="proc/updateaboutcolg.php" method="post">
		College Name:<input type="text" name="colgname" style="min-width:700px;" value="<?php echo $result['collegename']; ?>">
		</input>
		</br></br>
		About the College/NSS unit:
		<textarea name='aboutdata' id='aboutdata'>  
<?php 	echo $result['about']; 
?>
		</textarea>
		<script>
			CKEDITOR.replace( 'aboutdata' );
		</script>
		</br>
		<div class='submitbutton'><input id='submitbutton' type='submit' value='UPDATE'></div>
		<form>
		<div class="resetbutton"><a id="resetbutton" href="editaboutcolg.php?colgcode=<?php echo $_GET['colgcode'] ?>">RESET</a></div>
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
