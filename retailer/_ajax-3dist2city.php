<?php
include_once('../zc-common-admin.php');
$bank2state=$_POST['bank2state'];
$state2dist=$_POST['state2dist'];
$dist2city=$_POST['dist2city'];
$query="SELECT distinct(city_name) city FROM $bankapi_common.common_ifsc where bank_code='$bank2state' and state_name='$state2dist' and distt_name='$dist2city' order by city_name";
$result=mysql_query($query);
$num_rows = mysql_num_rows($result);
$res="<select name='city2branch' id='city2branch' onchange='city2branch()'>";
$res=$res."<option value=''>Select Distt.</option>";
if($num_rows>0)
{
	while($r = mysql_fetch_array($result)) {
		$res=$res."<option>".$r['city']."</option>";
	}
}
$res=$res."</select>";
echo json_encode($res);
?>