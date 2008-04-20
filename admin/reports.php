<?php
require("../include/site_config.inc.php");
require("/home/www/codebase/database.php");
require("/home/www/codebase/fpdf.php");
$reports = array();

$reports['album_list'] =  array("title"=>"Album List","sql"=>"select id,name,price,stock_count from albums order by name");
$reports['unamed'] =  array("title"=>"Unnamed Tracks","sql"=>"select albums.id,albums.name,sum(if(tracks.name = '',1,0)) as unnamed from tracks left join albums on album_id=albums.id group by albums.id having unnamed > 0");
$reports['orpahan_tracks'] =  array("title"=>"Orphan Tracks","sql"=>"select tracks.id,tracks.name from tracks left join albums on album_id=albums.id where albums.name is null");
$reports['lonely_artists'] =  array("title"=>"Empty Artists","sql"=>"select artists.id,artists.name,count(tracks.artist_id) as track_count, count(albums.artist_id) as album_count from artists left join albums on artists.id=albums.artist_id left join tracks on artists.id=tracks.artist_id group by artists.id having album_count = 0 and track_count = 0");
$reports['untagged_albums'] = array('title'=>'Untagged Albums','sql'=>'select id,albums.name,count(album_tags.id) as tag_count from albums left join album_tags on albums.id=album_FK order by albums.name group by albums.id having tag_count=0');

if(isset($_POST['report'])) {
	$report = $_POST['report'];
	$sql = $reports[$report]['sql'];
	$title= $reports[$report]['title'];
	require("/home/www/codebase/premier_report_engine.php");
}
else { ?>
<html>
<head>
<title>Reports</title>
</head>
<body>
<? include("nav.inc"); ?>
<form method="post">
<select name="report">
<?
foreach($reports as $report=>$details) { 
	print "<option value=\"$report\">" . $details['title'] . "</option>\n";
}
?>
</select>
<input type="submit" value=" Run Report ">
</form>

<?
}
?>

