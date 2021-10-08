<?php
include_once('../zc-common-admin.php');
?>
<html>
	<head>
		<title>Print Receipt</title>
		<script src="../js/jquery-1.7.2.min.js" type="text/javascript"></script>	
		<script>
		function bank2state()
		{
			var bank2state = $("#bank2state").val();
			//make the AJAX request, dataType is set to json
			//meaning we are expecting JSON data in response from the server
			$.ajax({
				type: "POST",
				url: "_ajax-1bank2state.php",
				data: {'bank2state': bank2state },
				dataType: "json",
			 
				//if received a response from the server
				success: function( data, textStatus, jqXHR) {
					//our country code was correct so we have some information to display/
					$("#t2").html(data);
					$("#t3").html("");
					$("#t4").html("");
					$("#t5").html("");
					$("#t6").html("<b>Details : </b>");
				}	 
			});
		}
		function state2dist()
		{
			var bank2state = $("#bank2state").val();
			var state2dist = $("#state2dist").val();
			//make the AJAX request, dataType is set to json
			//meaning we are expecting JSON data in response from the server
			$.ajax({
				type: "POST",
				url: "_ajax-2state2dist.php",
				data: {'bank2state': bank2state , 'state2dist': state2dist },
				dataType: "json",
			 
				//if received a response from the server
				success: function( data, textStatus, jqXHR) {
					//our country code was correct so we have some information to display/
					$("#t3").html(data);
					$("#t4").html("");
					$("#t5").html("");
					$("#t6").html("<b>Details : </b>");
				}	 
			});
		}
		function dist2city()
		{
			var bank2state = $("#bank2state").val();
			var state2dist = $("#state2dist").val();
			var dist2city = $("#dist2city").val();
			//make the AJAX request, dataType is set to json
			//meaning we are expecting JSON data in response from the server
			$.ajax({
				type: "POST",
				url: "_ajax-3dist2city.php",
				data: {'bank2state': bank2state , 'state2dist': state2dist, 'dist2city': dist2city },
				dataType: "json",
			 
				//if received a response from the server
				success: function( data, textStatus, jqXHR) {
					//our country code was correct so we have some information to display/
					$("#t4").html(data);
					$("#t5").html("");
					$("#t6").html("<b>Details : </b>");
				}	 
			});
		}
		function city2branch()
		{
			var bank2state = $("#bank2state").val();
			var state2dist = $("#state2dist").val();
			var dist2city = $("#dist2city").val();
			var city2branch = $("#city2branch").val();
			//make the AJAX request, dataType is set to json
			//meaning we are expecting JSON data in response from the server
			$.ajax({
				type: "POST",
				url: "_ajax-4city2branch.php",
				data: {'bank2state': bank2state , 'state2dist': state2dist, 'dist2city': dist2city, 'city2branch': city2branch },
				dataType: "json",
			 
				//if received a response from the server
				success: function( data, textStatus, jqXHR) {
					//our country code was correct so we have some information to display/
					$("#t5").html(data);
					$("#t6").html("<b>Details : </b>");
				}	 
			});
		}
		function branch2detail()
		{
			var bank2state = $("#bank2state").val();
			var state2dist = $("#state2dist").val();
			var dist2city = $("#dist2city").val();
			var city2branch = $("#city2branch").val();
			var branch2detail = $("#branch2detail").val();
			//make the AJAX request, dataType is set to json
			//meaning we are expecting JSON data in response from the server
			$.ajax({
				type: "POST",
				url: "_ajax-5branch2detail.php",
				data: {'bank2state': bank2state , 'state2dist': state2dist, 'dist2city': dist2city, 'city2branch': city2branch, 'branch2detail': branch2detail },
				dataType: "json",
			 
				//if received a response from the server
				success: function( data, textStatus, jqXHR) {
					//our country code was correct so we have some information to display/
					$("#t6").html(data);
				}	 
			});
		}
		</script>
	</head>
	<body>
		<table cellpadding='0' cellspacing='0'>
			<tr height='50' bgcolor='#f1f1f1'>
				<td align='center' colspan='2'><b>SEARCH IFSC CODE</b></td>
			</tr>
			<tr>
				<td colspan='2' bgcolor='#f1f1f1'><hr/></td>
			</tr>
			<tr height='30' bgcolor='#f1f1f1'>
				<td valign="top" width='220'>Search by IFSC</td>
				<td width='400'>
					<?php
					$res="";
					$newresult="<br><br>";
					$ifsc="";
					if(isset($_POST['code']))
					$ifsc=$_POST['code'];
					if(isset($_POST['search']))
					{
						$sql="select * from $bankapi_common.common_ifsc where ifsc_code='$ifsc'";
						$result=mysql_query($sql);
						$num_rows = mysql_num_rows($result);
						$res="$newresult";
						if($num_rows>0)
						{
							while($r = mysql_fetch_array($result)) {
								$res=$res."IFSC CODE : ".$r['ifsc_code']."<br><br>";
								$res=$res."MICR CODE : ".$r['micr_code']."<br><br>";
								$res=$res."BRANCH NAME : ".$r['branch_name']."<br><br>";
								$res=$res."<b>ADDRESS : </b><br><br><a style='line-height:24px;'>".$r['address']."<br><br></a>";
								$res=$res."CONTACT NUMBER : ".$r['contact_number']."<br><br>";
								$res=$res."CITY : ".$r['city_name']."<br><br>";
								$res=$res."DISTT. : ".$r['distt_name']."<br><br>";
								$res=$res."STATE : ".$r['state_name']."<br><br>";
							}
						}
						else
						{
							$res=$res."No details found.";
						}
					}
					?>
					<form method="post">
					<input type="text" name="code" value="<?php echo $ifsc;?>" required />&nbsp;&nbsp;
					<input type="submit" name="search" value="Search" />
					</form>
				</td>
			</tr>
			<tr bgcolor='#f1f1f1'>
				<td colspan='2'><hr/></td>
			</tr>
			<tr height='30' bgcolor='#f1f1f1'>
				<td align='left' colspan='2'><b>Search by Bank and Location</b></td>
			</tr>
			<tr bgcolor='#f1f1f1'>
				<td colspan='2'><hr/></td>
			</tr>
			<tr height='30'>
				<td>Bank Name</td>
				<td id="t1">
					<select name="bank2state" required id="bank2state" onchange="bank2state()">
						<option value="">Select Bank</option>
						<?php
						$query_bnk="SELECT * FROM eko_bank where ifsc_status!=-1";
						$result_bnk=mysql_query($query_bnk);
						while($rs_bnk = mysql_fetch_array($result_bnk))
						{		
							$bnk_name=$rs_bnk['bank_name'];
							$bnk_cd=$rs_bnk['bank_code'];
						?>
						<option value="<?php echo $bnk_cd;?>"><?php echo $bnk_name;?></option>
						<?php
						}												
						?>
					</select>
				</td>
			</tr>
			<tr height='30'>
				<td>State Name</td>
				<td id="t2"></td>
			</tr>
			<tr height='30'>
				<td>Distt Name</td>
				<td id="t3"></td>
			</tr>
			<tr height='30'>
				<td>City Name</td>
				<td id="t4"></td>
			</tr>
			<tr height='30'>
				<td>Branch Name</td>
				<td id="t5"></td>
			</tr>
			<tr bgcolor='#f1f1f1'>
				<td colspan='2'><hr/></td>
			</tr>
			<tr height='30' bgcolor='#f1f1f1'>
				<td colspan='2' id="t6"><b>Details : </b><?php echo $res;?></td>
			</tr>
			<tr bgcolor='#f1f1f1'>
				<td colspan='2'><hr/></td>
			</tr>
		</table>
	</body>
</html>
