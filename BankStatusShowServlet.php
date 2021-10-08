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
	$("#geo").val('0');
	if(pincode.length==6)
	{
		$("#error-title").html("Updating GEO Location");
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
				if($("#aadhar_no").val()=="")
				$("#aadhar_no").focus();
			}
		});
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
						<form class="wh w3-left" method="post">		
                        	<div class="w3-row-padding w3-margin-bottom"> 								
                            	<div class="w3-col m12 l12 w3-margin-top">
									<b class='w3-text-blue w3-medium'>BANK ACCOUNT INFORMATION</b>                               
                                </div>		
								
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>BANK NAME</label>	
                                	<input type="text" disabled value="<?php echo $kyc_data[17];?>" placeholder="Bank Name" class="w3-input w3-border w3-round">                                    
                                </div>
                            	                      	
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>IFSC CODE</label>
                                	<input type="text" disabled value="<?php echo $kyc_data[19];?>" placeholder="Bank IFSC Code" class="w3-input w3-border w3-round">                                    
                                </div>
                                
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>ACCOUNT NUMBER</label>	
                                	<input type="text" disabled value="<?php echo $kyc_data[18];?>" placeholder="Bank Account No" class="w3-input w3-border w3-round">                                    
                                </div>			
								
                            	<div class="w3-col m12 l12 w3-margin-top">
									<b class='w3-text-blue w3-medium'>BANK STATUS</b>                               
                                </div>			
								
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>UPDATED STATUS </label>	
                                	<select name="a1" disabled class="w3-input w3-border w3-round">
									<?php
									$kveri="";
									$kincomp="";
									if($kyc_data[21]==3)
										$kveri="selected";
									else
										$kincomp="selected";
									
									echo "<option value=''>BANK STATUS</option>";
									echo "<option value='4' $kincomp>Documents In-complete</option>";
									echo "<option value='3' $kveri>Account Verified</option>";
									?> 
									</select>                                                                 
                                </div> 
								<div class="w3-col m6 l4 w3-margin-top">
                                	<label>&nbsp;</label>
									<input type="button" onclick="window.history.back();" value="Go Back" class="w3-input w3-border w3-round w3-button w3-blue w3-w150">
                                </div>
								<?php
								if($logged_user_id==$sub_admin2)
								{
								?>
								<div class="w3-col m6 l4 w3-margin-top">
                                	<label>&nbsp;</label>
									<input type="button" onclick="window.location='BankStatusUpdateServlet?uid=<?php echo $userid;?>'" value="Modify/Update Bank Details" class="w3-input w3-border w3-round w3-button w3-green w3-w150">
                                </div>
								<?php
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
        <h3 class="w3-center" id="error-title">Confirm</h3> 
      </header> 
      <div class="w3-container w3-center">
      	<p id="error-message" class='w3-left-align'><img src='img/refresh.gif' height='50' align='right' />Please wait few seconds...<br>while we update GEO Location of User...</p>
      </div> 
        <div class="w3-container" style="margin-bottom:10px;">
            <div class="w3-bar w3-center">
                <a id="ButtonFirst" onclick="document.getElementById('error-box').style.display='none';" class="w3-button w3-blue w3-round">OK</a>
            </div> 
        </div> 
    </div>
  </div>
       
    <?php include_once('_footer.php');?>

</body>
</html> 
