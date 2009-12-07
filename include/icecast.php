<?php
function icecast_get_live()
{
	$url = "http://master.inspiralled.net:8000/info.xsl";
	$cache = "/tmp/icecast-" . md5($url);
	if(!is_file($cache)||((time() - filemtime($cache) > 30))) {
		$xml = @file_get_contents($url);
		if($xml) {
			file_put_contents($cache,$xml);
		}
	}
	else {
		$xml = file_get_contents($cache);
	}
	if($xml) {
		$doc = simplexml_load_string($xml);
		foreach($doc->source as $source) {
			if(eregi('live',$source->server_name)) {
				return($source);
			}
		}
	}
}

