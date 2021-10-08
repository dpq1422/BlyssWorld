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
	$("#CreateUser").click();
}
function check_values() {
	var utype=$("#utype").val();
	var uname=$("#uname").val();
	var uemail=$("#uemail").val();
	var umob=$("#umob").val();
	var password=$("#password").val();
	var cpassword=$("#confirm-password").val();
	var uadd=$("#uadd").val();
	var states=$("#states").val();
	var districts=$("#districts").val();
	var ucity=$("#ucity").val();
	var upincode=$("#upincode").val();
	var uremark=$("#uremark").val();
	var ustatus=$("#ustatus").val();
	
	var error_message="";
	
	if(isEmpty(utype)==1)
		error_message+="<li>Select User Type.</li>";
	if(isEmpty(uname)==1)
		error_message+="<li>User name should not be blank.</li>";
	if(isEmpty(uemail)==1)
		error_message+="<li>Email should not be blank.</li>";
	if(isEmail(uemail)==1)
		error_message+="<li>Email format is not correct.</li>";
	if(isEmpty(umob)==1)
		error_message+="<li>Mobile Number should not be blank.</li>";
	if(isNumeric(umob)==1)
		error_message+="<li>Mobile Number should have number only.</li>";
	if(isSize(umob,10,10)==1)
		error_message+="<li>Mobile Number must have 10 digits.</li>";
	if(isSize(password,8,8)==1)
		error_message+="<li>New password must have 8 characters.</li>";
	if(isSize(cpassword,8,8)==1)
		error_message+="<li>Confirm password must have 8 characters.</li>";
	if(password!="" && pass_comb(password)==false)
		error_message+="<li>New password must have at least 1 alphabet, 1 number & 1 special character.</li>";
	if(password!="" && password!=cpassword)
		error_message+="<li>New password & Confirm password are not matched.</li>";
	if(isEmpty(uadd)==1)
		error_message+="<li>Address should not be blank.</li>";
	if(isEmpty(states)==1)
		error_message+="<li>Select State.</li>";
	if(isEmpty(districts)==1)
		error_message+="<li>Select District.</li>";
	if(isEmpty(ucity)==1)
		error_message+="<li>City should not be blank.</li>";
	if(isEmpty(upincode)==1)
		error_message+="<li>Area Pincode should not be blank.</li>";
	if(isNumeric(upincode)==1)
		error_message+="<li>Area Pincode should have number only.</li>";
	if(isSize(upincode,6,6)==1)
		error_message+="<li>Area Pincode must have 6 digits.</li>";
	if(isEmpty(uremark)==1)
		error_message+="<li>Remarks should not be blank.</li>";
	if(isEmpty(ustatus)==1)
		error_message+="<li>Select Status.</li>";
	if($("#udeps1").prop('checked')==false && $("#udeps2").prop('checked')==false && 
		$("#udeps3").prop('checked')==false && $("#udeps4").prop('checked')==false && 
		$("#udeps5").prop('checked')==false && $("#udeps6").prop('checked')==false && 
		$("#udeps7").prop('checked')==false && $("#udeps8").prop('checked')==false)
		error_message+="<li>Select Department.</li>";
	if($("#gen1").prop('checked')==false && $("#gen2").prop('checked')==false && 
		$("#gen3").prop('checked')==false)
		error_message+="<li>Select Gender.</li>";
	
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
    var x = document.getElementById("confirm-password");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
function showUserRole()
{
	var utype = document.getElementById("utype").value;
	$('#udeps1').prop('disabled',true);
	$('#udeps1').prop('checked',false);
	if(utype==1)
	{
		$('#udeps1').prop('disabled',false);
	}
}
function show_dist()
{
	var states = $("#states").val();
	//make the AJAX request, dataType is set to json
	//meaning we are expecting JSON data in response from the server
	$.ajax({
		type: "POST",
		url: "AjaxShowDistServlet",
		data: {'states': states},
		dataType: "json",
	 
		//if received a response from the server
		success: function( data, textStatus, jqXHR) {
			//our country code was correct so we have some information to display/
			$("#districts").html(data);
		}	 
	});
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
                        	<h3>ADD NEW USER</h3>
                        </div>
						<?php
						if(isset($_POST['CreateUser']))
						{
							include_once('zc-session-admin.php');
							include_once('zf-User.php');
							$utype=mysql_real_escape_string($_POST['utype']);
							$uname=mysql_real_escape_string($_POST['uname']);
							$uemail=mysql_real_escape_string($_POST['uemail']);
							$umob=mysql_real_escape_string($_POST['umob']);
							$upass=mysql_real_escape_string($_POST['upass']);
							$uadd=mysql_real_escape_string($_POST['uadd']);
							$ucity=mysql_real_escape_string($_POST['ucity']);
							$udist=mysql_real_escape_string($_POST['districts']);
							$ustate=mysql_real_escape_string($_POST['states']);
							$upincode=mysql_real_escape_string($_POST['upincode']);
							$udeps=mysql_real_escape_string(implode(",",$_POST['udeps']));
							$ugender=mysql_real_escape_string($_POST['ugender']);
							$ustatus=mysql_real_escape_string($_POST['ustatus']);
							$uremark=mysql_real_escape_string($_POST['uremark']);
							create_user($utype, $uname, $uemail, $umob, $upass, $uadd, $ucity, $udist, $ustate, $upincode, $udeps, $ugender, $ustatus, $uremark, 0);
							echo "<script>window.location.href='UsersServlet';</script>";
							
						}
						?>
                        <form class="wh w3-left" method="post">
                        	<div class="w3-row-padding w3-margin-bottom">  
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>User Type</label>
                                	<select name="utype" onchange="showUserRole()" id="utype" class="w3-select w3-border w3-round" name="utype">
                                        <option value="" disabled selected>Choose your option</option>
                                        <option value="1">Admin</option>
                                        <option value="-1">User</option>
                                    </select>
                                </div>
                            	                      	
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>Name</label>	
                                	<input name="uname" id="uname" type="text" placeholder="Name" class="w3-input w3-border w3-round">                                    
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>Email</label>
                                	<input name="uemail" id="uemail" type="text" placeholder="Email" class="w3-input w3-border w3-round">                                    
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>Mobile Number</label>
                                	<input name="umob" id="umob" type="text" placeholder="Mobile" class="w3-input w3-border w3-round">                                    
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top" style="position:relative">
                                	<label>Password <b>(must have at least 1 alphabet, 1 num, 1 special character)</b></label>
                                	<input name="upass" type="password" id="password" placeholder="Password" class="w3-input w3-border w3-round">
                                    <img src="img/eye.png" class="eye" onclick="myFunction()">
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top" style="position:relative">
                                	<label>Confirm Password</label>
                                	<input type="password" id="confirm-password" placeholder="Confirm Password" class="w3-input w3-border w3-round">
                                    <img src="img/eye.png" class="eye" onclick="myFunction2()">
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>Address</label>
                                	<input name="uadd" id="uadd" type="text" placeholder="Address" class="w3-input w3-border w3-round">                                    
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>State</label>
                                	<select class="w3-select w3-border w3-round" id="states" name="states" onchange="show_dist()">
									<option value=''>Select state</option>
									<?php
									include_once('zf-State.php');
									$state_result=show_all_states();
									while($state_row=mysql_fetch_array($state_result))
									{
										echo "<option value='".$state_row['state_id']."'>".$state_row['state_name']."</option>";
									}
									?>
                                    </select>
                                </div>
                                
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>District</label>
                                	<select class="w3-select w3-border w3-round" id="districts" name="districts">
										<option value=''>Select district</option>
                                    </select>
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>City</label>
                                	<input name="ucity" id="ucity" type="text" placeholder="City" class="w3-input w3-border w3-round">                                    
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>Area Pincode</label>	
                                	<span>(must have 6 digits nums)</span>
                                	<input name="upincode" id="upincode" type="text" placeholder="Area Pincode" class="w3-input w3-border w3-round">
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>Remarks</label>
                                	<input name="uremark" id="uremark" type="text" placeholder="Remarks" class="w3-input w3-border w3-round">                                    
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top gender-w">
                                	<label>Department</label>
                                    <div>
                                        <input value="1" name="udeps[]" id="udeps1" disabled class="w3-check" type="checkbox">
                                        <label>Master</label>
                                    </div>
                                    <div>
                                        <input value="2" name="udeps[]" id="udeps2" class="w3-check" type="checkbox">
                                        <label>Team</label>
                                    </div>
                                    <div>
                                    	<input value="3" name="udeps[]" id="udeps3" checked class="w3-check" type="checkbox">
                                    	<label>Wallet</label>
                                    </div>
                                    <div>
                                        <input value="4" name="udeps[]" id="udeps4" checked class="w3-check" type="checkbox">
                                        <label>Transactions</label>
                                    </div>
                                    <div>
                                        <input value="5" name="udeps[]" id="udeps5" checked class="w3-check" type="checkbox">
                                        <label>Support</label>
                                    </div>
                                    <div>
                                        <input value="6" name="udeps[]" id="udeps6" class="w3-check" type="checkbox">
                                        <label>Commission</label>
                                    </div>
                                    <div>
                                        <input value="7" name="udeps[]" id="udeps7" class="w3-check" type="checkbox">
                                        <label>Audit</label>
                                    </div>
                                    <div>
                                        <input value="8" name="udeps[]" id="udeps8" class="w3-check" type="checkbox">
                                        <label>Report</label>
                                    </div>
                                </div> 
                                
                                <div class="w3-col m6 l4 w3-margin-top gender-w">
                                	<label>Gender</label>
                                    <div>
                                        <input class="w3-radio" id="gen1" type="radio" name="ugender" value="1">
                                        <label>Male</label>
                                    </div>
                                    <div>
                                    	<input class="w3-radio" id="gen2" type="radio" name="ugender" value="0">
                                    	<label>Female</label>
                                    </div>
                                    <div>
                                       <input class="w3-radio" id="gen3" type="radio" name="ugender" value="-1">
                                        <label>Trans Gender</label>
                                    </div>
                                </div> 
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>Status</label>
                                	<select id="ustatus" class="w3-select w3-border w3-round" name="ustatus">
                                        <option value="" disabled selected>Choose your option</option>
                                        <option value="1">Active</option>
                                        <option value="2">Blocked</option>
                                    </select>
                                </div>  
                                   
                                <div class="w3-col m12 w3-margin-top w3-right-align">
									<button onclick="check_values()" name="CreateUser" id="CreateUser" class="w3-button w3-round-small w3-right w3-blue display-none">CreateUser</button>
                                	<a class="w3-button w3-round w3-blue" onclick="check_values()">Create User</a>
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
