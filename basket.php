<?php
require("include/common.php");
?>
<?php include("header.inc.php"); ?>
<?php
$basket = new basket();
if(isset($_POST['album_id'])) {
	print "add album";
	$basket->addItem("album",$_POST['album_id']);
}

if(isset($_REQUEST['remove_id'])) {
	$basket->removeItem($_REQUEST['remove_id']);
}

?>

<?php
$items = $basket->getItems();
if(count($items)) { ?>
<table>
<tr>
	<th>Remove</th>
	<th>Item</th>
</tr>
	<?php
	foreach($items as $id=>$details) {
		?>
		<tr>
			<td><a href="basket.php?remove_id=<?= $id ?>">Remove</a></td>
			<td><?= $details['name'] ?></td>
		</tr>
		<?php
	}
	?>
</table>
<a href="checkout.php"><img src="https://www.paypal.com/en_GB/i/btn/btn_xpressCheckout.gif" align="left" style="margin-right:7px;"></a>
<!--
<form action="" method="post">
<input type="hidden" name="notify_url" value="http://shop.ekopia.net/ipn.php">
<input type="submit" value=" Pay ">
-->
</form>
<?php } ?>
<? include("footer.inc.php"); ?>
