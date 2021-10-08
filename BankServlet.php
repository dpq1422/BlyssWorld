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
function update_contact_info()
{
	click++;
	if(click==1)
	$("#AddBankInfo").click();
}
function check_values() {
	var bname=$("#bname").val();
	var baname=$("#baname").val();
	var bbname=$("#bbname").val();
	var bano=$("#bano").val();
	var bifsc=$("#bifsc").val();
	var bcdm=$("#bcdm").val();
	var bcheque=$("#bcheque").val();
	var bcash=$("#bcash").val();
	var bremark=$("#bremark").val();
	var bstatus=$("#bstatus").val();
	
	var error_message="";
	
	if(isEmpty(bname)==1)
		error_message+="<li>Bank name should not be blank.</li>";
	if(isEmpty(baname)==1)
		error_message+="<li>Account name should not be blank.</li>";
	if(isEmpty(bbname)==1)
		error_message+="<li>Branch Name should not be blank.</li>";
	if(isEmpty(bano)==1)
		error_message+="<li>Account Number should not be blank.</li>";
	if(isEmpty(bifsc)==1)
		error_message+="<li>IFSC code should not be blank.</li>";
	if(isSize(bifsc,11,11)==1)
		error_message+="<li>IFSC code size should be in 11 characters.</li>";	
	if(isEmpty(bcdm)==1)
		error_message+="<li>CDM charges should not be blank.</li>";
	if(isNumeric(bcdm)==1)
		error_message+="<li>CDM charges should has Numeric Only.</li>";
	if(isEmpty(bcheque)==1)
		error_message+="<li>Cheque bounce charges should not be blank.</li>";
	if(isNumeric(bcheque)==1)
		error_message+="<li>Cheque bounce charges should has Numeric Only.</li>";
	if(isEmpty(bcash)==1)
		error_message+="<li>Cash deposit charges should not be blank.</li>";
	if(isNumeric(bcash)==1)
		error_message+="<li>Cash deposit charges should has Numeric Only.</li>";
	if(isEmpty(bremark)==1)
		error_message+="<li>Remarks should not be blank.</li>";	
	if(isEmpty(bstatus)==1)
		error_message+="<li>Select status.</li>";	
	
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
		$("#error-message").html("Do you want to add compnay bank info?");
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
                        	<h3>ADD NEW BANK</h3>
                        </div>
						<?php
						if(isset($_POST['AddBankInfo']))
						{
							include_once('zc-session-admin.php');
							include_once('zf-Bank.php');
							$bname=mysql_real_escape_string($_POST['bname']);
							$baname=mysql_real_escape_string($_POST['baname']);
							$bbname=mysql_real_escape_string($_POST['bbname']);
							$bano=mysql_real_escape_string($_POST['bano']);
							$bifsc=mysql_real_escape_string($_POST['bifsc']);
							$bcdm=mysql_real_escape_string($_POST['bcdm']);
							$bcheque=mysql_real_escape_string($_POST['bcheque']);
							$bcash=mysql_real_escape_string($_POST['bcash']);
							$bremark=mysql_real_escape_string($_POST['bremark']);
							$bstatus=mysql_real_escape_string($_POST['bstatus']);
							add_bank($bname,$baname,$bbname,$bano,$bifsc,$bcdm,$bcheque,$bcash,$bremark,$bstatus,$logged_user_typename,$logged_user_id,$logged_user_name);
							echo "<script>window.location.href='BanksServlet';</script>";
						}
						?>
                        <form class="wh w3-left" method="post">
                        	<div class="w3-row-padding w3-margin-bottom"> 
                            	                      	
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>Bank Name</label>	
                                	<input id="bname" name="bname" type="text" placeholder="Bank Name" class="w3-input w3-border w3-round">                                    
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>Account Name</label>
                                	<input id="baname" name="baname" type="text" placeholder="Account Name" class="w3-input w3-border w3-round">                                    
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>Branch Name</label>	
                                	<input id="bbname" name="bbname" type="text" placeholder="Branch Name" class="w3-input w3-border w3-round">
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>Account No.</label>
                                	<input id="bano" name="bano" type="text" placeholder="Account No." class="w3-input w3-border w3-round">                                    
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>IFSC Code</label>	
                                	<input id="bifsc" name="bifsc" type="text" placeholder="IFSC Code" class="w3-input w3-border w3-round">
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>Cash Deposit Charges</label>	
                                	<input id="bcash" name="bcash" type="text" placeholder="Cash Deposit Charges" class="w3-input w3-border w3-round">
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>CDM Charges</label>	
                                	<input id="bcdm" name="bcdm" type="text" placeholder="CDM Charges" class="w3-input w3-border w3-round">
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>Cheque Bounce Charges</label>	
                                	<input id="bcheque" name="bcheque" type="text" placeholder="Cheque Bounce Charges" class="w3-input w3-border w3-round">
                                </div> 
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>Remarks</label>
                                	<input id="bremark" name="bremark" type="text" placeholder="Remarks" class="w3-input w3-border w3-round">                                    
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>Status</label>
                                	<select id="bstatus" class="w3-select w3-border w3-round" name="bstatus">
                                        <option value="" disabled selected>Choose your option</option>
                                        <option value="1">Active</option>
                                        <option value="2">Blocked</option>
                                    </select>
                                </div> 
                                   
                                <div class="w3-col m12 w3-margin-top w3-right-align">
									<button onclick="check_values()" name="AddBankInfo" id="AddBankInfo" class="w3-button w3-round-small w3-right w3-blue display-none">SaveBank</button>
                                	<a class="w3-button w3-round w3-blue" onclick="check_values()">Save Bank</a>
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
      	<p id="error-message">Do you want to add compnay bank info?</p>
      </div>  
        <div class="w3-container" style="margin-bottom:10px;">
            <div class="w3-bar w3-center">
                <a id="ViewServlet" onclick="update_contact_info()" class="w3-button w3-green w3-round">Accept &amp; Confirm</a>
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
