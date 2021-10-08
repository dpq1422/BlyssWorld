<?php
function show_levels_count($cond)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_parent_base.all_level $cond ";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	return $total_records;
}
function show_levels_data($cond, $start_from=0, $num_rec_per_page=0)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$start_from=mysql_real_escape_string($start_from);
	$num_rec_per_page=mysql_real_escape_string($num_rec_per_page);
	if($start_from==0 && $num_rec_per_page==0)
	$query="select * from $bankapi_parent_base.all_level $cond order by level_status desc,level_type,level_id ";
	else
	$query="select * from $bankapi_parent_base.all_level $cond order by level_status desc,level_type,level_id LIMIT $start_from, $num_rec_per_page";
	$result=mysql_query($query);
	return $result;
}
function show_level_name($level_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$level_name="";
	$query="select * from $bankapi_parent_base.all_level where level_id=$level_id";
	$result=mysql_query($query);
	$level_name=mysql_fetch_array($result)['level_name'];
	return $level_name;
}
?>