<?php
require("../include/site_config.inc.php");
$is_admin_area = true;
require("../include/common.php");

$products = array();

$fields = array("Brand","Description","VARIETY","SIZE","FIT","POS 20","POS 12","DEPT","CATEGORY","GROUP","SUBGROUP","SUPPLIER","ORDER CODE","MANUFACTURER","PACK/CARTON SIZE","MIN ORDER QTY","EX TAX COST","INC TAX COST","SELL 1","PLU/EAN/ISDN","TAX CODE","DISCOUNTABLE","CROSS REFERENCE CODE","UOM","SELL 2","SELL 3","SELL 4","SELL 5","TRACK SERIAL NUMBER","CLASSIFICATION","Recipe","FAMILY","VARIETY SET","SIZE SET","FIT SET","","INC TAX CALULATION");

function newProduct($desc,$dept,$cat,$group,$subgroup,$supplier,$ordercopde,$price)
{
	$p = array();
	$p['Description'] = $desc;
	$p['POS 20'] = substr($desc,0,20);
	$p['DEPT'] = $dept;
	$p['CATEGORY'] = $cat;
	$p['GROUP'] = $group;
	$p['SUBGROUP'] = $subgroup;
	$p['SUPPLIER'] = $supplier;
	$p['ORDER CODE'] = $ordercopde;
	$p['PACK/CARTON SIZE'] = 1;
	$p['MIN ORDER QTY'] = 1;
	$p['EX TAX COST'] = $price / 1.15;
	$p['EX TAX COST'] = $price / 1.15;
	$p['SELL 1'] = $price;
	$p['SELL 2'] = $price;
	$p['SELL 3'] = $price;
	$p['SELL 4'] = $price;
	$p['SELL 5'] = $price;
	$p['UOM'] = "Each";
	return($p);
}

$album = new album();
$album->getList("where price > 0");
while($album->getNext()) {
	$label = $album->getLabel();
	$products[] = newProduct($album->DN . " CD","Shop","Albums","CDs",$label->DN,"Shop","CD" . $album->id,$album->price);
}
$album->getList("where download_price > 0");
while($album->getNext()) {
	$label = $album->getLabel();
	$products[] = newProduct($album->DN . " Download","Shop","Albums","Downloads",$label->DN,"Shop","ALBUM" . $album->id,$album->download_price);
}

$track = new track();
$track->getList("where price > 0");
while($track->getNext()) {
	$album = $track->getAlbum();
	$label = $album->getLabel();
	$products[] = newProduct($track->DN . " Download","Shop","Tracks","Downloads",$label->DN,"Shop","TRK" . $track->id,$album->price);
}

$product = new product();
$product->getList("where price > 0");
while($product->getNext()) {
	$type = new type();
	$type->get($product->type_id);
	$description = htmlspecialchars(strip_tags(ereg_replace("[^ -~]"," ",$product->description)));
	$products[] = newProduct($product->DN,"Shop","Products",$type->DN,"NONE","Shop","PRD" . $product->id, $product->price);
}

$variation = new product_variation();
$variation->getList("where price > 0");
while($variation->getNext()) {
	$product = new product();
	$product->get($variation->product_id);
	$type = new type();
	$type->get($product->type_id);
	$description = htmlspecialchars(strip_tags(ereg_replace("[^ -~]"," ",$product->description)));
	$products[] = newProduct($variation->DN . " " . $type->name,"Shop","Products",$type->DN,$product->DN,"Shop","PRDV" . $variation->id, $variation->price);
}




header("Content-Type: text/csv");
header("Content-Disposition: attachment;filename=pos-export.csv");
print implode(",", $fields) . "\r\n";
foreach($products as $prod) {
	foreach($fields as $f) {
		if(isset($prod[$f])) {
			print '"' . $prod[$f] . '"';
		}
		else {
			print '""';
		}
		print ",";
	}
	print "\r\n";
}
?>
