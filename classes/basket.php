<?
require("basket_template.php");

class basket extends basket_template {

	function basket()
	{
		$this->basket_template();
		if(isset($_SESSION['basket_ref'])) {
			$this->basket_ref = $_SESSION['basket_ref'];
		}
		else {
			$this->basket_ref = time();
			@session_start();
			$_SESSION['basket_ref'] = $this->basket_ref;
		}
		if(!$this->getByOther(array('basket_ref'=>$this->basket_ref))) $this->add();
	}		

	function addItem($type,$id)
	{
		$item = new basket_item();
		$item->setproperties(array('basket_id'=>$this->id,'type'=>$type,'item_id'=>$id));
		$item->add();
	}

	function getItems()
	{
		$list = array();
		$item = new basket_item();
		$item->getList("where basket_id='$this->id'");
		while($item->getNext()) {
			$type = $item->type;
			$detail = new $type();
			$detail->get($item->item_id);

			$list[$item->id]['name'] = $detail->DN;
		}
		return($list);
	}

	function removeItem($id)
	{
		$item = new basket_item();
		return($item->delete($id));
	}
}
?>
