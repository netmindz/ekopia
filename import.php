<pre>
<?php
require("include/common.php");

function import_dir($src)
{
	$hd = dir($src);
	while($name = $hd->read()) {
		if(is_file("$src/$name")&&ereg('\.flac$',$name)) {
			import_file("$src/$name");
		}
		elseif(is_dir("$src/$name")&&(!ereg('^\.',$name))) {
			import_dir("$src/$name");
		}
	}
}

function import_file($src)
{
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

	

	$track = new track();
	$track->addTrack($info);

	print_r($info);

	$dest = "raw/" . $album->id . "/" . sprintf("%d",$track->track_number) . ".flac";
	if(!is_dir(dirname($dest))) mkdir(dirname($dest));
	if(!is_file($dest)) copy($src,$dest); 
	flush();
	print "<hr/>\n";
}

import_dir("to_import");
?>
</pre>
