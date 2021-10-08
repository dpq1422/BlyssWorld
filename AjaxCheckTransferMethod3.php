<?php
include('zc-session-admin.php');
$ifsc="";
$result="";
if(isset($_POST['ifsc']))
{
	$ifsc=$_POST['ifsc'];
}
if($ifsc!="")
{
	include_once('zf-TxnSource3DmtApi.php');
	$bcode=substr($ifsc,0,4);
	$result=check_bank_transfer_method($bcode);
}
echo json_encode($result);
?>