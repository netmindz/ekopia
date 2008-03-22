<?php require("include/common.php"); ?>
<?php include("header.inc.php"); ?>
<?php
$type = new type();
if(isset($_REQUEST['id'])) {
	$type->get($_REQUEST['id']);
	$product = new product();
	$product->getList("where type_id=$type->id");
	while($product->getNext()) {
		$product->displayThumb();
	}
}
else {
	$type->getList();
	while($type->getNext()) { ?>
	<a href="type.php?id=<?= $type->id ?>"><?= $type->name ?></a>
	<?
	}
}
?>
<?php include("footer.inc.php"); ?>
