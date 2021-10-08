<?php
include_once('zc-session-admin.php');
$field="";
if(isset($_POST['field']))
{
	include_once('zf-Sonar.php');
	$field=mysql_real_escape_string($_POST['field']);
	rd3($field);
}
echo json_encode("");
?>