<?php include("include/common.php"); ?>
<?
$user->checkLogin();
?>
<?php include("header.inc.php"); ?>
<h1>Artist/Label Admin Area</h1>
<h2>Labels</h2>
<ul>
<?php
$user_label = new user_label();
$user_label->getUserList($user);
while($user_label->getNext()) {
	$label = $user_label->getLabel();
	?>
	<li><?= $label->DN ?></li>
	<?
}
?>
</ul>
<?php include("footer.inc.php"); ?>

