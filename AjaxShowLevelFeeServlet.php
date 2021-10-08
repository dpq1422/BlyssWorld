<?php
$ajax_utype=$_POST['utype'];
if(isset($ajax_utype))
{
	echo show_level_fee($ajax_utype);
}
function show_level_fee($level_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_base.child_level where level_id=$level_id";
	$result=mysql_query($query);
	$return_result="";
	while($row=mysql_fetch_array($result))
	{
		$return_result=$row['security_min']."@".$row['security_max']."@".$row['software_min']."@".$row['software_max'];
	}
	$return_result=json_encode($return_result);
	return $return_result;
}
?>