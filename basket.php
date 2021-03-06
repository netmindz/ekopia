<?php
require("include/common.php");
?>
<?php
$basket = new basket();
if(isset($_POST['album_id'])) {
#	print "add album";
	$basket->addItem("album",$_POST['album_id'],$_POST['delivery']);
}
if(isset($_POST['product_id'])) {
	$basket->addItem("product",$_POST['product_id'],"");
}
if(isset($_POST['product_variation_id'])) {
	$basket->addItem("product_variation",$_POST['product_variation_id'],"");
}
if(isset($_POST['tracks'])) {
	foreach($_POST['tracks'] as $track_id=>$null){
		$basket->addItem("track",$track_id,"download");
	}
}

if(isset($_POST['products'])) {
	foreach($_POST['products'] as $pid=>$qty) {
		if($qty) $basket->addItem("product",$pid,"",$qty);
	}
}

if(isset($_POST['product_variations'])) {
	foreach($_POST['product_variations'] as $pid=>$qty) {
		if($qty) $basket->addItem("product_variation",$pid,"",$qty);
	}
}

if(!isset($_SESSION['format'])) $_SESSION['format'] = "mp3";
if(isset($_POST['format'])) $_SESSION['format'] = $_POST['format'];

$default_country = "row";
if(isset($_SERVER['GEOIP_CONTINENT_CODE'])&&$_SERVER['GEOIP_CONTINENT_CODE'] == "EU") $default_country = "eu";
if(isset($_SERVER['GEOIP_COUNTRY_CODE'])&&$_SERVER['GEOIP_COUNTRY_CODE'] == "GB") $default_country = "uk";
if(!isset($_SESSION['country'])) $_SESSION['country'] = $default_country;

if(isset($_POST['country'])) $_SESSION['country'] = $_POST['country'];


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
<h2>Basket</h2>
<table width="100%" border="0" id="basket">
<tr>
	<th colspan="2">Item</th>
	<th>Quantity</th>
	<th>Price</th>
	<td>&nbsp;</td>
</tr>
	<?php
	$shipping = 0;
	$total = 0;
	$basket_has_downloads = false;
	foreach($items as $id=>$details) {
		$total += $details['value'];
		if($id != "packing") {
			$shipping += $details['shipping'];
			if($details['type'] == "track") $basket_has_downloads = true;
			if($details['type'] == "album" && $details['delivery'] == "download") $basket_has_downloads = true;
			?>
			<tr valign="middle">
				<td><? if(isset($details['image_id'])) { $image = new image(); $image->show($details['image_id'],50,50,"align=\"left\""); } ?></td>
				<td><?= $details['name'] ?></td>
				<td><?php if(isset($details['quantity'])) { ?><?= $details['quantity'] ?><?php } else {  ?>1<?php } ?></td>
				<td align="center">&pound;<?= format_price($details['value']) ?></td>
				<td align="center"><a href="basket.php?remove_id=<?= $id ?>">Remove</a></td>
			</tr>
			<?php
		}
		else {
		/*
		 ?>
			<tr valign="middle">
				<td>&nbsp;</td>
                                <td><?= $details['name'] ?></td>
                                <td align="center">&pound;<?= format_price($details['value']) ?></td>
                                <td>&nbsp;</td>
                        </tr>
			<?
		*/
			$shipping += $details['shipping'];
		}
	}
	?>
<tr>
	<th colspan="3" align="right">Sub Total:</th>
        <th>&pound; <?= format_price($total) ?></th>
        <td rowspan="3" align="center"><form method="POST"><input type="hidden" name="clear" value="true"><input type="submit" class="inputbox" value=" Clear Basket "></form></td>
</tr>
<tr>
	<th colspan="3" align="right">Shipping Total:</th>
        <th>&pound; <?= format_price($shipping) ?></th>
</tr>
<tr>
	<th colspan="3" align="right">Total:</th>
        <th>&pound; <?= format_price($shipping + $total) ?></th>
</tr>
</table>
</form>
<?php
if($basket_has_downloads) { ?>
<h2>Download Format</h2>
<p>Please select the download format for the tracks</p>
<form method="POST" name="format">
<select name="format" onChange="document.forms.format.submit()">
<option value="mp3" <? if($_SESSION['format'] == "mp3") print "selected"; ?>>MP3 (192k)</option>
<option value="ogg" <? if($_SESSION['format'] == "ogg") print "selected"; ?>>Ogg Vorbis (Q7)</option>
<option value="flac" <? if($_SESSION['format'] == "flac") print "selected"; ?>>Flac (lossless)</option>
<option value="wav" <? if($_SESSION['format'] == "wav") print "selected"; ?>>Wave</option>
</select>
<input type="submit" value=" Change Format " class="inputbox">
</form>
<p>
Our MP3s are higher than the standard 128k sold by many online stores and are compatibile with almost all music players and all iPods. Our OggVorbis files are encoded with a Quality of 7 for suprior playback on supported devices. Flac is a lossless format that gives the exact same output as a pysical CD
</p>
<? } ?>
<?php if($shipping) { ?>
<h2>Shipping Region</h2>
<form method="POST" name="country">
<select name="country" onChange="document.forms.country.submit()">
<option value="uk" <? if($_SESSION['country'] == "uk") print "selected"; ?>>UK</option>
<option value="eu" <? if($_SESSION['country'] == "eu") print "selected"; ?>>Europe</option>
<option value="row" <? if($_SESSION['country'] == "row") print "selected"; ?>>Rest of world</option>
</select>
<input type="submit" value=" Change Shipping " class="inputbox">
</form>
<?php } ?>
<br/>
<h2>Go to secure paypal and card payment checkout</h2>
<form name="_xclick" action="https://<?= $CONF['paypal_host'] ?>/uk/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_cart">
<input type="hidden" name="_cart" value="upload">
<input type="hidden" name="upload" value="1">
<input type="hidden" name="notify_url" value="<?= $CONF['url'] ?>/ipn.php">
<input type="hidden" name="return" value="<?= $CONF['url'] ?>/complete.php">
<input type="hidden" name="rm" value="2">
<input type="hidden" name="cancel_return" value="<?= $CONF['url'] ?>/basket.php">
<input type="hidden" name="shopping_url" value="<?= $CONF['url'] ?>/basket.php">
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
<input type="hidden" name="amount_<?= $i ?>" value="<?= $details['item_value'] ?>">
<?php if(isset($details['quantity'])&&$details['quantity']) { ?>
<input type="hidden" name="quantity_<?= $i ?>" value="<?= $details['quantity'] ?>">
<?php } ?>
	<?php
	}
?>


<div align="right" style="margin-right: 20px">
Click to proceed : <input type="image" src="https://www.paypal.com/en_GB/i/bnr/vertical_solution_PP.gif" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">
</div>
</form>
<br/>
<br>
<!--
<form action="" method="post">
<input type="submit" value=" Pay ">
-->
</form>
<?php } else { ?>
<h2>Basket Empty</h2>
<?php } ?>
<? include("footer.inc.php"); ?>
