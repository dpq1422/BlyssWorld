<?php
function show_users_count($cond)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_parent_base.parent_user $cond ";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	return $total_records;
}
function show_users_data($cond, $start_from=0, $num_rec_per_page=0)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$start_from=mysql_real_escape_string($start_from);
	$num_rec_per_page=mysql_real_escape_string($num_rec_per_page);
	if($start_from==0 && $num_rec_per_page==0)
	$query="select * from $bankapi_parent_base.parent_user $cond ";
	else
	$query="select * from $bankapi_parent_base.parent_user $cond LIMIT $start_from, $num_rec_per_page";
	$result=mysql_query($query);
	return $result;
}
function show_user_name($user_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$user_name="";
	$query="select * from $bankapi_parent_base.parent_user where user_id=$user_id";
	$result=mysql_query($query);
	$user_name=mysql_fetch_array($result)['user_name'];
	return $user_name;
}
function show_user_profile($user_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$user_name="";
	$query="select * from $bankapi_parent_base.parent_user where user_id=$user_id ";
	$result=mysql_query($query);
	return $result;
}
function show_user_type($user_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	require_once('zf-ShowUserTypeName.php');
	$user_type="";
	$query="select * from $bankapi_parent_base.parent_user where user_id=$user_id";
	$result=mysql_query($query);
	$user_type=mysql_fetch_array($result)['user_type'];
	$user_type=show_user_type_name($user_type);
	return $user_type;
}
function update_password($user_id,$opass,$npass,$cpass)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="update $bankapi_parent_base.parent_user set pass_word=md5('$npass'), past_change_on='$datetime_datetime' where user_id='$user_id' and pass_word=md5('$opass');";
	mysql_query($query);
	$result=mysql_affected_rows();
	return $result;
}
?>