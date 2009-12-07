<?php require("include/common.php"); ?>
<?php
if(isset($_REQUEST['output'])&&($_REQUEST['output'] == "xml")) {
	$xml = true;
	header("Content-Type: text/xml");
	print "<search>\n";
}
else {
	$xml = false;
}

if(!$xml) {
	include("header.inc.php");
	page_title("Search");
}

if($_REQUEST['keyword']) {
	$album = new album();
	if($album->search($_REQUEST['keyword'],array('name'))) {
		if(!$xml) {
			?>
			<h2>Albums</h2>
			<?php
			while($album->getNext()) { 
				$album->displayThumb();
			}
			?>
			<br clear="left"/> 
			<?php
		}
		else {
			while($album->getNext()) {
				print "<result title=\"" . htmlentities($album->DN) . "\" section=\"albums\" href=\"".album_link($album->id,$album->name)."\"/>\n";
			}
		}
	}
	elseif(!$xml) 	{
		?>
		<p>No Album matches your search</p>
		<?php
	}

	$artist = new artist();
	if($artist->search($_REQUEST['keyword'],array('name'),null,"where published='yes'")) {
		if(!$xml) {
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
		else {
			while($artist->getNext()) {
				print "<result title=\"" . htmlentities($artist->DN) . "\" section=\"artists\" href=\"".browse_link("artist",$artist->id,$artist->DN)."\"/>\n";
			}
		}
	}
	elseif(!$xml) 	{
		?>
		<p>No Artist matches your search</p>
		<?php
	}

	$label = new label();
	if($label->search($_REQUEST['keyword'],array('name'))) {
		if(!$xml) {
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
		else {
			while($artist->getNext()) {
				print "<result title=\"" . htmlentities($artist->DN) . "\" section=\"artists\" href=\"".browse_link("label",$label->id,$label->DN)."\" />\n";
			}
		}
	}
	elseif(!$xml) 	{
		?>
		<p>No Labels matches your search</p>
		<?php
	}

	$track = new track();
	if($track->search($_REQUEST['keyword'],array('name'))) {
		if(!$xml) {
			?>
			<h2>Tracks</h2>
			<?php
			while($track->getNext()) { 
				$track->displayThumb();
			}
			?>
			<br clear="left"/> 
			<?php
		}
		else {
			while($track->getNext()) {
				$album = $track->getAlbum();
				print "<result title=\"" . htmlentities($track->DN) . "\" section=\"track\" href=\"".browse_link("album",$album->id,$album->DN)."\"/>\n";
			}
		}
	}
	elseif(!$xml) 	{
		?>
		<p>No Track matches your search</p>
		<?php
	}
	?>
	<?php
	$product = new product();
	if($product->search($_REQUEST['keyword'],array('name'))) {
		if(!$xml) {
			?>
			<h2>Products</h2>
			<?php
			while($product->getNext()) {
				if($product->published == "yes") {
					$product->displayThumb();
				}
			}
		}
		else {
			while($product->getNext()) {
				print "<result title=\"" . htmlentities($product->DN) . "\" section=\"products\" href=\"".$CONF['url'] ."/product.php?id=" . $product->id."\" />\n";
			}
		}
	}
	elseif(!$xml) 	{
		?>
		<p>No product matches your search</p>
		<?php
	}



}
elseif(!$xml) {
	?>
	<p class="error">No search term entered</p>
	<?php
}

?>
<?php
if(!$xml) {
	include("footer.inc.php");
}
else {
	print "</search>\n";
}
 ?>

