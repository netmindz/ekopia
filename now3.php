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
img {
	border: 0px;
}
</style>
</body>
</head>
<body>
<?php
$div_pos = "position: absolute; left: 500px; top: 69px; width:340px;";
#$debug_style = "border: 1px solid; background-color: white;";
$debug_style = "";
?>
<?php
if($data = icecast_get_live()) {
	?>
<DIV ID="TICKER" STYLE="<?= $debug_style ?> <?= $div_pos ?> overflow:hidden;"  onmouseover="TICKER_PAUSED=true" onmouseout="TICKER_PAUSED=false">
<a href="http://shop.inspiralled.net/radio.php" onClick="window.open('radio.php','radio','menubar=0,resizable=1,width=400,height=200'); return false;">Listen to live broadcast of <?= $data->artist ?> - <?= $data->title ?> live and direct from the lounge</a></div>

<div style="position: absolute; left: 885px;">
<h1 style="color: white;">Live<br>Feed</h1>
</div>
	<?php
}
elseif($data = mpd_now_playing()) {
	$album = new album();
	$album->getByOther(array('name'=>$data['album']));
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
	Track:	<?= $data['title'] ?>
	&nbsp;&nbsp;&nbsp;<a href="radio.php" onClick="window.open('radio.php','radio','menubar=0,resizable=1,width=400,height=200'); return false;" target="_new">Listen to inSpiral Radio stream</a>
	</div>
		<?php if($album->image_id) { ?>
			<div style="position: absolute; left: 885px;">
			<!-- <a href="album.php?album_id=<?= $album->id ?>" target="_new"> -->
			<a href="radio.php" nClick="window.open('radio.php','radio','menubar=0,resizable=1,width=400,height=200'); return false;" target="_new">
			<?php
				$image = new image();
				$image->show($album->image_id,78,78);
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
<script type="text/javascript" src="webticker_lib.js" language="javascript"></script>
</body>
</html>

