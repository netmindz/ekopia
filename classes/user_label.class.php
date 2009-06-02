<?
require("user_label_template.php");

class user_label extends user_label_template {

	function check($id)
	{
		if($this->getByOther(array('label_FK'=>$id))) {
			return(1);
		}
		else {
			return(0);
		}
	}		

}
?>
