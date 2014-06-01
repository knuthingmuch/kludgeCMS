<div id='topbarright'>
	<?php echo "Hello ".$_SESSION['fullname']; ?> |<a class='topbar' href='colgmainpage.php?colgcode=<?php echo $_SESSION['collegecode'] ?>'>
	<div class="dropdwn">
	<div class='topnav'>MY COLLEGE</div></a>
	<ul>
		<a class="dropdwn" href="listposts.php?colgcode=<?php echo $_SESSION['collegecode'] ?>&page=0"><li><div>VIEW POSTS</div></li></a>
	</ul>
	</div>|<a class='topbar' href='accountinfo.php'><div class='topnav'>ACCOUNT</div>
	</a>|<a class='topbar' href='proc/userlogout.php'><div class='topnav' id='logoutbtn'>LOGOUT</div>
	</a>|<a class='searchbtn topbar' href='qsearchpage.php'><div class='topnav'>SEARCH</div></a>
</div> 
 
