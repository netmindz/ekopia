<?php
require("include/common.php");

$track = new track();
$fade = true;
if(isset($_REQUEST['nofade'])) {
	$fade = false;
}
$track->get($_REQUEST['track_id']);
$error = $track->getPreview($fade);
if($error) {
	?>
	<h2>ERROR</h2>
	<p><?= $error ?></p>
	<?php
}
?>
