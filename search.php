<?php require("include/common.php"); ?>
<?php include("header.inc.php"); ?>
<?php page_title("Search") ?>
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
		<p>No Album matches your search</p>
		<?php
	}
	?>
	<br clear="left"/> 
	<?php

	$artist = new artist();
	if($artist->search($_REQUEST['keyword'],array('name'),null,"where published='yes'")) {
		?>
		<h2>Artists</h2>
		<ul>
		<?php
		while($artist->getNext()) { 
			?><li><a href="<?= browse_link("artist",$artist->id,$artist->DN) ?>"><?= $artist->DN ?></a></li><?
		}
		?>
		</ul>
		<?
	}
	else 	{
		?>
		<p>No Artist matches your search</p>
		<?php
	}

	$label = new label();
	if($label->search($_REQUEST['keyword'],array('name'))) {
		?>
		<h2>Labels</h2>
		<ul>
		<?php
		while($label->getNext()) { 
			?><li><a href="<?= browse_link("label",$label->id,$label->DN) ?>"><?= $label->DN ?></a></li><?
		}
		?>
		</ul>
		<?
	}
	else 	{
		?>
		<p>No Label matches your search</p>
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
		<p>No Track matches your search</p>
		<?php
	}
	?>
	<br clear="left"/> 
	<?php
	$product = new product();
	if($product->search($_REQUEST['keyword'],array('name'))) {
		?>
		<h2>Products</h2>
		<?php
		while($product->getNext()) {
			if($product->published == "yes") {
				$product->displayThumb();
			}
		}
	}
	else 	{
		?>
		<p>No product matches your search</p>
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

