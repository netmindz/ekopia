<?
require("track_template.php");

class track extends track_template {
		
	function getTrackListings($album_id)
	{
		return($this->getList("where album_id='$album_id'"));
	}

	function addTrack($info)
	{
		if($this->getByOther(array('track_number'=>$info['track_number'],'album_id'=>$info['album_id']))) {
			return($this->id);
		}
		else {
			$this->setProperties($info,"addslashes");
			return($this->add());
		}
	}

	function getDownload($type)
	{
		$raw = "raw/$this->album_id/$this->id.flac";
		$download = "encoded/$this->album_id/$this->id.$type";
		$filename = "$this->track_number - $this->name.$type"; 

		$error = "";

		if($type == "wav") {
			$fh = popen($this->_getRaw(),'r') or die();
			header("Content-Type: audio/x-wav");
			header("Content-Disposition: attachment;filename=" . urlencode(str_replace(" ","_",$filename)));
			fpassthru($fh);
			return;				
		}
		else {
			$album = new album();
			$album->get($this->album_id);
			$artist = new artist();
			$artist->get($album->artist_id); 	
			if(!is_file($download)) {
				if(!is_dir(dirname($download))) {
					exec("mkdir -m 777 -p " . dirname($download));
				}	
			}
			if($type == "mp3") { 
				$mime = "audio/mpeg";
				$id3 = "--tt \"$this->name\" ";
				$id3 .= "--ta \"$artist->name\" ";
				$id3 .= "--tl \"$album->name\" ";
				exec($this->_getRaw() . " | lame --preset cd --replaygain-accurate --brief -c $id3 - $download 2>&1",$results,$return);
				if($return) $error = implode("\n",$results);
			}
			elseif($type == "ogg") {
				$mime = "application/ogg";
				$id3 = "--title \"$this->name\" ";
				$id3 .= "--tracknum $this->track_number ";
				$id3 .= "--artist \"$artist->name\" ";
				$id3 .= "--album \"$album->name\" ";
				exec($this->_getRaw() . " | oggenc -q 7 $id3 --raw - -o $download 2>&1",$results,$return);
				if($return) $error = implode("\n",$results);
			}
			else {
				$error = "Unsupported type requested";
			}
			if((!is_file($download))||(!filesize($download))) {
				$error = "failed to find download in the $type format (" . $error . ")";
			}
			if(!$error)  {
				header("Content-Type: $mime");
				header("Content-Length: " . filesize($download));
				header("Content-Disposition: attachment;filename=" . urlencode(str_replace(" ","_",$filename)));
				$fh = fopen($download,'r') or die("failed to open file");
				while(!feof($fh)) {
					print fgets($fh,255);
				}
			}
			else {
				return($error);
			}
		}
	}

	function getPreview()
	{
		$preview = "encoded/mp3/$this->album_id/preview_$this->id.mp3";
		$filename = "$this->id.mp3"; 

		$error = "";

		if(!is_file($preview)) {
			if(!is_dir(dirname($preview))) {
					exec("mkdir -p " . dirname($preview));
			}	
		}
		$mime = "audio/mpeg";
		exec($this->_getRaw() . " | lame -a -m m -b 64 -f --brief -c --noreplaygain - $preview 2>&1",$results,$return);
		if($return) $error = implode("\n",$results);

		if((!is_file($preview))||(!filesize($preview))) {
			$error = "failed to find preview (" . $error . ")";
		}
		if(!$error)  {
			header("Content-Type: $mime");
			header("Content-Length: " . filesize($preview));
			header("Content-Disposition: attachment;filename=" . urlencode($filename));
			$fh = fopen($preview,'r') or die("failed to open file");
			while(!feof($fh)) {
				print fgets($fh,255);
			}
		}
		else {
			return($error);
		}
	}

	function _getRaw()
	{
		return("flac -dc raw/$this->album_id/$this->track_number.flac");
	}
}
?>
