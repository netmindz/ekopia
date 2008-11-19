<?php
$is_admin_area = true;
require("../include/site_config.inc.php");
require("/home/www/codebase/database.php");
require("../include/common.php");

$actions = array("nametracks"=>"Guess track names","deleteorphans"=>"Delete orphan artists");

function nametracks() {
	$track = new track();
	$track->getList("where name=''");
	while($track->getNext()) {
		$artist = new artist();
		$artist->get($track->artist_id);
		$name = ereg_replace('^[0-9]+ - ','',$artist->name);
		if(ereg('(.+) - (.+)',$name,$matches)) {
			print "looks like [" . $name . "] could be artist [" . $matches[1] . "] - ";
			$artist_new = new artist();
			if($artist_new->getByOther(array('name'=>$matches[1]))) {
				print "FOUND";
				$track_new = new track();
				$track_new->get($track->id);
				$track_new->name = $matches[2];
				$track_new->artist_id = $artist_new->id;
				$track_new->update();
			}
			elseif($artist_new->getByOther(array('name'=>$matches[2]))) {
				print "FOUND2";
				$track_new = new track();
				$track_new->get($track->id);
				$track_new->name = $matches[1];
				$track_new->artist_id = $artist_new->id;
				$track_new->update();
			}
			else {
				print "NOT FOUND";
			}
		}
		else {
			print "Could not guess track name from artist name " . $name;
		}
		print "\n";
	}
	print "\nDONE";
	flush();
	deleteorphans();
}

function deleteorphans()
{
	print "\n\n****DELETE ORPHANS****\n\n";
	$artist = new artist();
	$artist->getList();
	while($artist->getNext()) {
		$album = new album();
		$track = new track();
		$acount = $album->getListByType('artist',$artist->id);
		$tcount = $track->getListByType('artist',$artist->id);
		$count = $acount + $tcount;
		if(!$count) {
			$artist_new = new artist();
			$artist_new->get($artist->id);
			print $artist_new->name . "\n";
			$artist_new->delete($artist_new->id);
		}
	}
	print "\nDONE";
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
