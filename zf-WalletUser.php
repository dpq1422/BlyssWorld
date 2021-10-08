<?php
function show_wallet_count($cond)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_wallet.distribution $cond and date(wallet_date)>date(DATE_ADD(sysdate(), INTERVAL -38682000 SECOND)) and date(wallet_date)>='$wdates'";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	return $total_records;
}
function show_wallet_data($cond, $start_from=0, $num_rec_per_page=0)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$start_from=mysql_real_escape_string($start_from);
	$num_rec_per_page=mysql_real_escape_string($num_rec_per_page);
	if($start_from==0 && $num_rec_per_page==0)
	$query="select * from $bankapi_child_wallet.distribution $cond and date(wallet_date)>date(DATE_ADD(sysdate(), INTERVAL -38682000 SECOND)) and date(wallet_date)>='$wdates' order by wallet_date desc,wallet_time desc, wallet_id desc ";
	else
	$query="select * from $bankapi_child_wallet.distribution $cond and date(wallet_date)>date(DATE_ADD(sysdate(), INTERVAL -38682000 SECOND)) and date(wallet_date)>='$wdates' order by wallet_date desc,wallet_time desc, wallet_id desc LIMIT $start_from, $num_rec_per_page";
	$result=mysql_query($query);
	return $result;
}
function show_wallet_count2($cond)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_wallet.distribution $cond and date(wallet_date)>='$wdates' ";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	return $total_records;
}
function show_wallet_data2($cond, $start_from=0, $num_rec_per_page=0)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$start_from=mysql_real_escape_string($start_from);
	$num_rec_per_page=mysql_real_escape_string($num_rec_per_page);
	if($start_from==0 && $num_rec_per_page==0)
	$query="select * from $bankapi_child_wallet.distribution $cond and date(wallet_date)>='$wdates' order by wallet_date desc,wallet_time desc, wallet_id desc ";
	else
	$query="select * from $bankapi_child_wallet.distribution $cond and date(wallet_date)>='$wdates' order by wallet_date desc,wallet_time desc, wallet_id desc LIMIT $start_from, $num_rec_per_page";
	$result=mysql_query($query);
	return $result;
}
?>