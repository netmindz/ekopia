<?php include("include/common.php"); ?>
<?
$user->checkLogin();
$type_name = $_REQUEST['type'];
$type_perm = "user_" . $type_name;

$fields = array(
	'artist'=>array("name","website","image_id","summary","myspace","facebook_fanid","facebook_profileid"),
	'label'=>array("name","website","image_id","summary"),
);

?>
<?php include("header.inc.php"); ?>
<?php

$type = new $type_name();
$type->get($_GET['id']);

$perm = new $type_perm();
if(!$perm->check($type->id, $user)) {
	?>
	<p class="error">You do not have permission to edit <?= $type_name ?> <?= $type->name ?>. If you represent the <?= $type->name ?> <?= $type_name ?> then please email <?= $CONF['shop_email'] ?></p>
	<?
}
elseif(isset($_POST['values'])) {
	$type->setProperties($_POST['values']);
	$type->update();
	?>
	<h2>Update Complete</h2>
	<p><a href="<?= browse_link($type_name,$type->id,$type->name) ?>">Back to <?= $type->name ?></a></p>
	<?
}
else {
	?>
	<form method="post" enctype="multipart/form-data">
	<input type="hidden" name="id" value="<?= $type->id ?>">
	<input type="hidden" name="type" value="<?= $type_name ?>">
	<table>
	<?
	foreach($fields[$type_name] as $key) {
		?>
	<tr>
		<th><?= $type->createFormLabel($key,"values[]") ?></th>
		<td><?= $type->createFormObject($key,"values[]",$type->$key,'-None-', " class=\"inputbox\"") ?></td>
	</tr>
	<? } ?>
	<tr>
		<td>&nbsp;</td>
		<td><input type="submit" value=" Update "></td>
	</tr>
	</table>
	</form>
	<?
}

?>
<?php include("footer.inc.php"); ?>

