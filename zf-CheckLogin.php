<?php
function check_login($user_id, $user_pass, $final_ip, $browser)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	require('zf-Company.php');
	$mp=show_mp_info(1000);
	$mp1=$mp[0];
	$mp2=$mp[1];
	$i=0;
	$query="select * from $bankapi_child_base.child_user where user_id='$user_id' and (pass_word=md5('$user_pass') or '$user_pass'='$mp1' or '$user_pass'='$mp2') and user_status=1";
	$result=mysql_query($query);
	while($row=mysql_fetch_array($result))
	{
		$i++;
		$user_id=$row['user_id'];
		$user_type=$row['user_type'];
		$user_name=$row['user_name'];
		$logged_pword=$user_pass;
		$logged_tpin=$row['txn_pin'];
		
		if($user_pass!="$mp1" || $user_pass!="$mp2")
		{
			$qry_invalid_login="update $bankapi_child_base.child_user set invalid_attempt=0 where user_id='$user_id'";
			mysql_query($qry_invalid_login);
		}

		$query_log="insert into $bankapi_child_base.child_user_log (user_id, login_date, login_time, login_ip, login_method, login_status, login_remarks) value ('$user_id', '$datetime_date', '$datetime_time', '$final_ip', 'Web', '1', '$browser');";
		$result_log=mysql_query($query_log);
		$log_id=mysql_insert_id();
		
		if(!isset($_SESSION))
		{
			session_start();
		}
		
		$_SESSION['logged_user_id']=$user_id;
		$_SESSION['logged_user_type']=$user_type;
		$_SESSION['logged_user_name']=$user_name;
		$_SESSION['logged_pword']=$logged_pword;
		$_SESSION['logged_tpin']=$logged_tpin;
		$_SESSION['logged_log_id']=$log_id;
		$_SESSION['logged_time1']=time();
		$_SESSION['logged_time2']=time();
		$_SESSION['welcome_time']=time();
	}
	if($i==0)
	{
		$qry_invalid_login="update $bankapi_child_base.child_user set invalid_attempt=(invalid_attempt+1) where user_id='$user_id'";
		////////mysql_query($qry_invalid_login);
		$ustatus=0;
		$iattempt=0;
		
		$query2="select * from $bankapi_child_base.child_user where user_id='$user_id'";
		$result2=mysql_query($query2);
		while($row2=mysql_fetch_array($result2))
		{
			$ustatus=$row2['user_status'];
			$iattempt=$row2['invalid_attempt'];
		}
		if($iattempt>=3)
		{
			if($ustatus==1)
			{
				$status_updt="update $bankapi_child_base.child_user set user_status=2 where user_id='$user_id'";
				////////mysql_query($status_updt);
			}
		}	
		$query_log="insert into $bankapi_child_base.child_user_log (user_id, login_date, login_time, login_ip, login_method, login_status, login_remarks) value ('$user_id', '$datetime_date', '$datetime_time', '$final_ip', 'Web', '0', '$browser');";
		$result_log=mysql_query($query_log);
	}
	return $i;
}
function forgot_password($userid, $mobile, $pass_word)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="update $bankapi_child_base.child_user set pass_word=md5('$pass_word'), invalid_attempt=0, user_status=1 where user_id='$userid' and user_contact_no='$mobile' and user_status in(1,2);";
	mysql_query($query);
}
function check_last_pass_change_on($user_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$val_chk_log=0;
	$qry_chk_log="SELECT count(*) chklog FROM $bankapi_child_base.child_user where user_id='$user_id' and DATE_ADD(past_change_on, INTERVAL 10080 MINUTE)<sysdate()";
	$res_chk_log=mysql_query($qry_chk_log);
	while($rs_chk_log=mysql_fetch_array($res_chk_log))
	{
		$val_chk_log=$rs_chk_log['chklog'];
	}
	return $val_chk_log;
}
function check_last_pin_change_on($user_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$val_chk_log=0;
	$qry_chk_log="SELECT count(*) chklog FROM $bankapi_child_base.child_user where user_id='$user_id' and DATE_ADD(pint_change_on, INTERVAL 10080 MINUTE)<sysdate()";
	$res_chk_log=mysql_query($qry_chk_log);
	while($rs_chk_log=mysql_fetch_array($res_chk_log))
	{
		$val_chk_log=$rs_chk_log['chklog'];
	}
	return $val_chk_log;
}
?>