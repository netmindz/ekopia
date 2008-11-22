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

	function addItem($type,$id,$delivery)
	{
		$item = new basket_item();
		$item->setproperties(array('basket_id'=>$this->id,'type'=>$type,'item_id'=>$id,'delivery'=>$delivery));
		$item->add();
	}

	function getItems()
	{
		$format_prices = array('ogg'=>0,'mp3'=>0,'flac'=>'0.2','wav'=>'0.5');
		$country_costs = array('uk'=>array('start'=>1.5,'inc'=>0.5),'eu'=>array('start'=>2,'inc'=>0.5),'row'=>array('start'=>2.5,'inc'=>0.5));
		$list = array();
		$item = new basket_item();
		$item->getList("where basket_id='$this->id'");
		$shipping_type = "start";
		while($item->getNext()) {
			$type = $item->type;
			$detail = new $type();
			$detail->get($item->item_id);

			$list[$item->id]['type'] = $item->type;
			if($type == "album") {
				$list[$item->id]['shipping'] = $country_costs[$_SESSION['country']][$shipping_type];
				$shipping_type = "inc";
			}
			else {
				$list[$item->id]['shipping'] = 0;
			}
			if(ereg("product",$item->type)) {
				$name = $detail->DN;
				if($item->type == "product_variation") {
					$product = new product();
					$product->get($detail->id);
					if($product->image_id) $list[$item->id]['image_id'] = $product->image_id;
				}
			}
			else {
				$name = ucwords($item->type) . ": " . $detail->DN;
			}
			$list[$item->id]['name'] = $name;
			$list[$item->id]['value'] = $detail->price;
			if($type == "track") {
				$list[$item->id]['name'] .= " (" . $_SESSION['format'] . ")";
				$list[$item->id]['value'] += $format_prices[$_SESSION['format']];	
			}
			else {
				if(property_exists($detail,"image_id")&&($detail->image_id)) $list[$item->id]['image_id'] = $detail->image_id;
				if($item->delivery) {
					$list[$item->id]['name'] .= " (" . $item->delivery . ")";
				}
			}
		}
		return($list);
	}

	function removeItem($id)
	{
		$item = new basket_item();
		return($item->delete($id));
	}

	function clear()
	{
		$items = $this->getItems();
		foreach(array_keys($items) as $item_id) {
			$item =  new basket_item();
			$item->delete($item_id);
		}
	#	$this->delete($this->id);
	}
}
?>
