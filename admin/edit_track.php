<?
require_once("../include/site_config.inc.php");
require_once("../include/common.php");

$track = new track();
$track->get(1);

if(isset($_POST['track'])) {
	$track->setProperties($_POST['track']);
	if($track->update()) {
		print "<h2>Track updated</h2>\n";
	}
}

$track->get(1);

?>
<form method="post">
<table>
<?
foreach($track->_field_descs as $field_name=>$field_details) {
	if(!in_array($field_name,array("id"))) {
		?>
<tr>
	<th><?= $track->createFormLabel($field_name,"track[]"); ?></th>
	<td><?= $track->createFormObject($field_name,"track[]"); ?></td>
</tr>
		<?
	}
}

?>
<tr>
	<td>&nbsp;</td>
	<td><input type="submit" value=" Save "></td>
</tr>
</table>
</form>
