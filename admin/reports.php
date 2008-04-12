<?php
require("../include/site_config.inc.php");
require("/home/www/codebase/database.php");
require("/home/www/codebase/fpdf.php");
$reports = array();

$reports['album_list'] =  array("title"=>"Album List","sql"=>"select id,name,price,stock_count from albums order by name");
$reports['unamed'] =  array("title"=>"Unnamed Tracks","sql"=>"select albums.id,albums.name,sum(if(tracks.name = '',1,0)) as unnamed from tracks left join albums on album_id=albums.id group by albums.id having unamed > 0");
$reports['orpahan_tracks'] =  array("title"=>"Orpahn Tracks","sql"=>"select tracks.id,tracks.name from tracks left join albums on album_id=albums.id where albums.name is null");

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

