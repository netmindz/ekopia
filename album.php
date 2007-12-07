<?php
require("include/common.php");
?>
<?php include("header.inc.php"); ?>
<?php

$album = new album();
$album->get($_REQUEST['album_id']);
	$label = new label();
	$label->get($album->label_id);
	$artist = new artist();
	$artist->get($album->artist_id);

	?>
	<div style="float: right">
	<object width="280" height="280" type="application/x-shockwave-flash" data="mp3player.swf?playlist=playlist.php?album_id=<?= $album->id ?>"></object>
	</div>
	<?php $image = new image(); $image->show($album->image_id); ?>
	<table>
	<tr><th>Album:</th><td><?= $album->DN ?></td><tr>
	<tr><th>Artist:</th><td><a href="browse.php?type=artist&id=<?= $artist->id ?>"><?= $artist->DN ?></a></td><tr>
	<tr><th>Label:</th><td><a href="browse.php?type=label&id=<?= $label->id ?>"><?= $label->DN ?></a></td><tr>
	</table>

	Tracks<br>
	<ul>
	<?php
	
	$track = new track();
	$track->getTrackListings($album->id);
	$track_artist = new artist();
	while($track->getNext()) {
		$track_artist->get($track->artist_id);
		?>
		<li><?= $track->track_number ?> - <?= $track->DN ?> - <?= $track_artist->DN ?></a>
<?php if($_SERVER['HTTP_HOST'] == "localhost") { ?>
		(<a href="download.php?track_id=<?= $track->id ?>&type=mp3">mp3</a>)
		(<a href="download.php?track_id=<?= $track->id ?>&type=ogg">ogg</a>)
		(<a href="download.php?track_id=<?= $track->id ?>&type=wav">wav</a>)
<?php } ?>
		</li>
		<?php
	}
	?>
	</ul>
		<?php if($album->price) { ?>
		<form action="basket.php" method="POST">
		<input type="hidden" name="action" value="add">
		<input type="hidden" name="album_id" value="<?= $album->id ?>">
		<input type="submit" value="Add to basket">
		</form>
		<?php } else { ?>
		Coming soon to buy here
		<?php } ?>
	<?php
?>
<?php include("footer.inc.php"); ?>

