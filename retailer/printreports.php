<?php
include_once('../zc-session-admin.php');
include_once('../zc-common-admin.php');
include_once('../zc-gyan-info-admin.php');
include_once('../zf-Commission.php');
$result="";
if(isset($_REQUEST['result']))
$result=$_REQUEST['result'];
$results="";
if(isset($_REQUEST['results']))
$results=$_REQUEST['results'];

if($result!="")
{
?>
<html>
	<head>
		<title>Print Receipt</title>
		<style>
			body{background:url(../img/sample.png) no-repeat;font-family:Calibri;}
			.fb{font-size:22px;line-height:46px;}
			.fm{font-size:18px;}
			.fs{font-size:12px;}
			.display-none{display:none;}
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
					<td align="center" colspan="4"><b class='fm'>Commission Receipt</b></td>
				</tr>
				<tr height="30">
					<td width="25%" align="left">RO Code: </td>
					<td width="25%" align="left"><?php echo $logged_user_id;?></td>
					<td width="25%" align="left">RO Name:</td>
					<td width="25%" align="left"><?php echo $logged_user_name;?></td>
				</tr>
				<tr height='30'>
					<td width='25%' align="left">Year-Month: </td>
					<td width='25%' align="left"><?php echo $result;?></td>
					<td width='25%' align='left'>Paid On: </td>
					<td width='25%' align='left'><?php echo $results;?></td>
				</tr>
				<tr>
					<td colspan="4"><hr></td>
				</tr>
			</table>
			<table cellpadding="0" cellspacing="0" width='100%'>
				<tr height="30">
					<th align='left'>Sr.No.</th>
					<th align='left'>Product Name</th>
					<th align='right'>Earning</th>
					<th align='right'>GST</th>
					<th align='right'>TDS</th>
					<th align='right'>TOTAL</th>
				</tr>		
				<tr>
					<td colspan="6"><hr></td>
				</tr>		
				<?php
				$i=$a=$b=$c=$d=0;
				$res=show_my_all_payouts($logged_user_id,$result);
				while($rs = mysql_fetch_array($res))
				{
					$i++;
					$a+=$rs['comm'];
					$b+=$rs['gst'];
					$c+=$rs['tds'];
					$d+=$rs['earning'];
				?>
				<tr height="30">
					<td align='left'><?php echo $i;?></td>
					<td align='left'><?php echo str_replace("-"," - ",$rs['product']);?></td>
					<td align='right'><?php echo $rs['comm'];?></td>
					<td align='right'><?php echo $rs['gst'];?></td>
					<td align='right'><?php echo $rs['tds'];?></td>
					<td align='right'><?php echo $rs['earning'];?></td>
				</tr>	
				<?php
				}
				?>	
				<tr>
					<td colspan="6"><hr></td>
				</tr>	
				<tr height="30">
					<th align='center' colspan='2'>TOTAL</th>
					<th align='right'><?php echo $a;?></th>
					<th align='right'><?php echo $b;?></th>
					<th align='right'><?php echo $c;?></th>
					<th align='right'><?php echo $d;?></th>
				</tr>
				<tr>
					<td colspan="6"><hr></td>
				</tr>
				<tr>
					<td colspan='6' align="center" class='fs'>This is system generate receipt, does not require any signature.<br><br></td>
				</tr>
			</table>
			<table cellpadding="0" cellspacing="0" width='100%'>
				<tr height="30" class='display-none'>
					<td align="left"><br><b>Generic T&amp;C / Disclaimer</b>
						<ul class='fs'>
							<li>For any registration related issues, sender should contact the RO Agent.</li>
							<li>Customer is requested to furnish correct Beneficiary details to RO Agent.</li>
							<li>If customer is charged in excess of 1% of amount including GST. He/She should complaint about same on BLYSS Customer Care Number.</li>
							<li>BLYSS will not entertain any complaint with reference to any mistake/omission on the part of the sender.</li>
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
	echo "No Report Available - Report does not exist.";
}
?>
