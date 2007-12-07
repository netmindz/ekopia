<?php

require("include/common.php");
$image = new image();
$image->send($_GET['id']);
?>
