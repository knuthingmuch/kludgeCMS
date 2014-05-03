<?php
	echo 
<<<EOT
	<form action='proc/updateaboutcolg.php' method='post'>
	<textarea name='aboutdata' id='aboutdata'>  
EOT;
	echo $result['about'].
<<<EOT
	</textarea>
	<script>
		CKEDITOR.replace( 'aboutdata' );
	</script>
	<div class='submitbutton'><input id='submitbutton' type='submit' value='UPDATE'><div>
	<form>
EOT;
?>