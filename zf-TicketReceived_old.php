<?php
function show_tickets_count($cond)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_base.child_tickets $cond ";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	return $total_records;
}
function show_tickets_data($cond, $start_from=0, $num_rec_per_page=0)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$start_from=mysql_real_escape_string($start_from);
	$num_rec_per_page=mysql_real_escape_string($num_rec_per_page);
	if($start_from==0 && $num_rec_per_page==0)
	$query="select * from $bankapi_child_base.child_tickets $cond order by ticket_id desc ";
	else
	$query="select * from $bankapi_child_base.child_tickets $cond order by ticket_id desc LIMIT $start_from, $num_rec_per_page";
	$result=mysql_query($query);
	return $result;
}
function generate_ticket($subject, $remarks, $user_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="insert into $bankapi_child_base.child_tickets values(NULL, '$subject', '$datetime_datetime', '$user_id', '$remarks', '', 'sent by $user_id at $datetime_datetime','',1);";
	mysql_query($query);
	require('zf-sms.php');
	$sms="Ticket Generated by USER ID $user_id";
	zsms("9896677625",$sms);
}
?>