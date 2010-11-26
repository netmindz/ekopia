<?php
require("../include/site_config.inc.php");
$is_admin_area = true;
require("../include/common.php");

header("Content-Type: text/plain");
/*
header("Content-Type: text/csv");
header("Content-Disposition: attachment;filename=pos-export-orders.csv");
*/

$order = new order();
$order->getList();
while($order->getNext()) {
	$item = new line_item();
	$item->getOrderList($order);
	$customer = $order->getCustomer();
	while($item->getNext()) {
		if($item->type == "product") {
			$line = array();
			$line[] = $order->id; // ORDERREF
			$line[] = $order->created; // DATE_TIME
			$line[] =  "WEB"; // SOURCE
			$line[] =  $customer->id; // CUSTOMER_NUMBER
			$line[] =  "NEW"; // CUSTOMER_TYPE
			$line[] =  $customer->title; // TITLE
			$line[] =  $customer->first_name; // FIRST_NAME
			$line[] =  $customer->last_name; // SURNAME
			$line[] =  $customer->address1; // ADDRESS_1
			$line[] =  $customer->address2; // ADDRESS_2
			$line[] =  $customer->city; // CITY
			$line[] =  $customer->county; // COUNTY
			$line[] =  $customer->postcode; // POSTCODE
			$line[] =  $customer->country; // COUNTRY
			$line[] =  $customer->phone; // PHONE
			$line[] =  $customer->email; // EMAIL
			$line[] =  "N"; // ACCEPT_EMAIL
			$line[] =  ""; // ALTERNATE_CUSTOMER_NAME
			$line[] =  ""; // SHIP_ADDRESS_1
			$line[] =  ""; // SHIP_ADDRESS_2
			$line[] =  ""; // SHIP_CITY
			$line[] =  ""; // SHIP_COUNTY
			$line[] =  ""; // SHIP_POSTCODE
			$line[] =  ""; // SHIP_COUNTRY
			$line[] =  $item->item_id; // ITEMNUMBER 
			$line[] =  $item->item; // DESCRIPTION
			$line[] =  $item->item; // LONG_DESCRIPTION
			$line[] =  $item->price; // SELL_PRICE
			$line[] =  "0"; // SHIP_FEE
			$line[] = $item->quantity; // QTY
			$line[] =  "0"; // COLLECTION
			print '"' . implode('","', $line) . '"' . "\r\n";
		}
	}
}

?>
