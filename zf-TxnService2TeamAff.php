<?php
function show_txn_count($cond, $uid)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_txn.txn_rc $cond and user_id in (select user_id from $bankapi_child_base.child_userinfo_affiliate where user_type=12 and (id_01='$uid' or id_02='$uid' or id_03='$uid' or id_04='$uid')) and rc_status=2 and created_on>='$dt_upto'";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	return $total_records;
}
function show_txn_data($cond, $start_from=0, $num_rec_per_page=0, $uid)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$start_from=mysql_real_escape_string($start_from);
	$num_rec_per_page=mysql_real_escape_string($num_rec_per_page);
	if($start_from==0 && $num_rec_per_page==0)
	$query="select * from $bankapi_child_txn.txn_rc $cond and user_id in (select user_id from $bankapi_child_base.child_userinfo_affiliate where user_type=12 and (id_01='$uid' or id_02='$uid' or id_03='$uid' or id_04='$uid')) and rc_status=2 and created_on>='$dt_upto' order by rc_id desc ";
	else
	$query="select * from $bankapi_child_txn.txn_rc $cond and user_id in (select user_id from $bankapi_child_base.child_userinfo_affiliate where user_type=12 and (id_01='$uid' or id_02='$uid' or id_03='$uid' or id_04='$uid')) and rc_status=2 and created_on>='$dt_upto' order by rc_id desc LIMIT $start_from, $num_rec_per_page";
	$result=mysql_query($query);
	return $result;
}
?>