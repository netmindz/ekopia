<?php
require("include/common.php");
?>
<?php include("header.inc.php"); ?>

<?php
if((isset($_REQUEST['type']))&&(in_array($_REQUEST['type'],array('artist','album','label',"type")))) {
	$type = $_REQUEST['type'];
}
else {
	$type = "album";
}

if(($type == "album")||($type == "artist")||($type == "label")) {

	$album = new album();
	if(isset($_REQUEST['id'])) {
		$album->getListByType($type,$_REQUEST['id']);	
	}
	else {
		$album->getList();
	}
	?>
	<h1>Albums</h1>
	<div id="album_list">
	<?php
	while($album->getNext()) {
		$label = new label();
		$label->get($album->label_id);
		$artist = new artist();
		$artist->get($album->artist_id);

		?>
		<div id="album_thumb">
		Album: <a href="album.php?album_id=<?= $album->id ?>"><?= $album->DN ?></a><br>
		Artist: <a href="browse.php?type=artist&id=<?= $artist->id ?>"><?= $artist->DN ?></a><br>
		Label: <a href="browse.php?type=label&id=<?= $label->id ?>"><?= $label->DN ?></a><br>
		<?php if($album->price) { ?>
		<form action="basket.php" method="POST">
		<input type="hidden" name="action" value="add">
		<input type="hidden" name="album_id" value="<?= $album->id ?>">
		<input type="submit" value="Add to basket" class="inputbox">
		</form>
		<?php } else { ?>
		Coming soon to buy here
		<?php } ?>
		</div>
		<?php
	}
	?>
	</div>
<?php
}
else {
	?>
	<h1><?= $type ?>s</h1>
	<?php
} ?>
<?php include("footer.inc.php"); ?>
