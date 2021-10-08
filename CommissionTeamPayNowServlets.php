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
function pay_now()
{
	click++;
	if(click==1)
	$("#PayNow").click();
}
function check_values() {
	var uid=$("#uid").val();
	var payfrom=$("#payfrom").val();
	var amount=$("#amount").val();
	var remarks=$("#remarks").val();
	
	var error_message="";
	
	if(isEmpty(uid)==1)
		error_message+="<li>User ID should not be blank.</li>";	
	if(isEmpty(payfrom)==1)
		error_message+="<li>Select Pay From Wallet.</li>";
	if(isNumeric(uid)==1)
		error_message+="<li>User ID should have number only.</li>";
	if(isEmpty(amount)==1)
		error_message+="<li>Amount should not be blank.</li>";
	/*
	if(isNumeric(amount)==1)
		error_message+="<li>Amount should have number only.</li>";
	*/
	if(isEmpty(remarks)==1)
		error_message+="<li>Remarks should not be blank.</li>";
	
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
		$("#error-message").html("Do you want to pay to user?");
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
                        	<h3>Team Commission PAY NOW</h3>
                        </div>
						<?php
						$userids="";
						if(isset($_REQUEST['userid']))
							$userids=$_REQUEST['userid'];
						include_once('zf-User.php');
						include_once('zf-Level.php');
						include_once('zf-Commission.php');
						$usernames=show_user_name($userids);
						$usertypes=show_user_type($userids);
						$usertypenames=show_level_name($usertypes);
						$paidcom=show_paid_comm($userids);
						$unpaidcom=show_unpaid_comm($userids);
						$gencom=$paidcom+$unpaidcom;
						if(isset($_POST['PayNow']))
						{
							include_once('zc-session-admin.php');
							include_once('zf-User.php');
							$payfrom=mysql_real_escape_string($_POST['payfrom']);
							$amount=mysql_real_escape_string($_POST['amount']);
							$remarks=mysql_real_escape_string($_POST['remarks']);
							pay_now($payfrom, $userids, $amount, $remarks);
							echo "<script>window.location.href='CommissionTeamUnPaidServlet';</script>";
						}
						?>
                        <form class="wh w3-left" method="post">
                        	<div class="w3-row-padding w3-margin-bottom">     	
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>USER ID</label>	
                                	<input type="text" value="<?php echo $userids;?>" class="w3-input w3-border w3-round" disabled>                                    
									<input type="hidden" id="uid" name="uid" value="<?php echo $userids;?>" />
                                </div>  
								
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>USER NAME</label>	
                                	<input type="text" value="<?php echo $usernames;?>" class="w3-input w3-border w3-round" disabled>                                    
                                </div>     	
								
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>USER LEVEL</label>	
                                	<input type="text" value="<?php echo $usertypenames;?>" class="w3-input w3-border w3-round" disabled>                                    
                                </div>  
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>GENERATED COMMISSION</label>
                                	<input type="text" value="<?php echo $gencom;?>" class="w3-input w3-border w3-round" disabled>                                    
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>PAID COMMISSION</label>
                                	<input type="text" value="<?php echo $paidcom;?>" class="w3-input w3-border w3-round" disabled>                                    
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>REMAIN COMMISSION</label>
                                	<input type="text" value="<?php echo $unpaidcom;?>" class="w3-input w3-border w3-round" disabled>                                    
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>PAY FROM</label>
                                	<select id="payfrom" class="w3-select w3-border w3-round" name="payfrom">
                                        <option value="" disabled selected>Choose your option</option>
                                        <option value="90006">ADMIN EARNING</option>
                                        <option value="90008">GST CALCULATED</option>
                                        <option value="90009">TDS CALCULATED</option>
                                    </select>
                                </div>  
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>AMOUNT (Paid via Bank Transfer)</label>
                                	<input type="text" id="amount" name="amount" placeholder="AMOUNT (Paid via Bank Transfer)" class="w3-input w3-border w3-round">
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>REMARKS</label>
                                	<input type="text" id="remarks" name="remarks" placeholder="REMARKS" class="w3-input w3-border w3-round">                                    
                                </div>
								
								<div class="w3-col m12 w3-margin-top w3-right-align">
									<button onclick="check_values()" name="PayNow" id="PayNow" class="w3-button w3-round-small w3-right w3-blue display-none">PAY</button>
                                	<a class="w3-button w3-round w3-blue" onclick="check_values()">PAY</a>
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
      	<p id="error-message">Do you want to create user?</p>
      </div>  
        <div class="w3-container" style="margin-bottom:10px;">
            <div class="w3-bar w3-center">
                <a id="ViewServlet" onclick="pay_now()" class="w3-button w3-green w3-round">Accept &amp; Confirm</a>
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
