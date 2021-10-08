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

if(isset($_POST['usr']))
$usr=$_POST['usr'];

if(isset($_POST['amt']))
$amt=$_POST['amt'];

if(isset($_POST['bnk']))
$bnk=$_POST['bnk'];

if(isset($status))
$status=$_POST['status'];

if(isset($remarks))
$remarks=$_POST['remarks'];

if($req!="" && $usr!="" && $amt!="" && $bnk!="" && $status!="" && $remarks!="")
{
	$pm=0;
	$request_status="";
	
	if($status==2)
	{
		$request_status="Approved";
		include_once('zc-session-admin.php');
		include_once('zf-WalletDistributed.php');
		$remarks="$remarks - against request id $req $request_status";
		$remarks_admin=$remarks." by $logged_user_typename ($logged_user_id - $logged_user_name)";
		transfer_user_to_user($bnk, $usr, $amt, $remarks, $remarks_admin);
	}
	else
	{
		$request_status="Rejected";
		include_once('zc-session-admin.php');
		include_once('zf-WalletDistributed.php');
		$remarks="$remarks - against request id $req $request_status";
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
	$namer=$rss['user_name'];
	require('zf-sms.php');
	$msg="Dear $namer,\n\nYour wallet request ID $req is $request_status by your distributor at $datetime_datetime.\n\nTeam BLYSS";
	zsms($umob,$msg);
	/*
	$myfile = fopen("../_____sms.txt", "w") or die("Unable to open file!");
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
	$query_chk="update $bankapi_child_wallet.requests set request_status='$status', admin_remarks='$remarks', admin_updates=concat('updated by ','$datetime_datetime') where request_id='$req'";
	mysql_query($query_chk);
	$i=mysql_affected_rows();
	$i=json_encode($query_chk);
	return $i;
}
?>