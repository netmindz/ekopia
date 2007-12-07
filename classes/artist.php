<?
require("artist_template.php");

class artist extends artist_template {
		
	function lookupOrAdd($name)
	{
		if($this->getByOther(array('name'=>$name))) {
			return($this->id);
		}
		else {
			$this->setProperties(array('name'=>$name));
			return($this->add());
		}
	}		

}
?>
