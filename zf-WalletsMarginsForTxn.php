<?php
function show_user_limit($user)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$plan_limit=0;
	$query="SELECT * FROM $bankapi_child_base.child_user where user_id='$user'";
	$result=mysql_query($query);
	while($r = mysql_fetch_array($result)) 
	{
		$plan_limit=$r['plan_limit'];
	}
	return $plan_limit;
}
function show_admin_mt_rate($source, $method, $amount)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	
	$rate=0;
	$limit=5000;
	$amt=$amount;
	while($amt>$limit)
	{
		$amt=$amt-$limit;
		$query="SELECT * FROM $bankapi_parent_base.charges_in_source where source_id='$source' and $limit between slab_from+1 and slab_to";
		$result=mysql_query($query);
		while($r = mysql_fetch_array($result)) 
		{
			$rate+=$r['surcharges_fix'];
		}
	}
	if($amt<=$limit)
	{
		$query="SELECT * FROM $bankapi_parent_base.charges_in_source where source_id='$source' and $amt between slab_from+1 and slab_to";
		$result=mysql_query($query);
		while($r = mysql_fetch_array($result)) 
		{
			$rate+=$r['surcharges_fix'];
		}
	}
	return $rate;
}

function admin_otp_refund()
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$amount=0;
	$query="SELECT sum(amount) amt FROM $bankapi_parent_txn.txn_mt where mmt_status=-4;";
	$result=mysql_query($query);
	while($r = mysql_fetch_array($result)) 
	{
		$amount=$r['amt'];
	}
	return $amount;
}

function show_admin_av_rate($source)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	
	$rate=0;
	$query="SELECT * FROM $bankapi_parent_base.charges_in_source where source_id='$source' and operator_id=1002";
	$result=mysql_query($query);
	while($r = mysql_fetch_array($result)) 
	{
		$rate=$r['surcharges_fix'];
	}
	return $rate;
}

function show_client_mt_rate($source, $amount)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	
	$rate=0;
	$limit=5000;
	$amt=$amount;
	$i=0;
	while($amt>$limit)
	{
		$amt=$amt-$limit;
		$query="SELECT * FROM $bankapi_parent_base.charges_out_service where mt_source_id='$source' and $limit between slab_from+1 and slab_to and client_id='$clientdbid';";
		$result=mysql_query($query);
		while($r = mysql_fetch_array($result)) 
		{
			$rate+=$r['surcharges_fix'];
		}
	}
	if($amt<=$limit)
	{
		$query="SELECT * FROM $bankapi_parent_base.charges_out_service where mt_source_id='$source' and $amt between slab_from+1 and slab_to and client_id='$clientdbid';";
		$result=mysql_query($query);
		while($r = mysql_fetch_array($result)) 
		{
			$rate+=$r['surcharges_fix'];
		}
	}
	return $rate;
}

function show_client_av_rate($source)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	
	$rate=0;
	$query="SELECT * FROM $bankapi_parent_base.charges_out_service where mt_source_id='$source' and operator_id=1002 and client_id='$clientdbid';";
	$result=mysql_query($query);
	while($r = mysql_fetch_array($result)) 
	{
		$rate=$r['surcharges_fix'];
	}
	return $rate;
}

function show_user_plan($userid)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$plan_id=0;
	$query="SELECT * FROM $bankapi_child_base.child_user where user_id='$userid';";
	$result=mysql_query($query);
	while($r = mysql_fetch_array($result)) 
	{
		$plan_id=$r['plan_id'];
	}
	return $plan_id;
}

function show_user_mt_rate($userid, $source, $method, $amount)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$plan_id=1;
	$plan_id=show_user_plan($userid);
	if($plan_id==6)
		$plan_id--;
	$rate=0;
	$limit=5000;
	$amt=$amount;
	
	while($amt>$limit)
	{
		$amt=$amt-$limit;
		$query="SELECT * FROM $bankapi_child_base.child_plan_mt where plan_id='$plan_id' and source_id='$source' and payment_method='$method'";
		$result=mysql_query($query);
		while($r = mysql_fetch_array($result)) 
		{
			if($limit<=0)
			$rate+=0;
			else if($limit>0 && $limit<=2000)
			$rate+=10;//$r['m_01000'];
			/*
			else if($limit>1500 && $limit<=2000)
			{
				if(($limit*.01)>10.50)
					$rate+=$r['m_02000'];
				else
					$rate+=10.50;//$r['m_02000'];
			}
			*/
			else if($limit>2000 && $limit<=3000)
			$rate+=$r['m_03000'];
			else if($limit>3000 && $limit<=4000)
			$rate+=$r['m_04000'];
			else if($limit>4000 && $limit<=5000)
			$rate+=$r['m_05000'];	
		}
	}
	if($amt<=$limit)
	{
		$query="SELECT * FROM $bankapi_child_base.child_plan_mt where plan_id='$plan_id' and source_id='$source' and payment_method='$method'";
		$result=mysql_query($query);
		while($r = mysql_fetch_array($result)) 
		{
			if($amt<=0)
			$rate+=0;
			else if($amt>0 && $amt<=2000)
			$rate+=10;//$r['m_01000'];
			/*
			else if($amt>1500 && $amt<=2000)
			{
				if(($amt*.01)>10.50)
					$rate+=$r['m_02000'];
				else
					$rate+=10.50;//$r['m_02000'];
			}
			*/
			else if($amt>2000 && $amt<=3000)
			$rate+=$r['m_03000'];
			else if($amt>3000 && $amt<=4000)
			$rate+=$r['m_04000'];
			else if($amt>4000 && $amt<=5000)
			$rate+=$r['m_05000'];	
		}
	}
	return $rate;
}

function show_operator_ids($opr,$service)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$operator_id=0;
	$query="select * from $bankapi_parent_base.all_operator where service_id='$service' and operator_name='$opr'";
	$result=mysql_query($query);
	while($rs=mysql_fetch_array($result))
	{
		$operator_id=$rs['operator_id'];
	}
	return $operator_id;
}

function show_operator_id_by_code($opr,$service)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$operator_id=0;
	$query="select * from $bankapi_parent_base.all_operator where service_id='$service' and api_code_1='$opr'";
	$result=mysql_query($query);
	while($rs=mysql_fetch_array($result))
	{
		$operator_id=$rs['operator_id'];
	}
	return $operator_id;
}

function show_operator_id_by_code3($opr,$service)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$operator_id=0;
	$query="select * from $bankapi_parent_base.all_operator where service_id='$service' and api_code_3='$opr'";
	$result=mysql_query($query);
	while($rs=mysql_fetch_array($result))
	{
		$operator_id=$rs['operator_id'];
	}
	return $operator_id;
}

function show_user_av_rate($source)
{
	$rate=0;
	$rate_client=show_client_av_rate($source);
	$rate_admin=show_admin_av_rate($source);
	$rate=5;
	if($rate<$rate_client)
	$rate=$rate_client;
	if($rate<$rate_admin)
	$rate=$rate_admin;
	return $rate;
}

function show_user_rc_rate($service,$operator,$userid)//$field
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$val=0;
	$plan_id=1;
	$plan_id=show_user_plan($userid);
	if($plan_id==6)
		$plan_id--;
	$field="plan_$plan_id";
	$query="select * from $bankapi_child_base.child_plan_com where service_id='$service' and operator_id='$operator';";
	$result=mysql_query($query);
	while($row=mysql_fetch_array($result))
	{
		$val=$row["$field"];
	}
	return $val;
}

function show_user_rc_rate_surcharge($service,$operator,$userid)//$field
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$val=0;
	$plan_id=1;
	$plan_id=show_user_plan($userid);
	if($plan_id==6)
		$plan_id--;
	$field="plan_$plan_id";
	$query="select * from $bankapi_child_base.child_plan_sur where service_id='$service' and operator_id='$operator';";
	$result=mysql_query($query);
	while($row=mysql_fetch_array($result))
	{
		$val=$row["$field"];
	}
	return $val;
}

function show_client_rc_rate_surcharge($source,$service,$operator_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$val=0;
	$query="select * from $bankapi_parent_base.charges_out_service where service_id='$service' and operator_id='$operator_id' and mt_source_id='$source' and client_id='$clientdbid';";
	$result=mysql_query($query);
	while($row=mysql_fetch_array($result))
	{
		$val=$row["surcharges_fix"];
	}
	return $val;
}

function show_admin_rc_rate_surcharge($source,$service,$operator_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$val=0;
	$query="select * from $bankapi_parent_base.charges_in_source where service_id='$service' and operator_id='$operator_id' and source_id='$source';";
	$result=mysql_query($query);
	while($row=mysql_fetch_array($result))
	{
		$val=$row["surcharges_fix"];
	}
	return $val;
}

function show_client_rc_rate($source,$service,$operator_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$val=0;
	$query="select * from $bankapi_parent_base.charges_out_service where service_id='$service' and operator_id='$operator_id' and mt_source_id='$source' and client_id='$clientdbid';";
	$result=mysql_query($query);
	while($row=mysql_fetch_array($result))
	{
		$val=$row["surcharges_percent"];
	}
	return $val;
}

function show_admin_rc_rate($source,$service,$operator_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$val=0;
	$query="select * from $bankapi_parent_base.charges_in_source where service_id='$service' and operator_id='$operator_id' and source_id='$source';";
	$result=mysql_query($query);
	while($row=mysql_fetch_array($result))
	{
		$val=$row["surcharges_percent"];
	}
	return $val;
}

function show_txn_admin_balance($source)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$balance=0;
	if($source==1)
		$query="SELECT * FROM $bankapi_parent_wallet.rt_eko order by wallet_id desc limit 0,1";
	else if($source==2)
		$query="SELECT * FROM $bankapi_parent_wallet.rt_aquams order by wallet_id desc limit 0,1";
	else if($source==3)
		$query="SELECT * FROM $bankapi_parent_wallet.rt_acharya order by wallet_id desc limit 0,1";
	else if($source==4)
		$query="SELECT * FROM $bankapi_parent_wallet.rt_rechapi order by wallet_id desc limit 0,1";
	else if($source==5)
		$query="SELECT * FROM $bankapi_parent_wallet.rt_ach_blyss order by wallet_id desc limit 0,1";
	else if($source==6)
		$query="SELECT * FROM $bankapi_parent_wallet.rt_rech_blyss order by wallet_id desc limit 0,1";
	$result=mysql_query($query);
	while($row=mysql_fetch_array($result))
	{
		$balance=$row['amount_bal'];
	}
	return $balance;
}

function show_txn_client_balance()
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$balance=0;
	$query="SELECT * FROM $bankapi_child_wallet.realtime order by wallet_id desc limit 0,1";
	$result=mysql_query($query);
	while($row=mysql_fetch_array($result))
	{
		$balance=$row['amount_bal'];
	}
	return $balance;
}

function show_txn_client_dummy_balance()
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$dummy=0;
	$query2="SELECT * FROM $bankapi_parent_base.parent_client where client_id='$clientdbid'";
	$result2=mysql_query($query2);
	while($row2=mysql_fetch_array($result2))
	{
		$dummy=$row2['dummy_balance'];
	}
	return $dummy;
}

function show_txn_user_balance($userid)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$balance=0;
	$query="SELECT * FROM $bankapi_child_wallet.distribution where user_id='$userid' order by wallet_id desc limit 0,1";
	$result=mysql_query($query);
	while($row=mysql_fetch_array($result))
	{
		$balance=$row['amount_bal'];
	}
	return $balance;
}

function update_txn_client_balance()
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$balance=show_txn_client_balance();
	$query="update $bankapi_parent_base.parent_client set bal_amt=$balance where client_id='$clientdbid';";
	mysql_query($query);
}

function update_txn_user_balance($userid)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$balance=show_txn_user_balance($userid);
	$query="update $bankapi_child_base.child_userinfo_walletkyc set wallet_balance='$balance' where user_id='$userid'";
	mysql_query($query);
}

function check_mt_placed($retailerid,$recid,$date,$source,$type,$method,$amount)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$chk_record=0;
	$chk_qry="SELECT count(*) as nums FROM $bankapi_child_txn.txn_mt_parent where retailer_id='$retailerid' and receiver_id='$recid' and date(date_time)=date('$date') and source='$source' and type='$type' and method='$method' and amount='$amount'";
	$chk_res=mysql_query($chk_qry);
	while($chk_rs=mysql_fetch_array($chk_res))
	{
		$chk_record=$chk_rs['nums'];
	}
	return $chk_record;
}

function check_rc_placed($retailerid,$datetime,$type,$mobile,$amount)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$chk_record=0;	
	$chk_qry="SELECT count(*) as nums FROM $bankapi_child_txn.txn_rc where user_id='$retailerid' and mobile_number='$mobile' and date(created_on)=date('$datetime') and type='$type' and amount='$amount'";
	$chk_res=mysql_query($chk_qry);
	while($chk_rs=mysql_fetch_array($chk_res))
	{
		$chk_record=$chk_rs['nums'];
	}
	return $chk_record;
}

function show_my_parents($userid)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$result=array();
	$id_01=$id_02=$id_03=$id_04=$id_05=$id_06=$id_07=$id_08=$id_09=$id_10=$id_11=$id_12=0;
	$chk_qry="select * from $bankapi_child_base.child_userinfo_level where user_id='$userid';";
	$chk_res=mysql_query($chk_qry);
	while($chk_rs=mysql_fetch_array($chk_res))
	{
		$id_01=$chk_rs['id_01'];
		$id_02=$chk_rs['id_02'];
		$id_03=$chk_rs['id_03'];
		$id_04=$chk_rs['id_04'];
		$id_05=$chk_rs['id_05'];
		$id_06=$chk_rs['id_06'];
		$id_07=$chk_rs['id_07'];
		$id_08=$chk_rs['id_08'];
		$id_09=$chk_rs['id_09'];
		$id_10=$chk_rs['id_10'];
		$id_11=$chk_rs['id_11'];
		$id_12=$userid;
	}
	$result=array($id_01,$id_02,$id_03,$id_04,$id_05,$id_06,$id_07,$id_08,$id_09,$id_10,$id_11,$id_12);
	return $result;
}

function show_my_affiliates($userid)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$result=array();
	$id_01=$id_02=$id_03=$id_04=$id_05=$id_06=$id_07=$id_08=$id_09=$id_10=$id_11=$id_12=0;
	$chk_qry="select * from $bankapi_child_base.child_userinfo_affiliate where user_id='$userid';";
	$chk_res=mysql_query($chk_qry);
	while($chk_rs=mysql_fetch_array($chk_res))
	{
		$id_01=$chk_rs['id_01'];
		$id_02=$chk_rs['id_02'];
		$id_03=$chk_rs['id_03'];
		$id_04=$chk_rs['id_04'];
		$id_05=$chk_rs['id_05'];
		$id_06=$chk_rs['id_06'];
		$id_07=$chk_rs['id_07'];
		$id_08=$chk_rs['id_08'];
		$id_09=$chk_rs['id_09'];
		$id_10=$chk_rs['id_10'];
	}
	$result=array($id_01,$id_02,$id_03,$id_04,$id_05,$id_06,$id_07,$id_08,$id_09,$id_10,$id_11,$id_12);
	return $result;
}
?>