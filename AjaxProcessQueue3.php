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
	include('zf-TxnExists.php');
	$arr1=show_mt_order_details2($m_id);
	$arr3=show_mt_order_kyc($m_id);
	$pan=$arr3[0];
	$aadhar=$arr3[1];
	include_once('zf-TxnSource3DmtApi.php');
	$arr2=fund_transfer2($arr1[0],$arr1[1],$arr1[2],$arr1[3],$arr1[4],$arr1[5],$arr1[6],$arr1[7],$pan,$aadhar);
	$response=$arr2[6];
	//update_txn_status2($arr1[0],$response);
	$arr=order_clientid_clienttypeid_by_mid2($m_id);
	$order=$arr[0];
	$clientid=$arr[1];
	$clienttype=$arr[2];
	
	$resulted_response=$arr2[6];
	$ASTransCode=$arr2[3];
	$ReferenceNumber=$arr2[4];
	$Status=$arr2[1];
	//$StatusCode,$Status,$Description,$ASTransCode,$ReferenceNumber,$BeneficiaryName,$response
	if($arr2[1]=='SUCCESS')
		$txn_status=2;
	else if($arr2[1]=='FAILED')
		$txn_status=-4;
	else if($arr2[1]=='PENDING')
		$txn_status=3;
	
	$client_db="$bankapi_child"."$clienttype"."_"."$clientid"."_txn";
	//update tid for client_child
	mysql_query("update $client_db.txn_mt_child set tid='$ASTransCode', bank_ref_no='$ReferenceNumber', order_status='$txn_status' where order_id='$order';");
	
	//update response/tid for admin
	mysql_query("update $bankapi_parent_txn.txn_mt set response='$resulted_response', bank_ref_no='$ReferenceNumber', tid='$ASTransCode', response_message='$Status', mmt_status='$txn_status' where mmt_id='$m_id';");
}
echo json_encode("$m_id $pan $aadhar");
?>