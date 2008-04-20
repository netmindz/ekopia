<?php include("include/common.php"); ?>
<?
if(!isset($user)) $user = new user();
$login_failed = false;
if(isset($_POST['username'])) { 
	if(!$user->login($_POST['username'],$_POST['password'])) {
		$login_failed = true;
	}
}
include("header.inc.php");
if(($login_failed)||(!$user->id)) {
?>
<? if($user->lastError) { ?><p class="error"><?= $user->lastError ?></p><? } ?>
<form action="<?= $CONF['url'] ?>/login.php" method="post">
<table>
<tr>
	<th>Username</th>
	<td><input name="username" type="text" class="inputbox"/></td>
</tr>
<tr>
	<th>Password</th>
	<td><input name="password" type="password" class="inputbox"/></td>
</tr>
<tr>
	<th>&nbsp;</th>
	<td><input type="submit" value=" Login " class="inputbox"/></td>
</tr>
</table>
</form>
<? } else { ?>
	<h2>Welcome</h2>
	<p>Login sucessful</p>
<? } ?>
<?php include("footer.inc.php"); ?>

