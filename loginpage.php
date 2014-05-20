<?php
$PAGETITLE="NSS Goa | Login";
session_start();
require_once 'markup/template_top.php';
?>


<form action='proc/userlogin.php' method='post'>
	<p>Username:<input name='uname' type='text' /></p>
	<p>Password:<input name='passwd' type='password' /></p>
	<div style='text-align:center;font-size:12px'><input id='loginbutton' type='submit' value='LOGIN'/></div>
</form>


<?php
require_once 'markup/template_botm.php';
?> 
