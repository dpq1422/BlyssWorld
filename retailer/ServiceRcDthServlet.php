<!DOCTYPE html>
<html>
<head>
<?php include_once('_all-inner-pages-html-title.php'); ?>
<script type="text/javascript" src="../js/admin-validation-functions.js"></script>
<!--date picker-->
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js"></script> 
<link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet"> -->
<!--date picker-->    
<?php include_once('../zc-session-admin.php'); ?>
<script>
$(document).ready(function(){
	$(".search-icon").click(function(){
	$(".search-show").toggleClass("s-show");
	});
	
	$(".them").click(function(){
	$(".them ul").toggleClass("them-top");
	});
});
</script>
<script>
var click=0;
function recharge_dth()
{
	click++;
	if(click==1)
	$("#RechargeDth").click();
}
function checkplan2()
{
	var operator=$("#operatorss").val();
	if(operator!="")
	{
		$.ajax({
			type: "POST",
			url: "../AjaxDthPlan2.php",
			data: {'operator': operator },
			dataType: "json",
		 
			//if received a response from the server
			success: function( data, textStatus, jqXHR) {
				//our country code was correct so we have some information to display/
				if(data!="")
				{
					//alert(data);
					$("#resulted_plans").html(data);
				}
			}	 
		});
	}
}
function check_values() {
	var operator=$("#operator").val();
	var mobile=$("#mobile").val();
	var amount=$("#amount").val();
	var txn_pn=$("#txn_pn").val();
	
	var error_message="";
	
	if(isEmpty(operator)==1)
		error_message+="<li>Select Operator.</li>";
	if(isEmpty(mobile)==1)
		error_message+="<li>DTH No./Mobile No. should not be empty.</li>";
	if(isNumeric(mobile)==1)
		error_message+="<li>DTH No./Mobile No. should has Numeric Only.</li>";	
	if(isSize(mobile,8,11)==1)
		error_message+="<li>DTH No./Mobile No. must have 8 to 11 digits.</li>";
	if(isEmpty(amount)==1)
		error_message+="<li>Amount should not be empty.</li>";
	if(isNumeric(amount)==1)
		error_message+="<li>Amount should has Numeric Only.</li>";	
	if(isEmpty(amount)==0 && isNumeric(amount)==0 && amount<100)
		error_message+="<li>Amount should be minimum 100.</li>";	
	if(isEmpty(txn_pn)==1)
		error_message+="<li>T-PIN should not be empty.</li>";	
	if(isSize(txn_pn,4,4)==1)
		error_message+="<li>T-PIN No must have 4 characters/digits.</li>";
	
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
		$("#error-message").html("Do you want to recharge DTH?");
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
                	<h4 class="heading wh w3-left"><span>Submit Form</span></h4>
                </div>
            </div>-->
            <div class="w3-row-padding w3-margin-top">
            	<div class="w3-col m12 wow bounceIn">
                	<div class="table-box wh w3-left">
                    	<div class="box-head">
                        	<h3>DTH Recharge</h3>
                        </div>
						<?php
						//if($logged_user_id!=200100)
						//echo "<script>window.location.href='TxnServiceOtherServlet';</script>";
						$msg="";
						if(isset($_REQUEST['msg']))
							$msg=$_REQUEST['msg'];
						$service=103;
						if(isset($_POST['RechargeDth']))
						{
							include_once('../zc-session-admin.php');
							$service=103;
							$txn_pn=mysql_real_escape_string($_POST['txn_pn']);
							if($txn_pn==$logged_tpin)
							{
								$mobile=mysql_real_escape_string($_POST['mobile']);
								$operator=mysql_real_escape_string($_POST['operator']);
								$operators=explode("@",$operator);
								$source_id=$operators[0];
								$operator_code=$operators[1];
								$operator_name=$operators[2];
								$circle="DTH";
								$amount=mysql_real_escape_string($_POST['amount']);
								include_once('../zf-WalletTxnRc.php');
								$result_transaction=txn_recharge($logged_user_id, $service, $mobile, $operator_code, $operator_name, $circle, $amount, $source_id);
								if($result_transaction!="")
								{
									$msg=$result_transaction;
									echo "<script>document.location.href='ServiceRcDthServlet?msg=$msg'</script>";
								}
								else
								{
									echo "<script>document.location.href='TxnServiceRcServlet'</script>";
								}
							}
							else
							{
								$msg="T-PIN not matched";
								echo "<script>document.location.href='ServiceRcDthServlet?msg=$msg'</script>";
							}
						}
						if($logged_tpin=="1234")
						{
						?>
						<form class="wh w3-left w3-white w3-padding w3-padding-32 w3-round-large" method="post">
						<h3 class="w3-block w3-center w3-text-red">Update default T-PIN to start Transaction</h3>
						<p>Click here to update default T-PIN <a class="w3-button w3-round w3-blue" href="MyChangeTpinServlet">Update T-PIN</a></p>
						</form>
						<?php 
						}
						else if($kinf!=3)// || $logged_pword=="$mp1" || $logged_pword=="$mp2")//removelx
						{
							$kdocinf="";
							if($kinf==0)
							{
								$kdocinf="<p>KYC is not uploaded.<br><br><a class='w3-button w3-round w3-blue' href='KycUpload'>Upload KYC Documents</a></p>";
							}
							else if($kinf==1 || $kinf==2)
							{
								$kdocinf="<p>Verification pending, please wait some time for KYC approval.<br><br></p>";
							}
							else if($kinf==-4 || $kinf==4)
							{
								$kdocinf="<p>KYC Documents In-complete, please upload again.<br><br><a class='w3-button w3-round w3-blue' href='KycUpload'>Re-upload KYC Documents</a></p>";
							}
						?>
						<form class="wh w3-left w3-white w3-padding w3-padding-32 w3-round-large" method="post">
							<h3 class="w3-block w3-center w3-text-red">KYC not Verified</h3>
							<?php echo $kdocinf;?>
						</form>
						<?php 
						}
						else
						{
						?>
                        <form class="wh w3-left" method="post">
                        	<div class="w3-row-padding w3-margin-bottom">   
								<div class="w3-col m12 l12 w3-margin-top">
									<p><?php if($msg!="" && $msg=="repeated") {echo "<b class='w3-text-red'>Repeated Transaction</b>:: You already had performed same transaction with same amount to same mobile today. If you still want to continue, kindly change recharge amount.";}
									else if($msg!="") {echo "<b class='w3-text-red'>$msg</b>";}
									?></p>
								</div>   	
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>DTH Provider</label>	
                                	<select class="w3-select w3-border w3-round" id="operator" name="operator">
                                        <option value="" required disabled selected>Choose your option</option>
									<?php
									include_once('../zf-ServiceMarginRc.php');
									$state_result=show_operators(" where operator_status=1 and service_id=$service ");
									while($state_row=mysql_fetch_array($state_result))
									{
										$oprid=$state_row['operator_id'];
										$sourceid=show_operator_active_source($oprid,$service);
										//if($sourceid==2)
											//echo "<option value='$sourceid@".$state_row['api_code_1']."@".$state_row['operator_name']."'>".$state_row['operator_name']."</option>";
										if($sourceid==6)
											echo "<option value='$sourceid@".$state_row['api_code_3']."@".$state_row['operator_name']."'>".$state_row['operator_name']."</option>";
									}
									?>
                                    </select>                                    
                                </div>  
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>Number/Id</label>
                                	<input name="mobile" id="mobile" type="text" placeholder="DTH No" class="w3-input w3-border w3-round">                                    
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>Amount</label>
                                	<input name="amount" id="amount" type="text" placeholder="Amount" class="w3-input w3-border w3-round">                                    
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>T-PIN</label>
                                	<input id="txn_pn" name="txn_pn" type="password" placeholder="T-PIN" class="w3-input w3-border w3-round">
                                </div>
                                   
                                <div class="w3-col m12 w3-margin-top w3-right-align">
									<button onclick="check_values()" name="RechargeDth" id="RechargeDth" class="w3-button w3-round-small w3-right w3-blue display-none">RechargeDth</button>
                                	<a class="w3-button w3-round w3-blue" onclick="check_values()">RECHARGE</a>
                                </div>                              
                        	</div>
                        </form>
						<?php
						}
						?>
                    </div>
                </div>
          	 </div>                       
        <!--</div>-->
    </section>
	
	<?php
	if($logged_user_id==$testing2 || $logged_user_id==$testing1)
	{
	?>
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
                        	<h3>CHECK RECHARGE PLAN/TARIFF</h3>
                        </div>
                        <form class="wh w3-left">
                        	<div class="w3-row-padding w3-margin-bottom">  								
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>Operator</label>	
                                	<select class="w3-select w3-border w3-round" onchange="checkplan2()" required id="operatorss" name="operatorss">
                                        <option value="" disabled selected>Choose your option</option>
										<option value="93">AIRTEL DTH</option>
										<option value="94">TATASKY DTH</option>
										<option value="95">VIDEOCON D2H</option>
										<option value="96">RELIANCE BIG TV</option>
										<option value="97">DISH TV</option>
										<option value="98">SUN DTH</option>
                                    </select>                       
                                </div>  
							</div>
						</form>
						<p id="resulted_plans" class="w3-table wh w3-left"></p>
                    </div>
                </div>
          	</div>
        <!--</div>-->
    </section>
	<?php
	}
	?>
    
  <div id="error-box" class="w3-modal">
    <div class="w3-modal-content w3-animate-zoom w3-card-4 w3-round list-pop">
      <header class="w3-container w3-blue"> 
        <span onclick="document.getElementById('error-box').style.display='none';" class="w3-button w3-display-topright"><img src="../img/close.png" style="margin-bottom:0px;"></span>
        <h3 class="w3-center" id="error-title">Confirm</h3> 
      </header> 
      <div class="w3-container w3-center">
      	<p id="error-message">Do you want to recharge DTH?</p>
      </div>  
        <div class="w3-container" style="margin-bottom:10px;">
            <div class="w3-bar w3-center">
                <a id="ViewServlet" onclick="recharge_dth()" class="w3-button w3-green w3-round">Accept &amp; Confirm</a>
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
