<?
require("album_tag_template.php");

class album_tag extends album_tag_template {
		

	function getByAlbum($id)
	{
		return($this->getList("where album_FK=$id"));
	}
}
?>
