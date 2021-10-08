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
function pay_now()
{
	click++;
	if(click==1)
		$("#PayNow").click();
}
function check_values() {
		$("#error-title").html("Confirmation");
		$("#error-message").html("Do you want to pay commission to user?");
		$("#ButtonFirst").hide();
		$("#ButtonSecond").show();
		$("#ViewServlet").show();
		$("#error-box").show();
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
                        	<h3>Team Commission PAY NOW</h3>
                        </div>
						<?php
						$userids=$dt1=$dt2="";
						if(isset($_REQUEST['userid']))
							$userids=$_REQUEST['userid'];
						if(isset($_REQUEST['dt1']))
							$dt1=$_REQUEST['dt1'];
						if(isset($_REQUEST['dt2']))
							$dt2=$_REQUEST['dt2'];
						include_once('zf-User.php');
						include_once('zf-Level.php');
						include_once('zf-Commission.php');
						$usernames=show_user_name($userids);
						$usertypes=show_user_type($userids);
						$usertypenames=show_level_name($usertypes);
						$earn1=show_unpaid_comm_gst($userids,$dt1,$dt2);
						$earn2=show_unpaid_comm_non_gst($userids,$dt1,$dt2);
						$earn1=number_format((float)$earn1, 2, '.', '');
						$earn2=number_format((float)$earn2, 2, '.', '');
						$gst1=($earn1/118)*18;
						$gst2=($earn2/118)*0;
						//$gst1=$earn1*.18;
						//$gst2=$earn2*0;
						$gst1=number_format((float)$gst1, 2, '.', '');
						$gst2=number_format((float)$gst2, 2, '.', '');
						$remain1=$earn1-$gst1;
						$remain2=$earn2-$gst2;
						$remain1=number_format((float)$remain1, 2, '.', '');
						$remain2=number_format((float)$remain2, 2, '.', '');
						$tds1=$remain1*.05;
						$tds2=$remain2*.05;
						$tds1=number_format((float)$tds1, 2, '.', '');
						$tds2=number_format((float)$tds2, 2, '.', '');
						$tcomm1=$remain1-$tds1;
						$tcomm2=$remain2-$tds2;
						$tcomm1=number_format((float)$tcomm1, 2, '.', '');
						$tcomm2=number_format((float)$tcomm2, 2, '.', '');
						$earn=$earn1+$earn2;
						$gst=$gst1+$gst2;
						$remain=$remain1+$remain2;
						$tds=$tds1+$tds2;
						$tcomm=$tcomm1+$tcomm2;
						$earn=number_format((float)$earn, 2, '.', '');
						$gst=number_format((float)$gst, 2, '.', '');
						$remain=number_format((float)$remain, 2, '.', '');
						$tds=number_format((float)$tds, 2, '.', '');
						$tcomm=number_format((float)$tcomm, 2, '.', '');
						
						if(isset($_POST['PayNow']))
						{
							include_once('zc-session-admin.php');
							include_once('zf-User.php');
							$uid=mysql_real_escape_string($_POST['uid']);
							$dt1=mysql_real_escape_string($_POST['dt1']);
							$dt2=mysql_real_escape_string($_POST['dt2']);
							
							$tearn=mysql_real_escape_string($_POST['tearn']);
							$tgst=mysql_real_escape_string($_POST['tgst']);
							$tremain=mysql_real_escape_string($_POST['tremain']);
							$ttds=mysql_real_escape_string($_POST['ttds']);
							$tcom=mysql_real_escape_string($_POST['tcom']);
							
							$prd1=mysql_real_escape_string($_POST['prd1']);
							$ern1=mysql_real_escape_string($_POST['ern1']);
							$gst1=mysql_real_escape_string($_POST['gst1']);
							$rem1=mysql_real_escape_string($_POST['rem1']);
							$tds1=mysql_real_escape_string($_POST['tds1']);
							$com1=mysql_real_escape_string($_POST['com1']);
							
							$prd2=mysql_real_escape_string($_POST['prd2']);
							$ern2=mysql_real_escape_string($_POST['ern2']);
							$gst2=mysql_real_escape_string($_POST['gst2']);
							$rem2=mysql_real_escape_string($_POST['rem2']);
							$tds2=mysql_real_escape_string($_POST['tds2']);
							$com2=mysql_real_escape_string($_POST['com2']);
							
							$remarks="From date $dt1 to $dt2";
							pay_now_all($uid,$tearn,$tgst,$tremain,$ttds,$tcom,$remarks,$dt2);
							gst_tds($uid,$dt2,$prd1,$ern1,$gst1,$rem1,$tds1,$com1);
							gst_tds($uid,$dt2,$prd2,$ern2,$gst2,$rem2,$tds2,$com2);
							echo "<script>window.location.href='CommissionTeamUnPaidServlet?s2=$dt1&s3=$dt2&s1=&search=search';</script>";
						}
						?>
                        <form class="wh w3-left" method="post">
                        	<div class="w3-row-padding w3-margin-bottom">     	
                            	<div class="w3-col m2 l2 w3-margin-top">
                                	<label>USER ID</label>	
                                	<input type="text" value="<?php echo $userids;?>" class="w3-input w3-border w3-round" disabled>
									<input type="hidden" id="uid" name="uid" value="<?php echo $userids;?>" />
                                </div>  
								
                            	<div class="w3-col m2 l2 w3-margin-top">
                                	<label>USER NAME</label>	
                                	<input type="text" value="<?php echo $usernames;?>" class="w3-input w3-border w3-round" disabled>                                    
                                </div>     	 	
								
                            	<div class="w3-col m2 l2 w3-margin-top">
                                	<label>USER LEVEL</label>	
                                	<input type="text" value="<?php echo $usertypenames;?>" class="w3-input w3-border w3-round" disabled>                                    
                                </div>      	 	
								
                            	<div class="w3-col m2 l2 w3-margin-top">
                                	<label>From Date</label>	
                                	<input type="date" value="<?php echo $dt1;?>" class="w3-input w3-border w3-round" disabled>
									<input type="hidden" id="dt1" name="dt1" value="<?php echo $dt1;?>" />
                                </div>      	 	
								
                            	<div class="w3-col m2 l2 w3-margin-top">
                                	<label>To Date</label>	
                                	<input type="date" value="<?php echo $dt2;?>" class="w3-input w3-border w3-round" disabled>
									<input type="hidden" id="dt2" name="dt2" value="<?php echo $dt2;?>" />
                                </div>  
							</div>  
							
							<hr style='border-top: 1px solid #aaa;'/>
							
                        	<div class="w3-row-padding w3-margin-bottom">                                    
                                <div class="w3-col m6 l2 w3-margin-top">
                                	<label>PRODUCT</label>
                                	<input type="text" readonly value="DMT" class="w3-input w3-border w3-round" disabled>
									<input type="hidden" name="prd1" value="DMT" />
                                </div>
                                
                                <div class="w3-col m6 l2 w3-margin-top">
                                	<label>EARNING</label>
                                	<input type="text" readonly value="<?php echo $earn1;?>" class="w3-input w3-border w3-round w3-right-align" disabled>
									<input type="hidden" name="ern1" value="<?php echo $earn1;?>" />
                                </div>
                                
                                <div class="w3-col m6 l2 w3-margin-top">
                                	<label>GST TO GOVT.</label>
                                	<input type="text" readonly value="<?php echo $gst1;?>" class="w3-input w3-border w3-round w3-right-align" disabled>
									<input type="hidden" name="gst1" value="<?php echo $gst1;?>" />
                                </div>
                                
                                <div class="w3-col m6 l2 w3-margin-top">
                                	<label>REMAIN</label>
                                	<input type="text" readonly value="<?php echo $remain1;?>" class="w3-input w3-border w3-round w3-right-align" disabled>
									<input type="hidden" name="rem1" value="<?php echo $remain1;?>" />
                                </div>
                                
                                <div class="w3-col m6 l2 w3-margin-top">
                                	<label>TDS TO GOVT.</label>
                                	<input type="text" readonly value="<?php echo $tds1;?>" class="w3-input w3-border w3-round w3-right-align" disabled>
									<input type="hidden" name="tds1" value="<?php echo $tds1;?>" />
                                </div>
                                
                                <div class="w3-col m6 l2 w3-margin-top">
                                	<label>COMMISSION TO WALLET</label>
                                	<input type="text" readonly value="<?php echo $tcomm1;?>" class="w3-input w3-border w3-round w3-right-align" disabled>
									<input type="hidden" name="com1" value="<?php echo $tcomm1;?>" />
                                </div> 
							</div>  
							
                        	<div class="w3-row-padding w3-margin-bottom">                                    
                                <div class="w3-col m6 l2 w3-margin-top">
                                	<input type="text" readonly value="RCBILL" class="w3-input w3-border w3-round" disabled>
									<input type="hidden" name="prd2" value="RCBILL" />
                                </div>
                                
                                <div class="w3-col m6 l2 w3-margin-top">
                                	<input type="text" readonly value="<?php echo $earn2;?>" class="w3-input w3-border w3-round w3-right-align" disabled>
									<input type="hidden" name="ern2" value="<?php echo $earn2;?>" />
                                </div>
                                
                                <div class="w3-col m6 l2 w3-margin-top">
                                	<input type="text" readonly value="<?php echo $gst2;?>" class="w3-input w3-border w3-round w3-right-align" disabled>
									<input type="hidden" name="gst2" value="<?php echo $gst2;?>" />
                                </div>
                                
                                <div class="w3-col m6 l2 w3-margin-top">
                                	<input type="text" readonly value="<?php echo $remain2;?>" class="w3-input w3-border w3-round w3-right-align" disabled>
									<input type="hidden" name="rem2" value="<?php echo $remain2;?>" />
                                </div>
                                
                                <div class="w3-col m6 l2 w3-margin-top">
                                	<input type="text" readonly value="<?php echo $tds2;?>" class="w3-input w3-border w3-round w3-right-align" disabled>
									<input type="hidden" name="tds2" value="<?php echo $tds2;?>" />
                                </div>
                                
                                <div class="w3-col m6 l2 w3-margin-top">
                                	<input type="text" readonly value="<?php echo $tcomm2;?>" class="w3-input w3-border w3-round w3-right-align" disabled>
									<input type="hidden" name="com2" value="<?php echo $tcomm2;?>" />
                                </div> 
							</div> 
							
							<hr style='border-top: 1px solid #aaa;'/>
							
                        	<div class="w3-row-padding w3-margin-bottom">                                    
                                <div class="w3-col m6 l2 w3-margin-top">
                                	<input type="text" readonly value="TOTAL" class="w3-input w3-border w3-round" disabled>
                                </div>
                                
                                <div class="w3-col m6 l2 w3-margin-top">
                                	<input type="text" readonly value="<?php echo $earn;?>" class="w3-input w3-border w3-round w3-right-align" disabled>
									<input type="hidden" name="tearn" value="<?php echo $earn;?>" />
                                </div>
                                
                                <div class="w3-col m6 l2 w3-margin-top">
                                	<input type="text" readonly value="<?php echo $gst;?>" class="w3-input w3-border w3-round w3-right-align" disabled>
									<input type="hidden" name="tgst" value="<?php echo $gst;?>" />
                                </div>
                                
                                <div class="w3-col m6 l2 w3-margin-top">
                                	<input type="text" readonly value="<?php echo $remain;?>" class="w3-input w3-border w3-round w3-right-align" disabled>
									<input type="hidden" name="tremain" value="<?php echo $remain;?>" />
                                </div>
                                
                                <div class="w3-col m6 l2 w3-margin-top">
                                	<input type="text" readonly value="<?php echo $tds;?>" class="w3-input w3-border w3-round w3-right-align" disabled>
									<input type="hidden" name="ttds" value="<?php echo $tds;?>" />
                                </div>
                                
                                <div class="w3-col m6 l2 w3-margin-top">
                                	<input type="text" readonly value="<?php echo $tcomm;?>" class="w3-input w3-border w3-round w3-right-align" disabled>
									<input type="hidden" name="tcom" value="<?php echo $tcomm;?>" />
                                </div>
								
								<div class="w3-col m12 w3-margin-top w3-right-align">
									<button onclick="check_values()" name="PayNow" id="PayNow" class="w3-button w3-round-small w3-right w3-blue display-none">PAY</button>
                                	<a class="w3-button w3-round w3-blue" onclick="check_values()">PAY</a>
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
                <a id="ViewServlet" onclick="pay_now()" class="w3-button w3-green w3-round">Accept &amp; Confirm</a>
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
