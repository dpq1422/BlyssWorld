<?php
function show_employees_count($cond)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_base.child_user $cond and user_type=-2 ";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	return $total_records;
}
function show_employees_data($cond, $start_from=0, $num_rec_per_page=0)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$start_from=mysql_real_escape_string($start_from);
	$num_rec_per_page=mysql_real_escape_string($num_rec_per_page);
	if($start_from==0 && $num_rec_per_page==0)
	$query="select * from $bankapi_child_base.child_user $cond and user_type=-2 order by user_id ";
	else
	$query="select * from $bankapi_child_base.child_user $cond and user_type=-2 order by user_id  LIMIT $start_from, $num_rec_per_page";
	$result=mysql_query($query);
	return $result;
}
function show_employee_name($user_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$user_name="";
	$query="select * from $bankapi_child_base.child_user where user_id=$user_id and user_type=-2 ";
	$result=mysql_query($query);
	$user_name=mysql_fetch_array($result)['user_name'];
	return $user_name;
}
?>