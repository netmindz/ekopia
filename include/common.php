<?php

require_once("/home/www/codebase/database.php");
require_once("/home/www/codebase/premier_common.php");
require("include/site_config.inc.php");

require("classes/artist.php");
require("classes/album.php");
require("classes/label.php");
require("classes/track.php");
require("classes/basket.php");
require("classes/basket_item.php");
require("classes/order.php");
require("classes/image.php");
require("classes/line_item.php");
require("classes/page.php");

if(count($_COOKIE)) {
	session_start();
}

function browse_link($type,$id="",$name="")
{
        global $CONF;
        if($CONF['use_rewrite']) {
                if($id) {
                        return("/browse/$type/".urlencode($name)."/$id");
                }
                else {
                        return("/browse/$type");
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
		return("/album/$album_id/" . urlencode($name));
	}
	else {
		return($CONF['url']."/album.php?album_id=".$album_id);
	}
}
?>
