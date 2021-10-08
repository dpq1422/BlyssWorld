<?php
function show_margins_count($cond)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_base.child_service_margin_fix $cond order by operator_id ";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	return $total_records;
}
function show_margins_data($cond, $start_from=0, $num_rec_per_page=0)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$start_from=mysql_real_escape_string($start_from);
	$num_rec_per_page=mysql_real_escape_string($num_rec_per_page);
	if($start_from==0 && $num_rec_per_page==0)
	$query="select * from $bankapi_child_base.child_service_margin_fix $cond order by operator_id ";
	else
	$query="select * from $bankapi_child_base.child_service_margin_fix $cond order by operator_id LIMIT $start_from, $num_rec_per_page";
	$result=mysql_query($query);
	return $result;
}
function update_margin_distribution_levels($service_id,$operator_id,$id_00,$id_01,$id_02,$id_03,$id_04,$id_05,$id_06,$id_07,$id_08,$id_09,$id_10,$id_11,$id_12)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	for($aa=0;$aa<count($id_00);$aa++)
	{
		$service_ids=mysql_real_escape_string($service_id[$aa]);
		$operator_ids=mysql_real_escape_string($operator_id[$aa]);
		$id_00s=mysql_real_escape_string($id_00[$aa]);
		$id_01s=$id_02s=$id_03s=$id_04s=$id_05s=$id_06s=$id_07s=$id_08s=$id_09s=$id_10s=$id_11s=$id_12s=0;
		if(isset($id_01[$aa]))
		$id_01s=mysql_real_escape_string($id_01[$aa]);
		if(isset($id_02[$aa]))
		$id_02s=mysql_real_escape_string($id_02[$aa]);
		if(isset($id_03[$aa]))
		$id_03s=mysql_real_escape_string($id_03[$aa]);
		if(isset($id_04[$aa]))
		$id_04s=mysql_real_escape_string($id_04[$aa]);
		if(isset($id_05[$aa]))
		$id_05s=mysql_real_escape_string($id_05[$aa]);
		if(isset($id_06[$aa]))
		$id_06s=mysql_real_escape_string($id_06[$aa]);
		if(isset($id_07[$aa]))
		$id_07s=mysql_real_escape_string($id_07[$aa]);
		if(isset($id_08[$aa]))
		$id_08s=mysql_real_escape_string($id_08[$aa]);
		if(isset($id_09[$aa]))
		$id_09s=mysql_real_escape_string($id_09[$aa]);
		if(isset($id_10[$aa]))
		$id_10s=mysql_real_escape_string($id_10[$aa]);
		if(isset($id_11[$aa]))
		$id_11s=mysql_real_escape_string($id_11[$aa]);
		if(isset($id_12[$aa]))
		$id_12s=mysql_real_escape_string($id_12[$aa]);
		
		$query="update $bankapi_child_base.child_service_margin_fix set id_00='$id_00s', id_01='$id_01s', id_02='$id_02s', id_03='$id_03s', id_04='$id_04s', id_05='$id_05s', id_06='$id_06s', id_07='$id_07s', id_08='$id_08s', id_09='$id_09s', id_10='$id_10s', id_11='$id_11s', id_12='$id_12s' where operator_id='$operator_ids' and service_id='$service_ids';";
		mysql_query($query);
	}
}
?>