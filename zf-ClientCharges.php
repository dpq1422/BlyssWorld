<?php
function show_clients_charges_data($client_id, $service_id, $operator_id, $slab_from, $slab_to, $source_id=0)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_parent_base.charges_out_service where client_id='$client_id' and service_id='$service_id' and operator_id='$operator_id' and mt_source_id='$source_id' and slab_from='$slab_from' and slab_to='$slab_to' ";
	$result=mysql_query($query);
	return $result;
}
function delete_clients_charges($client_id, $service_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="delete from $bankapi_parent_base.charges_out_service where client_id='$client_id' and service_id='$service_id' ";
	mysql_query($query);
}
function store_clients_charges($client_id, $service_id, $operator_id, $charges_type, $slab_from, $slab_to, $surcharges_fix, $surcharges_percent, $utypes, $uid, $uname, $mt_source_id=0,$clienttype=0)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$remarks="last updated by $utypes ($uid - $uname) at $datetime_datetime";
	$query="insert into $bankapi_parent_base.charges_out_service (client_id, service_id, operator_id, charges_type, slab_from, slab_to, surcharges_fix, surcharges_percent, charges_status, charges_remarks, mt_source_id) value('$client_id', '$service_id', '$operator_id', '$charges_type', '$slab_from', '$slab_to', '$surcharges_fix', '$surcharges_percent', '1', '$remarks', '$mt_source_id') ";
	mysql_query($query);
	
	if($service_id==102 || $service_id==103)
	{
		$bankapi_child_base="$bankapi_child".$clienttype."_".$client_id."_base";
		$query2="update $bankapi_child_base.child_service_margin_fix set id_00='$surcharges_percent' where operator_id='$operator_id' and service_id='$service_id';";
		mysql_query($query2);
	}
	if($service_id==101)
	{
		$bankapi_child_base="$bankapi_child".$clienttype."_".$client_id."_base";
		$field="m_0".$slab_to;
		$query2="update $bankapi_child_base.child_service_margin_mt set $field='$surcharges_fix' where source_id='$mt_source_id' and user_id='100001';";
		mysql_query($query2);
	}
}
?>