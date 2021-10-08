<?php
function check_mmt_paid($mmt_id, $source, $type)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$total_records=0;
	$query="select * from $bankapi_parent_txn.com_paid_child where source='$source' and type='$type' and order_id='$mmt_id';";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	return $total_records;
}
function check_mrc_paid($mrc_id, $source, $type)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$total_records=0;
	$query="select * from $bankapi_parent_txn.com_paid_child where source='$source' and order_id='$mrc_id';";//and type='$type'
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	return $total_records;
}

function check_order_paid($bankapi_child_txn, $order, $source, $type)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$total_records=0;
	$query="select * from $bankapi_child_txn.com_generated where source='$source' and type='$type' and order_id='$order';";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	return $total_records;
}

function check_rc_paid($bankapi_child_txn, $order, $source, $type)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$total_records=0;
	$query="select * from $bankapi_child_txn.com_generated where source='$source' and type='$type' and order_id='$order';";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	return $total_records;
}
function show_mt_order_details($mmt_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$orderno=0;
	$cno=0;
	$brid=0;
	$method=0;
	$transamount=0;
	$query="select * from $bankapi_parent_txn.txn_mt where mmt_id='$mmt_id';";
	$result=mysql_query($query);
	while($rs=mysql_fetch_array($result))
	{
		$orderno=$rs['mmt_id'];
		$cno=$rs['sender_number'];
		$brid=$rs['receiver_id'];
		$method=$rs['method'];
		$transamount=$rs['amount'];
	}
	$arr=array($orderno,$cno,$brid,$method,$transamount);
	return $arr;
}
function show_mt_order_details2($mmt_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$orderno=0;
	$cno=0;
	$brid=0;
	$method=0;
	$transamount=0;
	$query="select * from $bankapi_parent_txn.txn_mt where mmt_id='$mmt_id';";
	$result=mysql_query($query);
	while($rs=mysql_fetch_array($result))
	{
		$orderno=$rs['mmt_id'];
		$cno=$rs['sender_number'];
		$cname=$rs['sname'];
		$brid=$rs['receiver_id'];
		$account=$rs['racc'];
		$ifsc=$rs['rifsc'];
		$method=$rs['method'];
		$transamount=$rs['amount'];
	}
	$arr=array($orderno,$cno,$cname,$brid,$account,$ifsc,$method,$transamount);
	return $arr;
}
function show_mt_order_kyc($mmt_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$client_id2=0;
	$user_id2=0;
	$client_type2=0;
	$pan="";
	$aadhar="";
	$query="select * from $bankapi_parent_txn.txn_mt where mmt_id='$mmt_id';";
	$result=mysql_query($query);
	while($rs=mysql_fetch_array($result))
	{
		$client_id2=$rs['client_id'];
		$user_id2=$rs['user_id'];
	}
	$query2="select * from $bankapi_parent_base.parent_client where client_id='$client_id2';";
	$result2=mysql_query($query2);
	while($rs2=mysql_fetch_array($result2))
	{
		$client_type2=$rs2['client_type'];
	}
	$maindbs="$bankapi_child".$client_type2."_".$client_id2."_base";
	$query3="select * from $maindbs.child_userinfo_walletkyc where user_id='$user_id2';";
	$result3=mysql_query($query3);
	while($rs3=mysql_fetch_array($result3))
	{
		$pan=$rs3['pancard_no'];
		$aadhar=$rs3['aadhar_no'];
	}
	$arr=array($pan,$aadhar);
	return $arr;
}
function update_txn_status($mmt_id,$response)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="update $bankapi_parent_txn.txn_mt set response='$response', mmt_status='1' where mmt_id='$mmt_id';";
	mysql_query($query);
}
function update_txn_value($mid,$bank_ref_no,$status)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$order_id="";
	$client_id="";
	$client_db="x";
	$query1="select * from $bankapi_parent_txn.txn_mt where mmt_id='$mid';";
	$result=mysql_query($query1);
	while($rs=mysql_fetch_array($result))
	{
		$order_id=$rs['order_id'];
		$client_id=$rs['client_id'];
		if($client_id==1000)
		{
			$client_db=$bankapi_child."1_1000_txn";
		}
		else if($client_id==2000)
		{
			$client_db=$bankapi_child."2_2000_txn";
		}
	}
	if($order_id!="" && $client_id!="")
	{
		$query2="update $bankapi_parent_txn.txn_mt set mmt_status='$status',bank_ref_no='$bank_ref_no' where mmt_id='$mid';";
		mysql_query($query2);
		
		$query3="update $client_db.txn_mt_child set order_status='$status',bank_ref_no='$bank_ref_no' where mid='$mid' and order_id='$order_id';";
		mysql_query($query3);
	}
}


function show_client_user_balance($clientdb, $user)
{
	$clientdb.="_base.child_userinfo_walletkyc";
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$bal=0;
	$query="select * from $clientdb where user_id='$user';";
	$result=mysql_query($query);
	while($rs=mysql_fetch_array($result))
	{
		$bal=$rs['wallet_balance'];
	}
	return $bal;
}

function update_client_user_balance($clientdb, $user, $amt)
{
	$clientdb.="_base.child_userinfo_walletkyc";
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="update $clientdb set wallet_balance='$amt' where user_id='$user';";
	mysql_query($query);
}

function client_user_balance_cr($clientdb, $user, $amt, $service, $order, $mmt, $details)
{
	$clientdb2=$clientdb;
	$clientdb.="_wallet.distribution";//8
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$pre=show_client_user_balance($clientdb2, $user);
	$post=$pre+$amt;
	$query="INSERT INTO $clientdb (wallet_date, wallet_time, user_id, user_id2, request_id, service_id, order_id, tid, transaction_type, transaction_description, amount_pre, amount_cr, amount_dr, amount_bal, remarks) VALUES ('$datetime_date', '$datetime_time', '$user', '0', '0', '$service', '$order', '$mmt', '8', '$details', '$pre', '$amt', '0.00', '$post', '$details');";
	mysql_query($query);
	update_client_user_balance($clientdb2, $user, $post);
}

function client_user_balance_dr($clientdb, $user, $amt, $service, $order, $mmt, $details)
{
	$clientdb2=$clientdb;
	$clientdb.="_wallet.distribution";//9
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$pre=show_client_user_balance($clientdb2, $user);
	$post=$pre-$amt;
	$query="INSERT INTO $clientdb (wallet_date, wallet_time, user_id, user_id2, request_id, service_id, order_id, tid, transaction_type, transaction_description, amount_pre, amount_cr, amount_dr, amount_bal, remarks) VALUES ('$datetime_date', '$datetime_time', '$user', '0', '0', '$service', '$order', '$mmt', '9', '$details', '$pre', '0.00', '$amt', '$post', '$details');";
	mysql_query($query);
	update_client_user_balance($clientdb2, $user, $post);
}

function client_user_balance_deduct($clientdb, $user, $amt, $service, $order, $mmt, $details)
{
	$clientdb2=$clientdb;
	$clientdb.="_wallet.distribution";//5
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$pre=show_client_user_balance($clientdb2, $user);
	$post=$pre-$amt;
	$query="INSERT INTO $clientdb (wallet_date, wallet_time, user_id, user_id2, request_id, service_id, order_id, tid, transaction_type, transaction_description, amount_pre, amount_cr, amount_dr, amount_bal, remarks) VALUES ('$datetime_date', '$datetime_time', '$user', '0', '0', '$service', '$order', '$mmt', '5', '$details', '$pre', '0.00', '$amt', '$post', '$details');";
	mysql_query($query);
	update_client_user_balance($clientdb2, $user, $post);
}

function show_admin_mt1_balance()
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_parent_wallet.rt_eko order by wallet_id desc limit 0,1 ";
	$result=mysql_query($query);
	$bal=0;
	while($row=mysql_fetch_array($result))
	{
		$bal=$row['amount_bal'];
	}
	return $bal;
}

function show_admin_mt2_balance()
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_parent_wallet.rt_acharya order by wallet_id desc limit 0,1 ";
	$result=mysql_query($query);
	$bal=0;
	while($row=mysql_fetch_array($result))
	{
		$bal=$row['amount_bal'];
	}
	return $bal;
}

function show_admin_mt3_balance()
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_parent_wallet.rt_ach_blyss order by wallet_id desc limit 0,1 ";
	$result=mysql_query($query);
	$bal=0;
	while($row=mysql_fetch_array($result))
	{
		$bal=$row['amount_bal'];
	}
	return $bal;
}

function show_admin_rc1_balance()
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_parent_wallet.rt_aquams order by wallet_id desc limit 0,1 ";
	$result=mysql_query($query);
	$bal=0;
	while($row=mysql_fetch_array($result))
	{
		$bal=$row['amount_bal'];
	}
	return $bal;
}

function show_admin_rc2_balance()
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_parent_wallet.rt_rechapi order by wallet_id desc limit 0,1 ";
	$result=mysql_query($query);
	$bal=0;
	while($row=mysql_fetch_array($result))
	{
		$bal=$row['amount_bal'];
	}
	return $bal;
}

function show_client_rt_balance($clientdb)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$clientdb_wallet=$clientdb."_wallet";
	$query="select * from $clientdb_wallet.realtime order by wallet_id desc limit 0,1 ";
	$result=mysql_query($query);
	$bal=0;
	while($row=mysql_fetch_array($result))
	{
		$bal=$row['amount_bal'];
	}
	return $bal;
}

function admin_mt1_refund_check($client, $user, $order, $mmt_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$total_records=0;
	$amt=0;
	$query="select * from $bankapi_parent_wallet.rt_eko where client_id='$client' and user_id='$user' and client_order_id='$order' and source_order_id='$mmt_id' and transaction_type='3';";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	if($total_records==0)
	{
		$query="select * from $bankapi_parent_wallet.rt_eko where client_id='$client' and user_id='$user' and client_order_id='$order' and source_order_id='$mmt_id' and transaction_type='2';";
		$result=mysql_query($query);
		while($rs=mysql_fetch_array($result))
		{
			$amt=$rs['amount_dr'];
		}
	}
	$return_result=array($total_records,$amt);
	return $return_result;
}

function admin_mt1_refund($client, $user, $order, $mmt_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$check=0;
	$check=admin_mt1_refund_check($client, $user, $order, $mmt_id);
	//echo $check[0]." ".$check[1]."<br>";
	$return_val=0;
	if($check[0]==0)
	{
		$pre=show_admin_mt1_balance();
		$amt=$check[1];
		$post=$pre+$amt;
		$details="Money Transfer order $mmt_id refunded for client $client, user $user, client order $order";
		$ins_qry="INSERT INTO $bankapi_parent_wallet.rt_eko(wallet_date, wallet_time, client_id, user_id, client_order_id, source_order_id, transaction_type, transaction_description, amount_pre, amount_cr, amount_dr, amount_bal) value('$datetime_date','$datetime_time','$client','$user','$order','$mmt_id','3','$details','$pre','$amt','0','$post')";
		mysql_query($ins_qry);
		$return_val++;
	}
	return $return_val;
}

function admin_mt2_refund_check($client, $user, $order, $mmt_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$total_records=0;
	$amt=0;
	$query="select * from $bankapi_parent_wallet.rt_acharya where client_id='$client' and user_id='$user' and client_order_id='$order' and source_order_id='$mmt_id' and transaction_type='3';";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	if($total_records==0)
	{
		$query="select * from $bankapi_parent_wallet.rt_acharya where client_id='$client' and user_id='$user' and client_order_id='$order' and source_order_id='$mmt_id' and transaction_type='2';";
		$result=mysql_query($query);
		while($rs=mysql_fetch_array($result))
		{
			$amt=$rs['amount_dr'];
		}
	}
	$return_result=array($total_records,$amt);
	return $return_result;
}

function admin_mt2_refund($client, $user, $order, $mmt_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$check=0;
	$check=admin_mt2_refund_check($client, $user, $order, $mmt_id);
	//echo $check[0]." ".$check[1]."<br>";
	$return_val=0;
	if($check[0]==0)
	{
		$pre=show_admin_mt1_balance();
		$amt=$check[1];
		$post=$pre+$amt;
		$details="Money Transfer order $mmt_id refunded for client $client, user $user, client order $order";
		$ins_qry="INSERT INTO $bankapi_parent_wallet.rt_acharya(wallet_date, wallet_time, client_id, user_id, client_order_id, source_order_id, transaction_type, transaction_description, amount_pre, amount_cr, amount_dr, amount_bal) value('$datetime_date','$datetime_time','$client','$user','$order','$mmt_id','3','$details','$pre','$amt','0','$post')";
		mysql_query($ins_qry);
		$return_val++;
	}
	return $return_val;
}

function admin_mt3_refund_check($client, $user, $order, $mmt_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$total_records=0;
	$amt=0;
	$query="select * from $bankapi_parent_wallet.rt_ach_blyss where client_id='$client' and user_id='$user' and client_order_id='$order' and source_order_id='$mmt_id' and transaction_type='3';";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	if($total_records==0)
	{
		$query="select * from $bankapi_parent_wallet.rt_ach_blyss where client_id='$client' and user_id='$user' and client_order_id='$order' and source_order_id='$mmt_id' and transaction_type='2';";
		$result=mysql_query($query);
		while($rs=mysql_fetch_array($result))
		{
			$amt=$rs['amount_dr'];
		}
	}
	$return_result=array($total_records,$amt);
	return $return_result;
}

function admin_mt3_refund($client, $user, $order, $mmt_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$check=0;
	$check=admin_mt3_refund_check($client, $user, $order, $mmt_id);
	//echo $check[0]." ".$check[1]."<br>";
	$return_val=0;
	if($check[0]==0)
	{
		$pre=show_admin_mt3_balance();
		$amt=$check[1];
		$post=$pre+$amt;
		$details="Money Transfer order $mmt_id refunded for client $client, user $user, client order $order";
		$ins_qry="INSERT INTO $bankapi_parent_wallet.rt_ach_blyss(wallet_date, wallet_time, client_id, user_id, client_order_id, source_order_id, transaction_type, transaction_description, amount_pre, amount_cr, amount_dr, amount_bal) value('$datetime_date','$datetime_time','$client','$user','$order','$mmt_id','3','$details','$pre','$amt','0','$post')";
		mysql_query($ins_qry);
		$return_val++;
	}
	return $return_val;
}

function client_realtime_refund_check($user,$service,$order,$mmt_id,$clientdb)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$total_records=0;
	$amt=0;
	$clientdb_wallet=$clientdb."_wallet";
	$query="select * from $clientdb_wallet.realtime where user_id='$user' and service_id='$service' and client_order_id='$order' and source_order_id='$mmt_id' and transaction_type='3';";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	if($total_records==0)
	{
		$query="select * from $clientdb_wallet.realtime where user_id='$user' and service_id='$service' and client_order_id='$order' and source_order_id='$mmt_id' and transaction_type='2';";
		$result=mysql_query($query);
		while($rs=mysql_fetch_array($result))
		{
			$amt=$rs['amount_dr'];
		}
	}
	$return_result=array($total_records,$amt);
	return $return_result;
}

function client_realtime_refund($user,$service,$order,$mmt_id,$clientdb)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$check=0;
	$check=client_realtime_refund_check($user,$service,$order,$mmt_id,$clientdb);
	//echo $check[0]." ".$check[1]."<br>";
	$return_val=0;
	if($check[0]==0)
	{
		$pre=show_client_rt_balance($clientdb);
		$clientdb_wallet=$clientdb."_wallet";
		$amt=$check[1];
		$post=$pre+$amt;
		$details="Money Transfer order $order refunded for user $user";
		$ins_qry="INSERT INTO $clientdb_wallet.realtime(wallet_date, wallet_time, user_id, request_id, service_id, client_order_id, source_order_id, transaction_type, transaction_description, amount_pre, amount_cr, amount_dr, amount_bal) value('$datetime_date','$datetime_time','$user','0','$service','$order','$mmt_id','3','$details','$pre','$amt','0','$post')";
		mysql_query($ins_qry);
		$return_val++;
	}
	return $return_val;
}

function client_user_refund_check($user,$service,$order,$mmt_id,$clientdb)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$total_records=0;
	$amt=0;
	$clientdb_wallet=$clientdb."_wallet";
	$query="select * from $clientdb_wallet.distribution where user_id='$user' and service_id='$service' and order_id='$order' and tid='$mmt_id' and transaction_type='7';";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	if($total_records==0)
	{
		$query="select * from $clientdb_wallet.distribution where user_id='$user' and service_id='$service' and order_id='$order' and tid='$mmt_id' and transaction_type='6';";
		$result=mysql_query($query);
		while($rs=mysql_fetch_array($result))
		{
			$amt=$rs['amount_dr'];
		}
	}
	$return_result=array($total_records,$amt);
	return $return_result;
}

function client_user_refund($user,$service,$order,$mmt_id,$clientdb)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$check=0;
	$check=client_user_refund_check($user,$service,$order,$mmt_id,$clientdb);
	//echo $check[0]." ".$check[1]."<br>";
	$return_val=0;
	if($check[0]==0)
	{
		$pre=show_client_user_balance($clientdb, $user);
		$clientdb_wallet=$clientdb."_wallet";
		$amt=$check[1];
		$post=$pre+$amt;
		$details="Money Transfer order $order refunded at $datetime_datetime";
		$ins_qry="INSERT INTO $clientdb_wallet.distribution(wallet_date, wallet_time, user_id, user_id2, request_id, service_id, order_id, tid, transaction_type, transaction_description, amount_pre, amount_cr, amount_dr, amount_bal, remarks) value('$datetime_date','$datetime_time','$user','0','0','$service','$order','$mmt_id','7','$details','$pre','$amt','0','$post','order refunded')";
		mysql_query($ins_qry);
		update_client_user_balance($clientdb, $user, $post);
		$return_val++;
	}
	return $return_val;
}

function check_rc_refunded_or_not($oid,$mid,$source,$uid,$clientid,$clienttype,$service)
{
    $return_val=0;
	require('../zc-gyan-info-admin.php');
	require('../zc-commons-admin.php');
	if($source==4)
	{
		$query_ref="select * from $bankapi_parent_wallet.rt_rechapi where user_id='$uid' and client_id='$clientid' and client_order_id='$oid' and transaction_type='3';";
		$result_ref=mysql_query($query_ref);
		while($rs_ref = mysql_fetch_assoc($result_ref))
		{
			$return_val++;
		}
	}
	else if($source==6)
	{
		$query_ref="select * from $bankapi_parent_wallet.rt_rech_blyss where user_id='$uid' and client_id='$clientid' and client_order_id='$oid' and transaction_type='3';";
		$result_ref=mysql_query($query_ref);
		while($rs_ref = mysql_fetch_assoc($result_ref))
		{
			$return_val++;
		}
	}
    
    return $return_val;
}


function refund_rc_amount($oid,$mid,$source,$uid,$clientid,$clienttype,$service)
{
	require('../zc-gyan-info-admin.php');
	require('../zc-commons-admin.php');
	$admin_charges=0;
	$client_charges=0;
	$retailer_charges=0;
	$bankapi_child_base="$bankapi_child".$clienttype."_".$clientid."_base";
	$bankapi_child_txn="$bankapi_child".$clienttype."_".$clientid."_txn";
	$bankapi_child_wallet="$bankapi_child".$clienttype."_".$clientid."_wallet";
	
	// get order deducted amount of admin wallet with wallet id
	if($source==2)
	{
		$query_ref="select * from $bankapi_parent_wallet.rt_aquams where user_id='$uid' and client_id='$clientid' and client_order_id='$oid' and transaction_type='2' order by wallet_id desc limit 0,1";
		$result_ref=mysql_query($query_ref);
		while($rs_ref = mysql_fetch_assoc($result_ref))
		{
			$admin_charges=$rs_ref['amount_dr'];
		}
	}
	else if($source==4)
	{
		$query_ref="select * from $bankapi_parent_wallet.rt_rechapi where user_id='$uid' and client_id='$clientid' and client_order_id='$oid' and transaction_type='2' order by wallet_id desc limit 0,1";
		$result_ref=mysql_query($query_ref);
		while($rs_ref = mysql_fetch_assoc($result_ref))
		{
			$admin_charges=$rs_ref['amount_dr'];
		}
	}
	else if($source==6)
	{
		$query_ref="select * from $bankapi_parent_wallet.rt_rech_blyss where user_id='$uid' and client_id='$clientid' and client_order_id='$oid' and transaction_type='2' order by wallet_id desc limit 0,1";
		$result_ref=mysql_query($query_ref);
		while($rs_ref = mysql_fetch_assoc($result_ref))
		{
			$admin_charges=$rs_ref['amount_dr'];
		}
	}
	
	
	// get order deducted amount of client wallet with wallet id
	$query_ref="select * from $bankapi_child_wallet.realtime where user_id='$uid' and client_order_id='$oid' and transaction_type='2' order by wallet_id desc limit 0,1";
	$result_ref=mysql_query($query_ref);
	while($rs_ref = mysql_fetch_assoc($result_ref))
	{
		$client_charges=$rs_ref['amount_dr'];
	}
	
	// get order deducted amount of user wallet with wallet id
	$field="request_id";
	if($mid>58292)
		$field="order_id";
	$query_ref="select * from $bankapi_child_wallet.distribution where user_id='$uid' and user_id2='0' and $field='$oid' and transaction_type='6'";
	$result_ref=mysql_query($query_ref);
	while($rs_ref = mysql_fetch_assoc($result_ref))
	{
		$retailer_charges=$rs_ref['amount_dr'];
	}
	
	$filled_remarks="RC order $oid refunded";
	//get last balance of admin
	$balance_admin=show_txn_admin_balance($source);
	$balance_admin_new=$balance_admin+$admin_charges;
	//refund order to admin
	if($source==2)
	{
		$query4b="INSERT INTO $bankapi_parent_wallet.rt_aquams (wallet_date, wallet_time, client_id, user_id, client_order_id, source_order_id, transaction_type, transaction_description, amount_pre, amount_cr, amount_dr, amount_bal) VALUES ('$datetime_date', '$datetime_time', '$clientid', '$uid', '$oid', '0', '3', '$filled_remarks', '$balance_admin', '$admin_charges', '0.00', '$balance_admin_new');";
		mysql_query($query4b);
		$refund_admin_tid=mysql_insert_id();
	}
	else if($source==4)
	{
		$query4b="INSERT INTO $bankapi_parent_wallet.rt_rechapi (wallet_date, wallet_time, client_id, user_id, client_order_id, source_order_id, transaction_type, transaction_description, amount_pre, amount_cr, amount_dr, amount_bal) VALUES ('$datetime_date', '$datetime_time', '$clientid', '$uid', '$oid', '0', '3', '$filled_remarks', '$balance_admin', '$admin_charges', '0.00', '$balance_admin_new');";
		mysql_query($query4b);
		$refund_admin_tid=mysql_insert_id();
	}
	else if($source==6)
	{
		$query4b="INSERT INTO $bankapi_parent_wallet.rt_rech_blyss (wallet_date, wallet_time, client_id, user_id, client_order_id, source_order_id, transaction_type, transaction_description, amount_pre, amount_cr, amount_dr, amount_bal) VALUES ('$datetime_date', '$datetime_time', '$clientid', '$uid', '$oid', '0', '3', '$filled_remarks', '$balance_admin', '$admin_charges', '0.00', '$balance_admin_new');";
		mysql_query($query4b);
		$refund_admin_tid=mysql_insert_id();
	}
	
	//get last balance of client
	$balance_client=show_txn_client_balance($bankapi_child_wallet);
	$balance_client_new=$balance_client+$client_charges;
	//refund order to client
	$query4b="INSERT INTO $bankapi_child_wallet.realtime (wallet_date, wallet_time, user_id, request_id, service_id, client_order_id, source_order_id, transaction_type, transaction_description, amount_pre, amount_cr, amount_dr, amount_bal) VALUES ('$datetime_date', '$datetime_time', '$uid', '0', '$service', '$oid', '0', '3', '$filled_remarks', '$balance_client', '$client_charges', '0.00', '$balance_client_new');";
	mysql_query($query4b);
	$refund_client_tid=mysql_insert_id();
	
	//get last balance of retailer
	$balance_retailer=show_txn_user_balance($uid,$bankapi_child_wallet);
	$balance_retailer_new=$balance_retailer+$retailer_charges;
	//refund order to retailer
	$query4b="INSERT INTO $bankapi_child_wallet.distribution (wallet_date, wallet_time, user_id, user_id2, request_id, service_id, order_id, tid, transaction_type, transaction_description, amount_pre, amount_cr, amount_dr, amount_bal, remarks) VALUES ('$datetime_date', '$datetime_time', '$uid', '0', '0', '$service', '$oid', '$mid', '7', '$filled_remarks', '$balance_retailer', '$retailer_charges', '0.00', '$balance_retailer_new', '$filled_remarks at $datetime_datetime');";
	mysql_query($query4b);
	$refund_retailer_tid=mysql_insert_id();
	update_txn_user_balance($uid,$bankapi_child_base,$bankapi_child_wallet);

	// update order status to refunded for admin
	$qry1="update $bankapi_parent_txn.txn_rc set mrc_status='5', refund_admin_tid='$refund_admin_tid', refund_client_tid='$refund_client_tid', refund_retailer_tid='$refund_retailer_tid', updated_on='$datetime_datetime' where mrc_id='$mid'";
	mysql_query($qry1);	
	// update order status to refunded for client
	$qry2="update $bankapi_child_txn.txn_rc set rc_status='5', refund_admin_tid='$refund_admin_tid', refund_client_tid='$refund_client_tid', refund_retailer_tid='$refund_retailer_tid', updated_on='$datetime_datetime' where rc_id='$oid'";
	mysql_query($qry2);	
}

function refund_rc_amount_refunded($oid,$mid,$source,$uid,$clientid,$clienttype,$service)
{
	require('../zc-gyan-info-admin.php');
	require('../zc-commons-admin.php');
	$admin_charges=0;
	$client_charges=0;
	$retailer_charges=0;
	$bankapi_child_base="$bankapi_child".$clienttype."_".$clientid."_base";
	$bankapi_child_txn="$bankapi_child".$clienttype."_".$clientid."_txn";
	$bankapi_child_wallet="$bankapi_child".$clienttype."_".$clientid."_wallet";

	// update order status to refunded for admin
	$qry1="update $bankapi_parent_txn.txn_rc set mrc_status='5' where mrc_id='$mid'";
	mysql_query($qry1);	
	// update order status to refunded for client
	$qry2="update $bankapi_child_txn.txn_rc set rc_status='5' where rc_id='$oid'";
	mysql_query($qry2);	
}

function show_rc_order_details($m_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$client_id=0;
	$order_id=0;
	$source=0;
	$client_type=0;
	$qry="select * from $bankapi_parent_txn.txn_rc where mrc_id='$m_id';";
	$result=mysql_query($qry);
	while($rs=mysql_fetch_array($result))
	{
		$client_id=$rs['client_id'];
		$order_id=$rs['order_id'];
		$source=$rs['source'];
	}
	$qry2="select * from $bankapi_parent_base.parent_client where client_id='$client_id';";
	$result2=mysql_query($qry2);
	while($rs2=mysql_fetch_array($result2))
	{
		$client_type=$rs2['client_type'];
	}
	$res=array($client_type,$client_id,$order_id,$source);
	return $res;
}

function show_txn_admin_balance($source)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$balance=0;
	if($source==1)
		$query="SELECT * FROM $bankapi_parent_wallet.rt_eko order by wallet_id desc limit 0,1";
	else if($source==2)
		$query="SELECT * FROM $bankapi_parent_wallet.rt_aquams order by wallet_id desc limit 0,1";
	else if($source==3)
		$query="SELECT * FROM $bankapi_parent_wallet.rt_acharya order by wallet_id desc limit 0,1";
	else if($source==4)
		$query="SELECT * FROM $bankapi_parent_wallet.rt_rechapi order by wallet_id desc limit 0,1";
	else if($source==5)
		$query="SELECT * FROM $bankapi_parent_wallet.rt_ach_blyss order by wallet_id desc limit 0,1";
	else if($source==6)
		$query="SELECT * FROM $bankapi_parent_wallet.rt_rech_blyss order by wallet_id desc limit 0,1";
	$result=mysql_query($query);
	while($row=mysql_fetch_array($result))
	{
		$balance=$row['amount_bal'];
	}
	return $balance;
}

function show_txn_client_balance($bankapi_child_wallet)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$balance=0;
	$query="SELECT * FROM $bankapi_child_wallet.realtime order by wallet_id desc limit 0,1";
	$result=mysql_query($query);
	while($row=mysql_fetch_array($result))
	{
		$balance=$row['amount_bal'];
	}
	return $balance;
}

function show_txn_user_balance($userid,$bankapi_child_wallet)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$balance=0;
	$query="SELECT * FROM $bankapi_child_wallet.distribution where user_id='$userid' order by wallet_id desc limit 0,1";
	$result=mysql_query($query);
	while($row=mysql_fetch_array($result))
	{
		$balance=$row['amount_bal'];
	}
	return $balance;
}

function update_txn_user_balance($userid,$bankapi_child_base,$bankapi_child_wallet)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$balance=show_txn_user_balance($userid,$bankapi_child_wallet);
	$query="update $bankapi_child_base.child_userinfo_walletkyc set wallet_balance='$balance' where user_id='$userid'";
	mysql_query($query);
}
?>