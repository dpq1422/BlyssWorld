<!DOCTYPE html>
<html>
<head>
<title>Register :: BlyssPay.com</title>
<?php 
ini_set('expose_php',0);
header("X-Powered-By: CentOS"); 
header("X-Powered-By: Ubuntu"); 
header("X-Powered-By: Servlet"); 
//header("X-Powered-By: Tomcat"); 
//header("X-Powered-By: Coyote"); 
ob_start();
?>
<script type="text/javascript" src="js/admin-validation-functions.js"></script>
<script>if(window.Polymer==window.Polymer){}</script>
<script src="js/angular.min.js"></script>
<script src="js/node.js"></script>
<script src="js/backbone.js"></script>
<meta name="gwt:property" content="panel="/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
<link rel="stylesheet" href="css/w3.css" type="text/css">
<link rel="stylesheet" href="css/style.css" type="text/css">
<script src="js/jquery-1.7.2.min.js" type="text/javascript"></script>
<link href="css/tinyslide.css" rel="stylesheet" />	
<script src="js/tinyslide.js" /></script>
<style>
 p#err{color:#dd5d5d;text-align:center;font-weight:bold;}
</style>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-126322670-11"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-126322670-11');
</script>
<script type="text/javascript">
window.oncontextmenu = function () { return false; }
function killCopy(e) { return false; }
function reEnable() { return true; }
document.onselectstart=new Function ("return false");
if (window.sidebar) { document.onmousedown=killCopy; document.onclick=reEnable; }
</script>
<script>
function close_error_box()
{
	document.getElementById('error-box').style.display='none';
	document.getElementById('filled_mobile_no').focus();
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
function init()
{
	navigator.sayswho= (function(){
		var N= navigator.appName, ua= navigator.userAgent, tem;
		var M= ua.match(/(opera|chrome|safari|firefox|msie)\/?\s*(\.?\d+(\.\d+)*)/i);
		if(M && (tem= ua.match(/version\/([\.\d]+)/i))!= null) M[2]= tem[1];
		M= M? [M[1], M[2]]: [N, navigator.appVersion, '-?'];

		return M;
	})();
	var returnValue=navigator.sayswho;
	var val=returnValue.indexOf("Chrome");
	if(val!==-1)
	{
		var abc="@"+returnValue;
		var abcd=abc.split("@Chrome,");
	}
	if(val==-1)
	{
		alert("Please use Google Chrome for this portal...");
		document.location.href='https://www.google.com/chrome';
	}
	else if(abcd[1]<60)
	{
		alert("Please use Updated Version of Google Chrome for this portal...");
		document.location.href='https://www.google.com/chrome';
	}
}
function check_user()
{
	var filled_referral_id = $("#rid").val();
	if(filled_referral_id.length==6)
	{
		//make the AJAX request, dataType is set to json
		//meaning we are expecting JSON data in response from the server
		$.ajax({
			type: "POST",
			url: "AjaxCheckReferralServlet",
			data: {'filled_referral_id': filled_referral_id},
			dataType: "json",
		 
			//if received a response from the server
			success: function( data, textStatus, jqXHR) {
				//our country code was correct so we have some information to display/
				if(data==0)
				{
					$("#error-title").html("Invalid Referral ID?");
					$("#error-message").html("<br>Mentioned Referral ID does not exists.<br>Register as a Free SignUp you must have a valid Referral ID.<br>Or contact our support team at 9896677625.");
					$("#error-box").show();
					$("#rid").val('');
				}
				else
				{
					$("#ridname").val(data);
				}
			}	 
		});
	}
}
function check_mob()
{
	var filled_mobile_no = $("#rmob").val();
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
					$("#error-message").html("<br>This mobile number is already registered with us.<br>You can not register one mobile number with multiple accounts.<br><br>If you forgot your password?<br>kindly go to <b>Login Page</b> and click on <b>Forgot Password</b>");
					$("#error-box").show();
					$("#rmob").val('');
				}
			}	 
		});
	}
}
function check_values() {
	var rid=$("#rid").val();
	var rname=$("#rname").val();
	var rmob=$("#rmob").val();
	//var password=$("#rpass").val();
	//var cpassword=$("#rcpass").val();
	var states=$("#states").val();
	var districts=$("#districts").val();
	var captcha=$("#captcha_code").val();
	
	var error_message="";
	
	if(isEmpty(rid)==1)
		error_message+="<li>Invalid Referral ID.</li>";
	else if(isNumeric(rid)==1)
		error_message+="<li>Invalid Referral ID.</li>";
	else if(isSize(rid,6,6)==1)
		error_message+="<li>Invalid Referral ID.</li>";
	if(isEmpty(rname)==1)
		error_message+="<li>Full Name should not be blank.</li>";
	if(isEmpty(rmob)==1)
		error_message+="<li>Mobile Number should not be blank.</li>";
	if(isNumeric(rmob)==1)
		error_message+="<li>Mobile Number should have number only.</li>";
	if(isSize(rmob,10,10)==1)
		error_message+="<li>Mobile Number must have 10 digits.</li>";
	/*
	if(isSize(password,8,8)==1)
		error_message+="<li>Password must have 8 characters.</li>";
	if(isSize(cpassword,8,8)==1)
		error_message+="<li>Confirm password must have 8 characters.</li>";
	if(password!="" && pass_comb(password)==false)
		error_message+="<li>Password must have at least 1 alphabet, 1 number & 1 special character.</li>";
	if(password!="" && password!=cpassword)
		error_message+="<li>Password & Confirm password are not matched.</li>";
	*/
	if(isEmpty(states)==1)
		error_message+="<li>Select State.</li>";
	if(isEmpty(districts)==1)
		error_message+="<li>Select District.</li>";
	if(isEmpty(captcha)==1)
		error_message+="<li>Captcha should not be blank.</li>";
	if(isNumeric(captcha)==1)
		error_message+="<li>Captcha should have number only.</li>";
	if(isSize(captcha,4,4)==1)
		error_message+="<li>Captcha must have 4 digits.</li>";
	
	if(error_message!="")
	{
		error_message="<br><ul class='error-message'>"+error_message+"</ul>";
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
		update_pass();
	}
}
var click=0;
function update_pass()
{
	click++;
	if(click==1)
	$("#RegisterUser").click();
}
function xyz()
{
	document.getElementById("refsimgs").src = "img/refresh.gif";
	setTimeout(xyz2,500);
}
function xyz2()
{
	document.getElementById("captchaimg").src = "__captcha";
	document.getElementById("refsimgs").src = "img/refresh.png";
	$("#captcha_code").focus();
}
function myFocus()
{
	init();
	document.getElementById("rid").focus();
}
</script>
</head>
<body onload="myFocus()">
	<div class="w3-container">
    	<div class="my-center">
        	<div class="login_main_locker">
            	<div class="login">
                	<div class="login_header w3-center"><img src="img/loing-center/logo.png" class="w3-image"></div>
                    <div class="login-form">
					<?php
					echo "<script>window.location.href='LoginServlet';</script>";
					$err=0;
					$last_id=0;
					if(!isset($_SESSION))
					{
						session_start();
					}
					if(isset($_POST['RegisterUser']))
					{
						// code for check server side validation
						$err=0;
						if(empty($_SESSION['captcha_code'] ) || strcasecmp($_SESSION['captcha_code'], $_POST['captcha_code']) != 0)
						{ 
							$err=1;// Captcha verification is incorrect.
						}
						else
						{
							include_once('zc-gyan-info-admin.php');
							include_once('zf-Retailer.php');
							$refid=mysql_real_escape_string($_POST['rid']);
							$uname=mysql_real_escape_string($_POST['rname']);
							$umob=mysql_real_escape_string($_POST['rmob']);
							$upass="blyss@12";
							$ustate=mysql_real_escape_string($_POST['states']);
							$udist=mysql_real_escape_string($_POST['districts']);
							$last_id=register_retailer($uname, $umob, $upass, $ustate, $udist, $refid);
						}
						if($err==1)
						{
							echo "<p id='err'>Invalid Captcha Code</p>";
						}
					}
					$ret_id="";
					$ret_name="";
					if(isset($_REQUEST['join']))
						$ret_id=$_REQUEST['join'];
					if($ret_id!="")
					{
						include_once('zf-Retailer.php');
						$ret_name=show_retailer_name($ret_id);
						$ret_name=explode(" ",$ret_name)[0];
						if($ret_name=="")
							$ret_id="";
					}
					if($last_id!=0)
					{
						$unames=explode(" ",$uname)[0];
						echo "<h2 class='w3-text-blue w3-center'>Congrats $unames, You are registered now.<br>User ID : <b>$last_id</b><br>Password : <b>blyss@12</b><br>T-Pin : <b>1234</b></h2>";
                			include_once('zf-sms.php');
                			$zsms=sign_up_msg($last_id);
                			zsms($umob,$zsms);
						?>
                        <form class="wh w3-left" method="post">
							<div class="w3-row-padding w3-margin-bottom">     
								<div class="w3-col m12 l12 w3-margin-top">
                                	<a href="LoginServlet" class="w3-button w3-round w3-right w3-blue">Login</a>
								</div>     
							</div>
                        </form>
						<?php
					}
					else
					{
					?>
                        <form class="wh w3-left" method="post">
							<div class="w3-row-padding w3-margin-bottom">     
								<div class="w3-col m12 l6 w3-margin-top">
									<label>Referral ID</label>
									<input type="text" value="<?php echo $ret_id?>" onkeyup="check_user()" autocomplete="off" id="rid" name="rid" maxlength="6" class="w3-input w3-round w3-border"/>
								</div>      
								<div class="w3-col m12 l6 w3-margin-top">
									<label>Referral Name</label>
									<input type="text" readonly value="<?php echo $ret_name?>" autocomplete="off" id="ridname" name="ridname" class="w3-input w3-round w3-border"/>
								</div>        
								<div class="w3-col m12 l6 w3-margin-top">
									<label>Full Name</label>
									<input type="text" autocomplete="off" id="rname" name="rname" class="w3-input w3-round w3-border"/>
								</div>      
								<div class="w3-col m12 l6 w3-margin-top">
									<label>Mobile No.</label>
									<input type="text" maxlength="10" autocomplete="off" id="rmob" onkeyup="check_mob()" name="rmob" class="w3-input w3-round w3-border"/>
								</div>  
								<div class="w3-col m12 l6 w3-margin-top">
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
								<div class="w3-col m12 l6 w3-margin-top">
                                	<label>District</label>
                                	<select class="w3-select w3-border w3-round" id="districts" name="districts">
										<option value=''>Select district</option>
                                    </select>
								</div>     
								<div class="w3-col m12 l6 w3-margin-top">
                                	<img style="border-radius:4px;" class="w3-left" src="__captcha" id='captchaimg'>
									<img onclick='xyz()' height="25" autocomplete="off" title="Reload Image" id="refsimgs" class="reload-img" src="img/refresh.png">
								</div>           
								<div class="w3-col m12 l6 w3-margin-top">
									<input required autocomplete="off" maxlength="4" onkeyup="check_captcha()" class="w3-input w3-border w3-round" id='captcha_code' name="captcha_code" type="text">
								</div>        
								<div class="w3-col m12 l12 w3-margin-top">
									<button onclick="check_values()" name="RegisterUser" id="RegisterUser" class="w3-button w3-round-small w3-right w3-blue display-none">RegisterUser</button>
                                	<a class="w3-button w3-round w3-right w3-blue" onclick="check_values()">Register</a>
                                	<a href="LoginServlet" class="w3-left w3-text-red">Login</a>
								</div>     
							</div>
                        </form>
						<?php
					}
						?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="patts"></div> 

 
<div id="error-box" class="w3-modal my-modal-padd">
    <div class="w3-modal-content w3-animate-zoom my-modal">
          <header class="w3-container w3-center w3-blue"> 
		    <span onclick="close_error_box()" class="w3-button w3-display-topright">
				<img src="img/close.png" style="margin-bottom:0px;">
			</span>
            <h4 class="w3-center" id="error-title">ERROR TITLE !!!</h4>
          </header>
          <div class="w3-container w3-center modal-txt">
            <p id="error-message">ERROR MESSAGE</p>
          </div>  
          <footer class="w3-center w3-padding-16">
          	<button onclick="close_error_box()" class="w3-button w3-round-small w3-blue">OK</button>
          </footer>        
    </div>
</div>

<section id="tiny" class="tinyslide">
  <aside class="slides">
    <figure><img src="img/loing-center/bg.jpg" alt="background" /></figure>
  </aside>
</section>

<!--banner js-->
<script>
  var tiny = $('#tiny').tiny().data('api_tiny');
</script>

</body>
</html> 