<?
require("product_template.php");

class product extends product_template {

        function displayThumb()
        {
                global $CONF;
                 ?>
                <div class="product_thumb">
                <div class="product_thumb_image">
                <a href="<?= $CONF['url'] ?>/product.php?id=<?= $this->id ?>"><?php
                $image = new image();
                $image->show($this->image_id,100,100,"alt=\"$this->name\" title=\"Click to view $this->name\"");
                ?></a>
                </div>
                <a href="<?= $CONF['url'] ?>/product.php?id=<?= $this->id ?>"><?= $this->name ?></a><br/>
		<?= $this->intro ?>
                <?php if($this->price) { ?>
                <form action="<?= $CONF['url'] ?>/basket.php" method="post">
                <input type="hidden" name="action" value="add" />
                <input type="hidden" name="product_id" value="<?= $this->id ?>" />
                &pound; <?= $this->price ?> <input type="submit" value="Add to basket" class="inputbox" />
                </form>
                <?php } else { ?>
                Coming soon to buy here
                <?php } ?>
                </div>
                <?
        }
		

}
?>
