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
<script>
var click=0;
function generate_request()
{
	click++;
	if(click==1)
	$("#GenerateRequest").click();
}
function check_values() {
	var bnk=$("#parent").val();
	var amt=$("#amt").val();
	var rmk=$("#rmk").val();
	
	var error_message="";
	
	if(isEmpty(bnk)==1)
		error_message+="<li>Select Bank.</li>";
	if(isEmpty(amt)==1)
		error_message+="<li>Amount is required</li>";	
	if(isNumeric(amt)==1)
		error_message+="<li>Amount should has Numeric Only.</li>";
	if(isEmpty(rmk)==1)
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
		var msg="Do you want to send wallet request to Distributor?";
		$("#error-title").html("Confirm");
		$("#error-message").html(msg);
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
                        	<h3>SEND NEW WALLET REQUEST TO DISTRIBUTOR</h3>
                        </div>
						<?php
						if(isset($_POST['GenerateRequest']))
						{
							include_once('../zc-session-admin.php');
							include_once('../zf-Bank.php');
							$filled_bank=mysql_real_escape_string($_POST['parent']);
							$filled_amount=mysql_real_escape_string($_POST['filled_amount']);
							$filled_remark=mysql_real_escape_string($_POST['filled_remark']);
							generate_request222($filled_bank,$filled_amount,$filled_remark,$logged_user_id,$logged_user_name);
							echo "<script>window.location.href='WalletSentRequestsTeamServlet';</script>";
						}
						
						include_once('../zf-UserLevel.php');
						include_once('../zf-User.php');
						$its_my_parent=show_parent_id222($logged_user_id);
						$its_my_parent_name=show_user_name($its_my_parent);
						?>
                        <form class="wh w3-left" method="post">
                        	<div class="w3-row-padding w3-margin-bottom"> 
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>DISTRIBUTOR NAME</label>
									<input type="hidden" id="parent" required name="parent" value="<?php echo $its_my_parent;?>"/>
                                	<input type="text" readonly disabled value="<?php echo $its_my_parent_name;?>" class="w3-input w3-border w3-round">    
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>AMOUNT</label>
                                	<input type="text" id="amt" name="filled_amount" required placeholder="AMOUNT" class="w3-input w3-border w3-round">                                    
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>REMARKS</label>
                                	<input type="text" id="rmk" name="filled_remark" required placeholder="REMARKS" class="w3-input w3-border w3-round">
									<button onclick="check_values()" name="GenerateRequest" id="GenerateRequest" class="w3-button w3-round-small w3-right w3-blue display-none">UPDATE</button>                                    
                                </div>
                                   
                                <div class="w3-col m12 w3-margin-top w3-right-align">
                                	<a class="w3-button w3-round w3-blue" onclick="check_values()">Send</a>
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
        <h3 class="w3-center" id="error-title">Confirm</h3> 
      </header> 
      <div class="w3-container w3-center">
      	<p id="error-message">Do you want to send wallet request?</p>
      </div>  
        <div class="w3-container" style="margin-bottom:10px;">
            <div class="w3-bar w3-center">
                <a id="ViewServlet" onclick="generate_request()" class="w3-button w3-green w3-round">Accept &amp; Confirm</a>
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
