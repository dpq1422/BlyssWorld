<?php
include_once('../zc-common-admin.php');
$bank2state=$_POST['bank2state'];
$state2dist=$_POST['state2dist'];
$query="SELECT distinct(distt_name) dist FROM $bankapi_common.common_ifsc where bank_code='$bank2state' and state_name='$state2dist' order by distt_name";
$result=mysql_query($query);
$num_rows = mysql_num_rows($result);
$res="<select name='dist2city' id='dist2city' onchange='dist2city()'>";
$res=$res."<option value=''>Select Distt.</option>";
if($num_rows>0)
{
	while($r = mysql_fetch_array($result)) {
		$res=$res."<option>".$r['dist']."</option>";
	}
}
$res=$res."</select>";
echo json_encode($res);
?>