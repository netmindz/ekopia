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

<?php if($product->price) { ?>
                <form action="<?= $CONF['url'] ?>/basket.php" method="post">
                <input type="hidden" name="action" value="add" />
                <input type="hidden" name="product_id" value="<?= $product->id ?>" />
                &pound; <?= $product->price ?> <input type="submit" value="Add to basket" class="inputbox" />
                </form>
<? } ?>

<p><a href="type.php?id=<?= $type->id ?>">Back to <?= $type->name ?>s</a></p>

<?php include("footer.inc.php"); ?>

