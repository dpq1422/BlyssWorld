<?php
include('zc-session-admin.php');
$sender="";
$receiver="";
$result="";
if(isset($_POST['sender']))
{
	$sender=$_POST['sender'];
}
if(isset($_POST['receiver']))
{
	$receiver=$_POST['receiver'];
}
if($sender!="" && $receiver!="")
{
	include_once('zf-TxnSource1DmtApi.php');
	$result=remove_beneficiary($sender,$receiver);
}
echo json_encode($result);
?>