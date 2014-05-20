<script src="ckeditor/ckeditor.js"></script>
<script src="ckeditor/adapters/jquery.js"></script>
<!-- <script src="../../ckeditor.js"></script> -->

<div id='topbarright' style='float:right;word-spacing:0;'>
	<?php echo "Hello ".$_SESSION['fullname']; ?> |
	<a class='topbar' href=''><div class='topnav'>MANAGE</div></a>|
	<a class='topbar' href='#'><div class='topnav'>ACCOUNT</div></a>|
	<a class='topbar' href='proc/userlogout.php'><div class='topnav' id='logoutbtn'>LOGOUT</div></a>|
	<a class='searchbtn topbar' href='#'><div class='topnav'>SEARCH</div></a>

</div> 
