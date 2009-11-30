<?php include("include/common.php"); ?>
<?php include("header.inc.php"); ?>
<h2>Latest Albums</h2>
<div id="album_list">
<?php
$album = new album();
$album->getNew(50);
while($album->getNext()) { 
	$album->displayThumb();
} 
?>
</div>
<?php include("footer.inc.php"); ?>

