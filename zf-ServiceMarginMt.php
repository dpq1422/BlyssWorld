<?php
function show_margins_count($cond)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_base.child_service_margin_mt $cond order by source_id,payment_method ";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	return $total_records;
}
function show_margins_data($cond, $start_from=0, $num_rec_per_page=0)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$start_from=mysql_real_escape_string($start_from);
	$num_rec_per_page=mysql_real_escape_string($num_rec_per_page);
	if($start_from==0 && $num_rec_per_page==0)
	$query="select * from $bankapi_child_base.child_service_margin_mt $cond order by source_id,payment_method ";
	else
	$query="select * from $bankapi_child_base.child_service_margin_mt $cond order by source_id,payment_method LIMIT $start_from, $num_rec_per_page";
	$result=mysql_query($query);
	return $result;
}
function show_user_margins_data($field,$user,$source,$method)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$val=0;
	$query="select * from $bankapi_child_base.child_service_margin_mt where user_id='$user' and source_id='$source' and payment_method='$method';";
	$result=mysql_query($query);
	while($row=mysql_fetch_array($result))
	{
		$val=$row["$field"];
	}
	return $val;
}
function show_mt_margin($userid, $source, $method)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$val=array();
	$query="select * from $bankapi_child_base.child_service_margin_mt where user_id='$userid' and source_id='$source' and payment_method='$method';";
	$result=mysql_query($query);
	while($row=mysql_fetch_array($result))
	{
		$val=array($row["m_01000"],$row["m_02000"],$row["m_03000"],$row["m_04000"],$row["m_05000"]);
	}
	return $val;
}
function update_mt_margin($mid,$f1,$f2,$f3,$f4,$f5)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$val=0;
	$query="update $bankapi_child_base.child_service_margin_mt set m_01000='$f1', m_02000='$f2', m_03000='$f3', m_04000='$f4', m_05000='$f5' where margin_id='$mid';";
	mysql_query($query);
}
function show_max($val1,$val2)
{
	if($val1>$val2)
		return $val1;
	else
		return $val2;
}
?>