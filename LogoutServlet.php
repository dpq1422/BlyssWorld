<?php
	include('zc-common-admin.php');
	include('zc-session-admin.php');
	
	$query_log="update $bankapi_parent_base.parent_user_log set logout_date='$datetime_date', logout_time='$datetime_time' where user_id='$logged_user_id' and log_id='$logged_log_id';";
	$result_log=mysql_query($query_log);
	
	unset($_SESSION['logged_user_id']);
	unset($_SESSION['logged_user_type']);
	unset($_SESSION['logged_user_name']);
	unset($_SESSION['logged_log_id']);
	unset($_SESSION['logged_time1']);
	unset($_SESSION['logged_time2']);
	unset($_SESSION['welcome_time']);
	session_unset();
	session_destroy();
	session_write_close();
	$logged_user_id="";
	$logged_user_type="";
	$logged_user_type_name="";
	$logged_user_name="";
	$logged_log_id="";
	header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	clearstatcache();
	header("location: index.php");
?>