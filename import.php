<pre>
<?php

require("include/common.php");
require("/home/www/codebase/amazon.inc.php");

function import_dir($src, user $user)
{
	global $files;
	$hd = dir($src);
	while($name = $hd->read()) {
		if(is_file("$src/$name")&&ereg('\.flac$',$name)) {
			$key = str_replace("../","","$src/$name");
			if(!in_array($key,$files)) {
				if(import_file("$src/$name", $user)) {
					$files[] = $key;
				}
			}
			else {
				print "skipping $name\n";
			}
		}
		elseif(is_dir("$src/$name")&&(!ereg('^\.',$name))) {
			import_dir("$src/$name", $user);
		}
	}
	file_put_contents("../to_import/seen.dat",implode("\n",$files));
}

function import_file($src, user $user)
{
	global $albums, $CONF;

	$info_map = array('title'=>'name','tracknumber'=>'track_number','album'=>'album','artist'=>'artist','date'=>'release_year');
	$raw = array();
	exec("metaflac --list \"$src\"",$results);
	#print_r($results);
	foreach($results as $line) {
		if(eregi("([A-Z]+)=(.+)",$line,$matches)) {
			$raw[strtolower($matches[1])] = $matches[2];
		}
	}
	print_r($raw);
	$info = array();
	foreach($info_map as $key=>$value) {
		$info[$value] = $raw[$key];
	}

	if(!isset($info['artist'])||(!isset($info['album']))) {
		print "WARNING: essential data missing for $src\n";
		return false;
	}
	
	$artist = new artist();
	$artist->LookupOrAdd($info['artist']);
	$info['artist_id'] = $artist->id;
	unset($info['artist']);

	$album = new album();
	$album->LookupOrAdd($info['album'],$artist->id,$info['release_year'], $user);
	$info['album_id'] = $album->id;
	unset($info['album']);
	unset($info['release_year']);

	$albums[$album->id]['name'] = $album->name;
	$albums[$album->id]['artists'][$artist->id] = $artist->name;

	$track = new track();
	$track->addTrack($info, $user);

	print_r($info);

	if($user->id) {
		$userArtist = new user_artist();
		if(!$userArtist->check($track->artist_id, $user)) {
			// user not attached to aritst
			$userArtist->addLink($track->artist_id, $user);
			mail($CONF['shop_email'],"Artist Attachment","$user->DN has been attached to $artist->DN as they uploaded $src");
		}

		if($album->label_id) {
			$userLabel = new user_label();
			if(!$userLabel->check($album->label_id, $user)) {
				$label = $album->getLabel();
				// user not attached to label
				$userLabel->addLink($track->label_id, $user);
				mail($CONF['shop_email'],"Label Attachment","$user->DN has been attached to $label->DN as they uploaded $src");
			}
		}
	}

	$dest = "../raw/" . $album->id . "/" . sprintf("%d",$track->track_number) . ".flac";
    $path = pathinfo($_SERVER['DOCUMENT_ROOT'] . "/" . $src);
    $src = realpath($path['dirname'] . "/" . $path['basename']);
    if(!is_dir(dirname($dest))) mkdir(dirname($dest));
    if(is_file($dest)) unlink($dest);
    if(!is_link($dest)) symlink($src,$dest);

	set_time_limit(10);
	flush();
	print "<hr/>\n";
	return true;
}
$albums = array();
$files = array();
$user = new user();

$tmp = file("../to_import/seen.dat");
foreach($tmp as $t) {
	$files[] = trim($t);
}
import_dir("../to_import", $user);

$user = new user();
$user->get(5);

import_dir("/home/inspiralled-dark/",$user);

$album = new album();
$album->getList("where image_id=0","order by rand()","limit 10");
while($album->getNext()) {
	$artist = $album->getArtist();
	$albums[$album->id]['name'] = $album->name;
	$albums[$album->id]['artists'][$album->artist_id] = $artist->name;
}

print "<h1>Amazon lookups</h1>\n";

foreach($albums as $album_id=>$a) {
	$album = new album();
	$album->get($album_id);
	if(!$album->image_id) {
		print "Searching for " . implode(", ",$a['artists']) .  ", " . $a['name'] . "\n";
		
		$details = amazon_getAlbum($a['artists'],$a['name'],"");

		if(($details)&&(count($details))) {
			print_r($details);
			$album->get($album_id); // fetch again as we might now have an asin
			$image_url = "";
			if((isset($details->ImageUrlLarge))&&($details->ImageUrlLarge)) {
				$image_url = $details->ImageUrlLarge;
			}
			elseif((isset($details->ImageUrlMedium)&&($details->ImageUrlMedium))) {
				$image_url = $details->ImageUrlMedium;
			}
			elseif($album->amazon_asin) {
				$image_url = "http://images.amazon.com/images/P/".$album->amazon_asin.".01._SCMZZZZZZZ_.jpg";
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
}
?>
</pre>
