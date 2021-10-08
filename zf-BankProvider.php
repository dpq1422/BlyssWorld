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
function generate_request($filled_dt,$filled_bank,$filled_method,$filled_refno,$filled_amount,$filled_remark,$company_id,$logged_user_id,$logged_user_name)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="insert into $bankapi_parent_wallet.requests values(NULL,'$datetime_date','$datetime_time','$company_id','$logged_user_id','$filled_dt','$filled_bank','$filled_method','$filled_refno','$filled_amount','$filled_remark','sent by $logged_user_id - $logged_user_name at $datetime_date $datetime_time','','',1)";
	mysql_query($query);
	$last_id=mysql_insert_id();
	$sms="Request No.: $last_id\n\nClient ID.:$clientdbid \n\nUser ID.: $logged_user_id\n\nAmount.: $filled_amount";
	require('zf-sms.php');
	zsms("9896677625",$sms);
}
?>