<?php
function show_retailer_joined_counts($cond, $user_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_base.child_user $cond;";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	return $total_records;
}
function show_retailer_joined_datas($cond, $user_id, $start_from=0, $num_rec_per_page=0)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_base.child_user $cond ";
	if($start_from!=0 || $num_rec_per_page!=0)
		$query=$query." LIMIT $start_from, $num_rec_per_page ";
	$result=mysql_query($query);
	return $result;
}
?>