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
function update_pass()
{
	click++;
	if(click==1)
	$("#CreateRetailer").click();
}
function check_values() {
	var uname=$("#uname").val();
	var umob=$("#umob").val();
	var states=$("#states").val();
	var districts=$("#districts").val();
	var ucity=$("#ucity").val();
	var utype=$("#utype").val();
	var usoftware=$("#usoftware").val();
	//var usecurity=$("#usecurity").val();
	
	var error_message="";
	
	if(isEmpty(uname)==1)
		error_message+="<li>User name should not be blank.</li>";
	if(isEmpty(umob)==1)
		error_message+="<li>Mobile Number should not be blank.</li>";
	if(isNumeric(umob)==1)
		error_message+="<li>Mobile Number should have number only.</li>";
	if(isSize(umob,10,10)==1)
		error_message+="<li>Mobile Number must have 10 digits.</li>";
	if($("#gen1").prop('checked')==false && $("#gen2").prop('checked')==false && 
		$("#gen3").prop('checked')==false)
		error_message+="<li>Select Gender.</li>";
	if(isEmpty(states)==1)
		error_message+="<li>Select State.</li>";
	if(isEmpty(districts)==1)
		error_message+="<li>Select District.</li>";
	if(isEmpty(ucity)==1)
		error_message+="<li>City should not be blank.</li>";
	if(isEmpty(utype)==1)
		error_message+="<li>Select Member Designation.</li>";
	if(isEmpty(usoftware)==1)
		error_message+="<li>Select Activation Charges.</li>";/*
	if(isEmpty(usecurity)==1)
		error_message+="<li>Select Security Fee.</li>";*/
	
	
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
		$("#error-message").html("Do you want to create retailer?");
		$("#ButtonFirst").hide();
		$("#ButtonSecond").show();
		$("#ViewServlet").show();
		$("#error-box").show();
		return true;
	}
}
function show_dist()
{
	var states = $("#states").val();
	//make the AJAX request, dataType is set to json
	//meaning we are expecting JSON data in response from the server
	$.ajax({
		type: "POST",
		url: "../AjaxShowDistServlet",
		data: {'states': states},
		dataType: "json",
	 
		//if received a response from the server
		success: function( data, textStatus, jqXHR) {
			//our country code was correct so we have some information to display/
			$("#districts").html(data);
		}	 
	});
}
function show_level_fee()
{
	var utype = $("#utype").val();
	//make the AJAX request, dataType is set to json
	//meaning we are expecting JSON data in response from the server
	$.ajax({
		type: "POST",
		url: "../AjaxShowLevelFeeServlet",
		data: {'utype': utype},
		dataType: "json",
	 
		//if received a response from the server
		success: function( data, textStatus, jqXHR) {
			//our country code was correct so we have some information to display/
			var res=data.split("@");
			a=parseInt(res[0]);
			b=parseInt(res[1]);
			c=parseInt(res[2]);
			d=parseInt(res[3]);
			//alert(res[0]+" "+res[1]+" "+res[2]+" "+res[3]);
			var res1="<option value='' selected>Select Security Fee</option>";
			for(i=a;i<=b;)
			{
				res1=res1+"<option>"+i+"</option>";
				if(i<5000)
				i=i+1000;
				else if(i<25000)
				i=i+5000;
				else if(i<100000)
				i=i+25000;
				else
				i=i+50000;
			}
			var res2="<option value='' selected>Select Activation Charges</option>";
			for(j=c;j<=d;)
			{
				res2=res2+"<option>"+j+"</option>";
				if(j<500)
				j=j+100;
				else
				j=j+500;
			}
			//$("#usecurity").html(res1);
			$("#usoftware").html(res2);
		}	 
	});
}
</script>

</head>
<body onload="show_level_fee()">

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
                        	<h3>ADD NEW RETAILER</h3>
                        </div>
						<?php
						if($logged_user_id==200309)
						{
							echo "<script>window.location.href='TeamsRetailersServlet';</script>";
						}
						if(isset($_POST['CreateRetailer']))
						{
							include_once('../zc-session-admin.php');
							include_once('../zf-Retailer.php');
							$uname=mysql_real_escape_string($_POST['uname']);
							$uadhar=0;
							$uemail=0;
							$umob=mysql_real_escape_string($_POST['umob']);
							$upass=mysql_real_escape_string("blyss@12");
							$ucity=mysql_real_escape_string($_POST['ucity']);
							$uadd=$ucity;
							$udist=mysql_real_escape_string($_POST['districts']);
							$ustate=mysql_real_escape_string($_POST['states']);
							$upincode=0;
							$ugender=mysql_real_escape_string($_POST['ugender']);
							$utype=mysql_real_escape_string($_POST['utype']);
							$usoftware=mysql_real_escape_string($_POST['usoftware']);
							$usecurity=0;
							$last_id=create_retailer($uname, $uadhar, $uemail, $umob, $upass, $uadd, $ucity, $udist, $ustate, $upincode, $ugender, $utype, $usoftware, $usecurity, 0, $logged_user_id, $logged_user_name, $logged_user_typename, $logged_user_type);
							if($last_id>0)
							{
								include_once('../zf-sms.php');
								$msg=create_registration_msg($last_id,$last_id,$last_id);
								zsms($umob,$msg);
							}
							echo "<script>window.location.href='SetUserMarginServlet?uid=$last_id';</script>";
							
						}
						?>
                        <form class="wh w3-left" method="post">
                        	<div class="w3-row-padding w3-margin-bottom"> 
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>Name</label>	
                                	<input name="uname" id="uname" type="text" placeholder="Name" class="w3-input w3-border w3-round">                                    
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>Mobile Number</label>
                                	<input name="umob" id="umob" type="text" placeholder="Mobile" class="w3-input w3-border w3-round">                                    
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
									   <input type="hidden" value="12" id="utype" name="utype" />
                                        <label>Trans Gender</label>
                                    </div>
                                </div> 
								
								<div style="clear:both;"></div>  
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>State</label>
                                	<select class="w3-select w3-border w3-round" id="states" name="states" onchange="show_dist()">
									<option value=''>Select state</option>
									<?php
									include_once('../zf-State.php');
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
                                	<label>Activation Charges</label>
                                	<select name="usoftware" id="usoftware" class="w3-select w3-border w3-round" name="option">
                                        <option value="" selected>Select Activation Charges</option>
                                    </select>
                                </div>
                                   
                                <div class="w3-col m12 w3-margin-top w3-right-align">
									<button onclick="check_values()" name="CreateRetailer" id="CreateRetailer" class="w3-button w3-round-small w3-right w3-blue display-none">CreateRetailer</button>
                                	<a class="w3-button w3-round w3-blue" onclick="check_values()">Create Retailer</a>
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
      	<p id="error-message">Do you want to create retailer?</p>
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
