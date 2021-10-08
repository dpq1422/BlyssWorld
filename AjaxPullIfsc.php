<?php
include('zc-session-admin.php');
$bid="";
$ifsc="";
if(isset($_POST['bid']))
{
	$bid=$_POST['bid'];
}
if($bid!="")
{
	include_once('zf-TxnSource1DmtApi.php');
	$ifsc=show_bank_ifsc_availability($bid);
}
echo json_encode($ifsc);
?>