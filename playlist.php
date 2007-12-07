<?php
require("include/common.php");

$track = new track();
$track->getTrackListings($_REQUEST['album_id']);
?>
<player showDisplay="yes" showPlaylist="yes" autoStart="yes">
<?php
while($track->getNext()) { ?>
	<song path="preview.php?track_id=<?= $track->id ?>" title="<?= $track->name ?>" />
<?php
}
?>
</player>
