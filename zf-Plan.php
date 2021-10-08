<?php
function show_plans_count($cond)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_base.child_plan $cond ";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	return $total_records;
}

function show_plans_data($cond, $start_from=0, $num_rec_per_page=0)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$start_from=mysql_real_escape_string($start_from);
	$num_rec_per_page=mysql_real_escape_string($num_rec_per_page);
	if($start_from==0 && $num_rec_per_page==0)
	$query="select * from $bankapi_child_base.child_plan $cond order by plan_id ";
	else
	$query="select * from $bankapi_child_base.child_plan $cond order by plan_id LIMIT $start_from, $num_rec_per_page";
	$result=mysql_query($query);
	return $result;
}

function show_plan_name($plan_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$name="";
	$query="select * from $bankapi_child_base.child_plan where plan_id='$plan_id' ";
	$result=mysql_query($query);
	while($rs=mysql_fetch_array($result))
	{
		$name=$rs['plan_name'];
	}
	return $name;
}

function show_operator_name2($operator)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$name="";
	$query="select * from $bankapi_parent_base.all_operator where operator_id='$operator' ";
	$result=mysql_query($query);
	while($rs=mysql_fetch_array($result))
	{
		$name=$rs['operator_name'];
	}
	return $name;
}

function show_plan_details($plan_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$pland="";
	$query="select * from $bankapi_child_base.child_plan where plan_id='$plan_id' ";
	$result=mysql_query($query);
	$rs=mysql_fetch_array($result);
	return $rs;
}

function show_plan_mt_rates($plan_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$rate=15;
	$query="select * from $bankapi_child_base.child_plan_mt where plan_id='$plan_id' ";
	$result=mysql_query($query);
	while($rs=mysql_fetch_array($result))
	{
		$rate=$rs['m_01000'];
	}
	return $rate;
}

function show_plan_com($service)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_base.child_plan_com where service_id='$service';";
	$result=mysql_query($query);
	return $result;
}

function show_plan_sur($service)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_base.child_plan_sur where service_id='$service';";
	$result=mysql_query($query);
	return $result;
}

function show_operator_charges($operator)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$charges=0;
	$type=0;
	$query="select * from $bankapi_parent_base.charges_out_service where operator_id='$operator' and client_id='$clientdbid' ";
	$result=mysql_query($query);
	while($rs=mysql_fetch_array($result))
	{
		$type=$rs['charges_type'];
		if($type==-1)
			$charges=$rs['surcharges_fix'];
		else if($type==1)
			$charges=$rs['surcharges_percent'];
	}
	$return_result=array($type,$charges);
	return $return_result;
}

function create_plan($name, $security, $software, $remarks, $status)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="insert into $bankapi_child_base.child_plan (plan_name, plan_security, plan_software, plan_status, plan_remarks) value ('$name', '$security', '$software', '$status', '$remarks') ;";
	mysql_query($query);
	$last_id = mysql_insert_id();
	return $last_id;
}

function show_plans_count_mt($cond)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_base.child_plan_mt $cond ";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	return $total_records;
}

function show_plans_data_mt($cond, $start_from=0, $num_rec_per_page=0)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$start_from=mysql_real_escape_string($start_from);
	$num_rec_per_page=mysql_real_escape_string($num_rec_per_page);
	if($start_from==0 && $num_rec_per_page==0)
	$query="select * from $bankapi_child_base.child_plan_mt $cond order by source_id,payment_method ";
	else
	$query="select * from $bankapi_child_base.child_plan_mt $cond order by source_id,payment_method LIMIT $start_from, $num_rec_per_page";
	$result=mysql_query($query);
	return $result;
}

function show_plans_count_commission($cond)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_base.child_plan_com $cond ";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	return $total_records;
}

function show_plans_data_commission($cond, $start_from=0, $num_rec_per_page=0)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$start_from=mysql_real_escape_string($start_from);
	$num_rec_per_page=mysql_real_escape_string($num_rec_per_page);
	if($start_from==0 && $num_rec_per_page==0)
	$query="select * from $bankapi_child_base.child_plan_com $cond order by service_id ";
	else
	$query="select * from $bankapi_child_base.child_plan_com $cond order by service_id LIMIT $start_from, $num_rec_per_page";
	$result=mysql_query($query);
	return $result;
}

function show_plans_count_surcharges($cond)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_base.child_plan_sur $cond ";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	return $total_records;
}

function show_plans_data_surcharges($cond, $start_from=0, $num_rec_per_page=0)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$start_from=mysql_real_escape_string($start_from);
	$num_rec_per_page=mysql_real_escape_string($num_rec_per_page);
	if($start_from==0 && $num_rec_per_page==0)
	$query="select * from $bankapi_child_base.child_plan_sur $cond order by service_id ";
	else
	$query="select * from $bankapi_child_base.child_plan_sur $cond order by service_id LIMIT $start_from, $num_rec_per_page";
	$result=mysql_query($query);
	return $result;
}

function update_mt_rate($plan,$source,$method,$m1,$m2,$m3,$m4,$m5)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="update $bankapi_child_base.child_plan_mt set m_01000='$m1', m_02000='$m2', m_03000='$m3', m_04000='$m4', m_05000='$m5' where plan_id='$plan' and source_id='$source' and payment_method='$method';";
	mysql_query($query);
}

function update_surcharges_amt($opr,$p1,$p2,$p3,$p4,$p5)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="update $bankapi_child_base.child_plan_sur set plan_1='$p1', plan_2='$p2', plan_3='$p3', plan_4='$p4', plan_5='$p5' where operator_id='$opr';";
	mysql_query($query);
}

function update_commission_amt($opr,$p1,$p2,$p3,$p4,$p5)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="update $bankapi_child_base.child_plan_com set plan_1='$p1', plan_2='$p2', plan_3='$p3', plan_4='$p4', plan_5='$p5' where operator_id='$opr';";
	mysql_query($query);
}

function upgrade_user_plan($userid,$curp,$newp,$rs,$msg)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query1="update $bankapi_child_base.child_user set plan_id='$newp', user_remarks=concat(user_remarks,'<br>$msg') where user_id='$userid' and plan_id='$curp';";
	mysql_query($query1);
	$query2="INSERT INTO $bankapi_child_base.child_plan_updated values(NULL, '$datetime_datetime', '$userid', '$curp', '$newp', '$rs', '$msg');";
	mysql_query($query2);
	
	$retailerbal=0;
	$query3="select * from $bankapi_child_wallet.distribution where user_id='$userid' order by wallet_id desc limit 0,1";
	$result3=mysql_query($query3);
	while($rs3 = mysql_fetch_assoc($result3))
	{
		$retailerbal=$rs3['amount_bal'];
	}
	$retailerbal2=$retailerbal-$rs;
	
	$filled_remarks="Membership Plan Upgraded";
	$filled_remarks2="Membership Plan Upgraded $msg";
	
	$query4="INSERT INTO $bankapi_child_wallet.distribution (wallet_date, wallet_time, user_id, user_id2, request_id, service_id, order_id, tid, transaction_type, transaction_description, amount_pre, amount_cr, amount_dr, amount_bal, remarks) VALUES ('$datetime_date', '$datetime_time', '$userid', '$wallet_security', '0', '0', '0', '0', '17', '$filled_remarks', '$retailerbal', '0', '$rs', '$retailerbal2', '$filled_remarks2 at $datetime_datetime');";
	mysql_query($query4);
	
	$secbal=0;
	$query3="select * from $bankapi_child_wallet.distribution where user_id='$wallet_security' order by wallet_id desc limit 0,1";
	$result3=mysql_query($query3);
	while($rs3 = mysql_fetch_assoc($result3))
	{
		$secbal=$rs3['amount_bal'];
	}
	$secbal2=$secbal+$rs;
	
	$query4="INSERT INTO $bankapi_child_wallet.distribution (wallet_date, wallet_time, user_id, user_id2, request_id, service_id, order_id, tid, transaction_type, transaction_description, amount_pre, amount_cr, amount_dr, amount_bal, remarks) VALUES ('$datetime_date', '$datetime_time', '$wallet_security', '$userid', '0', '0', '0', '0', '17', '$filled_remarks2', '$secbal', '$rs', '0', '$secbal2', '$filled_remarks2 at $datetime_datetime');";
	mysql_query($query4);
}
?>