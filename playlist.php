<?php
require("include/common.php");

$track = new track();
if(isset($_REQUEST['track_id'])) {
	$track->get($_REQUEST['track_id']);
	?>
	<player showDisplay="no" showPlaylist="no" autoStart="yes">
		<song path="<?= $CONF['media_url'] ?>/preview.php?track_id=<?= $track->id ?>&amp;nofade=1" title="<?= htmlspecialchars($track->name) ?>" />
	<?php
}
else {
	$track->getTrackListings($_REQUEST['album_id']);
	?>
	<player showDisplay="yes" showPlaylist="yes" autoStart="yes">
	<?php
	while($track->getNext()) { ?>
		<song path="<?= $CONF['media_url'] ?>/preview.php?track_id=<?= $track->id ?>" title="<?= htmlspecialchars($track->name) ?>" />
	<?php
	}
	?>
<? } ?>
</player>
