<?php
function show_txn_count($cond)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_txn.txn_mt_parent $cond and date(date_time)>date(DATE_ADD(sysdate(), INTERVAL -38682000 SECOND))";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	return $total_records;
}
function show_txn_data($cond, $start_from=0, $num_rec_per_page=0)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$val="date(DATE_ADD(sysdate(), INTERVAL 3907800 SECOND))";
	$start_from=mysql_real_escape_string($start_from);
	$num_rec_per_page=mysql_real_escape_string($num_rec_per_page);
	if($start_from==0 && $num_rec_per_page==0)
	$query="select * from $bankapi_child_txn.txn_mt_parent $cond and date(date_time)>date(DATE_ADD(sysdate(), INTERVAL -38682000 SECOND)) order by txn_id desc ";
	else
	$query="select * from $bankapi_child_txn.txn_mt_parent $cond and date(date_time)>date(DATE_ADD(sysdate(), INTERVAL -38682000 SECOND)) order by txn_id desc LIMIT $start_from, $num_rec_per_page";
	$result=mysql_query($query);
	return $result;
}
function show_txn_order_data($cond, $start_from=0, $num_rec_per_page=0)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$start_from=mysql_real_escape_string($start_from);
	$num_rec_per_page=mysql_real_escape_string($num_rec_per_page);
	if($start_from==0 && $num_rec_per_page==0)
	$query="select * from $bankapi_child_txn.txn_mt_child $cond and date(created_on)>date(DATE_ADD(sysdate(), INTERVAL -38682000 SECOND)) order by order_id ";
	else
	$query="select * from $bankapi_child_txn.txn_mt_child $cond and date(created_on)>date(DATE_ADD(sysdate(), INTERVAL -38682000 SECOND)) order by order_id LIMIT $start_from, $num_rec_per_page";
	$result=mysql_query($query);
	return $result;
}
function show_txn_orders_count($cond)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_txn.txn_mt_child $cond and (date(created_on)>date(DATE_ADD(sysdate(), INTERVAL -38682000 SECOND)) or order_status in(-4,4))";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	return $total_records;
}
function show_txn_orders_data($cond, $start_from=0, $num_rec_per_page=0)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$start_from=mysql_real_escape_string($start_from);
	$num_rec_per_page=mysql_real_escape_string($num_rec_per_page);
	if($start_from==0 && $num_rec_per_page==0)
	$query="select * from $bankapi_child_txn.txn_mt_child $cond and (date(created_on)>date(DATE_ADD(sysdate(), INTERVAL -38682000 SECOND)) or order_status in(-4,4)) order by order_id desc ";
	else
	$query="select * from $bankapi_child_txn.txn_mt_child $cond and (date(created_on)>date(DATE_ADD(sysdate(), INTERVAL -38682000 SECOND)) or order_status in(-4,4)) order by order_id desc LIMIT $start_from, $num_rec_per_page";
	$result=mysql_query($query);
	return $result;
}
function show_txn_orders_datar($cond, $start_from=0, $num_rec_per_page=0)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$start_from=mysql_real_escape_string($start_from);
	$num_rec_per_page=mysql_real_escape_string($num_rec_per_page);
	if($start_from==0 && $num_rec_per_page==0)
	$query="select * from $bankapi_child_txn.txn_mt_child $cond and (date(created_on)>date(DATE_ADD(sysdate(), INTERVAL -38682000 SECOND)) or order_status in(-4,4)) order by refund_retailer_tid desc ";
	else
	$query="select * from $bankapi_child_txn.txn_mt_child $cond and (date(created_on)>date(DATE_ADD(sysdate(), INTERVAL -38682000 SECOND)) or order_status in(-4,4)) order by refund_retailer_tid desc LIMIT $start_from, $num_rec_per_page";
	$result=mysql_query($query);
	return $result;
}
function show_sender_txn_data($user, $sender)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_txn.txn_mt_child where user_id='$user' and sender_number='$sender' and  (date(created_on)>date(DATE_ADD(sysdate(), INTERVAL -38682000 SECOND)) or order_status in(-4,4)) order by order_id desc LIMIT 0,20;";
	$result=mysql_query($query);
	return $result;
}
function show_sender_txn_datas($user, $sender, $source)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_txn.txn_mt_child where user_id='$user' and sender_number='$sender' and source='$source' and  (date(created_on)>date(DATE_ADD(sysdate(), INTERVAL -38682000 SECOND)) or order_status in(-4,4)) order by order_id desc LIMIT 0,20;";
	$result=mysql_query($query);
	return $result;
}
?>