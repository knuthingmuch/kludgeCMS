<div id='topbarright'>
	<?php echo "Hello ".$_SESSION['fullname']; ?> |
	<a class='topbar' href='colgmainpage.php?colgcode=<?php echo $_SESSION['collegecode'] ?>'><div class='topnav'>MY COLLEGE</div></a>|
	<div class="dropdwn">
	<a class='topbar' href=''>
	<div class='topnav'>ACCOUNT</div>
	</a>
	<ul>
		<li>OPT 1</li>
		<li>OPT 2</li>
	</ul>
	</div> 
	|<a class='topbar' href='proc/userlogout.php'><div class='topnav' id='logoutbtn'>LOGOUT</div></a>|
	<a class='searchbtn topbar' href='qsearchpage.php'><div class='topnav'>SEARCH</div></a>
</div> 
 
