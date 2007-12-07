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
require("classes/image.php");

if(count($_COOKIE)) session_start();

?>
