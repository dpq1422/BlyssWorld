<?php

$req="";
$status="";
$remarks="";
$usersid="";
$usersname="";
$req_user="";

if(isset($_POST['req']))
$req=$_POST['req'];

if(isset($_POST['req_user']))
$req_user=$_POST['req_user'];

if(isset($_POST['status']))
$status=$_POST['status'];

if(isset($_POST['remarks']))
$remarks=$_POST['remarks'];

if(isset($_POST['userid']))
$usersid=$_POST['userid'];

if(isset($_POST['username']))
$usersname=$_POST['username'];

if($req!="" && $req_user!="" && $status!="" && $remarks!="" && $usersid!="" && $usersname!="")
{
	echo update_user_ticket($req,$status,$remarks, $usersid, $usersname, $req_user);
}
function update_user_ticket($req, $status, $remarks, $usersid, $usersname, $req_user)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$req=mysql_real_escape_string($req);
	$status=mysql_real_escape_string($status);
	$remarks=mysql_real_escape_string($remarks);
	$i=0;
	$user='admin';
	$query_chk="update $bankapi_child_base.child_tickets set ticket_status=$status, admin_remarks=concat('$remarks<br>',admin_remarks), admin_updates=concat('updated by $usersid - $usersname at ','$datetime_datetime') where ticket_id='$req'";
	mysql_query($query_chk);
	$i=mysql_affected_rows();
	require('zf-User.php');
	$rs=show_user_profile($req_user);
	$num=mysql_fetch_array($rs)['user_contact_no'];
	require('zf-sms.php');
	$sms=support_ticket_reply_msg();
	zsms("$num",$sms);
	$i=json_encode($query_chk);
	return $i;
}
?>