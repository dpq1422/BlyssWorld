<?php
require('zc-session-admin.php');
$tpin1="";
$tpin2="";
$result=0;

if(isset($_POST['tpin']))
$tpin1=$_POST['tpin'];

$tpin2=$_SESSION['logged_tpin'];
if($tpin1==$tpin2)
	$result=1;
else
	$result=0;
echo json_encode($result);
?>