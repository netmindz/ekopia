<?
require("user_artist_template.php");

class user_artist extends user_artist_template {
	
	function check($id)
        {
                if($this->getByOther(array('artist_FK'=>$id))) {
                        return(1);
                }
                else {
                        return(0);
                }
        }
		

}
?>
