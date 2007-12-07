<?php

if(ereg('~',$_SERVER['PHP_SELF'])) {
	$docroot="/home/will/public_html/id";
}
else {
	$docroot=$_SERVER['DOCUMENT_ROOT'];
}
ini_set("include_path",".:$docroot/includes:$docroot/classes:" . ini_get("include_path"));

$CONF['track']['order'] = "order by album_id,track_number,name";

$CONF['db_name'] = "idspiral_shop";
$CONF['db_username'] = "idspiral_shop";
$CONF['db_pass'] = "idspiral_shoppass";
$CONF['db_sys_admin'] = "will@localhost";


?>
