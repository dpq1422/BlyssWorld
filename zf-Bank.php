<?php
function show_banks_count($cond)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_base.child_bank $cond ";
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
	$query="select * from $bankapi_child_base.child_bank $cond ";
	else
	$query="select * from $bankapi_child_base.child_bank $cond LIMIT $start_from, $num_rec_per_page";
	$result=mysql_query($query);
	return $result;
}
function show_bank_name($bank_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$bank_name="";
	$query="select * from $bankapi_child_base.child_bank where bank_id=$bank_id";
	$result=mysql_query($query);
	$bank_name=mysql_fetch_array($result)['bank_name'];
	return $bank_name;
}
function add_bank($bname,$baname,$bbname,$bano,$bifsc,$bcdm,$bcheque,$bcash,$bremark,$bstatus,$logged_user_typename,$logged_user_id,$logged_user_name)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$remark="$bremark - bank added by $logged_user_typename ($logged_user_id - $logged_user_name)";
	$query="insert into $bankapi_child_base.child_bank value(NULL, '$bname', '$baname', '$bano', '$bbname', '$bifsc', '$bstatus', '$remark', '$bcash', '$bcdm', '$bcheque')";
	mysql_query($query);
	$result=mysql_affected_rows();
	return $result;
}
function generate_request($filled_dt,$filled_bank,$filled_method,$filled_refno,$filled_amount,$filled_remark,$logged_user_id,$logged_user_name)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="insert into $bankapi_child_wallet.requests values(NULL,'$datetime_date','$datetime_time','$logged_user_id','$filled_dt','$filled_bank','$filled_method','$filled_refno','$filled_amount','$filled_remark','sent by $logged_user_id - $logged_user_name at $datetime_date $datetime_time','','',1)";
	mysql_query($query);
	$last_id=mysql_insert_id();
	
	$uname="";	
	$city_name="";
	$query2="select * from $bankapi_child_base.child_user where user_id=$logged_user_id ";
	$result2=mysql_query($query2);
	$arr=mysql_fetch_array($result2);
	$uname=$arr['user_name'];
	$city_name=$arr['city_name'];
	
	$msg="ReqNo.: $last_id\n\nUID.: $logged_user_id ($uname @ $city_name)\n\nAmt.: $filled_amount";
	require('zf-sms.php');
	$umob="9896677625";
	zsms($umob,$msg);
	/*
	$myfile = fopen("../_____sms.txt", "w") or die("Unable to open file!");
	$txt = "$umob\r\n$msg";
	fwrite($myfile, $txt);
	fclose($myfile);
	*/
}
function generate_request222($filled_bank,$filled_amount,$filled_remark,$logged_user_id,$logged_user_name)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="insert into $bankapi_child_wallet.requests values(NULL,'$datetime_date','$datetime_time','$logged_user_id','$datetime_date','$filled_bank','0','0','$filled_amount','$filled_remark','sent by $logged_user_id - $logged_user_name at $datetime_date $datetime_time','','',1)";
	mysql_query($query);
	$last_id=mysql_insert_id();
	
	$city_name="";
	$query2="select * from $bankapi_child_base.child_user where user_id=$logged_user_id ";
	$result2=mysql_query($query2);
	$arr=mysql_fetch_array($result2);
	$city_name=$arr['city_name'];
	
	$sms="You have received wallet request from your Team.\n\nRequest ID: $last_id\nUser ID: $logged_user_id\nUser Name:$logged_user_name\nLocation:$city_name\n\nAmount: $filled_amount\n\nTeam BLYSS";
	
	require_once('zf-User.php');
	$rs=show_user_profile($filled_bank);
	$rss=mysql_fetch_array($rs);
	$umob=$rss['user_contact_no'];
	require('zf-sms.php');
	//$sms=create_payone_wallet_request_msg($last_id,$name,$amt,$request_status,$datetime_datetime);
	zsms("$umob",$sms);
	/*	
	$myfile = fopen("../_____sms.txt", "w") or die("Unable to open file!");
	$txt = "$umob\r\n$sms";
	fwrite($myfile, $txt);
	fclose($myfile);
	*/
}
?>