<?php
function show_clients_count($cond)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_parent_base.parent_client $cond ";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	return $total_records;
}
function show_clients_data($cond, $start_from=0, $num_rec_per_page=0)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$start_from=mysql_real_escape_string($start_from);
	$num_rec_per_page=mysql_real_escape_string($num_rec_per_page);
	if($start_from==0 && $num_rec_per_page==0)
	$query="select * from $bankapi_parent_base.parent_client $cond ";
	else
	$query="select * from $bankapi_parent_base.parent_client $cond LIMIT $start_from, $num_rec_per_page";
	$result=mysql_query($query);
	return $result;
}
function show_client_name($client_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$client_name="";
	$query="select * from $bankapi_parent_base.parent_client where client_id='$client_id'";
	$result=mysql_query($query);
	$client_name=mysql_fetch_array($result)['client_name'];
	return $client_name;
}
function show_client_type($client_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$client_type="";
	$query="select * from $bankapi_parent_base.parent_client where client_id=$client_id";
	$result=mysql_query($query);
	$client_type=mysql_fetch_array($result)['client_type'];
	if($client_type==3)
		$client_type="API with Fixed Rate";
	if($client_type==2)
		$client_type="Portal with Fixed Rate";
	if($client_type==1)
		$client_type="Portal with Dynamic Rate";
	return $client_type;
}
function show_client_type_id($client_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$client_type="";
	$query="select * from $bankapi_parent_base.parent_client where client_id='$client_id'";
	$result=mysql_query($query);
	$rs=mysql_fetch_array($result);
	$client_type=$rs['client_type'];
	return $client_type;
}
function show_client_services($client_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$service_id="";
	$query="select * from $bankapi_parent_base.parent_client where client_id=$client_id";
	$result=mysql_query($query);
	$service_id=mysql_fetch_array($result)['service_id'];
	return $service_id;
}
function update_client_services($client_type,$client_id,$service_id,$utypes,$uid,$uname)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$remarks="services last updated by $utypes ($uid - $uname) at $datetime_datetime<br><br>";
	$query="update $bankapi_parent_base.parent_client set service_id='$service_id', client_remarks=concat('$remarks',client_remarks) where client_id=$client_id";
	mysql_query($query);
	
	$services=explode(",",$service_id);
	$query2="update $bankapi_child".$client_type."_".$client_id."_base.child_service set service_status=0";
	mysql_query($query2);
	for($aa=0;$aa<count($services);$aa++)
	{
		$service=$services[$aa];
		$query3="update $bankapi_child".$client_type."_".$client_id."_base.child_service set service_status=1 where service_id=$service";
		mysql_query($query3);
	}
}
function show_client_levels($client_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$level_id="";
	$query="select * from $bankapi_parent_base.parent_client where client_id=$client_id";
	$result=mysql_query($query);
	$level_id=mysql_fetch_array($result)['level_id'];
	return $level_id;
}
function update_client_levels($client_type,$client_id,$level_id,$utypes,$uid,$uname)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$remarks="levels last updated by $utypes ($uid - $uname) at $datetime_datetime<br><br>";
	$query="update $bankapi_parent_base.parent_client set level_id='$level_id', client_remarks=concat('$remarks',client_remarks) where client_id=$client_id";
	mysql_query($query);
	
	$levels=explode(",",$level_id);
	$query2="update $bankapi_child".$client_type."_".$client_id."_base.child_level set level_status=0";
	mysql_query($query2);
	for($aa=0;$aa<count($levels);$aa++)
	{
		$level=$levels[$aa];
		$query3="update $bankapi_child".$client_type."_".$client_id."_base.child_level set level_status=1 where level_id=$level";
		mysql_query($query3);
	}
}
function is_service_allocated($client_id,$service_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_parent_base.parent_client where client_id=$client_id and service_id like '%$service_id%' ";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	return $total_records;
}
function update_dummy_balance($client_id,$amount)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$client_type_id=show_client_type_id($client_id);
	$query="update $bankapi_parent_base.parent_client set dummy_balance=(dummy_balance+'$amount') where client_id='$client_id';";
	mysql_query($query);
	
	$client_db1=$bankapi_child.$client_type_id."_".$client_id."_wallet.realtime";
	$client_db2=$bankapi_child.$client_type_id."_".$client_id."_wallet.distribution";
	$client_db3=$bankapi_child.$client_type_id."_".$client_id."_base.child_userinfo_walletkyc";
	
	if($amount>0)
	{
		$query3="select * from $client_db1 order by wallet_id desc limit 0,1 ";
		$result3=mysql_query($query3);
		$pre1=$post1=0;
		while($row3=mysql_fetch_array($result3))
		{
			$pre1=$row3['amount_bal'];
		}
		$post1=$pre1+$amount;
		
		//transaction_type=1=transfer received from provider
		if($client_id==2000)
			$uids1=100001;
		if($client_id==1000)
			$uids1=200001;
		$query4="INSERT INTO $client_db1(`wallet_date`, `wallet_time`, `user_id`, `request_id`, `service_id`, `client_order_id`, `source_order_id`, `transaction_type`, `transaction_description`, `amount_pre`, `amount_cr`, `amount_dr`, `amount_bal`) VALUES ('$datetime_date', '$datetime_time', '$uids1', '0', 0, 0, 0, 1, 'Advance Added', '$pre1', '$amount', '0', '$post1')";
		mysql_query($query4);
		
		$query5="select * from $client_db2 where user_id='$uids1' order by wallet_id desc limit 0,1 ";
		$result5=mysql_query($query5);
		$pre2=$post2=0;
		while($row5=mysql_fetch_array($result5))
		{
			$pre2=$row5['amount_bal'];
		}
		$post2=$pre2+$amount;
		
		//transaction_type=1=transfer received from provider
		$query6="INSERT INTO $client_db2(`wallet_date`, `wallet_time`, `user_id`, `user_id2`, `request_id`, `service_id`, `order_id`, `tid`, `transaction_type`, `transaction_description`, `amount_pre`, `amount_cr`, `amount_dr`, `amount_bal`, `remarks`) VALUES ('$datetime_date', '$datetime_time', '$uids1', 0, 0, 0, 0, 0, 1, 'Advance Added', '$pre2', '$amount', '0', '$post2', 'Advance Added')";
		mysql_query($query6);
		
		$query="update $client_db3 set wallet_balance='$post2' where user_id='$uids1'";
		mysql_query($query);
	}
	else if($amount<0)
	{
		$amount=$amount*(-1);
		
		$query3="select * from $client_db1 order by wallet_id desc limit 0,1 ";
		$result3=mysql_query($query3);
		$pre1=0;
		while($row3=mysql_fetch_array($result3))
		{
			$pre1=$row3['amount_bal'];
		}
		$post1=$pre1-$amount;
		
		//transaction_type=4=withdraw
		if($client_id==2000)
			$uids1=100001;
		if($client_id==1000)
			$uids1=200001;
		$query4="INSERT INTO $client_db1(`wallet_date`, `wallet_time`, `user_id`, `request_id`, `service_id`, `client_order_id`, `source_order_id`, `transaction_type`, `transaction_description`, `amount_pre`, `amount_cr`, `amount_dr`, `amount_bal`) VALUES ('$datetime_date', '$datetime_time', '$uids1', 0, 0, 0, 0, 4, 'Advance Withdraw', '$pre1', '0', '$amount', '$post1')";
		mysql_query($query4);
		
		$query5="select * from $client_db2 where user_id='$uids1' order by wallet_id desc limit 0,1 ";
		$result5=mysql_query($query5);
		$pre2=0;
		while($row5=mysql_fetch_array($result5))
		{
			$pre2=$row5['amount_bal'];
		}
		$post2=$pre2-$amount;
		
		//transaction_type=5=withdraw
		$query6="INSERT INTO $client_db2(`wallet_date`, `wallet_time`, `user_id`, `user_id2`, `request_id`, `service_id`, `order_id`, `tid`, `transaction_type`, `transaction_description`, `amount_pre`, `amount_cr`, `amount_dr`, `amount_bal`, `remarks`) VALUES ('$datetime_date', '$datetime_time', '$uids1', 0, 0, 0, 0, 0, 5, 'Advance Withdraw', '$pre2', '0', '$amount', '$post2', 'Advance Withdraw')";
		mysql_query($query6);
		
		$query="update $client_db3 set wallet_balance='$post2' where user_id='$uids1'";
		mysql_query($query);
	}
}

function show_client_rt_balancessss($clientdb)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$clientdb_wallet=$clientdb."_wallet";
	$query="select * from $clientdb_wallet.realtime order by wallet_id desc limit 0,1 ";
	$result=mysql_query($query);
	$bal=0;
	if(isset($result) && $result!="")
	{
		while($row=mysql_fetch_array($result))
		{
			$bal=$row['amount_bal'];
		}
	}
	return $bal;
}

function update_client_rt_balancessss($clientdb,$client_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$bal=show_client_rt_balancessss($clientdb);
	$query="update $bankapi_parent_base.parent_client set bal_amt='$bal' where client_id='$client_id'";
	mysql_query($query);
	return $bal;
}
?>