<?php

$web_ip=$_SERVER["REMOTE_ADDR"];//127.0.0.1
$web_site=$_SERVER['HTTP_HOST'];//localhost

$web_user_id="";
if(isset($_POST['blyss_profile_id']))
$web_user_id=$_POST['blyss_profile_id'];

$web_user_key="";
if(isset($_POST['blyss_access_key']))
$web_user_key=$_POST['blyss_access_key'];

$web_access_method="";
if(isset($_POST['blyss_access_method']))
$web_access_method=$_POST['blyss_access_method'];

if($web_ip!="" && $web_site!="" && $web_user_id!="" && $web_user_key!="" && $web_access_method)
common_check($web_ip, $web_site, $web_user_id, $web_user_key, $web_access_method);

function common_check($web_ip, $web_site, $web_user_id, $web_user_key, $web_access_method)
{
	$res_code="";
	$res_message="";
	$res_data=array();
	require('../zc-gyan-info-admin.php');
	require('../zc-common-admin-api.php');
	$res_key="";
	$res_status="";
	$res_site="";
	$res_ip="";
	
	$web_user_id=mysql_real_escape_string($web_user_id);
	$qry="select * from $bankapi_child_base.api_user where user_id='$web_user_id';";
	$res=mysql_query($qry);
	$total_records=mysql_num_rows($res);
	while($rs=mysql_fetch_array($res))
	{
		$res_key=$rs['api_key'];
		$res_status=$rs['api_status'];
		$res_site=$rs['website'];
		$res_ip=$rs['ip'];
	}
	
	if($web_user_id=="")
	{
		$res_code="1001";
		$res_message="BlyssAPI BlyssProfileId should not be Empty.";
	}
	else if($total_records==0)
	{
		$res_code="1002";
		$res_message="BlyssAPI BlyssProfileId is Invalid.";
	}/*
	else if($res_site!=$web_site)
	{
		$res_code="1003";
		$res_message="BlyssAPI WhiteList Site is Invalid.";
	}
	else if($res_ip!=$web_ip)
	{
		$res_code="1004";
		$res_message="BlyssAPI WhiteList IP is Invalid.";
	}*/
	else if($web_user_key=="")
	{
		$res_code="1005";
		$res_message="BlyssAPI BlyssAccessKey should not be Empty.";
	}
	else if($res_key!=$web_user_key)
	{
		$res_code="1006";
		$res_message="BlyssAPI BlyssAccessKey is Invalid.";
	}
	else if($res_status==0)
	{
		$res_code="1007";
		$res_message="BlyssAPI is Blocked for BlyssProfileId $web_user_id.";
	}
	else if($web_access_method=="")
	{
		$res_code="1008";
		$res_message="BlyssAPI BlyssAccessMethod should not be Empty.";
	}
	else if($web_access_method!="ShowProfile"//
			&& $web_access_method!="ShowServices"//
			&& $web_access_method!="ShowOperators"//
			
			&& $web_access_method!="ShowWalletBalance"
			&& $web_access_method!="ShowWalletHistory"
			
			//&& $web_access_method!="ShowWalletRequests" /////////////////////////////////
			//&& $web_access_method!="SendWalletRequest" /////////////////////////////////
			//&& $web_access_method!="CheckWalletRequestStatus" /////////////////////////////////
			
			//&& $web_access_method!="ShowSupportTickets" /////////////////////////////////
			//&& $web_access_method!="SendSupoortTicket" /////////////////////////////////
			//&& $web_access_method!="CheckSupportTicketStatus" /////////////////////////////////
			
			&& $web_access_method!="ShowMoneyRemittanceBanks"
			&& $web_access_method!="ShowRegisteredSender"
			&& $web_access_method!="RegisterSender"
			&& $web_access_method!="VerifySenderByOtp"			
			
			&& $web_access_method!="ShowReceiversBySender"
			&& $web_access_method!="DeleteReceiverBySender"
			&& $web_access_method!="SaveReceiverBySender"
			&& $web_access_method!="VerifyReceiverBySender" /////////////////////////////////
			
			//&& $web_access_method!="ShowTransactions" /////////////////////////////////

			&& $web_access_method!="StartMoneyTransferBySender" /////////////////////////////////
			&& $web_access_method!="CheckMoneyTransferStatusByYtno" /////////////////////////////////
			//&& $web_access_method!="MoneyTransferRefundSendOtp"
			//&& $web_access_method!="MoneyTransferRefundVerifyOtp"
			
			//&& $web_access_method!="ShowPrepaidCircles"
			//&& $web_access_method!="ShowPrepaidCircleOperatorByMobileNumber"
			//&& $web_access_method!="ShowPrepaidPlanByCircleOperator"
			
			//&& $web_access_method!="StartRechargeTransaction"
			//&& $web_access_method!="CheckRechargeStatusByCid"
			)
	{
		$res_code="1009";
		$res_message="BlyssAPI BlyssAccessMethod is Invalid.";
	}
	else if($web_access_method=="ShowProfile")
	{
		$user_name="";
		$e_mail="";
		$user_contact_no="";
		$address="";
		$city_name="";
		$gender="";
		$aadhar_no="";
		$pancard_no="";
		$kyc_status="";
		$bank="";
		$ifsc="";
		$account="";
		$gst="";
		$business_name="";
		$business_address="";		
		
		$qry2="select * from $bankapi_child_base.child_user where user_id='$web_user_id';";
		$res2=mysql_query($qry2);
		$total_records2=mysql_num_rows($res2);
		while($rs2=mysql_fetch_array($res2))
		{
			$user_name=$rs2['user_name'];
			$e_mail=$rs2['e_mail'];
			$user_contact_no=$rs2['user_contact_no'];
			$address=$rs2['address'];
			$city_name=$rs2['city_name'];
			$gender=$rs2['gender'];
			if($gender==1)
				$gender="Male";
			else if($gender==0)
				$gender="Female";
			else if($gender==-1)
				$gender="TransGender";
		}
		$qry3="select * from $bankapi_child_base.child_userinfo_walletkyc where user_id='$web_user_id';";
		$res3=mysql_query($qry3);
		$total_records3=mysql_num_rows($res3);
		while($rs3=mysql_fetch_array($res3))
		{
			$aadhar_no=$rs3['aadhar_no'];
			$pancard_no=$rs3['pancard_no'];
			$kyc_status=$rs3['kyc_status'];
			if($kyc_status==0)
				$kyc_status="Pending";
			else if($kyc_status==1 || $kyc_status==2)
				$kyc_status="Uploaded";
			else if($kyc_status==3)
				$kyc_status="Verified";
			else if($kyc_status==4)
				$kyc_status="Rejected";
			$bank=$rs3['bank'];
			$ifsc=$rs3['ifsc'];
			$account=$rs3['account'];
			$gst=$rs3['gst'];
			$business_name=$rs3['business_name'];
			$business_address=$rs3['business_address'];
		}
		if($total_records2==0 || $total_records3==0)
		{
			$res_code="1010";
			$res_message="BlyssAPI BlyssProfileId is Incomplete for METHOD $web_access_method";
		}
		else
		{
			$res_code="0";
			$res_message="BlyssAPI Call Successful for METHOD $web_access_method";
			$res_data=array("blyss_profile_id"=>$web_user_id, 
						"profile_name"=>$user_name, 
						"profile_email"=>$e_mail, 
						"profile_contact"=>$user_contact_no, 
						"profile_address"=>$address, 
						"profile_city"=>$city_name, 
						"profile_gender"=>$gender, 
						"profile_aadhar_no"=>$aadhar_no, 
						"profile_pancard_no"=>$pancard_no, 
						"profile_kyc"=>$kyc_status, 
						"profile_bank_name"=>$bank, 
						"profile_bank_ifsc"=>$ifsc, 
						"profile_bank_account_no"=>$account, 
						"profile_gst_no"=>$gst, 
						"profile_business_name"=>$business_name, 
						"profile_business_address"=>$business_address);
		}
	}
	else if($web_access_method=="ShowServices")
	{
		$res_code="0";
		$res_message="BlyssAPI Call Successful for METHOD $web_access_method";
		$res_data=array();
		
		$qry2="select service_code blyss_service_code, service_name blyss_service_name from $bankapi_child_base.api_user_service where user_id='$web_user_id' and service_status=1;";
		$res2=mysql_query($qry2);
		while($rs2=mysql_fetch_assoc($res2))
		{
			 $res_data[] = $rs2;
		}
	}
	else if($web_access_method=="ShowOperators")
	{
		$web_service_code="";
		if(isset($_POST['blyss_service_code']))
		$web_service_code=$_POST['blyss_service_code'];
		$web_service_code=mysql_real_escape_string($web_service_code);
	
		if($web_service_code=="")
		{
			$res_code="1011";
			$res_message="BlyssAPI BlyssServiceCode should not be Empty for METHOD $web_access_method";
		}
		else if($web_service_code!="")
		{
			$qry2="select * from $bankapi_child_base.api_user_service where user_id='$web_user_id' and service_status=1 and service_code='$web_service_code';";
			$res2=mysql_query($qry2);
			$total_records3=mysql_num_rows($res2);
		
			if($total_records3==0)
			{
				$res_code="1012";
				$res_message="BlyssAPI BlyssServiceCode is Invalid for METHOD $web_access_method";
			}
			else
			{
				$res_code="0";
				$res_message="BlyssAPI Call Successful for METHOD $web_access_method";
				$res_data=array();
				
				$web_fields="operator_code blyss_operator_code, operator_name blyss_operator_name";
				if($web_service_code==1)
				{
					$web_fields="operator_code blyss_operator_code, operator_name blyss_operator_name, 'SURCHARGE' type, charges_out charges_commission";
				}
				else if($web_service_code==2 || $web_service_code==3 || $web_service_code==4)
				{
					$web_fields="operator_code blyss_operator_code, operator_name blyss_operator_name, 'COMMISSION' type, margin_out charges_commission";
				}
					
				$qry2="select $web_fields from $bankapi_child_base.api_user_service_operator where user_id='$web_user_id' and operator_status=1 and service_code='$web_service_code';";
				$res2=mysql_query($qry2);
				while($rs2=mysql_fetch_assoc($res2))
				{
					 $res_data[] = $rs2;
				}
			}
		}
	}
	else if($web_access_method=="ShowWalletBalance")
	{
		$res_code="0";
		$res_message="BlyssAPI Call Successful for METHOD $web_access_method";
		
		$amount_bal=show_wallet_balance($web_user_id);
		$res_data=array("blyss_profile_id"=>$web_user_id, 
						"current_wallet_balance"=>$amount_bal);
	}
	else if($web_access_method=="ShowWalletHistory")
	{
		$web_wallet_date="";
		if(isset($_POST['blyss_wallet_history_date']))
		$web_wallet_date=$_POST['blyss_wallet_history_date'];
		$web_wallet_date=mysql_real_escape_string($web_wallet_date);
	
		if($web_wallet_date=="")
		{
			$res_code="1013";
			$res_message="BlyssAPI BlyssWalletHistoryDate should not be Empty for METHOD $web_access_method";
		}
		else
		{
			$res_code="0";
			$res_message="BlyssAPI Call Successful for METHOD $web_access_method";
			
			$res_data=show_wallet_history($web_user_id,$web_wallet_date);
		}
	}
	else if($web_access_method=="ShowRegisteredSender")
	{
		$web_service_code="";
		if(isset($_POST['blyss_service_code']))
		$web_service_code=$_POST['blyss_service_code'];
		$web_service_code=mysql_real_escape_string($web_service_code);
		
		$web_service_tpin="";
		if(isset($_POST['blyss_service_tpin']))
		$web_service_tpin=$_POST['blyss_service_tpin'];
		$web_service_tpin=mysql_real_escape_string($web_service_tpin);
		
		$web_sender_mobile="";
		if(isset($_POST['blyss_sender_mobile']))
		$web_sender_mobile=$_POST['blyss_sender_mobile'];
		$web_sender_mobile=mysql_real_escape_string($web_sender_mobile);
	
		if($web_service_code=="")
		{
			$res_code="1014";
			$res_message="BlyssAPI BlyssServiceCode should not be Empty for METHOD $web_access_method";
		}
		else if($web_service_tpin=="")
		{
			$res_code="1015";
			$res_message="BlyssAPI BlyssServiceTpin should not be Empty for METHOD $web_access_method";
		}
		else if($web_service_code!=""  && $web_service_tpin!="")
		{
			$qry3="select * from $bankapi_child_base.api_user_service where user_id='$web_user_id' and service_code='$web_service_code' and service_pin='$web_service_tpin' and service_status=1;";
			$res3=mysql_query($qry3);
			$total_records3=mysql_num_rows($res3);
			if($total_records3==0)
			{
				$res_code="1016";
				$res_message="BlyssAPI BlyssProfileId, BlyssServiceCode, BlyssServiceTpin not authorized for METHOD $web_access_method";
			}
			else if($web_sender_mobile=="")
			{
				$res_code="1101";
				$res_message="BlyssAPI BlyssSenderMobile should not be Empty for METHOD $web_access_method";
			}
			else
			{
				$res_data=find_sender_blyss_api($web_user_id,$web_sender_mobile);
				$bdesc=$res_data[0]['blyss_description'];
				if($bdesc=="Sender Mobile should have only digits")
				{
					$res_code="1102";
					$res_message="BlyssAPI BlyssSenderMobile has Invalid Format for METHOD $web_access_method";
				}
				else if($bdesc=="Sender Mobile should start with 6,7,8 or 9 only")
				{
					$res_code="1103";
					$res_message="BlyssAPI BlyssSenderMobile has Invalid Format for METHOD $web_access_method";
				}
				else if($bdesc=="Sender Mobile should have 10 digits only")
				{
					$res_code="1104";
					$res_message="BlyssAPI BlyssSenderMobile has Invalid Format for METHOD $web_access_method";
				}
				else if($bdesc=="Sender Mobile does not exist in Blyss. Please Register Sender Mobile on Blyss for Money Remittance.")
				{
					$res_code="1105";
					$res_message="BlyssAPI BlyssSenderMobile does not exist for METHOD $web_access_method";
				}
				else
				{
					$res_code="0";
					$res_message="BlyssAPI Call Successful for METHOD $web_access_method";
				}
			}
		}
	}
	else if($web_access_method=="RegisterSender")
	{
		$web_service_code="";
		if(isset($_POST['blyss_service_code']))
		$web_service_code=$_POST['blyss_service_code'];
		$web_service_code=mysql_real_escape_string($web_service_code);
		
		$web_service_tpin="";
		if(isset($_POST['blyss_service_tpin']))
		$web_service_tpin=$_POST['blyss_service_tpin'];
		$web_service_tpin=mysql_real_escape_string($web_service_tpin);
		
		$web_sender_mobile="";
		if(isset($_POST['blyss_sender_mobile']))
		$web_sender_mobile=$_POST['blyss_sender_mobile'];
		$web_sender_mobile=mysql_real_escape_string($web_sender_mobile);
		
		$web_sender_name="";
		if(isset($_POST['blyss_sender_name']))
		$web_sender_name=$_POST['blyss_sender_name'];
		$web_sender_name=mysql_real_escape_string($web_sender_name);
	
		if($web_service_code=="")
		{
			$res_code="1014";
			$res_message="BlyssAPI BlyssServiceCode should not be Empty for METHOD $web_access_method";
		}
		else if($web_service_tpin=="")
		{
			$res_code="1015";
			$res_message="BlyssAPI BlyssServiceTpin should not be Empty for METHOD $web_access_method";
		}
		else if($web_service_code!=""  && $web_service_tpin!="")
		{
			$qry3="select * from $bankapi_child_base.api_user_service where user_id='$web_user_id' and service_code='$web_service_code' and service_pin='$web_service_tpin' and service_status=1;";
			$res3=mysql_query($qry3);
			$total_records3=mysql_num_rows($res3);
			if($total_records3==0)
			{
				$res_code="1016";
				$res_message="BlyssAPI BlyssProfileId, BlyssServiceCode, BlyssServiceTpin not authorized for METHOD $web_access_method";
			}
			else if($web_sender_mobile=="")
			{
				$res_code="1106";
				$res_message="BlyssAPI BlyssSenderMobile should not be Empty for METHOD $web_access_method";
			}
			else if($web_sender_name=="")
			{
				$res_code="1107";
				$res_message="BlyssAPI BlyssSenderName should not be Empty for METHOD $web_access_method";
			}
			else
			{
				$res_data=add_sender_blyss_api($web_user_id,$web_sender_mobile,$web_sender_name);
				$bdesc=$res_data[0]['blyss_description'];
				if($bdesc=="Sender Mobile should have only digits")
				{
					$res_code="1108";
					$res_message="BlyssAPI BlyssSenderMobile has Invalid Format for METHOD $web_access_method";
				}
				else if($bdesc=="Sender Mobile should start with 6,7,8 or 9 only")
				{
					$res_code="1109";
					$res_message="BlyssAPI BlyssSenderMobile has Invalid Format for METHOD $web_access_method";
				}
				else if($bdesc=="Sender Mobile should have 10 digits only")
				{
					$res_code="1110";
					$res_message="BlyssAPI BlyssSenderMobile has Invalid Format for METHOD $web_access_method";
				}
				else if($bdesc=="Invalid Sender Name. Sender Name should have alphabets and space only. Dont use special characters and numbers in Sender Name.")
				{
					$res_code="1111";
					$res_message="BlyssAPI BlyssSenderName has Invalid Format for METHOD $web_access_method";
				}
				else
				{
					$res_code="0";
					$res_message="BlyssAPI Call Successful for METHOD $web_access_method";
				}
			}
		}
	}
	else if($web_access_method=="VerifySenderByOtp")
	{
		$web_service_code="";
		if(isset($_POST['blyss_service_code']))
		$web_service_code=$_POST['blyss_service_code'];
		$web_service_code=mysql_real_escape_string($web_service_code);
		
		$web_service_tpin="";
		if(isset($_POST['blyss_service_tpin']))
		$web_service_tpin=$_POST['blyss_service_tpin'];
		$web_service_tpin=mysql_real_escape_string($web_service_tpin);
		
		$web_otp_ref_no="";
		if(isset($_POST['blyss_otp_ref_no']))
		$web_otp_ref_no=$_POST['blyss_otp_ref_no'];
		$web_otp_ref_no=mysql_real_escape_string($web_otp_ref_no);
		
		$web_otp="";
		if(isset($_POST['blyss_otp']))
		$web_otp=$_POST['blyss_otp'];
		$web_otp=mysql_real_escape_string($web_otp);
	
		if($web_service_code=="")
		{
			$res_code="1014";
			$res_message="BlyssAPI BlyssServiceCode should not be Empty for METHOD $web_access_method";
		}
		else if($web_service_tpin=="")
		{
			$res_code="1015";
			$res_message="BlyssAPI BlyssServiceTpin should not be Empty for METHOD $web_access_method";
		}
		else if($web_service_code!=""  && $web_service_tpin!="")
		{
			$qry3="select * from $bankapi_child_base.api_user_service where user_id='$web_user_id' and service_code='$web_service_code' and service_pin='$web_service_tpin' and service_status=1;";
			$res3=mysql_query($qry3);
			$total_records3=mysql_num_rows($res3);
			if($total_records3==0)
			{
				$res_code="1016";
				$res_message="BlyssAPI BlyssProfileId, BlyssServiceCode, BlyssServiceTpin not authorized for METHOD $web_access_method";
			}
			else if($web_otp_ref_no=="")
			{
				$res_code="1112";
				$res_message="BlyssAPI BlyssOtpRefNo should not be Empty for METHOD $web_access_method";
			}
			else if($web_otp=="")
			{
				$res_code="1113";
				$res_message="BlyssAPI BlyssOtp should not be Empty for METHOD $web_access_method";
			}
			else
			{
				$res_data=verify_sender_blyss_api($web_user_id,$web_otp_ref_no,$web_otp);
				$bdesc=$res_data[0]['blyss_description'];
				if($bdesc=="BlyssOTP is Invalid")
				{
					$res_code="1114";
					$res_message="BlyssAPI BlyssOTP is Invalid for METHOD $web_access_method";
				}
				else if($bdesc=="BlyssOTP Verified Successfully")
				{
					$res_code="0";
					$res_message="BlyssAPI Call Successful for METHOD $web_access_method";
				}
			}
		}
	}
	else if($web_access_method=="ShowReceiversBySender")
	{
		$web_service_code="";
		if(isset($_POST['blyss_service_code']))
		$web_service_code=$_POST['blyss_service_code'];
		$web_service_code=mysql_real_escape_string($web_service_code);
		
		$web_service_tpin="";
		if(isset($_POST['blyss_service_tpin']))
		$web_service_tpin=$_POST['blyss_service_tpin'];
		$web_service_tpin=mysql_real_escape_string($web_service_tpin);
		
		$web_sender_mobile="";
		if(isset($_POST['blyss_sender_mobile']))
		$web_sender_mobile=$_POST['blyss_sender_mobile'];
		$web_sender_mobile=mysql_real_escape_string($web_sender_mobile);
	
		if($web_service_code=="")
		{
			$res_code="1014";
			$res_message="BlyssAPI BlyssServiceCode should not be Empty for METHOD $web_access_method";
		}
		else if($web_service_tpin=="")
		{
			$res_code="1015";
			$res_message="BlyssAPI BlyssServiceTpin should not be Empty for METHOD $web_access_method";
		}
		else if($web_service_code!=""  && $web_service_tpin!="")
		{
			$qry3="select * from $bankapi_child_base.api_user_service where user_id='$web_user_id' and service_code='$web_service_code' and service_pin='$web_service_tpin' and service_status=1;";
			$res3=mysql_query($qry3);
			$total_records3=mysql_num_rows($res3);
			if($total_records3==0)
			{
				$res_code="1016";
				$res_message="BlyssAPI BlyssProfileId, BlyssServiceCode, BlyssServiceTpin not authorized for METHOD $web_access_method";
			}
			else if($web_sender_mobile=="")
			{
				$res_code="1101";
				$res_message="BlyssAPI BlyssSenderMobile should not be Empty for METHOD $web_access_method";
			}
			else
			{
				$res_data=show_beneficiary_blyss_api($web_user_id,$web_sender_mobile);
				$bdesc=$res_data[0]['blyss_description'];
				if($bdesc=="Sender Mobile should have only digits")
				{
					$res_code="1102";
					$res_message="BlyssAPI BlyssSenderMobile has Invalid Format for METHOD $web_access_method";
				}
				else if($bdesc=="Sender Mobile should start with 6,7,8 or 9 only")
				{
					$res_code="1103";
					$res_message="BlyssAPI BlyssSenderMobile has Invalid Format for METHOD $web_access_method";
				}
				else if($bdesc=="Sender Mobile should have 10 digits only")
				{
					$res_code="1104";
					$res_message="BlyssAPI BlyssSenderMobile has Invalid Format for METHOD $web_access_method";
				}
				else if($bdesc=="Sender Mobile does not exist in Blyss. Please Register Sender Mobile on Blyss for Money Remittance.")
				{
					$res_code="1105";
					$res_message="BlyssAPI BlyssSenderMobile does not exist for METHOD $web_access_method";
				}
				else
				{
					$res_code="0";
					$res_message="BlyssAPI Call Successful for METHOD $web_access_method";
				}
			}
		}
	}
	else if($web_access_method=="DeleteReceiverBySender")
	{
		$web_service_code="";
		if(isset($_POST['blyss_service_code']))
		$web_service_code=$_POST['blyss_service_code'];
		$web_service_code=mysql_real_escape_string($web_service_code);
		
		$web_service_tpin="";
		if(isset($_POST['blyss_service_tpin']))
		$web_service_tpin=$_POST['blyss_service_tpin'];
		$web_service_tpin=mysql_real_escape_string($web_service_tpin);
		
		$web_sender_mobile="";
		if(isset($_POST['blyss_sender_mobile']))
		$web_sender_mobile=$_POST['blyss_sender_mobile'];
		$web_sender_mobile=mysql_real_escape_string($web_sender_mobile);
		
		$web_receiver_id="";
		if(isset($_POST['blyss_receiver_id']))
		$web_receiver_id=$_POST['blyss_receiver_id'];
		$web_receiver_id=mysql_real_escape_string($web_receiver_id);
	
		if($web_service_code=="")
		{
			$res_code="1014";
			$res_message="BlyssAPI BlyssServiceCode should not be Empty for METHOD $web_access_method";
		}
		else if($web_service_tpin=="")
		{
			$res_code="1015";
			$res_message="BlyssAPI BlyssServiceTpin should not be Empty for METHOD $web_access_method";
		}
		else if($web_service_code!=""  && $web_service_tpin!="")
		{
			$qry3="select * from $bankapi_child_base.api_user_service where user_id='$web_user_id' and service_code='$web_service_code' and service_pin='$web_service_tpin' and service_status=1;";
			$res3=mysql_query($qry3);
			$total_records3=mysql_num_rows($res3);
			if($total_records3==0)
			{
				$res_code="1016";
				$res_message="BlyssAPI BlyssProfileId, BlyssServiceCode, BlyssServiceTpin not authorized for METHOD $web_access_method";
			}
			else if($web_sender_mobile=="")
			{
				$res_code="1101";
				$res_message="BlyssAPI BlyssSenderMobile should not be Empty for METHOD $web_access_method";
			}
			else if($web_receiver_id=="")
			{
				$res_code="1115";
				$res_message="BlyssAPI BlyssReceiverId should not be Empty for METHOD $web_access_method";
			}
			else
			{
				$res_data=remove_beneficiary_blyss_api($web_sender_mobile,$web_receiver_id);
				$res_code="0";
				$res_message="BlyssAPI Call Successful for METHOD $web_access_method";
			}
		}
	}
	else if($web_access_method=="SaveReceiverBySender")
	{
		$web_service_code="";
		if(isset($_POST['blyss_service_code']))
		$web_service_code=$_POST['blyss_service_code'];
		$web_service_code=mysql_real_escape_string($web_service_code);
		
		$web_service_tpin="";
		if(isset($_POST['blyss_service_tpin']))
		$web_service_tpin=$_POST['blyss_service_tpin'];
		$web_service_tpin=mysql_real_escape_string($web_service_tpin);
		
		$web_sender_mobile="";
		if(isset($_POST['blyss_sender_mobile']))
		$web_sender_mobile=$_POST['blyss_sender_mobile'];
		$web_sender_mobile=mysql_real_escape_string($web_sender_mobile);
		
		$web_receiver_name="";
		if(isset($_POST['blyss_receiver_name']))
		$web_receiver_name=$_POST['blyss_receiver_name'];
		$web_receiver_name=mysql_real_escape_string($web_receiver_name);
		
		$web_receiver_bank_account_no="";
		if(isset($_POST['blyss_receiver_bank_account_no']))
		$web_receiver_bank_account_no=$_POST['blyss_receiver_bank_account_no'];
		$web_receiver_bank_account_no=mysql_real_escape_string($web_receiver_bank_account_no);
		
		$web_receiver_bank_ifsc_code="";
		if(isset($_POST['blyss_receiver_bank_ifsc_code']))
		$web_receiver_bank_ifsc_code=$_POST['blyss_receiver_bank_ifsc_code'];
		$web_receiver_bank_ifsc_code=mysql_real_escape_string($web_receiver_bank_ifsc_code);
		
		$web_receiver_bank_code="";
		if(isset($_POST['blyss_receiver_bank_code']))
		$web_receiver_bank_code=$_POST['blyss_receiver_bank_code'];
		$web_receiver_bank_code=mysql_real_escape_string($web_receiver_bank_code);
	
		if($web_service_code=="")
		{
			$res_code="1014";
			$res_message="BlyssAPI BlyssServiceCode should not be Empty for METHOD $web_access_method";
		}
		else if($web_service_tpin=="")
		{
			$res_code="1015";
			$res_message="BlyssAPI BlyssServiceTpin should not be Empty for METHOD $web_access_method";
		}
		else if($web_service_code!=""  && $web_service_tpin!="")
		{
			$qry3="select * from $bankapi_child_base.api_user_service where user_id='$web_user_id' and service_code='$web_service_code' and service_pin='$web_service_tpin' and service_status=1;";
			$res3=mysql_query($qry3);
			$total_records3=mysql_num_rows($res3);
			if($total_records3==0)
			{
				$res_code="1016";
				$res_message="BlyssAPI BlyssProfileId, BlyssServiceCode, BlyssServiceTpin not authorized for METHOD $web_access_method";
			}
			else if($web_sender_mobile=="")
			{
				$res_code="1101";
				$res_message="BlyssAPI BlyssSenderMobile should not be Empty for METHOD $web_access_method";
			}
			else if($web_receiver_name=="")
			{
				$res_code="1116";
				$res_message="BlyssAPI BlyssReceiverName should not be Empty for METHOD $web_access_method";
			}
			else if($web_receiver_bank_account_no=="")
			{
				$res_code="1117";
				$res_message="BlyssAPI BlyssReceiverBankAccountNo should not be Empty for METHOD $web_access_method";
			}
			else if($web_receiver_bank_ifsc_code=="")
			{
				$res_code="1118";
				$res_message="BlyssAPI BlyssReceiverBankIfscCode should not be Empty for METHOD $web_access_method";
			}
			else if($web_receiver_bank_code=="")
			{
				$res_code="1119";
				$res_message="BlyssAPI BlyssReceiverBankCode should not be Empty for METHOD $web_access_method";
			}
			else
			{
				$res_data=add_beneficiary_blyss_api($web_sender_mobile,$web_receiver_name,$web_receiver_bank_account_no,$web_receiver_bank_ifsc_code,$web_receiver_bank_code);
				$bdesc=$res_data[0]['blyss_description'];
				if($bdesc=="Ifsc Code is Invalid")
				{
					$res_code="1120";
					$res_message="BlyssAPI BlyssReceiverBankIfscCode is Invalid Format for METHOD $web_access_method";
				}
				else if($bdesc=="Bank Code is Invalid")
				{
					$res_code="1121";
					$res_message="BlyssAPI BlyssReceiverBankCode is Invalid Format for METHOD $web_access_method";
				}
				else if($bdesc=="Sender Mobile is not Registered")
				{
					$res_code="1122";
					$res_message="BlyssAPI BlyssSenderMobile is not Registered for METHOD $web_access_method";
				}
				else
				{
					$res_code="0";
					$res_message="BlyssAPI Call Successful for METHOD $web_access_method";
				}
			}
		}
	}
	else if($web_access_method=="ShowMoneyRemittanceBanks")
	{
		$web_service_code="";
		if(isset($_POST['blyss_service_code']))
		$web_service_code=$_POST['blyss_service_code'];
		$web_service_code=mysql_real_escape_string($web_service_code);
		
		$web_service_tpin="";
		if(isset($_POST['blyss_service_tpin']))
		$web_service_tpin=$_POST['blyss_service_tpin'];
		$web_service_tpin=mysql_real_escape_string($web_service_tpin);
	
		if($web_service_code=="")
		{
			$res_code="1014";
			$res_message="BlyssAPI BlyssServiceCode should not be Empty for METHOD $web_access_method";
		}
		else if($web_service_tpin=="")
		{
			$res_code="1015";
			$res_message="BlyssAPI BlyssServiceTpin should not be Empty for METHOD $web_access_method";
		}
		else if($web_service_code!=""  && $web_service_tpin!="")
		{
			$qry3="select * from $bankapi_child_base.api_user_service where user_id='$web_user_id' and service_code='$web_service_code' and service_pin='$web_service_tpin' and service_status=1;";
			$res3=mysql_query($qry3);
			$total_records3=mysql_num_rows($res3);
			if($total_records3==0)
			{
				$res_code="1016";
				$res_message="BlyssAPI BlyssProfileId, BlyssServiceCode, BlyssServiceTpin not authorized for METHOD $web_access_method";
			}
			else
			{
				$res_code="0";
				$res_message="BlyssAPI Call Successful for METHOD $web_access_method";
				$qry2="SELECT * FROM $bankapi_common.eko_bank where b3_universal!='-1' and btype!='0' order by bank_name;";
				$res2=mysql_query($qry2);
				while($rs2=mysql_fetch_assoc($res2))
				{
					$bank_imps=$rs2['b3_imps'];
					$bank_neft=$rs2['b3_neft'];
					$bank_veri=$rs2['b3_verify'];
					$mstr_ifsc=$rs2['b3_universal'];
					if($bank_imps==1)
						$bank_imps="YES";
					else
						$bank_imps="NO";
					if($bank_neft==1)
						$bank_neft="YES";
					else
						$bank_neft="NO";
					if($bank_veri==1)
						$bank_veri="YES";
					else
						$bank_veri="NO";
					
					$res_data[] = array("bank_code"=>"".$rs2['bank_code'] ,"bank_name"=>"".$rs2['bank_name'] ,"imps_facility"=>"".$bank_imps ,"neft_facility"=>"".$bank_neft ,"verification_facility"=>"".$bank_veri ,"standard_ifsc"=>"".$mstr_ifsc);
				}
			}
		}
	}
	else if($web_access_method=="VerifyReceiverBySender")
	{
		$web_service_code="";
		if(isset($_POST['blyss_service_code']))
		$web_service_code=$_POST['blyss_service_code'];
		$web_service_code=mysql_real_escape_string($web_service_code);
		
		$web_service_tpin="";
		if(isset($_POST['blyss_service_tpin']))
		$web_service_tpin=$_POST['blyss_service_tpin'];
		$web_service_tpin=mysql_real_escape_string($web_service_tpin);
		
		$web_sender_mobile="";
		if(isset($_POST['blyss_sender_mobile']))
		$web_sender_mobile=$_POST['blyss_sender_mobile'];
		$web_sender_mobile=mysql_real_escape_string($web_sender_mobile);
		
		$web_sender_name="";
		if(isset($_POST['blyss_sender_name']))
		$web_sender_name=$_POST['blyss_sender_name'];
		$web_sender_name=mysql_real_escape_string($web_sender_name);
		
		$web_receiver_id="";
		if(isset($_POST['blyss_receiver_id']))
		$web_receiver_id=$_POST['blyss_receiver_id'];
		$web_receiver_id=mysql_real_escape_string($web_receiver_id);
		
		$web_receiver_name="";
		if(isset($_POST['blyss_receiver_name']))
		$web_receiver_name=$_POST['blyss_receiver_name'];
		$web_receiver_name=mysql_real_escape_string($web_receiver_name);
		
		$web_receiver_bank_account_no="";
		if(isset($_POST['blyss_receiver_bank_account_no']))
		$web_receiver_bank_account_no=$_POST['blyss_receiver_bank_account_no'];
		$web_receiver_bank_account_no=mysql_real_escape_string($web_receiver_bank_account_no);
		
		$web_receiver_bank_ifsc_code="";
		if(isset($_POST['blyss_receiver_bank_ifsc_code']))
		$web_receiver_bank_ifsc_code=$_POST['blyss_receiver_bank_ifsc_code'];
		$web_receiver_bank_ifsc_code=mysql_real_escape_string($web_receiver_bank_ifsc_code);
		
		$web_receiver_bank_code="";
		if(isset($_POST['blyss_receiver_bank_code']))
		$web_receiver_bank_code=$_POST['blyss_receiver_bank_code'];
		$web_receiver_bank_code=mysql_real_escape_string($web_receiver_bank_code);
		
		$web_retailer_pan_card_no="";
		if(isset($_POST['retailer_pan_card_no']))
		$web_retailer_pan_card_no=$_POST['retailer_pan_card_no'];
		$web_retailer_pan_card_no=mysql_real_escape_string($web_retailer_pan_card_no);
		
		$web_retailer_aadhar_card_no="";
		if(isset($_POST['retailer_aadhar_card_no']))
		$web_retailer_aadhar_card_no=$_POST['retailer_aadhar_card_no'];
		$web_retailer_aadhar_card_no=mysql_real_escape_string($web_retailer_aadhar_card_no);
		
		$web_your_txn_no="";
		if(isset($_POST['your_txn_no']))
		$web_your_txn_no=$_POST['your_txn_no'];
		$web_your_txn_no=mysql_real_escape_string($web_your_txn_no);
		
		$web_user_wallet_balance=show_wallet_balance($web_user_id);
		if($web_service_code=="")
		{
			$res_code="1014";
			$res_message="BlyssAPI BlyssServiceCode should not be Empty for METHOD $web_access_method";
		}
		else if($web_service_tpin=="")
		{
			$res_code="1015";
			$res_message="BlyssAPI BlyssServiceTpin should not be Empty for METHOD $web_access_method";
		}
		else if($web_service_code!=""  && $web_service_tpin!="")
		{
			$qry3="select * from $bankapi_child_base.api_user_service where user_id='$web_user_id' and service_code='$web_service_code' and service_pin='$web_service_tpin' and service_status=1;";
			$res3=mysql_query($qry3);
			$total_records3=mysql_num_rows($res3);
			if($total_records3==0)
			{
				$res_code="1016";
				$res_message="BlyssAPI BlyssProfileId, BlyssServiceCode, BlyssServiceTpin not authorized for METHOD $web_access_method";
			}
			else if($web_sender_mobile=="")
			{
				$res_code="1101";
				$res_message="BlyssAPI BlyssSenderMobile should not be Empty for METHOD $web_access_method";
			}
			else if($web_sender_name=="")
			{
				$res_code="1107";
				$res_message="BlyssAPI BlyssSenderName should not be Empty for METHOD $web_access_method";
			}
			else if($web_receiver_id=="")
			{
				$res_code="1115";
				$res_message="BlyssAPI BlyssReceiverId should not be Empty for METHOD $web_access_method";
			}
			else if($web_receiver_name=="")
			{
				$res_code="1116";
				$res_message="BlyssAPI BlyssReceiverName should not be Empty for METHOD $web_access_method";
			}
			else if($web_receiver_bank_account_no=="")
			{
				$res_code="1117";
				$res_message="BlyssAPI BlyssReceiverBankAccountNo should not be Empty for METHOD $web_access_method";
			}
			else if($web_receiver_bank_ifsc_code=="")
			{
				$res_code="1118";
				$res_message="BlyssAPI BlyssReceiverBankIfscCode should not be Empty for METHOD $web_access_method";
			}
			else if($web_receiver_bank_code=="")
			{
				$res_code="1119";
				$res_message="BlyssAPI BlyssReceiverBankCode should not be Empty for METHOD $web_access_method";
			}
			else if($web_retailer_pan_card_no=="") ///////////////////
			{
				$res_code="1201";
				$res_message="BlyssAPI RetailerPanCardNo should not be Empty for METHOD $web_access_method";
			}
			else if($web_retailer_aadhar_card_no=="") ///////////////////
			{
				$res_code="1202";
				$res_message="BlyssAPI RetailerAadharCardNo should not be Empty for METHOD $web_access_method";
			}
			else if($web_user_wallet_balance<5) ///////////////////
			{
				$res_code="1203";
				$res_message="BlyssAPI InsufficietWalletBalanceForTransaction for METHOD $web_access_method";
			}
			else if($web_your_txn_no=="") ///////////////////
			{
				$res_code="1204";
				$res_message="BlyssAPI YourTxnNo should not be Empty for METHOD $web_access_method";
			}
			else
			{
				$web_your_txn_no_pre=0;
				$web_your_txn_no_pre=check_user_api_txn_no($web_user_id,$web_your_txn_no);
				if($web_your_txn_no_pre!=0) ///////////////////
				{
					$res_code="1205";
					$res_message="BlyssAPI YourTxnNo is Duplicate for METHOD $web_access_method";
				}
				else
				{
					$res_data=create_verify_receiver_txn($web_ip, $web_user_id, $web_sender_mobile, $web_sender_name, $web_sender_mobile, $web_receiver_name, $web_receiver_bank_code, $web_receiver_bank_account_no, $web_receiver_bank_ifsc_code, $web_receiver_bank_code, 5, 2, 2, $web_retailer_pan_card_no, $web_retailer_aadhar_card_no, $web_your_txn_no);//$your_txn_no,$order_id,$txn_status,$bank_ref_no,$is_verified
					$res_code="0";
					$res_message="BlyssAPI Call Successful for METHOD $web_access_method";
				}
			}
		}
	}
	$resulted_response = array("response_code"=>$res_code, 
								"response_message"=>$res_message, 
								"response_data"=>$res_data);
	$resulted_response=json_encode($resulted_response);
	$resulted_response=str_replace('","','" , "',$resulted_response);
	/*
	$resulted_response=str_replace('":"','" : "',$resulted_response);
	*/
	echo $resulted_response;
}
//check_bal
//insert_parent/insert_child/update_parent_in_child
//deduct_ret/deduct_client/check_pre_verified/deduct_admin
//send_verification/read_response
//update_tid/bank_ref_no/status
function show_user_limit($user)
{
	require('../zc-gyan-info-admin.php');
	require('../zc-common-admin-api.php');
	$plan_limit=0;
	$query="SELECT * FROM $bankapi_child_base.child_user where user_id='$user'";
	$result=mysql_query($query);
	while($r = mysql_fetch_array($result)) 
	{
		$plan_limit=$r['plan_limit'];
	}
	return $plan_limit;
}

function show_txn_client_balance()
{
	require('../zc-gyan-info-admin.php');
	require('../zc-common-admin-api.php');
	$balance=0;
	$query="SELECT * FROM $bankapi_child_wallet.realtime order by wallet_id desc limit 0,1";
	$result=mysql_query($query);
	while($row=mysql_fetch_array($result))
	{
		$balance=$row['amount_bal'];
	}
	return $balance;
}

function show_txn_client_dummy_balance()
{
	require('../zc-gyan-info-admin.php');
	require('../zc-common-admin-api.php');
	$dummy=0;
	$query2="SELECT * FROM $bankapi_parent_base.parent_client where client_id='$clientdbid'";
	$result2=mysql_query($query2);
	while($row2=mysql_fetch_array($result2))
	{
		$dummy=$row2['dummy_balance'];
	}
	return $dummy;
}

function show_txn_admin_balance($source)
{
	require('../zc-gyan-info-admin.php');
	require('../zc-common-admin-api.php');
	$balance=0;
	if($source==1)
		$query="SELECT * FROM $bankapi_parent_wallet.rt_eko order by wallet_id desc limit 0,1";
	else if($source==2)
		$query="SELECT * FROM $bankapi_parent_wallet.rt_aquams order by wallet_id desc limit 0,1";
	else if($source==3)
		$query="SELECT * FROM $bankapi_parent_wallet.rt_acharya order by wallet_id desc limit 0,1";
	else if($source==4)
		$query="SELECT * FROM $bankapi_parent_wallet.rt_rechapi order by wallet_id desc limit 0,1";
	else if($source==5)
		$query="SELECT * FROM $bankapi_parent_wallet.rt_ach_blyss order by wallet_id desc limit 0,1";
	else if($source==6)
		$query="SELECT * FROM $bankapi_parent_wallet.rt_rech_blyss order by wallet_id desc limit 0,1";
	$result=mysql_query($query);
	while($row=mysql_fetch_array($result))
	{
		$balance=$row['amount_bal'];
	}
	return $balance;
}

function admin_otp_refund()
{
	require('../zc-gyan-info-admin.php');
	require('../zc-common-admin-api.php');
	$amount=0;
	$query="SELECT sum(amount) amt FROM $bankapi_parent_txn.txn_mt where mmt_status=-4;";
	$result=mysql_query($query);
	while($r = mysql_fetch_array($result)) 
	{
		$amount=$r['amt'];
	}
	return $amount;
}

function show_admin_av_rate($source)
{
	require('../zc-gyan-info-admin.php');
	require('../zc-common-admin-api.php');
	
	$rate=0;
	$query="SELECT * FROM $bankapi_parent_base.charges_in_source where source_id='$source' and operator_id=1002";
	$result=mysql_query($query);
	while($r = mysql_fetch_array($result)) 
	{
		$rate=$r['surcharges_fix'];
	}
	return $rate;
}

function show_client_av_rate($source)
{
	require('../zc-gyan-info-admin.php');
	require('../zc-common-admin-api.php');
	
	$rate=0;
	$query="SELECT * FROM $bankapi_parent_base.charges_out_service where mt_source_id='$source' and operator_id=1002 and client_id='$clientdbid';";
	$result=mysql_query($query);
	while($r = mysql_fetch_array($result)) 
	{
		$rate=$r['surcharges_fix'];
	}
	return $rate;
}

function show_user_av_rate($source)
{
	$rate=0;
	$rate_client=show_client_av_rate($source);
	$rate_admin=show_admin_av_rate($source);
	$rate=5;
	if($rate<$rate_client)
	$rate=$rate_client;
	if($rate<$rate_admin)
	$rate=$rate_admin;
	return $rate;
}

function generate_mt_client_txn_parent($query)
{
	require('../zc-gyan-info-admin.php');
	require('../zc-common-admin-api.php');
	$generated_id=0;
	mysql_query($query);				
	$generated_id=mysql_insert_id();
	return $generated_id;
}

function generate_mt_client_txn_child($query)
{
	require('../zc-gyan-info-admin.php');
	require('../zc-common-admin-api.php');
	$generated_id=0;
	mysql_query($query);				
	$generated_id=mysql_insert_id();
	return $generated_id;
}

function generate_mt_admin_txn($query)
{
	require('../zc-gyan-info-admin.php');
	require('../zc-common-admin-api.php');
	$generated_id=0;
	mysql_query($query);				
	$generated_id=mysql_insert_id();
	return $generated_id;
}

function generate_rc_client_txn($query)
{
	require('../zc-gyan-info-admin.php');
	require('../zc-common-admin-api.php');
	$generated_id=0;
	mysql_query($query);				
	$generated_id=mysql_insert_id();
	return $generated_id;
}

function generate_rc_admin_txn($query)
{
	require('../zc-gyan-info-admin.php');
	require('../zc-common-admin-api.php');
	$generated_id=0;
	mysql_query($query);				
	$generated_id=mysql_insert_id();
	return $generated_id;
}

function update_user_balance($user)
{
	require('../zc-gyan-info-admin.php');
	require('../zc-common-admin-api.php');
	$bal=show_user_balance($user);
	$query="update $bankapi_child_base.child_userinfo_walletkyc set wallet_balance='$bal' where user_id='$user'";
	mysql_query($query);
}

function show_user_balance($user)
{
	require('../zc-gyan-info-admin.php');
	require('../zc-common-admin-api.php');
	
	$query="select * from $bankapi_child_wallet.distribution where user_id='$user' order by wallet_id desc limit 0,1 ";
	$result=mysql_query($query);
	$bal=0;
	while($row=mysql_fetch_array($result))
	{
		$bal=$row['amount_bal'];
	}
	return $bal;
}

function create_verify_receiver_txn($web_ip, $userid, $cno, $cname, $bno, $bname, $bbname, $bacc, $bifsc, $bbankid, $source, $type, $method, $pan, $aadhar, $your_txn_no)
{
	require('../zc-gyan-info-admin.php');
	require('../zc-common-admin-api.php');
	$source=5;
	$type=2;
	$method=2;
	$datetime=$datetime_datetime;
	$balance_retailer=show_wallet_balance($userid);
	$show_user_limit=show_user_limit($userid);
	$balance_client=show_txn_client_balance();
	$balance_client_dummy=show_txn_client_dummy_balance();
	$balance_admin=show_txn_admin_balance($source);
	$client_otp_pending_refund=0;
	$admin_otp_pending_refund=0;
	$admin_otp_pending_refund=admin_otp_refund();
	
	$deduction_retailer=show_user_av_rate($source);
	$deduction_client=show_client_av_rate($source);
	$deduction_admin=show_admin_av_rate($source);
	$is_verified=is_benf_already_verified($bacc);
	if($is_verified!="0")
	{
		$deduction_admin=0;
	}
	$charged=$charges=0;
	
	$txn_id=$order_id=$m_id=$t_id=0;
	$user_ip=$web_ip;
	$ded_ret=$deduction_retailer;
	$remain_ret=$balance_retailer-$ded_ret;
	$ded_client=$deduction_client;
	$remain_client=$balance_client-$ded_client;
	$ded_admin=$deduction_admin;
	$remain_admin=$balance_admin-$ded_admin;
	$brid=0;
	$txn_status="1";
	
	$qry1="";			
	$qry1="INSERT INTO $bankapi_child_txn.txn_mt_parent(date_time, retailer_id, sender, sname, receiver, receiver_id, rname, rbname, racc, rifsc, rbankid, source, type, method, pre_bal, amount, charges, com_charged, deducted, post_bal) value('$datetime_datetime', '$userid', '$cno', '$cname', '$bno', '$brid', '$bname', '$bbname', '$bacc', '$bifsc', '$bbankid', '$source', '$type', '$method', '$balance_retailer', '$deduction_retailer', '$charges', '$charged', '$ded_ret', '$remain_ret')";
	$txn_id=generate_mt_client_txn_parent($qry1);
	if($txn_id%1000==0)
	{
		//include_once('../functions/_zsms.php');
		//zsms("9896677625","Txn No $txn_id started on dated $datetime_datetime");
	}
	
	$qry2="";			
	$qry2="INSERT INTO $bankapi_child_txn.txn_mt_child(txn_id, created_on, user_id, sender_number, sname, receiver_number, receiver_id, rname, rbname, racc, rifsc, rbankid, source, type, method, bal_before, amount, charges, com_charged, deducted, bal_after, updated_on, order_status, ip, api_txn_no) value ('$txn_id', '$datetime_datetime', '$userid', '$cno', '$cname', '$bno', '$brid', '$bname', '$bbname', '$bacc', '$bifsc', '$bbankid', '$source', '$type', '$method', '$balance_retailer', '$deduction_retailer', '$charges', '$charged', '$ded_ret', '$remain_ret', '$datetime', '$txn_status', '$user_ip', '$your_txn_no')";
	$order_id=generate_mt_client_txn_child($qry2);
	if($order_id%1000==0)
	{
		//include_once('../functions/_zsms.php');
		//zsms("9896677625","Order No $order_id started on dated $datetime_datetime");
	}
	
	$qry3="";			
	$qry3="INSERT INTO $bankapi_parent_txn.txn_mt(client_id, order_id, txn_id, created_on, user_id, sender_number, sname, receiver_number, receiver_id, rname, rbname, racc, rifsc, rbankid, source, type, method, bal_before, amount, charges, bal_after, updated_on, mmt_status, ip) value('$clientdbid', '$order_id', '$txn_id', '$datetime_datetime', '$userid', '$cno', '$cname', '$bno', '$brid', '$bname', '$bbname', '$bacc', '$bifsc', '$bbankid', '$source', '$type', '$method', '$balance_admin', '$deduction_admin', '$charges', '$remain_admin', '$datetime_datetime', '$txn_status', '$user_ip')";
	$m_id=generate_mt_admin_txn($qry3);
	
	//update_mid_for_client
	$qry4="";
	$qry4="update $bankapi_child_txn.txn_mt_child set mid='$m_id' where order_id='$order_id';";
	mysql_query($qry4);
	
	//deduct_amount_for_retailer
	$qry5="";
	$qry5="INSERT INTO $bankapi_child_wallet.distribution(wallet_date, wallet_time, user_id, service_id, order_id, tid, transaction_type, transaction_description, amount_pre, amount_cr, amount_dr, amount_bal, remarks) value('$datetime_date', '$datetime_time', '$userid', '101', '$order_id', '$m_id', '6', 'Money Transfer Order No. $order_id', '$balance_retailer', '0', '$ded_ret', '$remain_ret', 'Money Transfer Order generated by user at $datetime_datetime')";
	mysql_query($qry5);
	update_user_balance($userid);
	
	//deduct_amount_for_client
	$qry6="";
	$qry6="INSERT INTO $bankapi_child_wallet.realtime(wallet_date, wallet_time, user_id, service_id, client_order_id, source_order_id, transaction_type, transaction_description, amount_pre, amount_cr, amount_dr, amount_bal) value('$datetime_date', '$datetime_time', '$userid', '101', '$order_id', '$m_id', '2', 'Money Transfer Order No. $order_id generated by user id $userid', '$balance_client', '0', '$ded_client', '$remain_client')";
	mysql_query($qry6);
	
	if($source==1)
	{
		//deduct_amount_for_admin
		$qry7="";
		$qry7="INSERT INTO $bankapi_parent_wallet.rt_eko(wallet_date, wallet_time, client_id, user_id, client_order_id, source_order_id, transaction_type, transaction_description, amount_pre, amount_cr, amount_dr, amount_bal) value('$datetime_date', '$datetime_time', '$clientdbid', '$userid', '$order_id', '$m_id', '2', 'Money Transfer Order No. $order_id generated by user id $userid of client id $clientdbid', '$balance_admin', '0', '$ded_admin', '$remain_admin')";
		mysql_query($qry7);
	}
	if($source==3)
	{
		//deduct_amount_for_admin
		$qry7="";
		$qry7="INSERT INTO $bankapi_parent_wallet.rt_acharya(wallet_date, wallet_time, client_id, user_id, client_order_id, source_order_id, transaction_type, transaction_description, amount_pre, amount_cr, amount_dr, amount_bal) value('$datetime_date', '$datetime_time', '$clientdbid', '$userid', '$order_id', '$m_id', '2', 'Money Transfer Order No. $order_id generated by user id $userid of client id $clientdbid', '$balance_admin', '0', '$ded_admin', '$remain_admin')";
		mysql_query($qry7);
	}
	if($source==5)
	{
		//deduct_amount_for_admin
		$qry7="";
		$qry7="INSERT INTO $bankapi_parent_wallet.rt_ach_blyss(wallet_date, wallet_time, client_id, user_id, client_order_id, source_order_id, transaction_type, transaction_description, amount_pre, amount_cr, amount_dr, amount_bal) value('$datetime_date', '$datetime_time', '$clientdbid', '$userid', '$order_id', '$m_id', '2', 'Money Transfer Order No. $order_id generated by user id $userid of client id $clientdbid', '$balance_admin', '0', '$ded_admin', '$remain_admin')";
		mysql_query($qry7);
	}
	$blyss_receiver_account_name="";
	if($is_verified!="0")
	{
		$blyss_receiver_account_name=$is_verified;
		$txn_status="2";
					
		//update_benefid_tid_for_client_child
		$qry8="update $bankapi_child_txn.txn_mt_child set receiver_id='0', tid='1234', bank_ref_no='4321', order_status='$txn_status' where order_id='$order_id';";
		mysql_query($qry8);
		
		//update_tid_for_client_parent
		$qry9="update $bankapi_child_txn.txn_mt_parent set receiver_id='0' where txn_id='$txn_id';";
		mysql_query($qry9);
		
		//update_benefid_tid_for_admin
		$qry10="update $bankapi_parent_txn.txn_mt set response='1234-4321', receiver_id='0', tid='1234', bank_ref_no='4321', mmt_status='$txn_status', response_message='1234-4321' where mmt_id='$m_id';";
		mysql_query($qry10);
		
		//level wise margin for client		
		$qry11="insert into $bankapi_child_txn.txn_mt_child_margin(order_id, txn_id, lvl_1_id, lvl_1_chg, lvl_12_id, lvl_12_chg, lcl_12_chgd) value ('$order_id', '$txn_id', '$main_admin', '3', '$userid', '$ded_ret', '$ded_ret')";
		mysql_query($qry11);
		
		//margin for admin		
		$qry12="insert into $bankapi_parent_txn.txn_mt_margin(mt_id, created_on, client_id, source_id, type, method, service_id, amount, admin_rate, client_rate, admin_comm) value ('$m_id', '$datetime_datetime', '$clientdbid', '$source', '$type', '$method', '101', '$deduction_retailer', '$deduction_admin', '$deduction_client', $deduction_client-$deduction_admin)";
		mysql_query($qry12);

		$qry="insert into $bankapi_common.eko_receiver_verified(sender, bank, ifsc, receiver_acc_no, receiver_name, receiver_id_type, updated_on, source) value('$cno', '$bbname', '$bifsc', '$bacc', '$bname', '0', '$datetime_datetime', 3);";
		mysql_query($qry);
	}
	else
	{
	}
	if($txn_status=="0")
	{
		$txn_status="NOT INTIATED";
	}
	if($txn_status=="1" || $txn_status=="3")
	{
		$txn_status="PENDING";
	}
	if($txn_status=="4" || $txn_status=="-4")
	{
		$txn_status="PENDING";
	}
	if($txn_status=="-1" || $txn_status=="-2")
	{
		$txn_status="PENDING";
	}
	if($txn_status=="2")
	{
		$txn_status="SUCCESS";
	}
	if($txn_status=="5")
	{
		$txn_status="REFUNDED";
	}
	$res_data[] = array("your_txn_no"=>"".$your_txn_no ,"ref_id"=>"".$order_id ,"blyss_transaction_status"=>"".$txn_status ,"blyss_receiver_account_name"=>"".$blyss_receiver_account_name);
	return $res_data;
}

function is_benf_already_verified($acc_no)
{
	require('../zc-gyan-info-admin.php');
	require('../zc-common-admin-api.php');
	$verified=0;
	$qry="select * from $bankapi_common.eko_receiver_verified where receiver_acc_no='$acc_no' and source='1';";
	$result=mysql_query($qry);
	while($rs=mysql_fetch_array($result))
	{
		$verified=$rs['receiver_name'];
	}
	return $verified;
}

function verify_beneficiary_blyss_api($cno,$cname,$racc,$ifsc,$pan,$aadhar,$order_number)
{
	require('../zc-gyan-info-admin.php');
	require('../zc-common-admin-api.php');
	$return_result="";
	/*
	txn_add_benificiary($userid, $cno, $cname, $bno, $bname, $bbname, $bacc, $bifsc, $bbankid, $source, $type, $method, $pan, $aadhar)
	
	$uid=$_POST['uid'];
	$cno=$_POST['cno'];
	$cname=$_POST['cname'];
	$brid=$_POST['brid'];
	$bno=$_POST['bno'];
	$bname=$_POST['bname'];
	$bbname=$_POST['bbname'];
	$bacc=$_POST['bacc'];
	$sourcemt=$_POST['sourcemt'];*/
	
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
			$qry="insert into $bankapi_common.eko_receiver_verified(sender, bank, ifsc, receiver_acc_no, receiver_name, receiver_id_type, updated_on, source) value('$sender_number', '$receiver_bank_bankcode', '$receiver_bank_ifsccode', '$receiver_bank_accno', '$BeneficiaryName', '0', '$datetime_datetime', 3);";
			mysql_query($qry);
			$qry="insert into $bankapi_common.eko_receiver_verified(sender, bank, ifsc, receiver_acc_no, receiver_name, receiver_id_type, updated_on, source) value('0', '$receiver_bank_bankcode', '$receiver_bank_ifsccode', '$receiver_bank_accno', '$BeneficiaryName', '0', '$datetime_datetime', 1);";
			mysql_query($qry);
		}
	}
	$return_result=array($StatusCode,$Status,$Description,$ASTransCode,$ReferenceNumber,$BeneficiaryName,$response);
	return $return_result;
}

function check_user_api_txn_no($web_user_id,$web_your_txn_no)
{
	require('../zc-gyan-info-admin.php');
	require('../zc-common-admin-api.php');
	$qry3="select * from $bankapi_child_txn.txn_mt_child where user_id='$web_user_id' and api_txn_no='$web_your_txn_no';";
	$res3=mysql_query($qry3);
	$count=0;
	while($rs3=mysql_fetch_array($res3))
	{
		$count++;
	}
	$qry3="select * from $bankapi_child_txn.txn_rc where user_id='$web_user_id' and api_txn_no='$web_your_txn_no';";
	$res3=mysql_query($qry3);
	while($rs3=mysql_fetch_array($res3))
	{
		$count++;
	}
	return $count;
}

function add_beneficiary_blyss_api($cno,$rname,$rbacc,$rbifsc,$bank_code)
{
	require('../zc-gyan-info-admin.php');
	$return_result="";
	
	$bankapi_user_id="100001";
	$bankapi_user_pass="9729877577";
	$bankapi_method="SAVE_RECEIVER";
	
	$sender_number=urlencode($cno); 
	$receiver_name=urlencode($rname); 
	$receiver_bank_accno=urlencode($rbacc); 
	$receiver_bank_ifsccode=urlencode($rbifsc); 
	$receiver_bank_bankcode=urlencode($bank_code); 
	
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
	
	$err = curl_error($curl);
	curl_close($curl);
	if ($err) {
	  //echo "cURL Error : " . $err;
	}
	else
	{
		//echo $response;
		//[{"StatusCode":"0","Description":"Beneficiary Added Successfully"}]
		//[{"StatusCode":"0","Description":"Beneficiary is already Registered by requested mobile no"}]
		$result= json_decode($response, true)[0];
		$StatusCode=$result['StatusCode'];
		$Description=$result['Description'];
		$Description=str_replace("Sender is not registered ","Sender Mobile is not Registered",$Description);
		$Description=str_replace("Oops! Please provide a valid IFSC Code ","Ifsc Code is Invalid",$Description);
		$Description=str_replace("Invalid Bank Code ","Bank Code is Invalid",$Description);
		$Description=str_replace("Beneficiary Added Successfully","Receiver Added Successfully",$Description);
		$Description=str_replace("Beneficiary is already Registered by requested mobile no","Receiver is already exist for Sender Mobile",$Description);
	}
	$return_result[]=array("blyss_description"=>"$Description");
	return $return_result;
}

function remove_beneficiary_blyss_api($cno,$benid)
{
	require('../zc-gyan-info-admin.php');
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
	  	//echo "cURL Error : " . $err;
	}
	else
	{
		//[{"StatusCode":"0","Description":"Beneficiary Deleted."}]
		//echo $response;
		$result= json_decode($response, true)[0];
		$StatusCode=$result['StatusCode'];
		$Description=$result['Description'];
		$Description=str_replace("Beneficiary Deleted.","BlyssReceiver Deleted for BlyssSenderMobile",$Description);
	}
	$return_result[]=array("blyss_description"=>"$Description");
	return $return_result;
}

function show_beneficiary_blyss_api($useridlogged,$cno)
{
	require('../zc-gyan-info-admin.php');
	require('../zc-common-admin-api.php');
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
		//echo "cURL Error : " . $err;
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
			}
			$sender_number=mysql_real_escape_string($sender_number);
			$qry_beneficiary="SELECT sender_number, receiver_id, receiver_name, bank, ifsc, receiver_acc_no, is_verified FROM $bankapi_common.eko_receiver where sender_number='$sender_number' and source='3' order by receiver_id desc;";
			$result_beneficiary=mysql_query($qry_beneficiary);
			$res_data=array();
			while($rs2=mysql_fetch_assoc($result_beneficiary))
			{
				if($rs2['is_verified']==0)
				{
					$res_data[] = array("sender_number"=>"".$rs2['sender_number'] ,"receiver_id"=>"".$rs2['receiver_id'] ,"receiver_name"=>"".$rs2['receiver_name'] ,"bank_name"=>"".$rs2['bank'] ,"ifsc_code"=>"".$rs2['ifsc'] ,"bank_account_no"=>"".$rs2['receiver_acc_no'] ,"is_account_verified"=>"NO");
				}
				else
				{
					$acno=$rs2['receiver_acc_no'];
					$accname="";
					$qry_store="select * from $bankapi_common.eko_receiver_verified where receiver_acc_no = '$acno' and sender='$sender_number';";
					$result_store=mysql_query($qry_store);
					while($row_store=mysql_fetch_array($result_store))
					{
						$accname=$row_store['receiver_name'];
					}
					if($accname!="")
						$res_data[] = array("sender_number"=>"".$rs2['sender_number'] ,"receiver_id"=>"".$rs2['receiver_id'] ,"receiver_name"=>"".$accname ,"bank_name"=>"".$rs2['bank'] ,"ifsc_code"=>"".$rs2['ifsc'] ,"bank_account_no"=>"".$rs2['receiver_acc_no'] ,"is_account_verified"=>"YES");
					else
						$res_data[] = array("sender_number"=>"".$rs2['sender_number'] ,"receiver_id"=>"".$rs2['receiver_id'] ,"receiver_name"=>"".$rs2['receiver_name'] ,"bank_name"=>"".$rs2['bank'] ,"ifsc_code"=>"".$rs2['ifsc'] ,"bank_account_no"=>"".$rs2['receiver_acc_no'] ,"is_account_verified"=>"NO");
				}
			}
		}
	}
	return $res_data;
}

function verify_sender_blyss_api($useridlogged,$ccode,$cotp)
{
	require('../zc-gyan-info-admin.php');
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
		//echo "cURL Error : " . $err;
	}
	else
	{
		//echo $response;
		//[{"StatusCode":"-1","Description":"Invalid OTP"}]
		//[{"StatusCode":"0","Description":"OTP Verification Successful."}]
		$result= json_decode($response, true)[0];
		$StatusCode=$result['StatusCode'];
		$Description=$result['Description'];
		$Description=str_replace("Invalid OTP","BlyssOTP is Invalid",$Description);
		$Description=str_replace("OTP Verification Successful.","BlyssOTP Verified Successfully",$Description);
		$return_result[]=array("blyss_description"=>"$Description");
	}
	return $return_result;
}

function add_sender_blyss_api($useridlogged, $cno, $cname)
{
	require('../zc-gyan-info-admin.php');
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
		//echo "cURL Error : " . $err;
	}
	else
	{
		//echo $response."<br><br>";
		//[{"StatusCode":"0","Description":"A Verification OTP Sent to RemitterNo. Verify it along with OTP Code.","OTPCode":"7650474"}]
		//OTP is sent to Sender's Mobile. Verification is Pending.
		$result= json_decode($response, true)[0];
		$StatusCode=$result['StatusCode'];
		if($StatusCode==0)
		{
			$Description=$result['Description'];
			$OTPCode=$result['OTPCode'];
			$return_result[]=array("blyss_sender_mobile"=>"$cno", 
									"blyss_description"=>"BlyssOTP is sent on Sender Mobile. Verification is Pending.", 
									"blyss_otp_ref_no"=>"$OTPCode");
		}
		else
		{
			$Description=$result['Description'];
		}
		if($Description=="Remitter Does not exist. Please register this remitter.")
		{
			$return_result[]=array("blyss_sender_mobile"=>"$cno", 
									"blyss_description"=>"Sender Mobile does not exist in Blyss. Please Register Sender Mobile on Blyss for Money Remittance.");
		}
		if($Description=="Mobile No can only have digits")
		{
			$return_result[]=array("blyss_sender_mobile"=>"$cno", 
									"blyss_description"=>"Sender Mobile should have only digits");
		}
		if($Description=="Mobile No can begin with 6,7,8 or 9 only")
		{
			$return_result[]=array("blyss_sender_mobile"=>"$cno", 
									"blyss_description"=>"Sender Mobile should start with 6,7,8 or 9 only");
		}
		if($Description=="Mobile No must be of 10 digits")
		{
			$return_result[]=array("blyss_sender_mobile"=>"$cno", 
									"blyss_description"=>"Sender Mobile should have 10 digits only");
		}
		if($Description=="Invalid Remitter Name. Please provide valid Name. Avoid Special Characters and Numbers in Name.")
		{
			$return_result[]=array("blyss_sender_mobile"=>"$cno", 
									"blyss_description"=>"Invalid Sender Name. Sender Name should have alphabets and space only. Dont use special characters and numbers in Sender Name.");
		}
	}
	return $return_result;
}

function find_sender_blyss_api($useridlogged,$cno)
{
	require('../zc-gyan-info-admin.php');
	require('../zc-common-admin-api.php');
	$return_result=array();
	
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
		//echo "cURL Error : " . $err;
	}
	else
	{
		//echo $response;
		//[{"StatusCode":"0","RemitterName":"abhishek","RemitterMobile":"9729877577", "RemitterLimit1":"24850.00","RemitterLimit2":"24597.00"}]
		//Sender is not registered with us. Fill name of Sender and complete registration for Money Remittance.
		$result= json_decode($response, true)[0];
		$StatusCode=$result['StatusCode'];
		$Description="";
		$RemitterName="";
		$RemitterMobile="";
		$RemitterLimit1="0";
		$RemitterLimit2="0";
		if($StatusCode==0)
		{
			$RemitterName= $result['RemitterName'];
			$RemitterMobile= $result['RemitterMobile'];
			$RemitterLimit1= $result['RemitterLimit1'];
			$RemitterLimit2= $result['RemitterLimit2'];
			$cno=mysql_real_escape_string($cno);			
			mysql_query("delete from $bankapi_common.eko_sender where sender_number='$cno' and source='3';");
			$qry1="insert into $bankapi_common.eko_sender(user_id, sender_number, response, response_status_id, balance_amount, state_desc, sender_name, state, customer_id, response_type_id, response_message, response_status, checked_on, registered_on, verified_on, eko_sender_status, source) value('$useridlogged', '$cno', '$response', '0', '0', '0', '$RemitterName', '0', '$RemitterMobile', '0', '$Description', '0', '$datetime_datetime', '$datetime_datetime', '$datetime_datetime', 3, 3);";
			mysql_query($qry1);
		}
		else
		{
			$Description=$result['Description'];
		}
		$qry3="select customer_id sender_id, sender_number, sender_name, '$RemitterLimit1' remain_limit_neft, '$RemitterLimit2' remain_limit_imps from $bankapi_common.eko_sender where source=3 and sender_number='$cno';";
		$res3=mysql_query($qry3);
		while($rs3=mysql_fetch_assoc($res3))
		{
			 $return_result[] = $rs3;
		}
		if($Description=="Remitter Does not exist. Please register this remitter.")
		{
			$return_result[]=array("blyss_sender_mobile"=>"$cno", 
									"blyss_description"=>"Sender Mobile does not exist in Blyss. Please Register Sender Mobile on Blyss for Money Remittance.");
		}
		if($Description=="Mobile No can only have digits")
		{
			$return_result[]=array("blyss_sender_mobile"=>"$cno", 
									"blyss_description"=>"Sender Mobile should have only digits");
		}
		if($Description=="Mobile No can begin with 6,7,8 or 9 only")
		{
			$return_result[]=array("blyss_sender_mobile"=>"$cno", 
									"blyss_description"=>"Sender Mobile should start with 6,7,8 or 9 only");
		}
		if($Description=="Mobile No must be of 10 digits")
		{
			$return_result[]=array("blyss_sender_mobile"=>"$cno", 
									"blyss_description"=>"Sender Mobile should have 10 digits only");
		}
	}
	return $return_result;
}

function show_wallet_history($web_user_id,$web_wallet_date)
{
	require('../zc-gyan-info-admin.php');
	require('../zc-common-admin-api.php');
	$res_data=array();			
	$qry3="select wallet_date date, wallet_time time, transaction_description remarks, amount_cr cr, amount_dr dr from $bankapi_child_wallet.distribution where user_id='$web_user_id' and wallet_date='$web_wallet_date' order by wallet_id;";
	$res3=mysql_query($qry3);
	while($rs3=mysql_fetch_assoc($res3))
	{
		 $res_data[] = $rs3;
	}
	return $res_data;
}

function show_wallet_balance($web_user_id)
{
	require('../zc-gyan-info-admin.php');
	require('../zc-common-admin-api.php');
	$qry3="select * from $bankapi_child_wallet.distribution where user_id='$web_user_id' order by wallet_id desc limit 0,1;";
	$res3=mysql_query($qry3);
	$amount_bal=0;
	while($rs3=mysql_fetch_array($res3))
	{
		$amount_bal=$rs3['amount_bal'];
		$qry2="update $bankapi_child_base.child_userinfo_walletkyc set wallet_balance='$amount_bal' where user_id='$web_user_id';";
		mysql_query($qry2);
	}
	return $amount_bal;
}

//blyss_sender_mobile, blyss_sender_name, blyss_receiver_id, blyss_receiver_name, blyss_receiver_bank_account_no, blyss_receiver_bank_ifsc_code, blyss_receiver_bank_code, retailer_pan_card_no, retailer_aadhar_card_no, blyss_transfer_method, blyss_transfer_amount, your_txn_no
function fund_transfer2($orderno,$cno,$cname,$brid,$account,$ifsc,$method,$transamount,$pan,$aadhar)
{ // type=1
	require('../zc-gyan-info-admin.php');
	//require('../zc-common-admin-api.php');
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

//your_txn_no
function fund_transfer_order_status2($order)//CHECK_ORDER_STATUS
{ 	
	require('../zc-gyan-info-admin.php');
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
	require('../zc-gyan-info-admin.php');
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

?>