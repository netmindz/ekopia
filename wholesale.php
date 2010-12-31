<?php
if ((!isset($_SERVER['PHP_AUTH_USER']))||($_SERVER['PHP_AUTH_USER'] != "wholesale")||($_SERVER['PHP_AUTH_PW'] != "yummycakes")) {
    header('WWW-Authenticate: Basic realm="wholesale"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'This page is for registered wholesale customers only';
    exit;
}
?>
<?php include("include/common.php"); ?>
<?php include("header.inc.php"); ?>
<h2>Wholesale Order</h2>
<form action="basket.php" method="post">
<table width="100%">
<?php
ini_set("display_errors","on");
$type = new type();
$type->getWholesaleList();
while($type->getNext()) {
	?>
	<tr>
		<th>Code</th>
		<th><?= $type->name ?></th>
		<th>Unit</th>
		<th>Ex VAT</th>
		<th>Price</th>
		<th>Qty</th>
	</tr>
	<?php
	$product = new product();
	$product->getTypeList($type);
	while($product->getNext()) {
		if($product->price) {
			?>
			<tr>
				<td><?= $product->code ?></td>
				<td><?= $product->name ?></td>
				<td><?= $product->unit ?></td>
				<td><?php if($product->vat_exempt == 'no') print format_price(round($product->price / (1 + VAT_RATE),2)); ?></td>
				<td><?= format_price($product->price) ?></td>
				<td><input type="text" size="5" name="products[<?= $product->id ?>]"/></td>
			</tr>
			<?php
		}
		$varient = new product_variation();
		$varient->getProductList($product);
		while($varient->getNext()) {
			if($varient->price) {
				?>
				<tr>
					<td><?= $product->code ?></td>
					<td><?= $product->name ?> - <?= $varient->name ?></td>
					<td><?= $product->unit ?></td>
					<td><?php if($product->vat_exempt == 'no') print format_price(round($product->price / (1 + VAT_RATE),2)); ?></td>
					<td><?= format_price($varient->price) ?></td>
					<td><input type="text" size="5" name="product_variations[<?= $varient->id ?>]"/></td>
				</tr>
				<?php
			}
		}
	}
} 
?>
<tr>
	<td colspan="6" align="right"><input type="submit" value=" Add to Basket "/></td>
</tr>
</table>
<?php include("footer.inc.php"); ?>

