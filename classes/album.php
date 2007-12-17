<?
require("album_template.php");

class album extends album_template {

	function lookupOrAdd($name,$artist_id,$release_year)
	{
		// not getting the album artist, just the track artist
		#if($this->getByOther(array('name'=>$name,'artist_id'=>$artist_id))) {
		if($this->getByOther(array('name'=>$name))) {
			return($this->id);
		}
		else {
			$this->setProperties(array('name'=>$name,'artist_id'=>$artist_id,'release_year'=>$release_year));
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
		$label = new label();
                $label->get($this->label_id);
                $artist = new artist();
                $artist->get($this->artist_id);
		 ?>
                <div id="album_thumb">
		<div id="album_thumb_image">
		<a href="album.php?album_id=<?= $this->id ?>"><?php
		$image = new image();
		$image->show($this->image_id,100,100);
		?></a>
		</div>
                Album: <a href="album.php?album_id=<?= $this->id ?>"><?= $this->DN ?></a><br>
                Artist: <a href="browse.php?type=artist&id=<?= $artist->id ?>"><?= $artist->DN ?></a><br>
                Label: <a href="browse.php?type=label&id=<?= $label->id ?>"><?= $label->DN ?></a><br>
                <?php if($this->price) { ?>
                <form action="basket.php" method="POST">
                <input type="hidden" name="action" value="add">
                <input type="hidden" name="album_id" value="<?= $this->id ?>">
                <input type="submit" value="Add to basket" class="inputbox">
                </form>
                <?php } else { ?>
                Coming soon to buy here
                <?php } ?>
                </div>
		<?
	}
}
?>
