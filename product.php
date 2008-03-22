<?php require("include/common.php"); ?>
<?php

$product = new product();

$page_title = $product->name;
$page_keywords = implode(", ",array($product->name));
?>
<?php include("header.inc.php"); ?>
<?php include("footer.inc.php"); ?>

