<?
function amazon_getAlbum($artists,$album,$asin)
{
	if((!count($artists))&&(!$asin)) {
//		print "no artists supplied and no asin either<br>\n";
		return(false);
	}
	
	foreach($artists as $key=>$tmp) {
		$artists[$key] = strtolower($tmp);
	}
	
	
	$album = eregi_replace(" - CD ?[0-9]","",$album);

	$soapclient = new soapclient("http://soap-eu.amazon.com/schemas3/AmazonWebServices.wsdl?locale=uk");
	
#	print_r_html($soapclient->__getFunctions());
	
	
	$params = array (
		'keyword'	=> htmlspecialchars(ereg_replace("[!]","",$album)),
		'page'	=> 1,
		'mode'	=> 'music',
		'tag'		=> '',
		'type'	=> 'lite',
		'devtag'	=> 'D14LZ8QVR28RO5',
		'locale'=>'uk',
	);

	try {	
		if($asin) {
			$result = $soapclient->AsinSearchRequest(array('asin'=>$asin,'devtag'=>'D14LZ8QVR28RO5','type'=>'lite','mode'=>'music','locale'=>'uk','tag'=>''));
        	}
      		else {
			// print "searching for $album<br>\n";
			$result = $soapclient->keywordSearchRequest($params);
	
		}
	} catch (SoapFault $fault) {
    		trigger_error("SOAP Fault: (faultcode: {$fault->faultcode}, faultstring: {$fault->faultstring})", E_USER_WARNING);
		return false;
	}
	$items = $result->Details;
	
	if(!count($items)) return(false);
	$details = array();
	foreach($items as $item) {
		if($item->Asin == $asin) {
                	$details = $item;
                        break;
		}
	}
	if(!$details) {
		foreach($items as $item) {
			if(eregi("^$album",$item->ProductName)) {

				#print "found album $album, trying to verify artist (".implode(", ",$artists).")<br>\n";
				/*
				print_r_html($item['Artists']);
				print_r_html($artists);
				*/

				foreach($item->Artists as $artist) {
					$artist = strtolower($artist);
					if(in_array($artist,$artists)) {
						print "Found match in amazon<br>\n";
						$details = $item;
						$albumObj = new album();
						$albumObj->getByName($album);
						$albumObj->amazon_asin = $item->Asin;
						$albumObj->set("amazon_asin");
						break;
					}
				}
			}
		}
	}
	return($details);
}
?>
