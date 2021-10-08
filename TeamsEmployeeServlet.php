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
var click=0;
function update_pass()
{
	click++;
	if(click==1)
	$("#CreateEmployee").click();
}
function check_mob()
{
	var filled_mobile_no = $("#umob").val();
	$("#error-box").hide();
	$("#err").html('');
	if(filled_mobile_no.length==10)
	{
		//make the AJAX request, dataType is set to json
		//meaning we are expecting JSON data in response from the server
		$.ajax({
			type: "POST",
			url: "AjaxCheckMobileServlet",
			data: {'filled_mobile_no': filled_mobile_no},
			dataType: "json",
		 
			//if received a response from the server
			success: function( data, textStatus, jqXHR) {
				//our country code was correct so we have some information to display/
				if(data!=0)
				{
					$("#error-title").html("Already Registered?");
					$("#error-message").html("<br>This mobile number is already registered with us.<br>You can not register one mobile number with multiple accounts.");
					$("#ButtonFirst").hide();
					$("#ButtonSecond").hide();
					$("#ViewServlet").hide();
					$("#error-box").show();
					$("#umob").val('');
				}
			}	 
		});
	}
}
function check_eml()
{
	var filled_e_mail = $("#uemail").val();
	$("#error-box").hide();
	$("#err").html('');
	if(filled_e_mail.length!=0)
	{
		//make the AJAX request, dataType is set to json
		//meaning we are expecting JSON data in response from the server
		$.ajax({
			type: "POST",
			url: "AjaxCheckEmailServlet",
			data: {'filled_e_mail': filled_e_mail},
			dataType: "json",
		 
			//if received a response from the server
			success: function( data, textStatus, jqXHR) {
				//our country code was correct so we have some information to display/
				if(data!=0)
				{
					$("#error-title").html("Already Registered?");
					$("#error-message").html("<br>This e-mail is already registered with us.<br>You can not register one e-mail with multiple accounts.");
					$("#ButtonFirst").hide();
					$("#ButtonSecond").hide();
					$("#ViewServlet").hide();
					$("#error-box").show();
					$("#uemail").val('');
				}
			}	 
		});
	}
}
function check_values() {
	var utype=$("#utype").val();
	var uname=$("#uname").val();
	var uemail=$("#uemail").val();
	var umob=$("#umob").val();
	var uadd=$("#uadd").val();
	var states=$("#states").val();
	var districts=$("#districts").val();
	var ucity=$("#ucity").val();
	var upincode=$("#upincode").val();
	var utxn=$("#utxn").val();
	var ujoin=$("#ujoin").val();
	var usal=$("#usal").val();
	
	var error_message="";
	
	if(isEmpty(utype)==1)
		error_message+="<li>Select Employee Type.</li>";
	if(isEmpty(uname)==1)
		error_message+="<li>Employee name should not be blank.</li>";
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
	if(isEmpty(utxn)==1)
		error_message+="<li>Target in Txn should not be blank.</li>";
	if(isNumeric(utxn)==1)
		error_message+="<li>Target in Txn should have number only.</li>";
	if(isEmpty(ujoin)==1)
		error_message+="<li>Target in Join should not be blank.</li>";
	if(isNumeric(ujoin)==1)
		error_message+="<li>Target in Join should have number only.</li>";
	if(isEmpty(usal)==1)
		error_message+="<li>Salary should not be blank.</li>";
	if(isNumeric(usal)==1)
		error_message+="<li>Salary should have number only.</li>";
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
		$("#error-message").html("Do you want to create employee?");
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
                        	<h3>ADD NEW EMPLOYEE</h3>
                        </div>
						<?php
						echo "<script>window.location.href='TeamsEmployeesServlet';</script>";
						if(isset($_POST['CreateEmployee']))
						{
							include_once('zc-session-admin.php');
							include_once('zf-Employee.php');
							$utype=mysql_real_escape_string($_POST['utype']);
							$uname=mysql_real_escape_string($_POST['uname']);
							$uemail=mysql_real_escape_string($_POST['uemail']);
							$umob=mysql_real_escape_string($_POST['umob']);
							$upass=mysql_real_escape_string("blyss@12");
							$uadd=mysql_real_escape_string($_POST['uadd']);
							$ucity=mysql_real_escape_string($_POST['ucity']);
							$udist=mysql_real_escape_string($_POST['districts']);
							$ustate=mysql_real_escape_string($_POST['states']);
							$upincode=mysql_real_escape_string($_POST['upincode']);
							$ugender=mysql_real_escape_string($_POST['ugender']);
							$utxn=mysql_real_escape_string($_POST['utxn']);
							$ujoin=mysql_real_escape_string($_POST['ujoin']);
							$usal=mysql_real_escape_string($_POST['usal']);
							$uadhar="";
							$last_id=create_employee($utype, $uname, $uadhar, $uemail, $umob, $upass, $uadd, $ucity, $udist, $ustate, $upincode, $ugender, $utxn, $ujoin, $usal, $logged_user_id, $logged_user_name, $logged_user_typename, $logged_user_type);
							echo "<script>window.location.href='TeamsEmployeesServlet';</script>";							
						}
						?>
                        <form class="wh w3-left" method="post">
                        	<div class="w3-row-padding w3-margin-bottom">                                  
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>Employee Type</label>
                                	<select class="w3-select w3-border w3-round" id="utype" name="utype">
                                        <option value="" disabled selected>Choose your option</option>
                                        <option value="-2">Chief Sale Manager</option>
                                        <option value="-3">Sales Manager</option>
                                        <option value="-4">Asst. Sales Manager</option>
                                    </select>
                                </div>
								
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>Name</label>	
                                	<input name="uname" id="uname" type="text" placeholder="Name" class="w3-input w3-border w3-round">                                    
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>Email</label>
                                	<input name="uemail" id="uemail" onkeyup="check_eml()" type="text" placeholder="Email" class="w3-input w3-border w3-round">                                    
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>Mobile Number</label>
                                	<input name="umob" id="umob" onkeyup="check_mob()" maxlength="10" type="text" placeholder="Mobile" class="w3-input w3-border w3-round">                                    
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top" style="position:relative">
                                	<label>Password <b>(default)</b></label>
                                	<input type="text" value="blyss@12" readonly class="w3-input w3-border w3-round">
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top" style="position:relative">
                                	<label>T-PIN <b>(default)</b></label>
                                	<input type="text" value="1234" readonly class="w3-input w3-border w3-round">
                                </div>
                                
                                <div class="w3-col m6 l12 w3-margin-top">
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
								
								<div class="clear-both"></div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>Target in Txn (25 days x 100 Txn)</label>
                                	<input name="utxn" id="utxn" type="text" placeholder="Target in Txn" class="w3-input w3-border w3-round">                                    
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>Target in Join (25 days x 2 working retailer, at least 10 txn)</label>
                                	<input name="ujoin" id="ujoin" type="text" placeholder="Target in Join (working retailer at least 10 txn)" class="w3-input w3-border w3-round">                                    
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>Salary</label>
                                	<input name="usal" id="usal" type="text" placeholder="Salary" class="w3-input w3-border w3-round">                                    
                                </div>
                                   
                                <div class="w3-col m12 w3-margin-top w3-right-align">
									<button onclick="check_values()" name="CreateEmployee" id="CreateEmployee" class="w3-button w3-round-small w3-right w3-blue display-none">CreateEmployee</button>
                                	<a class="w3-button w3-round w3-blue" onclick="check_values()">Create Employee</a>
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
      	<p id="error-message">Do you want to create employee?</p>
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
