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

if(ereg(' \(([a-z]+)\)$',$li->item,$matches)) {
	$type = $matches[1];
}
else {
	exit("type unknown");
}

$track = new track();
$track->get($li->item_id);
$error = $track->getDownload($type);
if($error) {
	?>
	<h2>ERROR</h2>
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
?>
