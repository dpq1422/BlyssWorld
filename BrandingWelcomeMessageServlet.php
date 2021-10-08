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
<script src="js/ckeditor/ckeditor.js"></script> 
<script>
var click=0;
function save_wm()
{
	click++;
	if(click==1)
	$("#SaveWelcomeMessage").click();
}
function check_values() {
	var msg_title=$("#msg_title").val();
	//var msg_note=$("#msg_note").val();
	
	var error_message="";
	
	if(isEmpty(msg_title)==1)
		error_message+="<li>Message Title should not be blank.</li>";
	if(isSize(msg_title,10,50)==1)
		error_message+="<li>Message Title must have 10 to 50 characters.</li>";
	/*
	if(isEmpty(msg_note)==1)
		error_message+="<li>Welcome Message should not be blank.</li>";
	if(isSize(msg_note,20,500)==1)
		error_message+="<li>Welcome Message must have 20 to 500 characters.</li>";*/
	
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
		$("#error-message").html("Do you want to create welcome message?");
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
                        	<h3>Add New Welcome Message for Branding <!--(USER TYPE WISE)--></h3>
                        </div>
						<?php
						if(isset($_POST['SaveWelcomeMessage']))
						{
							include_once('zc-session-admin.php');
							include_once('zf-Branding-Welcome.php');
							$msg_title=mysql_real_escape_string($_POST['msg_title']);
							$msg_note=mysql_real_escape_string($_POST['ckeditor']);
							create_welcome_msg($msg_title, $msg_note);
							echo "<script>window.location.href='BrandingWelcomeMessagesServlet';</script>";
						}
						?>
                        <form class="wh w3-left" method="post">
                        	<div class="w3-row-padding w3-margin-bottom">
                            
                            	<!--<div class="w3-col m6 l4 w3-margin-top">
                                	<label>User Type</label>
                                	<select class="w3-select w3-border w3-round" name="option">
                                        <option value="" disabled selected>Choose your option</option>
                                        <option value="1">Admin</option>
                                        <option value="2">User</option>
                                    </select>
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>From Date</label>
                                	<input type="date" placeholder="From Date" class="w3-input w3-border w3-round">                                    
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>To Date</label>
                                	<input type="date" placeholder="To Date" class="w3-input w3-border w3-round">                                    
                                </div>-->
								
								<div class="w3-col m6 l4 w3-margin-top">
                                	<label>Message Title</label>
                                	<input type="text" name="msg_title" id="msg_title" placeholder="Message Title" class="w3-input w3-border w3-round">                                    
                                </div>
                                
                                <div class="w3-col m6 l12 w3-margin-top">
                                	<label>Welcome Message (Whatever Welcome note you want to show after login, you can add here)</label>
                                	<textarea id="msg_note" name="ckeditor"></textarea>                                  
                                </div>
								
								<div class="w3-col m12 w3-margin-top w3-right-align">
									<button onclick="check_values()" name="SaveWelcomeMessage" id="SaveWelcomeMessage" class="w3-button w3-round-small w3-right w3-blue display-none">Save Welcome Message</button>
                                	<a class="w3-button w3-round w3-blue" onclick="check_values()">SAVE</a>
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
      	<p id="error-message">Do you want to create welcome message?</p>
      </div>  
        <div class="w3-container" style="margin-bottom:10px;">
            <div class="w3-bar w3-center">
                <a id="ViewServlet" onclick="save_wm()" class="w3-button w3-green w3-round">Accept &amp; Confirm</a>
                <a id="ButtonFirst" onclick="document.getElementById('error-box').style.display='none';" class="w3-button w3-blue w3-round">OK</a>
                <a id="ButtonSecond" onclick="document.getElementById('error-box').style.display='none';" class="w3-button w3-orange w3-round">Do it later</a>
            </div> 
        </div> 
    </div>
  </div>
       
    <?php include_once('_footer.php');?>
	
<script>
	CKEDITOR.replace('ckeditor');
</script>

<!--date picker-->
<!--<script type="text/javascript">
    $( "#datepicker" ).datepicker();
	$( "#timepicker" ).timepicker();
</script>-->
<!--date picker-->
</body>
</html> 
