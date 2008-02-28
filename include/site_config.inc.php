<?php

if(ereg('~',$_SERVER['PHP_SELF'])||(isset($_SERVER['HOSTNAME']))) {
	$docroot="/home/will/public_html/id";
	$CONF['url'] = "http://wjtvaio.netmindz.net/~will/id";
	$CONF['paypal_address'] = 'seller_1197046991_biz@netmindz.net';
	$CONF['paypal_host'] = 'www.sandbox.paypal.com';
	$CONF['shop_email'] = "will@netmindz.net";
	$CONF['db_name'] = "idspiral_shop";
	$CONF['use_rewrite'] = false;
}
else {
	$docroot=$_SERVER['DOCUMENT_ROOT'];
	$CONF['url'] = "http://shop.inspiralled.net";
	$CONF['paypal_address'] = 'shop@inspiralled.net';
	$CONF['paypal_host'] = 'www.paypal.com';
	$CONF['shop_email'] = "shop@inspiralled.net";
	$CONF['db_name'] = "ekopia_shop";
	$CONF['db_host'] = "ralf.netmindz.net";
	$CONF['use_rewrite'] = true;
}
ini_set("include_path",".:$docroot/includes:$docroot/classes:" . ini_get("include_path"));

$CONF['label']['order'] = "order by name";
$CONF['artist']['order'] = "order by name";
$CONF['type']['order'] = "order by name";
$CONF['track']['order'] = "order by album_id,track_number,name";
$CONF['album']['order'] = "order by name,release_year";
$CONF['album']['DN'] = '<?php if($this->release_year) { $this->DN = $this->name . " (" . $this->release_year . ")"; } else { $this->DN = $this->name; } ?>';
$CONF['label']['richtext'] = array('summary');
$CONF['artist']['richtext'] = array('summary');
$CONF['album']['richtext'] = array('summary');
$CONF['page']['richtext'] = array('content');

$CONF['db_username'] = $CONF['db_name'];
$CONF['db_pass'] = $CONF['db_username'] . "pass";
$CONF['db_sys_admin'] = "will@netmindz.net";


?>
