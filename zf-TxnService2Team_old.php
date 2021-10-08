<?php
function show_txn_count($cond, $uid)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_txn.txn_rc $cond and user_id in (select user_id from $bankapi_child_base.child_userinfo_level where user_type=12 and (id_01='$uid' or id_02='$uid' or id_03='$uid' or id_04='$uid' or id_05='$uid' or id_06='$uid' or id_07='$uid' or id_08='$uid' or id_09='$uid' or id_10='$uid' or id_11='$uid')) ";
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
	$query="select * from $bankapi_child_txn.txn_rc $cond and user_id in (select user_id from $bankapi_child_base.child_userinfo_level where user_type=12 and (id_01='$uid' or id_02='$uid' or id_03='$uid' or id_04='$uid' or id_05='$uid' or id_06='$uid' or id_07='$uid' or id_08='$uid' or id_09='$uid' or id_10='$uid' or id_11='$uid')) order by rc_id desc ";
	else
	$query="select * from $bankapi_child_txn.txn_rc $cond and user_id in (select user_id from $bankapi_child_base.child_userinfo_level where user_type=12 and (id_01='$uid' or id_02='$uid' or id_03='$uid' or id_04='$uid' or id_05='$uid' or id_06='$uid' or id_07='$uid' or id_08='$uid' or id_09='$uid' or id_10='$uid' or id_11='$uid')) order by rc_id desc LIMIT $start_from, $num_rec_per_page";
	$result=mysql_query($query);
	return $result;
}
?>