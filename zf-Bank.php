<?php
function show_banks_count($cond)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_parent_base.parent_bank $cond ";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	return $total_records;
}
function show_banks_data($cond, $start_from=0, $num_rec_per_page=0)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$start_from=mysql_real_escape_string($start_from);
	$num_rec_per_page=mysql_real_escape_string($num_rec_per_page);
	if($start_from==0 && $num_rec_per_page==0)
	$query="select * from $bankapi_parent_base.parent_bank $cond ";
	else
	$query="select * from $bankapi_parent_base.parent_bank $cond LIMIT $start_from, $num_rec_per_page";
	$result=mysql_query($query);
	return $result;
}
function show_bank_name($bank_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$bank_name="";
	$query="select * from $bankapi_parent_base.parent_bank where bank_id=$bank_id";
	$result=mysql_query($query);
	$bank_name=mysql_fetch_array($result)['bank_name'];
	return $bank_name;
}
?>