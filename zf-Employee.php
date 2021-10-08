<?php
function show_employees_count($cond)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_base.child_user $cond and user_type in(-2,-3,-4) ";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	return $total_records;
}
function show_employees_data($cond, $start_from=0, $num_rec_per_page=0)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$start_from=mysql_real_escape_string($start_from);
	$num_rec_per_page=mysql_real_escape_string($num_rec_per_page);
	if($start_from==0 && $num_rec_per_page==0)
	$query="select * from $bankapi_child_base.child_user $cond and user_type in(-2,-3,-4) order by user_status,user_id ";
	else
	$query="select * from $bankapi_child_base.child_user $cond and user_type in(-2,-3,-4) order by user_status,user_id  LIMIT $start_from, $num_rec_per_page";
	$result=mysql_query($query);
	return $result;
}
function show_employee_name($user_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$user_name="";
	$query="select * from $bankapi_child_base.child_user where user_id=$user_id and user_type in(-2,-3,-4) ";
	$result=mysql_query($query);
	$user_name=mysql_fetch_array($result)['user_name'];
	return $user_name;
}
function create_employee($utype, $uname, $uadhar, $uemail, $umob, $upass, $uadd, $ucity, $udist, $ustate, $upincode, $ugender, $utxn, $ujoin, $usal, $logged_user_id, $logged_user_name, $logged_user_typename, $logged_user_type)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$last_id=0;
	$uremarks="created by $logged_user_typename ($logged_user_id - $logged_user_name)";
	$query="insert into $bankapi_child_base.child_user (join_date, join_time, user_type, user_name, e_mail, user_contact_no, pass_word, txn_pin, address, city_name, distt_id, state_id, area_pin_code, gender, user_status, user_remarks, target_s_txn, target_s_join, salary, past_change_on) value ('$datetime_date', '$datetime_time', '$utype', '$uname', '$uemail', '$umob', md5('$upass'), 0, '$uadd', '$ucity', '$udist', '$ustate', '$upincode', '$ugender', '1', '$uremarks', '$utxn', '$ujoin', '$usal', '2017-08-08') ;";
	mysql_query($query);
	$last_id = mysql_insert_id();
	
	if($last_id<101000)
	{
		$update_inc_id=explode(":",$datetime_time);
		$update_inc_id=($update_inc_id[2]-($update_inc_id[2]%10))/10;
		$update_inc_id=$last_id+$update_inc_id+1;
		$qry_update_inc_id="ALTER TABLE $bankapi_child_base.child_user auto_increment = $update_inc_id;";
		mysql_query($qry_update_inc_id);
	}
	
	$update_inc_id=explode(":",$datetime_time);
	$update_inc_id=($update_inc_id[2]-($update_inc_id[2]%10))/10;
	$update_inc_id=$last_id+$update_inc_id+1;
	$qry_update_inc_id="ALTER TABLE $bankapi_child_base.child_user auto_increment = $update_inc_id;";
	mysql_query($qry_update_inc_id);
	
	//$uadhar
	//$usoftware
	//$usecurity
	return $last_id;
}
?>