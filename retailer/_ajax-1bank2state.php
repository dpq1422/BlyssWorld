<?php
include_once('../zc-common-admin.php');
$bank2state=$_POST['bank2state'];
$query="SELECT distinct(state_name) state FROM $bankapi_common.common_ifsc where bank_code='$bank2state' order by state_name";
$result=mysql_query($query);
$num_rows = mysql_num_rows($result);
$res="<select name='state2dist' id='state2dist' onchange='state2dist()'>";
$res=$res."<option value=''>Select State</option>";
if($num_rows>0)
{
	while($r = mysql_fetch_array($result)) {
		$res=$res."<option>".$r['state']."</option>";
	}
}
$res=$res."</select>";
echo json_encode($res);
?>