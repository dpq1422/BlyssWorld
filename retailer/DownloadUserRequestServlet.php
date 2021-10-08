<?php
	include_once('../zc-session-admin.php');
	include_once('../zc-common-admin.php');
	include_once('../zf-WalletRequestReceived.php');
	include_once('../zf-User.php');
	include_once('../zf-Bank.php');

	$s1=$s2=$s3=$s4="";
	$cond=" where 1=1 and user_id='$logged_user_id' ";
	if(isset($_REQUEST['search']))
	{
		if(isset($_REQUEST['s1'])) $s1=mysql_real_escape_string($_REQUEST['s1']);
		if(isset($_REQUEST['s2'])) $s2=mysql_real_escape_string($_REQUEST['s2']);
		if(isset($_REQUEST['s3'])) $s3=mysql_real_escape_string($_REQUEST['s3']);
		if(isset($_REQUEST['s4'])) $s4=mysql_real_escape_string($_REQUEST['s4']);
		if($s1!=""){$cond.=" and user_id='$s1' ";}
		$total_records=show_requests_count($cond);
		$user_result=show_requests_data($cond, $start_from, $num_rec_per_page);
	}
	//if($s1!="")
	{
		$file="Wallet-Request-".time().".csv";
		
		$i=0;
		$csv_header = '"Request Id","Request Date","Deposit Date","Bank Name","Payment Method","Ref.No.","Amount","Status","User Remarks"';
		$csv_header .= "\n";
		$csv_row ='';
		
		while($user_row=mysql_fetch_array($user_result))
		{
			$i++;	
									$request_status=$user_row['request_status'];
									if($request_status==1)
									{
										$request_status="Sent";
									}
									else if($request_status==2)
									{
										$request_status="Transferred";
									}
									else if($request_status==3)
									{
										$request_status="Rejected";
									}	
									else if($request_status==4)
									{
										$request_status="Cancelled";
									}	
									
									$payment_mode=$user_row['payment_mode'];
									if($payment_mode==1)
									{
										$payment_mode="DD";
									}
									else if($payment_mode==2)
									{
										$payment_mode="Cheque";
									}
									else if($payment_mode==3)
									{
										$payment_mode="NEFT/RTGS";
									}
									else if($payment_mode==4)
									{
										$payment_mode="IMPS";
									}
									else if($payment_mode==5)
									{
										$payment_mode="Cash";
									}
									else if($payment_mode==6)
									{
										$payment_mode="CDM";
									}
			
			$csv_row .= '"'.$user_row['request_id'].'","'.$user_row['request_date'].'","'.$user_row['deposite_date'].'","'.show_bank_name($user_row['bank_id']).'","'.$payment_mode.'","'.$user_row['ref_no'].'","'.$user_row['deposit_amount'].'","'.$request_status.'","'.$user_row['client_remarks'].'"';
			$csv_row .= "\n";
		}
		/* Download as CSV File */
		header("Content-type: application/csv");
		header("Content-Disposition: attachment; filename=$file");
		echo $csv_header . $csv_row;
	}
	exit;
?>