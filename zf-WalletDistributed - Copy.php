<?php
function show_distributed_count($cond)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_wallet.distribution $cond and date(wallet_date)>='$wdates' ";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	return $total_records;
}
function show_distributed_data($cond, $start_from=0, $num_rec_per_page=0)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$start_from=mysql_real_escape_string($start_from);
	$num_rec_per_page=mysql_real_escape_string($num_rec_per_page);
	if($start_from==0 && $num_rec_per_page==0)
	$query="select * from $bankapi_child_wallet.distribution $cond and date(wallet_date)>='$wdates' order by wallet_date desc,wallet_time desc,wallet_id desc ";
	else
	$query="select * from $bankapi_child_wallet.distribution $cond and date(wallet_date)>='$wdates' order by wallet_date desc,wallet_time desc,wallet_id desc LIMIT $start_from, $num_rec_per_page ";
	$result=mysql_query($query);
	return $result;
}
function update_user_balance_check($user)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	
	$oldbal=0;
	$cr=0;
	$dr=0;
	$newbal=0;
	$walletid=0;
	
	$query="select * from $bankapi_child_wallet.distribution where user_id='$user' order by wallet_id; ";
	$result=mysql_query($query);
	while($row=mysql_fetch_array($result))
	{
		$oldbal=$newbal;
		$walletid=$row['wallet_id'];
		$cr=$row['amount_cr'];
		$dr=$row['amount_dr'];
		$newbal=$oldbal+$cr-$dr;
		$qr="update $bankapi_child_wallet.distribution set amount_pre='$oldbal', amount_bal='$newbal' where wallet_id='$walletid' and user_id='$user';";
		mysql_query($qr);
	}
	update_user_balance($user);
}
function update_user_balance_check2($user)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	
	$oldbal=0;
	$cr=0;
	$dr=0;
	$newbal=0;
	$walletid=0;
	
	$query="select * from $bankapi_child_wallet.distribution where user_id='$user' order by wallet_date,wallet_time,wallet_id; ";
	$result=mysql_query($query);
	while($row=mysql_fetch_array($result))
	{
		$oldbal=$newbal;
		$walletid=$row['wallet_id'];
		$cr=$row['amount_cr'];
		$dr=$row['amount_dr'];
		$newbal=$oldbal+$cr-$dr;
		$qr="update $bankapi_child_wallet.distribution set amount_pre='$oldbal', amount_bal='$newbal' where wallet_id='$walletid' and user_id='$user';";
		mysql_query($qr);
	}
	update_user_balance($user);
}
function show_distributed_balance()
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_wallet.distribution where user_id=$main_admin order by wallet_id desc limit 0,1 ";
	$result=mysql_query($query);
	$bal=0;
	while($row=mysql_fetch_array($result))
	{
		$bal=$row['amount_bal'];
	}
	return $bal;
}
function show_user_balance($user)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	
	$query="select * from $bankapi_child_wallet.distribution where user_id='$user' order by wallet_date desc, wallet_time desc, wallet_id desc limit 0,1 ";
	$result=mysql_query($query);
	$bal=0;
	while($row=mysql_fetch_array($result))
	{
		$bal=$row['amount_bal'];
	}
	return $bal;
}
function show_user_balance_check($user)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	
	$query="select sum(amount_cr-amount_dr) newbal from $bankapi_child_wallet.distribution where user_id='$user'; ";
	$result=mysql_query($query);
	$bal=0;
	while($row=mysql_fetch_array($result))
	{
		$bal=$row['newbal'];
	}
	return $bal;
}
function show_dummy_balance()
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	
	$query="select * from $bankapi_parent_base.parent_client where client_id='$clientdbid';";
	$result=mysql_query($query);
	$bal=0;
	while($row=mysql_fetch_array($result))
	{
		$bal=$row['dummy_balance'];
	}
	return $bal;
}
function update_user_balance($user)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$bal=show_user_balance($user);
	$query="update $bankapi_child_base.child_userinfo_walletkyc set wallet_balance='$bal' where user_id='$user'";
	mysql_query($query);
}
function show_rt()
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_wallet.realtime order by wallet_id desc limit 0,1 ";
	$result=mysql_query($query);
	$bal=0;
	while($row=mysql_fetch_array($result))
	{
		$bal=$row['amount_bal'];
	}
	return $bal;
}

function is_processed($user,$request)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$pro=0;
	$query="select * from $bankapi_child_wallet.distribution where user_id='$user' and request_id='$request' ";
	$result=mysql_query($query);
	while($row=mysql_fetch_array($result))
	{
		$pro++;
	}
	return $pro;
}

function transfer_admin_to_user($user, $amount, $remarks, $remarks_admin, $request=0, $bnk=0, $pm=0)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	
	$pre=show_user_balance("$main_admin");
	$pro=is_processed($user,$request);
	if($pre>=$amount && $pro==0)
	{
		$post=$pre-$amount;
		$type=2;
		if($request==0)
			$type=2;
		else
			$type=3;
		//transaction_type//1=received//2=manual transfer//3=request transfer//4=team transfer//5=manual withdraw
		$query="INSERT INTO $bankapi_child_wallet.distribution(`wallet_date`, `wallet_time`, `user_id`, `user_id2`, `request_id`, `service_id`, `order_id`, `tid`, `transaction_type`, `transaction_description`, `amount_pre`, `amount_cr`, `amount_dr`, `amount_bal`, `remarks`) VALUES ('$datetime_date', '$datetime_time', '$main_admin', '$user', '$request', 0, 0, 0, '$type', '$remarks', '$pre', '0', '$amount', '$post', '$remarks_admin')";
		mysql_query($query);
		update_user_balance("$main_admin");
		
		$pre2=show_user_balance($user);
		$post2=$pre2+$amount;
		$query2="INSERT INTO $bankapi_child_wallet.distribution(`wallet_date`, `wallet_time`, `user_id`, `user_id2`, `request_id`, `service_id`, `order_id`, `tid`, `transaction_type`, `transaction_description`, `amount_pre`, `amount_cr`, `amount_dr`, `amount_bal`, `remarks`) VALUES ('$datetime_date', '$datetime_time', '$user', '$main_admin', '$request', 0, 0, 0, 1, '$remarks', '$pre2', '$amount', '0', '$post2', '$remarks_admin')";
		mysql_query($query2);
		update_user_balance($user);
		
		if($request!=0 && $bnk!=0 && $pm!=0)
		{
			if($bnk==1 && $pm==6)
			{
				$charges=25;
				$pre3=show_user_balance($user);
				$post3=$pre3-$charges;
				$query="INSERT INTO $bankapi_child_wallet.distribution(`wallet_date`, `wallet_time`, `user_id`, `user_id2`, `request_id`, `service_id`, `order_id`, `tid`, `transaction_type`, `transaction_description`, `amount_pre`, `amount_cr`, `amount_dr`, `amount_bal`, `remarks`) VALUES ('$datetime_date', '$datetime_time', '$user', '$main_admin', 0, 0, 0, 0, 12, 'SBI CDM deposit charges against request id $request', '$pre3', '0', '$charges', '$post3', 'SBI CDM deposit charges against request id $request')";
				mysql_query($query);
				update_user_balance($user);
				
				$pre4=show_user_balance("$main_admin");
				$post4=$pre4+$charges;
				
				$query2="INSERT INTO $bankapi_child_wallet.distribution(`wallet_date`, `wallet_time`, `user_id`, `user_id2`, `request_id`, `service_id`, `order_id`, `tid`, `transaction_type`, `transaction_description`, `amount_pre`, `amount_cr`, `amount_dr`, `amount_bal`, `remarks`) VALUES ('$datetime_date', '$datetime_time', '$main_admin', '$user', 0, 0, 0, 0, 13, 'SBI CDM deposit charges against request id $request', '$pre4', '$charges', '0', '$post4', 'SBI CDM deposit charges against request id $request')";
				mysql_query($query2);
				update_user_balance("$main_admin");
			}
			if($bnk==1 && $pm==5)
			{
				$charges=0;
				$sbi1=118;
				$sbi2=0;
				$sbi2=($amount*.89);
				$sbi2=$sbi2/1000;
				$sbi2=$sbi2+59;

					if($sbi1>$sbi2)
						$charges=$sbi1;
					else
						$charges=$sbi2;
					
				//remove this line later
				$charges=59;
				$pre3=show_user_balance($user);
				$post3=$pre3-$charges;
				
				$query="INSERT INTO $bankapi_child_wallet.distribution(`wallet_date`, `wallet_time`, `user_id`, `user_id2`, `request_id`, `service_id`, `order_id`, `tid`, `transaction_type`, `transaction_description`, `amount_pre`, `amount_cr`, `amount_dr`, `amount_bal`, `remarks`) VALUES ('$datetime_date', '$datetime_time', '$user', '$main_admin', 0, 0, 0, 0, 12, 'SBI Cash deposit charges against request id $request', '$pre3', '0', '$charges', '$post3', 'SBI Cash deposit charges against request id $request')";
				mysql_query($query);
				update_user_balance($user);
				
				$pre4=show_user_balance("$main_admin");
				$post4=$pre4+$charges;
				
				$query2="INSERT INTO $bankapi_child_wallet.distribution(`wallet_date`, `wallet_time`, `user_id`, `user_id2`, `request_id`, `service_id`, `order_id`, `tid`, `transaction_type`, `transaction_description`, `amount_pre`, `amount_cr`, `amount_dr`, `amount_bal`, `remarks`) VALUES ('$datetime_date', '$datetime_time', '$main_admin', '$user', 0, 0, 0, 0, 13, 'SBI Cash deposit charges against request id $request', '$pre4', '$charges', '0', '$post4', 'SBI Cash deposit charges against request id $request')";
				mysql_query($query2);
				update_user_balance("$main_admin");
			}
		}
	}
	withdraw_security_amount($user);
	withdraw_software_amount($user);
	withdraw_lean_amount($user);
}


function transfer_admin_to_user_rejected($user, $amount, $remarks, $remarks_admin, $request=0, $bnk=0, $pm=0)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	
	$type=2;
	if($request==0)
		$type=2;
	else
		$type=3;
	
	$pre=show_user_balance($user);
	$post=$pre-$amount;
	$query="INSERT INTO $bankapi_child_wallet.distribution(`wallet_date`, `wallet_time`, `user_id`, `user_id2`, `request_id`, `service_id`, `order_id`, `tid`, `transaction_type`, `transaction_description`, `amount_pre`, `amount_cr`, `amount_dr`, `amount_bal`, `remarks`) VALUES ('$datetime_date', '$datetime_time', '$user', '$main_admin', 0, 0, 0, 0, 12, 'Wrong wallet request rejection charges against request id $request $remarks', '$pre', '0', '$amount', '$post', 'Wrong wallet request rejection charges against request id $request $remarks_admin')";
	mysql_query($query);
	update_user_balance($user);
	
	$pre2=show_user_balance("$main_admin");
	$post2=$pre2+$amount;
	
	$query2="INSERT INTO $bankapi_child_wallet.distribution(`wallet_date`, `wallet_time`, `user_id`, `user_id2`, `request_id`, `service_id`, `order_id`, `tid`, `transaction_type`, `transaction_description`, `amount_pre`, `amount_cr`, `amount_dr`, `amount_bal`, `remarks`) VALUES ('$datetime_date', '$datetime_time', '$main_admin', '$user', 0, 0, 0, 0, 13, 'Wrong wallet request rejection charges against request id $request', '$pre2', '$amount', '0', '$post2', 'Wrong wallet request rejection charges against request id $request')";
	mysql_query($query2);
	update_user_balance("$main_admin");
}

function transfer_user_to_admin($user, $amount, $remarks, $remarks_admin)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	
	$pre=show_user_balance($user);
	if($pre>=$amount || $pre<$amount)
	{
		$post=$pre-$amount;
		//transaction_type//1=received//2=manual transfer//3=request transfer//4=team transfer//5=manual withdraw
		$query="INSERT INTO $bankapi_child_wallet.distribution(`wallet_date`, `wallet_time`, `user_id`, `user_id2`, `request_id`, `service_id`, `order_id`, `tid`, `transaction_type`, `transaction_description`, `amount_pre`, `amount_cr`, `amount_dr`, `amount_bal`, `remarks`) VALUES ('$datetime_date', '$datetime_time', '$user', '$main_admin', 0, 0, 0, 0, 5, '$remarks', '$pre', '0', '$amount', '$post', '$remarks_admin')";
		mysql_query($query);
		update_user_balance($user);
		
		$pre2=show_user_balance("$main_admin");
		$post2=$pre2+$amount;
		$query2="INSERT INTO $bankapi_child_wallet.distribution(`wallet_date`, `wallet_time`, `user_id`, `user_id2`, `request_id`, `service_id`, `order_id`, `tid`, `transaction_type`, `transaction_description`, `amount_pre`, `amount_cr`, `amount_dr`, `amount_bal`, `remarks`) VALUES ('$datetime_date', '$datetime_time', '$main_admin', '$user', 0, 0, 0, 0, 5, '$remarks', '$pre2', '$amount', '0', '$post2', '$remarks_admin')";
		mysql_query($query2);
		update_user_balance("$main_admin");
	}
}


function transfer_user_to_user($user_from, $user_to, $amount, $remarks, $remarks_admin)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	
	$pre=show_user_balance($user_from);
	if($pre>=$amount)
	{
		$post=$pre-$amount;
		//transaction_type//1=received//2=manual transfer//3=request transfer//4=team transfer//5=manual withdraw
		$query="INSERT INTO $bankapi_child_wallet.distribution(`wallet_date`, `wallet_time`, `user_id`, `user_id2`, `request_id`, `service_id`, `order_id`, `tid`, `transaction_type`, `transaction_description`, `amount_pre`, `amount_cr`, `amount_dr`, `amount_bal`, `remarks`) VALUES ('$datetime_date', '$datetime_time', '$user_from', '$user_to', 0, 0, 0, 0, 4, '$remarks', '$pre', '0', '$amount', '$post', '$remarks_admin')";
		mysql_query($query);
		update_user_balance($user_from);
		
		$pre2=show_user_balance($user_to);
		$post2=$pre2+$amount;
		$query2="INSERT INTO $bankapi_child_wallet.distribution(`wallet_date`, `wallet_time`, `user_id`, `user_id2`, `request_id`, `service_id`, `order_id`, `tid`, `transaction_type`, `transaction_description`, `amount_pre`, `amount_cr`, `amount_dr`, `amount_bal`, `remarks`) VALUES ('$datetime_date', '$datetime_time', '$user_to', '$user_from', 0, 0, 0, 0, 1, '$remarks', '$pre2', '$amount', '0', '$post2', '$remarks_admin')";
		mysql_query($query2);
		update_user_balance($user_to);
	}
	withdraw_security_amount($user_to);
	withdraw_software_amount($user_to);
	withdraw_lean_amount($user_to);
}

function transfer_user_to_user_paid($user_from, $user_to, $amount, $remarks)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	
	if($user_from!=$wallet_gsttopay && $user_from!=$wallet_tdstopay)
	{
		$remarks2=$remarks." PAID TO $user_to ";
		$pre=show_user_balance($user_from);
		$post=$pre-$amount;
		//transaction_type//1=received//2=manual transfer//3=request transfer//4=team transfer//5=manual withdraw
		$query="INSERT INTO $bankapi_child_wallet.distribution(`wallet_date`, `wallet_time`, `user_id`, `user_id2`, `request_id`, `service_id`, `order_id`, `tid`, `transaction_type`, `transaction_description`, `amount_pre`, `amount_cr`, `amount_dr`, `amount_bal`, `remarks`) VALUES ('$datetime_date', '$datetime_time', '$user_from', '$user_to', 0, 0, 0, 0, 9, '$remarks2', '$pre', '0', '$amount', '$post', '$remarks2')";
		mysql_query($query);
		update_user_balance($user_from);
	}
	
	$remarks3=$remarks." PAID CLEARANCE FOR $user_to ";
	$user_to=$main_admin;
	$pre2=show_user_balance($user_to);
	$post2=$pre2+$amount;
	$query2="INSERT INTO $bankapi_child_wallet.distribution(`wallet_date`, `wallet_time`, `user_id`, `user_id2`, `request_id`, `service_id`, `order_id`, `tid`, `transaction_type`, `transaction_description`, `amount_pre`, `amount_cr`, `amount_dr`, `amount_bal`, `remarks`) VALUES ('$datetime_date', '$datetime_time', '$user_to', '$user_from', 0, 0, 0, 0, 21, '$remarks3', '$pre2', '$amount', '0', '$post2', '$remarks3')";
	mysql_query($query2);
	update_user_balance($user_to);
	
	withdraw_security_amount($user_to);
	withdraw_software_amount($user_to);
	withdraw_lean_amount($user_to);
}
/*
$wallet_security=90001;//in by every dr from user//no dr
$wallet_software=90002;//in by every dr from user//admin/(team+tds)
$wallet_transact=90003;//in by every com_charged dr from user//gst/admin/(team+tds)
$wallet_bankfees=90004;//in by every request from user//dr by entry matched and cr in admin wallet
$wallet_suspense=90005;//in by manual for suspense entry
$wallet_admininc=90006;//in after txn success/in after software fee//dr by exp and cr in admin wallet
$wallet_teamcomm=90007;//in after txn success/in after software fee//dr by comm paid and cr in admin wallet
$wallet_gsttopay=90008;//in after txn success//dr by gst paid and cr in admin wallet
$wallet_tdstopay=90009;//in after txn success/in after software fee//dr by tds paid and cr in admin wallet
$wallet_leanamnt=90010;//in by admin for user/in after full dr from user//cr in admin wallet
*/
function withdraw_security_amount($user)
{
/*
$wallet_security;
dr from member
cr to security fee
partial receveied 10k + 5k as wallet updated
*/
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$vals=show_security_data($user);
	$pre=show_user_balance($user);
	$amount_to_deduct=$vals[0]-$vals[1];
	if($amount_to_deduct>0 && $pre>0)
	{
		$amount_deducted=$amount_to_deduct;
		if($pre<$amount_to_deduct)
			$amount_deducted=$pre;
		
		$remarks="SECURITY AMOUNT";
		
		$pre=show_user_balance($user);
		$post=$pre-$amount_deducted;
		$query="INSERT INTO $bankapi_child_wallet.distribution(`wallet_date`, `wallet_time`, `user_id`, `user_id2`, `request_id`, `service_id`, `order_id`, `tid`, `transaction_type`, `transaction_description`, `amount_pre`, `amount_cr`, `amount_dr`, `amount_bal`, `remarks`) VALUES ('$datetime_date', '$datetime_time', '$user', '$wallet_security', 0, 0, 0, 0, 17, '$remarks', '$pre', '0', '$amount_deducted', '$post', '$remarks');";
		mysql_query($query);
		update_user_balance($user);
		
		$pre2=show_user_balance($wallet_security);
		$post2=$pre2+$amount_deducted;
		$query2="INSERT INTO $bankapi_child_wallet.distribution(`wallet_date`, `wallet_time`, `user_id`, `user_id2`, `request_id`, `service_id`, `order_id`, `tid`, `transaction_type`, `transaction_description`, `amount_pre`, `amount_cr`, `amount_dr`, `amount_bal`, `remarks`) VALUES ('$datetime_date', '$datetime_time', '$wallet_security', '$user', 0, 0, 0, 0, 17, '$remarks', '$pre2', '$amount_deducted', '0', '$post2', '$remarks');";
		mysql_query($query2);
		update_user_balance($wallet_security);
		
		$query3="update $bankapi_child_base.child_userinfo_walletkyc set sec_rec=(sec_rec+$amount_deducted) where user_id='$user';";
		mysql_query($query3);
	}
}

function show_security_data($user)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$amt='0';
	$rec='0';
	$query="select * from $bankapi_child_base.child_userinfo_walletkyc where user_id='$user';";
	$result=mysql_query($query);
	while($rs=mysql_fetch_array($result))
	{
		$amt=$rs['sec_amt'];
		$rec=$rs['sec_rec'];
	}
	return array($amt,$rec);
}

function withdraw_software_amount($user)
{
/*
$wallet_software;$source=0;
member created by MD at 15000
dr from member
cr to software fee
partial receveied 10k + 5k as wallet updated
now when all received 100% then distribution applied
dr from software fee and cr to admin 20% on behalf of admin earning in com_paid with source=0
dr from software fee and cr to tds 5% of 80% on behalf of MD id in com_paid with source=0
dr from software fee and cr to comm 95% of 80% on behalf of MD id in com_paid with source=0
*/
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$vals=show_software_data($user);
	$pre=show_user_balance($user);
	$amount_to_deduct=$vals[0]-$vals[1];
	if($amount_to_deduct>0 && $pre>0)
	{
		$amount_deducted=$amount_to_deduct;
		if($pre<$amount_to_deduct)
			$amount_deducted=$pre;
		
		$remarks="ACTIVATION CHARGES";
		
		$pre=show_user_balance($user);
		$post=$pre-$amount_deducted;
		$query="INSERT INTO $bankapi_child_wallet.distribution(`wallet_date`, `wallet_time`, `user_id`, `user_id2`, `request_id`, `service_id`, `order_id`, `tid`, `transaction_type`, `transaction_description`, `amount_pre`, `amount_cr`, `amount_dr`, `amount_bal`, `remarks`) VALUES ('$datetime_date', '$datetime_time', '$user', '$wallet_software', 0, 0, 0, 0, 16, '$remarks', '$pre', '0', '$amount_deducted', '$post', '$remarks');";
		mysql_query($query);
		update_user_balance($user);
		
		$pre2=show_user_balance($wallet_software);
		$post2=$pre2+$amount_deducted;
		$query2="INSERT INTO $bankapi_child_wallet.distribution(`wallet_date`, `wallet_time`, `user_id`, `user_id2`, `request_id`, `service_id`, `order_id`, `tid`, `transaction_type`, `transaction_description`, `amount_pre`, `amount_cr`, `amount_dr`, `amount_bal`, `remarks`) VALUES ('$datetime_date', '$datetime_time', '$wallet_software', '$user', 0, 0, 0, 0, 16, '$remarks', '$pre2', '$amount_deducted', '0', '$post2', '$remarks');";
		mysql_query($query2);
		update_user_balance($wallet_software);
		
		$query3="update $bankapi_child_base.child_userinfo_walletkyc set reg_rec=(reg_rec+$amount_deducted) where user_id='$user';";
		mysql_query($query3);
		
		$vals2=show_software_data($user);
		$amount_to_deduct2=$vals2[0]-$vals2[1];
		if($amount_to_deduct2==0)
		{
			
		}
	}
}

function show_software_data($user)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$amt='0';
	$rec='0';
	$query="select * from $bankapi_child_base.child_userinfo_walletkyc where user_id='$user';";
	$result=mysql_query($query);
	while($rs=mysql_fetch_array($result))
	{
		$amt=$rs['reg_amt'];
		$rec=$rs['reg_rec'];
	}
	return array($amt,$rec);
}

function withdraw_lean_amount($user)
{
/*
$wallet_leanamnt;$source=0;
if lean is equal or more than updated wallet balance of user then only 
dr from member
cr to lean wallet
*/
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$vals=show_lean_data($user);
	$pre=show_user_balance($user);
	$lamt=$vals[0];
	$lrem=$vals[1];
	if($lamt>0 && $pre>=$lamt)
	{
		$pre=show_user_balance($user);
		$post=$pre-$lamt;
		$query="INSERT INTO $bankapi_child_wallet.distribution(`wallet_date`, `wallet_time`, `user_id`, `user_id2`, `request_id`, `service_id`, `order_id`, `tid`, `transaction_type`, `transaction_description`, `amount_pre`, `amount_cr`, `amount_dr`, `amount_bal`, `remarks`) VALUES ('$datetime_date', '$datetime_time', '$user', '$wallet_leanamnt', 0, 0, 0, 0, 5, '$lrem', '$pre', '0', '$lamt', '$post', '$lrem');";
		mysql_query($query);
		update_user_balance($user);
		
		$pre2=show_user_balance($wallet_leanamnt);
		$post2=$pre2+$lamt;
		$query2="INSERT INTO $bankapi_child_wallet.distribution(`wallet_date`, `wallet_time`, `user_id`, `user_id2`, `request_id`, `service_id`, `order_id`, `tid`, `transaction_type`, `transaction_description`, `amount_pre`, `amount_cr`, `amount_dr`, `amount_bal`, `remarks`) VALUES ('$datetime_date', '$datetime_time', '$wallet_leanamnt', '$user', 0, 0, 0, 0, 5, '$lrem', '$pre2', '$lamt', '0', '$post2', '$lrem');";
		mysql_query($query2);
		update_user_balance($wallet_leanamnt);
		
		$query="update $bankapi_child_base.child_userinfo_walletkyc set lean_amount=0, lean_remarks='' where user_id='$user';";
		mysql_query($query);
	}
}

function show_lean_data($user)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$lamt='0';
	$lrem='';
	$query="select * from $bankapi_child_base.child_userinfo_walletkyc where user_id='$user';";
	$result=mysql_query($query);
	while($rs=mysql_fetch_array($result))
	{
		$lamt=$rs['lean_amount'];
		$lrem=$rs['lean_remarks'];
	}
	return array($lamt,$lrem);
}

function update_user_lean($uid,$amount,$remarks)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="update $bankapi_child_base.child_userinfo_walletkyc set lean_amount=(lean_amount+$amount), lean_remarks='$remarks' where user_id='$uid';";
	mysql_query($query);
	$result=mysql_affected_rows();
	
	$pre2=show_user_balance($wallet_leanamnt);
	$post2=$pre2-$amount;
	$query2="INSERT INTO $bankapi_child_wallet.distribution(`wallet_date`, `wallet_time`, `user_id`, `user_id2`, `request_id`, `service_id`, `order_id`, `tid`, `transaction_type`, `transaction_description`, `amount_pre`, `amount_cr`, `amount_dr`, `amount_bal`, `remarks`) VALUES ('$datetime_date', '$datetime_time', '$wallet_leanamnt', '$uid', 0, 0, 0, 0, 5, '$remarks', '$pre2', '0', '$amount', '$post2', '$remarks');";
	mysql_query($query2);
	update_user_balance($wallet_leanamnt);
	return $result;
}
?>