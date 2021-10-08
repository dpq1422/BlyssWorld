<?php
function show_members_count($cond)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_base.child_user $cond and user_type in(2,3,4,5) ";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	return $total_records;
}
function show_members_data($cond, $start_from=0, $num_rec_per_page=0)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$start_from=mysql_real_escape_string($start_from);
	$num_rec_per_page=mysql_real_escape_string($num_rec_per_page);
	if($start_from==0 && $num_rec_per_page==0)
	$query="select * from $bankapi_child_base.child_user $cond and user_type in(2,3,4,5) order by user_status,user_id ";
	else
	$query="select * from $bankapi_child_base.child_user $cond and user_type in(2,3,4,5) order by user_status,user_id  LIMIT $start_from, $num_rec_per_page";
	$result=mysql_query($query);
	return $result;
}
function show_member_name($user_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$user_name="";
	$query="select * from $bankapi_child_base.child_user where user_id=$user_id and user_type in(2,3,4,5) ";
	$result=mysql_query($query);
	$user_name=mysql_fetch_array($result)['user_name'];
	return $user_name;
}
function create_member($uname, $uadhar, $uemail, $umob, $upass, $uadd, $ucity, $udist, $ustate, $upincode, $ugender, $utype, $usoftware, $usecurity, $joinedby, $logged_user_id, $logged_user_name, $logged_user_typename, $logged_user_type)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$last_id=0;
	$uremarks="created by $logged_user_typename ($logged_user_id - $logged_user_name)";
	$query="insert into $bankapi_child_base.child_user (join_date, join_time, user_type, user_name, e_mail, user_contact_no, pass_word, address, city_name, distt_id, state_id, area_pin_code, gender, user_status, user_remarks, joined_by) value ('$datetime_date', '$datetime_time', '$utype', '$uname', '$uemail', '$umob', md5('$upass'), '$uadd', '$ucity', '$udist', '$ustate', '$upincode', '$ugender', '1', '$uremarks', '$joinedby') ;";
	mysql_query($query);
	$last_id = mysql_insert_id();
	
	if($last_id<201000)
	{
		$update_inc_id=explode(":",$datetime_time);
		$update_inc_id=($update_inc_id[2]-($update_inc_id[2]%10))/10;
		$update_inc_id=$last_id+$update_inc_id+1;
		$qry_update_inc_id="ALTER TABLE $bankapi_child_base.child_user auto_increment = $update_inc_id;";
		mysql_query($qry_update_inc_id);
	}
	/*
	$uadhar
	$usoftware
	$usecurity
	*/
	if($last_id>0)
	{
		$id_01=0;
		$id_02=0;
		$id_03=0;
		$id_04=0;
		$id_05=0;
		$id_06=0;
		$id_07=0;
		$id_08=0;
		$id_09=0;
		$id_10=0;
		$id_11=0;
		$id_12=0;
		
		$q1="select * from $bankapi_child_base.child_userinfo_level where user_id='$logged_user_id'";
		$res1=mysql_query($q1);
		while($rs1=mysql_fetch_array($res1))
		{
			$id_01=$rs1['id_01'];
			$id_02=$rs1['id_02'];
			$id_03=$rs1['id_03'];
			$id_04=$rs1['id_04'];
			$id_05=$rs1['id_05'];
			$id_06=$rs1['id_06'];
			$id_07=$rs1['id_07'];
			$id_08=$rs1['id_08'];
			$id_09=$rs1['id_09'];
			$id_10=$rs1['id_10'];
			$id_11=$rs1['id_11'];
			$id_12=$rs1['id_12'];
		}
		if($id_01==0)
			$id_01=$main_admin;
		if($logged_user_type==2)
			$id_02=$logged_user_id;
		else if($logged_user_type==3)
			$id_03=$logged_user_id;
		else if($logged_user_type==4)
			$id_04=$logged_user_id;
		else if($logged_user_type==5)
			$id_05=$logged_user_id;
		else if($logged_user_type==6)
			$id_06=$logged_user_id;
		else if($logged_user_type==7)
			$id_07=$logged_user_id;
		else if($logged_user_type==8)
			$id_08=$logged_user_id;
		else if($logged_user_type==9)
			$id_09=$logged_user_id;
		else if($logged_user_type==10)
			$id_10=$logged_user_id;
		else if($logged_user_type==11)
			$id_11=$logged_user_id;
		
		// create child_userinfo_level
		$query2="insert into $bankapi_child_base.child_userinfo_level(user_id, user_type, id_01, id_02, id_03, id_04, id_05, id_06, id_07, id_08, id_09, id_10, id_11) value('$last_id', '$utype', '$id_01', '$id_02', '$id_03', '$id_04', '$id_05', '$id_06', '$id_07', '$id_08', '$id_09', '$id_10', '$id_11')";
		mysql_query($query2);
		// create child_userinfo_walletkyc
		$query3="insert into $bankapi_child_base.child_userinfo_walletkyc(user_id, user_type, reg_amt, sec_amt, aadhar_no) value('$last_id', '$utype', '$usoftware', '$usecurity', '$uadhar')";
		mysql_query($query3);
		// create distribution wallet of user
		$query4="INSERT INTO $bankapi_child_wallet.distribution VALUES (NULL, '$datetime_date', '$datetime_time', '$last_id', '0', '0', '0', '0', '0', '0', 'Account Opened', '0', '0', '0', '0', '$uremarks');";
		mysql_query($query4);
		
		// create child_service_margin_mt
		$query5=" insert into $bankapi_child_base.child_service_margin_mt values ";
		
		//source 1 NEFT
		$query5a=$query5."(NULL,'$last_id',5,1,9,10,15,15,15,0,0,0,0)";
		mysql_query($query5a);
		//source 1 IMPS
		$query5b=$query5."(NULL,'$last_id',5,2,9,10,15,15,15,0,0,0,0)";
		mysql_query($query5b);
		//send sms
	}
	return $last_id;
}
?>