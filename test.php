<?php
$pos=strpos("Helloworld","woqrld");
if($pos)
	echo $pos."__".substr("Helloworld",0,$pos);

echo str_replace("/"," ",date('d/M/Y'));
echo " at ".date('h:i a')."\n";
echo htmlspecialchars("fzgfdgAKDKJCBH239049857_",ENT_QUOTES);
?>
<form action="test.php" method ="post">
<input type="text" name="test">
<input type="submit" value="go">
</form>

<?php
if(isset($_POST['test']))
	echo $_POST['test'];
?>
