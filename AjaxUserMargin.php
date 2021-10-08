<?php
include('zf-WalletsMarginsForTxn.php');
include('zc-session-admin.php');
$uid=$_POST['uid'];
$sid=$_POST['sid'];
$method=$_POST['method'];
$amount=$_POST['amount'];
$rate=show_user_mt_rate($uid, $sid, $method, $amount);
echo json_encode($rate);
?>