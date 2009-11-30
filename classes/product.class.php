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
		$image_id = $this->image_id;
                $image = new image();
		if($this->image_id_thumb) {
			$image_id = $this->image_id_thumb;
		}
	        $image->show($image_id,100,0,"alt=\"$this->name\" title=\"Click to view $this->name\"");
                ?></a>
                </div>
                <a href="<?= $CONF['url'] ?>/product.php?id=<?= $this->id ?>"><?= $this->name ?></a><br/>
		<?= substr($this->intro,0,80) ?>
                <?php if($this->price) { ?>
                <form action="<?= $CONF['url'] ?>/basket.php" method="post">
                <input type="hidden" name="action" value="add" />
                <input type="hidden" name="product_id" value="<?= $this->id ?>" />
                &pound; <?= format_price($this->price) ?> <input type="submit" value="Add to basket" class="inputbox" />
                </form>
                <?php } else { ?>
                <!-- Coming soon to buy here -->
                <?php } ?>
                </div>
                <?
        }
		

	function getTypeList(type $type, $order="")
	{
		return($this->getList("where type_id=" . $type->id . ' and published="yes"',$order));
	}
}
?>
