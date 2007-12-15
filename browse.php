<?php
require("include/common.php");
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
		$album->getListByType($type,$_REQUEST['id']);
		$typeObj = new $type();
		$typeObj->get($_REQUEST['id']);
		?>
		<h2><?= ucwords($type) ?> - <?= $typeObj->DN ?></h2>
		<?php	
	}
	else {
		if($type != "album") {
			$typeObj = new $type();
			$typeObj->getList();
			?>
			<h2><?= ucwords($type) ?>s</h2>
			<ul>
			<?php
			while($typeObj->getNext()) { ?>
				<li><a href="browse.php?type=<?= $type ?>&id=<?= $typeObj->id ?>"><?= $typeObj->DN ?></a></li>
			<?php
			}	
		}
		else {
			$album->getList();
		}
	}
	?>
<!--	<h1>Albums</h1> -->
	<div id="album_list">
	<?php
	while($album->getNext()) {
		$album->displayThumb();
	}
	?>
	</div>
<?php include("footer.inc.php"); ?>
