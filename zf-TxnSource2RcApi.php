<?php
function start_recharge($request_number,$mobile_number,$amount,$operator,$circle)
{
	require('zc-gyan-info-admin.php');
	$return_result="";
	
	$bankapi_user_id="100001";
	$bankapi_user_pass="9729877577";
	$bankapi_method="RCPP";
	$circle="PUNJAB";
	
	$request_number=urlencode($request_number);
	$mobile_number=urlencode($mobile_number);
	$amount=urlencode($amount);
	$operator=urlencode($operator);
	$circle=urlencode($circle);
	
	$url = "$call_rc1_url" . "?";
	$url = $url . "bankapi_user_id=" . $bankapi_user_id;
	$url = $url . "&bankapi_user_pass=" . $bankapi_user_pass;
	$url = $url . "&bankapi_method=" . $bankapi_method;
	$url = $url . "&request_number=" . $request_number;
	$url = $url . "&mobile_number=" . $mobile_number;
	$url = $url . "&amount=" . $amount;
	$url = $url . "&operator=" . $operator;
	$url = $url . "&circle=" . $circle;
							   
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($curl);
	return $response ;
}
function check_balance()
{
	require('zc-gyan-info-admin.php');
	$return_result="";
	
	$bankapi_user_id="100001";
	$bankapi_user_pass="9729877577";
	$bankapi_method="BLNC";
	
	$url = "$call_rc1_url" . "?";
	$url = $url . "bankapi_user_id=" . $bankapi_user_id;
	$url = $url . "&bankapi_user_pass=" . $bankapi_user_pass;
	$url = $url . "&bankapi_method=" . $bankapi_method;
							   
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($curl);
	return $response ;
}
function check_request_status($request_number)//our order id
{
	require('zc-gyan-info-admin.php');
	$return_result="";
	
	$bankapi_user_id="100001";
	$bankapi_user_pass="9729877577";
	$bankapi_method="STTSS";
	$request_number=urlencode($request_number);
	
	$url = "$call_rc1_url" . "?";
	$url = $url . "bankapi_user_id=" . $bankapi_user_id;
	$url = $url . "&bankapi_user_pass=" . $bankapi_user_pass;
	$url = $url . "&bankapi_method=" . $bankapi_method;
	$url = $url . "&request_number=" . $request_number;
							   
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($curl);
	return $response ;
}
function check_order_status($order_number)//api order id
{
	require('zc-gyan-info-admin.php');
	$return_result="";
	
	$bankapi_user_id="100001";
	$bankapi_user_pass="9729877577";
	$bankapi_method="STTS";
	$order_number=urlencode($order_number);
	
	$url = "$call_rc1_url" . "?";
	$url = $url . "bankapi_user_id=" . $bankapi_user_id;
	$url = $url . "&bankapi_user_pass=" . $bankapi_user_pass;
	$url = $url . "&bankapi_method=" . $bankapi_method;
	$url = $url . "&order_number=" . $order_number;
							   
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($curl);
	return $response ;
}
?>