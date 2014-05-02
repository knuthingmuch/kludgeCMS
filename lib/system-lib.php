<?php
$logfile="/opt/lampp/htdocs/nsssite/log";
// date_default_timezone_set('UTC');		//date gives hwclock, which is set to UTC on unix, but localtime on M$ Windoze, fix as required.

function systemlog($message)
{
	global $logfile;
	
 	$message=date('Y/m/d H:i:s')." ----- ".$message."\n";
	file_put_contents($logfile, $message, FILE_APPEND);
}
?>
