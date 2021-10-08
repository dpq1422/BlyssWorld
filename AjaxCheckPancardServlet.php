<?php
$filled_pancard_no=$_POST['filled_pancard_no'];
if(isset($filled_pancard_no))
{
	echo check_user($filled_pancard_no);
}
function check_user($filled_pancard_no)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$filled_pancard_no=mysql_real_escape_string($filled_pancard_no);
	$query_chk="select * from $bankapi_child_base.child_userinfo_walletkyc where pancard_no='$filled_pancard_no';";
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