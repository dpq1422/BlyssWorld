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
<?php include_once('../zc-session-admin.php'); ?>
<script>
$(document).ready(function(){
	$(".search-icon").click(function(){
	$(".search-show").toggleClass("s-show");
	});
	
	$(".them").click(function(){
	$(".them ul").toggleClass("them-top");
	});
	$(".pbtns").hide();
	$("#amount").hide();
});
</script>
<script>
var click=0;
function recharge_mobile()
{
	click++;
	if(click==1)
	$("#RechargeMobile").click();
}
function abcd()
{
	var operator=$("#operator").val();
	var mobile=$("#mobile").val();
	
	var error_message="";
	
	if(isEmpty(operator)==1)//customerid//customerid//customerno//crn-no//bp-no//customerid//arn-no//consumerno
		error_message+="<li>Select Electricity Provider.</li>";
	if(operator=="6@144@APEPDCL Andhra Pradesh" && isEmpty(mobile)==1)
		error_message+="<li>Service Number should not be empty.</li>";
	if(operator=="6@145@APSPDCL Andhra Pradesh" && isEmpty(mobile)==1)
		error_message+="<li>Service Number should not be empty.</li>";
	if(operator=="6@72@SOUTHERN POWER Andhra Pradesh" && isEmpty(mobile)==1)
		error_message+="<li>Service Number should not be empty.</li>";
	if(operator=="6@53@APDCL Assam" && isEmpty(mobile)==1)
		error_message+="<li>Customer ID should not be empty.</li>";
	if(operator=="6@62@India Power Bihar" && isEmpty(mobile)==1)
		error_message+="<li>Consumer Number should not be empty.</li>";
	if(operator=="6@154@Muzaffarpur Vidyut Vitran" && isEmpty(mobile)==1)
		error_message+="<li>Consumer Number should not be empty.</li>";
	if(operator=="6@155@NBPDCL Bihar" && isEmpty(mobile)==1)
		error_message+="<li>CA Number should not be empty.</li>";
	if(operator=="6@158@SBPDCL Bihar" && isEmpty(mobile)==1)
		error_message+="<li>CA Number should not be empty.</li>";
	if(operator=="6@59@CSEB Chhattisgarh" && isEmpty(mobile)==1)
		error_message+="<li>BP Number should not be empty.</li>";
	if(operator=="6@148@CSPDCL Chhattisgarh" && isEmpty(mobile)==1)
		error_message+="<li>BP Number should not be empty.</li>";
	if(operator=="6@149@Daman and Diu Electricity" && isEmpty(mobile)==1)
		error_message+="<li>Account Number should not be empty.</li>";
	if(operator=="6@56@BSES Rajdhani Delhi" && isEmpty(mobile)==1)
		error_message+="<li>Customer Number should not be empty.</li>";
	if(operator=="6@57@BSES Yamuna Delhi" && isEmpty(mobile)==1)
		error_message+="<li>Customer Number should not be empty.</li>";
	if(operator=="6@74@Tata Power Delhi" && isEmpty(mobile)==1)
		error_message+="<li>Customer Number should not be empty.</li>";
	if(operator=="6@150@DGVCL Gujrat" && isEmpty(mobile)==1)
		error_message+="<li>Consumer Number should not be empty.</li>";
	if(operator=="6@153@MGVCL Gujrat" && isEmpty(mobile)==1)
		error_message+="<li>Consumer Number should not be empty.</li>";
	if(operator=="6@157@PGVCL Gujrat" && isEmpty(mobile)==1)
		error_message+="<li>Consumer Number should not be empty.</li>";
	if(operator=="6@163@UGVCL Gujrat" && isEmpty(mobile)==1)
		error_message+="<li>Consumer Number should not be empty.</li>";
	if(operator=="6@64@Jamshedpur Utilities & Services (JUSCO)" && isEmpty(mobile)==1)
		error_message+="<li>Business Partner Number should not be empty.</li>";
	if(operator=="6@54@BESCOM Bengaluru" && isEmpty(mobile)==1)
		error_message+="<li>Consumer Number should not be empty.</li>";
	if(operator=="6@177@GESCOM Karnataka" && isEmpty(mobile)==1)
		error_message+="<li>Consumer Number should not be empty.</li>";
	if(operator=="6@66@Madhya Kshetra Vitran Madhya Pradesh" && isEmpty(mobile)==1)
		error_message+="<li>Consumer Number should not be empty.</li>";
	if(operator=="6@70@Paschim Kshetra Vitran Madhya Pradesh" && isEmpty(mobile)==1)
		error_message+="<li>Consumer Number should not be empty.</li>";
	if(operator=="6@55@BEST Undertaking Mumbai" && isEmpty(mobile)==1)
		error_message+="<li>Consumer Number should not be empty.</li>";
	if(operator=="6@159@SNDL Power Nagpur" && isEmpty(mobile)==1)
		error_message+="<li>Consumer Number should not be empty.</li>";
	if(operator=="6@161@Tata Power Mumbai" && isEmpty(mobile)==1)
		error_message+="<li>Consumer Number should not be empty.</li>";
	if(operator=="6@152@MEPDCL Meghalaya" && isEmpty(mobile)==1)
		error_message+="<li>Consumer ID should not be empty.</li>";
	if(operator=="6@156@NESCO Odisha" && isEmpty(mobile)==1)
		error_message+="<li>Consumer Number should not be empty.</li>";
	if(operator=="6@160@SOUTHCO Odisha" && isEmpty(mobile)==1)
		error_message+="<li>Consumer Number should not be empty.</li>";
	if(operator=="6@180@WESCO Odisha" && isEmpty(mobile)==1)
		error_message+="<li>Consumer Number should not be empty.</li>";
	if(operator=="6@52@Ajmer Vidyut Vitran Nigam Rajasthan" && isEmpty(mobile)==1)
		error_message+="<li>K Number should not be empty.</li>";
	if(operator=="6@146@BESL Bharatpur" && isEmpty(mobile)==1)
		error_message+="<li>K Number should not be empty.</li>";
	if(operator=="6@147@BKESL Bikaner" && isEmpty(mobile)==1)
		error_message+="<li>K Number should not be empty.</li>";
	if(operator=="6@63@Jaipur Vidyut Vitran Nigam Rajasthan" && isEmpty(mobile)==1)
		error_message+="<li>K Number should not be empty.</li>";
	if(operator=="6@65@Jodhpur Vidyut Vitran Nigam Rajasthan" && isEmpty(mobile)==1)
		error_message+="<li>K Number should not be empty.</li>";
	if(operator=="6@151@KEDL Kota" && isEmpty(mobile)==1)
		error_message+="<li>K Number should not be empty.</li>";
	if(operator=="6@162@TPADL Ajmer" && isEmpty(mobile)==1)
		error_message+="<li>K Number should not be empty.</li>";
	if(operator=="6@179@TNEB Tamilnadu" && isEmpty(mobile)==1)
		error_message+="<li>Consumer Number should not be empty.</li>";
	if(operator=="6@73@SOUTHERN POWER - TELANGANA" && isEmpty(mobile)==1)
		error_message+="<li>Service Number should not be empty.</li>";
	if(operator=="6@76@TSECL - TRIPURA" && isEmpty(mobile)==1)
		error_message+="<li>Consumer ID should not be empty.</li>";
	if(operator=="6@68@Noida Power Noida" && isEmpty(mobile)==1)
		error_message+="<li>Consumer Number should not be empty.</li>";
	if(operator=="6@143@UPPCL (Rural) Uttar Pradesh" && isEmpty(mobile)==1)
		error_message+="<li>Consumer Number should not be empty.</li>";
	if(operator=="6@165@UPPCL (Urban) Uttar Pradesh" && isEmpty(mobile)==1)
		error_message+="<li>Consumer Number should not be empty.</li>";
	if(operator=="6@58@CESC West Bengal" && isEmpty(mobile)==1)
		error_message+="<li>Consumer ID should not be empty.</li>";
	if(operator=="6@178@India Power West Bengal" && isEmpty(mobile)==1)
		error_message+="<li>Consumer Number should not be empty.</li>";///////
	if(operator=="6@181@APDCL (Non-RAPDR) Assam" && isEmpty(mobile)==1)
		error_message+="<li>Consumer Number should not be empty.</li>";
	if(operator=="6@183@CESCOM Karnataka" && isEmpty(mobile)==1)
		error_message+="<li>Consumer Number should not be empty.</li>";
	if(operator=="6@184@HESCOM Karnataka" && isEmpty(mobile)==1)
		error_message+="<li>Consumer Number should not be empty.</li>";
	if(operator=="6@185@Himachal Pradesh State Electricity Board" && isEmpty(mobile)==1)
		error_message+="<li>Consumer Number should not be empty.</li>";
	if(operator=="6@186@PSPCL - Punjab" && isEmpty(mobile)==1)
		error_message+="<li>Consumer Number should not be empty.</li>";
	if(operator=="6@187@UHBVN - Haryana" && isEmpty(mobile)==1)
		error_message+="<li>Consumer Number should not be empty.</li>";
	
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
		$("#error-title").html("Fetching Bill");
		$("#ButtonFirst").hide();
		$("#ButtonSecond").hide();
		$("#ViewServlet").hide();
		$("#error-message").html("<img src='../img/refresh.gif' height='50' align='right' />Please wait while we are fetching bill");
		$("#error-box").show();
		fetch_bill();
	}
}
function show_board_of_state()
{
	var ele_state=$("#ele_state").val();
	$.ajax({
		type: "POST",
		url: "../AjaxShowElectricityBoard.php",
		data: {'ele_state': ele_state },
		dataType: "json",
	 
		//if received a response from the server
		success: function( data, textStatus, jqXHR) {
			//our country code was correct so we have some information to display/
			$("#operator").html(data);
			show_field();
		}	 
	});
}
function clear_bill()
{
	$("#amount").val('');
	$(".pbtns").hide();
	$("#amount").hide();
}
function fetch_bill()
{
	$(".pbtns").hide();
	$("#amount").hide();
	var mobile=$("#mobile").val();
	var operator=$("#operator").val();
	var operators=operator.split("@");
	operator=operators[1];
	$.ajax({
		type: "POST",
		url: "../AjaxShowBill.php",
		data: {'mobile': mobile , 'operator_code': operator },
		dataType: "json",
	 
		//if received a response from the server
		success: function( data, textStatus, jqXHR) {
			//our country code was correct so we have some information to display/
			if(data!="@#@" && data!="#")
			{
				datas=data.split("@#@");
				$(".pbtns").show();
				$("#amount").show();
				$("#amount").val(datas[0]);
				$("#bilname").val(datas[1]);
				$("#error-box").hide();
			}
			else
			{
				$(".pbtns").hide();
				$("#amount").hide();
				$("#amount").val('');
				$("#bilname").val('');
				$("#error-title").html("Bill not fetched");
				$("#error-message").html("Unable to fetch bill details or bill not available at the moment.");
				$("#ButtonFirst").show();
				$("#ButtonSecond").hide();
				$("#ViewServlet").hide();
				$("#error-box").show();
			}
		}	 
	});
}
function check_values() {
	var operator=$("#operator").val();
	var mobile=$("#mobile").val();
	var amount=$("#amount").val();
	var txn_pn=$("#txn_pn").val();
	
	var error_message="";
	
	if(isEmpty(operator)==1)//customerid//customerid//customerno//crn-no//bp-no//customerid//arn-no//consumerno
		error_message+="<li>Select Electricity Provider.</li>";
	if(operator=="6@144@APEPDCL Andhra Pradesh" && isEmpty(mobile)==1)
		error_message+="<li>Service Number should not be empty.</li>";
	if(operator=="6@145@APSPDCL Andhra Pradesh" && isEmpty(mobile)==1)
		error_message+="<li>Service Number should not be empty.</li>";
	if(operator=="6@72@SOUTHERN POWER Andhra Pradesh" && isEmpty(mobile)==1)
		error_message+="<li>Service Number should not be empty.</li>";
	if(operator=="6@53@APDCL Assam" && isEmpty(mobile)==1)
		error_message+="<li>Customer ID should not be empty.</li>";
	if(operator=="6@62@India Power Bihar" && isEmpty(mobile)==1)
		error_message+="<li>Consumer Number should not be empty.</li>";
	if(operator=="6@154@Muzaffarpur Vidyut Vitran" && isEmpty(mobile)==1)
		error_message+="<li>Consumer Number should not be empty.</li>";
	if(operator=="6@155@NBPDCL Bihar" && isEmpty(mobile)==1)
		error_message+="<li>CA Number should not be empty.</li>";
	if(operator=="6@158@SBPDCL Bihar" && isEmpty(mobile)==1)
		error_message+="<li>CA Number should not be empty.</li>";
	if(operator=="6@59@CSEB Chhattisgarh" && isEmpty(mobile)==1)
		error_message+="<li>BP Number should not be empty.</li>";
	if(operator=="6@148@CSPDCL Chhattisgarh" && isEmpty(mobile)==1)
		error_message+="<li>BP Number should not be empty.</li>";
	if(operator=="6@149@Daman and Diu Electricity" && isEmpty(mobile)==1)
		error_message+="<li>Account Number should not be empty.</li>";
	if(operator=="6@56@BSES Rajdhani Delhi" && isEmpty(mobile)==1)
		error_message+="<li>Customer Number should not be empty.</li>";
	if(operator=="6@57@BSES Yamuna Delhi" && isEmpty(mobile)==1)
		error_message+="<li>Customer Number should not be empty.</li>";
	if(operator=="6@74@Tata Power Delhi" && isEmpty(mobile)==1)
		error_message+="<li>Customer Number should not be empty.</li>";
	if(operator=="6@150@DGVCL Gujrat" && isEmpty(mobile)==1)
		error_message+="<li>Consumer Number should not be empty.</li>";
	if(operator=="6@153@MGVCL Gujrat" && isEmpty(mobile)==1)
		error_message+="<li>Consumer Number should not be empty.</li>";
	if(operator=="6@157@PGVCL Gujrat" && isEmpty(mobile)==1)
		error_message+="<li>Consumer Number should not be empty.</li>";
	if(operator=="6@163@UGVCL Gujrat" && isEmpty(mobile)==1)
		error_message+="<li>Consumer Number should not be empty.</li>";
	if(operator=="6@64@Jamshedpur Utilities & Services (JUSCO)" && isEmpty(mobile)==1)
		error_message+="<li>Business Partner Number should not be empty.</li>";
	if(operator=="6@54@BESCOM Bengaluru" && isEmpty(mobile)==1)
		error_message+="<li>Consumer Number should not be empty.</li>";
	if(operator=="6@177@GESCOM Karnataka" && isEmpty(mobile)==1)
		error_message+="<li>Consumer Number should not be empty.</li>";
	if(operator=="6@66@Madhya Kshetra Vitran Madhya Pradesh" && isEmpty(mobile)==1)
		error_message+="<li>Consumer Number should not be empty.</li>";
	if(operator=="6@70@Paschim Kshetra Vitran Madhya Pradesh" && isEmpty(mobile)==1)
		error_message+="<li>Consumer Number should not be empty.</li>";
	if(operator=="6@55@BEST Undertaking Mumbai" && isEmpty(mobile)==1)
		error_message+="<li>Consumer Number should not be empty.</li>";
	if(operator=="6@159@SNDL Power Nagpur" && isEmpty(mobile)==1)
		error_message+="<li>Consumer Number should not be empty.</li>";
	if(operator=="6@161@Tata Power Mumbai" && isEmpty(mobile)==1)
		error_message+="<li>Consumer Number should not be empty.</li>";
	if(operator=="6@152@MEPDCL Meghalaya" && isEmpty(mobile)==1)
		error_message+="<li>Consumer ID should not be empty.</li>";
	if(operator=="6@156@NESCO Odisha" && isEmpty(mobile)==1)
		error_message+="<li>Consumer Number should not be empty.</li>";
	if(operator=="6@160@SOUTHCO Odisha" && isEmpty(mobile)==1)
		error_message+="<li>Consumer Number should not be empty.</li>";
	if(operator=="6@180@WESCO Odisha" && isEmpty(mobile)==1)
		error_message+="<li>Consumer Number should not be empty.</li>";
	if(operator=="6@52@Ajmer Vidyut Vitran Nigam Rajasthan" && isEmpty(mobile)==1)
		error_message+="<li>K Number should not be empty.</li>";
	if(operator=="6@146@BESL Bharatpur" && isEmpty(mobile)==1)
		error_message+="<li>K Number should not be empty.</li>";
	if(operator=="6@147@BKESL Bikaner" && isEmpty(mobile)==1)
		error_message+="<li>K Number should not be empty.</li>";
	if(operator=="6@63@Jaipur Vidyut Vitran Nigam Rajasthan" && isEmpty(mobile)==1)
		error_message+="<li>K Number should not be empty.</li>";
	if(operator=="6@65@Jodhpur Vidyut Vitran Nigam Rajasthan" && isEmpty(mobile)==1)
		error_message+="<li>K Number should not be empty.</li>";
	if(operator=="6@151@KEDL Kota" && isEmpty(mobile)==1)
		error_message+="<li>K Number should not be empty.</li>";
	if(operator=="6@162@TPADL Ajmer" && isEmpty(mobile)==1)
		error_message+="<li>K Number should not be empty.</li>";
	if(operator=="6@179@TNEB Tamilnadu" && isEmpty(mobile)==1)
		error_message+="<li>Consumer Number should not be empty.</li>";
	if(operator=="6@73@SOUTHERN POWER - TELANGANA" && isEmpty(mobile)==1)
		error_message+="<li>Service Number should not be empty.</li>";
	if(operator=="6@76@TSECL - TRIPURA" && isEmpty(mobile)==1)
		error_message+="<li>Consumer ID should not be empty.</li>";
	if(operator=="6@68@Noida Power Noida" && isEmpty(mobile)==1)
		error_message+="<li>Consumer Number should not be empty.</li>";
	if(operator=="6@143@UPPCL (Rural) Uttar Pradesh" && isEmpty(mobile)==1)
		error_message+="<li>Consumer Number should not be empty.</li>";
	if(operator=="6@165@UPPCL (Urban) Uttar Pradesh" && isEmpty(mobile)==1)
		error_message+="<li>Consumer Number should not be empty.</li>";
	if(operator=="6@58@CESC West Bengal" && isEmpty(mobile)==1)
		error_message+="<li>Consumer ID should not be empty.</li>";
	if(operator=="6@178@India Power West Bengal" && isEmpty(mobile)==1)
		error_message+="<li>Consumer Number should not be empty.</li>";///////
	if(operator=="6@181@APDCL (Non-RAPDR) Assam" && isEmpty(mobile)==1)
		error_message+="<li>Consumer Number should not be empty.</li>";
	if(operator=="6@183@CESCOM Karnataka" && isEmpty(mobile)==1)
		error_message+="<li>Consumer Number should not be empty.</li>";
	if(operator=="6@184@HESCOM Karnataka" && isEmpty(mobile)==1)
		error_message+="<li>Consumer Number should not be empty.</li>";
	if(operator=="6@185@Himachal Pradesh State Electricity Board" && isEmpty(mobile)==1)
		error_message+="<li>Consumer Number should not be empty.</li>";
	if(operator=="6@186@PSPCL - Punjab" && isEmpty(mobile)==1)
		error_message+="<li>Consumer Number should not be empty.</li>";
	if(operator=="6@187@UHBVN - Haryana" && isEmpty(mobile)==1)
		error_message+="<li>Consumer Number should not be empty.</li>";
	if(isEmpty(amount)==1)
		error_message+="<li>Amount should not be empty.</li>";
	//if(isNumeric(amount)==1)
		//error_message+="<li>Amount should has Numeric Only.</li>";	
	if(isEmpty(txn_pn)==1)
		error_message+="<li>T-PIN should not be empty.</li>";	
	if(isSize(txn_pn,4,4)==1)
		error_message+="<li>T-PIN must have 4 characters/digits.</li>";
	
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
		$("#error-message").html("Do you want to pay bill for Electricity?");
		$("#ButtonFirst").hide();
		$("#ButtonSecond").show();
		$("#ViewServlet").show();
		$("#error-box").show();
		return true;
	}
}
function show_field() {
	var operator=$("#operator").val();
	var error_message="ID / Number";
	
	if(operator=="6@144@APEPDCL Andhra Pradesh")
		error_message="Service Number";
	if(operator=="6@145@APSPDCL Andhra Pradesh")
		error_message="Service Number";
	if(operator=="6@72@SOUTHERN POWER Andhra Pradesh")
		error_message="Service Number";
	if(operator=="6@53@APDCL Assam")
		error_message="Customer ID";
	if(operator=="6@62@India Power Bihar")
		error_message="Consumer Number";
	if(operator=="6@154@Muzaffarpur Vidyut Vitran")
		error_message="Consumer Number";
	if(operator=="6@155@NBPDCL Bihar")
		error_message="CA Number";
	if(operator=="6@158@SBPDCL Bihar")
		error_message="CA Number";
	if(operator=="6@59@CSEB Chhattisgarh")
		error_message="BP Number";
	if(operator=="6@148@CSPDCL Chhattisgarh")
		error_message="BP Number";
	if(operator=="6@149@Daman and Diu Electricity")
		error_message="Account Number";
	if(operator=="6@56@BSES Rajdhani Delhi")
		error_message="Customer Number";
	if(operator=="6@57@BSES Yamuna Delhi")
		error_message="Customer Number";
	if(operator=="6@74@Tata Power Delhi")
		error_message="Customer Number";
	if(operator=="6@150@DGVCL Gujrat")
		error_message="Consumer Number";
	if(operator=="6@153@MGVCL Gujrat")
		error_message="Consumer Number";
	if(operator=="6@157@PGVCL Gujrat")
		error_message="Consumer Number";
	if(operator=="6@163@UGVCL Gujrat")
		error_message="Consumer Number";
	if(operator=="6@64@Jamshedpur Utilities & Services (JUSCO)")
		error_message="Business Partner Number";
	if(operator=="6@54@BESCOM Bengaluru")
		error_message="Consumer Number";
	if(operator=="6@177@GESCOM Karnataka")
		error_message="Consumer Number";
	if(operator=="6@66@Madhya Kshetra Vitran Madhya Pradesh")
		error_message="Consumer Number";
	if(operator=="6@70@Paschim Kshetra Vitran Madhya Pradesh")
		error_message="Consumer Number";
	if(operator=="6@55@BEST Undertaking Mumbai")
		error_message="Consumer Number";
	if(operator=="6@159@SNDL Power Nagpur")
		error_message="Consumer Number";
	if(operator=="6@161@Tata Power Mumbai")
		error_message="Consumer Number";
	if(operator=="6@152@MEPDCL Meghalaya")
		error_message="Consumer ID";
	if(operator=="6@156@NESCO Odisha")
		error_message="Consumer Number";
	if(operator=="6@160@SOUTHCO Odisha")
		error_message="Consumer Number";
	if(operator=="6@180@WESCO Odisha")
		error_message="Consumer Number";
	if(operator=="6@52@Ajmer Vidyut Vitran Nigam Rajasthan")
		error_message="K Number";
	if(operator=="6@146@BESL Bharatpur")
		error_message="K Number";
	if(operator=="6@147@BKESL Bikaner")
		error_message="K Number";
	if(operator=="6@63@Jaipur Vidyut Vitran Nigam Rajasthan")
		error_message="K Number";
	if(operator=="6@65@Jodhpur Vidyut Vitran Nigam Rajasthan")
		error_message="K Number";
	if(operator=="6@151@KEDL Kota")
		error_message="K Number";
	if(operator=="6@162@TPADL Ajmer")
		error_message="K Number";
	if(operator=="6@179@TNEB Tamilnadu")
		error_message="Consumer Number";
	if(operator=="6@73@SOUTHERN POWER - TELANGANA")
		error_message="Service Number";
	if(operator=="6@76@TSECL - TRIPURA")
		error_message="Consumer ID";
	if(operator=="6@68@Noida Power Noida")
		error_message="Consumer Number";
	if(operator=="6@143@UPPCL (Rural) Uttar Pradesh")
		error_message="Consumer Number";
	if(operator=="6@165@UPPCL (Urban) Uttar Pradesh")
		error_message="Consumer Number";
	if(operator=="6@58@CESC West Bengal")
		error_message="Consumer ID";
	if(operator=="6@178@India Power West Bengal")
		error_message="Consumer Number";
	if(operator=="6@181@APDCL (Non-RAPDR) Assam")
		error_message="Consumer Number";
	if(operator=="6@183@CESCOM Karnataka")
		error_message="Consumer Number";
	if(operator=="6@184@HESCOM Karnataka")
		error_message="Consumer Number";
	if(operator=="6@185@Himachal Pradesh State Electricity Board")
		error_message="Consumer Number";
	if(operator=="6@186@PSPCL - Punjab")
		error_message="Consumer Number";
	if(operator=="6@187@UHBVN - Haryana")
		error_message="Consumer Number";
	
	$("#showfield").html(error_message);
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
                        	<h3>Electricity Bill Payment</h3>
                        </div>
						<?php
						//if($logged_user_id!=200100)
						//echo "<script>window.location.href='TxnServiceOtherServlet';</script>";
						$msg="";
						if(isset($_REQUEST['msg']))
							$msg=$_REQUEST['msg'];
						$service=105;
						if(isset($_POST['RechargeMobile']))
						{
							include_once('../zc-session-admin.php');
							$service=105;
							$txn_pn=mysql_real_escape_string($_POST['txn_pn']);
							if($txn_pn==$logged_tpin)
							{
								$op1=$op2=$op3=$op4=$op5="0";
								$mobile=mysql_real_escape_string($_POST['mobile']);
								$operator=mysql_real_escape_string($_POST['operator']);
								$operators=explode("@",$operator);
								$source_id=$operators[0];
								$operator_code=$operators[1];
								$operator_name=$operators[2];
								$circle="ELECTRICITY";
								$amount=mysql_real_escape_string($_POST['amount']);
								include_once('../zf-WalletTxnElec.php');
								$result_transaction="";
								$result_transaction=txn_recharge_with_op1to5($logged_user_id, $service, $mobile, $operator_code, $operator_name, $circle, $amount, $source_id, $op1, $op2, $op3, $op4, $op5);
								if($result_transaction!="")
								{
									$msg=$result_transaction;
									echo "<script>document.location.href='ServiceElecServlet?msg=$msg'</script>";
								}
								else
								{
									echo "<script>document.location.href='TxnServiceUtilityServlet'</script>";
								}
							}
							else
							{
								$msg="T-PIN not matched";
								echo "<script>document.location.href='ServiceElecServlet?msg=$msg'</script>";
							}
						}
						if($logged_tpin=="1234")
						{
						?>
						<form class="wh w3-left w3-white w3-padding w3-padding-32 w3-round-large" method="post">
						<h3 class="w3-block w3-center w3-text-red">Update default T-PIN to start Transaction</h3>
						<p>Click here to update default T-PIN <a class="w3-button w3-round w3-blue" href="MyChangeTpinServlet">Update T-PIN</a></p>
						</form>
						<?php 
						}
						else if($kinf!=3)// || $logged_pword=="$mp1" || $logged_pword=="$mp2")//removelx
						{
							$kdocinf="";
							if($kinf==0)
							{
								$kdocinf="<p>KYC is not uploaded.<br><br><a class='w3-button w3-round w3-blue' href='KycUpload'>Upload KYC Documents</a></p>";
							}
							else if($kinf==1 || $kinf==2)
							{
								$kdocinf="<p>Verification pending, please wait some time for KYC approval.<br><br></p>";
							}
							else if($kinf==-4 || $kinf==4)
							{
								$kdocinf="<p>KYC Documents In-complete, please upload again.<br><br><a class='w3-button w3-round w3-blue' href='KycUpload'>Re-upload KYC Documents</a></p>";
							}
						?>
						<form class="wh w3-left w3-white w3-padding w3-padding-32 w3-round-large" method="post">
							<h3 class="w3-block w3-center w3-text-red">KYC not Verified</h3>
							<?php echo $kdocinf;?>
						</form>
						<?php 
						}
						else
						{
						?>
                        <form class="wh w3-left" method="post">
                        	<div class="w3-row-padding w3-margin-bottom">  
								<div class="w3-col m12 l12 w3-margin-top">
									<p><?php if($msg!="" && $msg=="repeated") {echo "<b class='w3-text-red'>Repeated Transaction</b>:: You already had performed same transaction with same amount to same mobile today. If you still want to continue, kindly change recharge amount.";}
									else if($msg!="") {echo "<b class='w3-text-red'>$msg</b>";}
									?></p>
								</div>     	
								
                            	<div class="w3-col m6 l3 w3-margin-top">
                                	<label>Select State</label>	
                                	<select class="w3-select w3-border w3-round" onclick="clear_bill()" onchange="show_board_of_state()" id="ele_state">
                                        <option value="" required disabled selected>Choose your option</option>
									<?php
									include_once('../zf-ServiceMarginRc.php');
									$state_result22=show_operator_states();
									while($state_row22=mysql_fetch_array($state_result22))
									{
											echo "<option value='".$state_row22['state']."'>".$state_row22['state']."</option>";
									}
									?>
                                    </select>                       
                                </div>     	
								
                            	<div class="w3-col m6 l3 w3-margin-top">
                                	<label>Electricity Provider</label>	
                                	<select class="w3-select w3-border w3-round" onclick="clear_bill()" onchange="show_field()" id="operator" name="operator">
                                        <option value="" required disabled selected>Choose your option</option>
									<?php/*
									include_once('../zf-ServiceMarginRc.php');
									$state_result=show_operators(" where operator_status=1 and service_id=$service ");
									while($state_row=mysql_fetch_array($state_result))
									{
										$oprid=$state_row['operator_id'];
										$sourceid=show_operator_active_source($oprid,$service);
										if($sourceid==4)
											echo "<option value='$sourceid@".$state_row['api_code_3']."@".$state_row['operator_name']."'>".$state_row['operator_name']."</option>";
									}*/
									?>
                                    </select>                       
                                </div>     
                                <div class="w3-col m6 l3 w3-margin-top">
                                	<label id="showfield">ID / Number</label>
                                	<input id="mobile" name="mobile" onclick="clear_bill()" type="text" placeholder="" class="w3-input w3-border w3-round">
                                </div> 
									   
								<div class="w3-col m3 w3-margin-top">
									<label id="showfield">&nbsp;</label>
									<input id="FetchBill" onclick="abcd()" name="FetchBill" type="text" readonly value="Fetch Bill" placeholder="" class="w3-input w3-round w3-blue">
								</div>   
								<div class="w3-col m6 l4 w3-margin-top pbtns">
									<label>Bill Holder Name </label>
									<input id="bilname" readonly type="text" placeholder="Bill Holder Name" class="w3-input w3-border w3-round">
								</div>
								<div class="w3-col m6 l4 w3-margin-top pbtns">
									<label>Amount</label>
									<input id="amount" readonly name="amount" type="text" placeholder="Amount" class="w3-input w3-border w3-round">
								</div>
								
								<div class="w3-col m6 l4 w3-margin-top pbtns">
									<label>T-PIN</label>
									<input id="txn_pn" name="txn_pn" type="password" placeholder="T-PIN" class="w3-input w3-border w3-round">
								</div>
								   
								<div class="w3-col m12 w3-margin-top w3-right-align pbtns">
									<button onclick="check_values()" name="RechargeMobile" id="RechargeMobile" class="w3-button w3-round-small w3-right w3-blue display-none">RechargeMobile</button>
									<a class="w3-button w3-round w3-blue" onclick="check_values()">Pay Bill</a>
								</div>                           
                        	</div>
                        </form>
						<?php
						}
						?>
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
      	<p id="error-message">Do you want to pay bill for Postpaid Mobile?</p>
      </div>  
        <div class="w3-container" style="margin-bottom:10px;">
            <div class="w3-bar w3-center">
                <a id="ViewServlet" onclick="recharge_mobile()" class="w3-button w3-green w3-round">Accept &amp; Confirm</a>
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
