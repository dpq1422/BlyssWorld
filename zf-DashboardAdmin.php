<?php
function update_all_wallet()
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$min=$max=0;
	$query="SELECT min(user_id) mins,max(user_id) maxs FROM $bankapi_child_base.child_user where user_id>=100000;";
	$result=mysql_query($query);
	while($rs = mysql_fetch_array($result)) 
	{
		$min=$rs['mins'];
		$max=$rs['maxs'];
	}
	for($i=90001;$i<=90010;$i++)
	{
			update_user_balances($i);
			calculate_payout($i);
	}
	for($i=$min;$i<=$max;$i++)
	{
		if(is_user_exists($i)!=0)
		{
			update_user_balances($i);
			calculate_payout($i);
		}
	}
}
function rf_txn()
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$a=$b=$c=$d=$e=$f=0;
	$query="SELECT sum(amount) a,sum(com_charged-6) c,count(*) n FROM $bankapi_child_txn.txn_mt_child where order_status=-4 and type=1";
	$result=mysql_query($query);
	while($rs = mysql_fetch_array($result)) 
	{
		$a=$rs['a'];
		$b=$rs['c'];
		$c=$rs['n'];
	}
	if($a=="")
	$a=0;
	if($b=="")
	$b=0;
	if($c=="")
	$c=0;
	$query="SELECT sum(amount) a,sum(com_charged-6) c,count(*) n FROM $bankapi_child_txn.txn_mt_child where order_status=4 and type=1";
	$result=mysql_query($query);
	while($rs = mysql_fetch_array($result)) 
	{
		$d=$rs['a'];
		$e=$rs['c'];
		$f=$rs['n'];
	}
	if($d=="")
	$d=0;
	if($e=="")
	$e=0;
	if($f=="")
	$f=0;

	$arr=array($a,$b,$c,$d,$e,$f);
	return $arr;
}

function ip_txn()
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$a=$b=$c=$d=$e=$f=0;
	$query="SELECT sum(amount) a,sum(com_charged-6) c,count(*) n FROM $bankapi_child_txn.txn_mt_child where order_status in(1,3) and type=1";
	$result=mysql_query($query);
	while($rs = mysql_fetch_array($result)) 
	{
		$a=$rs['a'];
		$b=$rs['c'];
		$c=$rs['n'];
	}
	if($a=="")
	$a=0;
	if($b=="")
	$b=0;
	if($c=="")
	$c=0;
	$query="SELECT sum(amount) a,sum(com_charged-6) c,count(*) n FROM $bankapi_child_txn.txn_mt_child where order_status in(-1,-2) and type=1";
	$result=mysql_query($query);
	while($rs = mysql_fetch_array($result)) 
	{
		$d=$rs['a'];
		$e=$rs['c'];
		$f=$rs['n'];
	}
	if($d=="")
	$d=0;
	if($e=="")
	$e=0;
	if($f=="")
	$f=0;

	$arr=array($a,$b,$c,$d,$e,$f);
	return $arr;
}
function is_user_exists($user_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="SELECT * FROM $bankapi_child_base.child_user where user_id='$user_id';";
	$result=mysql_query($query);
	$num_rows = mysql_num_rows($result);
	return $num_rows;
}
function calculate_payout($user_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="SELECT date(date_time) dt,sum(cr) cr,sum(dr) dr FROM $bankapi_child_txn.com_paid_child where user_id='$user_id' group by date(date_time) order by date(date_time)";
	$result=mysql_query($query);
	$num_rows = mysql_num_rows($result);
	$bal=0;
	$query2="delete FROM $bankapi_child_txn.com_paid_parent where user_id='$user_id';";
	$result2=mysql_query($query2);
	while($rs = mysql_fetch_array($result))
	{
		$dt=$rs['dt'];
		$cr=$rs['cr'];
		$dr=$rs['dr'];
		$bal=$bal+$cr-$dr;
		$query3="insert into $bankapi_child_txn.com_paid_parent(date_time,user_id,cr,dr,bal) value('$dt','$user_id','$cr','$dr','$bal');";
		$result3=mysql_query($query3);
	}
}
function update_user_balances($user)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$bal=show_user_balances($user);
	$query="update $bankapi_child_base.child_userinfo_walletkyc set wallet_balance='$bal' where user_id='$user';";
	mysql_query($query);
}
function show_rt_balances()
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_wallet.realtime order by wallet_id desc limit 0,1 ";
	$result=mysql_query($query);
	$bal=0;
	while($row=mysql_fetch_array($result))
	{
		$bal=$row['amount_bal'];
	}
	return $bal;
}
function show_dummy_balances()
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	
	$query="select * from $bankapi_parent_base.parent_client where client_id='$clientdbid';";
	$result=mysql_query($query);
	$bal=0;
	while($row=mysql_fetch_array($result))
	{
		$bal=$row['dummy_balance'];
	}
	return $bal;
}
function show_user_balances($user)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	
	$query="select * from $bankapi_child_wallet.distribution where user_id='$user' order by wallet_id desc limit 0,1 ";
	$result=mysql_query($query);
	$bal=0;
	while($row=mysql_fetch_array($result))
	{
		$bal=$row['amount_bal'];
	}
	return $bal;
}
function show_team_balances()
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	
	$query="select sum(wallet_balance) bal from $bankapi_child_base.child_userinfo_walletkyc where user_type between 2 and 11;";
	$result=mysql_query($query);
	$bal=0;
	while($row=mysql_fetch_array($result))
	{
		$bal=$row['bal'];
	}
	return $bal;
}
function show_retailer_balances()
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	
	$query="select sum(wallet_balance) bal from $bankapi_child_base.child_userinfo_walletkyc where user_type=12;";
	$result=mysql_query($query);
	$bal=0;
	while($row=mysql_fetch_array($result))
	{
		$bal=$row['bal'];
	}
	return $bal;
}
function show_dist_balances()
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	
	$query="SELECT sum(cr-dr) as amt FROM $bankapi_child_txn.com_paid_child;";
	$result=mysql_query($query);
	$admin_comm=0;
	$num_rows = mysql_num_rows($result);
	if($num_rows>0)
	{
		while($rs = mysql_fetch_array($result)) {
			$admin_comm=$rs['amt'];
		}
	}
	if($admin_comm=="")
	$admin_comm=0;

	return $admin_comm;
}
function admin_wallet_status()
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$a=$b=$c=$d=0;
	$query="SELECT * FROM $bankapi_child_wallet.distribution where user_id=$main_admin and wallet_date<'$datetime_date' order by wallet_id desc limit 0,1";
	$result=mysql_query($query);
	while($rs = mysql_fetch_array($result)) 
	{
		$a=$rs['amount_bal'];
	}
	if($a=="")
	$a=0;
	
	$query="SELECT sum(amount_cr) as amt FROM $bankapi_child_wallet.distribution where user_id=$main_admin and transaction_type in(1,5,21,13) and wallet_date='$datetime_date'";
	$result=mysql_query($query);
	while($rs = mysql_fetch_array($result)) 
	{
		$b=$rs['amt'];
	}
	if($b=="")
	$b=0;
	
	$query="SELECT sum(amount_dr) as amt FROM $bankapi_child_wallet.distribution where user_id=$main_admin and transaction_type in(2,3,4) and wallet_date='$datetime_date'";
	$result=mysql_query($query);
	while($rs = mysql_fetch_array($result)) 
	{
		$c=$rs['amt'];
	}
	if($c=="")
	$c=0;

	$d=$a+$b-$c;
	$a=number_format((float)$a, 2, '.', '');
	$b=number_format((float)$b, 2, '.', '');
	$c=number_format((float)$c, 2, '.', '');
	$d=number_format((float)$d, 2, '.', '');
	$arr=array($a,$b,$c,$d);
	return $arr;
}
?>