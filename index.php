<?php include("header.inc.php"); ?>
<h1>Welcome</h1>
Welcome to the brand new inspiralled shop
<?php
flush();
$fp = fsockopen("10.0.11.6",6600);
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
	?>
	<h2>Currently Playing In Store</h2>
	<table>
	<tr>
		<th>Artist</th>
		<td><?= $data['artist'] ?></td>
	</tr>
	<tr>
		<th>Album</th>
		<td><?= $data['album'] ?></td>
	</tr>
	<tr>
		<th>Track</th>
		<td><?= $data['title'] ?></td>
	</tr>
	</table>
	<?php
}

?>
<?php include("footer.inc.php"); ?>

