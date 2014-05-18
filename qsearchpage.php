<?php
$PAGETITLE="NSS Goa | Search";
session_start();
require_once 'markup/template_top.php';
?>

<div id='content'>
	<form action='' method='post'>
		<p>Search:<input name='qsterm' type='text' /></p> <!-- quicksearch term -->
		<div style='text-align:center;font-size:12px'><input id='searchbutton' type='submit' value='SEARCH'/></div>
	</form>
</div>

<?php
require_once 'markup/template_botm.php';
?> 
