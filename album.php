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

$page_title =  $album->DN . " by " . $artist->DN . " on " . $label->DN;

$artists = array();
$track = new track();
$track->getTrackListings($album->id);
$track_artist = new artist();
$download_avail = false;
while($track->getNext()) {
	$track_artist->get($track->artist_id);
	$artists[] = $track_artist->name;
}

$page_keywords = implode(", ",array_unique(array_merge(array($artist->DN,$album->name,$album->release_year,$album->label_reference,$label->DN),$artists)));
$page_meta = "$album->name by $artist->DN featuring " . implode(", ",array_unique($artists));
	?>
<?php include("header.inc.php"); ?>
	<h2><?= $album->DN ?> by <a href="<?= browse_link("artist",$artist->id,$artist->name) ?>"><?= $artist->DN ?></a></h2>
	<div style="float: right">
	<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="280" height="280" id="player" align="middle">
<PARAM NAME="wmode" VALUE="transparent"> <param name="allowScriptAccess" value="sameDomain" /><param name="movie" value="<?= $CONF['media_url'] ?>/mp3player.swf?playlist=<?= $CONF['media_url'] ?>/playlist.php?album_id=<?= $album->id ?>" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" /><embed src="<?= $CONF['media_url'] ?>/mp3player.swf?playlist=<?= $CONF['media_url'] ?>/playlist.php?album_id=<?= $album->id ?>" quality="high" bgcolor="#ffffff" width="280" height="280" name="player" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" wmode="transparent" /></object>
	</div>
	<?php $image = new image(); $image->show($album->image_id,250,250); ?>
	<table>
	<tr><th>Artist:</th><td><a href="<?= browse_link("artist",$artist->id,$artist->name) ?>"><?= $artist->DN ?></a></td></tr>
	<tr><th>Label:</th><td><a href="<?= browse_link("label",$label->id,$label->name) ?>"><?= $label->DN ?></a></td></tr>
	</table>

	<p><?= nl2br($album->summary); ?></p>
	<table width="100%">
	<tr>
	<td>
	Tracks<br/>
	<form action="<?= $CONF['url'] ?>/basket.php" method="post">
	<table>
	<?php
	
	$track = new track();
	$track->getTrackListings($album->id);
	$track_artist = new artist();
	$download_avail = false;
	while($track->getNext()) {
		$track_artist->get($track->artist_id);
		?>
		<tr>
		<td>&bull;&nbsp;<?= $track->track_number ?> - <?= $track->name ?><?php if($track_artist->id != $artist->id)  { ?> - <a href="<?= browse_link("artist",$track_artist->id,$track_artist->name) ?>"><?= $track_artist->DN ?></a><? } ?>
<?php /*if($_SERVER['HTTP_HOST'] == "flat.netmindz.net") { ?>
		(<a href="download.php?track_id=<?= $track->id ?>&type=mp3">mp3</a>)
		(<a href="download.php?track_id=<?= $track->id ?>&type=ogg">ogg</a>)
		(<a href="download.php?track_id=<?= $track->id ?>&type=wav">wav</a>)
<?php } */ ?>
		</td>
		<td>
		<?php
		if($track->price) { 
			$download_avail = true;
			?>
			<input type="checkbox" name="tracks[<?= $track->id ?>]" checked="true" /> &pound;<?= $track->price ?>
			<?
		}
		?>
		</td>
		</tr>
		<?php
	}
	?>
	<?php
	if($download_avail == true) { ?>
		<tr>
			<td></td>
			<td><input type="submit" class="inputbox" value=" Add Selected Tracks to basket "/></td>
		</tr>
		<?php
	}
	?>
	</table>
	</td>
	<td>
		Tags:<br>
		<ul>
		<?
		$atag = new album_tag();
		$atag->getByAlbum($album->id);
		while($atag->getNext()) {
			$tag = new tag();
			$tag->get($atag->tag_FK);
			?>
			<li><a href="<?= $CONF['url'] ?>/tags.php?id=<?= $tag->id ?>"><?= $tag->name ?></a></li>
			<?
		}
		?>
		</ul>
	</td>
	</tr>
	</table>
	</form>
	<h3>Album purchase</h3>
		<?php if($album->download_price > 0) { ?>
		<form action="<?= $CONF['url'] ?>/basket.php" method="post">
		<input type="hidden" name="action" value="add"/>
		<input type="hidden" name="delivery" value="download"/>
		<input type="hidden" name="album_id" value="<?= $album->id ?>"/>
		&pound; <?= $album->download_price ?>
		<input type="submit" value=" Add Album Download to basket " class="inputbox"/>
		</form>
		<?php } ?>
		<?php if(($album->price)&&($album->stock_count > 0)) { ?>
		<form action="<?= $CONF['url'] ?>/basket.php" method="post">
		<input type="hidden" name="action" value="add"/>
		<input type="hidden" name="delivery" value="cd"/>
		<input type="hidden" name="album_id" value="<?= $album->id ?>"/>
		&pound; <?= $album->price ?>
		<input type="submit" value=" Add CD basket " class="inputbox"/>
		</form>
		<?php } elseif($album->price > 0 && $album->stock_count <= 0) { ?>
		CD Out of stock
		<?php } elseif(($album->download_price <= 0)&&($album->price <= 0)) { ?>
		Coming soon to buy here
		<?php } else { ?>
		Download only
		<?php } ?>
		
		<p>&nbsp;</p>
		<hr/>
	<h2>Similar Albums</h2>
<!--	<div id="album_list"> -->
	<?php
	$alist = new album();
	if($artist->id != 198) $alist->getList("where id != $album->id AND artist_id=$artist->id","order by rand()","limit 0,2");
	while($alist->getNext()) { ?>
		<?php
		$alist->displayThumb();
	}
	$alist->getList("where id != $album->id AND label_id=" . $label->id,"order by rand()","limit 0,2");
	while($alist->getNext()) { ?>
		<?php
		$alist->displayThumb();
	}
	?>
<!--	</div> -->
		
	
<?php include("footer.inc.php"); ?>

