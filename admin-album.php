<?php include("include/common.php"); ?>
<?
$user->checkLogin();

$type = new album();
$type->get($_GET['id']);

if($album->user_id != $user->id) {
	exit("permission to album denied");
}
?>
<?php include("header.inc.php"); ?>
<?php
if(isset($_POST['values'])) {
	$type->setProperties($_POST['values']);
	$type->update();
	?>
	<h2>Update Complete</h2>
	<p><a href="<?= browse_link($type_name,$type->id,$type->name) ?>">Back to <?= $type->name ?></a></p>
	<?
}
else {
	?>
	<h1>Album Update</h1>
	<form method="post" enctype="multipart/form-data">
	<input type="hidden" name="id" value="<?= $type->id ?>">
	<table>
	<?
	foreach(array("name","release_year","label_reference","download_price","image_id","summary","tag_FKL") as $key) {
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
<p><a href="admin.php">Back to Admin Area</a></p>
<?php include("footer.inc.php"); ?>

