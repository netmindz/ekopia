<?
require("order_template.php");

class order extends order_template {

	function paypalIPN()
	{
		global $CONF;
		$new_order = false;
		$payment_updated = false;
		if(isset($_REQUEST['parent_txn_id'])) {
			// refund
			$this->getByOther(array('paypal_txn_id'=>$_REQUEST['parent_txn_id']));
		}
		else {
			if(!$this->getByOther(array('paypal_txn_id'=>$_REQUEST['txn_id']))) {
				$this->paypal_txn_id = $_REQUEST['txn_id'];
				$this->add();
				$new_order = true;
			}
		}
		if($this->payment_status != $_REQUEST['payment_status']) $payment_updated = true;
		
		$this->customer_email = $_REQUEST['payer_email'];
		$this->payment_status = $_REQUEST['payment_status'];
		$this->update();

		$paypal = array();
		foreach($_REQUEST as $k=>$v) {
			if(ereg('mc_gross_([0-9]+)',$k,$matches)) {
				$paypal['item'][$matches[1]]['price'] = $v;
			}
			if(ereg('^(address)_(.+)',$k,$matches)) {
				$paypal[$matches[1]][$matches[2]] = $v;
			}
			if(ereg('^(item)_([a-z]+)([0-9]+)',$k,$matches)) {
				$paypal[$matches[1]][$matches[3]][$matches[2]] = $v;
			}
		}

		ob_start();
		print_r($paypal);
		$message = ob_get_contents();
		ob_end_clean();

		$item_list = "";
		foreach($paypal['item'] as $key=>$item) {
				$item_list .= $item['name'] . "\n";
				if($new_order) {
					$bi = new basket_item();
					$li = new line_item();
					if($bi->get($item['number'])) {
						if($bi->type == "album") {
							$album = new album();
							$album->get($bi->item_id);
							$album->setField("stock_count",($album->stock_count - 1));
						}
						//$li->create($this->id,$bi->type.":".$bi->item_id,$item['price']);
						$li->create($this->id,$item['name'],$item['price'],$bi->type,$bi->item_id,$bi->delivery);
						// $bi->delete($bi->id);
					}
					else {
						$li->create($this->id,$item['name'] . "[#".$item['number']."]",$item['price'],"unknown",0,"unknown");
					}
				}
		}
		$address = $paypal['address']['name']."\n".$paypal['address']['street']."\n".$paypal['address']['city']."\n".$paypal['address']['state']."\n".$paypal['address']['zip']."\n".$paypal['address']['country'];

		if($new_order) {	
			mail($CONF['shop_email'],"Shop Order : #$this->id","Payment Status: $this->payment_status\nItems:\n".$item_list."\n Address:\n" . $address . "\nDebug: $message","From: ".$CONF['shop_email']);
			mail($this->customer_email,"Order Confirmation #$this->id","Thankyou for you order from our online shop.\n\nPayment Status: $this->payment_status\n\nItems:\n" . $item_list . "\nAddress: " . $address ."\n\n".$CONF['url']."/complete.php?order_id=$this->id&email=".urlencode($this->customer_email),"From: ".$CONF['shop_email']."\nBcc: will@netmindz.net");
		}
		elseif($payment_updated) {
			mail($CONF['shop_email'],"Order Update : #$this->id","Payment Status: $this->payment_status");
		}

	}

}
?>
