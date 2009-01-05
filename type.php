<?php require("include/common.php"); ?>
<?php
$page_title="@page_title@";
$page_keywords="@page_keywords@";
$keywords = array();
ob_start();
?>
<?php include("header.inc.php"); ?>
<?php
$type = new type();
if(isset($_REQUEST['id'])) {
	$type->get($_REQUEST['id']);
	$page_title =  $type->name . " Products";
	$keywords[] = $type->name;
	?>
	<h1><?= $type->name ?> Products</h1>
	<?= $type->description ?>
	<?
	$product = new product();
	$product->getList("where type_id=$type->id");
	while($product->getNext()) {
		$keywords[] = $product->DN;
		$product->displayThumb();
	}
	?>
	<br clear="all"/>
	<p><a href="type.php">Back to Products</a></p>
	<?
}
else {
	$type->getList();
	$page_title = "Products"
	?>
	<h1>Products</h1>
	<ul>
	<?
	while($type->getNext()) {
		$keywords[] = $type->name;
		?>
		<li><a href="type.php?id=<?= $type->id ?>"><?= $type->name ?></li>
	<?
	}
	?>
	</ul>
	<?php
	
}
?>
<?php

$page = ob_get_contents();
ob_end_clean();
$page = str_replace("@page_title@",$page_title,$page);
$page = str_replace("@page_keywords@",implode(", ",$keywords),$page);
print $page;

?>
<?php include("footer.inc.php"); ?>
