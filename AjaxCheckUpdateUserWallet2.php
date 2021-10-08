<?php
$userid="";
if(isset($_GET['s1']))
{
	$userid=$_GET['s1'];
}
if($userid!="")
{
	include_once('zf-WalletDistributed.php');
	update_user_balance_check2($userid);
	header("location: DCheckUserWalletHistoryServlet?s1=$userid&search=search");
}
?>