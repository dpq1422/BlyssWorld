<?php
$uid="";
$type="";
if(isset($_REQUEST['uid']))
{
	$uid=$_REQUEST['uid'];
}
if(isset($_REQUEST['type']))
{
	$type=$_REQUEST['type'];
}
if($uid!="")
{
	include('zc-common-admin.php');
	include('zc-session-admin.php');
	mysql_query("update $bankapi_child_base.child_user set txn_pin = '1234' , pint_change_on='2017-08-08 07:15:45' WHERE user_id = '$uid';");
}
if($type=="team")
header("location: TeamsMembersServlet");
else if($type=="retailer")
header("location: TeamsRetailersServlet");
else
header("location: DashboardServlet");
?>