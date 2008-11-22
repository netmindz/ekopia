<?php include("include/common.php"); ?>
<?php include("header.inc.php"); ?>
<h2>Digital Downloads</h2>
<div id="album_list">
<?php
$album = new album();
$album->getDownloads(200);
while($album->getNext()) { 
	$album->displayThumb(false);
} 
?>
</div>
<?php include("footer.inc.php"); ?>

