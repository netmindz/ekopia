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

if(!isset($_SESSION['format'])) $_SESSION['format'] = "mp3";
if(isset($_POST['format'])) $_SESSION['format'] = $_POST['format'];

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
<table width="90%" border=0>
<tr>
	<th>Item</th>
	<th>Price</th>
	<th>&nbsp;</th>
</tr>
	<?php
	$shipping = 0;
	$total = 0;
	$basket_has_downloads = false;
	foreach($items as $id=>$details) {
		$total += $details['value'];
		$total += $details['shipping'];
		if($details['type'] == "track") $basket_has_downloads = true;
		?>
		<tr>
			<td><?= $details['name'] ?></td>
			<td>&pound;<?= $details['value'] ?></td>
			<td><a href="basket.php?remove_id=<?= $id ?>">Remove</a></td>
		</tr>
		<?php
	}
	?>
<tr>
	<th align="right">Sub Total:</th>
        <th>&pound; <?= $total ?></th>
        <th rowspan="3"><form method="POST"><input type="hidden" name="clear" value="true"><input type="submit" class="inputbox" value=" Clear Basket "></form></th>
</tr>
<tr>
	<th align="right">Shipping Total:</th>
        <th>&pound; <?= $shipping ?></th>
        <th>&nbsp;</th>
</tr>
<tr>
	<th align="right">Total:</th>
        <th>&pound; <?= ($shipping + $total) ?></th>
        <th>&nbsp;</th>
</tr>
</table>
</form>
<?php
if($basket_has_downloads) { ?>
<p>Please select the download format for the tracks</p>
<form method="POST" name="format">
<select name="format" onChange="document.forms.format.submit()">
<option value="mp3" <? if($_SESSION['format'] == "mp3") print "selected"; ?>>MP3</option>
<option value="ogg" <? if($_SESSION['format'] == "ogg") print "selected"; ?>>Ogg Vorbis</option>
<option value="flac" <? if($_SESSION['format'] == "flac") print "selected"; ?>>Flac</option>
<option value="wav" <? if($_SESSION['format'] == "wav") print "selected"; ?>>Wave</option>
</select>
<input type="submit" value=" Change Format " class="inputbox">
</form>
<? } ?>
<br/>
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
<input type="hidden" name="shipping_<?= $i ?>" value="<?= $details['shipping'] ?>">
<input type="hidden" name="amount_<?= $i ?>" value="<?= $details['value'] ?>">
	<?php
	}
?>
<input type="image" src="http://<?= $CONF['paypal_host'] ?>/en_US/i/btn/x-click-but01.gif" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">
</form>
<!--
<form action="" method="post">
<input type="submit" value=" Pay ">
-->
</form>
<?php } ?>
<? include("footer.inc.php"); ?>
