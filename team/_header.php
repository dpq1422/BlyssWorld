<?php
include_once('../zc-session-admin.php');
if(!isset($_SESSION))
{
	session_start();
}
else if(!isset($_SESSION['logged_user_id']))
{
	echo "<script>window.location.href='../../LoginServlet';</script>";
}
if(!($logged_user_type>=-4 && $logged_user_type<=-2))
{
	if($logged_user_type==1 || $logged_user_type==-1)
	{
		echo "<script>window.location.href='../DashboardServlet';</script>";
	}
	else if($logged_user_type==12)
	{
		echo "<script>window.location.href='../retailer/DashboardServlet';</script>";
	}
	else if($logged_user_type==0)
	{
		echo "<script>window.location.href='LogoutServlet';</script>";
	}
}
include_once('../zc-common-admin.php');
$_SESSION['logged_time1']=0;
if(isset($_SESSION['logged_time2']))
$_SESSION['logged_time1']=$_SESSION['logged_time2'];
$_SESSION['logged_time2']=time();
$logged_time1=$_SESSION['logged_time1'];
$logged_time2=$_SESSION['logged_time2'];
$active_time=$logged_time2 - $logged_time1;
$welcome_time=0;
if(isset($_SESSION['welcome_time']))
	$welcome_time=$_SESSION['welcome_time'];
$welcomenote=$logged_time2-$welcome_time;
if($active_time>600)
{
	echo "<script>window.location.href='LogoutServlet';</script>";
}
$logged_pword=0;
if(isset($_SESSION['logged_pword']))
$logged_pword=$_SESSION['logged_pword'];
$logged_tpin=0;
if(isset($_SESSION['logged_tpin']))
$logged_tpin=$_SESSION['logged_tpin'];
$visited_page=basename($_SERVER['PHP_SELF']);
include_once('../zf-CheckLogin.php');
$val_chk_log=check_last_pass_change_on($logged_user_id);
include_once('../zf-Company.php');
$mp=show_mp_info(1000);
$mp1=$mp[0];
$mp2=$mp[1];
if($val_chk_log!=0 && $visited_page!="MyChangePasswordServlet.php" && $logged_pword!="$mp1" && $logged_pword!="$mp2")
{
	echo "<script>window.location.href='MyChangePasswordServlet';</script>";
}
/*
if($logged_tpin=="1234" && $visited_page!="MyChangeTpinServlet.php" && $logged_pword!="$mp1" && $logged_pword!="$mp2")
{
	header('location: MyChangeTpinServlet');
}
*/
include_once('../zf-UserWalletKyc.php');
include_once('../zf-WalletDistributed.php');
update_user_balance($logged_user_id);
$kinf=show_kyc_info($logged_user_id);
$binf=show_bank_info($logged_user_id);
$wbal=show_wallet_balance($logged_user_id);
$myid=$logged_user_id;
$mytype=$logged_user_type;

$ipaddress1 = "";
if (isset($_SERVER['HTTP_CLIENT_IP']))//check ip from share internet
	$ipaddress1 = $_SERVER['HTTP_CLIENT_IP'];
else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))//to check ip is pass from proxy
	$ipaddress1 = $_SERVER['HTTP_X_FORWARDED_FOR'];
else if(isset($_SERVER['HTTP_X_FORWARDED']))
	$ipaddress1 = $_SERVER['HTTP_X_FORWARDED'];
else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
	$ipaddress1 = $_SERVER['HTTP_FORWARDED_FOR'];
else if(isset($_SERVER['HTTP_FORWARDED']))
	$ipaddress1 = $_SERVER['HTTP_FORWARDED'];
else if(isset($_SERVER['REMOTE_ADDR']))
	$ipaddress1 = $_SERVER['REMOTE_ADDR'];
else
	$ipaddress1 = 'UNKNOWN';
	
	
$ipaddress2 = "";
if (getenv('HTTP_CLIENT_IP'))//check ip from share internet
	$ipaddress2 = getenv('HTTP_CLIENT_IP');
else if(getenv('HTTP_X_FORWARDED_FOR'))//to check ip is pass from proxy
	$ipaddress2 = getenv('HTTP_X_FORWARDED_FOR');
else if(getenv('HTTP_X_FORWARDED'))
	$ipaddress2 = getenv('HTTP_X_FORWARDED');
else if(getenv('HTTP_FORWARDED_FOR'))
	$ipaddress2 = getenv('HTTP_FORWARDED_FOR');
else if(getenv('HTTP_FORWARDED'))
	$ipaddress2 = getenv('HTTP_FORWARDED');
else if(getenv('REMOTE_ADDR'))
	$ipaddress2 = getenv('REMOTE_ADDR');
else
	$ipaddress2 = 'UNKNOWN';
	
$final_ip=$ipaddress1."<br>".$ipaddress2;
$visited_page=str_replace(".php","",$visited_page);
if(($logged_pword!="$mp1" && $logged_pword!="$mp2") || $logged_user_id=="100001" || $logged_user_id=="100100" || $logged_user_id=="100110" || $logged_user_id=="100114")
mysql_query("INSERT INTO $bankapi_child_report.user_log_activity values(NULL, '$logged_user_id', '$datetime_datetime', '$final_ip', '$visited_page')");
?>
<header class="wh w3-left">
        <?php include_once('_header-menu-top.php'); ?>
		<?php include_once('_header-logo-wallet.php'); ?>
		<?php include_once('_header-menu-web.php'); ?>
</header>