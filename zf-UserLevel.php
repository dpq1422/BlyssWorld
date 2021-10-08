<?php
function show_parent_id($user_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_base.child_userinfo_level where user_id='$user_id' ";
	$result=mysql_query($query);
	$parent_id=0;
	while($res=mysql_fetch_array($result))
	{
		if($res['id_12']!=0)
			$parent_id=$res['id_12'];
		else if($res['id_11']!=0)
			$parent_id=$res['id_11'];
		else if($res['id_10']!=0)
			$parent_id=$res['id_10'];
		else if($res['id_09']!=0)
			$parent_id=$res['id_09'];
		else if($res['id_08']!=0)
			$parent_id=$res['id_08'];
		else if($res['id_07']!=0)
			$parent_id=$res['id_07'];
		else if($res['id_06']!=0)
			$parent_id=$res['id_06'];
		else if($res['id_05']!=0)
			$parent_id=$res['id_05'];
		else if($res['id_04']!=0)
			$parent_id=$res['id_04'];
		else if($res['id_03']!=0)
			$parent_id=$res['id_03'];
		else if($res['id_02']!=0)
			$parent_id=$res['id_02'];
		else if($res['id_01']!=0)
			$parent_id=$res['id_01'];
	}
	return $parent_id;
}
function show_parent_id222($user_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_base.child_userinfo_level where user_id='$user_id' ";
	$result=mysql_query($query);
	$parent_id=0;
	while($res=mysql_fetch_array($result))
	{
		if($res['id_12']!=0)
			$parent_id=$res['id_12'];
		else if($res['id_11']!=0)
			$parent_id=$res['id_11'];
		else if($res['id_10']!=0)
			$parent_id=$res['id_10'];
		else if($res['id_09']!=0)
			$parent_id=$res['id_09'];
		else if($res['id_08']!=0)
			$parent_id=$res['id_08'];
		else if($res['id_07']!=0)
			$parent_id=$res['id_07'];
		else if($res['id_06']!=0)
			$parent_id=$res['id_06'];
		else if($res['id_05']!=0)
			$parent_id=$res['id_05'];
		else if($res['id_04']!=0)
			$parent_id=$res['id_04'];
		else if($res['id_03']!=0)
			$parent_id=$res['id_03'];
		else if($res['id_02']!=0)
			$parent_id=$res['id_02'];
	}
	return $parent_id;
}

function isMyUser($usertype,$myid,$userid)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_base.child_userinfo_level where user_id='$userid' ";
	if($usertype==1)
	$query="$query and id_01='$myid' and id_02=0 and id_03=0 and id_04=0 and id_05=0 and id_06=0 and id_07=0 and id_08=0 and id_09=0 and id_10=0 and id_11=0 and id_12=0 ";
	if($usertype==2)
	$query="$query and id_02='$myid' and id_03=0 and id_04=0 and id_05=0 and id_06=0 and id_07=0 and id_08=0 and id_09=0 and id_10=0 and id_11=0 and id_12=0 ";
	if($usertype==3)
	$query="$query and id_03='$myid' and id_04=0 and id_05=0 and id_06=0 and id_07=0 and id_08=0 and id_09=0 and id_10=0 and id_11=0 and id_12=0 ";
	if($usertype==4)
	$query="$query and id_04='$myid' and id_05=0 and id_06=0 and id_07=0 and id_08=0 and id_09=0 and id_10=0 and id_11=0 and id_12=0 ";
	if($usertype==5)
	$query="$query and id_05='$myid' and id_06=0 and id_07=0 and id_08=0 and id_09=0 and id_10=0 and id_11=0 and id_12=0 ";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	return $total_records;
}
function isMyTeam($myid,$userid)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_base.child_userinfo_level where user_id='$userid' and (id_01='$myid' or id_02='$myid' or id_03='$myid' or id_04='$myid' or id_05='$myid' or id_06='$myid' or id_07='$myid' or id_08='$myid' or id_09='$myid' or id_10='$myid' or id_11='$myid' or id_12='$myid') ";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	return $total_records;
}
?>