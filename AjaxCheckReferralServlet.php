<?php
$filled_referral_id=$_POST['filled_referral_id'];
if(isset($filled_referral_id))
{
	echo check_user($filled_referral_id);
}
function check_user($filled_referral_id)
{
	require('zc-gyan-info-admin.php');
	//require('zc-commons-admin.php');
	$filled_referral_id=mysql_real_escape_string($filled_referral_id);
	$i=0;
	$query_chk="select * from $bankapi_child_base.child_user where user_id='$filled_referral_id' and user_type='12' and ref_accepted='1' and user_status='1';";// user_status in('1','2')
	$result_chk=mysql_query($query_chk);
	$j="";
	while($row_chk=mysql_fetch_array($result_chk))
	{
		$i++;
		$j=$row_chk['user_name'];
		$j=explode(" ",$j)[0];
		$k=$row_chk['user_status'];
		$j="$j";
	}
	$i=$j;
	$i=json_encode($i);
	return $i;
}
?>