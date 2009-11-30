<?
require("user_artist_template.php");

class user_artist extends user_artist_template {
	
	function check($id, user $user)
        {
                if($this->getByOther(array('artist_FK'=>$id,'user_FK'=>$user->id))) {
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

	function getArtist()
	{
		$artist = new artist();
		$artist->get($this->artist_FK);
		return($artist);
	}
}
?>
