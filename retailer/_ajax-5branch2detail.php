<?php
include_once('../zc-common-admin.php');
$bank2state=$_POST['bank2state'];
$state2dist=$_POST['state2dist'];
$dist2city=$_POST['dist2city'];
$city2branch=$_POST['city2branch'];
$branch2detail=$_POST['branch2detail'];
$query="SELECT * FROM $bankapi_common.common_ifsc where bank_code='$bank2state' and state_name='$state2dist' and distt_name='$dist2city' and city_name='$city2branch' and branch_name='$branch2detail'";
$result=mysql_query($query);
$num_rows = mysql_num_rows($result);
$res="<b>Details : </b><br><br>";
if($num_rows>0)
{
	while($r = mysql_fetch_array($result)) {
		$res=$res."IFSC CODE : ".$r['ifsc_code']."<br><br>";
		$res=$res."MICR CODE : ".$r['micr_code']."<br><br>";
		$res=$res."BRANCH NAME : ".$r['branch_name']."<br><br>";
		$res=$res."<b>ADDRESS : </b><br><br><a style='line-height:24px;'>".$r['address']."<br><br></a>";
		$res=$res."CONTACT NUMBER : ".$r['contact_number']."<br><br>";
		$res=$res."CITY : ".$r['city_name']."<br><br>";
		$res=$res."DISTT. : ".$r['distt_name']."<br><br>";
		$res=$res."STATE : ".$r['state_name']."<br><br>";
	}
}
else
{
	$res=$res."No details found.";
}
echo json_encode($res);
?>