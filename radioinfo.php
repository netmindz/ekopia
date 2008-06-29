<?php
header("Content-type: text/plain");
require("include/common.php"); 
$album = new album();
if($album->getByOther(array('name'=>$_REQUEST['album']))) {
	print "album_link#" . browse_link("album",$album->id,$album->name)."\n";
	if($album->image_id) {
		print "image#http://shop.inspiralled.net/showimage.php?id=$album->image_id\n";
	}
}
$artist = new artist();
if($artist->getByOther(array('name'=>$_REQUEST['artist']))) {
	print "artist_link#" . browse_link("artist",$artist->id,$artist->name)."\n";
}
?>
