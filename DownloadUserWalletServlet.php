<?php
	include_once('zc-common-admin.php');
	include_once('zf-WalletUser.php');
	include_once('zf-User.php');

	$s1=$s2=$s3=$s4=$s5="";
	$cond=" where 1=1 ";
	if(isset($_REQUEST['search']))
	{
		if(isset($_REQUEST['s1'])) $s1=mysql_real_escape_string($_REQUEST['s1']);
		if(isset($_REQUEST['s2'])) $s2=mysql_real_escape_string($_REQUEST['s2']);
		if(isset($_REQUEST['s3'])) $s3=mysql_real_escape_string($_REQUEST['s3']);
		if(isset($_REQUEST['s4'])) $s4=mysql_real_escape_string($_REQUEST['s4']);
		if(isset($_REQUEST['s5'])) $s5=mysql_real_escape_string($_REQUEST['s5']);
		if($s1!=""){$cond.=" and user_id='$s1' ";}
		$total_records=show_wallet_count($cond);
		$user_result=show_wallet_data($cond, $start_from, $num_rec_per_page);
	}
	if($s1!="")
	{
		$file="Wallet-History-".time().".csv";
		
		$i=0;
		$csv_header = '"Wallet Id","Date","Time","Txn Type","Pre Balance","Cr","Dr","Balance","Description"';
		$csv_header .= "\n";
		$csv_row ='';
		
		while($user_row=mysql_fetch_array($user_result))
		{
			$i++;	
			
			$tr_tp=$user_row['transaction_type'];
			if($tr_tp=="0") 
			$tr_tp="Account Opened"; 
			else if($tr_tp=="1") 
			$tr_tp="Wallet Amount Received";
			else if($tr_tp=="2")
			$tr_tp="Wallet Transeferred Manual by Admin"; 
			else if($tr_tp=="3")
			$tr_tp="Wallet Transfer on Request by Admin"; 
			else if($tr_tp=="4")
			$tr_tp="Wallet Transferred"; 
			else if($tr_tp=="5")
			$tr_tp="Wallet Withdraw by Admin";
			else if($tr_tp=="6")
			$tr_tp="Order Generated";
			else if($tr_tp=="7")
			$tr_tp="Failed Order Refunded";
			else if($tr_tp=="8" || $tr_tp=="9")
			$tr_tp="Commission";
			else if($tr_tp=="10" || $tr_tp=="11")
			$tr_tp="Surcharges";
			else if($tr_tp=="12" || $tr_tp=="13")
			$tr_tp="Chargeback";
			else if($tr_tp=="14" || $tr_tp=="15")
			$tr_tp="Other";
			else if($tr_tp=="16")
			$tr_tp="Software Amount";
			else if($tr_tp=="17")
			$tr_tp="Security Amount";
			else if($tr_tp=="18")
			$tr_tp="Created Commission";
		
		$desc=$user_row['transaction_description'];
		$desc=explode(",",$desc)[0];
		$desc=explode(" by ",$desc)[0];
			
			$csv_row .= '"'.$user_row['wallet_id'].'","'.$user_row['wallet_date'].'","'.$user_row['wallet_time'].'","'.$tr_tp.'","'.$user_row['amount_pre'].'","'.$user_row['amount_cr'].'","'.$user_row['amount_dr'].'","'.$user_row['amount_bal'].'","'.$desc.'"';
			$csv_row .= "\n";
		}
		/* Download as CSV File */
		header("Content-type: application/csv");
		header("Content-Disposition: attachment; filename=$file");
		echo $csv_header . $csv_row;
	}
	exit;
?>