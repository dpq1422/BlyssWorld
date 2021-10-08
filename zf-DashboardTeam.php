<?php
function opening_balance($user_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$bal=0;
	$query="SELECT * FROM $bankapi_child_wallet.distribution where user_id='$user_id' and wallet_date<'$datetime_date' order by wallet_id desc limit 0,1;";
	$result=mysql_query($query);
	while($rs = mysql_fetch_array($result)) 
	{
		if(isset($rs['amount_bal']))
		$bal=$rs['amount_bal'];
	}
	return $bal;
}
function wallet_update($user_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$bal=$bal1=$bal2=0;
	$query="SELECT sum(amount_cr) as amt FROM $bankapi_child_wallet.distribution where user_id='$user_id' and transaction_type=1 and wallet_date='$datetime_date';";
	$result=mysql_query($query);
	while($rs = mysql_fetch_array($result)) 
	{
		if(isset($rs['amt']))
		$bal1=$rs['amt'];
	}
	$query="SELECT sum(amount_dr) as amt FROM $bankapi_child_wallet.distribution where user_id='$user_id' and transaction_type=5 and wallet_date='$datetime_date';";
	$result=mysql_query($query);
	while($rs = mysql_fetch_array($result)) 
	{
		if(isset($rs['amt']))
		$bal2=$rs['amt'];
	}
	$bal=$bal1-$bal2;
	return $bal;
}
function wallet_transfer($user_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$bal=0;
	$query="SELECT sum(amount_dr) as amt FROM $bankapi_child_wallet.distribution where user_id='$user_id' and transaction_type=4 and wallet_date='$datetime_date';";
	$result=mysql_query($query);
	while($rs = mysql_fetch_array($result)) 
	{
		if(isset($rs['amt']))
		$bal=$rs['amt'];
	}
	return $bal;
}
function closing_balance($user_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$bal=0;
	$query="SELECT * FROM $bankapi_child_wallet.distribution where user_id='$user_id' order by wallet_id desc limit 0,1;";
	$result=mysql_query($query);
	while($rs = mysql_fetch_array($result)) 
	{
		if(isset($rs['amount_bal']))
		$bal=$rs['amount_bal'];
	}
	return $bal;
}
function show_member_count($logged_user_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$bal=0;
	$query="SELECT count(*) nums FROM $bankapi_child_base.child_userinfo_level WHERE user_type between 2 and 11 and (id_02 = '$logged_user_id' or id_03 = '$logged_user_id' or id_04 = '$logged_user_id' or id_05 = '$logged_user_id' or id_06 = '$logged_user_id' or id_07 = '$logged_user_id' or id_08 = '$logged_user_id' or id_09 = '$logged_user_id' or id_10 = '$logged_user_id' or id_11 = '$logged_user_id');";
	$result=mysql_query($query);
	while($rs = mysql_fetch_array($result)) 
	{
		if(isset($rs['nums']))
		$bal=$rs['nums'];
	}
	return $bal;
}
function show_member_balance($logged_user_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$bal=0;
	$query="SELECT sum(wallet_balance) bal FROM $bankapi_child_base.child_userinfo_walletkyc where user_id in(SELECT user_id FROM $bankapi_child_base.child_userinfo_level WHERE user_type between 2 and 11 and (id_02 = '$logged_user_id' or id_03 = '$logged_user_id' or id_04 = '$logged_user_id' or id_05 = '$logged_user_id' or id_06 = '$logged_user_id' or id_07 = '$logged_user_id' or id_08 = '$logged_user_id' or id_09 = '$logged_user_id' or id_10 = '$logged_user_id' or id_11 = '$logged_user_id'));";
	$result=mysql_query($query);
	while($rs = mysql_fetch_array($result)) 
	{
		if(isset($rs['bal']))
		$bal=$rs['bal'];
	}
	return $bal;
}
function show_retailer_count($logged_user_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$bal=0;
	$query="SELECT count(*) nums FROM $bankapi_child_base.child_userinfo_level WHERE user_type=12 and (id_02 = '$logged_user_id' or id_03 = '$logged_user_id' or id_04 = '$logged_user_id' or id_05 = '$logged_user_id' or id_06 = '$logged_user_id' or id_07 = '$logged_user_id' or id_08 = '$logged_user_id' or id_09 = '$logged_user_id' or id_10 = '$logged_user_id' or id_11 = '$logged_user_id');";
	$result=mysql_query($query);
	while($rs = mysql_fetch_array($result)) 
	{
		if(isset($rs['nums']))
		$bal=$rs['nums'];
	}
	return $bal;
}
function show_retailer_balance($logged_user_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$bal=0;
	$query="SELECT sum(wallet_balance) bal FROM $bankapi_child_base.child_userinfo_walletkyc where user_id in(SELECT user_id FROM $bankapi_child_base.child_userinfo_level WHERE user_type=12 and (id_02 = '$logged_user_id' or id_03 = '$logged_user_id' or id_04 = '$logged_user_id' or id_05 = '$logged_user_id' or id_06 = '$logged_user_id' or id_07 = '$logged_user_id' or id_08 = '$logged_user_id' or id_09 = '$logged_user_id' or id_10 = '$logged_user_id' or id_11 = '$logged_user_id'));";
	$result=mysql_query($query);
	while($rs = mysql_fetch_array($result)) 
	{
		if(isset($rs['bal']))
		$bal=$rs['bal'];
	}
	return $bal;
}
?>