<?php
include('zc-session-admin.php');
$m_id="";
$result="";
$txnst="";
if(isset($_POST['order']))
{
	$m_id=$_POST['order'];
}
if(isset($_POST['txnst']))
{
	$txnst=$_POST['txnst'];
}
if($m_id!="" && $txnst!="" && $m_id>58292)
{
	$txn_status=$txnst;
	include_once('zf-TxnSource5DmtApi.php');
	$arr=order_clientid_clienttypeid_by_mid25($m_id);
	$order=$arr[0];
	$clientid=$arr[1];
	$clienttype=$arr[2];
	$txn_status=-4;
	
	$client_db="$bankapi_child"."$clienttype"."_"."$clientid"."_txn";
	//update tid for client_child
	mysql_query("update $client_db.txn_mt_child set order_status='$txn_status' where order_id='$order';");
	
	//update response/tid for admin
	mysql_query("update $bankapi_parent_txn.txn_mt set mmt_status='$txn_status' where mmt_id='$m_id';");
}
echo json_encode("");
?>