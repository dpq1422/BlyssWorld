<!DOCTYPE html>
<html>
<head>
<?php include_once('_all-inner-pages-html-title.php'); ?>
<script type="text/javascript" src="../js/admin-validation-functions.js"></script>
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
		url: "../AjaxShowDistServlet",
		data: {'states': states},
		dataType: "json",
	 
		//if received a response from the server
		success: function( data, textStatus, jqXHR) {
			//our country code was correct so we have some information to display/
			$("#districts").html(data);
		}	 
	});
}
var click=0;
function updatebank()
{
	click++;
	if(click==1)
	$("#UpdateBankInfo").click();
}
function check_values() {
	var bname=$("#bname").val();
	var bifsc=$("#bifsc").val();
	var bacc=$("#bacc").val();
	
	var error_message="";	
	
	if(isEmpty(bname)==1)
		error_message+="<li>Bank name should not be blank.</li>";
	if(isEmpty(bifsc)==1)
		error_message+="<li>Bank IFSC code should not be blank.</li>";
	if(isSize(bifsc,11,11)==1)
		error_message+="<li>Bank IFSC code should has 11 characters.</li>";
	if(isEmpty(bacc)==1)
		error_message+="<li>Bank account number should not be blank.</li>";
	
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
		$("#error-message").html("Do you want to update Bank Account Info?");
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
						if($binf!=0 && $binf!=-4)
							echo "<script>window.location.href='MyProfileServlet';</script>";
						$userid=$logged_user_id;
						if(isset($_POST['UpdateBankInfo']))
						{
							include_once('../zc-session-admin.php');
							include_once('../zf-UserWalletKyc.php');
							
							$mybname=mysql_real_escape_string($_POST['bname']);
							$mybifsc=mysql_real_escape_string($_POST['bifsc']);
							$mybaccno=mysql_real_escape_string($_POST['bacc']);
							
							$bst=2;
							
							$resultupload=update_my_bank($userid,$mybname,$mybaccno,$mybifsc,$bst);
							if($resultupload>0)
							{
								echo "<script>window.location.href='MyProfileServlet';</script>";
							}
							else
							{
								echo "<script>window.location.href='BankUpdate?msg=$resultupload';</script>";
							}
						}
						include_once('../zf-User.php');
						include_once('../zf-Level.php');
						include_once('../zf-UserWalletKyc.php');
						$userid=$logged_user_id;
						$username=show_user_name($userid);
						$usertype=show_user_type($userid);
						$usertypename=show_level_name($usertype);
						$kyc_data=show_kyc_data($userid);
						?>
                    	<div class="box-head">
                        	<h3>USER BANK ACCOUNT DETAILS</h3>
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
						<form class="wh w3-left" method="post" enctype="multipart/form-data">		
                        	<div class="w3-row-padding w3-margin-bottom"> 	
								
                            	<div class="w3-col m12 l12 w3-margin-top">
									<b class='w3-text-blue w3-medium'>BANK ACCOUNT INFORMATION (FOR COMMISSION PAYOUT)</b>                               
                                </div>		
								
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>BANK NAME</label>	
                                	<input type="text" id="bname" name="bname" value="<?php echo $kyc_data[17];?>" placeholder="Bank Name" class="w3-input w3-border w3-round">                                    
                                </div>
                            	                      	
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>IFSC CODE</label>
                                	<input type="text" id="bifsc" name="bifsc" value="<?php echo $kyc_data[19];?>" placeholder="Bank IFSC Code" class="w3-input w3-border w3-round">                                    
                                </div>
                                
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>ACCOUNT NUMBER</label>	
                                	<input type="text" id="bacc" name="bacc" value="<?php echo $kyc_data[18];?>" placeholder="Bank Account No" class="w3-input w3-border w3-round">                                    
                                </div>
								
								<div class="w3-col m6 l12 w3-margin-top">
                                	<label>&nbsp;</label>
									<input type="button" onclick="check_values()" value="Update Details" class="w3-input w3-border w3-round w3-button w3-blue w3-w150 w3-right">
									<button onclick="check_values()" name="UpdateBankInfo" id="UpdateBankInfo" class="w3-button w3-round-small w3-right w3-blue display-none">UpdateBankInfo</button>
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
        <span onclick="document.getElementById('error-box').style.display='none';" class="w3-button w3-display-topright"><img src="../img/close.png" style="margin-bottom:0px;"></span>
        <h3 class="w3-center" id="error-title"></h3> 
      </header> 
      <div class="w3-container w3-center">
      	<p id="error-message" class='w3-left-align'></p>
      </div> 
        <div class="w3-container" style="margin-bottom:10px;">
            <div class="w3-bar w3-center">
                <a id="ViewServlet" onclick="updatebank()" class="w3-button w3-green w3-round">Accept &amp; Confirm</a>
                <a id="ButtonFirst" onclick="document.getElementById('error-box').style.display='none';" class="w3-button w3-blue w3-round">OK</a>
                <a id="ButtonSecond" onclick="document.getElementById('error-box').style.display='none';" class="w3-button w3-orange w3-round">Do it later</a>
            </div> 
        </div> 
    </div>
  </div>
       
    <?php include_once('_footer.php');?>

</body>
</html> 
