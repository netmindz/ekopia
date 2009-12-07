<?php include("include/common.php"); ?>
<?php include("header.inc.php"); ?>

<?php page_title("Digital Downloads") ?>

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

