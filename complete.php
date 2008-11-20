<?php include("include/common.php"); ?>
<?php include("header.inc.php"); ?>
<h1>Thankyou</h1>
Thankyou for your order from the shop. You should get an email shortly confirming your order
<?php
$order = new order();
if(isset($_REQUEST['order_id'])) {
	$order->get($_REQUEST['order_id']);
	if($order->customer_email != $_REQUEST['email']) exit("Order Load failed");
}
else {
	$order->paypalIPN();
}
?>
<p>Your order ID is <?= $order->id ?> and we have your email address listed as  <?= $order->customer_email ?></p>
<p>Your payment status is : <?= $order->payment_status ?></p>
Items:
<ul>
<?
$line_item = new line_item();
$labels = array("-1");
$artists = array("-1");
$albums = array("-1");
$line_item->getList("where order_id=" . $order->id . " and type != ''");
while($line_item->getNext()) {
	$item = new $line_item->type();
	$item->get($line_item->item_id);
	?>
	<li><?= ucwords($line_item->type) ?> - <?= $item->name ?>
	<?
	if($line_item->type == "track") {
		$albums[] = $item->album_id;
		?><a href="<?= $CONF['media_url'] ?>/download.php?order_id=<?= $order->id ?>&amp;item_id=<?= $line_item->id ?>&amp;email=<?= urlencode($order->customer_email) ?>">Download</a><?php
	}
	elseif($line_item->type == "album") {
		$albums[] = $item->id;
		$artists[] = $item->artist_id;
		$labels[] = $item->label_id;
	}
	?>
	</li>
	<?php	
}
?>
</ul>
<p>&nbsp;</p>
<p>&nbsp;</p>

<?php
$album = new album();
$see_also_count = $album->getList("where id not in (".implode(",",$albums).") AND ((artist_id in (".implode(",",$artists).") OR (label_id in (".implode(",",$labels)."))))","order by rand()","limit 0,4");
if($see_also_count) {
	?>
	<h2>See also</h2>
	<p>If you like these, you might also want to check out these albums</p>
	<div id="album_list">
	<?
	while($album->getNext()) {
		$album->displayThumb();
	}
	?>
	</div>
	<?
}
?>
<?php
$basket = new basket();
$basket->clear();
?>
<?php include("footer.inc.php"); ?>

