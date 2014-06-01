<?php
$pos=strpos("Helloworld","woqrld");
if($pos)
	echo $pos."__".substr("Helloworld",0,$pos);

echo str_replace("/"," ",date('d/M/Y'));
echo " at ".date('h:i a')."\n";
echo htmlspecialchars("fzgfdgAKDKJCBH239049857_",ENT_QUOTES);

require_once 'lib/mysql-lib.php';

$CONN=db_sysconnect();
$result = mysqli_query($CONN,"SELECT collegecode FROM colleges;");
db_sysclose($CONN);

while($row=mysqli_fetch_array($result))
{
	echo $row['collegecode']." ";
}

echo hash('sha256', 'pass');

?>