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
function start_refund()
{
	click++;
	if(click==1)
	$("#StartRefund").click();
}
function check_values() {
	var oid=$("#oid").val();
	var mid=$("#mid").val();
	var tid=$("#tid").val();
	var otp=$("#otp").val();
	
	var error_message="";
	
	if(isEmpty(oid)==1)
		error_message+="<li>Order No. should not be blank.</li>";
	if(isEmpty(mid)==1)
		error_message+="<li>Mid should not be blank.</li>";
	if(isEmpty(tid)==1)
		error_message+="<li>Tid should not be blank.</li>";
	if(isEmpty(otp)==1)
		error_message+="<li>OTP should not be blank.</li>";
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
		$("#error-message").html("Do you want to initiate refund?");
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
                        	<h3>Refund Transaction</h3>
                        </div>
						<?php
						$resulted_msg="";
						$resulted_msgs="";
						$source=1;
						if(isset($_POST['StartRefund']))
						{
							include_once('../zc-session-admin.php');
							include_once('../zf-TxnSource1DmtApi.php');
							$oid=mysql_real_escape_string($_POST['oid']);
							$mid=mysql_real_escape_string($_POST['mid']);
							$tid=mysql_real_escape_string($_POST['tid']);
							$otp=mysql_real_escape_string($_POST['otp']);
							//$otp=0;
							$resulteds=fund_transfer_refund($mid,$tid,$otp);
							$resulted_msgs=$resulteds[0];
							$resulted_tid=$resulteds[1];
							if($resulted_msgs=="Refund done")
							{
								include_once('../zf-WalletTxnDmt.php');
								refund_amount($oid,$mid,$tid,$resulted_tid,$source);
								echo "<script>window.location.href='TxnRefundedServiceDmtServlet';</script>";
							}
							else
								$resulted_msgs="<b class='w3-text-red'>$resulted_msgs</b>";
						}
						else
						{
							$oid="";
							$mid="";
							$tid="";
							if(isset($_REQUEST['oid']))
								$oid=$_REQUEST['oid'];
							if(isset($_REQUEST['mid']))
								$mid=$_REQUEST['mid'];
							if(isset($_REQUEST['tid']))
								$tid=$_REQUEST['tid'];
							if($oid=="" || $mid=="" || $tid=="")
								echo "<script>window.location.href='TxnRefundPendingServiceDmtServlet';</script>";
							
							include_once('../zc-session-admin.php');
							include_once('../zf-TxnSource1DmtApi.php');
							$resulteds=fund_transfer_refund_otp($tid);
							$resulted_msg=$resulteds[0];
							$resulted_tid=$resulteds[1];
							//if($resulted_msg=="Success!Refund OTP resent")
								$resulted_msg="<b class='w3-text-green'>$resulted_msg</b>";
							//else
								//$resulted_msg="<b class='w3-text-red'>$resulted_msg</b>";
							
							//sending order id will mid//displaying order id will be oid
							//sending tid will be tid//displaying tid will be mid
							// on page load send curl request for otp if mthod is not posted
							
							//oid//tid//otp
						}
						$result_msg="";
						if($resulted_msg!="")
							$result_msg=$resulted_msg;
						if($resulted_msgs!="")
							$result_msg=$resulted_msgs;
						
						$resend_otp_link="ServiceDmtRefundServlet?oid=$oid&mid=$mid&tid=$tid";
						?>
                        <form class="wh w3-left" method="post">
                        	<div class="w3-row-padding w3-margin-bottom"> 
								<div class="w3-col m12 l12 w3-margin-top">
									<?php echo $result_msg;?>
                                </div>
								
                            	<div class="w3-col m6 l3 w3-margin-top">
                                	<label>Order No.</label>	
                                	<input type="text" value="<?php echo $oid."-".$mid;?>" class="w3-input w3-border w3-round"  disabled>                                   
                                </div>
                                
                                <div class="w3-col m6 l3 w3-margin-top">
                                	<label>Txn ID.</label>	
                                	<input type="text" value="<?php echo $mid."-".$tid;?>" class="w3-input w3-border w3-round"  disabled>                                   
                                </div>
                            	                      	
                            	<div class="w3-col m6 l3 w3-margin-top">
                                	<label>OTP</label>	
                                	<input type="text" name="otp" id="otp" placeholder="OTP" class="w3-input w3-border w3-round">
									<input type="hidden" value="<?php echo $oid;?>" name="oid" id="oid" />
									<input type="hidden" value="<?php echo $mid;?>" name="mid" id="mid" />
									<input type="hidden" value="<?php echo $tid;?>" name="tid" id="tid" />
                                </div>
                            	                      	
                            	<div class="w3-col m6 l3 w3-margin-top">
									<a class="w3-left w3-margin-top" onclick="window.location.href='<?php echo $resend_otp_link;?>';">Re-Send OTP</a>
                                </div>
								
								<div class="w3-col m12 w3-margin-top w3-right-align">
									<button onclick="check_values()" name="StartRefund" id="StartRefund" class="w3-button w3-round-small w3-right w3-blue display-none">INITIATE REFUND</button>
                                	<a class="w3-button w3-round w3-green" onclick="check_values()">Initiate Refund</a>
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
      	<p id="error-message">Do you want to initiate refund?</p>
      </div>  
        <div class="w3-container" style="margin-bottom:10px;">
            <div class="w3-bar w3-center">
                <a id="ViewServlet" onclick="start_refund()" class="w3-button w3-green w3-round">Accept &amp; Confirm</a>
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
