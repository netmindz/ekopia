<?
require("line_item_template.php");

class line_item extends line_item_template {

	function create($order_id,$item,$price,$type,$item_id,$delivery)
	{
		$this->setProperties(array('order_id'=>$order_id,'item'=>$item,'price'=>$price,'type'=>$type,'item_id'=>$item_id,'delivery'=>$delivery),"addslashes");
		return($this->add());
	}

}
?>
