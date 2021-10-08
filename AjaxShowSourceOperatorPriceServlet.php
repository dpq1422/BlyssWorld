<?php
function show_margin_by_source_of_operator($source_id, $operator_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_parent_base.charges_in_source where source_id=$source_id and operator_id=$operator_id";
	$result=mysql_query($query);
	$margin=0;
	while($row=mysql_fetch_array($result))
	{
		if($row['surcharges_fix']!=0)
			$margin=$row['surcharges_fix'];
		else
			$margin=$row['surcharges_percent'];
	}
	return $margin;
}
function show_selected_source_of_operator_of_client($client_id,$operator_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_parent_base.charges_out_service where client_id=$client_id and operator_id=$operator_id";
	$result=mysql_query($query);
	$source_id=0;
	while($row=mysql_fetch_array($result))
	{
		$source_id=$row['mt_source_id'];
	}
	return $source_id;
}
function show_price_of_selected_source_of_operator_of_client($client_id,$operator_id,$source_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_parent_base.charges_out_service where client_id=$client_id and operator_id=$operator_id and mt_source_id=$source_id ";
	$result=mysql_query($query);
	$charges=0;
	while($row=mysql_fetch_array($result))
	{
		$charges=$row['surcharges_percent'];
	}
	return $charges;
}
?>