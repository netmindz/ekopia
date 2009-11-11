<?php
if(!is_file("/tmp/menu.inc") && (filemtime("/tmp/menu.inc") > (time() - 3600)))  {
	$page = ereg_replace("\n","",file_get_contents("http://sandbox.ralf.netmindz.net/"));
	if(ereg("<!--Begin Horizontal Menu-->(.+)<!--End Horizontal Menu-->",$page,$matches)) {
			$menu = $matches[1];
			file_put_contents("/tmp/menu.inc",$menu);
	}
}
if(is_file("/tmp/menu.inc")) {
	print file_get_contents("/tmp/menu.inc");
}
?>
