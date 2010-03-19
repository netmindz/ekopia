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
 if(albums.id is not null,albums.artist_id,tracks.artist_id) as artist,
 if(albums.id is not null,albums.label_id,track_album.label_id) as label,
 sum(line_items.price) as total_paid
  FROM line_items left join albums on (type='album' and item_id=albums.id)
   left join tracks on (type='track' and item_id=tracks.id)
   left join albums track_album on (tracks.album_id=track_album.id)
    inner join orders on (order_id=orders.id)
     where delivery='download' and item_id > 0 and payment_status='Completed'
      group by purchase_month, item_id 
      having artist in (" . implode(",", $limit['artist']) . ") or label in (" . implode(",", $limit['label']) . ") or tracks.user_id=$user->id
	 order by purchase_month, num";

$title = "Download Sales";

$sizes = array('table'=>10,'data'=>8);

$data = array();
$db->query($sql);
while($row = $db->getNextRow()) {
	$data[] = $row;
}

?>
<html>
<head>
<title><?= $title ?></title>
</head>
<body>
<h1><?= $title ?></h1>
<table>
<tr>
	<th><?php implode("</th><th>",array_keys($data[0])) ?></th>
</tr>
<?php
foreach($data as $row) {
	?>
<tr>
	<td><?php implode("</td><td>",$row) ?></td>
</tr>
</table>
