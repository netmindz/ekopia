<?php
session_start();
if(isset($_GET['type'])) $_SESSION['radio_type'] = $_GET['type'];
?>
<html>
<head>
<title>inSpiral Radio</title>
<link href="http://www.inspiralled.net/templates/sp_slim3/css/template_css.css" rel="stylesheet" type="text/css" />
<link href="http://www.inspiralled.net/css/content.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php
if(!isset($_SESSION['radio_type'])) {
	$_SESSION['radio_type'] = "java";
}
if($_SESSION['radio_type'] == "java") {
	?>
	<applet code="jcraft.player.JOrbisPlayer.class"
		    archive="jorbis.jar?2,swing-layout-1.0.3.jar"
		    width="384" height="144" align="baseline">
		    <PARAM NAME="jorbis.player.playonstartup" VALUE="yes">
	</applet>
	<h2>Help</h2>
	<ul>
		<li>You see no player above - you need to install <a href="http://www.java.com/">Java</a> or try our <a href="radio.php?type=flash">Flash radio player</a></li>
		<li>You get some message about security - This is just to say that you wish to open the player, click trust and ok</li>
		<li>Still having issues - Please email <a href="mailto:shop@inspiralled.net">shop@inpiralled.net<a></li>
	</ul>
	<?
}
else { 
	$params = "playlist_url=playlist.xspf&autoload=true&autoplay=true";
	?>
	<object type="application/x-shockwave-flash" width="384" height="15" data="xspf_player_slim.swf?<?= $params ?>">
	<param name="movie" value="xspf_player_slim.swf?<?= $params ?>" />
	<embed src="xspf_player_slim.swf?<?= $params ?>" quality="high" bgcolor="#e6e6e6" width="384" height="15" name="xspf_player" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
	</object>
	<p>Use <a href="radio.php?type=java">inSpiral Radio Player</a></p>
<?
}
?> 
<p>Want inSpiral Radio at your fingertips ? <a href="radio.jnlp">Install inSpiral Radio Player</a></p>
</body>
</html>
