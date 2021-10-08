<?php
$ajax_states=$_POST['states'];
if(isset($ajax_states))
{
	echo show_all_ajax_districts_of_state($ajax_states);
}
function show_all_ajax_districts_of_state($state_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_common.common_district where state_id=$state_id";
	$result=mysql_query($query);
	$return_result="<option value='' disabled selected>Select district</option>";
	while($row=mysql_fetch_array($result))
	{
		$return_result=$return_result."<option value='".$row['distt_id']."'>".$row['distt_name']."</option>";
	}
	$return_result=json_encode($return_result);
	return $return_result;
}
?>