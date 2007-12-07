<?
require("album_template.php");

class album extends album_template {

	function lookupOrAdd($name,$artist_id,$release_year)
	{
		if($this->getByOther(array('name'=>$name,'artist_id'=>$artist_id))) {
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
}
?>
