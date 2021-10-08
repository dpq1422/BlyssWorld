<?php
function show_welcomemessages_count($cond)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_parent_base.parent_branding_welcome $cond order by welcome_status desc, welcome_id ";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	return $total_records;
}
function show_welcomemessages_data($cond, $start_from=0, $num_rec_per_page=0)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$start_from=mysql_real_escape_string($start_from);
	$num_rec_per_page=mysql_real_escape_string($num_rec_per_page);
	if($start_from==0 && $num_rec_per_page==0)
	$query="select * from $bankapi_parent_base.parent_branding_welcome $cond order by welcome_status desc, welcome_id ";
	else
	$query="select * from $bankapi_parent_base.parent_branding_welcome $cond order by welcome_status desc, welcome_id LIMIT $start_from, $num_rec_per_page";
	$result=mysql_query($query);
	return $result;
}
function show_welcomemessage()
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_parent_base.parent_branding_welcome where welcome_status=1 order by welcome_status desc, welcome_id LIMIT 0,1";
	$result=mysql_query($query);
	return $result;
}
function create_welcome_msg($msg_title, $msg_note)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	mysql_query("update $bankapi_parent_base.parent_branding_welcome set welcome_status=0;");
	$query="insert into $bankapi_parent_base.parent_branding_welcome(welcome_name, message_type, welcome_message, welcome_status) value('$msg_title', '0', '$msg_note', '1');";
	$result=mysql_query($query);
	return $result;
}
?>