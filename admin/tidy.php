<?php
$is_admin_area = true;
require("../include/site_config.inc.php");
require("/home/www/codebase/database.php");
require("../include/common.php");

$actions = array("nametracks"=>"Guess track names");

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
				$track->name = $matches[2];
				$track->artist_id = $artist_new->id;
				$track->update();
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
