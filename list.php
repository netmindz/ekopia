<?php include("include/common.php"); ?>
<?php include("header.inc.php"); ?>
<h2>Albums</h2>
<div id="album_list">
<?php
$album = new album();
$album->getList("where artist_id in (select id from artists where published = 'yes') and download_price > 0 ");
while($album->getNext()) { 
	if($album->image_id) {
	?>
		<div id="album_thumb_image">
                <a href="<?= album_link($album->id,$album->name) ?>"><?php
                $image = new image();
                $image->show($album->image_id,100,100,"alt=\"$album->name\" title=\"$album->name\"");
                ?></a>
                </div>
	<?
	}
} 
?>
</div>
<?php include("footer.inc.php"); ?>

