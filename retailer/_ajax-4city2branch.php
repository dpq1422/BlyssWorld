<?php
include_once('../zc-common-admin.php');
$bank2state=$_POST['bank2state'];
$state2dist=$_POST['state2dist'];
$dist2city=$_POST['dist2city'];
$city2branch=$_POST['city2branch'];
$query="SELECT distinct(branch_name) branch FROM $bankapi_common.common_ifsc where bank_code='$bank2state' and state_name='$state2dist' and distt_name='$dist2city' and city_name='$city2branch' order by branch_name";
$result=mysql_query($query);
$num_rows = mysql_num_rows($result);
$res="<select name='branch2detail' id='branch2detail' onchange='branch2detail()'>";
$res=$res."<option value=''>Select Branch</option>";
if($num_rows>0)
{
	while($r = mysql_fetch_array($result)) {
		$res=$res."<option>".$r['branch']."</option>";
	}
}
$res=$res."</select>";
echo json_encode($res);
?>