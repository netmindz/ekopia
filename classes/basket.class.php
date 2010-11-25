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

	function addItem($type,$id,$delivery,$qty=1)
	{
		$item = new basket_item();
		$props = array('basket_id'=>$this->id,'type'=>$type,'item_id'=>$id,'delivery'=>$delivery);
		if($item->getByOther($props)) {
			$item->quantity = $item->quantity + $qty;
			$item->update();
		}
		else {
			$props['quantity'] = $qty;
			$item->setproperties($props);
			$item->add();
		}
	}

	function getItems()
	{
		$format_prices = array('ogg'=>0,'mp3'=>0,'flac'=>'0.50','wav'=>'0.6');
		$format_album_prices = array('ogg'=>0,'mp3'=>0,'flac'=>'3','wav'=>'6');
//		$country_costs = array('uk'=>array('start'=>1.5,'inc'=>0.5),'eu'=>array('start'=>2,'inc'=>0.5),'row'=>array('start'=>2.5,'inc'=>0.5));
		$list = array();
		$item = new basket_item();
		$item->getList("where basket_id='$this->id'");
		$shipping_type = "start";
		$total_weight = 0;
		$total_packing = 0;
		while($item->getNext()) {
			$type = $item->type;
			$detail = new $type();
			$detail->get($item->item_id);

			$list[$item->id]['type'] = $item->type;
			if($type == "album") {
				$list[$item->id]['delivery'] = $item->delivery;
				if($item->delivery == "download") {
					$list[$item->id]['value'] = $detail->download_price;
					$list[$item->id]['shipping'] = 0;
				}
				else {	
					$total_weight += 100;
#					$list[$item->id]['shipping'] = $country_costs[$_SESSION['country']][$shipping_type];
					$total_packing += 0.10;
					$shipping_type = "inc";
				}
			}
			else {
				$list[$item->id]['shipping'] = 0;
			}
			if(ereg("product",$item->type)) {
				$name = $detail->DN;
				if($item->type == "product_variation") {
					$varient = new product_variation();
					$varient->get($detail->id);
					$product = new product();
					$product->get($varient->product_id);
					if($product->image_id) $list[$item->id]['image_id'] = $product->image_id;
					if($varient->weight) {
						$total_weight += $varient->weight;
					}
					else {
						$total_weight += $product->shipping_weight;
					}
				}
				else {
					if($detail->shipping_weight) $total_weight += $detail->shipping_weight;
				}
				$list[$item->id]['quantity'] = $item->quantity;
			}
			else {
				$name = ucwords($item->type) . ": " . $detail->DN;
			}
			$list[$item->id]['name'] = $name;

			if(!isset($list[$item->id]['value'])) {
				$list[$item->id]['value'] = $detail->price * $item->quantity;
			}
			
			if($type == "track") {
				$list[$item->id]['name'] .= " (" . $_SESSION['format'] . ")";
				$list[$item->id]['value'] += $format_prices[$_SESSION['format']];	
			}
			elseif($type == "album" && $item->delivery == "download") {
				$list[$item->id]['name'] .= " (" . $_SESSION['format'] . ")";
				$list[$item->id]['value'] += $format_album_prices[$_SESSION['format']];	
			}
			else {
				if($item->delivery) {
					$list[$item->id]['name'] .= " (" . $item->delivery . ")";
				}
			}
			if(property_exists($detail,"image_id")&&($detail->image_id)) $list[$item->id]['image_id'] = $detail->image_id;
		}
		if($total_weight || $total_packing) {
			$shipping = round($this->calculatePostage($total_weight,$_SESSION['country']) * 1.3,2);
			$list['packing']['name'] = "Packaging";
			$list['packing']['value'] = $total_packing;
 			$list['packing']['shipping'] = $shipping;
		}
		return($list);
	}

	function calculatePostage($total_weight,$region)
	{
		$shipping_price = 0;
		$bands = array(
		'uk'=>array(0=>1.14,250=>1.45,500=>1.94,750=>2.51,1000=>3.08,1250=>4.3,1500=>5,1750=>5.7,2000=>6.4,4000=>8.22),
		'eu'=>array(10=>1.24,20=>1.24,40=>1.24,60=>1.24,80=>1.24,100=>1.24,120=>1.36,140=>1.50,160=>1.63,180=>1.77,200=>1.90,220=>2.03,240=>2.15,260=>2.28,280=>2.39,300=>2.51,320=>2.62,340=>2.73,360=>2.84,380=>2.95,400=>3.06,420=>3.17,440=>3.28,460=>3.39,480=>3.50,500=>3.61,520=>3.71,540=>3.81,560=>3.91,580=>4.01,600=>4.11,620=>4.21,640=>4.31,660=>4.41,680=>4.51,700=>4.61,720=>4.71,740=>4.81,760=>4.91,780=>5.01,800=>5.11,820=>5.21,840=>5.31,860=>5.41,880=>5.51,900=>5.61,920=>5.71,940=>5.81,960=>5.91,980=>6.01,1000=>6.11,1020=>6.21,1040=>6.31,1060=>6.41,1080=>6.51,1100=>6.61,1120=>6.71,1140=>6.81,1160=>6.91,1180=>7.01,1200=>7.11,1220=>7.21,1240=>7.31,1260=>7.41,1280=>7.51,1300=>7.61,1320=>7.71,1340=>7.81,1360=>7.91,1380=>8.01,1400=>8.11,1420=>8.21,1440=>8.31,1460=>8.41,1480=>8.51,1500=>8.61,1520=>8.71,1540=>8.81,1560=>8.91,1580=>9.01,1600=>9.11,1620=>9.21,1640=>9.31,1660=>9.41,1680=>9.51,1700=>9.61,1720=>9.71,1740=>9.81,1760=>9.91,1780=>10.01,1800=>10.11,1820=>10.21,1840=>10.31,1860=>10.41,1880=>10.51,1900=>10.61,1920=>10.71,1940=>10.81,1960=>10.91,1980=>11.01,2000=>11.11),
		'row'=>array(10=>1.64,20=>1.64,40=>1.64,60=>1.64,80=>1.64,100=>1.64,120=>1.87,140=>2.10,160=>2.33,180=>2.56,200=>2.80,220=>3.01,240=>3.22,260=>3.43,280=>3.65,300=>3.87,320=>4.09,340=>4.31,360=>4.53,380=>4.75,400=>4.97,420=>5.19,440=>5.41,460=>5.63,480=>5.85,500=>6.07,520=>6.27,540=>6.47,560=>6.67,580=>6.87,600=>7.07,620=>7.27,640=>7.47,660=>7.67,680=>7.87,700=>8.07,720=>8.27,740=>8.47,760=>8.67,780=>8.87,800=>9.07,820=>9.27,840=>9.47,860=>9.67,880=>9.87,900=>10.07,920=>10.27,940=>10.47,960=>10.67,980=>10.87,1000=>11.07,1020=>11.27,1040=>11.47,1060=>11.67,1080=>11.87,1100=>12.07,1120=>12.27,1140=>12.47,1160=>12.67,1180=>12.87,1200=>13.07,1220=>13.27,1240=>13.47,1260=>13.67,1280=>13.87,1300=>14.07,1320=>14.27,1340=>14.47,1360=>14.67,1380=>14.87,1400=>15.07,1420=>15.27,1440=>15.47,1460=>15.67,1480=>15.87,1500=>16.07,1520=>16.27,1540=>16.47,1560=>16.67,1580=>16.87,1600=>17.07,1620=>17.27,1640=>17.47,1660=>17.67,1680=>17.87,1700=>18.07,1720=>18.27,1740=>18.47,1760=>18.67,1780=>18.87,1800=>19.07,1820=>19.27,1840=>19.47,1860=>19.67,1880=>19.87,1900=>20.07,1920=>20.27,1940=>20.47,1960=>20.67,1980=>20.87,2000=>21.07)
		);
		foreach($bands[$region] as $weight=>$price) {
			if($total_weight >= $weight) {
				$shipping_price = $price;
			}
			else {
				#break;
			}
		}
		/*	
		if($total_weight >= $weight) {
			if($region == "uk") {
				$shipping_price += (ceil(($total_weight - $weight)/2000) * 2.8); // add £2.80 for each additional 2kg or part thereof 
			}
		}
		*/
		return($shipping_price);
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
