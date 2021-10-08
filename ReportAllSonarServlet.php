<!DOCTYPE html>
<html>
<head>
<?php include_once('_all-inner-pages-html-title.php'); ?>
<script type="text/javascript" src="js/admin-validation-functions.js"></script>
<script>
function dailys(val)
{
	var daily=$("#daily").val();
	var error_message="";
	if(isEmpty(daily)==1)
		error_message+="<li>Select Date to process <b>Daily Report</b></li>";
	if(error_message=="")
	{
		var link="AjaxProcessReportD"+val+".php";
		var msg="<img src='img/refresh.gif' height='50' align='right' />Please wait few seconds...<br>while we process and reconcile ";
		if(val==1)
			msg=msg+"<br><b>Wallet Balance / Member Registrations / Wallet Requests / Tickets Raised</b>";
		else if(val==2)
			msg=msg+"<br><b>Account Verification / Money Transfer</b>";
		else if(val==3)
			msg=msg+"<br><b>Prepaid Mobile Recharge / DTH Recharge</b>";
		else if(val==4)
			msg=msg+"<br><b>GST / Commissions / TDS / Earnings</b>";
		msg=msg+"<br>daily report for date: <b>"+daily+"</b>";
		$("#error-message2").html(msg);
		$("#error-box2").show();
		$.ajax({
			type: "POST",
			url: link,
			data: {'field': daily },
			dataType: "json",
		 
			//if received a response from the server
			success: function( data, textStatus, jqXHR) {
				$("#error-box2").hide();
			}	 
		});
	}
	else
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
}
function monthlys(val)
{
	var monthly=$("#monthly").val();
	var error_message="";
	if(isEmpty(monthly)==1)
		error_message+="<li>Select Month to process <b>Monthly Report</b></li>";
	if(error_message=="")
	{
		var link="AjaxProcessReportM"+val+".php";
		var msg="<img src='img/refresh.gif' height='50' align='right' />Please wait few seconds...<br>while we process and reconcile ";
		if(val==1)
			msg=msg+"<br><b>Wallet Balance / Member Registrations / Wallet Requests / Tickets Raised</b>";
		else if(val==2)
			msg=msg+"<br><b>Account Verification / Money Transfer</b>";
		else if(val==3)
			msg=msg+"<br><b>Prepaid Mobile Recharge / DTH Recharge</b>";
		else if(val==4)
			msg=msg+"<br><b>GST / Commissions / TDS / Earnings</b>";
		msg=msg+"<br>monthly report for month: <b>"+monthly+"</b>";
		$("#error-message2").html(msg);
		$("#error-box2").show();
		$.ajax({
			type: "POST",
			url: link,
			data: {'field': monthly },
			dataType: "json",
		 
			//if received a response from the server
			success: function( data, textStatus, jqXHR) {
				$("#error-box2").hide();
			}	 
		});
	}
	else
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
}
</script>
</head>
<body>

	<?php include_once('_header.php'); ?>
    
    <section class="boxes wh w3-left">
        <!--<div class="w3-container">-->
            <!--<div class="w3-row-padding">
                <div class="w3-col m12">
                	<h4 class="heading wh w3-left"><span>Transactions</span></h4>
                </div>
            </div>-->
            <div class="w3-row-padding w3-margin-top">
            	<div class="w3-col m12 wow bounceIn">
                	<div class="table-box wh w3-left">
                    	<div class="box-head">
                        	<h3>SONAR REPORT </h3>
                        </div>
                        <form class="wh w3-left" method="post">
                        	<div class="w3-row-padding w3-margin-bottom">
                                <div class="w3-col m6 l6 w3-margin-top">
                                	&nbsp;
                                </div>
                                <div class="w3-col m2 l2 w3-margin-top">
									<label>Select Date</label>
                                	<input name="daily" id="daily" type="date" placeholder="Select Date" class="w3-input w3-border w3-round">
                                </div>
                                <div class="w3-col m1 l1 w3-margin-top">
                                	&nbsp;
                                </div>
                                <div class="w3-col m2 l2 w3-margin-top">
									<label>Select Month</label>
                                	<select name="monthly" id="monthly" class="w3-select w3-border w3-round">
                                        <option value="" selected>Select Month</option>
										<?php
										$yy=date('Y');
										$mm=date('m')+0;
										$steps=0;
										for($one=$yy;$one>=2018;$one--)
										{
											$start=12;
											if($one==$yy)
												$start=$mm;
											for($two=$start;$two>=1;$two--)
											{
												$steps++;
												if($two<10)
													echo "<option>$one-0$two</option>";
												else
													echo "<option>$one-$two</option>";
												if($one==2018 && $two==7)
													break;
												if($steps==12)
													break;
											}
											if($one==2018 && $two==7)
												break;
											if($steps==12)
												break;
										}
										?>
                                    </select>
                                </div>
                                <div class="w3-col m1 l1 w3-margin-top">
                                	&nbsp;
                                </div>
							</div>
                        	<div class="w3-row-padding w3-margin-bottom">
                                <div class="w3-col m6 l6 w3-margin-top">
                                	Wallet Balance / Member Registrations / Wallet Requests / Tickets Raised
                                </div>
                                <div class="w3-col m2 l2 w3-margin-top">
                                	<a onclick="dailys(1)" class="sonar w3-button w3-blue w3-round">Process Daily Report</a>
                                </div>
                                <div class="w3-col m1 l1 w3-margin-top">
                                	<?php if($logged_user_id==$main_admin || $logged_user_id==$sub_admin2) { ?><a target="_blank" href="ReportSonarDateWiseBaseServlet" class="sonar w3-button w3-green w3-round">Show</a><?php } ?>
                                </div>
                                <div class="w3-col m2 l2 w3-margin-top">
                                	<a onclick="monthlys(1)" class="sonar w3-button w3-blue w3-round">Process Monthly Report</a>
                                </div>
                                <div class="w3-col m1 l1 w3-margin-top">
                                	<?php if($logged_user_id==$main_admin || $logged_user_id==$sub_admin2) { ?><a target="_blank" href="ReportSonarMonthWiseBaseServlet" class="sonar w3-button w3-green w3-round">Show</a><?php } ?>
                                </div>
							</div>
                        	<div class="w3-row-padding w3-margin-bottom">
                                <div class="w3-col m6 l6 w3-margin-top">
                                	Account Verification / Money Transfer
                                </div>
                                <div class="w3-col m2 l2 w3-margin-top">
                                	<a onclick="dailys(2)" class="sonar w3-button w3-blue w3-round">Process Daily Report</a>
                                </div>
                                <div class="w3-col m1 l1 w3-margin-top">
                                	<?php if($logged_user_id==$main_admin || $logged_user_id==$sub_admin2) { ?><a target="_blank" href="ReportSonarDateWiseMtServlet" class="sonar w3-button w3-green w3-round">Show</a><?php } ?>
                                </div>
                                <div class="w3-col m2 l2 w3-margin-top">
                                	<a onclick="monthlys(2)" class="sonar w3-button w3-blue w3-round">Process Monthly Report</a>
                                </div>
                                <div class="w3-col m1 l1 w3-margin-top">
                                	<?php if($logged_user_id==$main_admin || $logged_user_id==$sub_admin2) { ?><a target="_blank" href="ReportSonarMonthWiseMtServlet" class="sonar w3-button w3-green w3-round">Show</a><?php } ?>
                                </div>
							</div>
                        	<div class="w3-row-padding w3-margin-bottom">
                                <div class="w3-col m6 l6 w3-margin-top">
                                	Prepaid Mobile Recharge / DTH Recharge
                                </div>
                                <div class="w3-col m2 l2 w3-margin-top">
                                	<a onclick="dailys(3)" class="sonar w3-button w3-blue w3-round">Process Daily Report</a>
                                </div>
                                <div class="w3-col m1 l1 w3-margin-top">
                                	<?php if($logged_user_id==$main_admin || $logged_user_id==$sub_admin2) { ?><a target="_blank" href="ReportSonarDateWiseRcServlet" class="sonar w3-button w3-green w3-round">Show</a><?php } ?>
                                </div>
                                <div class="w3-col m2 l2 w3-margin-top">
                                	<a onclick="monthlys(3)" class="sonar w3-button w3-blue w3-round">Process Monthly Report</a>
                                </div>
                                <div class="w3-col m1 l1 w3-margin-top">
                                	<?php if($logged_user_id==$main_admin || $logged_user_id==$sub_admin2) { ?><a target="_blank" href="ReportSonarMonthWiseRcServlet" class="sonar w3-button w3-green w3-round">Show</a><?php } ?>
                                </div>
							</div>
                        	<!--<div class="w3-row-padding w3-margin-bottom">
                                <div class="w3-col m6 l6 w3-margin-top">
                                	GST / Commissions / TDS / Earnings
                                </div>
                                <div class="w3-col m2 l2 w3-margin-top">
                                	<a onclick="dailys(4)" class="sonar w3-button w3-blue w3-round">Process Daily Report</a>
                                </div>
                                <div class="w3-col m1 l1 w3-margin-top">
                                	<?php if($logged_user_id==$main_admin || $logged_user_id==$sub_admin2) { ?><a target="_blank" href="ReportSonarDateWiseCommServlet" class="sonar w3-button w3-green w3-round">Show</a><?php } ?>
                                </div>
                                <div class="w3-col m2 l2 w3-margin-top">
                                	<a onclick="monthlys(4)" class="sonar w3-button w3-blue w3-round">Process Monthly Report</a>
                                </div>
                                <div class="w3-col m1 l1 w3-margin-top">
                                	<?php if($logged_user_id==$main_admin || $logged_user_id==$sub_admin2) { ?><a target="_blank" href="ReportSonarMonthWiseCommServlet" class="sonar w3-button w3-green w3-round">Show</a><?php } ?>
                                </div>
							</div>-->
						</form>
                    </div>
                </div>               
                
            </div>
        <!--</div>-->
    </section>
	
	<div id="error-box2" class="w3-modal">
		<div class="w3-modal-content w3-animate-zoom w3-card-4 w3-round list-pop">
		  <header class="w3-container w3-blue"> 
			<span onclick="document.getElementById('error-box2').style.display='none';" class="w3-button w3-display-topright"><img src="img/close.png" style="margin-bottom:0px;"></span>
			<h3 class="w3-center" id="error-title2">Processing Report</h3> 
		  </header> 
		  <div class="w3-container w3-center">
			<p id="error-message2" class='w3-left-align'><img src='img/refresh.gif' height='50' align='right' />Please wait few seconds...<br>while we process and reconcile report</p>
		  </div>  
		</div>
	  </div>
	  
	  <div id="error-box" class="w3-modal">
		<div class="w3-modal-content w3-animate-zoom w3-card-4 w3-round list-pop">
		  <header class="w3-container w3-blue"> 
			<span onclick="document.getElementById('error-box').style.display='none';" class="w3-button w3-display-topright"><img src="img/close.png" style="margin-bottom:0px;"></span>
			<h3 class="w3-center" id="error-title">Confirm</h3> 
		  </header> 
		  <div class="w3-container w3-center">
			<p id="error-message">Do you want to process report?</p>
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

</body>
</html> 
