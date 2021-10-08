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
	$("#CreatePlan").click();
}
function check_values() {
	var pname=$("#pname").val();
	var psec=$("#psec").val();
	var pfee=$("#pfee").val();
	var premarks=$("#premarks").val();
	var pstat=$("#pstat").val();
	
	var error_message="";
	
	if(isEmpty(pname)==1)
		error_message+="<li>Plan name should not be blank.</li>";
	if(isEmpty(psec)==1)
		error_message+="<li>Security Fee should not be blank (can be zero).</li>";
	if(isNumeric(psec)==1)
		error_message+="<li>Security Fee should have number only.</li>";
	if(isEmpty(pfee)==1)
		error_message+="<li>Membership Fee should not be blank (can be zero).</li>";
	if(isNumeric(pfee)==1)
		error_message+="<li>Membership Fee should have number only.</li>";
	if(isEmpty(premarks)==1)
		error_message+="<li>Remarks should not be blank.</li>";
	if(isEmpty(pstat)==1)
		error_message+="<li>Select Plan Status.</li>";
	
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
		$("#error-message").html("Do you want to create plan?");
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
                        	<h3>ADD NEW MEMBERSHIP PLAN</h3>
                        </div>
						<?php
						echo "<script>window.location.href='PlansServlet';</script>";
						if(isset($_POST['CreatePlan']))
						{
							include_once('zc-session-admin.php');
							include_once('zf-Plan.php');
							$pname=mysql_real_escape_string($_POST['pname']);
							$psec=mysql_real_escape_string($_POST['psec']);
							$pfee=mysql_real_escape_string($_POST['pfee']);
							$premarks=mysql_real_escape_string($_POST['premarks']);
							$pstat=mysql_real_escape_string($_POST['pstat']);
							create_plan($pname, $psec, $pfee, $premarks, $pstat);
							echo "<script>window.location.href='PlansServlet';</script>";
						}
						?>
                        <form class="wh w3-left" method="post">
                        	<div class="w3-row-padding w3-margin-bottom">  
                            	                      	
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>Plan Name</label>	
                                	<input name="pname" id="pname" type="text" placeholder="Name" class="w3-input w3-border w3-round">                                    
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>Security Fee</label>
                                	<input name="psec" id="psec" type="number" placeholder="Security Fee" class="w3-input w3-border w3-round">                                    
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>Membership Fee</label>
                                	<input name="pfee" id="pfee" type="number" placeholder="Membership Fee" class="w3-input w3-border w3-round">                                    
                                </div>
                                
                                <div class="w3-col m6 l8 w3-margin-top">
                                	<label>Remarks</label>
                                	<input name="premarks" id="premarks" type="text" placeholder="Remarks" class="w3-input w3-border w3-round">                                    
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>Status</label>
                                	<select id="pstat" class="w3-select w3-border w3-round" name="pstat">
                                        <option value="" disabled selected>Choose your option</option>
                                        <option value="1">Active</option>
                                        <option value="0">Blocked</option>
                                    </select>
                                </div>  
                                   
                                <div class="w3-col m12 w3-margin-top w3-right-align">
									<button onclick="check_values()" name="CreatePlan" id="CreatePlan" class="w3-button w3-round-small w3-right w3-blue display-none">CreatePlan</button>
                                	<a class="w3-button w3-round w3-blue" onclick="check_values()">Create Plan</a>
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
