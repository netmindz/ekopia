<?php
require("../include/site_config.inc.php");
$is_admin_area = true;
require("../include/common.php");
?>
<html>
<head>
<title>Quick Tag</title>
</head>
<body>
<? include("nav.inc"); ?>
<?
if(isset($_POST['track_id'])) {
	$track = new track();
	$track->get($_POST['track_id']);
	$track->setProperties(array('tag_FKL'=>$_POST['tags']));
	$track->update();
	print "<p>Track $track->DN tagged</p>\n";
}
if(isset($_POST['offset'])) {
	$offset = $_POST['offset'];
}
else {
	$offset = 0;
}
?>
<?
$track = new track();
$track->getUnTaggedList($offset);
$track->getNext();
?>
<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="280" height="280" id="player" align="middle">
<PARAM NAME="wmode" VALUE="transparent"> <param name="allowScriptAccess" value="sameDomain" /><param name="movie" value="<?= $CONF['media_url'] ?>/mp3player.swf?playlist=<?= $CONF['media_url'] ?>/playlist.php?track_id=<?= $track->id ?>" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" /><embed src="<?= $CONF['media_url'] ?>/mp3player.swf?playlist=<?= $CONF['media_url'] ?>/playlist.php?track_id=<?= $track->id ?>" quality="high" bgcolor="#ffffff" width="280" height="280" name="player" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" wmode="transparent" /></object>
<form method="post">
<input type="hidden" name="track_id" value="<?= $track->id ?>"/>
<input type="text" name="offset" value="<?= $offset ?>" />
<table>
<tr>
	<th><?= $track->DN ?></th>
	<td><?= $track->createFormObject("tag_FKL","tags") ?></td>
</tr>
	<?
?>
</table>
<input type="submit" value=" Update Track ">
</form>
<form  method="post" name="skip">
<input type="hidden" name="offset" value="<?= ($offset+1) ?>" />
<input type="text" name="skip" value="1" onChange="document.forms.skip.offset.value=document.forms.skip.skip.value+<?= $offset ?>"/>
<input type="submit" value=" Skip ">
</form>
