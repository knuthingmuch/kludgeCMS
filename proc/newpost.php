<?php

require_once '../lib/mysql-lib.php';

$CONN=db_sysconnect();

mysqli_query($CONN,"INSERT INTO posts VALUES ('','1','sxc','sdgsd','554353','','')");
echo mysqli_insert_id($CONN);

db_sysclose($CONN);
?>