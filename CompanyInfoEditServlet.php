<!DOCTYPE html>
<html>
<head>
<?php include_once('_all-inner-pages-html-title.php'); ?>
<script type="text/javascript" src="js/admin-validation-functions.js"></script>
<!--date picker-->
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js"></script> 
<link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet"> -->
<!--date picker-->  
<script>
var click=0;
function update_company_info()
{
	click++;
	if(click==1)
	$("#UpdateCompanyInfo").click();
}
function check_values() {
	var cname=$("#cname").val();
	var cmob=$("#cmob").val();
	var cemail=$("#cemail").val();
	var cadd=$("#cadd").val();
	var states=$("#states").val();
	var districts=$("#districts").val();
	var ccity=$("#ccity").val();
	var cpin=$("#cpin").val();
	var cweb=$("#cweb").val();
	var cpan=$("#cpan").val();
	var cgst=$("#cgst").val();
	var cestd=$("#cestd").val();
	var cpower=$("#cpower").val();
	
	var error_message="";
	
	if(isEmpty(cname)==1)
		error_message+="<li>Company name should not be blank.</li>";
	if(isEmpty(cmob)==1)
		error_message+="<li>Mobile should not be blank.</li>";
	if(isSize(cmob,10,10)==1)
		error_message+="<li>Mobile number size should be in 10 digits.</li>";	
	if(isNumeric(cmob)==1)
		error_message+="<li>Mobile number should has Numeric Only.</li>";
	if(isEmpty(cemail)==1)
		error_message+="<li>Email should not be blank.</li>";	
	if(isEmail(cemail)==1)
		error_message+="<li>Email format should be valid and proper.</li>";
	if(isEmpty(cadd)==1)
		error_message+="<li>Address should not be blank.</li>";
	if(isEmpty(states)==1)
		error_message+="<li>State should not be blank.</li>";
	if(isEmpty(districts)==1)
		error_message+="<li>District should not be blank.</li>";
	if(isEmpty(ccity)==1)
		error_message+="<li>City should not be blank.</li>";
	if(isEmpty(cpin)==1)
		error_message+="<li>Area pincode should not be blank.</li>";
	if(isSize(cpin,6,6)==1)
		error_message+="<li>Area pincode should has 6 digits.</li>";
	if(isEmpty(cweb)==1)
		error_message+="<li>Website should not be blank.</li>";
	if(isEmpty(cpan)==1)
		error_message+="<li>Pan card no should not be blank.</li>";
	if(isSize(cpan,10,10)==1)
		error_message+="<li>Pan card no should has 10 digits.</li>";
	if(isEmpty(cgst)==1)
		error_message+="<li>GST no should not be blank.</li>";
	if(isSize(cgst,15,15)==1)
		error_message+="<li>GST no should has 15 digits.</li>";
	if(isEmpty(cestd)==1)
		error_message+="<li>Estd in should not be blank.</li>";
	if(isEmpty(cpower)==1)
		error_message+="<li>Powered by should not be blank.</li>";
	
	if(error_message!="")
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
		$("#error-message").html("Do you want to update?");
		$("#ButtonFirst").hide();
		$("#ButtonSecond").show();
		$("#ViewServlet").show();
		$("#error-box").show();
		return true;
	}
}
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
</script>
</head>
<body>

	<?php include_once('_header.php'); ?>
    
    <section class="boxes wh w3-left">
        <!--<div class="w3-container">-->
            <!--<div class="w3-row-padding">
                <div class="w3-col m12">
                	<h4 class="heading wh w3-left"><span>Submit Form</span></h4>
                </div>
            </div>-->
            <div class="w3-row-padding w3-margin-top">
            	<div class="w3-col m12 wow bounceIn">
                	<div class="table-box wh w3-left">
                    	<div class="box-head">
                        	<h3>COMPANY INFO (Edit/Update)</h3>
                        </div>
						<?php
						if($logged_user_type!=1)
						{
							echo "<script>window.location.href='index';</script>";
						}
						include_once('zf-Company.php');
						$company_result=show_company_info(1);
						$company_row=mysql_fetch_array($company_result);
						
						
						if(isset($_POST['UpdateCompanyInfo']))
						{
							include_once('zc-session-admin.php');
							include_once('zf-Company.php');
							$cname=mysql_real_escape_string($_POST['cname']);
							$cmob=mysql_real_escape_string($_POST['cmob']);
							$cemail=mysql_real_escape_string($_POST['cemail']);
							$cadd=mysql_real_escape_string($_POST['cadd']);
							$states=mysql_real_escape_string($_POST['states']);
							$districts=mysql_real_escape_string($_POST['districts']);
							$ccity=mysql_real_escape_string($_POST['ccity']);
							$cpin=mysql_real_escape_string($_POST['cpin']);
							$cweb=mysql_real_escape_string($_POST['cweb']);
							$cpan=mysql_real_escape_string($_POST['cpan']);
							$cgst=mysql_real_escape_string($_POST['cgst']);
							$cestd=mysql_real_escape_string($_POST['cestd']);
							$cpower=mysql_real_escape_string($_POST['cpower']);
							update_company_info(1,$cname,$cmob,$cemail,$cadd,$states,$districts,$ccity,$cpin,$cweb,$cpan,$cgst,$cestd,$cpower,$logged_user_typename,$logged_user_id,$logged_user_name);
							echo "<script>window.location.href='CompanyInfoViewServlet';</script>";
						}
						?>
                        <form class="wh w3-left" method="post" onsubmit="return check_values()">
                        	<div class="w3-row-padding w3-margin-bottom">  
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>Company Name <b>(also displayed in support/contact info)</b></label>	
                                	<input type="text" name="cname" id="cname" placeholder="Name" class="w3-input w3-border w3-round" value="<?php echo $company_row['company_name'];?>">                                    
                                </div>                           
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>Mobile <b>(also displayed in support/contact info)</b></label>
                                	<input type="text" name="cmob" id="cmob" placeholder="Mobile" class="w3-input w3-border w3-round" value="<?php echo $company_row['contact_no'];?>">                                    
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>Email <b>(also displayed in support/contact info)</b></label>
                                	<input type="text" name="cemail" id="cemail" placeholder="Email" class="w3-input w3-border w3-round" value="<?php echo $company_row['e_mail'];?>">                                    
                                </div>   
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>Address</label>
                                	<input type="text" name="cadd" id="cadd" placeholder="Address" class="w3-input w3-border w3-round" value="<?php echo $company_row['address'];?>">                                    
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>State</label>
                                	<select class="w3-select w3-border w3-round" id="states" name="states" onchange="show_dist()">
									<option value='' disabled>Select state</option>
									<?php
									include_once('zf-State.php');
									$state_result=show_all_states();
									while($state_row=mysql_fetch_array($state_result))
									{
										if($company_row['state_id']==$state_row['state_id'])
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
                                	<label>District</label>
                                	<select class="w3-select w3-border w3-round" id="districts" name="districts">
										<option value='' disabled>Select district</option>
									<?php
									include_once('zf-Districts.php');
									$district_result=show_all_districts_of_state($company_row['state_id']);
									while($district_row=mysql_fetch_array($district_result))
									{
										if($company_row['distt_id']==$district_row['state_id'])
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
                                	<label>City</label>
                                	<input type="text" name="ccity" id="ccity" placeholder="City" class="w3-input w3-border w3-round" value="<?php echo $company_row['city_name'];?>">                                    
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>Area Pincode</label>	
                                	<input type="text" name="cpin" id="cpin" placeholder="Area Pincode" class="w3-input w3-border w3-round" value="<?php echo $company_row['area_pin_code'];?>">
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>Website</label>
                                	<input type="text" name="cweb" id="cweb" placeholder="Website" class="w3-input w3-border w3-round" value="<?php echo $company_row['website'];?>">                                    
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>Pan Card (for Invoicing)</label>
                                	<input type="text" name="cpan" id="cpan" placeholder="Pan Card" class="w3-input w3-border w3-round" value="<?php echo $company_row['pan_no'];?>">                                    
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>GST No. (for Invoicing)</label>
                                	<input type="text" name="cgst" id="cgst" placeholder="GST No." class="w3-input w3-border w3-round" value="<?php echo $company_row['gst_no'];?>">                                    
                                </div> 
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>Estd. in (for Website Footer)</label>
                                	<input type="text" name="cestd" id="cestd" placeholder="&copy; &amp; &reg; 2012. All rights are reserved." class="w3-input w3-border w3-round" 
									value="<?php echo $company_row['estd_in'];?>">                                    
                                </div> 
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>Footer Note (for Website Footer)</label>
                                	<input type="text" name="cpower" id="cpower" placeholder="Powered by Mentor India" class="w3-input w3-border w3-round" value="<?php echo $company_row['powered_by'];?>">
									<button onclick="check_values()" name="UpdateCompanyInfo" id="UpdateCompanyInfo" class="w3-button w3-round-small w3-right w3-blue display-none">UPDATE</button>                                   
                                </div>
                                   
                                <div class="w3-col m12 w3-margin-top w3-right-align">
                                	<a class="w3-button w3-round w3-blue" onclick="check_values()">Update Info</a>
                                </div>                             
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
        <h3 class="w3-center" id="error-title">Confirm</h3> 
      </header> 
      <div class="w3-container w3-center">
      	<p id="error-message">Do you want to update?</p>
      </div>  
        <div class="w3-container" style="margin-bottom:10px;">
            <div class="w3-bar w3-center">
                <a id="ViewServlet" onclick="update_company_info()" class="w3-button w3-green w3-round">Accept &amp; Confirm</a>
                <a id="ButtonFirst" onclick="document.getElementById('error-box').style.display='none';" class="w3-button w3-blue w3-round">OK</a>
                <a id="ButtonSecond" onclick="document.getElementById('error-box').style.display='none';" class="w3-button w3-orange w3-round">Do it later</a>
            </div> 
        </div> 
    </div>
  </div>
       
    <?php include_once('_footer.php');?>

<!--date picker-->
<!--<script type="text/javascript">
    $( "#datepicker" ).datepicker();
	$( "#timepicker" ).timepicker();
</script>-->
<!--date picker-->
</body>
</html> 
