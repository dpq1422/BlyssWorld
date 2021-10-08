<?php
function show_distributed_count($cond)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_parent_wallet.distributed_blyss $cond ";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	return $total_records;
}
function show_distributed_data($cond, $start_from=0, $num_rec_per_page=0)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$start_from=mysql_real_escape_string($start_from);
	$num_rec_per_page=mysql_real_escape_string($num_rec_per_page);
	if($start_from==0 && $num_rec_per_page==0)
	$query="select * from $bankapi_parent_wallet.distributed_blyss $cond order by wallet_id desc ";
	else
	$query="select * from $bankapi_parent_wallet.distributed_blyss $cond order by wallet_id desc LIMIT $start_from, $num_rec_per_page ";
	$result=mysql_query($query);
	return $result;
}
function show_rt1()
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
function show_rt2()
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
function show_rt3()
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
function show_rt4()
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
function show_rt5()
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
function show_rt6()
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_parent_wallet.rt_rech_blyss order by wallet_id desc limit 0,1 ";
	$result=mysql_query($query);
	$bal=0;
	while($row=mysql_fetch_array($result))
	{
		$bal=$row['amount_bal'];
	}
	return $bal;
}
function show_distributed_balance()
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_parent_wallet.distributed_blyss order by wallet_id desc limit 0,1 ";
	$result=mysql_query($query);
	$bal=0;
	while($row=mysql_fetch_array($result))
	{
		$bal=$row['amount_bal'];
	}
	return $bal;
}
function update_distributed_wallet($bank, $source, $amount, $remarks)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_parent_wallet.distributed_blyss order by wallet_id desc limit 0,1 ";
	$result=mysql_query($query);
	$pre=0;
	while($row=mysql_fetch_array($result))
	{
		$pre=$row['amount_bal'];
	}
	$post=$pre+$amount;
	
	$query2="INSERT INTO $bankapi_parent_wallet.distributed_blyss(`wallet_date`, `wallet_time`, `client_id`, `user_id`, `request_id`, `transaction_type`, `transaction_description`, `amount_pre`, `amount_cr`, `amount_dr`, `amount_bal`) VALUES ('$datetime_date', '$datetime_time', $source, 0, '$bank', 1, '$remarks', '$pre', '$amount', '0', '$post')";
	mysql_query($query2);
	
	if($source==1)
	{
		$query="select * from $bankapi_parent_wallet.rt_eko order by wallet_id desc limit 0,1 ";
		$result=mysql_query($query);
		$pre1=0;
		while($row=mysql_fetch_array($result))
		{
			$pre1=$row['amount_bal'];
		}
		$post1=$pre1+$amount;
		
		$query2="INSERT INTO $bankapi_parent_wallet.rt_eko(`wallet_date`, `wallet_time`, `client_id`, `user_id`, `client_order_id`, `source_order_id`, `transaction_type`, `transaction_description`, `amount_pre`, `amount_cr`, `amount_dr`, `amount_bal`) VALUES ('$datetime_date', '$datetime_time', 1, 0, '$bank', -1, 1, '$remarks', '$pre1', '$amount', '0', '$post1')";
		mysql_query($query2);
	}
	else if($source==2)
	{
		$query="select * from $bankapi_parent_wallet.rt_aquams order by wallet_id desc limit 0,1 ";
		$result=mysql_query($query);
		$pre2=0;
		while($row=mysql_fetch_array($result))
		{
			$pre2=$row['amount_bal'];
		}
		$post2=$pre2+$amount;
		
		$query2="INSERT INTO $bankapi_parent_wallet.rt_aquams(`wallet_date`, `wallet_time`, `client_id`, `user_id`, `client_order_id`, `source_order_id`, `transaction_type`, `transaction_description`, `amount_pre`, `amount_cr`, `amount_dr`, `amount_bal`) VALUES ('$datetime_date', '$datetime_time', 2, 0, '$bank', -1, 1, '$remarks', '$pre2', '$amount', '0', '$post2')";
		mysql_query($query2);
	}
	else if($source==3)
	{
		$query="select * from $bankapi_parent_wallet.rt_acharya order by wallet_id desc limit 0,1 ";
		$result=mysql_query($query);
		$pre2=0;
		while($row=mysql_fetch_array($result))
		{
			$pre2=$row['amount_bal'];
		}
		$post2=$pre2+$amount;
		
		$query2="INSERT INTO $bankapi_parent_wallet.rt_acharya(`wallet_date`, `wallet_time`, `client_id`, `user_id`, `client_order_id`, `source_order_id`, `transaction_type`, `transaction_description`, `amount_pre`, `amount_cr`, `amount_dr`, `amount_bal`) VALUES ('$datetime_date', '$datetime_time', 3, 0, '$bank', -1, 1, '$remarks', '$pre2', '$amount', '0', '$post2')";
		mysql_query($query2);
	}
	else if($source==4)
	{
		$query="select * from $bankapi_parent_wallet.rt_rechapi order by wallet_id desc limit 0,1 ";
		$result=mysql_query($query);
		$pre4=0;
		while($row=mysql_fetch_array($result))
		{
			$pre4=$row['amount_bal'];
		}
		$post4=$pre4+$amount;
		
		$query2="INSERT INTO $bankapi_parent_wallet.rt_rechapi(`wallet_date`, `wallet_time`, `client_id`, `user_id`, `client_order_id`, `source_order_id`, `transaction_type`, `transaction_description`, `amount_pre`, `amount_cr`, `amount_dr`, `amount_bal`) VALUES ('$datetime_date', '$datetime_time', 4, 0, '$bank', -1, 1, '$remarks', '$pre4', '$amount', '0', '$post4')";
		mysql_query($query2);
	}
	else if($source==5)
	{
		$query="select * from $bankapi_parent_wallet.rt_ach_blyss order by wallet_id desc limit 0,1 ";
		$result=mysql_query($query);
		$pre4=0;
		while($row=mysql_fetch_array($result))
		{
			$pre4=$row['amount_bal'];
		}
		$post4=$pre4+$amount;
		
		$query2="INSERT INTO $bankapi_parent_wallet.rt_ach_blyss(`wallet_date`, `wallet_time`, `client_id`, `user_id`, `client_order_id`, `source_order_id`, `transaction_type`, `transaction_description`, `amount_pre`, `amount_cr`, `amount_dr`, `amount_bal`) VALUES ('$datetime_date', '$datetime_time', 4, 0, '$bank', -1, 1, '$remarks', '$pre4', '$amount', '0', '$post4')";
		mysql_query($query2);
	}
	else if($source==6)
	{
		$query="select * from $bankapi_parent_wallet.rt_rech_blyss order by wallet_id desc limit 0,1 ";
		$result=mysql_query($query);
		$pre4=0;
		while($row=mysql_fetch_array($result))
		{
			$pre4=$row['amount_bal'];
		}
		$post4=$pre4+$amount;
		
		$query2="INSERT INTO $bankapi_parent_wallet.rt_rech_blyss(`wallet_date`, `wallet_time`, `client_id`, `user_id`, `client_order_id`, `source_order_id`, `transaction_type`, `transaction_description`, `amount_pre`, `amount_cr`, `amount_dr`, `amount_bal`) VALUES ('$datetime_date', '$datetime_time', 4, 0, '$bank', -1, 1, '$remarks', '$pre4', '$amount', '0', '$post4')";
		mysql_query($query2);
	}
}
function transfer_to_client($client_type_id, $client, $request, $amount, $remarks, $remarks_admin)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$client_db1 = $bankapi_child . $client_type_id . "_" . $client . "_wallet.realtime";
	$client_db2 = $bankapi_child . $client_type_id . "_" . $client . "_wallet.distribution";
	
	$query="select * from $bankapi_parent_wallet.distributed_blyss order by wallet_id desc limit 0,1 ";
	$result=mysql_query($query);
	$pre=0;
	while($row=mysql_fetch_array($result))
	{
		$pre=$row['amount_bal'];
	}
	$post=$pre-$amount;
	//transaction_type=2=transfer
	$query2="INSERT INTO $bankapi_parent_wallet.distributed_blyss(`wallet_date`, `wallet_time`, `client_id`, `user_id`, `request_id`, `transaction_type`, `transaction_description`, `amount_pre`, `amount_cr`, `amount_dr`, `amount_bal`) VALUES ('$datetime_date', '$datetime_time', '$client', 0, '$request', 2, '$remarks_admin', '$pre', '0', '$amount', '$post')";
	mysql_query($query2);
	
	
	$query3="select * from $client_db1 order by wallet_id desc limit 0,1 ";
	$result3=mysql_query($query3);
	$pre1=0;
	while($row3=mysql_fetch_array($result3))
	{
		$pre1=$row3['amount_bal'];
	}
	$post1=$pre1+$amount;
	
	//transaction_type=1=transfer received from provider
		if($client==2000)
			$uids1=100001;
		if($client==1000)
			$uids1=200001;
	$query4="INSERT INTO $client_db1(`wallet_date`, `wallet_time`, `user_id`, `request_id`, `service_id`, `client_order_id`, `source_order_id`, `transaction_type`, `transaction_description`, `amount_pre`, `amount_cr`, `amount_dr`, `amount_bal`) VALUES ('$datetime_date', '$datetime_time', '$uids1', '$request', 0, 0, 0, 1, '$remarks', '$pre1', '$amount', '0', '$post1')";
	mysql_query($query4);

	if($client_type_id!=3)
	{
		$query5="select * from $client_db2 where user_id='$uids1' order by wallet_id desc limit 0,1 ";
		$result5=mysql_query($query5);
		$pre2=0;
		while($row5=mysql_fetch_array($result5))
		{
			$pre2=$row5['amount_bal'];
		}
		$post2=$pre2+$amount;
		
		//transaction_type=1=transfer received from provider
		$query6="INSERT INTO $client_db2(`wallet_date`, `wallet_time`, `user_id`, `user_id2`, `request_id`, `service_id`, `order_id`, `tid`, `transaction_type`, `transaction_description`, `amount_pre`, `amount_cr`, `amount_dr`, `amount_bal`, `remarks`) VALUES ('$datetime_date', '$datetime_time', '$uids1', 0, '$request', 0, 0, 0, 1, '$remarks', '$pre2', '$amount', '0', '$post2', '$remarks')";
		mysql_query($query6);
	}
	$query7="update $bankapi_parent_base.parent_client set bal_amt=(bal_amt+$amount) where client_id='$client';";
	mysql_query($query7);
}
function transfer_to_client_rejected($client_type_id, $client, $request, $amount, $remarks, $remarks_admin)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$client_db1 = $bankapi_child . $client_type_id . "_" . $client . "_wallet.realtime";
	$client_db2 = $bankapi_child . $client_type_id . "_" . $client . "_wallet.distribution";
	
	$query="select * from $bankapi_parent_wallet.distributed_blyss order by wallet_id desc limit 0,1 ";
	$result=mysql_query($query);
	$pre=0;
	while($row=mysql_fetch_array($result))
	{
		$pre=$row['amount_bal'];
	}
	$post=$pre+$amount;
	//transaction_type=2=transfer/3=withdraw/4=chargeback
	$query2="INSERT INTO $bankapi_parent_wallet.distributed_blyss(`wallet_date`, `wallet_time`, `client_id`, `user_id`, `request_id`, `transaction_type`, `transaction_description`, `amount_pre`, `amount_cr`, `amount_dr`, `amount_bal`) VALUES ('$datetime_date', '$datetime_time', '$client', 0, '$request', 4, '$remarks_admin', '$pre', '$amount', '0', '$post')";
	mysql_query($query2);
	
	
	$query3="select * from $client_db1 order by wallet_id desc limit 0,1 ";
	$result3=mysql_query($query3);
	$pre1=0;
	while($row3=mysql_fetch_array($result3))
	{
		$pre1=$row3['amount_bal'];
	}
	$post1=$pre1-$amount;
	
	//transaction_type=1=transfer received from provider/4-chargeback
	$query4="INSERT INTO $client_db1(`wallet_date`, `wallet_time`, `user_id`, `request_id`, `service_id`, `client_order_id`, `source_order_id`, `transaction_type`, `transaction_description`, `amount_pre`, `amount_cr`, `amount_dr`, `amount_bal`) VALUES ('$datetime_date', '$datetime_time', 100001, '$request', 0, 0, 0, 4, '$remarks', '$pre1', '0', '$amount', '$post1')";
	mysql_query($query4);

	if($client_type_id!=3)
	{
		$query5="select * from $client_db2 where user_id=100001 order by wallet_id desc limit 0,1 ";
		$result5=mysql_query($query5);
		$pre2=0;
		while($row5=mysql_fetch_array($result5))
		{
			$pre2=$row5['amount_bal'];
		}
		$post2=$pre2-$amount;
		
		//transaction_type=1=transfer received from provider/12-chargeback
		$query6="INSERT INTO $client_db2(`wallet_date`, `wallet_time`, `user_id`, `user_id2`, `request_id`, `service_id`, `order_id`, `tid`, `transaction_type`, `transaction_description`, `amount_pre`, `amount_cr`, `amount_dr`, `amount_bal`, `remarks`) VALUES ('$datetime_date', '$datetime_time', 100001, 0, '$request', 0, 0, 0, 12, '$remarks', '$pre2', '0', '$amount', '$post2', '$remarks')";
		mysql_query($query6);
	}
	$query7="update $bankapi_parent_base.parent_client set bal_amt=(bal_amt+$amount) where client_id='$client';";
	mysql_query($query7);
}

function withdraw_from_client($client_type_id, $client, $amount, $remarks, $remarks_admin)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$client_db1=$bankapi_child .$client_type_id."_".$client."_wallet.realtime";
	$client_db2=$bankapi_child .$client_type_id."_".$client."_wallet.distribution";
	
	$query="select * from $bankapi_parent_wallet.distributed_blyss order by wallet_id desc limit 0,1 ";
	$result=mysql_query($query);
	$pre=0;
	while($row=mysql_fetch_array($result))
	{
		$pre=$row['amount_bal'];
	}
	$post=$pre+$amount;
	//transaction_type=3=withdraw
	$query2="INSERT INTO $bankapi_parent_wallet.distributed_blyss(`wallet_date`, `wallet_time`, `client_id`, `user_id`, `request_id`, `transaction_type`, `transaction_description`, `amount_pre`, `amount_cr`, `amount_dr`, `amount_bal`) VALUES ('$datetime_date', '$datetime_time', '$client', 0, 0, 3, '$remarks_admin', '$pre', '$amount', '0', '$post')";
	mysql_query($query2);
	
	
	$query3="select * from $client_db1 order by wallet_id desc limit 0,1 ";
	$result3=mysql_query($query3);
	$pre1=0;
	while($row3=mysql_fetch_array($result3))
	{
		$pre1=$row3['amount_bal'];
	}
	$post1=$pre1-$amount;
	
	//transaction_type=4=withdraw
	$query4="INSERT INTO $client_db1(`wallet_date`, `wallet_time`, `user_id`, `request_id`, `service_id`, `client_order_id`, `source_order_id`, `transaction_type`, `transaction_description`, `amount_pre`, `amount_cr`, `amount_dr`, `amount_bal`) VALUES ('$datetime_date', '$datetime_time', '100001', 0, 0, 0, 0, 4, '$remarks', '$pre1', '0', '$amount', '$post1')";
	mysql_query($query4);

	if($client_type_id!=3)
	{
		if($client==2000)
			$uids1=100001;
		if($client==1000)
			$uids1=200001;
		
		$query5="select * from $client_db2 where user_id='$uids1' order by wallet_id desc limit 0,1 ";
		$result5=mysql_query($query5);
		$pre2=0;
		while($row5=mysql_fetch_array($result5))
		{
			$pre2=$row5['amount_bal'];
		}
		$post2=$pre2-$amount;
		
		//transaction_type=5=withdraw
		$query6="INSERT INTO $client_db2(`wallet_date`, `wallet_time`, `user_id`, `user_id2`, `request_id`, `service_id`, `order_id`, `tid`, `transaction_type`, `transaction_description`, `amount_pre`, `amount_cr`, `amount_dr`, `amount_bal`, `remarks`) VALUES ('$datetime_date', '$datetime_time', '$uids1', 0, 0, 0, 0, 0, 5, '$remarks', '$pre2', '0', '$amount', '$post2', '$remarks')";
		mysql_query($query6);
	}
	$query7="update $bankapi_parent_base.parent_client set bal_amt=(bal_amt-$amount) where client_id='$client';";
	mysql_query($query7);
}
?>