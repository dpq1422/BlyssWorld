<?php
	include_once('zc-common-admin.php');
	include_once('zf-TxnService2.php');
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
		if($s1!=""){$cond.=" and rc_id='$s1' ";}
		if($s2!=""){$cond.=" and user_id = '$s2' ";}
		if($s3!=""){$cond.=" and mobile_number='$s3' ";}
		$total_records=show_orders_count($cond);
		$user_result=show_orders_data($cond, $start_from, $num_rec_per_page);
	}
	if($s2!="")
	{
		$file="Transaction-History-".time().".csv";
		
		$i=0;
		$csv_header = '"Txn Id","Date Time","Txn Type","Biller","Account No","Pre Balance","Amount","Deducted","Balance","Status"';
		$csv_header .= "\n";
		$csv_row ='';
		
		while($user_row=mysql_fetch_array($user_result))
		{
			$i++;	
			$txn_type=$user_row['type'];
			if($txn_type==3)
				$txn_type="MOBILE RC";
			else if($txn_type==4)
				$txn_type="DTH RC";
			else if($txn_type==5)
				$txn_type="POSTPAID";
			else if($txn_type==6)
				$txn_type="ELECTRICITY";
			else if($txn_type==7)
				$txn_type="WATER";
			else if($txn_type==8)
				$txn_type="GAS";
			else if($txn_type==9)
				$txn_type="LANDLINE/BROADBAND";
			else if($txn_type==10)
				$txn_type="DATACARD";
			else if($txn_type==11)
				$txn_type="INSURANCE";
		
			$txn_status=$user_row['rc_status'];
			if($txn_status==0)
			{
				$txn_status="Not Initiated";
			}
			else if($txn_status==1)
			{
				$txn_status="Initiated";
			}
			else if($txn_status==2)
			{
				$txn_status="Success";
			}
			else if($txn_status==3)
			{
				$txn_status="<b class='w3-text-blue'>Response Awaited";
			}
			else if($txn_status==4)
			{
				$txn_status="Refund Pending";
			}
			else if($txn_status==-4)
			{
				$txn_status="Refund Pendings";
			}
			else if($txn_status==5)
			{
				$txn_status="Refunded";
			}
			else
			{
				$txn_status="In Progress";
			}
			
			$csv_row .= '"'.$user_row['rc_id'].'","'.$user_row['created_on'].'","'.$txn_type.'","'.$user_row['operator'].'","'.$user_row['mobile_number'].'","'.$user_row['pre_bal'].'","'.$user_row['amount'].'","'.$user_row['deducted_amt'].'","'.$user_row['post_bal'].'","'.$txn_status.'"';
			$csv_row .= "\n";
		}
		/* Download as CSV File */
		header("Content-type: application/csv");
		header("Content-Disposition: attachment; filename=$file");
		echo $csv_header . $csv_row;
	}
	exit;
?>