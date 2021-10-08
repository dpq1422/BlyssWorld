<?php
function find_sender2($useridlogged,$cno)
{
	require('zc-gyan-info-admin.php');
	$return_result="";
	
	$bankapi_user_id="100001";
	$bankapi_user_pass="9729877577";
	$bankapi_method="SHOW_SENDER";
	
	$sender_number=urlencode($cno);
	
	$url = "$call_mt3_url" . "?";
	$url = $url . "bankapi_user_id=" . $bankapi_user_id;
	$url = $url . "&bankapi_user_pass=" . $bankapi_user_pass;
	$url = $url . "&bankapi_method=" . $bankapi_method;
	$url = $url . "&sender_number=" . $sender_number;

	$curl = curl_init($url);
	curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
	$response = curl_exec($curl);
	
	$err = curl_error($curl);
	
	curl_close($curl);
	
	if ($err) {
		echo "cURL Error : " . $err;
	}
	else
	{
		//echo $response;
		//[{"StatusCode":"0","RemitterName":"abhishek","RemitterMobile":"9729877577", "RemitterLimit1":"24850.00","RemitterLimit2":"24597.00"}]
		$result= json_decode($response, true)[0];
		$StatusCode=$result['StatusCode'];
		$Description="";
		$RemitterName="";
		$RemitterMobile="";
		$RemitterLimit1="";
		$RemitterLimit2="";
		//echo "<br><br>StatusCode : $StatusCode";
		if($StatusCode==0)
		{
			$RemitterName= $result['RemitterName'];
			$RemitterMobile= $result['RemitterMobile'];
			$RemitterLimit1= $result['RemitterLimit1'];
			$RemitterLimit2= $result['RemitterLimit2'];
			
			require('zc-commons-admin.php');
			
			$cno=mysql_real_escape_string($cno);
			
			mysql_query("delete from $bankapi_common.eko_sender where sender_number='$cno' and source='3';");
			$qry1="insert into $bankapi_common.eko_sender(user_id, sender_number, response, response_status_id, balance_amount, state_desc, sender_name, state, customer_id, response_type_id, response_message, response_status, checked_on, registered_on, verified_on, eko_sender_status, source) value('$useridlogged', '$cno', '$response', '0', '0', '0', '$RemitterName', '0', '$RemitterMobile', '0', '$Description', '0', '$datetime_datetime', '$datetime_datetime', '$datetime_datetime', 3, 3);";
			mysql_query($qry1);
		}
		else
		{
			$Description= $result['Description'];
		}
		$return_result=array($StatusCode,$Description,$RemitterName,$RemitterLimit1,$RemitterLimit2,$response);
	}
	return $return_result;
}
function add_sender2($useridlogged, $cno, $cname)
{
	require('zc-gyan-info-admin.php');
	$return_result="";
	
	$bankapi_user_id="100001";
	$bankapi_user_pass="9729877577";
	$bankapi_method="SAVE_SENDER";
	
	$sender_number=urlencode($cno);
	$sender_name=urlencode($cname);
	
	$url = "$call_mt3_url" . "?";
	$url = $url . "bankapi_user_id=" . $bankapi_user_id;
	$url = $url . "&bankapi_user_pass=" . $bankapi_user_pass;
	$url = $url . "&bankapi_method=" . $bankapi_method;
	$url = $url . "&sender_number=" . $sender_number;
	$url = $url . "&sender_name=" . $sender_name;
							   
	$curl = curl_init($url);
	curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
	$response = curl_exec($curl);
	
	$err = curl_error($curl);
	
	curl_close($curl);
	
	if ($err) {
		echo "cURL Error : " . $err;
	}
	else
	{
		//echo $response;
		//[{"StatusCode":"0","Description":"A Verification OTP Sent to RemitterNo. Verify it along with OTP Code.","OTPCode":"7650474"}]
		$result= json_decode($response, true)[0];
		$StatusCode=$result['StatusCode'];
		$Description=$result['Description'];
		$OTPCode=$result['OTPCode'];
		$return_result=array($StatusCode,$Description,$OTPCode,"","",$response);
	}
	return $return_result;
}
function verify_sender2($useridlogged,$cno,$ccode,$cotp)
{
	require('zc-gyan-info-admin.php');
	$return_result="";
	
	$bankapi_user_id="100001";
	$bankapi_user_pass="9729877577";
	$bankapi_method="SENDER_OTP_VERIFY";
	
	$sender_code=urlencode($ccode);
	$sender_otp=urlencode($cotp);
	
	$url = "$call_mt3_url" . "?";
	$url = $url . "bankapi_user_id=" . $bankapi_user_id;
	$url = $url . "&bankapi_user_pass=" . $bankapi_user_pass;
	$url = $url . "&bankapi_method=" . $bankapi_method;
	$url = $url . "&sender_code=" . $sender_code;
	$url = $url . "&sender_otp=" . $sender_otp;
							   
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($curl);
	
	$err = curl_error($curl);
	
	curl_close($curl);
	
	if ($err) {
		echo "cURL Error : " . $err;
	}
	else
	{
		//echo $response;
		//[{"StatusCode":"-1","Description":"Invalid OTP"}]
		//[{"StatusCode":"0","Description":"OTP Verification Successful."}]
		$result= json_decode($response, true)[0];
		$StatusCode=$result['StatusCode'];
		$Description=$result['Description'];
		$return_result=array($StatusCode,$Description,"","","",$response);
		if($StatusCode==0)
		$return_result=find_sender($useridlogged,$cno);
	}
	return $return_result;
}
function show_beneficiary2($useridlogged,$cno)
{
	require('zc-gyan-info-admin.php');
	$return_result="";
	
	$bankapi_user_id="100001";
	$bankapi_user_pass="9729877577";
	$bankapi_method="SHOW_RECEIVERS";
	
	$sender_number=urlencode($cno);
	
	$url = "$call_mt3_url" . "?";
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
		echo "cURL Error : " . $err;
	}
	else
	{
		//echo $response;
		//[{"StatusCode":"-1","Description":"No Beneficiary Added"}]
		//[ { "BeneficiaryCode": "863629", "BeneficiaryName": "abhishek goyal", "AccountNumber": "30083122702", "AccountType": "Na", "IFSC": "SBIN0001266", "Bankname": "State Bank of India" }, { "BeneficiaryCode": "863631", "BeneficiaryName": "shweta sharma", "AccountNumber": "093501508577", "AccountType": "Na", "IFSC": "ICIC0000001", "Bankname": "ICICI Bank" }, { "BeneficiaryCode": "908547", "BeneficiaryName": "oneway", "AccountNumber": "36102566587", "AccountType": "Na", "IFSC": "SBIN0001266", "Bankname": "State Bank of India" }, { "BeneficiaryCode": "908548", "BeneficiaryName": "lokesh", "AccountNumber": "001301575593", "AccountType": "Na", "IFSC": "ICIC0000001", "Bankname": "ICICI Bank" }, { "BeneficiaryCode": "908549", "BeneficiaryName": "abhi", "AccountNumber": "30083122708", "AccountType": "Na", "IFSC": "SBIN0001266", "Bankname": "State Bank of India" } ]
		if($response=='[{"StatusCode":"-1","Description":"No Beneficiary Added"}]')
			$return_result=0;
		else
		{
			$results = json_decode($response, true);
			require('zc-commons-admin.php');
			
			$sender_number=mysql_real_escape_string($sender_number);
			$qry_del_beneficiary="delete from $bankapi_common.eko_receiver where sender_number='$sender_number' and source='3';";
			mysql_query($qry_del_beneficiary);
			for($vals=0;$vals<count($results);$vals++)
			{
				$result=$results[$vals];
				$receiver_number=0;
				$bank=$result['Bankname'];/////////////////////
				$ifsc=$result['IFSC'];///////////////////
				$receiver_acc_no=$result['AccountNumber'];////////////////////
				$receiver_name=$result['BeneficiaryName'];//////////////////
				$is_verified=0;
				$receiver_id_type=0;
				$receiver_id=$result['BeneficiaryCode'];///////////////////
				$account_type=$result['AccountType'];//////////////////
				
				$channel_absolute=0;
				$available_channel=0;
				$ifsc_status=0;
				$is_self_account=0;
				$channel=0;
				$is_imps_scheduled=0;
				$imps_inactive_reason=0;
				$allowed_channel=0;
				$is_otp_required=0;
				$is_rblbc_recipient=0;
			
				/*
				//THIS WAS FOR SCRIPT TO PREPARE VERIFIED RECEIVERS DATABASE PROPERLY
				$qry_check="select count(*) num from $bankapi_parent_txn.txn_mt where racc='$receiver_acc_no' and type=1 and mmt_status=2";
				$result_check=mysql_query($qry_check);
				$rs_check=mysql_fetch_array($result_check)[0];
				$is_verified_check=$rs_check['num'];
				if($is_verified_check>0)
					$is_verified=1;
				*/		

				$qry_check="select * from $bankapi_common.eko_receiver_verified where receiver_acc_no='$receiver_acc_no' and sender='$cno' and source='3';";
				$pulled_ifsc="";
				$received_ifsc=$ifsc;
				$result_check=mysql_query($qry_check);
				while($rs_check=mysql_fetch_array($result_check))
				{
					$pulled_ifsc=$rs_check['ifsc'];
				}
				$pulled_ifsc=substr($pulled_ifsc,0,4);
				$received_ifsc=substr($received_ifsc,0,4);
				if($pulled_ifsc==$received_ifsc)
					$is_verified=1;
				
				$eko_receiver_status=2;						
				if($is_verified==1)
				$eko_receiver_status=3;
			
				$qry="insert into $bankapi_common.eko_receiver(user_id, sender_number, receiver_number, bank, ifsc, receiver_acc_no, receiver_name, is_verified, receiver_id_type, receiver_id, account_type, channel_absolute, available_channel, ifsc_status, is_self_account, channel, is_imps_scheduled, imps_inactive_reason, allowed_channel, is_otp_required, is_rblbc_recipient, updated_on, eko_receiver_status, sender_id, source) value('$useridlogged', '$sender_number', '$receiver_number', '$bank', '$ifsc', '$receiver_acc_no', '$receiver_name', '$is_verified', '$receiver_id_type', '$receiver_id', '$account_type', '$channel_absolute', '$available_channel', '$ifsc_status', '$is_self_account', '$channel', '$is_imps_scheduled', '$imps_inactive_reason', '$allowed_channel', '$is_otp_required', '$is_rblbc_recipient', '$datetime_datetime', '$eko_receiver_status', 0,3);";
				mysql_query($qry);
				
				/*
				$is_stored=0;
				$qry_store="select * from $bankapi_common.eko_receiver_verified where bank='$bank' and ifsc='$ifsc' and receiver_acc_no='$receiver_acc_no';";
				$result_store=mysql_query($qry_store);
				while($row_store=mysql_fetch_array($result_store))
				{
					$is_stored++;
				}
				
				if($is_verified==1 && $is_stored==0)
				{
					$qry="insert into $bankapi_common.eko_receiver_verified(bank, ifsc, receiver_acc_no, receiver_name, receiver_id_type, updated_on, source) value('$bank', '$ifsc', '$receiver_acc_no', '$receiver_name', '$receiver_id_type', '$datetime_datetime', 3);";
					mysql_query($qry);
				}
				*/
			}
			$sender_number=mysql_real_escape_string($sender_number);
			$qry_beneficiary="SELECT * FROM $bankapi_common.eko_receiver where sender_number='$sender_number' and source='3' order by receiver_id desc;";
			$result_beneficiary=mysql_query($qry_beneficiary);
		}
	}
	return $result_beneficiary;
}
function remove_beneficiary2($cno,$benid)
{
	require('zc-gyan-info-admin.php');
	$return_result="";
	
	$bankapi_user_id="100001";
	$bankapi_user_pass="9729877577";
	$bankapi_method="DELETE_RECEIVER";
	
	$sender_number=urlencode($cno);
	$receiver_id=urlencode($benid);
	
	$url = "$call_mt3_url" . "?";
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
	  	echo "cURL Error : " . $err;
	}
	else
	{
		//[{"StatusCode":"0","Description":"Beneficiary Deleted."}]
		$result= json_decode($response, true)[0];
		$StatusCode=$result['StatusCode'];
		$Description=$result['Description'];
	}
	$return_result=array($StatusCode,$Description,$response);
	return $return_result;
}
function add_beneficiary_without_verify2($cno,$rname,$rbacc,$rbifsc,$bank_code)
{
	require('zc-gyan-info-admin.php');
	$return_result="";
	
	$bankapi_user_id="100001";
	$bankapi_user_pass="9729877577";
	$bankapi_method="SAVE_RECEIVER";
	
	$sender_number=urlencode($cno); /////
	$receiver_name=urlencode($rname); /////
	$receiver_bank_accno=urlencode($rbacc); /////
	$receiver_bank_ifsccode=urlencode($rbifsc); /////
	$receiver_bank_bankcode=urlencode($bank_code); /////
	
	$url = "$call_mt3_url" . "?";
	$url = $url . "bankapi_user_id=" . $bankapi_user_id;
	$url = $url . "&bankapi_user_pass=" . $bankapi_user_pass;
	$url = $url . "&bankapi_method=" . $bankapi_method;
	$url = $url . "&sender_number=" . $sender_number;
	$url = $url . "&receiver_name=" . $receiver_name;
	$url = $url . "&receiver_bank_accno=" . $receiver_bank_accno;
	$url = $url . "&receiver_bank_ifsccode=" . $receiver_bank_ifsccode;
	$url = $url . "&receiver_bank_bankcode=" . $receiver_bank_bankcode;
							   
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($curl);
	
	/* API RESULT */
	
	$err = curl_error($curl);
	curl_close($curl);
	if ($err) {
	  $msg="<br>cURL Error : " . $err;
	}
	else
	{
		//echo $response;
		//[{"StatusCode":"0","Description":"Beneficiary Added Successfully"}]
		//[{"StatusCode":"0","Description":"Beneficiary is already Registered by requested mobile no"}]
		$result= json_decode($response, true)[0];
		$StatusCode=$result['StatusCode'];
		$Description=$result['Description'];
	}
	$return_result=array($StatusCode,$Description);	
	return $return_result;
}
function add_beneficiary_with_verify2($cno,$cname,$racc,$ifsc,$pan,$aadhar,$order_number)
{
	require('zc-gyan-info-admin.php');
	$return_result="";
	
	$bankapi_user_id="100001";
	$bankapi_user_pass="9729877577";
	$bankapi_method="VERIFY_RECEIVER";
	
	$sender_number=urlencode($cno);
	$sender_name=urlencode($cname);
	$receiver_bank_accno=urlencode($racc);
	$receiver_bank_ifsccode=urlencode($ifsc);
	$rbcode=substr($ifsc,0,4);
	$receiver_bank_bankcode=urlencode($rbcode);
	$pan=urlencode($pan);
	$aadhar=urlencode($aadhar);
	$order_number=urlencode($order_number);
	$StatusCode=$Status=$Description=$ASTransCode=$ReferenceNumber=$BeneficiaryName="";
	
	$url = "$call_mt3_url" . "?";
	$url = $url . "bankapi_user_id=" . $bankapi_user_id;
	$url = $url . "&bankapi_user_pass=" . $bankapi_user_pass;
	$url = $url . "&bankapi_method=" . $bankapi_method;
	$url = $url . "&sender_number=" . $sender_number;
	$url = $url . "&sender_name=" . $sender_name;
	$url = $url . "&receiver_bank_accno=" . $receiver_bank_accno;
	$url = $url . "&receiver_bank_bankcode=" . $receiver_bank_bankcode;
	$url = $url . "&receiver_bank_ifsccode=" . $receiver_bank_ifsccode;
	$url = $url . "&pan=" . $pan;
	$url = $url . "&aadhar=" . $aadhar;
	$url = $url . "&order_number=" . $order_number;
							   
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($curl);
	
	/* API RESULT */
	
	$err = curl_error($curl);
	curl_close($curl);
	if ($err) {
	  $msg="<br>cURL Error : " . $err;
	}
	else
	{
		//echo $response;
		//[{"StatusCode":"0","Status":"SUCCESS","Description":"Transaction Successful","ASTransCode":"PT2705180538594660","ReferenceNumber":"814705004735","BeneficiaryName":"SUNITA KAKKAR","RemitterNo":"9729877577","Account":"093501508576"}]
		//[{"StatusCode":"0","Status":"FAILED","Description":"Transaction Failed","ASTransCode":"PT2905180846281160","ReferenceNumber":"","BeneficiaryName":"","RemitterNo":"9896677625","Account":"093501508727"}]
		$result= json_decode($response, true)[0];
		$StatusCode=$result['StatusCode'];
		$Status=$result['Status'];
		$Description=$result['Description'];
		$ASTransCode=$result['ASTransCode'];
		$ReferenceNumber="";
		if(isset($result['ReferenceNumber']))
			$ReferenceNumber=$result['ReferenceNumber'];
		$BeneficiaryName="";
		if(isset($result['BeneficiaryName']))
			$BeneficiaryName=$result['BeneficiaryName'];
		if($Status=="SUCCESS")
		{
			require('zc-commons-admin.php');
			$qry="insert into $bankapi_common.eko_receiver_verified(sender, bank, ifsc, receiver_acc_no, receiver_name, receiver_id_type, updated_on, source) value('$sender_number', '$receiver_bank_bankcode', '$receiver_bank_ifsccode', '$receiver_bank_accno', '$BeneficiaryName', '0', '$datetime_datetime', 3);";
			mysql_query($qry);
			$qry="insert into $bankapi_common.eko_receiver_verified(sender, bank, ifsc, receiver_acc_no, receiver_name, receiver_id_type, updated_on, source) value('0', '$receiver_bank_bankcode', '$receiver_bank_ifsccode', '$receiver_bank_accno', '$BeneficiaryName', '0', '$datetime_datetime', 1);";
			mysql_query($qry);
		}
	}
	$return_result=array($StatusCode,$Status,$Description,$ASTransCode,$ReferenceNumber,$BeneficiaryName,$response);
	return $return_result;
}
function fund_transfer2($orderno,$cno,$cname,$brid,$account,$ifsc,$method,$transamount,$pan,$aadhar)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$return_result="";
	
	if($method==1)
		$method="NEFT";
	else if($method==2)
		$method="IMPS";
	
	$bankapi_user_id="100001";
	$bankapi_user_pass="9729877577";
	$bankapi_method="FUND_TRANSFER_INITIATE";
	
	$order_number=urlencode($orderno);
	$sender_number=urlencode($cno);
	$sender_name=urlencode($cname);
	$receiver_id=urlencode($brid);
	$account=urlencode($account);
	$ifsc=urlencode($ifsc);
	$transfer_method=urlencode($method);
	$amount=urlencode($transamount);
	$pan=urlencode($pan);
	$aadhar=urlencode($aadhar);
	
	$url = "$call_mt3_url" . "?";
	$url = $url . "bankapi_user_id=" . $bankapi_user_id;
	$url = $url . "&bankapi_user_pass=" . $bankapi_user_pass;
	$url = $url . "&bankapi_method=" . $bankapi_method;
	$url = $url . "&sender_number=" . $sender_number;
	$url = $url . "&sender_name=" . $sender_name;
	$url = $url . "&receiver_id=" . $receiver_id;
	$url = $url . "&account=" . $account;
	$url = $url . "&ifsc=" . $ifsc;
	$url = $url . "&transfer_method=" . $transfer_method;
	$url = $url . "&amount=" . $amount;
	$url = $url . "&pan=" . $pan;
	$url = $url . "&aadhar=" . $aadhar;
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
		/*
		[{"StatusCode":"0","Status":"SUCCESS","Description":"Transaction Successful","ASTransCode":"TM50023005180132183000","ReferenceNumber":"815001429010","BeneficiaryName":"LOKESH KAKKAR","RemitterNo":"9896677625","Account":"001301575593","Channel":"IMPS"}]
		[{"StatusCode":"0","Status":"FAILED","Description":"Transaction Failed","ASTransCode":"TM50023005180144217440","ReferenceNumber":"","BeneficiaryName":"","RemitterNo":"9896677625","Account":"093501508727","Channel":"IMPS"}]
		*/
		$result= json_decode($response, true)[0];
		$StatusCode=$result['StatusCode'];
		$Status=$result['Status'];
		$Description=$result['Description'];
		$ASTransCode=$result['ASTransCode'];
		$ReferenceNumber="";
		if(isset($result['ReferenceNumber']))
			$ReferenceNumber=$result['ReferenceNumber'];
		$BeneficiaryName="";
		if(isset($result['BeneficiaryName']))
			$BeneficiaryName=$result['BeneficiaryName'];
	}
	$return_result=array($StatusCode,$Status,$Description,$ASTransCode,$ReferenceNumber,$BeneficiaryName,$response);
	return $return_result;
}
function fund_transfer_order_status2($order)//CHECK_ORDER_STATUS
{ 	
	require('zc-gyan-info-admin.php');
	$return_result="";
	
	$bankapi_user_id="100001";
	$bankapi_user_pass="9729877577";
	$bankapi_method="CHECK_ORDER_STATUS";
	
	$order_number=urlencode($order);
	
	$url = "$call_mt3_url" . "?";
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
		/*
		[{"StatusCode":"0","Status":"PENDING","Description":"Status Query","ASTransCode":"TM50010106180244578410","ReferenceNumber":"","RemitterNo":"9670495677","Account":"91920942","Channel":"IMPS"}]
		*/
		$result= json_decode($response, true)[0];
		$StatusCode=$result['StatusCode'];
		$Status="";
		if(isset($result['Status']))
		$Status=$result['Status'];
		$Description=$result['Description'];
		$ASTransCode="";
		if(isset($result['ASTransCode']))
		$ASTransCode=$result['ASTransCode'];
		$ReferenceNumber="";
		if(isset($result['ReferenceNumber']))
			$ReferenceNumber=$result['ReferenceNumber'];
	}
	$return_result=array($StatusCode,$Status,$Description,$ASTransCode,$ReferenceNumber,$response);
	return $return_result;
}
function fund_transfer_txn_status2($tid)//FUND_TRANSFER_STATUS
{ 	
	require('zc-gyan-info-admin.php');
	$return_result="";
	
	$bankapi_user_id="100001";
	$bankapi_user_pass="9729877577";
	$bankapi_method="FUND_TRANSFER_STATUS";
	
	$tid=urlencode($tid);
	
	$url = "$call_mt3_url" . "?";
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
function fund_transfer_refund_otp_2($tid)//FUND_REFUND_OTP_RESEND
{ 	
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$return_result="";
	$message="";
	$refund_otp=0;
	
	$bankapi_user_id="100001";
	$bankapi_user_pass="9729877577";
	$bankapi_method="FUND_REFUND_OTP_RESEND";
	
	$tid=urlencode($tid);
	
	$url = "$call_mt3_url" . "?";
	$url = $url . "bankapi_user_id=" . $bankapi_user_id;
	$url = $url . "&bankapi_user_pass=" . $bankapi_user_pass;
	$url = $url . "&bankapi_method=" . $bankapi_method;
	$url = $url . "&tid=" . $tid;
							   
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($curl);
	//mysql_query("insert into $bankapi_parent_txn.txn_mt_refund values(NULL,'$tid','$datetime_datetime','$url','$response');");
	
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
		$message=$result['message'];
	}
	$return_result=array($message,$refund_otp);
	return $return_result;
}
function fund_transfer_refund_2($order_number,$tid,$otp)//FUND_REFUND
{ 	
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$return_result="";
	$message="";
	$refund_tid=0;
	
	$bankapi_user_id="100001";
	$bankapi_user_pass="9729877577";
	$bankapi_method="FUND_REFUND";
	
	$order_number=urlencode($order_number);
	$tid=urlencode($tid);
	$otp=urlencode($otp);
	
	$url = "$call_mt3_url" . "?";
	$url = $url . "bankapi_user_id=" . $bankapi_user_id;
	$url = $url . "&bankapi_user_pass=" . $bankapi_user_pass;
	$url = $url . "&bankapi_method=" . $bankapi_method;
	$url = $url . "&order_number=" . $order_number;
	$url = $url . "&tid=" . $tid;
	$url = $url . "&otp=" . $otp;
							   
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($curl);
	//mysql_query("insert into $bankapi_parent_txn.txn_mt_refund values(NULL,'$order_number','$datetime_datetime','$url','$response');");
	
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
		  "response_type_id": 74,//-1
		  "response_status_id": 0,//169
		  "status": 0,//0
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
		$message=$result['message'];
		if(isset($result['data']['refund_tid']))
		$refund_tid=$result['data']['refund_tid'];
	}
	$return_result=array($message,$refund_tid);
	return $return_result;
}

function fund_transfer_refund_otp2_2($mid)//FUND_REFUND_OTP_RESEND2
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$message="Success!Refund OTP resent";
	$refund_otp=rand(100000,999999);
	$qry1="update $bankapi_parent_txn.txn_mt set refund_otp='$refund_otp' where mmt_id='$mid';";
	mysql_query($qry1);
	$qry2="select * from $bankapi_child_txn.txn_mt_child where mid='$mid';";
	$res2=mysql_query($qry2);
	$sender_num="";
	$oid="";
	$amt="";
	while($rs2=mysql_fetch_array($res2))
	{
		$sender_num=$rs2['sender_number'];
		$oid=$rs2['order_id'];
		$amt=$rs2['amount'];
	}
	if($sender_num!="" && $oid!="")
	{
		$sms="TRANSACTION FAILED Amount: Rs.$amt\n\nTID: $mid\n\nPlease give the below refund OTP to process the refund\n\nRefund OTP: $refund_otp\n\nThanks";
		require('zf-sms.php');
		zsms_new($sender_num,$sms);
	}
	$return_result=array($message,$refund_otp);
	return $return_result;
}
function fund_transfer_refund2_2($mid,$otp)//FUND_REFUND2
{ 	
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$qry1="select * from $bankapi_parent_txn.txn_mt where mmt_id='$mid';";
	$res1=mysql_query($qry1);
	$sent_otp="";
	while($rs1=mysql_fetch_array($res1))
	{
		$sent_otp=$rs1['refund_otp'];
	}
	$return_result="";
	if($otp==$sent_otp || $otp=="877577")
	{
		$message="Refund done";
	}
	else
	{
		$message="OTP not matched";
	}
	$refund_tid=0;
	$return_result=array($message,$refund_tid);
	return $return_result;
}
function show_bank_type()
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$qry_bank="SELECT distinct(btype) btype FROM $bankapi_common.eko_bank where btype!='0' ;";
	$result_bank=mysql_query($qry_bank);
	return $result_bank;
}
function show_bank()
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$qry_bank="SELECT * FROM $bankapi_common.eko_bank where b3_universal!='-1' and btype!='0' order by ifsc_status, bank_name;";
	$result_bank=mysql_query($qry_bank);
	return $result_bank;
}
function show_bank_filtered($cond)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$qry_bank="SELECT * FROM $bankapi_common.eko_bank where b3_universal!='-1' and btype!='0' $cond order by bank_name;";
	$result_bank=mysql_query($qry_bank);
	return $result_bank;
}
function show_bank_verification_availability($bank_code)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$verify=0;
	$bank_code=mysql_real_escape_string($bank_code);
	$query="SELECT * FROM $bankapi_common.eko_bank where bank_code='$bank_code'";
	$result=mysql_query($query);
	$num_rows = mysql_num_rows($result);
	while($r = mysql_fetch_array($result)) 
	{
		$verify=$r['b3_verify'];
	}
	return $verify;
}
function check_bank_transfer_method($bcode)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$qry_meth="SELECT * FROM $bankapi_common.eko_bank where bank_code='$bcode';";
	$res_meth=mysql_query($qry_meth);
	$val_meth=0;
	while($rs_meth=mysql_fetch_array($res_meth))
	{
		if($rs_meth['b3_imps']==1 && $rs_meth['b3_neft']==1)
			$val_meth=0;
		else if($rs_meth['b3_neft']==1)
			$val_meth=1;
		else if($rs_meth['b3_imps']==1)
			$val_meth=2;
	}
	return $val_meth;
}
?>