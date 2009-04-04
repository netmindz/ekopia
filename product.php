<?php require("include/common.php"); ?>
<?php

$product = new product();
$product->get($_REQUEST['id']);

$type = new type();
$type->get($product->type_id);

$page_title = "inSpiral - $type->name -  $product->name";
$page_keywords = implode(", ",array($product->name,$type->name));
$page_meta = $product->intro;
?>
<?php include("header.inc.php"); ?>
<h1><?= $product->name ?> <?= $type->name ?></h1>

<?php  $image = new image(); $image->show($product->image_id); ?>
<p><?= $product->description ?></p>

<?php if($product->price) { ?>
                <form action="<?= $CONF['url'] ?>/basket.php" method="post">
                <input type="hidden" name="action" value="add" />
                <input type="hidden" name="product_id" value="<?= $product->id ?>" />
                &pound; <?= $product->price ?> <input type="submit" value="Add to basket" class="inputbox" />
                </form>
<? } ?>
<?php
$variation = new product_variation();
if($variation->getListForProduct($product->id)) { ?>
	<form action="<?= $CONF['url'] ?>/basket.php" method="post">
	<input type="hidden" name="action" value="add" />
	<select name="product_variation_id">
	<option value="">--select--</option>
	<?php
	while($variation->getNext()) {
		?><option value="<?= $variation->id ?>"><?= $variation->name ?>  - &pound; <?= $variation->price ?></option><?php 
	}
	?>
	<input type="submit" value="Add to basket" class="inputbox" />
	</form>
<?php } ?>

<p>&nbsp;</p>
<hr/>
<p><a href="type.php?id=<?= $type->id ?>">Back to <?= $type->name ?>s</a></p>

<?php include("footer.inc.php"); ?>

