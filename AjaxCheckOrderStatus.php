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
	include_once('zf-TxnSource1DmtApi.php');
	$arr=order_clientid_clienttypeid_by_mid($m_id);
	$order=$arr[0];
	$clientid=$arr[1];
	$clienttype=$arr[2];
	$resulted_data=fund_transfer_order_status($m_id);
	$resulted_response=$resulted_bankrefno=$resulted_tid=$resulted_message=$resulted_type_id=$resulted_status_id=$resulted_status=$resulted_status_desc="";
	$resulted_response=$resulted_data[0];
	$resulted_bankrefno=$resulted_data[1];
	$resulted_tid=$resulted_data[2];
	$resulted_message=$resulted_data[3];
	$resulted_type_id=$resulted_data[4];
	$resulted_status_id=$resulted_data[5];
	$resulted_status=$resulted_data[6];
	$resulted_status_desc=$resulted_data[7];
	if($resulted_status_id==0 && ($resulted_type_id==70 || $resulted_type_id==325))
	{
		if($resulted_status==0)
			$txn_status=2;//success
		else if($resulted_status==1)
			$txn_status=-4;//failed and refund by our otp
		else if($resulted_status==2 && $resulted_status_desc=="Response Awaited")
			$txn_status=3;//Response Awaited
		else if($resulted_status==2 && $resulted_status_desc=="Initiated")
			$txn_status=1;//Initiated
		else if($resulted_status==3)
			$txn_status=4;//Refund Pending
		else if($resulted_status==4)
			$txn_status=5;//Refunded
		else if($resulted_status==5)
			$txn_status=3;//Hold
		else if($resulted_status==8)
			$txn_status=3;//Scheduled
	}
	if($txn_status!=$txnst)
	{
		//update tid for client_child//bankapi_child1_1001_txn
		require('zc-gyan-info-admin.php');
		require('zc-commons-admin.php');
		$bankapi_child_txn="$bankapi_child".$clienttype."_".$clientid."_txn";
		mysql_query("update $bankapi_child_txn.txn_mt_child set tid='$resulted_tid', updated_on='$datetime_datetime', bank_ref_no='$resulted_bankrefno', order_status='$txn_status' where order_id='$order';");
		
		//update response/tid for admin
		mysql_query("update $bankapi_parent_txn.txn_mt set response='$resulted_response', updated_on='$datetime_datetime', bank_ref_no='$resulted_bankrefno', tid='$resulted_tid', response_message='$resulted_message', mmt_status='$txn_status' where mmt_id='$m_id';");
	}
	else
	{
		mysql_query("update $bankapi_parent_txn.txn_mt set response='$resulted_response' where mmt_id='$m_id';");
	}
}
echo json_encode($resulted_data);
?>