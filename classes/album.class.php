<?
require("album_template.php");

class album extends album_template {

	function lookupOrAdd($name,$artist_id,$release_year)
	{
		// not getting the album artist, just the track artist
		#if($this->getByOther(array('name'=>$name,'artist_id'=>$artist_id))) {
		if(ereg('^(.+) \[(.+)\]$',$name,$matches)) {
			$name = $matches[1];
			$label_reference = $matches[2];
		}
		else {
			$label_reference = "";
		}
		if(eregi('^(.+) \((.+ records)\)$',$name,$matches)) {
			$name = $matches[1];
			$label = new label();
			$label_id = $label->LookupOrAdd($matches[2]);
		}
		else {
			$label_id = 0;
		}
		if($this->getByOther(array('name'=>$name))) {
			return($this->id);
		}
		else {
			$this->setProperties(array('name'=>$name,'artist_id'=>$artist_id,
			'release_year'=>$release_year,'label_reference'=>$label_reference,'label_id'=>$label_id,'added'=>'NOW()'));
			return($this->add());
		}
	}		

	function getListByType($type,$id)
	{
		return($this->getList("where ${type}_id='".$id."'"));
	}
	
	function getListPrefixes()
	{
		$tmp = new album();
		$tmp->getList();
		$prefixes = array();
		$tmp->getList();
		while($tmp->getNext()) {
			$prefixes[substr(strtoupper($tmp->name),0,1)] = 1;
		}
		$prefixes = array_keys($prefixes);
		sort($prefixes);
		return($prefixes);
	}

	function getListByPrefix($prefix)
	{
		return($this->getList("where name like '$prefix%'"));
	}	
	
	function getByName($name)
	{
		return($this->getByOther(array('name'=>$name)));
	}
		

	function displayThumb($showBuyCD=true)
	{
		global $CONF;
		$label = new label();
                $label->get($this->label_id);
                $artist = new artist();
                $artist->get($this->artist_id);
		 ?>
                <div id="album_thumb">
		<div id="album_thumb_image">
		<a href="<?= album_link($this->id,$this->name) ?>"><?php
		$image = new image();
		$image->show($this->image_id,100,100,"alt=\"$this->name\" title=\"Click to view album $this->name\"");
		?></a>
		</div>
                Album: <a href="<?= album_link($this->id,$this->name) ?>"><?= $this->name ?></a><br/>
                Artist: <a href="<?= browse_link("artist",$artist->id,$artist->DN); ?>"><?= $artist->DN ?></a><br/>
                Label: <a href="<?= browse_link("label",$label->id,$label->DN) ?>"><?= $label->DN ?></a><br/>
		<?php if($this->download_price > 0) { ?>
	       		<form action="<?= $CONF['url'] ?>/basket.php" method="post">
        	        <input type="hidden" name="action" value="add"/>
	                <input type="hidden" name="delivery" value="download"/>
	                <input type="hidden" name="album_id" value="<?= $this->id ?>"/>
	                &pound; <?= $this->download_price ?>
	                <input type="submit" value="Download" class="inputbox"/>
	                </form>
	        <?php } elseif($this->countDownloads()) { ?>
			<a href="<?= album_link($this->id,$this->name) ?>"><img src="/download.gif" width="15"></a>&nbsp;Downloads Avalible<br/>
	        <?php } ?>

		<?php if($showBuyCD) { ?>
	                <?php if(($this->price)&&($this->stock_count > 0)) { ?>
        	        <form action="<?= $CONF['url'] ?>/basket.php" method="post">
                	<input type="hidden" name="action" value="add" />
	                <input type="hidden" name="album_id" value="<?= $this->id ?>" />
			<input type="hidden" name="delivery" value="cd"/>
        	        &pound; <?= $this->price ?> <input type="submit" value="Buy CD" class="inputbox" />
	                </form>
	                <?php } elseif(($this->download_price <=0)&&($this->price <=0)) { ?>
	                Coming soon to buy here
			<?php } elseif($this->stock_count <= 0) { ?>
	                CD Out of stock
              	 	<?php } ?>
		<?php } ?>
                </div>
		<?
	}
		

	function countDownloads()
	{
		$track = new track();
		return($track->getDownloadTrackListings($this->id));
	}

	function getNew($count)
	{
		return($this->getList("where price > 0 and stock_count > 0","order by added desc,rand()","limit 0,$count"));
	}

	function getDownloads($count)
	{
		return($this->getList("where id in (select distinct album_id from tracks where price > 0)","order by added desc","limit 0,$count"));
	}
	
	function downloadAlbum($type)
	{
		$track = new track();
		$track->getAlbumList($this);
		$files = array();
		$zip = new ZipArchive;
		$zipname = '/tmp/album-'.$this->id.".zip";
		if(!is_file($zipname)) {
			if($zip->open($zipname,ZipArchive::CREATE) === TRUE) {
				while($track->getNext()) {
					$file = $track->getDownload($type);
					$zip->addFile($file, basename($file));
				}
				$zip->close();
			}
			else {
				trigger_error("Failed to open zip");
			}
		}
		header("Content-Type: application/zip");
		header("Content-Length: " . filesize($zipname));
		header("Content-Disposition: attachment;filename=" . urlencode(basename($zipname)));
		fpassthur(fopen($zipname,'r'));
	}
}
?>
