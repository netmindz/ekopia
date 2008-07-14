<?php require("include/common.php"); ?>
<?php require("include/mpd.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><head><title>now playing</title>
<meta http-equiv="content-type" content="text/html;charset=utf-8">
<link rel="stylesheet" type="text/css" href="http://www.inspiralled.net/streamer/radio_template2_css.css">
<meta http-equiv="refresh" content="30">
</head><body>
<?php
if($data = mpd_now_playing()) {
	$album = new album();
?>
		<table border="0" width="141" >
	<tbody>
				<tr>
					<td align="center" width="8" height="55"></td>
					<td colspan="2" align="center" height="55"></td>

					<td align="center" width="8" height="55"></td>
				</tr>
				<tr>
					<td align="center" width="8" height="100"></td>
					<td colspan="2" align="center" height="100">
						<div align="center">
							<?php if($album->getByOther(array('name'=>$data['album']))) { ?>
		<a href="album.php?album_id=<?= $album->id ?>" target="_new">
		<?php
		if($album->image_id) {
			$image = new image();
			$image->show($album->image_id,100,100);
		}
		?></a>
		<?php } ?></div>
					</td>
					<td align="center" width="8" height="100"></td>

				</tr>
	<tr>
					<td width="8"></td>
					<td width="35">Artist:</td>
		<td><?php 
			$artist = new artist();
			if($artist->getByOther(array('name'=>$data['artist']))) {
				?><a href="<?= browse_link("artist",$artist->id,$artist->name) ?>" target="_new"><?= $data['artist'] ?></a><?php
			}
			else { ?><?= $data['artist'] ?><?php
			}
			?></td>
					<td width="8"></td>

				</tr>
	<tr>
					<td valign="top" width="8"></td>
					<td valign="top" width="35">Album:</td>
		<td valign="top"><?if($album->id) { ?><a href="album.php?album_id=<?= $album->id ?>" target="_new" ><? } ?><?= $data['album'] ?><? if($album->id) { ?></a><? } ?></td>
					<td width="8"></td>
				</tr>
	<tr>

					<td width="8"></td>
					<td valign="top" width="35">Track:</td>
		<td valign="top"><?= $data['title'] ?> (<?= $data['time'] ?>)</td>
					<td width="8"></td>
				</tr>
				<tr>
					<td width="8" height="8"></td>
					<td width="35" height="8"></td>

					<td height="8"></td>
					<td width="8" height="8"></td>
				</tr>
			</tbody>
</table>
	<div align="center"><a href="radio.php" onClick="window.open('radio.php','radio','menubar=0,resizable=1,width=400,height=200'); return false;" target="_new">Listen Now</a></div>
	<?php
}
else { ?>
<br/>
<br/>
<br/>
<br/>
<p>Can't identify current track</p>
<?php
}
?>
</body>
</html>

	</body></html>
