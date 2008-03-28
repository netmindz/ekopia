<?php
require("../include/site_config.inc.php");
require("/home/www/codebase/database.php");
require("/home/www/codebase/fpdf.php");
$reports = array();

$reports['album_list'] =  array("title"=>"Album List","sql"=>"select name,price,stock_count from albums order by name");

if(isset($_POST['report'])) {
	$report = $_POST['report'];
	$sql = $reports[$report]['sql'];
	$title= $reports[$report]['title'];
	require("/home/www/codebase/premier_report_engine.php");
}
else { ?>
<html>
<head>
<title>Reports</title>
</head>
<body>
<? include("nav.inc"); ?>
<form method="post">
<select name="report">
<?
foreach($reports as $report=>$details) { 
	print "<option value=\"$report\">" . $details['title'] . "</option>\n";
}
?>
</select>
<input type="submit" value=" Run Report ">
</form>

<?
}
?>

