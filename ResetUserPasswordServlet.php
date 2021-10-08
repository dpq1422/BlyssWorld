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
	mysql_query("update $bankapi_child_base.child_user set pass_word = MD5('blyss@12') , invalid_attempt = '0', past_change_on='2017-08-08 07:15:45' WHERE user_id = '$uid';");
	
	$mob=0;
	$qry_chk_log="SELECT * FROM $bankapi_child_base.child_user where user_id='$uid'";
	$res_chk_log=mysql_query($qry_chk_log);
	while($rs_chk_log=mysql_fetch_array($res_chk_log))
	{
		$mob=$rs_chk_log['user_contact_no'];
	}
	if($mob!=0)
	{
    	include_once('zf-sms.php');
    	$zsms=reset_password_msg();
    	zsms($mob,$zsms);
	}
}
if($type=="team")
header("location: TeamsMembersServlet");
else if($type=="retailer")
header("location: TeamsRetailersServlet");
else
header("location: DashboardServlet");
?>