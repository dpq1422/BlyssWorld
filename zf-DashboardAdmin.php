<?php
function show_client_dummy_balancess($client)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$bal=0;
	$query="select * from $bankapi_parent_base.parent_client where client_id='$client' ";
	$result=mysql_query($query);
	while($row=mysql_fetch_array($result))
	{
		$bal=$row['dummy_balance'];
		if(!isset($bal))
			$bal=0;
	}
	return $bal;
}

function show_val($qry)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$bal=0;
	$result=mysql_query($qry);
	while($row=mysql_fetch_array($result))
	{
		$bal=$row['bal'];
		if(!isset($bal))
			$bal=0;
	}
	return $bal;
}

function show_client_balancess($type,$client)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$dbsd=$bankapi_child."".$type."_".$client."_wallet";
	$bal=0;
	$query="select * from $dbsd.realtime order by wallet_id desc limit 0,1;";
	$result=mysql_query($query);
	while($row=mysql_fetch_array($result))
	{
		$bal=$row['amount_bal'];
		if(!isset($bal))
			$bal=0;
	}
	return $bal;
}
function show_distributed_balancess()
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$bal=0;
	$query="SELECT * FROM $bankapi_parent_wallet.distributed_blyss order by wallet_id desc limit 0,1 ";
	$result=mysql_query($query);
	while($row=mysql_fetch_array($result))
	{
		$bal=$row['amount_bal'];
		if(!isset($bal))
			$bal=0;
	}
	return $bal;
}
function show_mentor_earningss($client)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$bal=0;
	$query="SELECT sum(cr-dr) earning FROM $bankapi_parent_txn.com_paid_child where client_id='$client';";
	$result=mysql_query($query);
	while($row=mysql_fetch_array($result))
	{
		$bal=$row['earning'];
		if(!isset($bal))
			$bal=0;
	}
	return $bal;
}
function txn_status_countss($cond)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$bal=0;
	$query="SELECT count(*) nums FROM $bankapi_parent_txn.$cond";
	$result=mysql_query($query);
	while($row=mysql_fetch_array($result))
	{
		$bal=$row['nums'];
		if(!isset($bal))
			$bal=0;
	}
	return $bal;
}
function txn_holding_amountss($cond)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$bal1=0;
	$bal2=0;
	$query="SELECT count(*) nums,sum(amount) amt FROM $bankapi_parent_txn.$cond;";
	$result=mysql_query($query);
	while($row=mysql_fetch_array($result))
	{
		$bal1=$row['nums'];
		$bal2=$row['amt'];
		if(!isset($bal1))
			$bal1=0;
		if(!isset($bal2))
			$bal2=0;
	}
	$bal=array($bal1,$bal2);
	return $bal;
}
function base_status_countss($cond)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$bal=0;
	$query="SELECT count(*) nums FROM $bankapi_parent_base.$cond";
	$result=mysql_query($query);
	while($row=mysql_fetch_array($result))
	{
		$bal=$row['nums'];
		if(!isset($bal))
			$bal=0;
	}
	return $bal;
}
function base_status_countss2($cond)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$bal=0;
	$query="SELECT count(*) nums FROM $bankapi_child"."2_2000_base".".$cond";
	$result=mysql_query($query);
	while($row=mysql_fetch_array($result))
	{
		$bal=$row['nums'];
		if(!isset($bal))
			$bal=0;
	}
	return $bal;
}
?>