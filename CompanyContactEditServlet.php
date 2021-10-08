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
	$("#UpdateContactInfo").click();
}
function check_values() {
	var cname=$("#cname").val();
	var cmob=$("#cmob").val();
	var cemail=$("#cemail").val();
	
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
		$("#error-message").html("Do you want to update Company Contact Info?");
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
                        	<h3>COMPANY CONTACT INFO (Edit/Update)</h3>
                        </div>
						<?php
						if($logged_user_type!=1)
						{
							echo "<script>window.location.href='index';</script>";
						}
						include_once('zf-Company.php');
						$company_result=show_company_info(1);
						$company_row=mysql_fetch_array($company_result);
						
						
						if(isset($_POST['UpdateContactInfo']))
						{
							include_once('zc-session-admin.php');
							include_once('zf-Company.php');
							$cname=mysql_real_escape_string($_POST['cname']);
							$cmob=mysql_real_escape_string($_POST['cmob']);
							$cemail=mysql_real_escape_string($_POST['cemail']);
							update_company_contact_info(1,$cname,$cmob,$cemail,$logged_user_typename,$logged_user_id,$logged_user_name);
							echo "<script>window.location.href='CompanyContactViewServlet';</script>";
						}
						?>
                        <form class="wh w3-left" method="post" onsubmit="return check_values()">
                        	<div class="w3-row-padding w3-margin-bottom">    	
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>Company Name <b>(also displayed in master/company info)</b></label>	
                                	<input type="text" name="cname" id="cname" placeholder="Name" class="w3-input w3-border w3-round" value="<?php echo $company_row['company_name'];?>">                                    
                                </div>  
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>Mobile <b>(also displayed in master/company info)</b></label>
                                	<input type="text" name="cmob" id="cmob" placeholder="Mobile" class="w3-input w3-border w3-round" value="<?php echo $company_row['contact_no'];?>">                                    
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>Email <b>(also displayed in master/company info)</b></label>
                                	<input type="text" name="cemail" id="cemail" placeholder="Email" class="w3-input w3-border w3-round" value="<?php echo $company_row['e_mail'];?>">
									<button onclick="check_values()" name="UpdateContactInfo" id="UpdateContactInfo" class="w3-button w3-round-small w3-right w3-blue display-none">UPDATE</button>                                    
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
      	<p id="error-message">Do you want to update Company Contact Info?</p>
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
