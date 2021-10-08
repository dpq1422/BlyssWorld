<?php
include('zc-session-admin.php');
$type="";
$operator="";
$circle="";
$resulted_data=$result="";
if(isset($_POST['type']))
{
	$type=$_POST['type'];
}
if(isset($_POST['operator']))
{
	$operator=$_POST['operator'];
}
if(isset($_POST['circle']))
{
	$circle=$_POST['circle'];
}
if($type!="" && $operator!="" && $circle!="")
{
	include_once('zf-TxnSource4RcApi.php');
	$resulted_data=check_plan($type,$operator,$circle);
	/*
	$resulted_data=json_decode($resulted_data, true);
	$operator=$resulted_data['data']['service'];
	$circle=$resulted_data['data']['location'];
	$circle_id=$resulted_data['data']['circleId'];
	$result=$operator."@".$circle."@".$circle_id;
	*/
}
echo json_encode("$resulted_data");
?>