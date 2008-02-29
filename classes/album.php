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
			$this->setProperties(array('name'=>addslashes($name),'artist_id'=>$artist_id,
			'release_year'=>$release_year,'label_reference'=>$label_reference,'label_id'=>$label_id));
			return($this->add());
		}
	}		

	function getListByType($type,$id)
	{
		return($this->getList("where ${type}_id='".$id."'"));
	}
		
	function getByName($name)
	{
		return($this->getByOther(array('name'=>$name)));
	}
		

	function displayThumb()
	{
		global $CONF;
		$label = new label();
                $label->get($this->label_id);
                $artist = new artist();
                $artist->get($this->artist_id);
		 ?>
                <div id="album_thumb">
		<div id="album_thumb_image">
		<a href="<?= $CONF['url'] ?>/album.php?album_id=<?= $this->id ?>"><?php
		$image = new image();
		$image->show($this->image_id,100,100,"alt=\"$this->name\" title=\"Click to view album $this->name\"");
		?></a>
		</div>
                Album: <a href="<?= $CONF['url'] ?>/album.php?album_id=<?= $this->id ?>"><?= $this->name ?></a><br/>
                Artist: <a href="<?= browse_link("artist",$artist->id,$artist->DN); ?>"><?= $artist->DN ?></a><br/>
                Label: <a href="<?= browse_link("label",$label->id,$label->DN) ?>"><?= $label->DN ?></a><br/>
                <?php if($this->price) { ?>
                <form action="<?= $CONF['url'] ?>/basket.php" method="post">
                <input type="hidden" name="action" value="add" />
                <input type="hidden" name="album_id" value="<?= $this->id ?>" />
                &pound; <?= $this->price ?> <input type="submit" value="Add to basket" class="inputbox" />
                </form>
                <?php } else { ?>
                Coming soon to buy here
                <?php } ?>
                </div>
		<?
	}
}
?>
