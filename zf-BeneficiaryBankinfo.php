<?php
//$call_mt1_url
function show_beneficiary_ifsc($brid)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$ifsc="";
	$query="SELECT * FROM $bankapi_common.eko_receiver where receiver_id='$brid';";
	$result=mysql_query($query);
	while($row = mysql_fetch_array($result)) 
	{
		$ifsc=$row['ifsc'];
	}
	return $ifsc;
}
function show_beneficiary_bankid($brid)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$bank="";
	$bankid=0;
	$query="SELECT * FROM $bankapi_common.eko_receiver where receiver_id='$brid';";
	$result=mysql_query($query);
	while($row = mysql_fetch_array($result)) 
	{
		$bank=$row['bank'];
	}
	$query2="SELECT * FROM $bankapi_common.eko_bank where name='$bank' or bank_name='$bank';";
	$result2=mysql_query($query2);
	while($row2 = mysql_fetch_array($result2)) 
	{
		$bankid=$row2['eko_bank_id'];
	}
	return $bankid;
}
?>