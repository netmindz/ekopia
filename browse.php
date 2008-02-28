<?php
require("include/common.php");

$page_title="@page_title@";
$page_keywords="@page_keywords@";
$keywords = array();
ob_start();

?>
<?php include("header.inc.php"); ?>

<?php
if((isset($_REQUEST['type']))&&(in_array($_REQUEST['type'],array('artist','album','label',"type")))) {
	$type = $_REQUEST['type'];
}
else {
	$type = "album";
}


	$album = new album();
	if(isset($_REQUEST['id'])) {
		$count = $album->getListByType($type,$_REQUEST['id']);
		$typeObj = new $type();
		$typeObj->get($_REQUEST['id']);
		?>
		<h2><?= ucwords($type) ?> - <?= $typeObj->DN ?></h2>
		<?php
		$page_title = ucwords($type) . " - " . $typeObj->DN;
		print $typeObj->summary;
		$keywords[] = $typeObj->DN;
	}
	else {
		$page_title = "Browse " . ucwords($type);
		if($type != "album") {
			$typeObj = new $type();
			$count = $typeObj->getList();
			?>
			<h2><?= ucwords($type) ?>s</h2>
			<p><?= $count ?> found</p>
			<ul>
			<?php
			while($typeObj->getNext()) { ?>
				<li><a href="browse.php?type=<?= $type ?>&id=<?= $typeObj->id ?>"><?= $typeObj->DN ?></a></li>
				<?php
				$keywords[] = $typeObj->DN;
			}	
		}
		else {
			$count = $album->getList();
		}
	}
	?>
<!--	<h1>Albums</h1> -->
	<div id="album_list">
	<p><?= $count ?> albums</p>
	<?php
	while($album->getNext()) {
		$album->displayThumb();
		$keywords[] = $album->name;
	}
	?>
	</div>
	<br clear="all">
<?php
if($type == "artist") {
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
		<li><?= $track->DN ?> on <a href="album.php?album_id=<?= $track_album->id ?>"><?= $track_album->DN ?></a></li>
		<?php
		$keywords[] = $track_album->DN;
	}
	?>
	</ul>
	<?
}
?>
<?php

$page = ob_get_contents();
ob_end_clean();
print str_replace("@page_title@",$page_title,$page);
print str_replace("@page_keywords@",implode(",",$keywords),$page);

?>
<?php include("footer.inc.php"); ?>
