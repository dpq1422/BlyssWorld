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
function recharge_mobile()
{
	click++;
	if(click==1)
	$("#RechargeMobile").click();
}
function checkoprcir()
{
	var mobile=$("#mobile").val();
	if(mobile.length==4)
	{
		$.ajax({
			type: "POST",
			url: "../AjaxMobileOperatorCircle.php",
			data: {'mobile': mobile },
			dataType: "json",
		 
			//if received a response from the server
			success: function( data, textStatus, jqXHR) {
				//our country code was correct so we have some information to display/
				var resulted_data=data.split("@");//operator//circle//circleid
				var operator=document.getElementById("operator");
				var circle=document.getElementById("circle");
				
				for(i=0; i<operator.options.length;i++)
				{
					opr_val=operator.options[i].value;
					opr_vals=opr_val.split("@");
					if(opr_vals[2]==resulted_data[0])
					operator.options[i].selected=true;
				}
				
				for(i=0; i<circle.options.length;i++)
				{
					cir_val=circle.options[i].value;
					if(cir_val.toUpperCase()==resulted_data[1].toUpperCase())
					circle.options[i].selected=true;
				}
			}	 
		});
	}
}
function checkplan()
{
	var type=$("#typess").val();
	var operator=$("#operatorss").val();
	var circle=$("#circless").val();
	if(type!="" && operator!="" && circle!="")
	{
		$.ajax({
			type: "POST",
			url: "../AjaxMobilePlan.php",
			data: {'type': type , 'operator': operator, 'circle': circle },
			dataType: "json",
		 
			//if received a response from the server
			success: function( data, textStatus, jqXHR) {
				//our country code was correct so we have some information to display/
				if(data!="")
				alert(data);
			}	 
		});
	}
}
function checkplan2()
{
	var type=$("#typess").val();
	var operator=$("#operatorss").val();
	var circle=$("#circless").val();
	if(type!="" && operator!="" && circle!="")
	{
		$.ajax({
			type: "POST",
			url: "../AjaxMobilePlan2.php",
			data: {'type': type , 'operator': operator, 'circle': circle },
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
	var mobile=$("#mobile").val();
	var operator=$("#operator").val();
	var circle=$("#circle").val();
	var amount=$("#amount").val();
	var txn_pn=$("#txn_pn").val();
	
	var error_message="";
	
	if(isEmpty(mobile)==1)
		error_message+="<li>Mobile No should not be empty.</li>";
	if(isNumeric(mobile)==1)
		error_message+="<li>Mobile No should has Numeric Only.</li>";	
	if(isSize(mobile,10,10)==1)
		error_message+="<li>Mobile No must have 10 digits.</li>";
	if(isEmpty(operator)==1)
		error_message+="<li>Select Operator.</li>";
	if(isEmpty(circle)==1)
		error_message+="<li>Select Circle.</li>";
	if(isEmpty(amount)==1)
		error_message+="<li>Amount should not be empty.</li>";
	if(isNumeric(amount)==1)
		error_message+="<li>Amount should has Numeric Only.</li>";	
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
		$("#error-message").html("Do you want to recharge Mobile?");
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
                        	<h3>Prepaid Mobile Recharge</h3>
                        </div>
						<?php
						$msg="";
						if(isset($_REQUEST['msg']))
							$msg=$_REQUEST['msg'];
						$service=102;
						if(isset($_POST['RechargeMobile']))
						{
							include_once('../zc-session-admin.php');
							$service=102;
							$txn_pn=mysql_real_escape_string($_POST['txn_pn']);
							if($txn_pn==$logged_tpin)
							{
								$mobile=mysql_real_escape_string($_POST['mobile']);
								$operator=mysql_real_escape_string($_POST['operator']);
								$operators=explode("@",$operator);
								$source_id=$operators[0];
								$operator_code=$operators[1];
								$operator_name=$operators[2];
								$circle=mysql_real_escape_string($_POST['circle']);
								$amount=mysql_real_escape_string($_POST['amount']);
								include_once('../zf-WalletTxnRc.php');
								$result_transaction=txn_recharge($logged_user_id, $service, $mobile, $operator_code, $operator_name, $circle, $amount, $source_id);
								if($result_transaction!="")
								{
									$msg=$result_transaction;
									echo "<script>document.location.href='ServiceRcMobServlet?msg=$msg'</script>";
								}
								else
								{
									echo "<script>document.location.href='TxnServiceRcServlet'</script>";
								}
							}
							else
							{
								$msg="T-PIN not matched";
								echo "<script>document.location.href='ServiceRcMobServlet?msg=$msg'</script>";
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
                                	<label>Mobile</label>
                                	<input id="mobile" onkeyup="checkoprcir()" name="mobile" type="text" placeholder="Mobile" class="w3-input w3-border w3-round">
                                </div>   	
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>Operator</label>	
                                	<select class="w3-select w3-border w3-round" required id="operator" name="operator">
                                        <option value="" disabled selected>Choose your option</option>
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
                                	<label>Circle</label>	
                                	<select class="w3-select w3-border w3-round" required id="circle" name="circle">
                                        <option value="" disabled selected>Choose your option</option>
									<?php
									include_once('../zf-ServiceMarginRc.php');
									$state_result=show_rc1_circles();
									while($state_row=mysql_fetch_array($state_result))
									{
											echo "<option value='".$state_row['api_code_1']."'>".$state_row['api_code_1']."</option>";
									}
									?>
                                    </select>                                   
                                </div>  
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>Amount</label>
                                	<input id="amount" name="amount" type="text" placeholder="Amount" class="w3-input w3-border w3-round">
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>T-PIN</label>
                                	<input id="txn_pn" name="txn_pn" type="password" placeholder="T-PIN" class="w3-input w3-border w3-round">
                                </div>
                                   
                                <div class="w3-col m12 w3-margin-top w3-right-align">
									<button onclick="check_values()" name="RechargeMobile" id="RechargeMobile" class="w3-button w3-round-small w3-right w3-blue display-none">RechargeMobile</button>
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
										<option value="28">AIRTEL</option>
										<option value="1">AIRCEL</option>
										<option value="3">BSNL</option>
										<option value="22">VODAFONE</option>
										<option value="17">TATA DOCOMO GSM</option>
										<option value="18">TATA DOCOMO CDMA</option>
										<option value="13">RELIANCE GSM</option>
										<option value="12">RELAINCE CDMA</option>
										<option value="10">MTS</option>
										<option value="19">UNINOR</option>
										<option value="9">LOOP</option>
										<option value="5">VIDEOCON</option>
										<option value="6">MTNL MUMBAI</option>
										<option value="20">MTNL DELHI</option>
										<option value="8">IDEA</option>
										<option value="29">JIO</option>
                                    </select>                       
                                </div>     	
								
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>Circle</label>	
                                	<select class="w3-select w3-border w3-round" onchange="checkplan2()" required id="circless" name="circless">
                                        <option value="" disabled selected>Choose your option</option>
										<option value="5">Andhra Pradesh</option>
										<option value="19">Assam</option>
										<option value="17">Bihar & Jharkhand</option>
										<option value="23">Chennai</option>
										<option value="1">Delhi/NCR</option>
										<option value="8">Gujarat</option>
										<option value="16">Haryana</option>
										<option value="21">Himachal Pradesh</option>
										<option value="22">Jammu & Kashmir</option>
										<option value="7">Karnataka</option>
										<option value="14">Kerala</option>
										<option value="3">Kolkata</option>
										<option value="2">Mumbai</option>
										<option value="20">North East</option>
										<option value="18">Orissa</option>
										<option value="15">Punjab</option>
										<option value="13">Rajasthan</option>
										<option value="6">Tamil Nadu</option>
										<option value="9">Uttar Pradesh (E)</option>
										<option value="11">Uttar Pradesh (W)</option>
										<option value="12">West Bengal</option>
										<option value="4">Maharashtra</option>
										<option value="10">Madhya Pradesh</option>
                                    </select>                                   
                                </div>    
								
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>RECHARGE TYPE</label>	
                                	<select class="w3-select w3-border w3-round" onchange="checkplan2()" required id="typess" name="typess">
                                        <option value="" disabled selected>Choose your option</option>
                                        <option value="2G" >2G PACK</option>
                                        <option value="3G" >3G PACK</option>
                                        <option value="FTT" >FULL TALKTIME</option>
                                        <option value="LSC" >Local/STD/ISD Call</option>
                                        <option value="OTR" >Other Recharge</option>
                                        <option value="RMG" >ROAMING</option>
                                        <option value="SMS" >SMS PACK</option>
                                        <option value="TUP" >TOP-UP</option>
									</select>
								</div>
							</div>
						</form>
						<p id="resulted_plans" class="w3-table wh w3-left"></p>
                    </div>
                </div>
          	</div>     
			
			
            <div class="w3-row-padding w3-margin-top display-none">
            	<div class="w3-col m12 wow bounceIn">
                	<div class="table-box wh w3-left">
                    	<div class="box-head">
                        	<h3>CHECK RECHARGE PLAN/TARIFF</h3>
                        </div>
                        <form class="wh w3-left">
                        	<div class="w3-row-padding w3-margin-bottom">  								
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>Operator</label>	
                                	<select class="w3-select w3-border w3-round" onchange="checkplan()" required id="operatorss" name="operatorss">
                                        <option value="" disabled selected>Choose your option</option>
									<?php
									include_once('../zf-ServiceMarginRc.php');
									$state_result=show_operators(" where operator_status=1 and service_id=$service ");
									while($state_row=mysql_fetch_array($state_result))
									{
										$oprid=$state_row['operator_id'];
										$sourceid=show_operator_active_source($oprid,$service);
										if($sourceid==2)
											echo "<option value='$sourceid@".$state_row['api_code_1']."@".$state_row['operator_name']."'>".$state_row['operator_name']."</option>";
										if($sourceid==4)
											echo "<option value='$sourceid@".$state_row['api_code_3']."@".$state_row['operator_name']."'>".$state_row['operator_name']."</option>";
									}
									?>
                                    </select>                       
                                </div>     	
								
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>Circle</label>	
                                	<select class="w3-select w3-border w3-round" onchange="checkplan()" required id="circless" name="circless">
                                        <option value="" disabled selected>Choose your option</option>
									<?php
									include_once('../zf-ServiceMarginRc.php');
									$state_result=show_rc1_circles();
									while($state_row=mysql_fetch_array($state_result))
									{
											echo "<option value='".$state_row['api_code_1']."'>".$state_row['api_code_1']."</option>";
									}
									?>
                                    </select>                                   
                                </div>    
								
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>RECHARGE TYPE</label>	
                                	<select class="w3-select w3-border w3-round" onchange="checkplan()" required id="typess" name="typess">
                                        <option value="" disabled selected>Choose your option</option>
                                        <option value="2G" >2G PACK</option>
                                        <option value="3G" >3G PACK</option>
                                        <option value="FTT" >FULL TALKTIME</option>
                                        <option value="LSC" >Local/STD/ISD Call</option>
                                        <option value="OTR" >Other Recharge</option>
                                        <option value="RMG" >ROAMING</option>
                                        <option value="SMS" >SMS PACK</option>
                                        <option value="TUP" >TOP-UP</option>
									</select>
								</div>
							</div>
						</form>
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
      	<p id="error-message">Do you want to recharge Mobile?</p>
      </div>  
        <div class="w3-container" style="margin-bottom:10px;">
            <div class="w3-bar w3-center">
                <a id="ViewServlet" onclick="recharge_mobile()" class="w3-button w3-green w3-round">Accept &amp; Confirm</a>
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
