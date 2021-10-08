<?php
include_once('../zc-session-admin.php');
include_once('../zc-common-admin.php');
include_once('../zc-gyan-info-admin.php');
$result="-1";
if(isset($_REQUEST['result']))
$result=$_REQUEST['result'];

$query="SELECT * FROM $bankapi_child_txn.txn_mt_child where txn_id='$result' and user_id='$logged_user_id';";
$res=mysql_query($query);
$num_rows = mysql_num_rows($res);	
if($num_rows>0)
{
	$snum="";
	$sname="";
	$rid="";
	$rname="";
	$rbank="";
	$racc="";
	$tid="";
	$bref="";
	$tdtm="";
	$tdtm2="";
	$amt=0;
	$sur=0;
	$total=0;
	$i=0;
	while($rs = mysql_fetch_assoc($res))
	{
		$snum=$rs['sender_number'];
		$rid=$rs['receiver_id'];
		$tid="";
		
		$st="";
		$st=$rs['order_status'];
		if($st==-2 || $st==-1 || $st==1 || $st==3)
			$st=" IN PROGRESS ".$rs['amount'];
		if($st==0)
			$st=" NOT INITIATED - RETRY ".$rs['amount'];
		if($st==4 || $st==-4)
			$st=" PENDING REFUND ".$rs['amount'];
		if($st==5)
			$st=" REFUNDED ".$rs['amount'];
		if($st==2)
			$st=" SUCCESS ".$rs['amount'];
		
		if($i==0 && $rs['order_status']==2)
		$bref = $bref . "<br> " . $rs['bank_ref_no'];
		else if($i!=0 && $rs['order_status']==2)
			$bref = $bref . "<br> " . $rs['bank_ref_no'];
		else if($i==0 && $rs['order_status']!=2)
		$bref = $bref . "<br> $st ";
		else if($i!=0 && $rs['order_status']!=2)
		$bref = $bref . "<br> $st ";
	
		$tdtm = strtotime($rs['created_on']);
		$tdtm = date("d/M/Y", $tdtm);
		$tdtm2 = strtotime($rs['updated_on']);
		$tdtm2 = date("d/M/Y g:i A", $tdtm2);
		$amt+=$rs['amount'];
		$sur+=$rs['com_charged'];
		$total+=$rs['deducted'];
		$i++;
		$sname=$rs['sname'];
		$rname=$rs['rname'];
		$rbank=$rs['rbname'];
		$racc=$rs['racc'];
	}
?>
<html>
	<head>
		<title>Print Receipt</title>
		<style>body{background:url(../img/sample.png) no-repeat;}</style>
	</head>
	<body>
		<table cellpadding='0' cellspacing='0'>
			<tr height='50'>
				<td align='center' colspan='2'><b>RECEIPT</b></td>
			</tr>
			<tr>
				<td colspan='2'><hr/></td>
			</tr>
			<tr height='30'>
				<td width='350'>Invoice No.: <?php echo "".$result."";?></td>
				<td width='350' align='right'>Date:<?php echo $tdtm;?></td>
			</tr>
			<tr>
				<td colspan='2'><hr/></td>
			</tr>
			<tr height='30'>
				<td align='left' colspan='2'><b>TRANSACTION DETAILS</b></td>
			</tr>
			<tr>
				<td colspan='2'><hr/></td>
			</tr>
			<tr height='30'>
				<td><b>Sender Name</b></td>
				<td><?php echo $sname;?></td>
			</tr height='30'>
			<tr height='30'>
				<td><b>Sender Mobile</b></td>
				<td><?php echo $snum;?></td>
			</tr height='30'>
			<tr height='30'>
				<td><b>Receiver Name</b></td>
				<td><?php echo $rname;?></td>
			</tr>
			<tr height='30'>
				<td><b>Receiver Bank Name</b></td>
				<td><?php echo $rbank;?></td>
			</tr>
			<tr height='30'>
				<td><b>Receiver Account Number</b></td>
				<td><?php echo $racc;?></td>
			</tr>
			<tr height='30'>
				<td><b>Transaction ID</b></td>
				<td><?php echo "".$result."";?></td>
			</tr>
			<tr height='30'>
				<td><b>Bank Reference Number</b></td>
				<td><?php echo "".$bref."";?></td>
			</tr>
			<tr height='30'>
				<td><b>Date &amp; Time</b></td>
				<td><?php echo $tdtm2;?></td>
			</tr>
			<tr height='30'>
				<td><b>Amount</b></td>
				<td><?php echo $amt;?></td>
			</tr>
			<tr height='30'>
				<td><b>Sur-Charge</b></td>
				<td><?php echo $sur;?></td>
			</tr>
			<tr>
				<td colspan='2'><hr/></td>
			</tr>
			<tr height='30'>
				<td><b>TOTAL AMOUNT</b></td>
				<td><b><?php echo $total;?></b></td>
			</tr>
			<tr>
				<td colspan='2'><hr/></td>
			</tr>
			<tr height='30'>
				<td align='center' colspan='2'><i>This is a system generated receipt, hence no seal or signature required.</i></td>
			</tr>
			<tr>
				<td colspan='2'>&nbsp;</td>
			</tr>
		</table>
		<input type='button' style='float:right;' onclick="print()" value="print"/>
	</body>
</html>
<?php
}
else
{
	echo "No Receipt Available - Txn No does not exist.";
}
?>
