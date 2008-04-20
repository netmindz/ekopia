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
		print $typeObj->summary;
		$keywords[] = $typeObj->DN;
		?>
		<div class="edit">[&nbsp;<a href="edit.php?id=<?= $id ?>&amp;type=<?= $type ?>">edit</a>&nbsp;]</div>
		<?
	}
	else {
		$page_title = "Browse " . ucwords($type) . "s @ inSpiral shop";
		if($type != "album") {
			$typeObj = new $type();
			$count = $typeObj->getList();
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
