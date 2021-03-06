<?
require("track_template.php");
#if(!class_exists("album")) include("album.php");

class track extends track_template {
		
	function getTrackListings($album_id)
	{
		return($this->getList("where album_id='$album_id'"));
	}

	function getDownloadTrackListings($album_id)
	{
		return($this->getList("where album_id='$album_id' and price > 0"));
	}

	function addTrack($info, user $user)
	{
		if(($info['track_number'])&&($this->getByOther(array('track_number'=>$info['track_number'],'album_id'=>$info['album_id'])))) {
			return($this->id);
		}
		elseif($this->getByOther(array('name'=>$info['name'],'album_id'=>$info['album_id']))) {
			return($this->id);
		}
		else {
			$this->setProperties($info,"addslashes");
			$this->setProperties(array('user_id'=>$user->id));
			return($this->add());
		}
	}

	function getDownload($type)
	{
		$flac = "../raw/$this->album_id/$this->track_number.flac";
		$download = "../encoded/$this->album_id/$this->id.$type";
		$filename = "$this->track_number - $this->name.$type"; 

		$error = "";

		if(!is_file($flac)) {
			return("failed to find raw");
		}

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
			
			$artist = $album->getArtist();
			$image = $album->getImage();
			$cover = $image->createThumb(300,300);

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
				$id3 .= "--tn $this->track_number ";
				if(is_file($cover)) {
					$id3 .= "--ti $cover ";
				}
				$exec = $this->_getRaw() . " | lame --preset cd --brief -c $id3 - $download 2>&1";
			}
			elseif($type == "ogg") {
				$mime = "application/ogg";
				$id3 = "--title \"$this->name\" ";
				$id3 .= "--tracknum $this->track_number ";
				$id3 .= "--artist \"$artist->name\" ";
				$id3 .= "--album \"$album->name\" ";
				$exec = $this->_getRaw() . " | oggenc -q 7 $id3 --raw - -o $download 2>&1";
			}
			elseif($type == "flac") {
				$download = $flac;
			}
			else {
				$error = "Unsupported type requested";
			}
			if(!is_file($download)) {
				exec($exec,$results,$return);
		                if($return) $error = implode("\n",$results);
			}
			if((!is_file($download))||(!filesize($download))) {
				$error = "failed to find download in the $type format (" . $error . ") file($download) from $flac";
			}

			if(!$error)  {
				return($download);
			}
			else {
				trigger_error($error);
			}
		}
	}

	function downloadTrack($type)
	{
		$download = $this->getDownload($type);

		if($type == "mp3") {
                       $mime = "audio/mpeg";
		}elseif($type == "ogg") {
			$mime = "application/ogg";
		}
		else {
			$mime = "application/octet-stream";
		}
		$filename = "$this->track_number - $this->name.$type"; 
		
                header("Content-Type: $mime");
                header("Content-Length: " . filesize($download));
                header("Content-Disposition: attachment;filename=" . urlencode(str_replace(" ","_",$filename)));
                $fh = fopen($download,'r') or die("failed to open file");
                while(!feof($fh)) {
			print fgets($fh,255);
		}

	}

	function getPreview($use_fade)
	{
	        if(!$use_fade) {
	                $full = 1;
			$preview = "previews/$this->album_id/$this->track_number.full.mp3";
        	}
		else {
			$full = 0;
			if($use_fade) {
				$preview = "previews/$this->album_id/$this->track_number.mp3";
			}
			else {
				$preview = "previews/$this->album_id/$this->track_number.nofade.mp3";
			}
		}
		$filename = basename($preview);
		$mime = "audio/mpeg";

		$error = "";
		if((!is_file($preview))||(filesize($preview) < 1024)) {
			if(!is_dir(dirname($preview))) {
					exec("mkdir -p " . dirname($preview));
			}	
			$preview_length = 60;
			$fade = 10;
			$total_length = ($preview_length + ($fade * 2));
			if($raw = $this->_getRaw()) {
				if($full) {
					$cmd = $this->_getRaw() . " | lame -a -m m -b 64 -f --brief -c --noreplaygain - $preview 2>&1";
					exec($cmd,$results,$return);
	                                if($return) $error = "$cmd = " . implode("\n",$results);
				}
				else {
					if($use_fade) { 
						$fade_cmd = " | sox -t wav - -t wav - fade t $fade ".($total_length - $fade)." $fade ";
					}
					else {
						$total_length = $preview_length * 2;
						$fade_cmd = "";
					}

					$cmd = $this->_getRaw() . " | sox -t wav - -t wav - trim 60 $total_length $fade_cmd | lame -a -m m -b 64 -f --brief -c --noreplaygain - $preview 2>&1";
					exec($cmd,$results,$return);
					if($return) $error = "$cmd = " . implode("\n",$results);
				}
			}		
			else {
				$error = "failed to find raw";
			}
		}

		if((!is_file($preview))||(filesize($preview) < 1024)) {
			$error = "failed to find preview (" . $error . ")";
			@unlink($preview);
		}
		if(!$error)  {
			/*
			header("Content-Type: $mime");
			header("Content-Length: " . filesize($preview));
			header("Content-Disposition: attachment;filename=" . urlencode($filename));
			$fh = fopen($preview,'r') or die("failed to open file");
			while(!feof($fh)) {
				print fgets($fh,255);
			}
			*/
			header ('HTTP/1.1 301 Moved Permanently');
			header("Location: $preview");
			exit();
		}
		else {
			return($error);
		}
	}

	function displayThumb()
	{
		$artist = new artist();
		$artist->get($this->artist_id);
		$album = new album();
		$album->get($this->album_id);
		?>
		<div id="track_thumb">
		Track: <?= $this->name ?><br>
		Artist: <a href="<?= browse_link("artist",$artist->id,$artist->DN) ?>"><?= $artist->DN ?></a><br/>
		Album: <a href="<?= browse_link("album",$album->id,$album->DN) ?>"><?= $album->DN ?></a><br/>
		</div>
		<?php
	}

        function getListByType($type,$id)
        {
                return($this->getList("where ${type}_id='".$id."'"));
        }


	function _getRaw()
	{
		$file = "../raw/$this->album_id/$this->track_number.flac";
		if(!is_file($file)) {
			return false;
		}
		else {
			return("flac -dc $file");
		}
	}

	function getUnTaggedList($offset)
	{
		$this->database->query("select tracks.* from tracks left join track_tags on (tracks.id = track_FK) where track_FK is null limit $offset,100");
		return($this->database->RowCount);
	}
}
?>
