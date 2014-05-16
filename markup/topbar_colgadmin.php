<script src="ckeditor/ckeditor.js"></script>
<script src="ckeditor/adapters/jquery.js"></script>
<script src="../../ckeditor.js"></script>

<div id='topbarright' style='float:right;word-spacing:0;'>
	<?php echo "Hello ".$_SESSION['fullname']; ?> |<div class="dropdwn">
	<a class='topbar' href='colgmainpage.php?colgcode=<?php echo $_SESSION['collegecode'];?>'><div class='topnav'>MY COLLEGE</div></a>
	<ul>
		<a class="dropdwn" href="editaboutcolg.php?colgcode=<?php echo $_SESSION['collegecode'];?>"><li class="dropdwn" style=''><div>EDIT INFO</div></li></a>
		<a class="dropdwn" href="writenewpost.php?colgcode=<?php echo $_SESSION['collegecode'];?>"><li><div>NEW POST</div></li></a>
	</ul>
	</div>|<a class='topbar' href=''>
	<div class='topnav'>ACCOUNT</div>
	</a>|<a class='topbar' href='proc/userlogout.php'>
	<div class='topnav' id='logoutbtn'>LOGOUT</div>
	</a>|<a class='searchbtn topbar' href='qsearchpage.php'>
	<div class='topnav'>SEARCH</div>
	</a>

</div> 
