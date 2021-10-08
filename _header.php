<?php
if(!isset($_SESSION))
{
	session_start();
}
include_once('zc-session-admin.php');
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
if($active_time>3000000)
{
	header("location: LogoutServlet");
}
include('zf-CheckLogin.php');
$val_chk_log=check_last_pass_change_on($logged_user_id);
/*
if($val_chk_log!=0 && basename($_SERVER['PHP_SELF'])!="MyChangePasswordServlet.php")
{
	header('location: MyChangePasswordServlet');
}
*/
include_once('zf-CheckUserDepartment.php');
$user_department_info=check_user_department($logged_user_id);
include_once('zf-WalletDistributed.php');
$dist_bal=show_distributed_balance();
$rt1=show_rt1();
$rt2=show_rt2();
$rt3=show_rt3();
$rt4=show_rt4();
$rt5=show_rt5();
$rt6=show_rt6();
?>
<header class="wh w3-left">
        <?php include_once('_header-menu-top.php'); ?>
		<?php include_once('_header-logo-wallet.php'); ?>
		<?php include_once('_header-menu-web.php'); ?>
</header>