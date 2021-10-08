<?php
function show_margins_rc_count($cond)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_base.child_service_margin_fix $cond order by service_id,operator_id ";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	return $total_records;
}
function show_margins_rc_data($cond, $start_from=0, $num_rec_per_page=0)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$start_from=mysql_real_escape_string($start_from);
	$num_rec_per_page=mysql_real_escape_string($num_rec_per_page);
	if($start_from==0 && $num_rec_per_page==0)
	$query="select * from $bankapi_child_base.child_service_margin_fix $cond order by service_id,operator_id ";
	else
	$query="select * from $bankapi_child_base.child_service_margin_fix $cond order by service_id,operator_id LIMIT $start_from, $num_rec_per_page";
	$result=mysql_query($query);
	return $result;
}
function show_operators($cond)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_parent_base.all_operator $cond order by operator_name;";
	$result=mysql_query($query);
	return $result;
}
function show_operator_states()
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select distinct(state) state from $bankapi_parent_base.all_operator where operator_status=1 and service_id=105 and state!='0' order by state;";
	$result=mysql_query($query);
	return $result;
}
function show_rc1_circles()
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select api_code_1 from $bankapi_common.common_state where api_code_1!='0' order by api_code_1;";
	$result=mysql_query($query);
	return $result;
}
function show_operator_id($opr,$service)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$operator_id=0;
	$query="select * from $bankapi_parent_base.all_operator where service_id='$service' and api_code_1='$opr'";
	$result=mysql_query($query);
	while($rs=mysql_fetch_array($result))
	{
		$operator_id=$rs['operator_id'];
	}
	return $operator_id;
}
function show_operator_active_source($opr,$service)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$source=0;
	$query="select * from $bankapi_parent_base.charges_out_service where service_id='$service' and operator_id='$opr' and client_id='$clientdbid'";
	$result=mysql_query($query);
	while($rs=mysql_fetch_array($result))
	{
		$source=$rs['mt_source_id'];
	}
	return $source;
}
?>