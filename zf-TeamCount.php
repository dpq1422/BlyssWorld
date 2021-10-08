<?php
function show_team_joined($user_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_base.child_userinfo_level where user_type in(2,3,4,5,6,7,8,9,10,11) and (id_01=$user_id or id_02=$user_id or id_03=$user_id or id_04=$user_id or id_05=$user_id or id_06=$user_id or id_07=$user_id or id_08=$user_id or id_09=$user_id or id_10=$user_id or id_11=$user_id or id_12=$user_id) ";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	return $total_records;
}
function show_retailer_joined($user_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_base.child_userinfo_level where user_type=12 and (id_01=$user_id or id_02=$user_id or id_03=$user_id or id_04=$user_id or id_05=$user_id or id_06=$user_id or id_07=$user_id or id_08=$user_id or id_09=$user_id or id_10=$user_id or id_11=$user_id or id_12=$user_id) ";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	return $total_records;
}
?>