<?php
function show_services_count($cond)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_base.child_service $cond and service_status=1 ";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	return $total_records;
}
function show_services_data($cond, $start_from=0, $num_rec_per_page=0)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$start_from=mysql_real_escape_string($start_from);
	$num_rec_per_page=mysql_real_escape_string($num_rec_per_page);
	if($start_from==0 && $num_rec_per_page==0)
	$query="select * from $bankapi_child_base.child_service $cond and service_status=1 ";
	else
	$query="select * from $bankapi_child_base.child_service $cond and service_status=1 LIMIT $start_from, $num_rec_per_page";
	$result=mysql_query($query);
	return $result;
}
function show_service_name($service_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$service_name="";
	$query="select * from $bankapi_child_base.child_service where service_id=$service_id";
	$result=mysql_query($query);
	$service_name=mysql_fetch_array($result)['service_name'];
	return $service_name;
}
function show_operator_name($operator_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$operator_name="";
	$query="select * from $bankapi_parent_base.all_operator where operator_id=$operator_id";
	$result=mysql_query($query);
	$operator_name=mysql_fetch_array($result)['operator_name'];
	return $operator_name;
}
?>