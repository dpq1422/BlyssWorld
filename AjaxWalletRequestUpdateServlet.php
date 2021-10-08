<?php

$req="";
$status="";
$remarks="";
$usr="";
$amt="";
$bnk="";
$pm="";

if(isset($req))
$req=$_POST['req'];

if(isset($status))
$status=$_POST['status'];

if(isset($remarks))
$remarks=$_POST['remarks'];

if(isset($_POST['usr']))
$usr=$_POST['usr'];

if(isset($_POST['amt']))
$amt=$_POST['amt'];

if(isset($_POST['bnk']))
$bnk=$_POST['bnk'];

if(isset($_POST['pm']))
$pm=$_POST['pm'];

if($req!="" && $status!="" && $remarks!="" && $usr!="" && $amt!="" && $bnk!="" && $pm!="")
{
	$request_status="";
	if($status==2)
	{
		$request_status="Approved";
		include_once('zc-session-admin.php');
		include_once('zf-WalletDistributed.php');
		$remarks="$remarks - against request id $req";
		$remarks_admin=$remarks." by $logged_user_typename ($logged_user_id - $logged_user_name)";
		transfer_admin_to_user($usr, $amt, $remarks, $remarks_admin, $req, $bnk, $pm);
	}
	else
	{
		$request_status="Rejected";
		include_once('zc-session-admin.php');
		include_once('zf-WalletDistributed.php');
		$remarks="$remarks - against request id $req";
		$remarks_admin=$remarks." by $logged_user_typename ($logged_user_id - $logged_user_name)";
		//transfer_admin_to_user_rejected($usr, 0, $remarks, $remarks_admin, $req, $bnk, $pm);
	}
	update_user_request($req,$status,$remarks);
	
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	require('zf-User.php');
	$rs=show_user_profile($usr);
	$rss=mysql_fetch_array($rs);
	$umob=$rss['user_contact_no'];
	$name=$rss['user_name'];
	$name=explode(" ",$name)[0];
	require('zf-sms.php');
	$msg=create_payone_wallet_request_msg_reply($datetime_datetime,$name,$amt,$request_status,$datetime_datetime);
	zsms($umob,$msg);
	/*
	$myfile = fopen("_____sms.txt", "w") or die("Unable to open file!");
	$txt = "$umob\r\n$msg";
	fwrite($myfile, $txt);
	fclose($myfile);
	*/
	echo json_encode("");
}
function update_user_request($req, $status, $remarks)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$req=mysql_real_escape_string($req);
	$status=mysql_real_escape_string($status);
	$remarks=mysql_real_escape_string($remarks);
	$i=0;
	$user='admin';
	$query_chk="update $bankapi_child_wallet.requests set request_status='$status', admin_remarks='$remarks', admin_updates=concat('updated by $user at ','$datetime_datetime') where request_id='$req'";
	mysql_query($query_chk);
	$i=mysql_affected_rows();
	$i=json_encode($query_chk);
	return $i;
}
?>