<?php
function show_all_districts_of_state($state_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_common.common_district where state_id=$state_id";
	$result=mysql_query($query);
	return $result;
}
function show_district_name($district_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$distt_name="";
	$query="select * from $bankapi_common.common_district where distt_id=$district_id";
	$result=mysql_query($query);
	$distt_name=mysql_fetch_array($result)['distt_name'];
	return $distt_name;
}
?>