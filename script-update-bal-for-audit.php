<?php
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	
	$start=-100;
	if(isset($_REQUEST['start']))
		$start=$_REQUEST['start'];
	
	$q1="SELECT * FROM $bankapi_child_base.child_userinfo_walletkyc where user_id>$start ORDER BY user_id ASC limit 0,1";
	$res1=mysql_query($q1);
	$user=0;
	$pre_bal=0;
	$post_bal=0;
	while($rs1=mysql_fetch_array($res1))
	{
		$user=0;
		$pre_bal=0;
		$post_bal=0;
		$user=$rs1['user_id'];
		$pre_bal=$rs1['wallet_balance'];
		
		$q2="select * from $bankapi_child_wallet.distribution where user_id='$user' order by wallet_id desc limit 0,1 ";
		$res2=mysql_query($q2);
		while($rs2=mysql_fetch_array($res2))
		{
			$post_bal=$rs2['amount_bal'];
		}
		
		$q3="update $bankapi_child_base.child_userinfo_walletkyc set wallet_balance='$post_bal' where user_id='$user';";
		mysql_query($q3);
		$start=$user;
		echo "userid : $user <br>pre bal : $pre_bal <br>post bal : $post_bal <br>start : $start";
		if($pre_bal!=$post_bal)
		{
			echo "<h1>Record Updated</h1>";
		}
		echo str_pad('',16384);flush();ob_flush();usleep(200000);
	}
	
	echo "<script>window.location.href='script-update-bal-for-audit.php?start=$start';</script>";
?>