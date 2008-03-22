<?php require("include/common.php"); ?>
<?php

$product = new product();
$product->get($_REQUEST['id']);

$type = new type();
$type->get($product->type_id);

$page_title = $product->name;
$page_keywords = implode(", ",array($product->name,$type->name));
?>
<?php include("header.inc.php"); ?>
<h1><?= $product->name ?></h1>
<p><a href="type.php?id=<?= $type->id ?>">Back to <?= $type->name ?>s</a></p>
<?php include("footer.inc.php"); ?>

