<?php
require("../include/site_config.inc.php");
$is_admin_area = true;
require("../include/common.php");
?>
<html>
<head>
<title>Stock Control</title>
</head>
<body>
<? include("nav.inc"); ?>
<?
if(isset($_POST['values'])) {
	foreach($_POST['values']  as $id=>$details) {
		$album = new album();
		$album->get($id);
		if($album->stock_count != $details['count']) {
			print "Updating stock count for $album->DN to " . $details['count'] ."<br/>\n";
			$album->setField("stock_count",$details['count']);
		}
		if($album->price != $details['price']) {
			print "Updating price for $album->DN to " . $details['price'] ."<br/>\n";
			$album->setField("price",$details['price']);
		}
	}
	
}
else { ?>
<form method="post">
<table>
<?
$album = new album();
$album->getList();
while($album->getNext()) {
	?>
<tr>
	<th><?= $album->DN ?></th>
	<td><input type="text" name="values[<?= $album->id ?>][count]" value="<?= $album->stock_count ?>"/></td>
	<td><input type="text" name="values[<?= $album->id ?>][price]" value="<?= $album->price ?>"/></td>
</tr>
	<?
}
?>
</table>
<input type="submit" value=" Update Stock ">
</form>

<?
}
?>

