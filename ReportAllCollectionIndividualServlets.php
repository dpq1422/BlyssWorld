<?php
	include_once('zc-common-admin.php');
	include_once('zf-User.php');
	include_once('zf-Level.php');
	include_once('zf-UserLevel.php');
	include_once('zf-WalletDistributed.php');
	include_once('zf-UserWalletKyc.php');
	
	if(isset($_SESSION['logged_user_id']))
	{
		$dt1=$dt2=$usid="";
							
		if(isset($_REQUEST['dt1']))
			$dt1=$_REQUEST['dt1'];
		if(isset($_REQUEST['dt2']))
			$dt2=$_REQUEST['dt2'];
		if(isset($_REQUEST['usid']))
			$usid=$_REQUEST['usid'];
		
		$dt1=mysql_real_escape_string($dt1);
		$dt2=mysql_real_escape_string($dt2);
		$usid=mysql_real_escape_string($usid);
		
		$file="download-file.txt";
		$csv_header="INVALID VALUES";
		$csv_row="\r\nPLEASE FILL CORRECT VALUES";
		
		if($dt1!="" && $dt2!="" && $usid!="" && strlen($usid)==6)
		{
		
			$cond=" where 1=1 and user_status in(1,2) and join_date <= '$dt2'";
			$file="progress-report-of-$usid-from-$dt1-to-$dt2.csv";
			
			$i=0;
			$csv_header = '"USER ID","JOINING DATE","DESIGNATION","NAME","CITY","EMAIL","MOBILE","USER STATUS","KYC STATUS","PARENT ID","PARENT NAME","PARENT DESIGNATION","CURRENT WALLET BALANCE","TOTAL TXN","TOTAL AMOUNT","IMPS-1K","IMPS-2K","IMPS-3K","IMPS-4K","IMPS-5K","NEFT-1K","NEFT-2K","NEFT-3K","NEFT-4K","NEFT-5K","MT TXN","MT AMOUNT","AV TXN","AV AMOUNT","PREPAID TXN","PREPAID AMOUNT","DTH TXN","DTH AMOUNT","POSTPAID TXN","POSTPAID AMOUNT","UTILITY TXN","UTILITY AMOUNT"';
			$csv_header .= "\n";
			$csv_row ='';
			$aa=$bb=$cc=0;
			$user_result=show_all_members_data($cond,$usid);
			while($user_row=mysql_fetch_array($user_result))
			{
				$i++;			
				
				$user_type=$user_row['user_type'];
				if($user_type==1)
					$user_type="Admin";
				else if($user_type==2)
					$user_type="Main Distributor";
				else if($user_type==3)
					$user_type="Platinum Distributor";
				else if($user_type==4)
					$user_type="Master Distributor";
				else if($user_type==5)
					$user_type="Distributor";
				else if($user_type==12)
					$user_type="Retailer";
				
				/*
				$user_gender=$user_row['gender'];
				if($user_gender==1)
					$user_gender="Male";
				else if($user_gender==0)
					$user_gender="Female";
				else if($user_gender==-1)
					$user_gender="Trans Gender";
				else
					$user_gender="Not Mentoined";
				*/
				
				$user_status=$user_row['user_status'];
				if($user_status==1)
					$user_status="Active";
				else if($user_status==2)
					$user_status="Blocked";
				else if($user_status==3)
					$user_status="Suspended";
				else if($user_status==4)
					$user_status="Terminated";
				
				$wb=$t1=$t2=$mtrate=$mtrateNEFT=$mtrateIMPS=0;
				$nomt=$noav=$norc=$nodth=$nopp=$noutl=0;
				$nomtamt=$noavamt=$norcamt=$nodthamt=$noppamt=$noutlamt=0;
				$wb=show_user_balance($user_row['user_id']);
				$kyc=0;
				$kyc=show_kyc_info($user_row['user_id']);
				if($kyc==0)
					$kyc="PENDING FROM USER TO UPLOAD";
				else if($kyc==1 || $kyc==2)
					$kyc="UPLOADED BY USER PENDING FOR VERIFICATION";
				else if($kyc==3)
					$kyc="VERIFIED";
				else
					$kyc="KYC DOCUMENTS INCOMPLETE";
				
				$pid=$pnm=$pdes="";
				$tmpuid=$user_row['user_id'];
				$pid=show_parent_id($tmpuid);
				$pnm=show_user_name($pid);
				$pdes=show_level_name(show_user_type($pid));
				
				$nomt=showt1txn($user_row['user_id'],1,$dt1,$dt2);
				$noav=showt1txn($user_row['user_id'],2,$dt1,$dt2);
				$norc=showt2txn($user_row['user_id'],3,$dt1,$dt2);
				$nodth=showt2txn($user_row['user_id'],4,$dt1,$dt2);
				$nopp=showt2txn($user_row['user_id'],5,$dt1,$dt2);
				$noutl=showt2txn($user_row['user_id'],6,$dt1,$dt2);
				
				$nomtamt=showt1amt($user_row['user_id'],1,$dt1,$dt2);
				$noavamt=showt1amt($user_row['user_id'],2,$dt1,$dt2);
				$norcamt=showt2amt($user_row['user_id'],3,$dt1,$dt2);
				$nodthamt=showt2amt($user_row['user_id'],4,$dt1,$dt2);
				$noppamt=showt2amt($user_row['user_id'],5,$dt1,$dt2);
				$noutlamt=showt2amt($user_row['user_id'],6,$dt1,$dt2);
				$t1=$nomt+$noav+$norc+$nodth+$nopp+$noutl;
				$t2=$nomtamt+$noavamt+$norcamt+$nodthamt+$noppamt+$noutlamt;
				
				$mtrateNEFT=explode("/",show_mt_rate_user($tmpuid,1));
				$mtrateIMPS=explode("/",show_mt_rate_user($tmpuid,2));
				
				if($wb==0)
					$wb="";
				if($t1==0)
					$t1="";
				if($t2==0)
					$t2="";
				if($nomt==0)
					$nomt="";
				if($noav==0)
					$noav="";
				if($norc==0)
					$norc="";
				if($nodth==0)
					$nodth="";
				if($nopp==0)
					$nopp="";
				if($noutl==0)
					$noutl="";
				if($nomtamt==0)
					$nomtamt="";
				if($noavamt==0)
					$noavamt="";
				if($norcamt==0)
					$norcamt="";
				if($nodthamt==0)
					$nodthamt="";
				if($noppamt==0)
					$noppamt="";
				if($noutlamt==0)
					$noutlamt="";
				if($mtrate==0)
					$mtrate="";
				if($mtrateNEFT==0)
					$mtrateNEFT="";
				if($mtrateIMPS==0)
					$mtrateIMPS="";
				
				$join_date1 = $user_row['join_date'];
				$join_date2 = date("d-M-Y", strtotime($join_date1));
				
				$csv_row .= '"'.$user_row['user_id'].'","'.$join_date2.'","'.$user_type.'","'.$user_row['user_name'].'","'.$user_row['city_name'].'","'.$user_row['e_mail'].'","'.$user_row['user_contact_no'].'","'.$user_status.'","'.$kyc.'","'.$pid.'","'.$pnm.'","'.$pdes.'","'.$wb.'","'.$t1.'","'.$t2.'","'.$mtrateIMPS[0].'","'.$mtrateIMPS[1].'","'.$mtrateIMPS[2].'","'.$mtrateIMPS[3].'","'.$mtrateIMPS[4].'","'.$mtrateNEFT[0].'","'.$mtrateNEFT[1].'","'.$mtrateNEFT[2].'","'.$mtrateNEFT[3].'","'.$mtrateNEFT[4].'","'.$nomt.'","'.$nomtamt.'","'.$noav.'","'.$noavamt.'","'.$norc.'","'.$norcamt.'","'.$nodth.'","'.$nodthamt.'","'.$nopp.'","'.$noppamt.'","'.$noutl.'","'.$noutlamt.'"';
				$csv_row .= "\n";
			}
			//$csv_row .= '"========","========","========","========","========","========","========","========","========","========","========","========","========","========","========","========","========","========","========","========","========","========","========","========","========","========"';
			//$csv_row .= "\n";
		}
		/* Download as CSV File */
		header("Content-type: application/csv");
		header("Content-Disposition: attachment; filename=$file");
		echo $csv_header . $csv_row;
		exit;
	}
	header("Location: index.php");
?>