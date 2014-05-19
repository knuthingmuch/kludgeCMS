<?php
session_start();
require_once '../lib/mysql-lib.php';
require_once '../lib/users-lib.php';

if(isset($_SESSION['uid']) and isset($_SESSION['tempauthoruid']) and ($_SESSION['uid']==$_SESSION['tempauthoruid'] or isSiteAdmin($_SESSION['uid'])))	//is own post or is siteAdmin
{
	$CONN=db_sysconnect();
	$title=htmlspecialchars($_POST['posttitle'],ENT_QUOTES);	//otherwise might have problems displaying
	$tags=htmlspecialchars($_POST['tags'],ENT_QUOTES);
	
	$title=mysqli_real_escape_string($CONN,$title);
	$postcontent=mysqli_real_escape_string($CONN,$_POST['postdata']);	//already converted into html entitites by ckeditor.
	$tags=mysqli_real_escape_string($CONN,$tags);
	$edittime=str_replace("/"," ",date('d/M/Y'))." at ".date('h:i a');
	
	mysqli_query($CONN,"UPDATE posts,postdata SET title='$title',tags='$tags',edittime='$edittime',postdata.content='$postcontent' WHERE posts.postid=postdata.postid and posts.postid='".$_SESSION['temppostid']."';") or systemlog($_SERVER['PHP_SELF']."  SQL query error: ".mysqli_error($CONN));
	
	db_sysclose($CONN);
	
	header('location: ../showpost.php?postid='.$_SESSION['temppostid']);	//to the edited post
}
else
{
	header('location: '.$_SERVER['HTTP_REFERER']) or header('location: ../index.php');	//ERROR PAGE/ACCESS DENIED	TODO
}
unset($_SESSION['tempauthoruid']);
unset($_SESSION['temppostid']);
?>