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
	$("#UpdatePassword").click();
}
function check_values() {
	var opass=$("#password").val();
	var npass=$("#new-password").val();
	var cpass=$("#confirm-password").val();
	
	var error_message="";
	
	if(isSize(opass,4,4)==1)
		error_message+="<li>Old password must have 4 characters.</li>";
	if(isSize(npass,4,4)==1)
		error_message+="<li>New password must have 4 characters.</li>";
	if(isSize(cpass,4,4)==1)
		error_message+="<li>Confirm password must have 4 characters.</li>";
	//if(npass!="" &&pass_comb(npass)==false)
		//error_message+="<li>New password must have at least 1 alphabet, 1 number & 1 special character.</li>";
	if(opass!="" && opass==npass)
		error_message+="<li>Old password & New password should not be same.</li>";
	if(npass!="" && npass!=cpass)
		error_message+="<li>New password & Confirm password are not matched.</li>";
	
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
		$("#error-message").html("Do you want to update?");
		$("#ButtonFirst").hide();
		$("#ButtonSecond").show();
		$("#ViewServlet").show();
		$("#error-box").show();
		return true;
	}
}
</script>  
<script>
function myFunction() {
    var x = document.getElementById("password");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
function myFunction2() {
    var x = document.getElementById("new-password");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
function myFunction3() {
    var x = document.getElementById("confirm-password");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
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
                        	<h3>CHANGE PASSWORD</h3>
                        </div>
						<?php
						if(isset($_POST['UpdatePassword']))
						{
							include_once('zc-session-admin.php');
							include_once('zf-User.php');
							$opass=mysql_real_escape_string($_POST['opass']);
							$npass=mysql_real_escape_string($_POST['npass']);
							$cpass=mysql_real_escape_string($_POST['cpass']);
							$result=update_password($logged_user_id,$opass,$npass,$cpass);
							echo "<script>window.location.href='MyChangePasswordServlet?msg=$result';</script>";
						}
						$msg="-1";
						if(isset($_REQUEST['msg']))
							$msg=$_REQUEST['msg'];
						if($msg>0)
							$msg="<b class='w3-text-green'>New Password updated</b>";
						else if($msg==0)
							$msg="<b class='w3-text-red'>Old Password not matched</b>";
						else
							$msg="";
						?>
                        <form class="wh w3-left" method="post">
                        	<div class="w3-row-padding w3-margin-bottom"> 
                            	<div class="w3-col m6 l12 w3-margin-top">
                                	<span><?php echo $msg;?></label>	                                
                                </div>
								
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>User ID</label>	
                                	<input type="text" value="<?php echo $logged_user_id;?>" placeholder="User ID" disabled class="w3-input w3-border w3-round">                                    
                                </div>
                            	                      	
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>User Name</label>
                                	<input type="text" value="<?php echo $logged_user_name;?>" placeholder="User Name" disabled class="w3-input w3-border w3-round">                                    
                                </div>
                                
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>User Type</label>	
                                	<input type="text" value="<?php echo $logged_user_typename;?>" placeholder="User Type" disabled class="w3-input w3-border w3-round">                                    
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top" style="position:relative">
                                	<label>Old Password</label>
                                	<input type="password" name="opass" id="password" placeholder="Old Password" class="w3-input w3-border w3-round">
                                    <img src="img/eye.png" class="eye" onclick="myFunction()">
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top" style="position:relative">
                                	<label>New Password</label>
                                	<input type="password" name="npass" id="new-password" placeholder="New Password" class="w3-input w3-border w3-round">
                                    <img src="img/eye.png" class="eye" onclick="myFunction2()">
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top" style="position:relative">
                                	<label>Confirm Password</label>
                                	<input type="password" name="cpass" id="confirm-password" placeholder="Confirm Password" class="w3-input w3-border w3-round">
                                    <img src="img/eye.png" class="eye" onclick="myFunction3()">
                                </div>
                                   
                                <div class="w3-col m12 w3-margin-top w3-right-align">
									<button onclick="check_values()" name="UpdatePassword" id="UpdatePassword" class="w3-button w3-round-small w3-right w3-blue display-none">UPDATE</button>
                                	<a class="w3-button w3-round w3-blue" onclick="check_values()">Update Password</a>
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
      	<p id="error-message">Do you want to update?</p>
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
