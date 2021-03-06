<?php

require_once("/home/www/codebase/database.php");
require_once("/home/www/codebase/premier_common.php");
if(isset($is_admin_area)) {
	require("../include/site_config.inc.php");
}
else {
	require("include/site_config.inc.php");
}
require("artist.class.php");
require("album.class.php");
require("label.class.php");
require("track.class.php");
require("basket.class.php");
require("basket_item.class.php");
require("order.class.php");
require("image.class.php");
require("line_item.class.php");
require("page.class.php");
require("tag.class.php");
require("album_tag.class.php");
require("track_tag.class.php");
require("product.class.php");
require("type.class.php");
require("user.class.php");
require("user_label.class.php");
require("user_artist.class.php");
require("product_variation.class.php");


$user = new user();
if(count($_COOKIE)) {
	session_start();
	if(isset($_SESSION['user_id'])) {
		$user->get($_SESSION['user_id']);
	}
}

function browse_link($type,$id="",$name="")
{
        global $CONF;
        if($CONF['use_rewrite']) {
                if($id) {
                        return($CONF['url']."/browse/$type/".urlencode($name)."/$id");
                }
                else {
                        return($CONF['url']."/browse/$type");
                }
        }
        else {
                if($id) {
                        return($CONF['url']."/browse.php?type=$type&amp;id=$id");
                }
                else {
                        return($CONF['url']."/browse.php?type=$type");
                }
        }
}

function album_link($album_id,$name)
{
	global $CONF;
	if($CONF['use_rewrite']) {
		return($CONF['url']."/album/$album_id/" . urlencode($name));
	}
	else {
		return($CONF['url']."/album.php?album_id=".$album_id);
	}
}

function format_price($price)
{
	return sprintf("%1.2f",$price);
}

function page_title($title)
{
	?>
	<div class="side-style-h3">
		<h3 class="module-title"><?= $title ?></h3>
	</div>
	<?php
}

?>
