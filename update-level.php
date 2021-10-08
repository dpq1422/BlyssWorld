<?php
function update_com_levels()
{
	require('zc-gyan-info-admin.php');
	mysql_query("update $bankapi_child_txn.com_generated set lvl_1_id='$main_admin';");
	$biz_q1="SELECT * from $bankapi_child_txn.com_generated where lvl_2_id=0 group by user_id order by user_id;";
	$biz_res1=mysql_query($biz_q1);
	while($biz_rs1=mysql_fetch_array($biz_res1))
	{
		$uid=0;
		$lvl_2_id=0;
		$uid=$biz_rs1['user_id'];
		$biz_q2="SELECT * from $bankapi_child_base.child_userinfo_level where user_id='$uid';";
		$biz_res2=mysql_query($biz_q2);
		while($biz_rs2=mysql_fetch_array($biz_res2))
		{
			$lvl_2_id=$biz_rs2['id_02'];
		}
		mysql_query("update $bankapi_child_txn.com_generated set lvl_2_id='$lvl_2_id' where user_id='$uid';");
	}
}
function show_biz_today($user_id)
{
	require('zc-gyan-info-admin.php');
	$amt=0;
	$query="SELECT sum(amount) amt FROM $bankapi_child_txn.com_generated where lvl_2_id='$user_id' and source=1 and type=1 and date(date_time)=date(DATE_ADD(sysdate(), INTERVAL +19800 SECOND));";
	$result=mysql_query($query);
	while($rs=mysql_fetch_array($result))
	{
		if(isset($rs['amt']))
		$amt=$rs['amt'];
	}
	return $amt;
}
function show_biz($user_id,$time)
{
	require('zc-gyan-info-admin.php');
	$amt=0;
	$query="SELECT sum(amount) amt FROM $bankapi_child_txn.com_generated where lvl_2_id='$user_id' and source=1 and type=1 and date(date_time)>='$time';";
	$result=mysql_query($query);
	while($rs=mysql_fetch_array($result))
	{
		if(isset($rs['amt']))
		$amt=$rs['amt'];
	}
	return $amt;
}
?>