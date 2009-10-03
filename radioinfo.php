<?php
header("Content-type: text/plain");
require("include/common.php"); 
$album = new album();
if($album->getByOther(array('name'=>$_REQUEST['album']))) {
	print "album_link#http://shop.inspiralled.net" . album_link($album->id,$album->name)."\n";
	if($album->image_id) {
		print "image#http://shop.inspiralled.net/showimage.php?id=$album->image_id&width=120&height=120&nocache=true\n";
	}
}
$artist = new artist();
if($artist->getByOther(array('name'=>$_REQUEST['artist']))) {
	print "artist_link#http://shop.inspiralled.net" . browse_link("artist",$artist->id,$artist->name)."\n";
}
?>
