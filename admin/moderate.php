<?php
require("../include/site_config.inc.php");
$is_admin_area = true;
require("../include/common.php");
?>
<html>
<head>
<title>Moderate</title>
</head>
<body>
<? include("nav.inc"); ?>
<?php
if(!isset($_REQUEST['offset'])) {
	$offset = 0;
}
else {
	$offset = $_REQUEST['offset'];
}
settype($offset,"int");

if(isset($_POST['artist_id'])) {
	$artist = new artist();
	$artist->get($_POST['artist_id']);
	$artist->setProperties($_POST['artist']);
	$artist->update();
}

$artist = new artist();
$count = $artist->getList("where published != 'yes'","","limit $offset,1");
$artist->getNext();

if($count) {
?>
<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="280" height="280" id="player" align="middle">
<PARAM NAME="wmode" VALUE="transparent"> <param name="allowScriptAccess" value="sameDomain" /><param name="movie" value="<?= $CONF['media_url'] ?>/mp3player.swf?playlist=<?= $CONF['media_url'] ?>/playlist.php?artist_id=<?= $artist->id ?>" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" /><embed src="<?= $CONF['media_url'] ?>/mp3player.swf?playlist=<?= $CONF['media_url'] ?>/playlist.php?artist_id=<?= $artist->id ?>" quality="high" bgcolor="#ffffff" width="280" height="280" name="player" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" wmode="transparent" /></object>
<form method="post">
<input type="hidden" name="artist_id" value="<?= $artist->id ?>"/>
<input type="hidden" name="offset" value="<?= $offset ?>" />
<table>
<tr>
	<th><?= $artist->DN ?></th>
	<td><?= $artist->createFormObject("published","artist[]") ?></td>
</tr>
	<?
?>
</table>
<input type="submit" value=" Update Aritst ">
</form>
<form  method="post" name="skip">
<input type="hidden" name="offset" value="<?= ($offset+1) ?>" />
Skip: <input type="text" size="2" name="skip" value="1" onChange="document.forms.skip.offset.value=document.forms.skip.skip.value+<?= $offset ?>"/> artists
<input type="submit" value=" Skip ">
</form>
<?php } else { ?>
<p>No artists to moderate</p>
<?php } ?>
