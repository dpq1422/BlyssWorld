<?php
function show_sources_count($cond)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_parent_base.all_source $cond ";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	return $total_records;
}
function show_sources_data($cond, $start_from=0, $num_rec_per_page=0)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$start_from=mysql_real_escape_string($start_from);
	$num_rec_per_page=mysql_real_escape_string($num_rec_per_page);
	if($start_from==0 && $num_rec_per_page==0)
	$query="select * from $bankapi_parent_base.all_source $cond ";
	else
	$query="select * from $bankapi_parent_base.all_source $cond LIMIT $start_from, $num_rec_per_page";
	$result=mysql_query($query);
	return $result;
}
function show_source_name($source_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$source_name="";
	$query="select * from $bankapi_parent_base.all_source where source_id=$source_id";
	$result=mysql_query($query);
	$source_name=mysql_fetch_array($result)['source_name'];
	return $source_name;
}
?>