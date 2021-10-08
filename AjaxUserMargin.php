<?php
include('zc-session-admin.php');
$uid=$_POST['uid'];
$sid=$_POST['sid'];
$method=$_POST['method'];
$amount_rcv=$_POST['amount'];
$amt=$amount_rcv;
$limit=5000;
$rate=0;
do
{
	if($amt>$limit)
	{
		$amount=$limit;
		$amt=$amt-$amount;
	}
	else
	{
		$amount=$amt;
		$amt=$amt-$amount;
	}
	$query="SELECT * FROM $bankapi_child_base.child_service_margin_mt where user_id='$uid' and source_id='$sid' and payment_method='$method'";
	$result=mysql_query($query);
	$num_rows = mysql_num_rows($result);
	if($num_rows>0)
	{
		while($r = mysql_fetch_array($result)) {
			if($amount<=0)
			$rate+=0;
			else if($amount>0 && $amount<=1000)
			$rate+=$r['m_01000'];
			else if($amount>1000 && $amount<=2000)
			$rate+=$r['m_02000'];
			else if($amount>2000 && $amount<=3000)
			$rate+=$r['m_03000'];
			else if($amount>3000 && $amount<=4000)
			$rate+=$r['m_04000'];
			else if($amount>4000 && $amount<=5000)
			$rate+=$r['m_05000'];		
			else if($amount>5000)
			$rate+=0;
		}
	}
}
while($amt>0);
echo json_encode($rate);
?>