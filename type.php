<?php require("include/common.php"); ?>
<?php include("header.inc.php"); ?>
<?php
$type = new type();
if(isset($_REQUEST['id'])) {
	$type->get($_REQUEST['id']);
	?>
	<h1><?= $type->name ?> Products</h1>
	<?
	$product = new product();
	$product->getList("where type_id=$type->id");
	while($product->getNext()) {
		$product->displayThumb();
	}
	?>
	<p><a href="type.php">Back to Products</a></p>
	<?
}
else {
	$type->getList();
	?>
	<h1>Products</h1>
	<?
	while($type->getNext()) { ?>
	<a href="type.php?id=<?= $type->id ?>"><?= $type->name ?></a>
	<?
	}
}
?>
<?php include("footer.inc.php"); ?>
