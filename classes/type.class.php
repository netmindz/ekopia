<?
require("type_template.php");

class type extends type_template {

	function getWholesaleList() {
		return($this->getList("where visibility in ('wholesale','both')"));
	}		

	function getPublicTopList() {
		return($this->getList("where visibility in ('public','both') and type_id=0"));
	}		

}
?>
