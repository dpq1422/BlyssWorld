<?php
function show_operators_count($cond)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_parent_base.all_operator $cond ";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	return $total_records;
}
function show_operators_data($cond, $start_from=0, $num_rec_per_page=0)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$start_from=mysql_real_escape_string($start_from);
	$num_rec_per_page=mysql_real_escape_string($num_rec_per_page);
	if($start_from==0 && $num_rec_per_page==0)
	$query="select * from $bankapi_parent_base.all_operator $cond order by operator_status desc,service_id,operator_name";
	else
	$query="select * from $bankapi_parent_base.all_operator $cond order by operator_status desc,service_id,operator_name LIMIT $start_from, $num_rec_per_page";
	$result=mysql_query($query);
	return $result;
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
function show_operator_id($operator_name,$source)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$operator_id=0;
	$field="";
	if($source==2)
		$field="api_code_1";
	else if($source==3)
		$field="operator_name";
	else if($source==4)
		$field="operator_name";
	$query="select * from $bankapi_parent_base.all_operator where $field='$operator_name';";
	$result=mysql_query($query);
	$operator_id=mysql_fetch_array($result)['operator_id'];
	return $operator_id;
}
function show_operator_ids($operator_name,$source,$service)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$operator_id="";
	$field="";
	if($source==2)
		$field="api_code_1";
	else if($source==3)
		$field="operator_name";
	else if($source==4)
		$field="operator_name";
	$query="select * from $bankapi_parent_base.all_operator where $field='$operator_name' and service_id='$service';";
	$result=mysql_query($query);
	$operator_id=mysql_fetch_array($result)['operator_id'];
	return $operator_id;
}
?>