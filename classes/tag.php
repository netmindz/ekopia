<?
require("tag_template.php");

class tag extends tag_template {

	var $count, $perc;

	function getTags()
	{
		$max = 0;
		$list = array();
		$tmp = new tag();
		$tmp->getList("where public='yes'");
		while($tmp->getNext()) {
			$at = new album_tag();
			$i = $at->getList("where tag_FK=$tmp->id");
			$tt = new track_tag();
			$i += $tt->getList("where tag_FK=$tmp->id");
			if($i > $max) $max = $i;
			$tmp->count = $i;
			if($i) $list[$tmp->id] = $tmp;
		}
		foreach($list as $id=>$tag) {
			$list[$id]->perc = floor($tag->count/$max);
		}
		return($list);
	}		

}
?>
