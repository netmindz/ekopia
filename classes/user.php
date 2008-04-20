<?
require("user_template.php");

class user extends user_template {

	public $lastError;

	function login($username,$password)
	{
		if(!isset($_SESSION)) session_start();
		if(!$this->getByOther(array('username'=>$username))) {
			$this->lastError = "Unknown user";
			return(false);
		}
		if(md5($password) != $this->password) {
			$this->lastError = "Invalid Login";
			return(false);
		}
		$_SESSION['user_id'] = $this->id;
		return($this->id);
	}

	function checkLogin()
	{
		global $CONF;
		if(!$this->id) {
			header($CONF['url'] . "/login.php");
			exit();
		}
	}

}
?>
