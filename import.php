<pre>
<?php
require("include/common.php");
require("include/amazon.inc.php");

function import_dir($src)
{
	global $files;
	$hd = dir($src);
	while($name = $hd->read()) {
		if(is_file("$src/$name")&&ereg('\.flac$',$name)) {
			if(!in_array("$src/$name",$files)) {
				import_file("$src/$name");
				$files[] = "$src/$name";
			}
			else {
				print "skipping $name\n";
			}
		}
		elseif(is_dir("$src/$name")&&(!ereg('^\.',$name))) {
			import_dir("$src/$name");
		}
	}
	file_put_contents("../to_import/seen.dat",implode("\n",$files));
}

function import_file($src)
{
	global $albums;

	$info_map = array('title'=>'name','tracknumber'=>'track_number','album'=>'album','artist'=>'artist','date'=>'release_year');
	$raw = array();
	exec("metaflac --list \"$src\"",$results);
	#print_r($results);
	foreach($results as $line) {
		if(ereg("([A-Z]+)=(.+)",$line,$matches)) {
			$raw[strtolower($matches[1])] = $matches[2];
		}
	}
	print_r($raw);
	$info = array();
	foreach($info_map as $key=>$value) {
		$info[$value] = $raw[$key];
	}
	
	$artist = new artist();
	$artist->LookupOrAdd($info['artist']);
	$info['artist_id'] = $artist->id;
	unset($info['artist']);

	$album = new album();
	$album->LookupOrAdd($info['album'],$artist->id,$info['release_year']);
	$info['album_id'] = $album->id;
	unset($info['album']);
	unset($info['release_year']);

	$albums[$album->id]['name'] = $album->name;
	$albums[$album->id]['artists'][$artist->id] = $artist->name;

	$track = new track();
	$track->addTrack($info);

	print_r($info);

	$dest = "../raw/" . $album->id . "/" . sprintf("%d",$track->track_number) . ".flac";
	if(!is_dir(dirname($dest))) mkdir(dirname($dest));
	if(!is_file($dest)) copy($src,$dest); 
	set_time_limit(10);
	flush();
	print "<hr/>\n";
}
$albums = array();
$files = array();

$tmp = file("../to_import/seen.dat");
foreach($tmp as $t) {
	$files[] = trim($t);
}
import_dir("../to_import");

print "<h1>Amazon lookups</h1>\n";

foreach($albums as $album_id=>$a) {
	$album = new album();
	$album->get($album_id);
	if(!$album->image_id) {
		$details = amazon_getAlbum($a['artists'],$a['name'],"");
		#print_r($details);

		$image_url = "";
		if($details->ImageUrlLarge) {
			$image_url = $details->ImageUrlLarge;
		}
		elseif($details->ImageUrlMedium) {
			$image_url = $details->ImageUrlMedium;
		}
		if($image_url) {
			print "Grabbing image for $album->DN\n";
			$file = tempnam("/tmp/","cover");
			file_put_contents($file,file_get_contents($image_url));
			$image = new image();
			$album->setField("image_id",$image->upload($file,ereg_replace("[^a-zA-Z]","",$album->DN).".jpg"));
		}
	}
}
?>
</pre>
