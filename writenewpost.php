<?php
$PAGETITLE="NSS Goa | New post";
session_start();
require_once 'markup/template_top.php';
?>

<form action='proc/newpost.php' method='post'>
<textarea name="postdata" id="postdata"></textarea>
<script>
    CKEDITOR.replace( 'postdata' );
</script>
<input type='submit' value='POST'>
<form> 

<?php
require_once 'markup/template_botm.php';
?>
