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
<table>
<?php
ini_set("display_errors","on");
$type = new type();
$type->getWholesaleList();
while($type->getNext()) {
	?>
	<tr>
		<th><?= $type->name ?></th>
		<th>Qty</th>
	</tr>
	<?php
	$product = new product();
	$product->getTypeList($type);
	while($product->getNext()) {
		if($product->price) {
			?>
			<tr>
				<td><?= $product->name ?></td>
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
					<td><?= $product->name ?> - <?= $varient->name ?></td>
					<td><input type="text" size="5" name="product_variations[<?= $varient->id ?>]"/></td>
				</tr>
				<?php
			}
		}
	}
} 
?>
<tr>
	<td colspan="2" align="right"><input type="submit" value=" Add to Basket "/></td>
</tr>
</table>
<?php include("footer.inc.php"); ?>

