<?php
function show_joined_level($user_id,$level)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$count=0;
	$query="SELECT count(*) nums FROM $bankapi_child_base.child_user where user_id in(SELECT user_id FROM $bankapi_child_base.child_userinfo_affiliate where id_0$level='$user_id') and join_date>=date('$dt_upto');";
	$query="SELECT count(*) nums FROM $bankapi_child_base.child_userinfo_affiliate where id_0$level='$user_id';";
	$result=mysql_query($query);
	while($rs = mysql_fetch_array($result)) 
	{
		if(isset($rs['nums']))
		$count=$rs['nums'];
	}
	return $count;
}
function show_txn_level($user_id,$level)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$count=0;
	////////////////add mt txn
	$query="select count(*) nums from $bankapi_child_txn.txn_mt_child where user_id in(SELECT user_id FROM $bankapi_child_base.child_userinfo_affiliate where id_0$level='$user_id') and order_status=2 and type=1 and created_on>='$dt_upto';";
	$result=mysql_query($query);
	while($rs = mysql_fetch_array($result)) 
	{
		if(isset($rs['nums']))
		$count=$rs['nums'];
	}
	////////////////add rc txn
	return $count;
}
function show_earn_level($user_id,$level)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$count=0.00000;
	$earn=0.00000;
	////////////////add mt earn
	if($level==1)
		$earn=.10;
	else if($level==2)
		$earn=.05;
	else if($level==3)
		$earn=.025;
	else if($level==4)
		$earn=.025;
	$query="select sum(charges*100*$earn/118) nums from $bankapi_child_txn.txn_mt_child where user_id in(SELECT user_id FROM $bankapi_child_base.child_userinfo_affiliate where id_0$level='$user_id') and order_status=2 and type=1 and created_on>='$dt_upto';";
	$result=mysql_query($query);
	while($rs = mysql_fetch_array($result)) 
	{
		if(isset($rs['nums']))
		$count=$rs['nums'];
	}
	////////////////add rc earn
	//$count=number_format((float)$count, 5, '.', '');
	return $count;
}
function show_txn_level2($user_id,$level)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$count=0;
	////////////////add mt txn
	$query="select count(*) nums from $bankapi_child_txn.txn_rc where user_id in(SELECT user_id FROM $bankapi_child_base.child_userinfo_affiliate where id_0$level='$user_id') and rc_status=2 and created_on>='$dt_upto';";
	$result=mysql_query($query);
	while($rs = mysql_fetch_array($result)) 
	{
		if(isset($rs['nums']))
		$count=$rs['nums'];
	}
	////////////////add rc txn
	return $count;
}
function show_earn_level2($user_id,$level)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$count=0.00000;
	$earn=0.00000;
	////////////////add mt earn
	if($level==1)
		$earn=.10;
	else if($level==2)
		$earn=.05;
	else if($level==3)
		$earn=.025;
	else if($level==4)
		$earn=.025;
	$query="select sum((((amount-deducted_amt)*100)/amount)*$earn) nums from $bankapi_child_txn.txn_rc where user_id in(SELECT user_id FROM $bankapi_child_base.child_userinfo_affiliate where id_0$level='$user_id') and rc_status=2 and type in(3,4,5) and created_on>='$dt_upto';";
	$result=mysql_query($query);
	while($rs = mysql_fetch_array($result)) 
	{
		if(isset($rs['nums']))
		$count=$count+$rs['nums'];
	}
	$query="select sum((((deducted_amt-amount)*100)/118)*$earn) nums from $bankapi_child_txn.txn_rc where user_id in(SELECT user_id FROM $bankapi_child_base.child_userinfo_affiliate where id_0$level='$user_id') and rc_status=2 and type in(6,7,8,9,10,11)  and created_on>='$dt_upto';";
	$result=mysql_query($query);
	while($rs = mysql_fetch_array($result)) 
	{
		if(isset($rs['nums']))
		$count=$count+$rs['nums'];
	}
	////////////////add rc earn
	//$count=number_format((float)$count, 5, '.', '');
	return $count;
}
?>