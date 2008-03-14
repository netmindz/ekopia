<?php include("include/common.php"); ?>
<?
$page_title="@page_title@";
$page_keywords="@page_keywords@";
$keywords = array();
ob_start();
?>
<?php include("header.inc.php"); ?>
<?php

if(isset($_REQUEST['id'])) {
	$id = $_REQUEST['id'];
}
else {
	$id = 0;
}

$tag = new tag();
if(!$id) {
	?>
	<h1>Tags</h1>
	<ul>
	<?
	$page_title = "Tags";
	$tag->getList();
	while($tag->getNext()) {
		$keywords[] = $tag->DN . " albums and tracks";
		?>
		<li><a href="tags.php?id=<?= $tag->id ?>"><?= $tag->DN ?></a></li>
		<?
	}
	?>
	</ul>
	<?
}
else {
	$tag->get($id);
	$page_title = $tag->DN;
	$keywords[] = $tag->DN;
	?>
	<h1><?= $tag->DN ?></h1>
	<div id="albm_list">
	<?
	$atag = new album_tag();
	$atag->getList("where tag_FK=".$tag->id,"order by rand()");
	while($atag->getNext()) {
		$keywords[] = $album->name;
		$album = new album();
		$album->get($atag->album_id);
		$album->displayThumb();
	}
	?>
	</div>
	<p><a href="tags.php">Back to tags</a></p>
	<?
}
?>
	

<?php include("footer.inc.php"); ?>
<?
$page = ob_get_contents();
ob_end_clean();
$page = str_replace("@page_title@",$page_title,$page);
print str_replace("@page_keywords@",implode(", ",$keywords),$page);
?>
