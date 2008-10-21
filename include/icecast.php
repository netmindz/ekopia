<?php
function icecast_get_live()
{
	$xml = @file_get_contents("http://master.inspiralled.net:8000/info.xsl");
	if($xml) {
		$doc = simplexml_load_string($xml);
		foreach($doc->source as $source) {
			if(eregi('live',$source->server_name)) {
				return($source);
			}
		}
	}
}

