<?php
include('zc-session-admin.php');
$order="";
$result="";
$txnst="";
if(isset($_POST['order']))
{
	$order=$_POST['order'];
}
if(isset($_POST['txnst']))
{
	$txnst=$_POST['txnst'];
}
if($order!="" && $txnst!="" && $order>0)//IN
{
	$txn_status=$txnst;
	include_once('zf-WalletTxnDmt.php');
	$m_id=mid_by_order($order);
	$type=type_by_mid($m_id);
	$amt=amt_by_mid($m_id);
	include_once('zf-TxnSource3DmtApi.php');
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
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	if($resulted_message=="Invalid Client Reference No." && $type==2 && $amt<=5)
		$txn_status=-4;
	
	//if($txn_status!=$txnst)
	{
		//update tid for client_child
		mysql_query("update $bankapi_child_txn.txn_mt_child set tid='$resulted_tid', updated_on='$datetime_datetime', bank_ref_no='$resulted_bankrefno', order_status='$txn_status' where order_id='$order';");
		
		//update response/tid for admin
		mysql_query("update $bankapi_parent_txn.txn_mt set response='$resulted_response', updated_on='$datetime_datetime', bank_ref_no='$resulted_bankrefno', tid='$resulted_tid', response_message='$resulted_message', mmt_status='$txn_status' where mmt_id='$m_id';");
	}
	//else
	{
		//mysql_query("update $bankapi_parent_txn.txn_mt set response='$resulted_response' where mmt_id='$m_id';");
	}
}
echo json_encode("$resulted_response");
?>