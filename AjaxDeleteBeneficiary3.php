<?php
include('zc-session-admin.php');
$sender="";
$receiver="";
$acc="";
$result="";
if(isset($_POST['sender']))
{
	$sender=$_POST['sender'];
}
if(isset($_POST['receiver']))
{
	$receiver=$_POST['receiver'];
}
if(isset($_POST['acc']))
{
	$acc=$_POST['acc'];
}
if($sender!="" && $receiver!="" && $acc!="")
{
	include_once('zf-TxnSource3DmtApi.php');
	$result=remove_beneficiary2($sender,$receiver);
	include_once('zf-WalletTxnDmt.php');
	delete_beneficiary3_in_db($sender,$acc);
}
echo json_encode($result);
?>