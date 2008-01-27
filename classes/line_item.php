<?
require("line_item_template.php");

class line_item extends line_item_template {

	function create($item,$price)
	{
		$this->setProperties(array('item'=>$item,'price'=>$price),"addslashes");
		return($this->add());
	}

}
?>
