<?php
function show_collection1($dt1,$dt2)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select user_id, count(*) nums, sum(amount) amt, sum(com_charged) chgd from $bankapi_child_txn.txn_mt_child where date(created_on) between '$dt1' and '$dt2' and source=5 and order_status=2 and type=1 group by user_id order by amt desc;";
	$result=mysql_query($query);
	return $result;
}
function show_collection2($dt1,$dt2)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select user_id, count(*) nums, sum(amount) amt, sum(com_charged) chgd from $bankapi_child_txn.txn_mt_child where date(created_on) between '$dt1' and '$dt2' and source=5 and order_status=2 and type=2 and bank_ref_no!='4321' group by user_id order by amt desc;";
	$result=mysql_query($query);
	return $result;
}
function show_collection3($dt1,$dt2)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select user_id, count(*) nums, sum(amount) amt, sum(com_charged) chgd from $bankapi_child_txn.txn_mt_child where date(created_on) between '$dt1' and '$dt2' and source=5 and order_status=2 and type=2 and bank_ref_no='4321' group by user_id order by amt desc;";
	$result=mysql_query($query);
	return $result;
}
function show_collection4($dt1,$dt2)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select user_id, count(*) nums, sum(amount) amt, sum(deducted_amt) chgd from $bankapi_child_txn.txn_rc where date(created_on) between '$dt1' and '$dt2' and source=6 and rc_status=2 and type in(3,4,5) group by user_id order by amt desc;";
	$result=mysql_query($query);
	return $result;
}
function show_collection4b($uid,$dt1,$dt2)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select sum(deducted_amt) chgd from $bankapi_parent_txn.txn_rc where client_id='$clientdbid' and user_id='$uid' and source=6 and mrc_status=2 and type in(3,4,5) and date(created_on) between '$dt1' and '$dt2';";
	$result=mysql_query($query);
	$chgd=0;
	while($rs = mysql_fetch_array($result))
	{
		if(isset($rs['chgd']))
		$chgd=$rs['chgd'];
	}
	return $chgd;
}
function show_collection5($dt1,$dt2)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select user_id, count(*) nums, sum(amount) amt, sum(deducted_amt) chgd from $bankapi_child_txn.txn_rc where date(created_on) between '$dt1' and '$dt2' and source=6 and rc_status=2 and type in(6,7,8,9,10,11) group by user_id order by amt desc;";
	$result=mysql_query($query);
	return $result;
}
function show_my_team_collection($user_id,$dt1,$dt2)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select user_id, count(*) nums, sum(amount) amt, sum(charged) chgd from $bankapi_child_txn.com_generated where date(date_time) between '$dt1' and '$dt2' and source in(1,3) and (lvl_1_id='$user_id' or lvl_2_id='$user_id' or lvl_3_id='$user_id' or lvl_4_id='$user_id' or lvl_5_id='$user_id' or lvl_6_id='$user_id' or lvl_7_id='$user_id' or lvl_8_id='$user_id' or lvl_9_id='$user_id' or lvl_10_id='$user_id' or lvl_11_id='$user_id') group by user_id order by amt desc;";
	$result=mysql_query($query);
	return $result;
}
function calculate_payout($user_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="SELECT date(date_time) dt,sum(cr) cr,sum(dr) dr FROM $bankapi_child_txn.com_paid_child where user_id='$user_id' and details not like 'my%' group by date(date_time) order by date(date_time)";
	$result=mysql_query($query);
	$num_rows = mysql_num_rows($result);
	$bal=0;
	$query2="delete FROM $bankapi_child_txn.com_paid_parent where user_id='$user_id';";
	$result2=mysql_query($query2);
	while($rs = mysql_fetch_assoc($result))
	{
		$dt=$rs['dt'];
		$cr=$rs['cr'];
		$dr=$rs['dr'];
		$bal=$bal+$cr-$dr;
		$query3="insert into $bankapi_child_txn.com_paid_parent(date_time,user_id,cr,dr,bal) value('$dt','$user_id','$cr','$dr','$bal');";
		$result3=mysql_query($query3);
	}
	$query="SELECT date(date_time) dt,sum(cr) cr,sum(dr) dr FROM $bankapi_child_txn.com_paid_child where user_id='$user_id' and details like 'my%' group by date(date_time) order by date(date_time)";
	$result=mysql_query($query);
	$num_rows = mysql_num_rows($result);
	$bal=0;
	$query2="delete FROM $bankapi_child_txn.com_paid_parent_my where user_id='$user_id';";
	$result2=mysql_query($query2);
	while($rs = mysql_fetch_assoc($result))
	{
		$dt=$rs['dt'];
		$cr=$rs['cr'];
		$dr=$rs['dr'];
		$bal=$bal+$cr-$dr;
		$query3="insert into $bankapi_child_txn.com_paid_parent_my(date_time,user_id,cr,dr,bal) value('$dt','$user_id','$cr','$dr','$bal');";
		$result3=mysql_query($query3);
	}
}
function show_paid_comm($user_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="SELECT sum(dr) bal FROM $bankapi_child_txn.com_paid_child WHERE user_id = '$user_id'";
	$result=mysql_query($query);
	$bal=0;
	while($rs = mysql_fetch_assoc($result))
	{
		if(isset($rs['bal']))
		$bal=$rs['bal'];
	}
	return $bal;
}
function show_my_all_payout($user_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="SELECT monthof, sum(earning) earning, sum(gst) gst, sum(remain) remain, sum(tds) tds, sum(comm) comm, paidon FROM $bankapi_child_txn.all_gst_tds WHERE userid = '$user_id' group by monthof order by monthof desc";
	$result=mysql_query($query);
	return $result;
}
function show_my_all_payouts($user_id,$month_of)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="SELECT * FROM $bankapi_child_txn.all_gst_tds WHERE userid = '$user_id' and monthof like '$month_of%' order by tax_id;";
	$result=mysql_query($query);
	return $result;
}
function show_paid_comm_non_aff($user_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="SELECT sum(dr) bal FROM $bankapi_child_txn.com_paid_child WHERE details like 'My%' and user_id = '$user_id'";
	$result=mysql_query($query);
	$bal=0;
	while($rs = mysql_fetch_assoc($result))
	{
		if(isset($rs['bal']))
		$bal=$rs['bal'];
	}
	return $bal;
}
function show_unpaid_comm($user_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="SELECT sum(cr-dr) bal FROM $bankapi_child_txn.com_paid_child WHERE user_id = '$user_id'";
	$result=mysql_query($query);
	$bal=0;
	while($rs = mysql_fetch_assoc($result))
	{
		if(isset($rs['bal']))
		$bal=$rs['bal'];
	}
	return $bal;
}
function show_unpaid_comm_non_aff($user_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="SELECT sum(cr-dr) bal FROM $bankapi_child_txn.com_paid_child WHERE details like 'My%' and user_id = '$user_id'";
	$result=mysql_query($query);
	$bal=0;
	while($rs = mysql_fetch_assoc($result))
	{
		if(isset($rs['bal']))
		$bal=$rs['bal'];
	}
	return $bal;
}
function show_unpaid_comm_gst($user_id,$dt1,$dt2)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="SELECT sum(cr-dr) bal FROM $bankapi_child_txn.com_paid_child WHERE user_id = '$user_id' and type in(1) and date(date_time) between '$dt1' and '$dt2' and details like 'My%'";
	$result=mysql_query($query);
	$bal=0;
	while($rs = mysql_fetch_assoc($result))
	{
		if(isset($rs['bal']))
		$bal=$rs['bal'];
	}
	return $bal;
}
function show_unpaid_comm_non_gst($user_id,$dt1,$dt2)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="SELECT sum(cr-dr) bal FROM $bankapi_child_txn.com_paid_child WHERE user_id = '$user_id' and type in(3,4) and date(date_time) between '$dt1' and '$dt2'";
	$result=mysql_query($query);
	$bal=0;
	while($rs = mysql_fetch_assoc($result))
	{
		if(isset($rs['bal']))
		$bal=$rs['bal'];
	}
	return $bal;
}
function show_unpaid_comm_non_gst2($user_id,$dt1,$dt2)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="SELECT sum(cr-dr) bal FROM $bankapi_child_txn.com_paid_child WHERE user_id = '$user_id' and type in(1) and date(date_time) between '$dt1' and '$dt2' and details not like 'My%'";
	$result=mysql_query($query);
	$bal=0;
	while($rs = mysql_fetch_assoc($result))
	{
		if(isset($rs['bal']))
		$bal=$rs['bal'];
	}
	return $bal;
}
function show_payout_count($cond)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="SELECT * FROM $bankapi_child_txn.com_paid_parent $cond order by paid_id desc;";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	return $total_records;
}
function show_payout_data($cond, $start_from=0, $num_rec_per_page=0)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$start_from=mysql_real_escape_string($start_from);
	$num_rec_per_page=mysql_real_escape_string($num_rec_per_page);
	if($start_from==0 && $num_rec_per_page==0)
	$query="SELECT * FROM $bankapi_child_txn.com_paid_parent $cond order by paid_id desc";
	else
	$query="SELECT * FROM $bankapi_child_txn.com_paid_parent $cond order by paid_id desc LIMIT $start_from, $num_rec_per_page;";
	$result=mysql_query($query);
	return $result;
}
function show_mypayout_count($cond)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="SELECT * FROM $bankapi_child_txn.com_paid_parent_my $cond order by paid_id desc;";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	return $total_records;
}
function show_mypayout_data($cond, $start_from=0, $num_rec_per_page=0)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$start_from=mysql_real_escape_string($start_from);
	$num_rec_per_page=mysql_real_escape_string($num_rec_per_page);
	if($start_from==0 && $num_rec_per_page==0)
	$query="SELECT * FROM $bankapi_child_txn.com_paid_parent_my $cond order by paid_id desc";
	else
	$query="SELECT * FROM $bankapi_child_txn.com_paid_parent_my $cond order by paid_id desc LIMIT $start_from, $num_rec_per_page;";
	$result=mysql_query($query);
	return $result;
}
function show_payout_detail_count($cond)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="SELECT * FROM $bankapi_child_txn.com_paid_child $cond and details not like 'my%' order by paid_id desc;";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	return $total_records;
}
function show_payout_detail_data($cond, $start_from=0, $num_rec_per_page=0)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$start_from=mysql_real_escape_string($start_from);
	$num_rec_per_page=mysql_real_escape_string($num_rec_per_page);
	if($start_from==0 && $num_rec_per_page==0)
	$query="SELECT * FROM $bankapi_child_txn.com_paid_child $cond and details not like 'my%' order by paid_id desc";
	else
	$query="SELECT * FROM $bankapi_child_txn.com_paid_child $cond and details not like 'my%' order by paid_id desc LIMIT $start_from, $num_rec_per_page;";
	$result=mysql_query($query);
	return $result;
}
function show_mypayout_detail_count($cond)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="SELECT * FROM $bankapi_child_txn.com_paid_child $cond and details like 'my%' order by paid_id desc;";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	return $total_records;
}
function show_mypayout_detail_data($cond, $start_from=0, $num_rec_per_page=0)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$start_from=mysql_real_escape_string($start_from);
	$num_rec_per_page=mysql_real_escape_string($num_rec_per_page);
	if($start_from==0 && $num_rec_per_page==0)
	$query="SELECT * FROM $bankapi_child_txn.com_paid_child $cond and details like 'my%' order by paid_id desc";
	else
	$query="SELECT * FROM $bankapi_child_txn.com_paid_child $cond and details like 'my%' order by paid_id desc LIMIT $start_from, $num_rec_per_page;";
	$result=mysql_query($query);
	return $result;
}
function show_order_details($order_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$retailer_id=0;
	$source=0;
	$type=0;
	$arr=array();
	$query="SELECT * FROM $bankapi_child_txn.txn_mt_child where order_id='$order_id';";
	$result=mysql_query($query);
	while($res=mysql_fetch_array($result))
	{
		$retailer_id=$res['user_id'];
		$source=$res['source'];
		$type=$res['type'];
	}
	$arr=array($retailer_id,$source,$type);
	return $arr;
}
function show_order_details2($order_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$retailer_id=0;
	$source=0;
	$type=0;
	$arr=array();
	$query="SELECT * FROM $bankapi_child_txn.txn_rc where rc_id='$order_id';";
	$result=mysql_query($query);
	while($res=mysql_fetch_array($result))
	{
		$retailer_id=$res['user_id'];
		$source=$res['source'];
		$type=$res['type'];
	}
	$arr=array($retailer_id,$source,$type);
	return $arr;
}
function show_team_commission_count($cond)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="SELECT user_id,sum(cr) cr,sum(dr) dr,sum(cr-dr) bal FROM $bankapi_child_txn.com_paid_child $cond group by user_id having (sum(cr)!=0 or sum(dr)!=0) order by bal desc;";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	return $total_records;
}
function show_team_commission_data($cond, $start_from=0, $num_rec_per_page=0)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$start_from=mysql_real_escape_string($start_from);
	$num_rec_per_page=mysql_real_escape_string($num_rec_per_page);
	if($start_from==0 && $num_rec_per_page==0)
	$query="SELECT user_id,sum(cr) cr,sum(dr) dr,sum(cr-dr) bal FROM $bankapi_child_txn.com_paid_child $cond group by user_id having (sum(cr)!=0 or sum(dr)!=0) order by bal desc";
	else
	$query="SELECT user_id,sum(cr) cr,sum(dr) dr,sum(cr-dr) bal FROM $bankapi_child_txn.com_paid_child $cond group by user_id having (sum(cr)!=0 or sum(dr)!=0) order by bal desc LIMIT $start_from, $num_rec_per_page;";
	$result=mysql_query($query);
	return $result;
}
function pay_now($from,$user,$amount,$remarks)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$etid=time();
	$query="insert into $bankapi_child_txn.com_paid_child value(NULL,$etid,'$user',0,0,0,'$datetime_datetime','$remarks',0,'$amount');";
	mysql_query($query);
	transfer_user_to_user_paid($from, $user, $amount, $remarks);
}

function show_desc_data($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}

function pay_now_all($user,$earn,$gst,$remain,$tds,$com,$remarks,$dt2)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	//include('zf-WalletDistributed.php');
	$etid=time();
	$etid1=$etid."1";
	$rem1="PAYOUT: $remarks, AMOUNT:$earn, GST:$gst";
	$q1="insert into $bankapi_child_txn.com_paid_child value(NULL,'$etid1','$user',0,0,0,'$dt2 23:59:59','GST : $remarks',0,'$gst');";
	mysql_query($q1);
	$etid2=$etid."2";
	$rem2="PAYOUT: $remarks, EARNING:$remain, TDS:$tds";
	$q2="insert into $bankapi_child_txn.com_paid_child value(NULL,'$etid2','$user',0,0,0,'$dt2 23:59:59','TDS : $remarks',0,'$tds');";
	mysql_query($q2);
	$etid3=$etid."3";
	$rem3="PAYOUT: $remarks, COMMISSION:$com";
	$q3="insert into $bankapi_child_txn.com_paid_child value(NULL,'$etid3','$user',0,0,0,'$dt2 23:59:59','COMMISSION : $remarks',0,'$com');";
	mysql_query($q3);
	//gst to gst wallet
	transfer_to_wallet($user, $wallet_gsttopay, $gst, $rem1);
	//tds to tds wallet
	transfer_to_wallet($user, $wallet_tdstopay, $tds, $rem2);
	//earning to retailer wallet
	transfer_to_wallet2($user, $user, $com, $remarks);
}

function gst_tds($user,$dt,$prd,$ern,$gst,$rem,$tds,$com)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
/*
	create table all_gst_tds
	(
		tax_id bigint auto_increment primary key,
		userid bigint default 0,
		monthof date default '0000-00-00',
		product varchar(50) default '0',
		earning decimal(15,2) default 0,
		gst decimal(15,2) default 0,
		remain decimal(15,2) default 0,
		tds decimal(15,2) default 0,
		comm decimal(15,2) default 0,
		paidon date default '0000-00-00'
	);
	ALTER TABLE all_gst_tds ENGINE = MyISAM;
*/
	$query="INSERT INTO $bankapi_child_txn.all_gst_tds VALUES (NULL, '$user', '$dt', '$prd', '$ern', '$gst', '$rem', '$tds', '$com', '$datetime_date')";
	mysql_query($query);
}

function pay_now_all_new($user,$earn,$gst,$remain,$tds,$com,$remarks,$dt2,$tds1,$tds2,$tds3,$com1,$com2,$com3)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	//include('zf-WalletDistributed.php');
	$etid=time();
	$etid1=$etid."1";/////////////////////////$dt2 23:59:59
	$rem1="PAYOUT: $remarks, AMOUNT:$earn, GST:$gst";
	$q1="insert into $bankapi_child_txn.com_paid_child value(NULL,'$etid1','$user',0,0,0,'$datetime_datetime','My GST : $remarks',0,'$gst');";
	mysql_query($q1);
	$etid2=$etid."2";/////////////////////////
	$rem2="PAYOUT: $remarks, EARNING:$remain, TDS:$tds1";
	$q2="insert into $bankapi_child_txn.com_paid_child value(NULL,'$etid2','$user',0,0,0,'$datetime_datetime','My TDS : $remarks',0,'$tds1');";
	if($tds1!=0)
	mysql_query($q2);
	$etid3=$etid."3";
	$rem3="PAYOUT: $remarks, COMMISSION:$com1";
	$q3="insert into $bankapi_child_txn.com_paid_child value(NULL,'$etid3','$user',0,0,0,'$datetime_datetime','My COMMISSION : $remarks',0,'$com1');";
	if($com1!=0)
	mysql_query($q3);
	$etid2=$etid."4";/////////////////////////
	$rem2="PAYOUT: $remarks, EARNING:$remain, TDS:$tds2";
	$q2="insert into $bankapi_child_txn.com_paid_child value(NULL,'$etid2','$user',0,0,0,'$datetime_datetime','Affiliate TDS : $remarks',0,'$tds2');";
	if($tds2!=0)
	mysql_query($q2);
	$etid3=$etid."5";
	$rem3="PAYOUT: $remarks, COMMISSION:$com2";
	$q3="insert into $bankapi_child_txn.com_paid_child value(NULL,'$etid3','$user',0,0,0,'$datetime_datetime','Affiliate COMMISSION : $remarks',0,'$com2');";
	if($com2!=0)
	mysql_query($q3);
	$etid2=$etid."6";/////////////////////////
	$rem2="PAYOUT: $remarks, EARNING:$remain, TDS:$tds3";
	$q2="insert into $bankapi_child_txn.com_paid_child value(NULL,'$etid2','$user',0,0,0,'$datetime_datetime','Affiliate TDS : $remarks',0,'$tds3');";
	if($tds3!=0)
	mysql_query($q2);
	$etid3=$etid."7";/////////////////////////
	$rem3="PAYOUT: $remarks, COMMISSION:$com3";
	$q3="insert into $bankapi_child_txn.com_paid_child value(NULL,'$etid3','$user',0,0,0,'$datetime_datetime','Affiliate COMMISSION : $remarks',0,'$com3');";
	if($com3!=0)
	mysql_query($q3);
	//gst to gst wallet
	transfer_to_wallet($user, $wallet_gsttopay, $gst, $rem1);
	//tds to tds wallet
	transfer_to_wallet($user, $wallet_tdstopay, $tds, $rem2);
	//earning to retailer wallet
	transfer_to_wallet2($user, $user, $com, $remarks);
}

function gst_tds_new($user,$dt,$prd,$ern,$gst,$rem,$tds,$com)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
/*
	create table all_gst_tds
	(
		tax_id bigint auto_increment primary key,
		userid bigint default 0,
		monthof date default '0000-00-00',
		product varchar(50) default '0',
		earning decimal(15,2) default 0,
		gst decimal(15,2) default 0,
		remain decimal(15,2) default 0,
		tds decimal(15,2) default 0,
		comm decimal(15,2) default 0,
		paidon date default '0000-00-00'
	);
	ALTER TABLE all_gst_tds ENGINE = MyISAM;
*/
	$query="INSERT INTO $bankapi_child_txn.all_gst_tds VALUES (NULL, '$user', '$dt', '$prd', '$ern', '$gst', '$rem', '$tds', '$com', '$datetime_date')";
	mysql_query($query);
}

function transfer_to_wallet($user_from, $user_to, $amount, $remarks)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	
	$pre2=show_user_balance_last($user_to);
	$post2=$pre2+$amount;
	$query2="INSERT INTO $bankapi_child_wallet.distribution(`wallet_date`, `wallet_time`, `user_id`, `user_id2`, `request_id`, `service_id`, `order_id`, `tid`, `transaction_type`, `transaction_description`, `amount_pre`, `amount_cr`, `amount_dr`, `amount_bal`, `remarks`) VALUES ('$datetime_date', '$datetime_time', '$user_to', '$user_from', 0, 0, 0, 0, 21, '$remarks', '$pre2', '$amount', '0', '$post2', '$remarks')";
	mysql_query($query2);
	update_user_balance_last($user_to);
}

function transfer_to_wallet2($user_from, $user_to, $amount, $remarks)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	
	$pre2=show_user_balance_last($user_to);
	$post2=$pre2+$amount;
	$query2="INSERT INTO $bankapi_child_wallet.distribution(`wallet_date`, `wallet_time`, `user_id`, `user_id2`, `request_id`, `service_id`, `order_id`, `tid`, `transaction_type`, `transaction_description`, `amount_pre`, `amount_cr`, `amount_dr`, `amount_bal`, `remarks`) VALUES ('$datetime_date', '$datetime_time', '$user_to', '$user_from', 0, 0, 0, 0, 8, '$remarks', '$pre2', '$amount', '0', '$post2', 'COMMISSION : $remarks')";
	mysql_query($query2);
	update_user_balance_last($user_to);
}

function show_user_balance_last($user)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	
	$query="select * from $bankapi_child_wallet.distribution where user_id='$user' order by wallet_id desc limit 0,1 ";
	$result=mysql_query($query);
	$bal=0;
	while($row=mysql_fetch_array($result))
	{
		$bal=$row['amount_bal'];
	}
	return $bal;
}

function update_user_balance_last($user)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$bal=show_user_balance_last($user);
	$query="update $bankapi_child_base.child_userinfo_walletkyc set wallet_balance='$bal' where user_id='$user'";
	mysql_query($query);
}
?>