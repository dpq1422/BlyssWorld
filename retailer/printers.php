<?php
include_once('../zc-session-admin.php');
include_once('../zc-common-admin.php');
include_once('../zc-gyan-info-admin.php');
include_once('../zf-User.php');
$result="-1";
if(isset($_REQUEST['result']))
$result=$_REQUEST['result'];

$query="SELECT * FROM $bankapi_child_txn.txn_rc where rc_id='$result' and user_id='$logged_user_id';";
$res=mysql_query($query);
$num_rows = mysql_num_rows($res);	
if($num_rows>0)
{
	$mobs=show_user_profile($logged_user_id);
	while($abcde=mysql_fetch_array($mobs))
	{
		$mobs=$abcde['user_contact_no'];
	}
?>
<html>
	<head>
		<title>Print Receipt</title>
		<style>
			body{background:url(../img/sample.png) no-repeat;font-family:Calibri;}
			.fb{font-size:22px;line-height:46px;}
			.fm{font-size:18px;}
			.fs{font-size:12px;}
			.up{text-transform:uppercase;}
		</style>
	</head>
	<body>
		<div style='border:1px solid #c5c5c5;padding:10px;width:560px;'>
			<table cellpadding="0" cellspacing="0" width='100%'>
				<tr height='50'>
					<td align='left' width='50%'>
						<img src='https://blysspay.com/img/loing-center/logo.png'/>
						<br>CIN No: U74999HR2018PTC074901
						<br>GST No: 06AAHCB9152C1ZV
					</td>
					<td align='right' width='50%'>
						<b class='fb'>Blyss Fintech Private Limited</b>
						<br>303, NJP, Mahesh Nagar,
						<br>Ambala, Haryana – 133001
						<br>Email: support@blysspay.in
						<br>Contact No: +91 9896677625&nbsp;
					</td>
				</tr>
				<tr>
					<td colspan="2"><hr></td>
				</tr>
			</table>
			<table cellpadding="0" cellspacing="0" width='100%'>
				<tr height="50">
					<td align="center" colspan="4"><b class='fm'>Transaction Receipt</b></td>
				</tr>
				<tr height="30">
					<td width="25%" align="left">RO Code: </td>
					<td width="25%" align="left"><?php echo $logged_user_id;?></td>
					<td width="25%" align="left">RO Name:</td>
					<td width="25%" align="left"><?php echo $logged_user_name;?></td>
				</tr>
				<?php
				while($rs = mysql_fetch_assoc($res))
				{
					$st="";
					$st=$rs['rc_status'];
					if($st=="-2" || $st=="-1" || $st=="1" || $st=="3")
						$st=" IN PROGRESS ";
					else if($st=="0")
						$st=" NOT INITIATED ";
					else if($st=="4" || $st=="-4")
						$st=" PENDING REFUND ";
					else if($st=="5")
						$st=" REFUNDED ";
					else if($st=="2" && $rs['tid']!="0")
						$st=" ".$rs['tid']." ";
					else if($st=="2" && $rs['tid']=="0")
						$st=" ".$rs['mid']." ";
				?>
				<tr height='30'>
					<td width='25%' align="left">Biller Name: </td>
					<td width='25%' align="left"><?php echo $rs['operator'];?></td>
					<td width='25%' align='left'>Acc/No: </td>
					<td width='25%' align='left' class='up'><?php echo $rs['mobile_number'];?></td>
				</tr>
				<tr>
					<td colspan="4"><hr></td>
				</tr>		
			</table>
			<table cellpadding="0" cellspacing="0" width='100%'>
				<tr height="30">
					<th align='left' width='25%'>Order ID</th>
					<th align='left' width='25%'>Txn Date &amp; Time</th>
					<th align='right' width='25%'>Amount&nbsp;&nbsp;&nbsp;&nbsp;</th>
					<th align='left' width='25%'>Reference No.</th>
				</tr>		
				<tr height="30">
					<td align='left'><?php echo $rs['rc_id'];?></td>
					<td align='left'><?php echo $rs['created_on'];?></td>
					<td align='right'><?php echo $rs['amount'];?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
					<td align='left'><?php echo $st;?></td>
				</tr>	
				<tr>
					<td colspan="4"><hr></td>
				</tr>	
				<tr>
					<td colspan='4' align="right"><br><br>Signature RO Agent&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
				</tr>	
				<tr>
					<td colspan='4' align="right"><?php echo $logged_user_name;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
				</tr>	
				<tr>
					<td colspan='4' align="right"><?php echo $mobs;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
				</tr>
			</table>
				<?php
				}
				?>	
			<table cellpadding="0" cellspacing="0" width='100%'>
				<tr height="30">
					<td align="left"><br><b>Generic T&amp;C / Disclaimer</b>
						<ul class='fs'>
							<li>For any registration related issues, customer should contact the RO Agent.</li>
							<li>Customer is requested to furnish correct Biller details to RO Agent.</li>
							<li>BLYSS will not entertain any complaint with reference to any mistake/omission on the part of the customer.</li>
						</ul>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td><input type="button" style="float:right;" onclick="print()" value="Print"></td>
				</tr>
			</table>
		</div>
	</body>
</html>
<?php
}
else
{
	echo "No Receipt Available - Txn No does not exist.";
}
?>
