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
function generate_ticket()
{
	click++;
	if(click==1)
	$("#GenerateTicket").click();
}
function check_values() {
	var subject=$("#subject").val();
	var remarks=$("#remarks").val();
	
	var error_message="";
	
	if(isEmpty(subject)==1)
		error_message+="<li>Select Subject of Ticket.</li>";
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
		$("#error-message").html("Do you want to send ticket?");
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
                        	<h3>GENERATE NEW TICKET</h3>
                        </div>
						<?php
						if(isset($_POST['GenerateTicket']))
						{
							include_once('../zc-session-admin.php');
							include_once('../zf-TicketReceived.php');
							$subject=mysql_real_escape_string($_POST['subject']);
							$remarks=mysql_real_escape_string($_POST['remarks']);
							generate_ticket($subject,$remarks,$logged_user_id);
							echo "<script>window.location.href='TicketsSentServlet';</script>";
						}
						?>
                        <form class="wh w3-left" method="post">
                        	<div class="w3-row-padding w3-margin-bottom"> 
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>SUBJECT</label>
                                	<select id="subject" class="w3-select w3-border w3-round" name="subject">
                                        <option value="" required disabled selected>Choose your option</option>
                                        <option value="1">Money Transfer Dispute</option>
                                        <option value="2">Technical Support</option>
                                        <option value="3">Sales Enquiry</option>
                                        <option value="4">Billing Enquiry</option>
                                        <option value="5">Commission Issue</option>
                                    </select>
                                </div>
                                
                                <div class="w3-col m6 l8 w3-margin-top">
                                	<label>REMARKS</label>
                                	<input id="remarks" name="remarks" type="text" placeholder="REMARKS" class="w3-input w3-border w3-round">                                    
                                </div>
                                   
                                <div class="w3-col m12 w3-margin-top w3-right-align">
                                	<a class="w3-button w3-round w3-blue" onclick="check_values()">Generate Ticket</a>
									<button onclick="check_values()" name="GenerateTicket" id="GenerateTicket" class="w3-button w3-round-small w3-right w3-blue display-none">Send Ticket to Admin</button>
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
      	<p id="error-message">Do you want to send ticket?</p>
      </div>  
        <div class="w3-container" style="margin-bottom:10px;">
            <div class="w3-bar w3-center">
                <a id="ViewServlet" onclick="generate_ticket()" class="w3-button w3-green w3-round">Accept &amp; Confirm</a>
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
