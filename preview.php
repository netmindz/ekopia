<?php
require("include/common.php");

$track = new track();
$track->get($_REQUEST['track_id']);
$error = $track->getPreview();
if($error) {
	?>
	<h2>ERROR</h2>
	<p><?= $error ?></p>
	<?php
}
?>
