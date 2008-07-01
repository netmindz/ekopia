<?php 
header("Content-Type: text/xml");

print "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n
<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";

require("include/common.php");
	$album = new album();
	$album->getList("where price > 0 and stock_count > 0");
	while($album->getNext()) {
		$description = htmlspecialchars(strip_tags(ereg_replace("[^ -~]"," ",$album->summary)));
		$artist = new artist();
		$artist->get($album->artist_id);
		print "\t<url>\n\t\t<loc>".$CONF['url'] . album_link($album->id,$album->name)."</loc>\n\t</url>\n";
	}
print "</urlset>\n";
?>
