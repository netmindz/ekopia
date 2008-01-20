<?php
require("include/common.php");
?>
<?php
$basket = new basket();
if(isset($_POST['album_id'])) {
#	print "add album";
	$basket->addItem("album",$_POST['album_id']);
}
if(isset($_POST['tracks'])) {
	foreach($_POST['tracks'] as $track_id=>$null){
		$basket->addItem("track",$track_id);
	}
}



if(isset($_REQUEST['remove_id'])) {
	$basket->removeItem($_REQUEST['remove_id']);
}

if(isset($_REQUEST['clear'])) {
	$basket->clear();
}

?>
<?php include("header.inc.php"); ?>

<?php
$items = $basket->getItems();
if(count($items)) { ?>
<table width="90%">
<tr>
	<th>Item</th>
	<th>Price</th>
	<th>&nbsp;</th>
</tr>
	<?php
	foreach($items as $id=>$details) {
		?>
		<tr>
			<td><?= $details['name'] ?></td>
			<td>&pound;<?= $details['value'] ?></td>
			<td><a href="basket.php?remove_id=<?= $id ?>">Remove</a></td>
		</tr>
		<?php
	}
	?>
</table>
<form method="POST">
<input type="hidden" name="clear" value="true">
<input type="submit" class="inputbox" value=" Clear Basket ">
</form>
<br>
<form name="_xclick" action="https://<?= $CONF['paypal_host'] ?>/uk/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_cart">
<input type="hidden" name="upload" value="1">
<input type="hidden" name="notify_url" value="<?= $CONF['url'] ?>/ipn.php">
<input type="hidden" name="return" value="<?= $CONF['url'] ?>/complete.php">
<input type="hidden" name="cancel_return" value="<?= $CONF['url'] ?>/basket.php">
<input type="hidden" name="business" value="<?= $CONF['paypal_address'] ?>">
<input type="hidden" name="currency_code" value="GBP">
<?php
	$i =0;
	foreach($items as $id=>$details) {
		$i++;
	?>
<input type="hidden" name="item_number_<?= $i ?>" value="<?= $id ?>">
<input type="hidden" name="item_name_<?= $i ?>" value="<?= $details['name'] ?>">
<input type="hidden" name="shipping_<?= $i ?>" value="1.00">
<input type="hidden" name="amount_<?= $i ?>" value="10.00">
	<?php
	}
?>
<input type="image" src="http://www.sandbox.paypal.com/en_US/i/btn/x-click-but01.gif" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">
</form>
<!--
<form action="" method="post">
<input type="submit" value=" Pay ">
-->
</form>
<?php } ?>
<? include("footer.inc.php"); ?>
