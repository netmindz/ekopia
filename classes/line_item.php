<?
require("line_item_template.php");

class line_item extends line_item_template {

	function create($order_id,$item,$price)
	{
		$this->setProperties(array('order_id'=>$order_id,'item'=>$item,'price'=>$price),"addslashes");
		return($this->add());
	}

}
?>
