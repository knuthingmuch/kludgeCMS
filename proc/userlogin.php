<?php
require_once '../lib/users-lib.php';

if (login($_POST['uname'],$_POST['passwd']))
	header('location: '.$_SERVER['HTTP_REFERER']) or header('location: ../index.php');
else
	echo "Fail!";	//---ERROR PAGE/POPUP	TODO
?>
