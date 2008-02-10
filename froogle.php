<?php
require("include/common.php");

$ftp_server = "uploads.google.com";
$ftp_username = "inspiralled";
$ftp_password = "feedme2008!";
$destination_file = "albums-uk.xml";


function get_rss() {
	global $CONF;
	$rss='<?xml version="1.0"?>
<rss version="2.0" xmlns:g="http://base.google.com/ns/1.0">
<channel>
<title>Shop Listings</title>
<description>Album listing for the shop</description>
<link>'.$CONF['url'].'</link>
';
	$album = new album();
	$album->getList("where price >0");
	while($album->getNext()) {
		$artist = new artist();
		$artist->get($album->artist_id);
		$rss .= '<item>
<title>'.htmlspecialchars($album->name).' CD Album by '.htmlspecialchars($artist->name).'</title>
<g:expiration_date>'.date("Y-m-d",strtotime("next month")).'</g:expiration_date>
<g:brand>'.htmlspecialchars($artist->name).'</g:brand>
<g:condition>new</g:condition>
<description>'.htmlspecialchars($album->summary).'</description>
<guid>'.$album->id.'</guid>
<g:image_link>'.$CONF['url'].'/showimage.php?id='.$album->image_id.'</g:image_link>
<link>'.$CONF['url'].'/album.php?album_id='.$album->id.'</link>
<g:price>'.$album->price.'</g:price>
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
	$rss .= '</channel></rss>';

	return($rss);
}

if(ereg("download",$_SERVER['QUERY_STRING'])) {
	header("Content-Type: text/xml");
	header("Content-Disposition: attachment;filename=".$destination_file);
	print get_rss();
	exit();
}


$conn_id = ftp_connect($ftp_server); 

// login with username and password
$login_result = ftp_login($conn_id, $ftp_username,$ftp_password); 

// check connection
if ((!$conn_id) || (!$login_result)) { 
        echo "FTP connection has failed!";
        echo "Attempted to connect to $ftp_server for user $ftp_username"; 
        exit; 
    } else {
        echo "Connected to $ftp_server, for user $ftp_username";
    }

$source_file = tempnam("/tmp/","albums");
file_put_contents($source_file,get_rss());

// upload the file
$upload = ftp_put($conn_id, $destination_file, $source_file, FTP_BINARY); 

// check upload status
if (!$upload) { 
        echo "FTP upload has failed!";
    } else {
        echo "Uploaded $source_file to $ftp_server as $destination_file";
    }

@unlink($source_file);

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
