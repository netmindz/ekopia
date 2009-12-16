<?php
require("include/common.php");

$order = new order();
$order->get($_REQUEST['order_id']);

if($order->payment_status != "Completed") {
	exit("Payment not complete, please try later");
}

$li = new line_item();
$li->get($_REQUEST['item_id']);
if($li->order_id != $order->id) exit("Error");

if(ereg(' \(([a-z3]+)\)$',$li->item,$matches)) {
	$type = $matches[1];
}
else {
	exit("type unknown");
}

if($li->type == "track") {

	$track = new track();
	$track->get($li->item_id);
	$error = $track->downloadTrack($type);
	if($error) {
		?>
		<h2>Track ERROR</h2>
		<p><?= $error ?></p>
		<?php
	}
	else {
		ob_start();
		print_r($_SERVER);
		$message .= "\n\n" . ob_get_contents();
		ob_end_clean();
		mail($CONF['shop_email'],"Order $order->id - Track Download - $track->DN",$message);
	}
}
elseif($li->type == "album") {
	$album = new album();
	$album->get($li->item_id);
	if(!isset($_REQUEST['format'])) {
		$format = "mp3";
	}
	else {
		$format = $_REQUEST['format'];
	}
	$error = $album->downloadAlbum($format);
	if($error) {
		?>
		<h2>Album ERROR</h2>
		<p><?= $error ?></p>
		<?php
	}
	else {
		ob_start();
		print_r($_SERVER);
		$message .= "\n\n" . ob_get_contents();
		ob_end_clean();
		mail($CONF['shop_email'],"Order $order->id - Album Download - $album->DN",$message);
	}
	
}
?>
