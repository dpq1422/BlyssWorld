<?php
$filled_e_mail=$_POST['filled_e_mail'];
if(isset($filled_e_mail))
{
	echo check_user($filled_e_mail);
}
function check_user($filled_e_mail)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$filled_e_mail=mysql_real_escape_string($filled_e_mail);
	$query_chk="select * from $bankapi_child_base.child_user where e_mail='$filled_e_mail';";
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