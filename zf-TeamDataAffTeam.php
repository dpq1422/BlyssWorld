<?php
function show_joined_count($user_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_base.child_userinfo_affiliate where user_type=12 and (id_01=$user_id or id_02=$user_id or id_03=$user_id or id_04=$user_id);";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	return $total_records;
}
function show_joined_data($user_id, $start_from=0, $num_rec_per_page=0)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_base.child_userinfo_affiliate where user_type=12 and (id_01=$user_id or id_02=$user_id or id_03=$user_id or id_04=$user_id) ";
	if($start_from!=0 || $num_rec_per_page!=0)
		$query=$query." LIMIT $start_from, $num_rec_per_page ";
	$result=mysql_query($query);
	return $result;
}
?>