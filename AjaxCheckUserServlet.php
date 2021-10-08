<?php
$ajax_user_id=$_POST['filled_mobile_no'];
$ipaddress1 = "";

if (isset($_SERVER['HTTP_CLIENT_IP']))//check ip from share internet
	$ipaddress1 = $_SERVER['HTTP_CLIENT_IP'];
else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))//to check ip is pass from proxy
	$ipaddress1 = $_SERVER['HTTP_X_FORWARDED_FOR'];
else if(isset($_SERVER['HTTP_X_FORWARDED']))
	$ipaddress1 = $_SERVER['HTTP_X_FORWARDED'];
else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
	$ipaddress1 = $_SERVER['HTTP_FORWARDED_FOR'];
else if(isset($_SERVER['HTTP_FORWARDED']))
	$ipaddress1 = $_SERVER['HTTP_FORWARDED'];
else if(isset($_SERVER['REMOTE_ADDR']))
	$ipaddress1 = $_SERVER['REMOTE_ADDR'];
else
	$ipaddress1 = 'UNKNOWN';
	
	
$ipaddress2 = "";
if (getenv('HTTP_CLIENT_IP'))//check ip from share internet
	$ipaddress2 = getenv('HTTP_CLIENT_IP');
else if(getenv('HTTP_X_FORWARDED_FOR'))//to check ip is pass from proxy
	$ipaddress2 = getenv('HTTP_X_FORWARDED_FOR');
else if(getenv('HTTP_X_FORWARDED'))
	$ipaddress2 = getenv('HTTP_X_FORWARDED');
else if(getenv('HTTP_FORWARDED_FOR'))
	$ipaddress2 = getenv('HTTP_FORWARDED_FOR');
else if(getenv('HTTP_FORWARDED'))
	$ipaddress2 = getenv('HTTP_FORWARDED');
else if(getenv('REMOTE_ADDR'))
	$ipaddress2 = getenv('REMOTE_ADDR');
else
	$ipaddress2 = 'UNKNOWN';
	
$ajax_final_ip=$ipaddress1."<br>".$ipaddress2;
$ajax_browser=$_SERVER['HTTP_USER_AGENT'];
if(isset($ajax_user_id) && isset($ajax_final_ip) && isset($ajax_browser))
{
	echo check_user($ajax_user_id,$ajax_final_ip,$ajax_browser);
}
function check_user($user_id, $final_ip, $browser)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$user_id=mysql_real_escape_string($user_id);
	$final_ip=mysql_real_escape_string($final_ip);
	$browser=mysql_real_escape_string($browser);
	$i=0;
	$query_chk="select * from $bankapi_parent_base.parent_user where user_id='$user_id' and user_id not in(1000,1999)";
	$result_chk=mysql_query($query_chk);
	$j="";
	while($row_chk=mysql_fetch_array($result_chk))
	{
		$i++;
		$j=$row_chk['user_name'];
		$k=$row_chk['user_status'];
		$j="Hello, <b class='WelcomeUser'>$j</b>@#@$k";
	}
	if($i==0)
	{
		$query_log="insert into $bankapi_parent_base.parent_user_log_unknown (user_id, login_date, login_time, login_ip, login_method, login_status, login_remarks) value ('$user_id', '$datetime_date', '$datetime_time', '$final_ip', 'Web', '2', '$browser');";
		$result_log=mysql_query($query_log);
	}
	else
	{
		$i=$j;
	}
	$i=json_encode($i);
	return $i;
}
?>