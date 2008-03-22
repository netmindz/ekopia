<?php include("include/common.php"); ?>
<?php require("include/mpd.php"); ?>
<?php include("header.inc.php"); ?>
<h2>Latest Albums</h2>
<ul>
<?php
$album = new album();
$album->getNew(5);
while($album->getNext()) { ?>
	<li><a href="<?= album_link($album->id,$album->name) ?>"><?= $album->name ?></li>
	<?php
} 
?>
</ul>
<?php
if($data = mpd_now_playing()) {
	?>
	<h2>Currently Playing In Store</h2>
	<table width="100%">
	<tr>
		<th>Artist :</th>
		<td><?= $data['artist'] ?>
			<?php 
			$artist = new artist();
			if($artist->getByOther(array('name'=>$data['artist']))) {
				?>
				(<a href="browse.php?type=artist&amp;id=<?= $artist->id ?>">View Tracks</a>)
				<?php
			}
			?>
		</td>
		<td rowspan="3" align="center">
		<?php
		$album = new album();
		if($album->getByOther(array('name'=>$data['album']))) {
			?>
			<a href="album.php?album_id=<?= $album->id ?>">
			<?php
			if($album->image_id) {
				$image = new image();
				$image->show($album->image_id,150,150);
				print "<br/>";
			}
			?>
			View Album</a>

			<?php
		}
		?>
		</td>
	</tr>
	<tr>
		<th>Album :</th>
		<td><?if($album->id) { ?><a href="album.php?album_id=<?= $album->id ?>"><? } ?><?= $data['album'] ?><? if($album->id) { ?></a><? } ?></td>
	</tr>
	<tr>
		<th>Track :</th>
		<td><?= $data['title'] ?> (<?= $data['time'] ?>)</td>
	</tr>
	</table>
	<?php
}

?>
<?php include("footer.inc.php"); ?>

