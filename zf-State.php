<?php
function show_all_states()
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_common.common_state where state_status=1";
	$result=mysql_query($query);
	return $result;
}
function show_state_name($state_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$state_name="";
	$query="select * from $bankapi_common.common_state where state_id=$state_id";
	$result=mysql_query($query);
	$state_name=mysql_fetch_array($result)['state_name'];
	return $state_name;
}
?>