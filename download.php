<?php
require("include/common.php");

if($_SERVER['HTTP_HOST'] != "localhost") exit("debug only");

$track = new track();
$track->get($_REQUEST['track_id']);
$error = $track->getDownload($_REQUEST['type']);
if($error) {
	?>
	<h2>ERROR</h2>
	<p><?= $error ?></p>
	<?php
}
?>
