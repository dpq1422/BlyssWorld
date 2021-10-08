<?php
/*
if(!isset($_SESSION))
{
	session_start();
}*/
date_default_timezone_set('Asia/Kolkata');
ini_set('error_reporting', E_ALL);
ini_set('display_errors', '0');


require('zc-gyan-info-admin.php');
$datetime_second="0";
$domain_name=$_SERVER['HTTP_HOST'];
if($domain_name!="localhost")
$datetime_second="19800";//19800
$query_time="select date(DATE_ADD(sysdate(), INTERVAL $datetime_second SECOND)) as datetime_date,
time(DATE_ADD(sysdate(), INTERVAL $datetime_second SECOND)) as datetime_time,
sysdate() + interval $datetime_second second as datetime_datetime;";
$result_time=mysql_query($query_time);
$datetime_date="";
$datetime_time="";
$datetime_datetime="";
while($row_time=mysql_fetch_array($result_time))
{
	$datetime_date=$row_time['datetime_date'];
	$datetime_time=$row_time['datetime_time'];
	$datetime_datetime=$row_time['datetime_datetime'];
}

//error_reporting(0); // for server
//ob_start("ob_gzhandler"); // for server

//ini_set("log_errors", 1);
//ini_set("error_log", "_error_log.txt");
?>