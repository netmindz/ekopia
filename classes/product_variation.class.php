<?
require("product_variation_template.php");

class product_variation extends product_variation_template {

	function getListForProduct($product_id)
	{
		settype($product_id,"int");
		return($this->getList("where product_id=$product_id"));
	}		

}
?>
