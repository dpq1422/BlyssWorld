<?php
include('zc-session-admin.php');
$ele_state="";
$resulted_data=$result="";
if(isset($_POST['ele_state']))
{
	$ele_state=$_POST['ele_state'];
}
if($ele_state!="")
{
	include_once('zf-ServiceMarginRc.php');
	$state_result=show_operators(" where operator_status=1 and service_id=105 and state='$ele_state' ");
	$result='<select class="w3-select w3-border w3-round" onchange="show_field()" id="operator" name="operator">';
	$result.='<option value="" required disabled selected>Choose your option</option>';
	while($state_row=mysql_fetch_array($state_result))
	{
		$oprid=$state_row['operator_id'];
		$sourceid=show_operator_active_source($oprid,105);
		if($sourceid==6)
		{
			$result.="<option value='$sourceid@".$state_row['api_code_3']."@".$state_row['operator_name']."'>".$state_row['operator_name']."</option>";
		}
	}
	$result.='</select>';
}
echo json_encode("$result");
?>