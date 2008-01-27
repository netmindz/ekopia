<?php include("include/common.php"); ?>
<?php include("header.inc.php"); ?>
<h1>Welcome</h1>
Welcome to the brand new inspiralled shop
<?php
flush();
$fp = fsockopen("10.0.11.6",6600,$errno,$errstr,5);
$banner = fgets($fp,255);
if(ereg("OK",$banner)) {
	fputs($fp,"status\n");
	$sanity = 0;
	$data = array();
	while($line = trim(fgets($fp,255))) {
		#print $line . "<br>\n";
		if($sanity > 1000) break;
		$sanity++;
		if($line=="OK") break;
		list($key,$value) = explode(": ",$line);
		$data[$key] = $value;
	}

	fputs($fp,"playlistinfo " . $data['song'] . "\n");
	        while($line = trim(fgets($fp,255))) {
                #print $line . "<br>\n";
                if($sanity > 1000) break;
                $sanity++;
                if($line=="OK") break;
                list($key,$value) = explode(": ",$line);
                $data[strtolower($key)] = $value;
        }
	#print_r($data);
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
				(<a href="browse.php?type=artist&id=<?= $artist->id ?>">View Tracks</a>)
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
				print "<br>";
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
		<td><?= $data['title'] ?></td>
	</tr>
	</table>
	<?php
}

?>
<?php include("footer.inc.php"); ?>

