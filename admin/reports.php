<?php
require("../include/site_config.inc.php");
require("/home/www/codebase/database.php");
require("/home/www/codebase/fpdf.php");
$reports = array();

$reports['album_list'] =  array("title"=>"Album List","sql"=>"select id,name,price,stock_count from albums order by name");
$reports['unamed'] =  array("title"=>"Unnamed Tracks","sql"=>"select albums.id,albums.name,sum(if(tracks.name = '',1,0)) as unnamed from tracks left join albums on album_id=albums.id group by albums.id having unnamed > 0");
$reports['orpahan_tracks'] =  array("title"=>"Orphan Tracks","sql"=>"select tracks.id,tracks.name from tracks left join albums on album_id=albums.id where albums.name is null");
$reports['lonely_artists'] =  array("title"=>"Empty Artists","sql"=>"select artists.id,artists.name,count(tracks.artist_id) as track_count, count(albums.artist_id) as album_count from artists left join albums on artists.id=albums.artist_id left join tracks on artists.id=tracks.artist_id group by artists.id having album_count = 0 and track_count = 0");
$reports['untagged_albums'] = array('title'=>'Untagged Albums','sql'=>'select albums.id,albums.name,count(album_tags.id) as tag_count from albums left join album_tags on albums.id=album_FK  group by albums.id having tag_count=0 order by albums.name');
$reports['sale_summary'] = array('title'=>'Sales Summary','sql'=>"SELECT date_format(created,'%y-%m') as date,type,count(*) num,sum(li.price) value,if(products.id is not null,types.name,if(pv.id is not null,pvt.name,li.type)) as item from line_items li inner join orders on (order_id=orders.id) left join products on (item_id=products.id and type='product') left join types on (products.type_id=types.id) left join product_variations pv on (item_id=pv.id and type='product_variation') left join products pvp on (pv.product_id=pvp.id) left join types pvt on (pvp.type_id=pvt.id) where payment_status='Completed' and type != 'unknown' and type != '' group by type,date order by date,type,item");

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

