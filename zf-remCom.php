<?php
function remove_comm()
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="delete FROM $bankapi_child_txn.com_paid_child where source=5 and order_id in(SELECT order_id FROM $bankapi_child_txn.txn_mt_child where order_status in(4,5) and date(created_on)>=date(DATE_ADD(sysdate(), INTERVAL $datetime_second-604800 SECOND)));";
	mysql_query($query);
	$query="delete FROM $bankapi_child_txn.com_paid_child where source=6 and order_id in(SELECT rc_id FROM $bankapi_child_txn.txn_rc where rc_status in(4,5) and date(created_on)>=date(DATE_ADD(sysdate(), INTERVAL $datetime_second-604800 SECOND)));";
	mysql_query($query);
}
function remove_comm_all()
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="delete FROM $bankapi_child_txn.com_paid_child where source=5 and order_id in(SELECT order_id FROM $bankapi_child_txn.txn_mt_child where order_status in(4,5));";
	mysql_query($query);
	$query="delete FROM $bankapi_child_txn.com_paid_child where source=6 and order_id in(SELECT rc_id FROM $bankapi_child_txn.txn_rc where rc_status in(4,5));";
	mysql_query($query);
}
?>