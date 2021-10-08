<?php
function show_levels_count($cond)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_base.child_level $cond and level_status=1 ";
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
	$query="select * from $bankapi_child_base.child_level $cond and level_status=1 order by level_status desc,level_type,level_id ";
	else
	$query="select * from $bankapi_child_base.child_level $cond and level_status=1 order by level_status desc,level_type,level_id LIMIT $start_from, $num_rec_per_page";
	$result=mysql_query($query);
	return $result;
}
function show_levels_data_desc($cond, $start_from=0, $num_rec_per_page=0)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$start_from=mysql_real_escape_string($start_from);
	$num_rec_per_page=mysql_real_escape_string($num_rec_per_page);
	if($start_from==0 && $num_rec_per_page==0)
	$query="select * from $bankapi_child_base.child_level $cond and level_status=1 order by level_id desc";
	else
	$query="select * from $bankapi_child_base.child_level $cond and level_status=1 order by level_id desc LIMIT $start_from, $num_rec_per_page";
	$result=mysql_query($query);
	return $result;
}
function show_level_user_count($level_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_base.child_user where user_type='$level_id' ";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	return $total_records;
}
function show_level_name($level_id)
{
	$level_name="";
	if($level_id==-1)
	{
		$level_name="Office Staff";
	}
	else if($level_id==0)
	{
		$level_name="System Wallet";
	}
	else if($level_id>=1 && $level_id<=22)
	{
		require('zc-gyan-info-admin.php');
		require('zc-commons-admin.php');
		$query="select * from $bankapi_child_base.child_level where level_id=$level_id";
		$result=mysql_query($query);
		$level_name=mysql_fetch_array($result)['level_name'];
	}
	return $level_name;
}
function show_dist_level($level_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$level_name="";
	$query="select * from $bankapi_child_base.child_level where level_id=$level_id";
	$result=mysql_query($query);
	$level_name=mysql_fetch_array($result)['dist_level'];
	return $level_name;
}
function show_dist_ratio($level_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$level_name="";
	$query="select * from $bankapi_child_base.child_level where level_id=$level_id";
	$result=mysql_query($query);
	$level_name=mysql_fetch_array($result)['dist_ratio'];
	return $level_name;
}
function update_software_distribution_levels($filled_level,$filled_levels,$filled_ratios)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="update $bankapi_child_base.child_level set dist_level='$filled_levels',dist_ratio='$filled_ratios' where level_id=$filled_level";
	mysql_query($query);
	return $query;
}
?>