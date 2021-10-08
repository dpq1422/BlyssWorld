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
if($order!="" && $txnst!="" && $order>10000000)
{
	$rc_stat=$txnst;
	include_once('zf-WalletTxnRc.php');
	$m_id=mid_by_order($order);
	$result_id=result_by_mid($m_id);
	$source=source_by_mid($m_id);
	$tid=0;
	$transid=0;
	$reponsecode=0;
	if($source==6)
	{
		include_once('zf-TxnSource4RcApi.php');
		if($result_id==0 || $result_id=="" || $result_id=="0")
		$resulted_data=check_order_status2($m_id);
		else
		$resulted_data=check_order_status($result_id);
		require('zc-gyan-info-admin.php');
		require('zc-commons-admin.php');
		
		$results= json_decode($resulted_data, true);
		$result=$results['data'][0];
		
		$reponsecode=$result['status'];
		$tid=0;
		$tid=$result['TransId'];
		$transid=0;
		if(isset($result['orderId']))
			$transid=$result['orderId'];
		if(count($transid)==0 || $transid=="N" || $transid=="NA")
			$transid=0;
		
		//if($tid==0)
			//$tid=$transid;

		$rc_stat=1;//initiated
		if($reponsecode=="SUCCESS")
			$rc_stat=2;//success
		else if($reponsecode=="PENDING")
			$rc_stat=3;//in progress
		else if($reponsecode=="FAILED")
			$rc_stat=4;// failed
		if($resulted_data=='{"data":[{"orderId":0,"status":0,"mobile":0,"amount":0,"error_code":"112","TransId":0,"service":0,"reqTime":0,"bal":0,"resText":"Invalid order id"}]}')
			$rc_stat=4;// failed
		if(isset($resulted_data))
		{
			//update tid for client_child
			$qry_a="update $bankapi_child_txn.txn_rc set tid='$tid', rc_status='$rc_stat' where rc_id='$order';";
			mysql_query($qry_a);
			
			//update response/tid for admin
			$qry_b="update $bankapi_parent_txn.txn_rc set response='$resulted_data', tid='$tid', result='$transid', mrc_status='$rc_stat' where mrc_id='$m_id';";
			mysql_query($qry_b);
		}
	}
}
echo json_encode("");
?>