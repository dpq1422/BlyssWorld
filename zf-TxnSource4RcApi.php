<?php
function start_recharge($request_number,$mobile_number,$amount,$operator,$circle)
{
	require('zc-gyan-info-admin.php');
	$return_result="";
	
	$bankapi_user_id="100001";
	$bankapi_user_pass="9729877577";
	$bankapi_method="RCPP";
	
	$request_number=urlencode($request_number);
	$mobile_number=urlencode($mobile_number);
	$amount=urlencode($amount);
	$operator=urlencode($operator);
	$circle=urlencode($circle);
	
	$url = "$call_rc2_url" . "?";
	$url = $url . "bankapi_user_id=" . $bankapi_user_id;
	$url = $url . "&bankapi_user_pass=" . $bankapi_user_pass;
	$url = $url . "&bankapi_method=" . $bankapi_method;
	$url = $url . "&request_number=" . $request_number;
	$url = $url . "&mobile_number=" . $mobile_number;
	$url = $url . "&amount=" . $amount;
	$url = $url . "&operator=" . $operator;
							   
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	//curl_setopt($curl, CURLOPT_TIMEOUT, 60);
    //curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 60);
	$response = curl_exec($curl);
	return $response ;
}
function start_recharge_with_op1to5($request_number,$mobile_number,$amount,$operator,$circle, $op1, $op2, $op3, $op4, $op5)
{
	require('zc-gyan-info-admin.php');
	$return_result="";
	
	$bankapi_user_id="100001";
	$bankapi_user_pass="9729877577";
	$bankapi_method="RCPP";
	
	$request_number=urlencode($request_number);
	$mobile_number=urlencode($mobile_number);
	$amount=urlencode($amount);
	$operator=urlencode($operator);
	$circle=urlencode($circle);
	$op1=urlencode($op1);
	$op2=urlencode($op2);
	$op3=urlencode($op3);
	$op4=urlencode($op4);
	$op5=urlencode($op5);
	
	$url = "$call_rc2_url" . "?";
	$url = $url . "bankapi_user_id=" . $bankapi_user_id;
	$url = $url . "&bankapi_user_pass=" . $bankapi_user_pass;
	$url = $url . "&bankapi_method=" . $bankapi_method;
	$url = $url . "&request_number=" . $request_number;
	$url = $url . "&mobile_number=" . $mobile_number;
	$url = $url . "&amount=" . $amount;
	$url = $url . "&operator=" . $operator;
	$url = $url . "&opvalue1=" . $op1;
	$url = $url . "&opvalue2=" . $op2;
	$url = $url . "&opvalue3=" . $op3;
	$url = $url . "&opvalue4=" . $op4;
	$url = $url . "&opvalue5=" . $op5;
							   
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	//curl_setopt($curl, CURLOPT_TIMEOUT, 60);
    //curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 60);
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
	
	$url = "$call_rc2_url" . "?";
	$url = $url . "bankapi_user_id=" . $bankapi_user_id;
	$url = $url . "&bankapi_user_pass=" . $bankapi_user_pass;
	$url = $url . "&bankapi_method=" . $bankapi_method;
							   
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	//curl_setopt($curl, CURLOPT_TIMEOUT, 60);
    //curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 60);
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
	
	$url = "$call_rc2_url" . "?";
	$url = $url . "bankapi_user_id=" . $bankapi_user_id;
	$url = $url . "&bankapi_user_pass=" . $bankapi_user_pass;
	$url = $url . "&bankapi_method=" . $bankapi_method;
	$url = $url . "&order_number=" . $order_number;
							   
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	//curl_setopt($curl, CURLOPT_TIMEOUT, 60);
    //curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 60);
	$response = curl_exec($curl);
	return $response ;
}
function check_order_status2($order_number)//ur order id
{
	require('zc-gyan-info-admin.php');
	$return_result="";
	
	$bankapi_user_id="100001";
	$bankapi_user_pass="9729877577";
	$bankapi_method="STTSS";
	$order_number=urlencode($order_number);
	
	$url = "$call_rc2_url" . "?";
	$url = $url . "bankapi_user_id=" . $bankapi_user_id;
	$url = $url . "&bankapi_user_pass=" . $bankapi_user_pass;
	$url = $url . "&bankapi_method=" . $bankapi_method;
	$url = $url . "&order_number=" . $order_number;
							   
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	//curl_setopt($curl, CURLOPT_TIMEOUT, 60);
    //curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 60);
	$response = curl_exec($curl);
	return $response ;
}
function check_mobile($mobile_number)
{
	require('zc-gyan-info-admin.php');
	$return_result="";
	
	$bankapi_user_id="100001";
	$bankapi_user_pass="9729877577";
	$bankapi_method="MCD";
	$mobile_number=urlencode($mobile_number);
	
	$url = "$call_rc2_url" . "?";
	$url = $url . "bankapi_user_id=" . $bankapi_user_id;
	$url = $url . "&bankapi_user_pass=" . $bankapi_user_pass;
	$url = $url . "&bankapi_method=" . $bankapi_method;
	$url = $url . "&mobile_number=" . $mobile_number;
							   
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	//curl_setopt($curl, CURLOPT_TIMEOUT, 60);
    //curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 60);
	$response = curl_exec($curl);
	return $response ;
}
function check_plan($type,$opid,$cirid)
{
	require('zc-gyan-info-admin.php');
	$return_result="";
	
	$bankapi_user_id="100001";
	$bankapi_user_pass="9729877577";
	$bankapi_method="FNDR";
	$type=urlencode($type);
	$cirid=urlencode($cirid);
	$opid=urlencode($opid);
	
	$url = "$call_rc2_url" . "?";
	$url = $url . "bankapi_user_id=" . $bankapi_user_id;
	$url = $url . "&bankapi_user_pass=" . $bankapi_user_pass;
	$url = $url . "&bankapi_method=" . $bankapi_method;
	$url = $url . "&type=" . $type;
	$url = $url . "&cirid=" . $cirid;
	$url = $url . "&opid=" . $opid;
							   
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	//curl_setopt($curl, CURLOPT_TIMEOUT, 60);
    //curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 60);
	$response = curl_exec($curl);
	return $response ;
}
?>