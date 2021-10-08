<?php
include('zc-session-admin.php');
$receiver="";
$result="";
if(isset($_POST['receiver']))
{
	$receiver=$_POST['receiver'];
}
if($receiver!="")
{
	include_once('zf-TxnSource1DmtApi.php');
	$result=check_bank_transfer_method($receiver);
}
echo json_encode($result);
?>