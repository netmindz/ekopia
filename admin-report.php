<?php include("include/common.php"); ?>
<?
$user->checkLogin();

$limit = array('artist'=>array(-1),'label'=>array(-1));
foreach(array_keys($limit) as $type) {
	$perm = "user_$type";
	$typelist = new $perm();
	$count = $typelist->getUserList($user);
#	print "found $count $perm\n";
	while($typelist->getNext()) {
		$get = "get" . ucwords($type);
		$typeObj = $typelist->$get();
		if($typeObj->id) {
			$limit[$type][] = $typeObj->id;
		}
	}
}

$sql = "SELECT date_format(orders.created,'%Y-%m') as purchase_month,count(*) as num,if(albums.id is not null,concat('Album: ',albums.name),concat('Track: ',tracks.name)) as name,
 if(albums.id is not null,album_artists.name,track_artists.name) as artist,
 sum(line_items.price) as total_paid,
 if(albums.id is not null,albums.label_id,track_album.label_id) as label_id,
 tracks.user_id
  FROM line_items left join albums on (type='album' and item_id=albums.id)
   left join tracks on (type='track' and item_id=tracks.id)
   left join albums track_album on (tracks.album_id=track_album.id)
   left join artists track_artists on (track_artists.id = tracks.artist_id)
   left join artists album_artists on (album_artists.id = albums.artist_id)
    inner join orders on (order_id=orders.id)
     where delivery='download' and item_id > 0 and payment_status='Completed'
      group by purchase_month, item_id 
      having artist in (" . implode(",", $limit['artist']) . ") or label_id in (" . implode(",", $limit['label']) . ") or tracks.user_id=$user->id
	 order by purchase_month, num";

$title = "Download Sales";

$sizes = array('table'=>10,'data'=>8);

$db = new database();
$data = array();
$db->query($sql);
while($row = $db->getNextRow()) {
	foreach($row as $key=>$v) {
		if(ereg("_id",$key)) unset($row[$key]);
	}
	$data[] = $row;
}

if(isset($_REQUEST['type'])) {
	header("Content-Type: text/csv");
	header("Content-Disposition: attachment; filename=report.csv");
	foreach($data as $i=>$row) {
		if(!$i) print '"' . implode('","', array_keys($row)) . "\"\n";
		print '"' . implode('","', $row) . "\"\n";
	}
	exit();
}

?>
<html>
<head>
<title><?= $title ?></title>
</head>
<body>
<h1><?= $title ?></h1>
<table border=1>
<tr>
	<th><?= implode("</th><th>",array_keys($data[0])) ?></th>
</tr>
<?php
foreach($data as $row) {
	?>
<tr>
	<td><?= implode("</td><td>",$row) ?></td>
</tr>
<?php } ?>
</table>
<p><a href="admin-report.php?type=csv">Download CSV</a></p>
