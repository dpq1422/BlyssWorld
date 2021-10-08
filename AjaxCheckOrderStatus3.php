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
	include_once('zf-TxnSource3DmtApi.php');
	$arr=order_clientid_clienttypeid_by_mid2($m_id);
	$order=$arr[0];
	$clientid=$arr[1];
	$clienttype=$arr[2];//bankapi_child1_1001_txn
	$resulted_data=fund_transfer_order_status2($m_id);//$StatusCode,$Status,$Description,$ASTransCode,$ReferenceNumber,$response
	$resulted_response=$resulted_bankrefno=$resulted_tid=$resulted_message=$resulted_status=$resulted_status_desc="";
	$resulted_response=$resulted_data[5];
	$resulted_bankrefno=$resulted_data[4];
	$resulted_tid=$resulted_data[3];
	$resulted_message=$resulted_data[2];
	$resulted_status=$resulted_data[1];
	$resulted_status_desc=$resulted_data[0];
	if($resulted_status=="SUCCESS")
		$txn_status=2;//success
	else if($resulted_status=="FAILED" || $resulted_status=="REFUND")
		$txn_status=-4;//failed and refund by our otp
	else if($resulted_status=="PENDING")
		$txn_status=3;//Response Awaited
	require_once('zc-gyan-info-admin.php');
	require_once('zc-commons-admin.php');
	if($txn_status!=$txnst)
	{
		//update tid for client_child//
		$bankapi_child_txn="$bankapi_child".$clienttype."_".$clientid."_txn";
		mysql_query("update $bankapi_child_txn.txn_mt_child set tid='$resulted_tid', updated_on='$datetime_datetime', bank_ref_no='$resulted_bankrefno', order_status='$txn_status' where order_id='$order';");
		
		//update response/tid for admin
		mysql_query("update $bankapi_parent_txn.txn_mt set response='$resulted_response', updated_on='$datetime_datetime', bank_ref_no='$resulted_bankrefno', tid='$resulted_tid', response_message='$resulted_status', mmt_status='$txn_status' where mmt_id='$m_id';");
	}
	else
	{
		mysql_query("update $bankapi_parent_txn.txn_mt set response='$resulted_response' where mmt_id='$m_id';");
	}
}
echo json_encode("");
?>