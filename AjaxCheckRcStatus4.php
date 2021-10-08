<?php
include('zc-session-admin.php');
$m_id="";
$rc_stat="";
$txnst="";
if(isset($_POST['order']))
{
	$m_id=$_POST['order'];
}
if(isset($_POST['txnst']))
{
	$txnst=$_POST['txnst'];
}
if($m_id!="" && $txnst!="" && $m_id>10003000)
{
	$txn_status=$txnst;
	include_once('zf-TxnExists.php');
	$arr=show_rc_order_details($m_id);//$client_type,$client_id,$order_id,$source
	include_once('zf-TxnSource4RcApi.php');
	$resulted_data=check_order_status42($m_id);
	
	if($arr[0]!=0 && $arr[1]!=0 && $arr[2]!=0 && $arr[3]==4)
	{
		$order=$arr[2];
		require('zc-gyan-info-admin.php');
		require('zc-commons-admin.php');
		
		$tid=0;
		$transid=0;
		$reponsecode=0;
		
		$results=json_decode($resulted_data, true);
		$result=$results['data'][0];
	
		$reponsecode=$result['status'];
		$tid=$result['TransId'];
		if(isset($result['orderId']))
			$transid=$result['orderId'];
		if(count($transid)==0 || $transid=="N" || $transid=="NA")
			$transid=0;

		if($reponsecode==="SUCCESS")
		{
			$rc_stat=2;//success
		}
		if($reponsecode=="PENDING")
		{
			$rc_stat=3;//in progress
		}
		if($reponsecode=="FAILED" || $reponsecode=="0")
		{
			$rc_stat=4;// failed
		}
		if(isset($resulted_data))
		{
			$bankapi_childs=$bankapi_child.$arr[0]."_".$arr[1]."_txn";
			//update tid for client_child
			$qry_a="update $bankapi_childs.txn_rc set tid='$tid', rc_status='$rc_stat' where rc_id='$order';";
			mysql_query($qry_a);
			
			//update response/tid for admin
			$qry_b="update $bankapi_parent_txn.txn_rc set response='$resulted_data', tid='$tid', result='$transid', mrc_status='$rc_stat' where mrc_id='$m_id';";
			mysql_query($qry_b);
		}
	}
	$qry_c="update $bankapi_parent_txn.txn_rc set response='$resulted_data' where mrc_id='$m_id';";
	mysql_query($qry_c);
}
echo json_encode("$resulted_data");
?>