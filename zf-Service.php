<?php
function show_services_count($cond)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_parent_base.parent_service $cond ";
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
	$query="select * from $bankapi_parent_base.parent_service $cond ";
	else
	$query="select * from $bankapi_parent_base.parent_service $cond order by service_status desc, service_type LIMIT $start_from, $num_rec_per_page";
	$result=mysql_query($query);
	return $result;
}
function show_service_name($service_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$service_name="";
	$query="select * from $bankapi_parent_base.parent_service where service_id=$service_id";
	$result=mysql_query($query);
	$service_name=mysql_fetch_array($result)['service_name'];
	return $service_name;
}
?>