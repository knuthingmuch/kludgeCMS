<?php
require_once 'users-lib.php';
require_once 'system-lib.php';
// $SITEROOT=$_SERVER['DOCUMENT_ROOT'].'/nsssite/';

function getPublicTopbar()
{
// 	global $SITEROOT;
	include 'markup/topbar_public';
}

function getUserTopbar($uid)
{
// 	global $SITEROOT;
	if(isSiteAdmin($uid))
		include 'markup/topbar_siteadmin.php';
	else if (isColgAdmin($uid))
		include 'markup/topbar_colgadmin.php';
	else
		include 'markup/topbar_basic.php';
}

function show_tab_btn()			//generate once and OP to file. TODO -->>PERFORMANCE
{
	$CONN=db_sysconnect();
	$result = mysqli_query($CONN,"SELECT collegename,collegecode FROM colleges ORDER BY collegenum;") or systemlog("SQL query error: ".mysql_error());	//and die?? TODO
	db_sysclose($CONN);
	
	if($result)
	{
		while($row = mysqli_fetch_array($result))
		{
			echo "<a class='tab_link' id='".$row['collegecode']."_tab' href='colgmainpage.php?colgcode=$row[collegecode]'>\n"."<div class='tab_btn'>".$row['collegename']."</div>\n"."</a>\n";
		}
	}
}
?>
