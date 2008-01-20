<?php include("include/common.php"); ?>
<?php include("header.inc.php"); ?>
<?php
$basket = new basket();
$basket->clear();
?>
<h1>Thankyou</h1>
Thankyou for your order from the shop. You should get an email shortly confirming your order
<?php
$order = new order();
$order->paypalIPN();
?>
<p>Your order ID is <?= $order->id ?> and we have your email address listed as  <?= $order->customer_email ?></p>
<p>Your payment status is : <?= $order->payment_status ?></p>
<?php include("footer.inc.php"); ?>

