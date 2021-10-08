<?php
function show_mt_success($user_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$count=0;
	$query="SELECT count(*) nums FROM $bankapi_child_txn.txn_mt_child where user_id='$user_id' and date(created_on)='$datetime_date' and order_status=2;";
	$result=mysql_query($query);
	while($rs = mysql_fetch_array($result)) 
	{
		if(isset($rs['nums']))
		$count=$rs['nums'];
	}
	return $count;
}
function show_mt_in_progress($user_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$count=0;
	$query="SELECT count(*) nums FROM $bankapi_child_txn.txn_mt_child where user_id='$user_id' and date(created_on)='$datetime_date' and order_status in(-1,-2,1,3);";
	$result=mysql_query($query);
	while($rs = mysql_fetch_array($result)) 
	{
		if(isset($rs['nums']))
		$count=$rs['nums'];
	}
	return $count;
}
function show_mt_pending_refund($user_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$count=0;
	$query="SELECT count(*) nums FROM $bankapi_child_txn.txn_mt_child where user_id='$user_id' and date(created_on)='$datetime_date' and order_status in(-4,4);";
	$result=mysql_query($query);
	while($rs = mysql_fetch_array($result)) 
	{
		if(isset($rs['nums']))
		$count=$rs['nums'];
	}
	return $count;
}
function show_mt_refunded($user_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$count=0;
	$query="SELECT count(*) nums FROM $bankapi_child_txn.txn_mt_child where user_id='$user_id' and date(created_on)='$datetime_date' and order_status=5;";
	$result=mysql_query($query);
	while($rs = mysql_fetch_array($result)) 
	{
		if(isset($rs['nums']))
		$count=$rs['nums'];
	}
	return $count;
}
function show_rc_success($user_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$count=0;
	$query="SELECT count(*) nums FROM $bankapi_child_txn.txn_rc where user_id='$user_id' and date(created_on)='$datetime_date' and rc_status=2;";
	$result=mysql_query($query);
	while($rs = mysql_fetch_array($result)) 
	{
		if(isset($rs['nums']))
		$count=$rs['nums'];
	}
	return $count;
}
function show_rc_in_progress($user_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$count=0;
	$query="SELECT count(*) nums FROM $bankapi_child_txn.txn_rc where user_id='$user_id' and date(created_on)='$datetime_date' and rc_status in(-1,-2,1,3);";
	$result=mysql_query($query);
	while($rs = mysql_fetch_array($result)) 
	{
		if(isset($rs['nums']))
		$count=$rs['nums'];
	}
	return $count;
}
function show_rc_pending_refund($user_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$count=0;
	$query="SELECT count(*) nums FROM $bankapi_child_txn.txn_rc where user_id='$user_id' and date(created_on)='$datetime_date' and rc_status in(-4,4);";
	$result=mysql_query($query);
	while($rs = mysql_fetch_array($result)) 
	{
		if(isset($rs['nums']))
		$count=$rs['nums'];
	}
	return $count;
}
function show_rc_refunded($user_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$count=0;
	$query="SELECT count(*) nums FROM $bankapi_child_txn.txn_rc where user_id='$user_id' and date(created_on)='$datetime_date' and rc_status=5;";
	$result=mysql_query($query);
	while($rs = mysql_fetch_array($result)) 
	{
		if(isset($rs['nums']))
		$count=$rs['nums'];
	}
	return $count;
}
?>