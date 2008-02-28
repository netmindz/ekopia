<?
require("label_template.php");

class label extends label_template {

        function lookupOrAdd($name)
        {
                if($this->getByOther(array('name'=>$name))) {
                        return($this->id);
                }
                else {
                        $this->setProperties(array('name'=>$name),"addslashes");
                        return($this->add());
                }
        }
		

}
?>
