<?php require("include/common.php"); ?>
<?php require("include/mpd.php"); ?>
<html>
<head>
<title>Now playing</title>
<link rel="stylesheet" type="text/css" href="http://www.inspiralled.net/templates/sp_main/css/template_css.css">
<meta http-equiv="refresh" content="10"></head><body marginwidth="0" marginheight="0">
<?php
if($data = mpd_now_playing()) { ?>
<table width="100" border="0">
	<tbody>
	<tr>
             <td colspan="2" align="center"><a href="album.php?album_id=<?= $album->id ?>" target="_new">
		<?php
		$album = new album();
		if($album->getByOther(array('name'=>$data['album']))) {	
			if($album->image_id) {
				$image = new image();
				$image->show($album->image_id,100,100);
			}
		}
		?></a>
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
</tbody>
</table>

	<?php
}

?>
</body>
</html>
