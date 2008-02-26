<?php require("include/common.php"); ?>
<?php

$album = new album();
$album->get($_REQUEST['album_id']);
	$label = new label();
	$label->get($album->label_id);
	$artist = new artist();
	$artist->get($album->artist_id);

	$page_title = $artist->DN . " - " . $album->DN;
	?>
	<?php include("header.inc.php"); ?>
	<h2><?= $album->DN ?></h2>
	<div style="float: right">
	<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="280" height="280" id="player" align="middle">
<param name="allowScriptAccess" value="sameDomain" /><param name="movie" value="mp3player.swf?playlist=playlist.php?album_id=<?= $album->id ?>" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" /><embed src="mp3player.swf?playlist=playlist.php?album_id=<?= $album->id ?>" quality="high" bgcolor="#ffffff" width="280" height="280" name="player" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></object>
	</div>
	<?php $image = new image(); $image->show($album->image_id,250,250); ?>
	<table>
	<tr><th>Artist:</th><td><a href="browse.php?type=artist&id=<?= $artist->id ?>"><?= $artist->DN ?></a></td><tr>
	<tr><th>Label:</th><td><a href="browse.php?type=label&id=<?= $label->id ?>"><?= $label->DN ?></a></td><tr>
	</table>

	<p><?= nl2br($album->summary); ?></p>
	Tracks<br/>
	<ul>
	<form action="basket.php" method="post">
	<?php
	
	$track = new track();
	$track->getTrackListings($album->id);
	$track_artist = new artist();
	$download_avail = false;
	while($track->getNext()) {
		$track_artist->get($track->artist_id);
		?>
		<li><?= $track->track_number ?> - <?= $track->DN ?><?php if($track_artist->id != $artist->id)  { ?> - <a href="browse.php?type=artist&id=<?= $track_artist->id ?>"><?= $track_artist->DN ?></a><? } ?></a>
<?php if($_SERVER['HTTP_HOST'] == "localhost") { ?>
		(<a href="download.php?track_id=<?= $track->id ?>&type=mp3">mp3</a>)
		(<a href="download.php?track_id=<?= $track->id ?>&type=ogg">ogg</a>)
		(<a href="download.php?track_id=<?= $track->id ?>&type=wav">wav</a>)
<?php } ?>
		<?php
		if($track->price) { 
			$download_avail = true;
			?>
			<input type="checkbox" name="tracks[<?= $track->id ?>]" checked="true" />
			<?
		}
		?>
		</li>
		<?php
	}
	?>
	<?php
	if($download_avail == true) { ?>
		<input type="submit" class="inputbox" value=" Add Tracks to Basket "/>
		<?php
	}
	?>
	</form>
	</ul>
		<?php if($album->price) { ?>
		<form action="basket.php" method="POST">
		<input type="hidden" name="action" value="add"/>
		<input type="hidden" name="album_id" value="<?= $album->id ?>"/>
		&pound; <?= $album->price ?>
		<input type="submit" value="Add CD basket" class="inputbox"/>
		</form>
		<?php } else { ?>
		Coming soon to buy here
		<?php } ?>
	<?php
?>
<?php include("footer.inc.php"); ?>

