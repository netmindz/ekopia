<?php require("include/common.php"); ?>
<?php require("include/mpd.php"); ?>
<html>
<head>
<title>Now Playing</title>
<link rel="stylesheet" type="text/css" href="http://www.inspiralled.net/templates/sp_main/css/template_css.css">
<meta http-equiv="refresh" content="10">
</head>
<body>
<?php
if($data = mpd_now_playing()) {
	?>
	<table>
	<tr>
		<td colspan="2" align="right">
		<?php
		$album = new album();
		if($album->getByOther(array('name'=>$data['album']))) {
			?>
			<a href="album.php?album_id=<?= $album->id ?>">
			<?php
			if($album->image_id) {
				$image = new image();
				$image->show($album->image_id,100,100);
				print "<br>";
			}
			?></a>
			<?php
		}
		?>
		</td>
	</tr>
	<tr>
		<td>Artist :</td>
		<td><?= $data['artist'] ?>
			<?php 
			$artist = new artist();
			if($artist->getByOther(array('name'=>$data['artist']))) {
				?>
				(<a href="browse.php?type=artist&id=<?= $artist->id ?>">View Tracks</a>)
				<?php
			}
			?>
		</td>
	</tr>
	<tr>
		<td>Album :</td>
		<td><?if($album->id) { ?><a href="album.php?album_id=<?= $album->id ?>"><? } ?><?= $data['album'] ?><? if($album->id) { ?></a><? } ?></td>
	</tr>
	<tr>
		<td>Track :</td>
		<td><?= $data['title'] ?> (<?= $data['time'] ?>)</td>
	</tr>
	</table>
	<?php
}

?>
</body>
</html>
