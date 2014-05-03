<?php

require_once '../lib/mysql-lib.php';

$SYSCONN=db_sysconnect();

mysqli_query($SYSCONN,"INSERT INTO posts VALUES ('','1','sxc','sdgsd','554353','','')");
echo mysqli_insert_id($SYSCONN);

db_sysclose($SYSCONN);
?>