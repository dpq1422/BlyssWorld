<?php
	include_once('zc-common-admin.php');
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
		if($s2!=""){$cond.=" and user_name like '%$s2%' ";}
		if($s3!=""){$cond.=" and user_type='$s3' ";}
		if($s4!=""){$cond.=" and user_department_info like '%$s4%' ";}
		if($s5!=""){$cond.=" and user_status='$s5' ";}
	}
	$file="list-of-users-".date("Y/m/d")."-".date("h:i:sa").".csv";
	
	$i=0;
	$csv_header = '"User Id","Date of Joining","User Type","User Name","Gender","City","Address","Email","Contact No","Status"';
	$csv_header .= "\n";
	$csv_row ='';
	$aa=$bb=$cc=0;
	$user_result=show_users_data($cond);
	while($user_row=mysql_fetch_array($user_result))
	{
		$i++;			
		
		$user_type=$user_row['user_type'];
		if($user_type==1)
			$user_type="Application Admin";
		else if($user_type==0)
			$user_type="Application Wallet";
		else if($user_type==-1)
			$user_type="Office Staff/User";
		
		$user_gender=$user_row['gender'];
		if($user_gender==1)
			$user_gender="Male";
		else if($user_gender==0)
			$user_gender="Female";
		else if($user_gender==-1)
			$user_gender="Trans Gender";
		
		$user_status=$user_row['user_status'];
		if($user_status==1)
			$user_status="Active";
		else if($user_status==2)
			$user_status="Blocked";
		else if($user_status==3)
			$user_status="Suspended";
		else if($user_status==4)
			$user_status="Terminated";
		
		$csv_row .= '"'.$user_row['user_id'].'","'.$user_row['join_date'].'","'.$user_type.'","'.$user_row['user_name'].'","'.$user_gender.'","'.$user_row['city_name'].'","'.$user_row['address'].'","'.$user_row['e_mail'].'","'.$user_row['user_contact_no'].'","'.$user_status.'"';
		$csv_row .= "\n";
	}
	/* Download as CSV File */
	header("Content-type: application/csv");
	header("Content-Disposition: attachment; filename=$file");
	echo $csv_header . $csv_row;
	exit;
?>