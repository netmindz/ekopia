<?php

require("include/common.php");
$image = new image();
if(isset($_GET['width'])) {
	$image->send($_GET['id'],$_GET['width'],$_GET['height']);
}
else {
	$image->send($_GET['id']);
}
?>
