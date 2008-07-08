<?php
require("include/common.php");

$ftp_server = "uploads.google.com";
$ftp_username = "inspiralled";
$ftp_password = "feedme2008!";
$destinations = array("albums-uk.xml"=>1,"albums.xml"=>1.97330,'albums-de.xml'=>1.28);


function get_rss($rate,$country) {
	global $CONF;
	$rss='<?xml version="1.0" encoding="iso-8859-1" ?>
<rss version="2.0" xmlns:g="http://base.google.com/ns/1.0">
<channel>
<title>Shop Listings</title>
<description>Product listing for the inSpiral shop</description>
<link>'.$CONF['url'].'</link>
';
	$album = new album();
	$album->getList("where price > 0 and stock_count > 0");
	while($album->getNext()) {
		$description = htmlspecialchars(strip_tags(ereg_replace("[^ -~]"," ",$album->summary)));
		$artist = new artist();
		$artist->get($album->artist_id);
		$rss .= '<item>
<title>'.htmlspecialchars($album->name).' CD Album by '.htmlspecialchars($artist->name).'</title>
<g:expiration_date>'.date("Y-m-d",strtotime("+25 days")).'</g:expiration_date>
<g:brand>'.htmlspecialchars($artist->name).'</g:brand>
<g:condition>new</g:condition>
<description>'.$description.'</description>
<guid>'.$country.$album->id.'</guid>
<g:image_link>'.$CONF['url'].'/showimage.php?id='.$album->image_id.'</g:image_link>
<link>'.$CONF['url'] . album_link($album->id,$album->name).'</link>
<g:price>'.round(($album->price * $rate),2).'</g:price>
<g:product_type>CD</g:product_type>
<g:artist>'.htmlspecialchars($artist->name).'</g:artist>
<g:edition>'.$album->release_year.'</g:edition>
<g:year>'.$album->release_year.'</g:year>
<g:format>CD</g:format>
<g:payment_accepted>Cash</g:payment_accepted>
<g:payment_accepted>Visa</g:payment_accepted>
<g:payment_accepted>MasterCard</g:payment_accepted>
<g:payment_notes>Cash only for pickup from store</g:payment_notes>
<g:pickup>true</g:pickup>
</item>';
	}

	$track = new track();
	$track->getList("where price > 0");
	while($track->getNext()) {
		$album = new album();
		$album->get($track->album_id);
		$description = htmlspecialchars(strip_tags(ereg_replace("[^ -~]"," ",$album->summary)));
		$artist = new artist();
		$artist->get($track->artist_id);
		$rss .= '<item>
<title>'.htmlspecialchars($track->name).' by ' .htmlspecialchars($artist->name).' digital MP3 / Ogg / Flac / Wav download</title>
<g:expiration_date>'.date("Y-m-d",strtotime("+25 days")).'</g:expiration_date>
<g:brand>'.htmlspecialchars($artist->name).'</g:brand>
<g:condition>new</g:condition>
<description>'.$description.'</description>
<guid>'.$country.'t'.$track->id.'</guid>
<g:image_link>'.$CONF['url'].'/showimage.php?id='.$album->image_id.'</g:image_link>
<link>'.$CONF['url'] . album_link($album->id,$album->name).'</link>
<g:price>'.round(($track->price * $rate),2).'</g:price>
<g:product_type>MP3/Ogg/Flac/Wav</g:product_type>
<g:artist>'.htmlspecialchars($artist->name).'</g:artist>
<g:edition>'.$album->release_year.'</g:edition>
<g:year>'.$album->release_year.'</g:year>
<g:format>Download</g:format>
<g:payment_accepted>Visa</g:payment_accepted>
<g:payment_accepted>MasterCard</g:payment_accepted>
<g:pickup>false</g:pickup>
</item>';
	}

	$product = new product();
	$product->getList("where price > 0");
	while($product->getNext()) {
		$type = new type();
		$type->get($product->type_id);
		$description = htmlspecialchars(strip_tags(ereg_replace("[^ -~]"," ",$product->description)));
		$rss .= '<item>
<title>'.htmlspecialchars($product->name).'</title>
<g:expiration_date>'.date("Y-m-d",strtotime("+10 days")).'</g:expiration_date>
<g:condition>new</g:condition>
<description>'.$description.'</description>
<guid>'.$country.'p'.$product->id.'</guid>
<g:image_link>'.$CONF['url'].'/showimage.php?id='.$product->image_id.'</g:image_link>
<link>'.$CONF['url'] . 'product.php?id='.$product->id.'</link>
<g:price>'.round(($product->price * $rate),2).'</g:price>
<g:product_type>'.$type->DN.'</g:product_type>
<g:payment_accepted>Visa</g:payment_accepted>
<g:payment_accepted>MasterCard</g:payment_accepted>
<g:pickup>true</g:pickup>
</item>';
	}



	$rss .= "</channel>\n</rss>\n";

	return($rss);
}

if(ereg("download",$_SERVER['QUERY_STRING'])) {
	header("Content-Type: text/xml;charset=iso-8859-1");
	//header("Content-Disposition: attachment;filename=".$destination_file);
	if(isset($_GET['file'])) {
		print get_rss($destinations[$_GET['file']],"");
	}
	else {
		print get_rss(1,"");
	}
	exit();
}


$conn_id = ftp_connect($ftp_server); 

// login with username and password
$login_result = ftp_login($conn_id, $ftp_username,$ftp_password); 

// check connection
if ((!$conn_id) || (!$login_result)) { 
        echo "FTP connection has failed!</br>\n";
        echo "Attempted to connect to $ftp_server for user $ftp_username</br>\n"; 
        exit; 
    } else {
        echo "Connected to $ftp_server, for user $ftp_username</br>\n";
    }

foreach($destinations as $destination_file=>$rate) {
	print "$destination_file with rate of $rate<br>\n";
	$source_file = tempnam("/tmp/","albums");
	if(ereg("-(.+)\.xml",$destination_file,$matches)) {
		$country = $matches[1];
	}
	else {
		$country = "";
	}
	file_put_contents($source_file,get_rss($rate,$country));

	// check upload status
	if (!ftp_put($conn_id, $destination_file, $source_file, FTP_BINARY)) { 
	        echo "FTP upload of $source_file to $destination_file has failed!</br>\n";
	} else {
        	echo "Uploaded $source_file to $ftp_server as $destination_file</br>\n";
	}

	#@unlink($source_file);
}

// close the FTP stream 
ftp_close($conn_id); 
/*
    * ean
    * id
    * isbn
    * mpn

    * genre
*/


?>
