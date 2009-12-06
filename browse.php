<?php
require("include/common.php");

$page_title="@page_title@";
$page_keywords="@page_keywords@";
$keywords = array();
ob_start();

?>
<?php include("header.inc.php"); ?>

<?php

$type = "album";
if(ereg("/browse/([^/]+)(.*)",$_SERVER['PHP_SELF'],$matches)) {
	$type = $matches[1];
	if(ereg("/[^/]+/([0-9]+)",$matches[2],$mat)) {
		$id = $mat[1];
	}
}
if((isset($_REQUEST['type']))&&(in_array($_REQUEST['type'],array('artist','album','label',"type")))) {
	$type = $_REQUEST['type'];
}
if(isset($_REQUEST['id'])) {
	$id = $_REQUEST['id'];
}


	$album = new album();
	if(isset($id)) {
		$count = $album->getListByType($type,$id);
		$typeObj = new $type();
		$typeObj->get($id);
		?>
		<h2><?= ucwords($type) ?> - <?= $typeObj->DN ?></h2>
		<?php

		$page_title = ucwords($type) . " - " . $typeObj->DN . " @ inSpiral shop";
		if($typeObj->image_id) {
			$image =  new image();
			$image->show($typeObj->image_id,150,150,"align='right'");
		}
		print $typeObj->summary;
		if($typeObj->website) { ?><p><a href="<?= $typeObj->website ?>" target="_new"><?= $typeObj->DN ?> website</a></p><? }
		if($typeObj->myspace) { ?><p><a href="http://www.myspace.com/<?= $typeObj->myspace ?>" target="_new"><?= $typeObj->DN ?> on MySpace</a></p><? } 
		if($typeObj->facebook_fanid) { ?><p>Become a fan of <a href="http://www.facebook.com/pages/fan/<?= $typeObj->facebook_fanid ?>" target="_new"><?= $typeObj->DN ?></a> on Facebook</p><? } 
		if($typeObj->facebook_profileid) { ?><p>Become a friend of <a href="http://www.facebook.com/profile.php?id=<?= $typeObj->facebook_profileid ?>" target="_new"><?= $typeObj->DN ?></a> on Facebook</p><? } 
		
		$keywords[] = $typeObj->DN;
		?>
		<div class="edit">[&nbsp;<a href="edit.php?id=<?= $id ?>&amp;type=<?= $type ?>">edit</a>&nbsp;]</div>
		<?
	}
	else {
		$page_title = "Browse " . ucwords($type) . "s @ inSpiral shop";
		if($type != "album") {
			$typeObj = new $type();
			if($type == "artist") {
				$where = "where published='yes'";
			}
			else {
				$where = "";
			}
			$count = $typeObj->getList($where);
			?>
			<h2><?= ucwords($type) ?>s</h2>
			<p><?= $count ?> found</p>
			<ul>
			<?php
			while($typeObj->getNext()) { ?>
				<li><a href="<?= browse_link($type,$typeObj->id,$typeObj->DN) ?>"><?= $typeObj->DN ?></a></li>
				<?php
			}	
		}
		else {
			$prefixes = $album->getListPrefixes();
			if(isset($_REQUEST['prefix'])) { $prefix = $_REQUEST['prefix']; } else { $prefix = $prefixes[0]; } 
			$count = $album->getListbyPrefix($prefix);
		}
	}
	?>
<!--	<h1>Albums</h1> -->
	<?php
	if(($count)||($type != "artist")) { ?>
	<div id="album_list">
	<p><?= $count ?> albums</p>
	<?php if(isset($prefixes)) {
		if($CONF['use_rewrite']) { $join = "?"; } else { $join = "&"; } 
		?>
		<p>Browse:
		<?php
		foreach($prefixes as $prefix) print "&#149;&nbsp;<a href=\"" . browse_link("album") ."${join}prefix=$prefix\">$prefix</a> ";
		?>
		</p>
		<p><a href="<?= $CONF['url'] ?>/list.php">View All</a></p>
		<?php
	}
	?>
	<?php
	while($album->getNext()) {
		$album->displayThumb();
		$keywords[] = $album->name;
	}
	?>
	</div>
	<br clear="all">
	<?php } ?>
<?php
if(($type == "artist")&&(isset($id))) {
	?>
	<h2>Tracks by <?= $typeObj->name ?></h2>
	<ul>
	<?php
	$track = new track();
	$count = $track->getList("where artist_id=$typeObj->id");
	while($track->getNext()) {
		$track_album = new album();
		$track_album->get($track->album_id);
		?>
		<li><?= $track->name ?> on <a href="<?= album_link($track_album->id,$track_album->name) ?>"><?= $track_album->DN ?></a></li>
		<?php
		$keywords[] = $track->DN;
	}
	?>
	</ul>
	<?
}
?>
<?php

$page = ob_get_contents();
ob_end_clean();
$page = str_replace("@page_title@",$page_title,$page);
$page = str_replace("@page_keywords@",implode(", ",$keywords),$page);
print $page;

?>
<?php include("footer.inc.php"); ?>
