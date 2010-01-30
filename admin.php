<?php include("include/common.php"); ?>
<?
$user->checkLogin();
?>
<?php include("header.inc.php"); ?>
<h1>Artist/Label Admin Area</h1>
<p>This is the admin area from which you can administer items associated to you</p>
<?php
foreach(array("label","artist") as $type) {
	$perm = "user_$type";
	$typelist = new $perm();
	if($typelist->getUserList($user)) {
		?>
		<h2><?= ucwords($type) ?>s</h2>
		<ul>
		<?php
		while($typelist->getNext()) {
			$get = "get" . ucwords($type);
			$typeObj = $typelist->$get();
			?>
			<li><a href="<?= $CONF['url'] ?>/edit.php?id=<?= $typeObj->id ?>&type=<?= $type ?>"><?= $typeObj->DN ?></a></li>
			<?
		}
		?>
		</ul>
		<?php
	 }
}

$album = new album();
if($album->getUserList($user)) {
	?>
	<h2>Albums</h2>
	<ul>
	<?php
	while($album->getNext()) {
		?>
		<li><a href="admin-album.php?id=<?= $album->id ?>"><?= $album->DN ?></a> - <?php if($album->download_price) { ?>&pound; <?= format_price($album->download_price) ?><?php } else { ?>No whole-album Download price<?php } ?><?php if($artist->published != 'yes') print " Not yet published"; ?></li>
			<?
	}
	?>
	</ul>
	<?php
}
?>
<h2>Reports</h2>
<ul>
	<li><a href="admin-report.php">Download Sales</a></li>
</ul>
<?php include("footer.inc.php"); ?>

