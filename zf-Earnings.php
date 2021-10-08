<?php
function show_datewise_earning_count($cond)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="SELECT date(date_time) dt,source,client_id cl,sum(cr) cr,sum(dr) dr from $bankapi_parent_txn.com_paid_child $cond group by date(date_time),source,client_id having (cr!=0 or dr!=0) order by date(date_time) desc;";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	return $total_records;
}
function show_datewise_earning_data($cond, $start_from=0, $num_rec_per_page=0)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$start_from=mysql_real_escape_string($start_from);
	$num_rec_per_page=mysql_real_escape_string($num_rec_per_page);
	if($start_from==0 && $num_rec_per_page==0)
	$query="SELECT date(date_time) dt,source,client_id cl,sum(cr) cr,sum(dr) dr from $bankapi_parent_txn.com_paid_child $cond group by date(date_time),source,client_id having (cr!=0 or dr!=0) order by date(date_time) desc;";
	else
	$query="SELECT date(date_time) dt,source,client_id cl,sum(cr) cr,sum(dr) dr from $bankapi_parent_txn.com_paid_child $cond group by date(date_time),source,client_id having (cr!=0 or dr!=0) order by date(date_time) desc LIMIT $start_from, $num_rec_per_page;";
	$result=mysql_query($query);
	return $result;
}
?>