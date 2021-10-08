<?php
$filled_mobile_no=$_POST['filled_mobile_no'];
if(isset($filled_mobile_no))
{
	echo check_user($filled_mobile_no);
}
function check_user($filled_mobile_no)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$filled_mobile_no=mysql_real_escape_string($filled_mobile_no);
	$query_chk="select * from $bankapi_child_base.child_user where user_contact_no='$filled_mobile_no';";
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