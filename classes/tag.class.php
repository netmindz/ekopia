<?
require("tag_template.php");

class tag extends tag_template {

	var $count, $perc;

	function getTags()
	{
		$max = 0;
		$list = array();
		$tag = new tag();
		$tag->getList("where public='yes'");
		while($tag->getNext()) {
			$at = new album_tag();
			$i = $at->getList("where tag_FK=$tag->id");
			$tt = new track_tag();
			$i += $tt->getList("where tag_FK=$tag->id");
			if($i > $max) $max = $i;
			$tag->count = $i;
			if($i) $list[] = clone($tag);
		}
		foreach($list as $tag) {
			$tag->perc = $tag->count/$max;
		}
		return($list);
	}		

        /**
         * @return mixed        -       The number of rows found, or FALSE on query fail
         * @param string $where = ""            -       The Where clause SQL
         * @param string $order = ""            -       The Order By SQL
         * @param string $limit = ""            -       The Limit SQL
         * @desc This generic method runs a database query with the optional WHERE statement, sorted as defined in the global $CONF array or overridden with a order parameter. There is also an optional limit parameter
         */
        function getList($where="", $order="", $limit="")
        {
		global $is_admin_area;
		if((!$where)&&(!$is_admin_area)) $where = "where public = 'yes'";
                if(!$order) $order = "order by name";
                $select = "SELECT tags.* FROM tags ";
                if ($this->database->query("$select $where $order $limit")) {
                        return($this->database->RowCount);
                }else{
                        return false;
                }//IF
        }//getList


}
?>
