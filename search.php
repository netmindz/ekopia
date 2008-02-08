<?php require("include/common.php"); ?>
<?php include("header.inc.php"); ?>
<h1>Search</h1>
<?
if($_REQUEST['keyword']) {
	$album = new album();
	if($album->search($_REQUEST['keyword'],array('name'))) {
		?>
		<h2>Albums</h2>
		<?php
		while($album->getNext()) { 
			$album->displayThumb();
		}
	}
	else 	{
		?>
		<p>No Albums matches your search</p>
		<?php
	}
	?>
	<br clear="all"/>
	<?php

	$artist = new artist();
	if($artist->search($_REQUEST['keyword'],array('name'))) {
		?>
		<h2>Artists</h2>
		<ul>
		<?php
		while($artist->getNext()) { 
			?><li><a href="browse.php?type=artist&id=<?= $artist->id ?>"><?= $artist->DN ?></a></li><?
		}
		?>
		</ul>
		<?
	}
	else 	{
		?>
		<p>No Artists matches your search</p>
		<?php
	}

	$track = new track();
	if($track->search($_REQUEST['keyword'],array('name'))) {
		?>
		<h2>Tracks</h2>
		<?php
		while($track->getNext()) { 
			$track->displayThumb();
		}
	}
	else 	{
		?>
		<p>No Tracks matches your search</p>
		<?php
	}

}
else {
	?>
	<p class="error">No search term entered</p>
	<?php
}

?>
<?php include("footer.inc.php"); ?>

