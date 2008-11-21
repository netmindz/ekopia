<?php
require("include/common.php");

$track = new track();
$track->getTrackListings($_REQUEST['album_id']);
?>
<player showDisplay="yes" showPlaylist="yes" autoStart="yes">
<?php
while($track->getNext()) { ?>
	<song path="<?= $CONF['media_url'] ?>/preview.php?track_id=<?= $track->id ?>" title="<?= htmlspecialchars($track->name) ?>" />
<?php
}
?>
</player>
