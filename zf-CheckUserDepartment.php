<?php
function check_user_department($user_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$user_department_info=0;
	$query="select * from $bankapi_child_base.child_user where user_id='$user_id'";
	$result=mysql_query($query);
	while($row=mysql_fetch_array($result))
	{
		$user_department_info=$row['user_department_info'];
	}
	return $user_department_info;
}
?>