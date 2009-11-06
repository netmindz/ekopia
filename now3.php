<?php require("include/common.php"); ?>
<?php require("include/mpd.php"); ?>
<?php require("include/icecast.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><head><title>now playing</title>
<meta http-equiv="content-type" content="text/html;charset=utf-8">
<meta http-equiv="refresh" content="60">
<style type="text/css">
body {
	font-family:Arial;
	font-size:12px;
}
</style>
</body>
</head>
<body>
<?php
$div_pos = "position: absolute; left: 500px; top: 68px; width:340px;";
#$debug_style = "border: 1px solid; background-color: white;";
$debug_style = "";
?>
<?php
if($data = icecast_get_live()) {
	?>
<h1>We are LIVE !</h1>
<p><a href="http://www.inspiralled.net:8000/ekopia.ogg.m3u">Listen to live broadcast of <?= $data->artist ?> - <?= $data->title ?> direct from the lounge</a></p>
<p>Requires
<ul>
<li><a href="http://download.nullsoft.com/winamp/client/winamp5541_full_emusic-7plus_en-us.exe">winamp</a> or </li>
<li><a href="radio.php" onClick="window.open('radio.php','radio','menubar=0,resizable=1,width=400,height=200'); return false;" target="_new">inSpiral Radio</a> (requires java)</li>
</ul>
</p>
<p>Note: iTunes will not work, even if you have OggVorbis support</p>
	<?php
}
elseif($data = mpd_now_playing()) {
	$album = new album();
	?>
	<DIV ID="TICKER" STYLE="<?= $debug_style ?> <?= $div_pos ?> overflow:hidden;"  onmouseover="TICKER_PAUSED=true" onmouseout="TICKER_PAUSED=false">
	Artist:
	<?php 
	$artist = new artist();
	if($artist->getByOther(array('name'=>$data['artist']))) {
		?><a href="<?= browse_link("artist",$artist->id,$artist->name) ?>" target="_new"><?= $data['artist'] ?></a><?php
	}
	else { ?><?= $data['artist'] ?><?php
	}
	?>
	&nbsp;&nbsp;&nbsp;
	Album:	<?if($album->id) { ?><a href="album.php?album_id=<?= $album->id ?>" target="_new" ><? } ?><?= $data['album'] ?><? if($album->id) { ?></a><? } ?>
	&nbsp;&nbsp;&nbsp;
	Track:	<?= $data['title'] ?> - <a href="radio.php" onClick="window.open('radio.php','radio','menubar=0,resizable=1,width=400,height=200'); return false;" target="_new">Listen Now</a>
	</div>
	<script type="text/javascript" src="webticker_lib.js" language="javascript"></script>
		<?php if($album->getByOther(array('name'=>$data['album']))&&($album->image_id)) { ?>
			<div style="position: absolute; left: 885px;">
			<a href="album.php?album_id=<?= $album->id ?>" target="_new">
			<?php
				$image = new image();
				$image->show($album->image_id,90,90);
			?>
			</a>
		<?php } ?>

		<?php
}
else { ?>
<DIV STYLE="<?= $debug_style ?> <?= $div_pos ?> overflow:hidden;">
Can't identify current track
</div>
<?php
}
?>
</body>
</html>

