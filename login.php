<?php include("include/common.php"); ?>
<?
$logout = false;

if(isset($_REQUEST['logout'])) {
	$user->logout();	
	$logout = true;
}
else {
	if(!isset($user)) $user = new user();
	$login_failed = false;
	if(isset($_POST['username'])) { 
		if(!$user->login($_POST['username'],$_POST['password'])) {
			$login_failed = true;
			if(isset($_REQUEST['url'])) {
				header("Location: " . $_REQUEST['url']);
				exit();
			}
		}
	}
}
include("header.inc.php");
if($logout) {
	?>
	<h2>Goodbye</h2>
	<p>User logged out</p>
	<p><a href="login.php">Login</a></p>
	<?php
}
elseif(($login_failed)||(!$user->id)) {
?>
<? if($user->lastError) { ?><p class="error"><?= $user->lastError ?></p><? } ?>
<p>If you are artist or label and wish to be able to update your profile, please email shop@inspiralled.net to have an account created for you</p>
<form action="<?= $CONF['url'] ?>/login.php" method="post">
<input type="hidden" name="url" value="<?= $_REQUEST['url'] ?>"/>
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
	<p><a href="admin.php">Admin Area</a></p>
<? } ?>
<?php include("footer.inc.php"); ?>

