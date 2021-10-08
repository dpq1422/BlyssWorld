<?php
//$call_mt1_url
function security_2point0()
{
	//1. secret-key
	//2. secret-key-timestamp

	//initializing secret key in some variable
	$key = md5("9893627028");

	//encode it using base64
	$encodedKey = base64_encode($key);

	//Generate timestamp in long which works as a salt
	$secret_key_timestamp = time();

	//Computes the signature by hashing the salt with the secret key as the key
	$signature = hash_hmac('SHA256', $secret_key_timestamp, $encodedKey, true);

	//encode it using base64
	$secret_key = base64_encode($signature);

	$return_value=array($secret_key, $secret_key_timestamp);
	return $return_value;
}

function find_sender($useridlogged,$cno)
{
	require('zc-gyan-info-admin.php');
	$return_result="";
	
	$bankapi_user_id="100001";
	$bankapi_user_pass="9729877577";
	$bankapi_method="SHOW_SENDER";
	
	$sender_number=urlencode($cno);
	
	$url = "$call_mt1_url" . "?";
	$url = $url . "bankapi_user_id=" . $bankapi_user_id;
	$url = $url . "&bankapi_user_pass=" . $bankapi_user_pass;
	$url = $url . "&bankapi_method=" . $bankapi_method;
	$url = $url . "&sender_number=" . $sender_number;
							   
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($curl);
	
	$err = curl_error($curl);
	
	curl_close($curl);
	
	if ($err) {
		$err=str_replace("eko","",$err);
		//$err=str_replace("_","",$err);
		echo "cURL Error : " . $err;
	}
	else
	{
		//$response=str_replace("eko","",$response);
		//$response=str_replace("_","",$response);
		//echo $response;
		$result= json_decode($response, true);
		$message= $result['message'];
		$response_status_id=$result['response_status_id'];
		$response_type_id=$result['response_type_id'];
		$response_status=$result['status'];
		$name="";
		$limit1=$limit2=0;
		$name= $result['data']['name'];
		
		if($response_status_id==0 && $response_type_id==33 && $response_status==0)
		{
			$balance_amount=$result['data']['balance'];
			$state_desc=$result['data']['state_desc'];
			$sender_name=$result['data']['name'];
			$state=$result['data']['state'];
			$customer_id=$result['data']['customer_id'];
			$response_message=$result['message'];
			
			require('zc-commons-admin.php');
			
			$cno=mysql_real_escape_string($cno);
			
			mysql_query("delete from $bankapi_common.eko_sender where sender_number='$cno';");
			mysql_query("delete from $bankapi_common.eko_sender_limit where customer_id='$cno';");
			$qry1="insert into $bankapi_common.eko_sender(user_id, sender_number, response, response_status_id, balance_amount, state_desc, sender_name, state, customer_id, response_type_id, response_message, response_status, checked_on, registered_on, verified_on, eko_sender_status) value('$useridlogged', '$cno', '$response', '$response_status_id', '$balance_amount', '$state_desc', '$sender_name', '$state', '$customer_id', '$response_type_id', '$response_message', '$response_status', '$datetime_datetime', '$datetime_datetime', '$datetime_datetime', 3);";
			mysql_query($qry1);
			
			$limitss=$result['data']['limit'];
			for($vals=0;$vals<count($limitss);$vals++)
			{
				$wallet_name=$limitss[$vals]['name'];
				$pipe=$limitss[$vals]['pipe'];
				$used=$limitss[$vals]['used'];
				$priority=$limitss[$vals]['priority'];
				$remaining=$limitss[$vals]['remaining'];
				$status=$limitss[$vals]['status'];
				if(!isset($wallet_name))
				{
					$wallet_name=0;
				}
				if(!isset($pipe))
				{
					$pipe=0;
				}
				if(!isset($used))
				{
					$used=0;
				}
				if(!isset($priority))
				{
					$priority=0;
				}
				if(!isset($remaining))
				{
					$remaining=0;
				}
				if(!isset($status))
				{
					$status=0;
				}
				$qry2="insert into $bankapi_common.eko_sender_limit value(NULL, '$customer_id', '$wallet_name', '$pipe', '$used', '$priority', '$remaining', '$status');";
				mysql_query($qry2);
			}
		}
		$customer_id=mysql_real_escape_string($customer_id);
		$qry_limit="SELECT * FROM $bankapi_common.eko_sender_limit where customer_id='$customer_id' and status=1 order by priority limit 0,2";
		$result_limit=mysql_query($qry_limit);
		$limit_no=0;
		$limit1=$limit2=0;
		while($row_limit=mysql_fetch_array($result_limit))
		{
			$limit_no++;
			if($limit_no==1)
				$limit1=$row_limit['remaining'];
			if($limit_no==2)
				$limit2=$row_limit['remaining'];
		}
		$return_result=array($response_status_id,$response_type_id,$response_status,$name,$limit1,$limit2);
	}
	return $return_result;
}
function add_sender($useridlogged, $cno, $cname)
{
	require('zc-gyan-info-admin.php');
	$return_result="";
	
	$bankapi_user_id="100001";
	$bankapi_user_pass="9729877577";
	$bankapi_method="SAVE_SENDER";
	
	$sender_number=urlencode($cno);
	$sender_name=urlencode($cname);
	
	$url = "$call_mt1_url" . "?";
	$url = $url . "bankapi_user_id=" . $bankapi_user_id;
	$url = $url . "&bankapi_user_pass=" . $bankapi_user_pass;
	$url = $url . "&bankapi_method=" . $bankapi_method;
	$url = $url . "&sender_number=" . $sender_number;
	$post_values = "";
	$post_values = $post_values . "sender_name=" . $sender_name;
							   
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $post_values);
	$response = curl_exec($curl);
	
	$err = curl_error($curl);
	
	curl_close($curl);
	
	if ($err) {
		$err=str_replace("eko","",$err);
		//$err=str_replace("_","",$err);
		echo "cURL Error : " . $err;
	}
	else
	{
		//$response=str_replace("eko","",$response);
		//$response=str_replace("_","",$response);
		//echo $response;
		$result= json_decode($response, true);
		$message= $result['message'];
		$name= $result['data']['name'];
		$response_status_id=$result['response_status_id'];
		$response_type_id=$result['response_type_id'];
		$response_status=$result['status'];
		$otp="";
		if(isset($result['data']['otp']))
		$otp= $result['data']['otp'];
		$return_result=array($response_status_id,$response_type_id,$response_status,$name,$otp);
	}
	return $return_result;
}
function verify_sender($useridlogged,$cno,$cname,$cotp)
{
	require('zc-gyan-info-admin.php');
	$return_result="";
	
	$bankapi_user_id="100001";
	$bankapi_user_pass="9729877577";
	$bankapi_method="SENDER_OTP_VERIFY";
	
	$sender_number=urlencode($cno);
	$sender_name=urlencode($cname);
	$sender_otp=urlencode($cotp);
	
	$url = "$call_mt1_url" . "?";
	$url = $url . "bankapi_user_id=" . $bankapi_user_id;
	$url = $url . "&bankapi_user_pass=" . $bankapi_user_pass;
	$url = $url . "&bankapi_method=" . $bankapi_method;
	$url = $url . "&sender_number=" . $sender_number;
	$url = $url . "&sender_name=" . $sender_name;
	$url = $url . "&sender_otp=" . $sender_otp;
							   
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($curl);
	
	$err = curl_error($curl);
	
	curl_close($curl);
	
	if ($err) {
		$err=str_replace("eko","",$err);
		//$err=str_replace("_","",$err);
		echo "cURL Error : " . $err;
	}
	else
	{
		//$response=str_replace("eko","",$response);
		//$response=str_replace("_","",$response);
		//echo $response;
		$result= json_decode($response, true);
		$message= $result['message'];
		$return_result=find_sender($useridlogged,$cno);
	}
	return $return_result;
}
function show_beneficiary($useridlogged,$cno)
{
	require('zc-gyan-info-admin.php');
	$result_beneficiary="";
	
	$bankapi_user_id="100001";
	$bankapi_user_pass="9729877577";
	$bankapi_method="SHOW_RECEIVERS";
	
	$sender_number=urlencode($cno);
	
	$url = "$call_mt1_url" . "?";
	$url = $url . "bankapi_user_id=" . $bankapi_user_id;
	$url = $url . "&bankapi_user_pass=" . $bankapi_user_pass;
	$url = $url . "&bankapi_method=" . $bankapi_method;
	$url = $url . "&sender_number=" . $sender_number;
							   
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($curl);
	
	$err = curl_error($curl);
	
	curl_close($curl);
	
	if ($err) {
		$err=str_replace("eko","",$err);
		//$err=str_replace("_","",$err);
		echo "cURL Error : " . $err;
	}
	else
	{
		//$response=str_replace("eko","",$response);
		//$response=str_replace("_","",$response);
		//echo $response;
		$result= json_decode($response, true);
		$response_status_id=$result['response_status_id'];
		$response_type_id=$result['response_type_id'];
		$response_message=$result['message'];
		$response_status=$result['status'];	
		if($response_status_id==0 && $response_type_id==23 && $response_status==0)
		{
			require('zc-commons-admin.php');
			
			$sender_number=mysql_real_escape_string($sender_number);
			$qry_del_beneficiary="delete from $bankapi_common.eko_receiver where sender_number='$sender_number';";
			mysql_query($qry_del_beneficiary);
			
			$recipient_list=$result['data']['recipient_list'];
			for($vals=0;$vals<count($recipient_list);$vals++)
			{
				$receiver_number=$recipient_list[$vals]['recipient_mobile'];
				$bank=$recipient_list[$vals]['bank'];
				$ifsc=$recipient_list[$vals]['ifsc'];
				$receiver_acc_no=$recipient_list[$vals]['account'];
				$receiver_name=$recipient_list[$vals]['recipient_name'];
				$is_verified=$recipient_list[$vals]['is_verified'];
				$receiver_id_type=$recipient_list[$vals]['recipient_id_type'];
				$receiver_id=$recipient_list[$vals]['recipient_id'];
				$account_type=$recipient_list[$vals]['account_type'];
				
				$channel_absolute=$recipient_list[$vals]['channel_absolute'];
				$available_channel=$recipient_list[$vals]['available_channel'];
				$ifsc_status=$recipient_list[$vals]['ifsc_status'];
				$is_self_account=$recipient_list[$vals]['is_self_account'];
				$channel=$recipient_list[$vals]['channel'];
				$is_imps_scheduled=$recipient_list[$vals]['is_imps_scheduled'];
				$imps_inactive_reason=$recipient_list[$vals]['imps_inactive_reason'];
				$allowed_channel=$recipient_list[$vals]['allowed_channel'];
				$is_otp_required=$recipient_list[$vals]['is_otp_required'];
				$is_rblbc_recipient=$recipient_list[$vals]['is_rblbc_recipient'];
				
				$eko_receiver_status=2;						
				if($is_verified==1)
				$eko_receiver_status=3;
			
				$qry="insert into $bankapi_common.eko_receiver(user_id, sender_number, receiver_number, bank, ifsc, receiver_acc_no, receiver_name, is_verified, receiver_id_type, receiver_id, account_type, channel_absolute, available_channel, ifsc_status, is_self_account, channel, is_imps_scheduled, imps_inactive_reason, allowed_channel, is_otp_required, is_rblbc_recipient, updated_on, eko_receiver_status, sender_id, source) value('$useridlogged', '$sender_number', '$receiver_number', '$bank', '$ifsc', '$receiver_acc_no', '$receiver_name', '$is_verified', '$receiver_id_type', '$receiver_id', '$account_type', '$channel_absolute', '$available_channel', '$ifsc_status', '$is_self_account', '$channel', '$is_imps_scheduled', '$imps_inactive_reason', '$allowed_channel', '$is_otp_required', '$is_rblbc_recipient', '$datetime_datetime', '$eko_receiver_status', 0,1);";
				mysql_query($qry);
				
				$is_stored=0;
				$qry_store="select * from $bankapi_common.eko_receiver_verified where bank='$bank' and ifsc='$ifsc' and receiver_acc_no='$receiver_acc_no';";
				$result_store=mysql_query($qry_store);
				while($row_store=mysql_fetch_array($result_store))
				{
					$is_stored++;
				}
				
				if($is_verified==1 && $is_stored==0)
				{
					$qry="insert into $bankapi_common.eko_receiver_verified(bank, ifsc, receiver_acc_no, receiver_name, receiver_id_type, updated_on, source) value('$bank', '$ifsc', '$receiver_acc_no', '$receiver_name', '$receiver_id_type', '$datetime_datetime', 1);";
					mysql_query($qry);
				}
			}
		}
		$sender_number=mysql_real_escape_string($sender_number);
		$qry_beneficiary="SELECT * FROM $bankapi_common.eko_receiver where sender_number='$sender_number' order by receiver_id desc;";
		$result_beneficiary=mysql_query($qry_beneficiary);
	}
	return $result_beneficiary;
}
function show_bank()
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$qry_bank="SELECT * FROM $bankapi_common.eko_bank where ifsc_status!=-1 order by ifsc_status, bank_name;";
	$result_bank=mysql_query($qry_bank);
	return $result_bank;
}
function show_bank_ifsc_availability($bank_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$ifsc="";
	$bank_id=mysql_real_escape_string($bank_id);
	$query="SELECT * FROM $bankapi_common.eko_bank where eko_bank_id='$bank_id'";
	$result=mysql_query($query);
	$num_rows = mysql_num_rows($result);
	while($r = mysql_fetch_array($result)) 
	{
		$ifsc=$r['base_ifsc']."@".$r['verification_available'];
	}
	return $ifsc;
}
function remove_beneficiary($cno,$benid)
{
	require('zc-gyan-info-admin.php');
	$return_result="";
	
	$bankapi_user_id="100001";
	$bankapi_user_pass="9729877577";
	$bankapi_method="DELETE_RECEIVER";
	
	$sender_number=urlencode($cno);
	$receiver_id=urlencode($benid);
	
	$url = "$call_mt1_url" . "?";
	$url = $url . "bankapi_user_id=" . $bankapi_user_id;
	$url = $url . "&bankapi_user_pass=" . $bankapi_user_pass;
	$url = $url . "&bankapi_method=" . $bankapi_method;
	$url = $url . "&sender_number=" . $sender_number;
	$url = $url . "&receiver_id=" . $receiver_id;
							   
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($curl);
	
	$err = curl_error($curl);
	
	curl_close($curl);
	
	if ($err) {
		$err=str_replace("eko","",$err);
		//$err=str_replace("_","",$err);
	  	echo "cURL Error : " . $err;
	}
	else
	{
		$response=str_replace("eko","",$response);
		//$response=str_replace("_","",$response);
		$result= json_decode($response, true);
		$message= $result['message'];
		$response_type_id= $result['response_type_id'];
		$response_status_id= $result['response_status_id'];
		$status= $result['state'];
	}
	$return_result=array($message,$response_type_id,$response_status_id,$status);
	return $return_result;
}
function add_beneficiary_without_verify($cno,$rno,$rname,$rbacc,$rbifsc,$rbifscstatus,$bank_id,$bank_code)
{
	require('zc-gyan-info-admin.php');
	$return_result="";
	
	$bankapi_user_id="100001";
	$bankapi_user_pass="9729877577";
	$bankapi_method="SAVE_RECEIVER";
	
	$sender_number=urlencode($cno);
	$receiver_number=urlencode($rno);
	$receiver_name=urlencode($rname);
	$receiver_bank_accno=urlencode($rbacc);
	$receiver_bank_ifsccode=urlencode($rbifsc);
	$receiver_bank_ifscstatus=urlencode($rbifscstatus);
	$receiver_bank_bankid=urlencode($bank_id);
	$receiver_bank_bankcode=urlencode($bank_code);
	
	$url = "$call_mt1_url" . "?";
	$url = $url . "bankapi_user_id=" . $bankapi_user_id;
	$url = $url . "&bankapi_user_pass=" . $bankapi_user_pass;
	$url = $url . "&bankapi_method=" . $bankapi_method;
	$url = $url . "&sender_number=" . $sender_number;
	$url = $url . "&receiver_number=" . $receiver_number;
	$url = $url . "&receiver_bank_accno=" . $receiver_bank_accno;
	$url = $url . "&receiver_bank_ifsccode=" . $receiver_bank_ifsccode;
	$url = $url . "&receiver_bank_ifscstatus=" . $receiver_bank_ifscstatus;
	$url = $url . "&receiver_bank_bankid=" . $receiver_bank_bankid;
	$url = $url . "&receiver_bank_bankcode=" . $receiver_bank_bankcode;
	$post_values = "";
	$post_values = $post_values . "receiver_name=" . $receiver_name;
							   
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $post_values);
	$response = curl_exec($curl);
	
	/* API RESULT */
	
	$err = curl_error($curl);
	curl_close($curl);
	if ($err) {
	  $msg="<br>cURL Error : " . $err;
	}
	else
	{
		//echo $response;//die();
		$result= json_decode($response, true);
		$msg=$message=$result['message'];
		$response_type_id="";
		$response_status_id="";
		$status="";
		if($message!="No key for Response")
		{
			$response_type_id=$result['response_type_id'];
			$response_status_id=$result['response_status_id'];
			$status=$result['status'];
		}
	}
	$return_result=array($msg,$response_type_id,$response_status_id,$status);
	return $return_result;
}
function add_beneficiary_with_verify($cno,$rbacc,$rbifsc,$bank_id)
{
	require('zc-gyan-info-admin.php');
	$return_result="";
	
	$bankapi_user_id="100001";
	$bankapi_user_pass="9729877577";
	$bankapi_method="VERIFY_RECEIVER";
	
	$sender_number=urlencode($cno);
	$bankapi_acc=urlencode($rbacc);
	$bankapi_ifsc=urlencode($rbifsc);
	$receiver_bank_bankid=urlencode($bank_id);
	
	$url = "$call_mt1_url" . "?";
	$url = $url . "bankapi_user_id=" . $bankapi_user_id;
	$url = $url . "&bankapi_user_pass=" . $bankapi_user_pass;
	$url = $url . "&bankapi_method=" . $bankapi_method;
	$url = $url . "&bankapi_acc=" . $bankapi_acc;
	$url = $url . "&bankapi_ifsc=" . $bankapi_ifsc;
	$url = $url . "&receiver_bank_bankid=" . $receiver_bank_bankid;
	$post_values = "";
	$post_values = $post_values . "sender_number=" . $sender_number;
							   
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $post_values);
	$response = curl_exec($curl);
	
	/* API RESULT */
	
	$err = curl_error($curl);
	curl_close($curl);
	if ($err) {
	  $msg="<br>cURL Error : " . $err;
	}
	else
	{
		$result= json_decode($response, true);
		$msg=$message=$result['message'];
		$benefid=0;
		$tid=0;
		$response_type_id="";
		$response_status_id="";
		$status="";
		if($message!="No key for Response")
		{
			$response_type_id=$result['response_type_id'];
			$response_status_id=$result['response_status_id'];
			$status=$result['status'];
			if(isset($result['data']['recipient_id']))
			$benefid=$result['data']['recipient_id'];
			if(isset($result['data']['tid']))
			$tid=$result['data']['tid'];
		}
	}
	$return_result=array($msg,$response_type_id,$response_status_id,$status);
	$return_result=array($response,$benefid,$tid,$return_result);
	return $return_result;
}
function check_bank_transfer_method($receiver)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$qry_bnk="select bank from $bankapi_common.eko_receiver where receiver_id='$receiver';";
	$res_bnk=mysql_query($qry_bnk);
	$val_bank="";
	while($rs_bnk=mysql_fetch_array($res_bnk))
	{
		$val_bank=$rs_bnk['bank'];
	}
	$qry_meth="SELECT * FROM $bankapi_common.eko_bank where name='$val_bank' or bank_name='$val_bank';";
	$res_meth=mysql_query($qry_meth);
	$val_meth=-1;
	while($rs_meth=mysql_fetch_array($res_meth))
	{
		$val_meth=$rs_meth['available_channels'];
	}
	return $val_meth;
}
function fund_transfer($orderno,$cno,$brid,$method,$transamount,$doctype,$docid,$areapincode,$geo)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$return_result="";
	
	$bankapi_user_id="100001";
	$bankapi_user_pass="9729877577";
	$bankapi_method="FUND_TRANSFER_INITIATE";
	
	$sender_number=urlencode($cno);
	$receiver_id=urlencode($brid);
	$transfer_method=urlencode($method);
	$amount=urlencode($transamount);
	$merchant_document_id_type=urlencode($doctype);
	$merchant_document_id=urlencode($docid);
	$pincode=urlencode($areapincode);
	$latlong=urlencode($geo);
	$timestamp=str_replace('+00:00', 'Z', gmdate('c', strtotime($datetime_date." ".$datetime_time)));
	$order_number=urlencode($orderno);
	
	$url = "$call_mt1_url" . "?";
	$url = $url . "bankapi_user_id=" . $bankapi_user_id;
	$url = $url . "&bankapi_user_pass=" . $bankapi_user_pass;
	$url = $url . "&bankapi_method=" . $bankapi_method;
	$url = $url . "&sender_number=" . $sender_number;
	$url = $url . "&receiver_id=" . $receiver_id;
	$url = $url . "&transfer_method=" . $transfer_method;
	$url = $url . "&amount=" . $amount;
	$url = $url . "&timestamp=" . $timestamp;
	$url = $url . "&order_number=" . $order_number;
	$url = $url . "&merchant_document_id_type=" . $merchant_document_id_type;
	$url = $url . "&merchant_document_id=" . $merchant_document_id;
	$url = $url . "&pincode=" . $pincode;
	$url = $url . "&latlong=" . $latlong;
							   
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($curl);
	
	$err = curl_error($curl);
	
	curl_close($curl);
	
	if ($err) {
		$err=str_replace("eko","",$err);
		//$err=str_replace("_","",$err);
	  	echo "cURL Error : " . $err;
	}
	else
	{
		$result= json_decode($response, true);
		/*
		{
			"response_status_id":0,
			"data":
			{
				"tx_status":"0",
				"debit_user_id":"9910028267",
				"tds":"",
				"txstatus_desc":"Success",
				"fee":"8.4",
				"channel":"2",
				"collectable_amount":"1408.4",
				"ekyc_enabled":"0",
				"remaining_limit_before_pan_required":47200.0,
				"tid":"16123900",
				"balance":"8499849.72",
				"totalfee":"",
				"is_otp_required":"0",
				"aadhar":"",
				"currency":"INR",
				"commission":"",
				"state":"1",
				"bank_ref_num":"876112909",
				"recipient_id":10016267,
				"timestamp":"2018-01-30T19:29:01.741+05:30",
				"amount":"1400.00",
				"pan_required":2,
				"pinNo":"",
				"payment_mode_desc":"",
				"channel_desc":"IMPS",
				"last_used_okekey":"253",
				"npr":"",
				"service_tax":"1.10",
				"paymentid":"",
				"mdr":"",
				"customer_id":"9729877577",
				"account":"972997299729"
			},
			"response_type_id":325,
			"message":"Transaction successful Last_used_OkeyKey: 253",
			"status":0
		}
		*/
		$message="";
		$bankrefno="0";
		$tid="0";
		$response_type_id="";
		$response_status_id="";
		$status="";
		$status_desc="";
		$message=$result['message'];
		if($message!="")
		{
			$response_type_id=$result['response_type_id'];
			$response_status_id=$result['response_status_id'];
			if(isset($result['data']['tid']))
			$tid=$result['data']['tid'];
			if(isset($result['data']['bank_ref_num']))
			$bankrefno=$result['data']['bank_ref_num'];
			if(isset($result['data']['tx_status']))
			$status=$result['data']['tx_status'];
			if(isset($result['data']['txstatus_desc']))
			$status_desc=$result['data']['txstatus_desc'];
		}
	}
	$return_result=array($response,$bankrefno,$tid,$message,$response_type_id,$response_status_id,$status,$status_desc);
	return $return_result;
}
function fund_transfer_order_status($order)//CHECK_ORDER_STATUS
{ 	
	require('zc-gyan-info-admin.php');
	$return_result="";
	
	$bankapi_user_id="100001";
	$bankapi_user_pass="9729877577";
	$bankapi_method="CHECK_ORDER_STATUS";
	
	$order_number=urlencode($order);
	
	$url = "$call_mt1_url" . "?";
	$url = $url . "bankapi_user_id=" . $bankapi_user_id;
	$url = $url . "&bankapi_user_pass=" . $bankapi_user_pass;
	$url = $url . "&bankapi_method=" . $bankapi_method;
	$url = $url . "&order_number=" . $order_number;
							   
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($curl);
	
	$err = curl_error($curl);
	
	curl_close($curl);
	
	if ($err) {
		$err=str_replace("eko","",$err);
		//$err=str_replace("_","",$err);
	  	echo "cURL Error : " . $err;
	}
	else
	{
		$result= json_decode($response, true);
		/*
		{
			"response_status_id":0,
			"data":
			{
				"tx_status":"0",
				"amount":"1400.00",
				"txstatus_desc":"Success",
				"fee":"8.4",
				"channel":"2",
				"branch":"",
				"tid":"16123914",
				"tx_desc":"IMPS Remittance",
				"allow_retry":"0",
				"service_tax":"1.10",
				"currency":"INR",
				"customer_id":"9729877577",
				"bank_ref_num":"876176146",
				"recipient_id":10016267,
				"timestamp":"2018-01-30T19:34:39.662+05:30"
			},
			"response_type_id":70,
			"message":"Success! Transaction status enq successful.",
			"status":0
		}
		*/
		$message="";
		$bankrefno="0";
		$tid="0";
		$response_type_id="";
		$response_status_id="";
		$status="";
		$status_desc="";
		$message=$result['message'];
		if($message!="")
		{
			$response_type_id=$result['response_type_id'];
			$response_status_id=$result['response_status_id'];
			if(isset($result['data']['tid']))
			$tid=$result['data']['tid'];
			if(isset($result['data']['bank_ref_num']))
			$bankrefno=$result['data']['bank_ref_num'];
			if(isset($result['data']['tx_status']))
			$status=$result['data']['tx_status'];
			if(isset($result['data']['txstatus_desc']))
			$status_desc=$result['data']['txstatus_desc'];
		}
	}
	$return_result=array($response,$bankrefno,$tid,$message,$response_type_id,$response_status_id,$status,$status_desc);
	return $return_result;
}
function fund_transfer_txn_status($tid)//FUND_TRANSFER_STATUS
{ 	
	require('zc-gyan-info-admin.php');
	$return_result="";
	
	$bankapi_user_id="100001";
	$bankapi_user_pass="9729877577";
	$bankapi_method="FUND_TRANSFER_STATUS";
	
	$tid=urlencode($tid);
	
	$url = "$call_mt1_url" . "?";
	$url = $url . "bankapi_user_id=" . $bankapi_user_id;
	$url = $url . "&bankapi_user_pass=" . $bankapi_user_pass;
	$url = $url . "&bankapi_method=" . $bankapi_method;
	$url = $url . "&tid=" . $tid;
							   
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($curl);
	
	$err = curl_error($curl);
	
	curl_close($curl);
	
	if ($err) {
		$err=str_replace("eko","",$err);
		//$err=str_replace("_","",$err);
	  	echo "cURL Error : " . $err;
	}
	else
	{
		$result= json_decode($response, true);
		/*
		{
			"response_status_id":0,
			"data":
			{
				"tx_status":"0",
				"amount":"1400.00",
				"txstatus_desc":"Success",
				"fee":"8.4",
				"channel":"2",
				"branch":"",
				"tid":"16123914",
				"tx_desc":"IMPS Remittance",
				"allow_retry":"0",
				"service_tax":"1.10",
				"currency":"INR",
				"customer_id":"9729877577",
				"bank_ref_num":"876176146",
				"recipient_id":10016267,
				"timestamp":"2018-01-30T19:34:39.662+05:30"
			},
			"response_type_id":70,
			"message":"Success! Transaction status enq successful.",
			"status":0
		}
		*/
		$message="";
		$bankrefno="0";
		$tid="0";
		$response_type_id="";
		$response_status_id="";
		$status="";
		$status_desc="";
		$message=$result['message'];
		if($message!="")
		{
			$response_type_id=$result['response_type_id'];
			$response_status_id=$result['response_status_id'];
			if(isset($result['data']['tid']))
			$tid=$result['data']['tid'];
			if(isset($result['data']['bank_ref_num']))
			$bankrefno=$result['data']['bank_ref_num'];
			if(isset($result['data']['tx_status']))
			$status=$result['data']['tx_status'];
			if(isset($result['data']['txstatus_desc']))
			$status_desc=$result['data']['txstatus_desc'];
		}
	}
	$return_result=array($response,$bankrefno,$tid,$message,$response_type_id,$response_status_id,$status,$status_desc);
	return $return_result;
}
function fund_transfer_refund_otp($tid)//FUND_REFUND_OTP_RESEND
{ 	
	require('zc-gyan-info-admin.php');
	$return_result="";
	
	$bankapi_user_id="100001";
	$bankapi_user_pass="9729877577";
	$bankapi_method="FUND_REFUND_OTP_RESEND";
	
	$tid=urlencode($tid);
	
	$url = "$call_mt1_url" . "?";
	$url = $url . "bankapi_user_id=" . $bankapi_user_id;
	$url = $url . "&bankapi_user_pass=" . $bankapi_user_pass;
	$url = $url . "&bankapi_method=" . $bankapi_method;
	$url = $url . "&tid=" . $tid;
							   
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($curl);
	
	$err = curl_error($curl);
	
	curl_close($curl);
	
	if ($err) {
		$err=str_replace("eko","",$err);
		//$err=str_replace("_","",$err);
	  	echo "cURL Error : " . $err;
	}
	else
	{
		$result= json_decode($response, true);
		/*
		{
		  "message": "Success!Refund OTP resent",
		  "response_type_id": 169,
		  "response_status_id": -1,
		  "status": 0,
		  "data": {
			"tid": "12735434",
			"otp": "7668294572"
		  }
		}
		*/
		$return_result=$message=$result['message'];
	}
	return $return_result;
}
function fund_transfer_refund($order_number,$tid,$otp)//FUND_REFUND
{ 	
	require('zc-gyan-info-admin.php');
	$return_result="";
	
	$bankapi_user_id="100001";
	$bankapi_user_pass="9729877577";
	$bankapi_method="FUND_REFUND_OTP_RESEND";
	
	$order_number=urlencode($order_number);
	$tid=urlencode($tid);
	$otp=urlencode($otp);
	
	$url = "$call_mt1_url" . "?";
	$url = $url . "bankapi_user_id=" . $bankapi_user_id;
	$url = $url . "&bankapi_user_pass=" . $bankapi_user_pass;
	$url = $url . "&bankapi_method=" . $bankapi_method;
	$url = $url . "&order_number=" . $order_number;
	$url = $url . "&tid=" . $tid;
	$url = $url . "&otp=" . $otp;
							   
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($curl);
	
	$err = curl_error($curl);
	
	curl_close($curl);
	
	if ($err) {
		$err=str_replace("eko","",$err);
		//$err=str_replace("_","",$err);
	  	echo "cURL Error : " . $err;
	}
	else
	{
		$result= json_decode($response, true);
		/*
		{
		  "message": "Refund done",
		  "response_type_id": 74,
		  "response_status_id": 0,
		  "status": 0,
		  "data": {
			"refunded_amount": "5000.00",
			"timestamp": "2017-08-02T12:09:41.135Z",
			"fee": "0.0",
			"amount": "5000.00",
			"tid": "12735435",
			"refund_tid": "12737093",
			"currency": "INR"
		  }
		}
		*/
		$return_result=$message=$result['message'];
	}
	return $return_result;
}

function order_clientid_clienttypeid_by_mid($m_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	
	$mid=0;
	$clientid=0;
	$query="SELECT * FROM $bankapi_parent_txn.txn_mt where mmt_id='$m_id';";
	$result=mysql_query($query);
	while($r = mysql_fetch_array($result)) 
	{
		$mid=$r['order_id'];
		$clientid=$r['client_id'];
		require('zf-Client.php');
		$clienttypeid=show_client_type_id($clientid);
	}
	$ar=array($mid,$clientid,$clienttypeid);
	return $ar;
}
?>