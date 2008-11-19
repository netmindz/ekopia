<?php
$is_admin_area = true;
require("../include/site_config.inc.php");
require("/home/www/codebase/database.php");
require("../include/common.php");

$actions = array("nametracks"=>"Guess track names","deleteorphans"=>"DO NOT USE");

function nametracks() {
	$track = new track();
	$track->getList("where name=''");
	while($track->getNext()) {
		$artist = new artist();
		$artist->get($track->artist_id);
		if(ereg('(.+) - (.+)',$artist->name,$matches)) {
			print "looks like [" . $artist->name . "] could be artist [" . $matches[1] . "] - ";
			$artist_new = new artist();
			if($artist_new->getByOther(array('name'=>$matches[1]))) {
				print "FOUND";
				$track_new = new track();
				$track_new->get($track->id);
				$track_new->name = $matches[2];
				$track_new->artist_id = $artist_new->id;
				$track_new->update();
			}
			else {
				print "NOT FOUND";
			}
		}
		else {
			print "Could not guess track name from artist name " . $artist->name;
		}
		print "\n";
	}
	print "\nDONE";
}

function deleteorphans()
{
	$artist = new artist();
	$artist->getList();
	while($artist->getNext()) {
		$album = new album();
		$track = new track();
		$acount = $album->getByType('artist'=>$artist->id);
		$tcount = $track->getByType('artist'=>$artist->id);
		print $artist->name . " $acount $tcount\n";
	}
}
?>
<html>
<head>
<title>Tidy</title>
</head>
<body>
<? include("nav.inc"); ?>
<form method="post">
<select name="action">
<?
foreach($actions as $key=>$name) { 
	print "<option value=\"$key\">" . $name . "</option>\n";
}
?>
</select>
<input type="submit" value=" Run Task ">
</form>
<pre>
<?
if(isset($_POST['action'])) {
	
	$_POST['action']();
}

?>
</pre>
