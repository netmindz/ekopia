<?
require("user_label_template.php");

class user_label extends user_label_template {

	function check($id, user $user)
	{
		if($this->getByOther(array('label_FK'=>$id,'user_FK'=>$user->id))) {
			return(1);
		}
		else {
			return(0);
		}
	}
	
	function getUserList(user $user)
	{
		return($this->getList("where user_FK=" . $user->id));
	}

	function getLabel()
	{
		$label = new label();
		$label->get($this->label_FK);
		return($label);
	}
}
?>
