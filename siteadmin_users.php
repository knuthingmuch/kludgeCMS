<?php
$PAGETITLE="NSS Goa | User Management";
session_start();
require_once 'markup/template_top.php';

if(userIsSiteAdmin())
{
	
}
else
{
?>
	<div id="error">
	You do not have the priviledges required to access this page.
	</div>
<?php
}

require_once 'markup/template_botm.php';
?>
