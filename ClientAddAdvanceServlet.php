<!DOCTYPE html>
<html>
<head>
<?php include_once('_all-inner-pages-html-title.php'); ?>
<script type="text/javascript" src="js/admin-validation-functions.js"></script>
<script>
var click=0;
function update_pass()
{
	click++;
	if(click==1)
	$("#UpdateAdvance").click();
}
function check_values() {
	var amount=$("#amount").val();
	
	var error_message="";
	if(isEmpty(amount)==1)
		error_message+="<li>Amount shoud not be blank.</li>";
	if(isNumeric(amount)==1)
		error_message+="<li>Amount should have number only.</li>";
	
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
						<?php
						include_once('zf-Service.php');
						include_once('zf-Client.php');
						
						$client_id=$_REQUEST['id'];
						$client_name=show_client_name($client_id);
						$client_type=show_client_type($client_id);
						$client_type_id=show_client_type_id($client_id);
						
						if(isset($_POST['UpdateAdvance']))
						{
							include_once('zc-session-admin.php');
							include_once('zf-Client.php');
							$client=$_POST['client'];
							$amount=$_POST['amount'];

							$client=mysql_real_escape_string($client);
							$amount=mysql_real_escape_string($amount);
							update_dummy_balance($client,$amount);
							echo "<script>window.location.href='ClientsServlet';</script>";
						}
						?>
                    	<div class="box-head">
                        	<h3>Add Advance Amount</h3>
                        </div>
                        <form class="wh w3-left" method="post">
                        	<div class="w3-row-padding w3-margin-bottom">  
                            	                      	
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>Client ID</label>	
                                	<input type="text" value="<?php echo $client_id;?>" placeholder="Client ID" class="w3-input w3-border w3-round" disabled>
                                	<input type="hidden" id="client" name="client" value="<?php echo $client_id;?>" />
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>Client Name</label>
                                	<input type="text" value="<?php echo $client_name;?>" placeholder="Client Name" class="w3-input w3-border w3-round" disabled>                                    
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>Client Type</label>
                                	<input type="text" value="<?php echo $client_type;?>" placeholder="Client Type" class="w3-input w3-border w3-round" disabled>                                    
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>Add Advance Amount</label>
                                	<input type="text" id="amount" name="amount" placeholder="Add Advance Amount" class="w3-input w3-border w3-round">                                    
                                </div>
                                   
                                <div class="w3-col m12 w3-margin-top w3-right-align">
									<button onclick="check_values()" name="UpdateAdvance" id="UpdateAdvance" class="w3-button w3-round-small w3-right w3-blue display-none">UpdateAdvance</button>
                                	<a class="w3-button w3-round w3-blue" onclick="check_values()">Add Advance</a>
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
	
</body>
</html> 
