<script src="ckeditor/ckeditor.js"></script>
<script src="ckeditor/adapters/jquery.js"></script>
<!-- <script src="../../ckeditor.js"></script> -->

<div id='topbarright' style='float:right;word-spacing:0;'>
	<?php echo "Hello ".$_SESSION['fullname']; ?> |<div class="dropdwn">
	<a class='topbar' href=''><div class='topnav' style='width:80px;'> ADMINISTER </div></a>
	<ul>
		<a class="dropdwn" href="siteadmin_users.php"><li class="dropdwn"><div>USERS</div></li></a>
		<a class="dropdwn" href=""><li><div>COLLEGES</div></li></a>
	</ul>
	</div>|<a class='topbar' href='#'><div class='topnav'>ACCOUNT</div>
	</a>|<a class='topbar' href='proc/userlogout.php'><div class='topnav' id='logoutbtn'>LOGOUT</div>
	</a>|<a class='searchbtn topbar' href='#'><div class='topnav'>SEARCH</div></a>

</div> 
