<?php
	include_once('../zc-session-admin.php');
	include_once('../zc-common-admin.php');
	include_once('../zf-TxnService1.php');
	include_once('../zf-User.php');

	$s1=$s2=$s3=$s4=$s5="";
	$cond=" where 1=1 and user_id='$logged_user_id' ";
	if(isset($_REQUEST['search']))
	{		
		if(isset($_REQUEST['s1'])) $s1=mysql_real_escape_string($_REQUEST['s1']);
		if(isset($_REQUEST['s2'])) $s2=mysql_real_escape_string($_REQUEST['s2']);
		if(isset($_REQUEST['s3'])) $s3=mysql_real_escape_string($_REQUEST['s3']);
		if(isset($_REQUEST['s4'])) $s4=mysql_real_escape_string($_REQUEST['s4']);
		if(isset($_REQUEST['s5'])) $s5=mysql_real_escape_string($_REQUEST['s5']);
		if($s1!=""){$cond.=" and txn_id='$s1' ";}
		if($s2!=""){$cond.=" and order_id='$s2' ";}
		if($s3!=""){$cond.=" and date(created_on) ='$s3' ";}
		if($s4!=""){$cond.=" and sender='$s4' ";}
		if($s5!=""){$cond.=" and racc='$s5' ";}

		$total_records=show_orders_count2($cond);
		$user_result=show_orders_data2($cond, $start_from, $num_rec_per_page);
	}
	//if($s3!="")
	{
		$file="Transaction-History-".time().".csv";
		
		$i=0;
		$csv_header = '"Txn Id","Order Id","Date Time","Txn Type","Method","Sender Number","Sender Name","Bank Name","Account Number","Pre Balance","Amount","Charges","Balance","Status"';
		$csv_header .= "\n";
		$csv_row ='';
		
		while($user_row=mysql_fetch_array($user_result))
		{
			$i++;	
			$txn_type="";
			if($user_row['amount']==5 && $user_row['charges']==0)
				$txn_type="Account Verification";
			else
				$txn_type="Money Transfer";
			
			$method=$user_row['method'];
			if($method==1)
				$method="NEFT";
			else
				$method="IMPS";
			
			$bank_ref_no="";
			$txn_status=$user_row['order_status'];
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
				$bank_ref_no=$user_row['bank_ref_no'];
			}
			else if($txn_status==3)
			{
				$txn_status="Response Awaited";
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
			
			$csv_row .= '"'.$user_row['txn_id'].'","'.$user_row['order_id'].'","'.$user_row['created_on'].'","'.$txn_type.'","'.$method.'","'.$user_row['sender_number'].'","'.$user_row['sname'].'","'.$user_row['rbname'].'","'.$user_row['racc'].'","'.$user_row['bal_before'].'","'.$user_row['amount'].'","'.$user_row['com_charged'].'","'.$user_row['bal_before'].'","'.$txn_status.'"';
			$csv_row .= "\n";
		}
		/* Download as CSV File */
		header("Content-type: application/csv");
		header("Content-Disposition: attachment; filename=$file");
		echo $csv_header . $csv_row;
	}
	exit;
?>