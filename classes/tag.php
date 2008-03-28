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

}
?>
