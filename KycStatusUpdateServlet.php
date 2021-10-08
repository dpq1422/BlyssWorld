<!DOCTYPE html>
<html>
<head>
<?php include_once('_all-inner-pages-html-title.php'); ?>
<script type="text/javascript" src="js/admin-validation-functions.js"></script>
<script>
function expand(exp_no)
{
	$(".address"+exp_no).slideToggle();
	$(".add"+exp_no).toggleClass("add-show");
}
</script>
<script>
$(document).ready(function(){
	$(".search-data").click(function(){
		$(".table-search-filter").slideToggle();
	});
});
</script>
<script>
function show_dist()
{
	var states = $("#states").val();
	//make the AJAX request, dataType is set to json
	//meaning we are expecting JSON data in response from the server
	$.ajax({
		type: "POST",
		url: "AjaxShowDistServlet",
		data: {'states': states},
		dataType: "json",
	 
		//if received a response from the server
		success: function( data, textStatus, jqXHR) {
			//our country code was correct so we have some information to display/
			$("#districts").html(data);
		}	 
	});
}
function getGeo()
{
	var pincode = $("#pincode").val();
	var geo=$("#geo").val();
	if(pincode.length==6)
	{
		do
		{
			getGEO();
		}
		while(geo=="0" || geo=="0,0");
	}
}
function getGEO()
{
	var pincode = $("#pincode").val();
	$("#geo").val("0");
	$("#ButtonSecond").hide();
	$("#ViewServlet").hide();
	if(pincode.length==6)
	{
		$("#error-title").html("Updating GEO Location");
		$("#error-message").html("<img src='img/refresh.gif' height='50' align='right' />Please wait few seconds...<br>while we update GEO Location of User...");
		$("#error-box").show();
		//make the AJAX request, dataType is set to json
		//meaning we are expecting JSON data in response from the server
		$.ajax({
			type: "POST",
			url: "AjaxFetchGeoServlet",
			data: {'pincode': pincode},
			dataType: "json",
		 
			//if received a response from the server
			success: function( data, textStatus, jqXHR) {
				//our country code was correct so we have some information to display/
				$("#geo").val(data);
				$("#error-box").hide();
				if($("#paadharno").val()=="")
				$("#paadharno").focus();
			}
		});
	}
}
var click=0;
function updatekyc()
{
	click++;
	if(click==1)
	$("#UpdateKYC").click();
}
function check_values() {
	var pname=$("#pname").val();
	var pemail=$("#pemail").val();
	var pmobile=$("#pmobile").val();
	
	var padd=$("#padd").val();
	
	var states=$("#states").val();
	var districts=$("#districts").val();
	var pcity=$("#pcity").val();
	
	var pincode=$("#pincode").val();
	var geo=$("#geo").val();
	var paadharno=$("#paadharno").val();
	
	var ppanno=$("#ppanno").val();
	var pdob=$("#pdob").val();
	var pgender=$("#pgender").val();
	
	//var bsname=$("#bsname").val();
	//var bslogo=$("#bslogo").val();
	//var bsgst=$("#bsgst").val();
	
	//var bsadd=$("#bsadd").val();
	
	var kstatus=$("#kstatus").val();
	
	var error_message="";
	
	if(isEmpty(pname)==1)
		error_message+="<li>User name should not be blank.</li>";
	if(isEmpty(pemail)==1)
		error_message+="<li>Email should not be blank.</li>";	
	if(isEmail(pemail)==1)
		error_message+="<li>Email format should be valid and proper.</li>";
	if(isEmpty(pmobile)==1)
		error_message+="<li>Mobile should not be blank.</li>";
	if(isSize(pmobile,10,10)==1)
		error_message+="<li>Mobile number size should be in 10 digits.</li>";	
	if(isNumeric(pmobile)==1)
		error_message+="<li>Mobile number should has Numeric Only.</li>";
	
	
	
	if(isEmpty(padd)==1)
		error_message+="<li>User Address should not be blank.</li>";
	
	
	
	if(isEmpty(states)==1)
		error_message+="<li>Select State.</li>";
	if(isEmpty(districts)==1)
		error_message+="<li>Select District.</li>";
	if(isEmpty(pcity)==1)
		error_message+="<li>City should not be blank.</li>";
	
	
	
	if(isEmpty(pincode)==1)
		error_message+="<li>Area pincode should not be blank.</li>";	
	if(isNumeric(pincode)==1)
		error_message+="<li>Area pincode should has Numeric Only.</li>";
	if(isSize(pincode,6,6)==1)
		error_message+="<li>Area pincode should has 6 digits.</li>";
	//if(isEmpty(geo)==1 || geo=="0" || geo=="0,0")
		//error_message+="<li>GEO Location should not be blank.</li>";
	if(isEmpty(paadharno)==1)
		error_message+="<li>Aadhar Number should not be blank.</li>";	
	if(isNumeric(paadharno)==1)
		error_message+="<li>Aadhar Number should has Numeric Only.</li>";
	if(isSize(paadharno,12,12)==1)
		error_message+="<li>Aadhar Number should has 12 digits.</li>";
	
	
	
	if(isEmpty(ppanno)==1)
		error_message+="<li>Pan card no should not be blank.</li>";
	if(isSize(ppanno,10,10)==1)
		error_message+="<li>Pan card no should has 10 characters.</li>";
	if(isEmpty(pdob)==1)
		error_message+="<li>Select Date of Birth.</li>";
	if(isEmpty(pgender)==1)
		error_message+="<li>Select Gender.</li>";
	
	
	
	if(isEmpty(kstatus)==1)
		error_message+="<li>Select KYC States.</li>";
	
	if(error_message!="" && kstatus!=-4)
	{
		error_message="<ul class='error-message'>"+error_message+"</ul>";
		$("#error-title").html("Required Fileds/Values");
		$("#error-message").html(error_message);
		$("#ButtonFirst").show();
		$("#ButtonSecond").hide();
		$("#ViewServlet").hide();
		$("#error-box").show();
		return false;
	}
	else
	{
		$("#error-title").html("Confirm");
		$("#error-message").html("Do you want to update KYC Info?");
		$("#ButtonFirst").hide();
		$("#ButtonSecond").show();
		$("#ViewServlet").show();
		$("#error-box").show();
		return true;
	}
}
</script>

</head>
<body>

	<?php include_once('_header.php'); ?>
    
    <section class="boxes wh w3-left">
        <!--<div class="w3-container">-->
            <!--<div class="w3-row-padding">
                <div class="w3-col m12">
                	<h4 class="heading wh w3-left"><span>Transactions</span></h4>
                </div>
            </div>-->
            <div class="w3-row-padding w3-margin-top">
            	<div class="w3-col m12 wow bounceIn">
                	<div class="table-box wh w3-left">
						<?php
						$userid=0;
						if(isset($_REQUEST['uid']))
							$userid=$_REQUEST['uid'];
						if(isset($_POST['UpdateKYC']))
						{
							if($logged_user_id==$main_admin)
							{
								include_once('zc-session-admin.php');
								include_once('zf-UserWalletKyc.php');
								$name=mysql_real_escape_string($_POST['pname']);
								$email=mysql_real_escape_string($_POST['pemail']);
								$mobile=mysql_real_escape_string($_POST['pmobile']);
								$address=mysql_real_escape_string($_POST['padd']);
								$state=mysql_real_escape_string($_POST['states']);
								$dist=mysql_real_escape_string($_POST['districts']);
								$city=mysql_real_escape_string($_POST['pcity']);
								$pincode=mysql_real_escape_string($_POST['pincode']);
								$gender=mysql_real_escape_string($_POST['pgender']);
								$aadhar=mysql_real_escape_string($_POST['paadharno']);
								$pancard=mysql_real_escape_string($_POST['ppanno']);
								$dob=mysql_real_escape_string($_POST['pdob']);
								$geo=mysql_real_escape_string($_POST['geo']);
								$bsname=mysql_real_escape_string($_POST['bsname']);
								$bsadd=mysql_real_escape_string($_POST['bsadd']);
								$bsgst=mysql_real_escape_string($_POST['bsgst']);
								$kst=mysql_real_escape_string($_POST['kstatus']);
								update_user_kyc($userid,$name,$email,$address,$mobile,$city,$dist,$state,$pincode,$gender,$aadhar,$pancard,$dob,$geo,$bsname,$bsadd,$bsgst,$kst);
							}
							header("location: KycStatusServlet");
						}
						include_once('zf-User.php');
						include_once('zf-Level.php');
						include_once('zf-UserWalletKyc.php');
						$userid=$_REQUEST['uid'];
						$username=show_user_name($userid);
						$usertype=show_user_type($userid);
						$usertypename=show_level_name($usertype);
						$kyc_data=show_kyc_data($userid);
						$kyc_files=show_kyc_files($userid);
						$total_records=mysql_num_rows($kyc_files);
						?>
                    	<div class="box-head">
                        	<h3>USER KYC DETAILS</h3>
                        </div>					
						<div class="w3-row-padding w3-margin-bottom"> 								
							<div class="w3-col m6 l4 w3-margin-top">
								<label>User ID</label>	
								<input type="text" value="<?php echo $userid;?>" placeholder="User ID" disabled class="w3-input w3-border w3-round">                                    
							</div>
													
							<div class="w3-col m6 l4 w3-margin-top">
								<label>User Name</label>
								<input type="text" value="<?php echo $username;?>" placeholder="User Name" disabled class="w3-input w3-border w3-round">                                    
							</div>
							
							<div class="w3-col m6 l4 w3-margin-top">
								<label>User Type</label>	
								<input type="text" value="<?php echo $usertypename;?>" placeholder="User Type" disabled class="w3-input w3-border w3-round">                                    
							</div>
						</div>
						
                    	<div class="box-head">
                        	<h3>KYC DOCUMENTS <span class="w3-right w3-blue w3-center badges"><?php echo $total_records;?></span></h3>
                        </div>						
                        <div class="w3-responsive">
                            <table class="w3-table-all" id="myTable" style="border:none;">
                                <tr class="w3-blue">
									<th>S.No.</th>
									<th>Date Time</th>
									<th>Remarks</th>
									<th>Link</th>
                                </tr>      
								<?php
								while($kyc_row=mysql_fetch_array($kyc_files))
								{
									$i++;
									$file="";
									if(isset($kyc_row['doc_1']) && $kyc_row['doc_1']!=0)
									$file=$kyc_row['doc_1'];
									if(isset($kyc_row['doc_2']) && $kyc_row['doc_2']!=0)
									$file=$kyc_row['doc_2'];
									if(isset($kyc_row['doc_3']) && $kyc_row['doc_3']!=0)
									$file=$kyc_row['doc_3'];
									if(isset($kyc_row['doc_4']) && $kyc_row['doc_4']!=0)
									$file=$kyc_row['doc_4'];
								
									$file="<a href='kyc/$file.jpg' style='color:#cc5801;' target='_blank'>$file</a>";
								?>                          
                                <tr>
                                  <td><?php echo $i;?></td>
                                  <td><?php echo $kyc_row['uploaded_at'];?></td>
                                  <td><?php echo $kyc_row['remarks'];?></td>
                                  <td><?php echo $file;?></td>
                                </tr>
								<?php
								}
								?>
                            </table>	
                        </div>
						<form class="wh w3-left" method="post">		
                        	<div class="w3-row-padding w3-margin-bottom"> 								
                            	<div class="w3-col m12 l12 w3-margin-top">
									<b class='w3-text-blue w3-medium'>USER INFORMATION</b>                               
                                </div>						
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>NAME</label>	
                                	<input type="text" id="pname" name="pname" value="<?php echo $kyc_data[0];?>" placeholder="User Name" class="w3-input w3-border w3-round">                                    
                                </div>
                            	                      	
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>E-MAIL</label>
                                	<input type="text" id="pemail" name="pemail" value="<?php echo $kyc_data[1];?>" placeholder="E-Mail" class="w3-input w3-border w3-round">                                    
                                </div>
                                
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>MOBILE NUMBER</label>	
                                	<input type="text" id="pmobile" name="pmobile" value="<?php echo $kyc_data[3];?>" placeholder="Mobile Number" class="w3-input w3-border w3-round">                                    
                                </div>				
                                
                            	<div class="w3-col m12 l12 w3-margin-top">
                                	<label>ADDRESS</label>	
                                	<input type="text" id="padd" name="padd" value="<?php echo $kyc_data[2];?>" placeholder="Address" class="w3-input w3-border w3-round">                                    
                                </div>		
                                
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>STATE</label>	
                                	<select class="w3-select w3-border w3-round" id="states" name="states" onchange="show_dist()">
									<option value='' disabled>Select state</option>
									<?php
									include_once('zf-State.php');
									$state_result=show_all_states();
									while($state_row=mysql_fetch_array($state_result))
									{
										if($kyc_data[6]==$state_row['state_id'])
										{
											echo "<option value='".$state_row['state_id']."' selected>".$state_row['state_name']."</option>";
										}
										else
										{
											echo "<option value='".$state_row['state_id']."'>".$state_row['state_name']."</option>";
										}
									}
									?>
                                    </select>                               
                                </div>		
                                
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>DISTRICT</label>	
                                	<select class="w3-select w3-border w3-round" id="districts" name="districts">
										<option value='' disabled>Select district</option>
									<?php
									include_once('zf-Districts.php');
									$district_result=show_all_districts_of_state($kyc_data[6]);
									while($district_row=mysql_fetch_array($district_result))
									{
										if($kyc_data[5]==$district_row['distt_id'])
										{
											echo "<option value='".$district_row['distt_id']."' selected>".$district_row['distt_name']."</option>";
										}
										else
										{
											echo "<option value='".$district_row['distt_id']."'>".$district_row['distt_name']."</option>";
										}
									}
									?>
                                    </select>                                
                                </div>		
                                
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>CITY</label>	
                                	<input type="text" id="pcity" name="pcity" value="<?php echo $kyc_data[4];?>" placeholder="City" class="w3-input w3-border w3-round">                                    
                                </div>			
                                
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>AREA PINCODE</label>	
                                	<input type="text" onkeyup="getGEO()" value="<?php echo $kyc_data[7];?>" placeholder="Pincode" name="pincode" id="pincode" class="w3-input w3-border w3-round">                                    
                                </div>			
                                
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>GEO LOCATION</label>	
                                	<input type="text" id="geo" readonly name="geo" value="<?php echo $kyc_data[12];?>" placeholder="GEO Location" class="w3-input w3-border w3-round">                                    
                                </div>		
                                
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>AADHAR CARD NO</label>	
                                	<input type="text" id="paadharno" name="paadharno" value="<?php echo $kyc_data[9];?>" placeholder="Aadhar No" class="w3-input w3-border w3-round">                                    
                                </div>		
                                
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>PAN CARD NO</label>	
                                	<input type="text" id="ppanno" name="ppanno" value="<?php echo $kyc_data[10];?>" placeholder="Pan No" class="w3-input w3-border w3-round">                                    
                                </div>		
                                
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>DATE OF BIRTH</label>	
                                	<input type="date" id="pdob" name="pdob" value="<?php echo $kyc_data[11];?>" placeholder="Date of Birth" class="w3-input w3-border w3-round">                                    
                                </div>		
                                
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>GENDER</label>	
                                	<select id="pgender" name="pgender" class="w3-input w3-border w3-round">
										<?php
											$gensel="";
											$malesel="";
											$femalesel="";
											$transgensel="";
											if($kyc_data[8]==1)
												$malesel="selected";
											else if($kyc_data[8]==0)
												$femalesel="selected";
											else if($kyc_data[8]==-1)
												$transgensel="selected";
											else
												$gensel="selected";
											
											echo "<option value='' $gensel>Gender</option>";
											echo "<option value='1' $malesel>Male</option>";
											echo "<option value='0' $femalesel>Female</option>";
											echo "<option value='-1' $transgensel>Trans Gender</option>";
										?>
										
									</select>                                                                  
                                </div>		
								
                            	<div class="w3-col m12 l12 w3-margin-top">
									<b class='w3-text-blue w3-medium'>BUSINESS INFORMATION</b>                               
                                </div>		
								
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>BUSINESS NAME</label>	
                                	<input type="text" id="bsname" name="bsname" value="<?php echo $kyc_data[13];?>" placeholder="Business Name" class="w3-input w3-border w3-round">                                    
                                </div>
                                
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>GST NO</label>	
                                	<input type="text" id="bsgst" name="bsgst" value="<?php echo $kyc_data[16];?>" placeholder="GST No" class="w3-input w3-border w3-round">                                    
                                </div>	
                            	                      	
                                <div class="w3-col m6 l12 w3-margin-top">
                                	<label>BUSINESS ADDRESS</label>
                                	<input type="text" id="bsadd" name="bsadd" value="<?php echo $kyc_data[14];?>" placeholder="Business Address" class="w3-input w3-border w3-round">                                    
                                </div>		
								
                            	<div class="w3-col m12 l12 w3-margin-top">
									<b class='w3-text-blue w3-medium'>KYC STATUS</b>                               
                                </div>			
								
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>UPDATED STATUS </label>	
                                	<select name="kstatus" id="kstatus" class="w3-input w3-border w3-round">
									<?php
									$kveri="";
									$kincomp="";
									if($kyc_data[20]==3)
										$kveri="selected";
									else
										$kincomp="selected";
									
									echo "<option value=''>KYC STATUS</option>";
									echo "<option value='-4' $kincomp>Documents In-complete</option>";
									echo "<option value='3' $kveri>KYC Verified</option>";
									?> 
									</select>                                                                 
                                </div> 
								<div class="w3-col m6 l4 w3-margin-top">
                                	<label>&nbsp;</label>
									<input type="button" onclick="getGEO()" value="Update GEO" class="w3-input w3-border w3-round w3-button w3-blue w3-w150">
                                </div>
								<?php
								if($logged_user_id==$main_admin)
								{
								?>
								<div class="w3-col m6 l4 w3-margin-top">
                                	<label>&nbsp;</label>
									<input type="button" onclick="check_values()" value="Update KYC" class="w3-input w3-border w3-round w3-button w3-green w3-w150">
									<button onclick="check_values()" name="UpdateKYC" id="UpdateKYC" class="w3-button w3-round-small w3-right w3-green display-none">UpdateKYC</button>
                                </div>
								<?php
								}
								else
								{
									header("location: KycStatusShowServlet?uid=$userid");
								}
								?>
							</div>
						</form>
                    </div>
                </div>  
            </div>
        <!--</div>-->
    </section>
	
  <div id="error-box" class="w3-modal">
    <div class="w3-modal-content w3-animate-zoom w3-card-4 w3-round list-pop">
      <header class="w3-container w3-blue"> 
        <span onclick="document.getElementById('error-box').style.display='none';" class="w3-button w3-display-topright"><img src="img/close.png" style="margin-bottom:0px;"></span>
        <h3 class="w3-center" id="error-title"></h3> 
      </header> 
      <div class="w3-container w3-center">
      	<p id="error-message" class='w3-left-align'></p>
      </div> 
        <div class="w3-container" style="margin-bottom:10px;">
            <div class="w3-bar w3-center">
                <a id="ViewServlet" onclick="updatekyc()" class="w3-button w3-green w3-round">Accept &amp; Confirm</a>
                <a id="ButtonFirst" onclick="document.getElementById('error-box').style.display='none';" class="w3-button w3-blue w3-round">OK</a>
                <a id="ButtonSecond" onclick="document.getElementById('error-box').style.display='none';" class="w3-button w3-orange w3-round">Do it later</a>
            </div> 
        </div> 
    </div>
  </div>
       
    <?php include_once('_footer.php');?>

</body>
</html> 
