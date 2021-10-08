<?php
function rd1($rdate)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$qry1="SELECT * FROM $bankapi_child_report.sonar_basic_daily WHERE report_date='$rdate';";
	$res1=mysql_query($qry1);
	$num_rows1 = mysql_num_rows($res1);
	if($num_rows1==0)
	{
		$qry2="INSERT INTO $bankapi_child_report.sonar_basic_daily(report_date) VALUES ('$rdate');";
		mysql_query($qry2);
	}
	$a1=$a2=$a3=$a4=$a5=$a6=$a7=$a8=$a9=$a10=$a11=$a12=$a13=$a14=0;
	
	//admin_opening_balance
	$qry_check="SELECT amount_bal amt FROM $bankapi_child_wallet.distribution WHERE user_id = $main_admin AND wallet_date < '$rdate' ORDER BY wallet_id desc limit 0,1;";
	$res_check=mysql_query($qry_check);
	while($rs_check=mysql_fetch_array($res_check))
	{
		$a1=$rs_check['amt'];
	}
	if($a1=="")
		$a1=0;
	$qry_update="update $bankapi_child_report.sonar_basic_daily set opening_balance='$a1' where report_date='$rdate';";
	mysql_query($qry_update);
	
	//admin_wallet_update
	$qry_check="SELECT sum(amount_cr) amt FROM $bankapi_child_wallet.distribution WHERE user_id = $main_admin and transaction_type in(1,5,21,13) and wallet_date='$rdate';";
	$res_check=mysql_query($qry_check);
	while($rs_check=mysql_fetch_array($res_check))
	{
		$a2=$rs_check['amt'];
	}
	if($a2=="")
		$a2=0;
	$qry_update="update $bankapi_child_report.sonar_basic_daily set wallet_received='$a2' where report_date='$rdate';";
	mysql_query($qry_update);
	
	//admin_wallet_transfer
	$qry_check="SELECT sum(amount_dr) amt FROM $bankapi_child_wallet.distribution WHERE user_id = $main_admin and transaction_type in(2,3,5) and wallet_date='$rdate';";
	$res_check=mysql_query($qry_check);
	while($rs_check=mysql_fetch_array($res_check))
	{
		$a3=$rs_check['amt'];
	}
	if($a3=="")
		$a3=0;
	$qry_update="update $bankapi_child_report.sonar_basic_daily set wallet_transfer='$a3' where report_date='$rdate';";
	mysql_query($qry_update);
	
	//admin_closing_balance
	$qry_check="SELECT amount_bal amt FROM $bankapi_child_wallet.distribution WHERE user_id = $main_admin AND wallet_date <= '$rdate' ORDER BY wallet_id desc limit 0,1;";
	$res_check=mysql_query($qry_check);
	while($rs_check=mysql_fetch_array($res_check))
	{
		$a4=$rs_check['amt'];
	}
	if($a4=="")
		$a4=0;
	$qry_update="update $bankapi_child_report.sonar_basic_daily set closing_balance='$a4' where report_date='$rdate';";
	mysql_query($qry_update);
	
	//admin user
	$qry_check="SELECT count(*) num FROM $bankapi_child_base.child_user where user_type in(-1,1) and join_date='$rdate';";
	$res_check=mysql_query($qry_check);
	while($rs_check=mysql_fetch_array($res_check))
	{
		$a5=$rs_check['num'];
	}
	if($a5=="")
		$a5=0;
	$qry_update="update $bankapi_child_report.sonar_basic_daily set reg_user='$a5' where report_date='$rdate';";
	mysql_query($qry_update);
	
	//team
	$qry_check="SELECT count(*) num FROM $bankapi_child_base.child_user where (user_type between 2 and 11) and join_date='$rdate';";
	$res_check=mysql_query($qry_check);
	while($rs_check=mysql_fetch_array($res_check))
	{
		$a6=$rs_check['num'];
	}
	if($a6=="")
		$a6=0;
	$qry_update="update $bankapi_child_report.sonar_basic_daily set reg_team='$a6' where report_date='$rdate';";
	mysql_query($qry_update);
	
	//retailer
	$qry_check="SELECT count(*) num FROM $bankapi_child_base.child_user where user_type in(12) and join_date='$rdate';";
	$res_check=mysql_query($qry_check);
	while($rs_check=mysql_fetch_array($res_check))
	{
		$a7=$rs_check['num'];
	}
	if($a7=="")
		$a7=0;
	$qry_update="update $bankapi_child_report.sonar_basic_daily set reg_retailer='$a7' where report_date='$rdate';";
	mysql_query($qry_update);
	
	//all team
	$qry_check="SELECT count(*) num FROM $bankapi_child_base.child_user where join_date='$rdate' and user_type!=0;";
	$res_check=mysql_query($qry_check);
	while($rs_check=mysql_fetch_array($res_check))
	{
		$a8=$rs_check['num'];
	}
	if($a8=="")
		$a8=0;
	$qry_update="update $bankapi_child_report.sonar_basic_daily set reg_total='$a8' where report_date='$rdate';";
	mysql_query($qry_update);
	
	//wallet_request_received_unit,amt
	$qry_check="SELECT count(*) num,sum(deposit_amount) amt FROM $bankapi_child_wallet.requests where request_date='$rdate';";
	$res_check=mysql_query($qry_check);
	while($rs_check=mysql_fetch_array($res_check))
	{
		$a9=$rs_check['num'];
		$a10=$rs_check['amt'];
	}
	if($a9=="")
		$a9=0;
	if($a10=="")
		$a10=0;
	$qry_update="update $bankapi_child_report.sonar_basic_daily set wallet_request_received_unit='$a9', wallet_request_received_amount='$a10' where report_date='$rdate';";
	mysql_query($qry_update);
	
	//wallet_request_accepted_unit,amt
	$qry_check="SELECT count(*) num,sum(deposit_amount) amt FROM $bankapi_child_wallet.requests where request_date='$rdate' and request_status='2';";
	$res_check=mysql_query($qry_check);
	while($rs_check=mysql_fetch_array($res_check))
	{
		$a11=$rs_check['num'];
		$a12=$rs_check['amt'];
	}
	if($a11=="")
		$a11=0;
	if($a12=="")
		$a12=0;
	$qry_update="update $bankapi_child_report.sonar_basic_daily set wallet_request_accepted_unit='$a11', wallet_request_accepted_amount='$a12' where report_date='$rdate';";
	mysql_query($qry_update);
	
	//ticket_received
	$qry_check="SELECT count(*) num FROM $bankapi_child_base.child_tickets where date(date_time)='$rdate';";
	$res_check=mysql_query($qry_check);
	while($rs_check=mysql_fetch_array($res_check))
	{
		$a13=$rs_check['num'];
	}
	if($a13=="")
		$a13=0;
	$qry_update="update $bankapi_child_report.sonar_basic_daily set ticket_received='$a13' where report_date='$rdate';";
	mysql_query($qry_update);
	
	//ticket_received
	$qry_check="SELECT count(*) num FROM $bankapi_child_base.child_tickets where date(date_time)='$rdate' and ticket_status='4';";
	$res_check=mysql_query($qry_check);
	while($rs_check=mysql_fetch_array($res_check))
	{
		$a14=$rs_check['num'];
	}
	if($a14=="")
		$a14=0;
	$qry_update="update $bankapi_child_report.sonar_basic_daily set ticket_closed='$a14' where report_date='$rdate';";
	mysql_query($qry_update);
}

function rm1($rdate)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	
	mysql_query("delete from $bankapi_child_report.sonar_basic_monthly where report_month='$rdate'");
	$query="insert into $bankapi_child_report.sonar_basic_monthly SELECT NULL, '$rdate', sum(opening_balance), sum(wallet_received), sum(wallet_transfer), sum(closing_balance), sum(reg_user), sum(reg_team), sum(reg_retailer), sum(reg_total), sum(wallet_request_received_unit), sum(wallet_request_received_amount), sum(wallet_request_accepted_unit), sum(wallet_request_accepted_amount), sum(ticket_received), sum(ticket_closed) FROM $bankapi_child_report.sonar_basic_daily WHERE report_date like '$rdate%';";
	mysql_query($query);
}

function rd1_count()
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_report.sonar_basic_daily;";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	return $total_records;
}

function rd1_show()
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_report.sonar_basic_daily order by report_date desc;";
	$result=mysql_query($query);
	return $result;
}

function md1_count()
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_report.sonar_basic_monthly;";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	return $total_records;
}

function md1_show()
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_report.sonar_basic_monthly order by report_month desc;";
	$result=mysql_query($query);
	return $result;
}

function rd2($rdate)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$qry1="SELECT * FROM $bankapi_child_report.sonar_mt_daily WHERE report_date='$rdate';";
	$res1=mysql_query($qry1);
	$num_rows1 = mysql_num_rows($res1);
	if($num_rows1==0)
	{
		$qry2="INSERT INTO $bankapi_child_report.sonar_mt_daily(report_date) VALUES ('$rdate');";
		mysql_query($qry2);
	}
	$a1=$a2=$a3=$a4=$a5=$a6=$a7=$a8=$a9=$a10=$a11=$a12=$a13=$a14=0;
	
	//transfer and charges and charged
	$qry_check="SELECT sum(amount) mt_amount, count(*) mt_unit, sum(charges) charges, sum(com_charged) charged FROM $bankapi_child_txn.txn_mt_child where date(created_on)='$rdate' and order_status=2 and type=1;";
	$res_check=mysql_query($qry_check);
	while($rs_check=mysql_fetch_array($res_check))
	{
		$a1=$rs_check['mt_amount'];
		$a2=$rs_check['mt_unit'];
		$a3=$rs_check['charges'];
		$a4=$rs_check['charged'];
	}
	if($a1=="")
		$a1=0;
	if($a2=="")
		$a2=0;
	if($a3=="")
		$a3=0;
	if($a4=="")
		$a4=0;
	$qry_update="update $bankapi_child_report.sonar_mt_daily set transfer_amount='$a1', transfer_unit='$a2', charges='$a3', charged='$a4' where report_date='$rdate';";
	mysql_query($qry_update);
	
	//account verification
	$qry_check="SELECT sum(amount) av_amount, count(*) av_unit FROM $bankapi_child_txn.txn_mt_child where date(created_on)='$rdate' and order_status=2 and type=2;";
	$res_check=mysql_query($qry_check);
	while($rs_check=mysql_fetch_array($res_check))
	{
		$a5=$rs_check['av_amount'];
		$a6=$rs_check['av_unit'];
	}
	if($a5=="")
		$a5=0;
	if($a6=="")
		$a6=0;
	$qry_update="update $bankapi_child_report.sonar_mt_daily set verification_amount='$a5', verification_unit='$a6' where report_date='$rdate';";
	mysql_query($qry_update);
	
	//not intit
	$qry_check="SELECT count(*) num FROM $bankapi_child_txn.txn_mt_child where date(created_on)='$rdate' and order_status=0;";
	$res_check=mysql_query($qry_check);
	while($rs_check=mysql_fetch_array($res_check))
	{
		$a7=$rs_check['num'];
	}
	if($a7=="")
		$a7=0;
	$qry_update="update $bankapi_child_report.sonar_mt_daily set noti='$a7' where report_date='$rdate';";
	mysql_query($qry_update);
	
	//success
	$qry_check="SELECT count(*) num FROM $bankapi_child_txn.txn_mt_child where date(created_on)='$rdate' and order_status=2;";
	$res_check=mysql_query($qry_check);
	while($rs_check=mysql_fetch_array($res_check))
	{
		$a8=$rs_check['num'];
	}
	if($a8=="")
		$a8=0;
	$qry_update="update $bankapi_child_report.sonar_mt_daily set succ='$a8' where report_date='$rdate';";
	mysql_query($qry_update);
	
	//in-pro
	$qry_check="SELECT count(*) num FROM $bankapi_child_txn.txn_mt_child where date(created_on)='$rdate' and order_status in(-1,-2,1,3);";
	$res_check=mysql_query($qry_check);
	while($rs_check=mysql_fetch_array($res_check))
	{
		$a9=$rs_check['num'];
	}
	if($a9=="")
		$a9=0;
	$qry_update="update $bankapi_child_report.sonar_mt_daily set inpro='$a9' where report_date='$rdate';";
	mysql_query($qry_update);
	
	//rpsrc
	$qry_check="SELECT count(*) num FROM $bankapi_child_txn.txn_mt_child where date(created_on)='$rdate' and order_status=4;";
	$res_check=mysql_query($qry_check);
	while($rs_check=mysql_fetch_array($res_check))
	{
		$a10=$rs_check['num'];
	}
	if($a10=="")
		$a10=0;
	$qry_update="update $bankapi_child_report.sonar_mt_daily set rpsrc='$a10' where report_date='$rdate';";
	mysql_query($qry_update);
	
	//rpown
	$qry_check="SELECT count(*) num FROM $bankapi_child_txn.txn_mt_child where date(created_on)='$rdate' and order_status='-4';";
	$res_check=mysql_query($qry_check);
	while($rs_check=mysql_fetch_array($res_check))
	{
		$a11=$rs_check['num'];
	}
	if($a11=="")
		$a11=0;
	$qry_update="update $bankapi_child_report.sonar_mt_daily set rpown='$a11' where report_date='$rdate';";
	mysql_query($qry_update);
	
	//refunded
	$qry_check="SELECT count(*) num FROM $bankapi_child_txn.txn_mt_child where date(created_on)='$rdate' and order_status=5;";
	$res_check=mysql_query($qry_check);
	while($rs_check=mysql_fetch_array($res_check))
	{
		$a12=$rs_check['num'];
	}
	if($a12=="")
		$a12=0;
	$qry_update="update $bankapi_child_report.sonar_mt_daily set refunded='$a12' where report_date='$rdate';";
	mysql_query($qry_update);
	
	//total
	$qry_check="SELECT count(*) num FROM $bankapi_child_txn.txn_mt_child where date(created_on)='$rdate';";
	$res_check=mysql_query($qry_check);
	while($rs_check=mysql_fetch_array($res_check))
	{
		$a13=$rs_check['num'];
	}
	if($a13=="")
		$a13=0;
	$qry_update="update $bankapi_child_report.sonar_mt_daily set total='$a13' where report_date='$rdate';";
	mysql_query($qry_update);
	//return $qry_update;
}

function rm2($rdate)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	
	mysql_query("delete from $bankapi_child_report.sonar_mt_monthly where report_month='$rdate'");
	$query="insert into $bankapi_child_report.sonar_mt_monthly SELECT NULL, '$rdate', sum(transfer_unit), sum(transfer_amount), sum(verification_unit), sum(verification_amount), sum(charges), sum(charged), sum(charged_later), sum(noti), sum(succ), sum(inpro), sum(rpsrc), sum(rpown), sum(refunded), sum(total) FROM $bankapi_child_report.sonar_mt_daily WHERE report_date like '$rdate%';";
	mysql_query($query);
}

function rd2_count()
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_report.sonar_mt_daily;";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	return $total_records;
}

function rd2_show()
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_report.sonar_mt_daily order by report_date desc;";
	$result=mysql_query($query);
	return $result;
}

function md2_count()
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_report.sonar_mt_monthly;";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	return $total_records;
}

function md2_show()
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_report.sonar_mt_monthly order by report_month desc;";
	$result=mysql_query($query);
	return $result;
}

function rd3($rdate)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$qry1="SELECT * FROM $bankapi_child_report.sonar_rc_daily WHERE report_date='$rdate';";
	$res1=mysql_query($qry1);
	$num_rows1 = mysql_num_rows($res1);
	if($num_rows1==0)
	{
		$qry2="INSERT INTO $bankapi_child_report.sonar_rc_daily(report_date) VALUES ('$rdate');";
		mysql_query($qry2);
	}
	$a1=$a2=$a3=$a4=$a5=$a6=$a7=$a8=$a9=$a10=$a11=$a12=$a13=$a14=0;
	
	//rc amount and deducted
	$qry_check="SELECT sum(amount) rc_amount, count(*) rc_unit, sum(deducted_amt) rc_deducted FROM $bankapi_child_txn.txn_rc where date(created_on)='$rdate' and rc_status=2;";
	$res_check=mysql_query($qry_check);
	while($rs_check=mysql_fetch_array($res_check))
	{
		$a1=$rs_check['rc_amount'];
		$a2=$rs_check['rc_unit'];
		$a3=$rs_check['rc_deducted'];
	}
	if($a1=="")
		$a1=0;
	if($a2=="")
		$a2=0;
	if($a3=="")
		$a3=0;
	$qry_update="update $bankapi_child_report.sonar_rc_daily set recharge_amount='$a1', recharge_unit='$a2', recharge_deducted='$a3' where report_date='$rdate';";
	mysql_query($qry_update);
	
	//not intit
	$qry_check="SELECT count(*) num FROM $bankapi_child_txn.txn_rc where date(created_on)='$rdate' and rc_status=0;";
	$res_check=mysql_query($qry_check);
	while($rs_check=mysql_fetch_array($res_check))
	{
		$a7=$rs_check['num'];
	}
	if($a7=="")
		$a7=0;
	$qry_update="update $bankapi_child_report.sonar_rc_daily set noti='$a7' where report_date='$rdate';";
	mysql_query($qry_update);
	
	//success
	$qry_check="SELECT count(*) num FROM $bankapi_child_txn.txn_rc where date(created_on)='$rdate' and rc_status=2;";
	$res_check=mysql_query($qry_check);
	while($rs_check=mysql_fetch_array($res_check))
	{
		$a8=$rs_check['num'];
	}
	if($a8=="")
		$a8=0;
	$qry_update="update $bankapi_child_report.sonar_rc_daily set succ='$a8' where report_date='$rdate';";
	mysql_query($qry_update);
	
	//in-pro
	$qry_check="SELECT count(*) num FROM $bankapi_child_txn.txn_rc where date(created_on)='$rdate' and rc_status in(-1,-2,1,3);";
	$res_check=mysql_query($qry_check);
	while($rs_check=mysql_fetch_array($res_check))
	{
		$a9=$rs_check['num'];
	}
	if($a9=="")
		$a9=0;
	$qry_update="update $bankapi_child_report.sonar_rc_daily set inpro='$a9' where report_date='$rdate';";
	mysql_query($qry_update);
	
	//rpsrc
	$qry_check="SELECT count(*) num FROM $bankapi_child_txn.txn_rc where date(created_on)='$rdate' and rc_status=4;";
	$res_check=mysql_query($qry_check);
	while($rs_check=mysql_fetch_array($res_check))
	{
		$a10=$rs_check['num'];
	}
	if($a10=="")
		$a10=0;
	$qry_update="update $bankapi_child_report.sonar_rc_daily set rpsrc='$a10' where report_date='$rdate';";
	mysql_query($qry_update);
	
	//rpown
	$qry_check="SELECT count(*) num FROM $bankapi_child_txn.txn_rc where date(created_on)='$rdate' and rc_status='-4';";
	$res_check=mysql_query($qry_check);
	while($rs_check=mysql_fetch_array($res_check))
	{
		$a11=$rs_check['num'];
	}
	if($a11=="")
		$a11=0;
	$qry_update="update $bankapi_child_report.sonar_rc_daily set rpown='$a11' where report_date='$rdate';";
	mysql_query($qry_update);
	
	//refunded
	$qry_check="SELECT count(*) num FROM $bankapi_child_txn.txn_rc where date(created_on)='$rdate' and rc_status=5;";
	$res_check=mysql_query($qry_check);
	while($rs_check=mysql_fetch_array($res_check))
	{
		$a12=$rs_check['num'];
	}
	if($a12=="")
		$a12=0;
	$qry_update="update $bankapi_child_report.sonar_rc_daily set refunded='$a12' where report_date='$rdate';";
	mysql_query($qry_update);
	
	//total
	$qry_check="SELECT count(*) num FROM $bankapi_child_txn.txn_rc where date(created_on)='$rdate';";
	$res_check=mysql_query($qry_check);
	while($rs_check=mysql_fetch_array($res_check))
	{
		$a13=$rs_check['num'];
	}
	if($a13=="")
		$a13=0;
	$qry_update="update $bankapi_child_report.sonar_rc_daily set total='$a13' where report_date='$rdate';";
	mysql_query($qry_update);
	//return $qry_update;
}

function rm3($rdate)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	
	mysql_query("delete from $bankapi_child_report.sonar_rc_monthly where report_month='$rdate'");
	$query="insert into $bankapi_child_report.sonar_rc_monthly SELECT NULL, '$rdate', sum(recharge_unit), sum(recharge_amount), sum(recharge_deducted), sum(noti), sum(succ), sum(inpro), sum(rpsrc), sum(rpown), sum(refunded), sum(total) FROM $bankapi_child_report.sonar_rc_daily WHERE report_date like '$rdate%';";
	mysql_query($query);
}

function rd3_count()
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_report.sonar_rc_daily;";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	return $total_records;
}

function rd3_show()
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_report.sonar_rc_daily order by report_date desc;";
	$result=mysql_query($query);
	return $result;
}

function md3_count()
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_report.sonar_rc_monthly;";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	return $total_records;
}

function md3_show()
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_report.sonar_rc_monthly order by report_month desc;";
	$result=mysql_query($query);
	return $result;
}

function rd4($rdate)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$qry1="SELECT * FROM $bankapi_child_report.sonar_victory_daily WHERE report_date='$rdate';";
	$res1=mysql_query($qry1);
	$num_rows1 = mysql_num_rows($res1);
	if($num_rows1==0)
	{
		$qry2="INSERT INTO $bankapi_child_report.sonar_victory_daily(report_date) VALUES ('$rdate');";
		mysql_query($qry2);
	}
	$a1=$a2=$a3=$a4=$a5=$a6=$a7=$a8=$a9=$a10=$a11=$a12=$a13=$a14=$a15=$a16=$a17=$a18=$a19=$a20=$a21=$a22=0;
	
	//mt unit and amount//av unit and amount
	$qry_check="SELECT sum(amount) mt_amount, count(*) mt_unit FROM $bankapi_child_txn.com_generated where date(date_time)='$rdate' and source in(1,3);";
	$res_check=mysql_query($qry_check);
	while($rs_check=mysql_fetch_array($res_check))
	{
		$a1=$rs_check['mt_amount'];
		$a2=$rs_check['mt_unit'];
	}
	if($a1=="")
		$a1=0;
	if($a2=="")
		$a2=0;
	$qry_update="update $bankapi_child_report.sonar_victory_daily set mt_amount='$a1', mt_unit='$a2' where report_date='$rdate';";
	mysql_query($qry_update);
	
	//rc unit and amount
	/*
	$qry_check="SELECT sum(amount) rc_amount, count(*) rc_unit FROM $bankapi_child_txn.com_generated where date(date_time)='$rdate' and source in(2,4);";
	$res_check=mysql_query($qry_check);
	while($rs_check=mysql_fetch_array($res_check))
	{
		$a3=$rs_check['rc_amount'];
		$a4=$rs_check['rc_unit'];
	}
	*/
	$qry_check2="SELECT * FROM $bankapi_child_report.sonar_rc_daily where report_date='$rdate';";
	$res_check2=mysql_query($qry_check2);
	while($rs_check2=mysql_fetch_array($res_check2))
	{
		$a3=$rs_check2['recharge_amount'];
		$a4=$rs_check2['recharge_unit'];
		$a3b=$rs_check2['recharge_deducted'];
	}
	if($a3=="")
		$a3=0;
	if($a3b=="")
		$a3b=0;
	if($a4=="")
		$a4=0;
	$a3b=$a3-$a3b;
	$qry_update="update $bankapi_child_report.sonar_victory_daily set rc_amount='$a3', rc_unit='$a4', rc_deducted='$a3b' where report_date='$rdate';";
	mysql_query($qry_update);
		
	//avfee
	$qry_check="SELECT count(*) av_unit FROM $bankapi_child_txn.txn_mt_child where date(created_on)='$rdate' and order_status=2 and type=2;";
	$res_check=mysql_query($qry_check);
	while($rs_check=mysql_fetch_array($res_check))
	{
		$val_17=$rs_check['av_unit'];
	}
	if($val_17=="")
		$val_17=0;
	$val_17=$val_17*3;
	$qry_update="update $bankapi_child_report.sonar_victory_daily set avfee='$val_17' where report_date='$rdate';";
	mysql_query($qry_update);
	
	//swfee
	$qry_check="SELECT sum(amount_cr-amount_dr) swfee FROM $bankapi_child_wallet.distribution where ((user_id=100005 and transaction_type in(16,18)) or (user_id=90002 and transaction_type in(8))) and wallet_date='$rdate';";
	$res_check=mysql_query($qry_check);
	while($rs_check=mysql_fetch_array($res_check))
	{
		$val_18=$rs_check['swfee'];
	}
	if($val_18=="")
		$val_18=0;
	$qry_update="update $bankapi_child_report.sonar_victory_daily set swfee='$val_18' where report_date='$rdate';";
	mysql_query($qry_update);
	
	//scfee
	$qry_check="SELECT sum(amount_cr) scfee FROM $bankapi_child_wallet.distribution where ((user_id=100005 and transaction_type in(16,18)) or (user_id=90001 and transaction_type in(8))) and wallet_date='$rdate';";
	$res_check=mysql_query($qry_check);
	while($rs_check=mysql_fetch_array($res_check))
	{
		$val_19=$rs_check['scfee'];
	}
	if($val_19=="")
		$val_19=0;
	$qry_update="update $bankapi_child_report.sonar_victory_daily set scfee='$val_19' where report_date='$rdate';";
	mysql_query($qry_update);
	
	//fee_admin/gst_admin/fee_taken/gst_taken/fee_retailer/gst_retailer
	$qry_check="SELECT sum(admin_fee) fee_admin, sum(admin_gst) gst_admin, sum(charged) fee_taken, sum(retailer_gst) gst_taken, sum(charged) fee_retailer, sum(retailer_gst) gst_retailer FROM $bankapi_child_txn.com_generated where date(date_time)='$rdate' and source in(1,3);";
	$res_check=mysql_query($qry_check);
	while($rs_check=mysql_fetch_array($res_check))
	{
		$a5=$rs_check['fee_admin'];
		$a6=$rs_check['gst_admin'];
		$a7=$rs_check['fee_taken'];
		$a8=$rs_check['gst_taken'];
		$a9=$rs_check['fee_retailer'];
		$a10=$rs_check['gst_retailer'];
		//$val_17=($val_17)*2/3;
		//$a5=$a5-$val_17;
		$a8=($a7*18/118)-$a6;
	}
	
	//com_r/tds_r/earn_r/com_t/tds_t/earn_t
	$qry_check="SELECT sum(lvl_12_com) com_r, sum(lvl_12_tds) tds_r, sum(lvl_12_earn) earn_r, sum(lvl_3_com + lvl_4_com + lvl_5_com + lvl_6_com + lvl_7_com + lvl_8_com + lvl_9_com + lvl_10_com + lvl_11_com) com_t, sum(lvl_3_tds + lvl_4_tds + lvl_5_tds + lvl_6_tds + lvl_7_tds + lvl_8_tds + lvl_9_tds + lvl_10_tds + lvl_11_tds) tds_t, sum(lvl_3_earn + lvl_4_earn + lvl_5_earn + lvl_6_earn + lvl_7_earn + lvl_8_earn + lvl_9_earn + lvl_10_earn + lvl_11_earn) earn_t FROM $bankapi_child_txn.com_generated where date(date_time)='$rdate';";
	$res_check=mysql_query($qry_check);
	while($rs_check=mysql_fetch_array($res_check))
	{
		$a11=$rs_check['com_r'];
		$a12=$a11*.05;
		$a13=$a11*.95;
		$a14=$rs_check['com_t'];
		$a15=$a14*.05;
		$a16=$a14*.95;
	}
	if($a5=="")
		$a5=0;
	if($a6=="")
		$a6=0;
	if($a7=="")
		$a7=0;
	if($a8=="")
		$a8=0;
	if($a9=="")
		$a9=0;
	if($a10=="")
		$a10=0;
	if($a11=="")
		$a11=0;
	if($a12=="")
		$a12=0;
	if($a13=="")
		$a13=0;
	if($a14=="")
		$a14=0;
	if($a15=="")
		$a15=0;
	if($a16=="")
		$a16=0;
	$qry_update="update $bankapi_child_report.sonar_victory_daily set fee_admin='$a5', gst_admin='$a6', fee_taken='$a7', gst_taken='$a8', fee_retailer='$a9', gst_retailer='$a10', com_r='$a11', tds_r='$a12', earn_r='$a13', com_t='$a14', tds_t='$a15', earn_t='$a16' where report_date='$rdate';";
	mysql_query($qry_update);
}

function rm4($rdate)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	
	mysql_query("delete from $bankapi_child_report.sonar_victory_monthly where report_month='$rdate'");
	$query="insert into $bankapi_child_report.sonar_victory_monthly SELECT NULL, '$rdate', sum(mt_unit), sum(mt_amount), sum(rc_unit), sum(rc_amount), sum(rc_deducted), sum(fee_admin), sum(gst_admin), sum(fee_taken), sum(gst_taken), sum(fee_retailer), sum(gst_retailer), sum(com_r), sum(tds_r), sum(earn_r), sum(com_t), sum(tds_t), sum(earn_t), sum(avfee), sum(swfee), sum(scfee) FROM $bankapi_child_report.sonar_victory_daily WHERE report_date like '$rdate%';";
	mysql_query($query);
}

function rd4_count()
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_report.sonar_victory_daily;";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	return $total_records;
}

function rd4_show()
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_report.sonar_victory_daily order by report_date desc;";
	$result=mysql_query($query);
	return $result;
}

function md4_count()
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_report.sonar_victory_monthly;";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	return $total_records;
}

function md4_show()
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_report.sonar_victory_monthly order by report_month desc;";
	$result=mysql_query($query);
	return $result;
}
?>