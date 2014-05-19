<?php
require_once '../lib/users-lib.php';

if (login($_POST['uname'],$_POST['passwd']))
	header('location: '.$_SERVER['HTTP_REFERER']); // since REFERER is always set for login.
else
	header('location: ../invalidlogin.php');
?>
