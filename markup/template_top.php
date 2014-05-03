<!DOCTYPE html>
<?php 
// $SITEROOT=$_SERVER['DOCUMENT_ROOT'].'/nsssite/';
require_once 'lib/display-lib.php';
?>

<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

<link rel="icon" type="image/png" href='favicon.png'>			<!-- FAVICON -->

<title id='page_title'><?php echo $PAGETITLE ?></title>

<link rel="stylesheet" type="text/css" href="main.css">
<link rel="stylesheet" type="text/css" href="popups.css">

<script src="lib/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="ckeditor/ckeditor.js"></script>
<script src="ckeditor/adapters/jquery.js"></script>

<script src="all.js" type="text/javascript"></script>

</head>

<body>
<header>
	<div id="banner">
	<img src="nss_logo.png" height='56px' width='56px' style="padding-left:320px;float:left;" />
	<p style="text-align:left;font-size:25px;font-weight:bold;padding:0px;">N.S.S. CELL, GOA UNIVERSITY</p>
	</div>

	<div id="topcontainer">
		<div id="topbar">
			<div id="topbarleft" style="float:left;word-spacing:0;">
				<a class="topbar topnav" href="index.php">HOME</a>|<a class='topbar topnav' href=''>ABOUT NSS @ GU</a>|<a class='topbar topnav' href=''>CONTACT US</a>|<a class='topbar' href='#'><div class='topnav'>RECENT</div></a>
			</div>
<?php
			if(isset($_SESSION['uid']))
				getUserTopbar($_SESSION['uid']);
			else
				getPublicTopbar();
?>
		</div>
	</div>
</header>

<main>
	<div id="main_wrap">
		<div class='loginpopup'>
			<div class='close'>
				<a href='#' class='close'>CLOSE</a>
			</div>
		<form action="proc/userlogin.php" method="post">
			<p>Username:<input style='float:right' name='uname' type='text' /></p>
			<p>Password:<input style='float:right' name='passwd' type='password' /></p>
			<div class='loginbutton'><input id='loginbutton' type='submit' value='LOGIN'/></div>
		</form>
		</div> 
		<div class='searchpopup'>
			<div class='close'>
				<a href='#' class='close'>CLOSE</a>
			</div>
			<form action='' method='post'>
				<p>Quicksearch:<input style='float:right' name='qsterm' type='text' /></p> <!-- quicksearch term -->
				<div class='searchbutton'><input id='searchbutton' type='submit' value='SEARCH'/></div>
			</form>
		</div>

<!-- ____________________________________________________________________________________________________________________________________ -->
<div id='tabs_cont'>
<?php
		show_tab_btn();
?>
</div> 
		<div id='content'>