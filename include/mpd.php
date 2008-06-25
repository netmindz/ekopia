<?php

function mpd_now_playing() 
{
	flush();
	$data = array();
	$fp = @fsockopen("10.0.11.6",6600,$errno,$errstr,5);
	if($fp) {
		$banner = fgets($fp,255);
		if(ereg("OK",$banner)) {
			fputs($fp,"status\n");
			$sanity = 0;
			while($line = trim(fgets($fp,255))) {
				#print $line . "<br>\n";
				if($sanity > 1000) break;
				$sanity++;
				if($line=="OK") break;
			 	if(ereg('^([^ ]+): (.+)$',$line,$matches)) {
		   	         		$data[strtolower($matches[1])] = $matches[2];
				}
			}
	
			fputs($fp,"playlistinfo " . $data['song'] . "\n");
			$data['title'] = "";
			while(($line = trim(fgets($fp,255)))&&($sanity < 1000)) {
					#print "line=$line<br/>\n";
					$sanity++;
					if($line=="OK") break;
			 		if(ereg('^([^ ]+): (.+)$',$line,$matches)) {
						$key = strtolower($matches[1]);
		   	         		$data[$key] = $matches[2];
					}
			}
			#print_r($data);
			return($data);
		}
	}
}


?>
