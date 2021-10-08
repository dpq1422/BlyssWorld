<?php

$req="";
$status="";
$remarks="";

if(isset($req))
$req=$_POST['req'];

if(isset($status))
$status=$_POST['status'];

if(isset($remarks))
$remarks=$_POST['remarks'];

if($req!="" && $status!="" && $remarks!="")
{
	echo update_client_ticket($req,$status,$remarks);
}
function update_client_ticket($req, $status, $remarks)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$req=mysql_real_escape_string($req);
	$status=mysql_real_escape_string($status);
	$remarks=mysql_real_escape_string($remarks);
	$i=0;
	$user='admin';
	$query_chk="update $bankapi_parent_base.parent_tickets set ticket_status=$status, admin_remarks=concat('$remarks<br>',admin_remarks), admin_updates=concat('updated by $user at ',sysdate()) where ticket_id='$req'";
	mysql_query($query_chk);
	$i=mysql_affected_rows();
	$i=json_encode($query_chk);
	return $i;
}
?>