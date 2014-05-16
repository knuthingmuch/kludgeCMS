 
<?php
$pos=strpos("Helloworld","woqrld");
if($pos)
	echo $pos."__".substr("Helloworld",0,$pos);

echo str_replace("/"," ",date('d/M/Y'));
echo " at ".date('h:i a')."\n";

?>
