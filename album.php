<?php require("include/common.php"); ?>
<?php


$album = new album();
if(ereg("/album/([^/]+)(.*)",$_SERVER['PHP_SELF'],$matches)) {
        $album->get($matches[1]);
}
else {
	$album->get($_REQUEST['album_id']);
}
	$label = new label();
	$label->get($album->label_id);
	$artist = new artist();
	$artist->get($album->artist_id);

	$page_title = $artist->DN . " - " . $album->DN . " on " . $label->DN;
	$page_keywords = implode(", ",array($artist->DN,$album->name,$album->release_year,$album->label_reference,$label->DN));
	?>
	<?php include("header.inc.php"); ?>
	<h2><?= $album->DN ?> by <a href="<?= browse_link("artist",$artist->id,$artist->name) ?>"><?= $artist->DN ?></a></h2>
	<div style="float: right">
	<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="280" height="280" id="player" align="middle">
<PARAM NAME="wmode" VALUE="transparent"> <param name="allowScriptAccess" value="sameDomain" /><param name="movie" value="<?= $CONF['url'] ?>/mp3player.swf?playlist=<?= $CONF['url'] ?>/playlist.php?album_id=<?= $album->id ?>" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" /><embed src="<?= $CONF['url'] ?>/mp3player.swf?playlist=<?= $CONF['url'] ?>/playlist.php?album_id=<?= $album->id ?>" quality="high" bgcolor="#ffffff" width="280" height="280" name="player" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" wmode="transparent" /></object>
	</div>
	<?php $image = new image(); $image->show($album->image_id,250,250); ?>
	<table>
	<tr><th>Artist:</th><td><a href="<?= browse_link("artist",$artist->id,$artist->name) ?>"><?= $artist->DN ?></a></td><tr>
	<tr><th>Label:</th><td><a href="<?= browse_link("label",$label->id,$label->name) ?>"><?= $label->DN ?></a></td><tr>
	</table>

	<p><?= nl2br($album->summary); ?></p>
	Tracks<br/>
	<ul>
	<form action="<?= $CONF['url'] ?>/basket.php" method="post">
	<?php
	
	$track = new track();
	$track->getTrackListings($album->id);
	$track_artist = new artist();
	$download_avail = false;
	while($track->getNext()) {
		$track_artist->get($track->artist_id);
		?>
		<li><?= $track->track_number ?> - <?= $track->DN ?><?php if($track_artist->id != $artist->id)  { ?> - <a href="<?= browse_link("artist",$track_artist->id,$track_artist->name) ?>"><?= $track_artist->DN ?></a><? } ?></a>
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
		<form action="<?= $CONF['url'] ?>/basket.php" method="POST">
		<input type="hidden" name="action" value="add"/>
		<input type="hidden" name="album_id" value="<?= $album->id ?>"/>
		&pound; <?= $album->price ?>
		<input type="submit" value="Add CD basket" class="inputbox"/>
		</form>
		<?php } else { ?>
		Coming soon to buy here
		<?php } ?>
	<h2>Similar Albums</h2>
	<div id="album_list">
	<?php
	$alist = new album();
	$alist->getList("where label_id=" . $label->id);
	while($alist->getNext()) { ?>
		<?php
		$alist->albumThumb();
	}
	?>
	</div>
		
	
<?php include("footer.inc.php"); ?>

