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
function update_pass()
{
	click++;
	if(click==1)
	$("#WithdrawWallet").click();
}
function check_values() {
	var client=$("#client").val();
	var amount=$("#amount").val();
	var remarks=$("#remarks").val();
	
	var error_message="";
	
	if(isEmpty(client)==1)
		error_message+="<li>Select Client.</li>";
	if(isEmpty(amount)==1)
		error_message+="<li>Amount shoud not be blank.</li>";
	if(isNumeric(amount)==1)
		error_message+="<li>Amount should have number only.</li>";
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
		$("#error-message").html("Do you want to create user?");
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
                        	<h3>Withdraw Amount From Client Wallet</h3>
                        </div>
						<?php
						if(isset($_POST['WithdrawWallet']))
						{
							include_once('zc-session-admin.php');
							include_once('zf-WalletDistributed.php');
							include_once('zf-Client.php');
							$client=mysql_real_escape_string($_POST['client']);
							$amount=mysql_real_escape_string($_POST['amount']);
							$remarks=mysql_real_escape_string($_POST['remarks']);
							$client_type_id=show_client_type_id($client);
							
							$remarks_admin=$remarks." by $logged_user_typename ($logged_user_id - $logged_user_name)";
							withdraw_from_client($client_type_id, $client, $amount, $remarks, $remarks_admin);
							echo "<script>window.location.href='WalletDistributedServlet';</script>";
						}
						?>
                        <form class="wh w3-left" method="post">
                        	<div class="w3-row-padding w3-margin-bottom">  
                                <div class="w3-col m6 l3 w3-margin-top">
                                	<label>CLIENT</label>
                                	<select class="w3-select w3-border w3-round" id="client" name="client">
                                        <option value="" disabled selected>Choose your option</option>
									<?php
									include_once('zf-Client.php');
									$bank_result=show_clients_data(" where client_status=1 and client_id!=1001");
									while($bank_row=mysql_fetch_array($bank_result))
									{
										echo "<option value='".$bank_row['client_id']."'>".$bank_row['client_name']."</option>";
									}
									?>
                                    </select>                     
                                </div>
                                
                                <div class="w3-col m6 l3 w3-margin-top">
                                	<label>AMOUNT</label>
                                	<input type="text" id="amount" name="amount" placeholder="AMOUNT" class="w3-input w3-border w3-round">                                    
                                </div>
                                
                                <div class="w3-col m6 l6 w3-margin-top">
                                	<label>REMARKS</label>
                                	<input type="text" id="remarks" name="remarks" placeholder="REMARKS" class="w3-input w3-border w3-round">                                    
                                </div>
                                   
                                <div class="w3-col m12 w3-margin-top w3-right-align">
									<button onclick="check_values()" name="WithdrawWallet" id="WithdrawWallet" class="w3-button w3-round-small w3-right w3-blue display-none">WithdrawWallet</button>
                                	<a class="w3-button w3-round w3-blue" onclick="check_values()">Withdraw</a>
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
                <a id="ViewServlet" onclick="update_pass()" class="w3-button w3-green w3-round">Accept &amp; Confirm</a>
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
