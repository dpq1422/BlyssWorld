<?php
function show_requests_count($cond)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_wallet.requests $cond and bank_id<100 and date(request_date)>date(DATE_ADD(sysdate(), INTERVAL -3868200 SECOND)) and date(request_date)>='$wdates'";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	return $total_records;
}
function show_requests_data($cond, $start_from=0, $num_rec_per_page=0)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$start_from=mysql_real_escape_string($start_from);
	$num_rec_per_page=mysql_real_escape_string($num_rec_per_page);
	if($start_from==0 && $num_rec_per_page==0)
	$query="select * from $bankapi_child_wallet.requests $cond and bank_id<100 and date(request_date)>date(DATE_ADD(sysdate(), INTERVAL -3868200 SECOND)) and date(request_date)>='$wdates' order by request_id desc ";
	else
	$query="select * from $bankapi_child_wallet.requests $cond and bank_id<100 and date(request_date)>date(DATE_ADD(sysdate(), INTERVAL -3868200 SECOND)) and date(request_date)>='$wdates' order by request_id desc LIMIT $start_from, $num_rec_per_page";
	$result=mysql_query($query);
	return $result;
}
function show_requests_count_dist($cond)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_wallet.requests $cond and bank_id>100 and date(request_date)>date(DATE_ADD(sysdate(), INTERVAL -3868200 SECOND)) and date(request_date)>='$wdates'";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	return $total_records;
}
function show_requests_data_dist($cond, $start_from=0, $num_rec_per_page=0)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$start_from=mysql_real_escape_string($start_from);
	$num_rec_per_page=mysql_real_escape_string($num_rec_per_page);
	if($start_from==0 && $num_rec_per_page==0)
	$query="select * from $bankapi_child_wallet.requests $cond and bank_id>100 and date(request_date)>date(DATE_ADD(sysdate(), INTERVAL -3868200 SECOND)) and date(request_date)>='$wdates' order by request_id desc ";
	else
	$query="select * from $bankapi_child_wallet.requests $cond and bank_id>100 and date(request_date)>date(DATE_ADD(sysdate(), INTERVAL -3868200 SECOND)) and date(request_date)>='$wdates' order by request_id desc LIMIT $start_from, $num_rec_per_page";
	$result=mysql_query($query);
	return $result;
}
function show_requests_count_dist2($cond, $myid)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_wallet.requests $cond and bank_id<100 and user_id in(select user_id from $bankapi_child_base.child_userinfo_level where id_01='$myid' or id_02='$myid' or id_03='$myid' or id_04='$myid' or id_05='$myid' or id_06='$myid' or id_07='$myid' or id_08='$myid' or id_09='$myid' or id_10='$myid' or id_11='$myid') and date(request_date)>date(DATE_ADD(sysdate(), INTERVAL -3868200 SECOND)) and date(request_date)>='$wdates'";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	return $total_records;
}
function show_requests_data_dist2($cond, $myid, $start_from=0, $num_rec_per_page=0)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$start_from=mysql_real_escape_string($start_from);
	$num_rec_per_page=mysql_real_escape_string($num_rec_per_page);
	if($start_from==0 && $num_rec_per_page==0)
	$query="select * from $bankapi_child_wallet.requests $cond and bank_id<100 and user_id in(select user_id from $bankapi_child_base.child_userinfo_level where id_01='$myid' or id_02='$myid' or id_03='$myid' or id_04='$myid' or id_05='$myid' or id_06='$myid' or id_07='$myid' or id_08='$myid' or id_09='$myid' or id_10='$myid' or id_11='$myid') and date(request_date)>date(DATE_ADD(sysdate(), INTERVAL -3868200 SECOND)) and date(request_date)>='$wdates' order by request_id desc ";
	else
	$query="select * from $bankapi_child_wallet.requests $cond and bank_id<100 and user_id in(select user_id from $bankapi_child_base.child_userinfo_level where id_01='$myid' or id_02='$myid' or id_03='$myid' or id_04='$myid' or id_05='$myid' or id_06='$myid' or id_07='$myid' or id_08='$myid' or id_09='$myid' or id_10='$myid' or id_11='$myid') and date(request_date)>date(DATE_ADD(sysdate(), INTERVAL -3868200 SECOND)) and date(request_date)>='$wdates' order by request_id desc LIMIT $start_from, $num_rec_per_page";
	$result=mysql_query($query);
	return $result;
}
?>