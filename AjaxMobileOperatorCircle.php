<?php
include('zc-session-admin.php');
$mobile="";
$resulted_data=$result="";
if(isset($_POST['mobile']))
{
	$mobile=$_POST['mobile'];
}
if($mobile!="")
{
	include_once('zf-TxnSource4RcApi.php');
	$resulted_data=check_mobile($mobile);
	$resulted_data=json_decode($resulted_data, true);
	$operator=$resulted_data['data']['service'];
	$circle=$resulted_data['data']['location'];
	$circle_id=$resulted_data['data']['circleId'];
	$result=$operator."@".$circle."@".$circle_id;
}
echo json_encode("$result");
?>