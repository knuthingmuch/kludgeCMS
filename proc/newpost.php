<?php
session_start();
require_once '../lib/mysql-lib.php';
require_once '../lib/users-lib.php';

if(isset($_SESSION['uid']) and (isColgAdmin($_SESSION['uid']) or isSiteAdmin($_SESSION['uid'])))
{
	$CONN=db_sysconnect();
	$title=htmlspecialchars($_POST['posttitle'],ENT_QUOTES);	//otherwise might have problems displaying
	$tags=htmlspecialchars($_POST['tags'],ENT_QUOTES);
	
	$title=mysqli_real_escape_string($CONN,$title);
	$postdata=mysqli_real_escape_string($CONN,$_POST['postdata']);	//already converted into html entitites by ckeditor.
	$tags=mysqli_real_escape_string($CONN,$tags);
	$posttime=str_replace("/"," ",date('d/M/Y'))." at ".date('h:i a');
	
	mysqli_query($CONN,"INSERT INTO posts VALUES (NULL,".$_SESSION['uid'].",'".$_SESSION['tempcolgcode']."','".$title."','".$posttime."','','".$tags."',NULL, NOW())") or systemlog("SQL query error: ".mysqli_error($CONN)); //and die?? TODO
	
	$postid=mysqli_insert_id($CONN);
	
	mysqli_query($CONN,"INSERT INTO postdata VALUES (".$postid.",'".$postdata."')") or systemlog("SQL query error: ".mysqli_error($CONN)); //and die?? TODO
	
	db_sysclose($CONN);
	
	header('location: ../showpost.php?postid='.$postid);	//to the new post
}
else
{
	header('location: '.$_SERVER['HTTP_REFERER']) or header('location: ../index.php');	//ERROR PAGE/ACCESS DENIED	TODO
}
unset($_SESSION['tempcolgcode']);
?>