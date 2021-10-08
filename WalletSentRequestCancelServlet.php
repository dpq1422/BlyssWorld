<?php
$rid="";
if(isset($_REQUEST['rid']))
{
	$rid=$_REQUEST['rid'];
}
if($rid!="")
{
	include('zc-common-admin.php');
	include('zc-session-admin.php');
	mysql_query("update $bankapi_parent_wallet.requests set request_status=4 WHERE request_id = '$rid';");
}
header("location: WalletSentRequestsServlet");
?>