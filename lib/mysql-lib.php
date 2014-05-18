<?php 
require_once 'system-lib.php';

//MySQL siteadmin user credentials	//seperate user required??? nah..
$db_admhost='localhost';
$db_admuname='siteadmin';
$db_admpasswd='';
$dba_admdbname='nsssite';

//MySQL sitesytsem user credentials
$db_syshost='localhost';
$db_sysuname='nsssitesystem';
$db_syspasswd='nss123';
$db_sysdbname='nsssite';
//------------------------------------

function db_sysconnect()
{
	global $db_syshost,$db_sysuname,$db_syspasswd,$db_sysdbname;
	$SYSCONN=mysqli_connect($db_syshost,$db_sysuname,$db_syspasswd,$db_sysdbname) or systemlog("SQL connection error: ".mysqli_error($SYSCONN));		//and die?? TODO
	return $SYSCONN;
}
function db_sysclose($SYSCONN)
{
	mysqli_close($SYSCONN) or systemlog("SQL connection error: ".mysqli_error($SYSCONN));
}

function db_admconnect()	//not required?
{
	global $db_admhost,$db_admuname,$db_admpasswd,$db_admdbname;
	$ADMCONN=mysqli_connect($db_admhost,$db_admuname,$db_admpasswd,$db_admdbname) or systemlog("SQL connection error: ".mysqli_error($ADMCONN)); //and die?? TODO
	return $ADMCONN;
}
function db_admclose($ADMCONN)	//not required?
{
	mysqli_close($ADMCONN) or systemlog("SQL connection error: ".mysqli_error($ADMCONN));
}
?>