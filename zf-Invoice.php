<?php
function show_invoices_count($cond)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_parent_base.parent_invoice $cond ";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	return $total_records;
}
function show_invoices_data($cond, $start_from=0, $num_rec_per_page=0)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$start_from=mysql_real_escape_string($start_from);
	$num_rec_per_page=mysql_real_escape_string($num_rec_per_page);
	if($start_from==0 && $num_rec_per_page==0)
	$query="select * from $bankapi_parent_base.parent_invoice $cond order by invoice_status desc,service_id,invoice_id";
	else
	$query="select * from $bankapi_parent_base.parent_invoice $cond order by invoice_status desc,service_id,invoice_id LIMIT $start_from, $num_rec_per_page";
	$result=mysql_query($query);
	return $result;
}
?>