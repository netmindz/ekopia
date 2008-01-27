<?php

if(ereg('~',$_SERVER['PHP_SELF'])) {
	$docroot="/home/will/public_html/id";
	$CONF['url'] = "http://wjtvaio.netmindz.net/~will/id";
	$CONF['paypal_address'] = 'seller_1197046991_biz@netmindz.net';
	$CONF['paypal_host'] = 'www.sandbox.paypal.com';
	$CONF['shop_email'] = "will@netmindz.net";
}
else {
	$docroot=$_SERVER['DOCUMENT_ROOT'];
	$CONF['url'] = "http://shop.ralf.netmindz.net";
	$CONF['paypal_address'] = 'shop@inspiralled.net';
	$CONF['paypal_host'] = 'www.paypal.com';
	$CONF['shop_email'] = "shop@inspiralled.net";
	
}
ini_set("include_path",".:$docroot/includes:$docroot/classes:" . ini_get("include_path"));

$CONF['artist']['order'] = "order by name";
$CONF['type']['order'] = "order by name";
$CONF['track']['order'] = "order by album_id,track_number,name";
$CONF['album']['order'] = "order by name,release_year";
$CONF['album']['DN'] = '<?php if($this->release_year) { $this->DN = $this->name . " (" . $this->release_year . ")"; } else { $this->DN = $this->name; } ?>';

$CONF['db_name'] = "idspiral_shop";
$CONF['db_username'] = "idspiral_shop";
$CONF['db_pass'] = "idspiral_shoppass";
$CONF['db_sys_admin'] = "will@netmindz.net";


?>
