<?php
include('zc-session-admin.php');
$banktype="";
$tp="";
$resulted_data=$result="";
$cond="";
if(isset($_POST['banktype']))
{
	$banktype=$_POST['banktype'];
}
if(isset($_POST['tp']))
{
	$tp=$_POST['tp'];
}
if($banktype!="" && $tp!="")
{
	include_once("zf-TxnSource"."$tp"."DmtApi.php");
	if($banktype!="All Banks")
	{
		$cond=" and btype='$banktype' ";
	}
	else
	{
		$cond=" and 1=1 ";
	}
	$result_bank=show_bank_filtered($cond);
	$result="<select class='w3-select w3-border w3-round' name='bbnk' onchange='pullIFSC1$tp()' required id='bankCode'>";
	$result.='<option value="" disabled selected>Choose your option</option>';
	$number=0;
	while($result_bank_row=mysql_fetch_array($result_bank))
	{
		$number++;
		$bnk=$result_bank_row['eko_bank_id']."@".$result_bank_row['bank_code']."@".$result_bank_row['ifsc_status']."@".$result_bank_row['bank_name']."@".$result_bank_row['b3_universal'];
		$bnk_name=$result_bank_row['bank_name'];
		$result.="<option value='$bnk'>$bnk_name</option>";
	}	
	$result.='</select>';
}
echo json_encode("$result");
?>