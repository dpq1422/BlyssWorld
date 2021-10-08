<?php
$filled_aadhar_no=$_POST['filled_aadhar_no'];
if(isset($filled_aadhar_no))
{
	echo check_user($filled_aadhar_no);
}
function check_user($filled_aadhar_no)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$filled_aadhar_no=mysql_real_escape_string($filled_aadhar_no);
	$query_chk="select * from $bankapi_child_base.child_userinfo_walletkyc where aadhar_no='$filled_aadhar_no';";
	$result_chk=mysql_query($query_chk);
	$i=0;
	while($row_chk=mysql_fetch_array($result_chk))
	{
		$i++;
	}
	$i=json_encode($i);
	return $i;
}
?>