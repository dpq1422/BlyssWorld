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
function hide_det()
{
	$("#uid").val('');
	$("#show-det").hide();
}
var click=0;
function search_user()
{
	click++;
	if(click==1)
	$("#sbmt").click();
}
function check_value() {
	$("#show-det").hide();
	var uid=$("#uid").val();
	
	if(isSize(uid,6,6)==0)
	{
		search_user();
	}
}
var click2=0;
function withdraw_wallet()
{
	click2++;
	if(click2==1)
	$("#WithdrawWallet").click();
}
function check_values() {
	var fromuser=$("#fromuser").val();
	var amount=$("#amount").val();
	var remarks=$("#remarks").val();
	var tpin=$("#tpin").val();
	
	var error_message="";
	
	if(isEmpty(fromuser)==1)
		error_message+="<li>User ID should not be blank.</li>";
	if(isEmpty(amount)==1)
		error_message+="<li>Amount should not be blank.</li>";
	if(isNumeric(amount)==1)
		error_message+="<li>Amount should have number only.</li>";
	if(isEmpty(remarks)==1)
		error_message+="<li>Remarks should not be blank.</li>";
	if(isSize(tpin,4,4)==1)
		error_message+="<li>T-PIN must have 4 characters.</li>";
	
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
		$("#error-message").html("Do you want to withdraw?");
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
                        	<h3>Withdraw Amount From User Wallet</h3>
                        </div>
						<?php
						$msg="";
						if(isset($_POST['WithdrawWallet']))
						{
							include_once('zc-session-admin.php');
							include_once('zf-WalletDistributed.php');
							$fromuser=mysql_real_escape_string($_POST['fromuser']);
							$amount=mysql_real_escape_string($_POST['amount']);
							$remarks=mysql_real_escape_string($_POST['remarks']);
							$tpin=mysql_real_escape_string($_POST['tpin']);
							if($tpin==$logged_tpin)
							{
								$remarks_admin="amount withdrawn by $logged_user_typename ($logged_user_id - $logged_user_name)";
								if($amount>0)
								{
									transfer_user_to_admin($fromuser, $amount, $remarks, $remarks_admin);
								}
								echo "<script>window.location.href='WalletTransferAdminServlet';</script>";
							}
							else
							{
								$msg="<b class='w3-text-red'>T-PIN is not matched</b>";
							}
						}
						$xuid1="";
						if(isset($_POST['uid']))
						$xuid1=$_POST['uid'];
						if($logged_tpin=="1234")
						{
						?>
						<form class="wh w3-left w3-white w3-padding w3-padding-32 w3-round-large" method="post">
						<h3 class="w3-block w3-center w3-text-red">Update default T-PIN to start Transaction</h3>
						<p>Click here to update default T-PIN <a class="w3-button w3-round w3-blue" href="MyChangeTpinServlet">Update T-PIN</a></p>
						</form>
						<?php 
						}
						else
						{
						?>
                        <form class="wh w3-left" method="post">
                        	<div class="w3-row-padding w3-margin-bottom">                                
                                <div class="w3-col m12 l12 w3-margin-top">
                                	<?php echo $msg; ?>                  
                                </div>                                                                     
                                <div class="w3-col m6 l3 w3-margin-top">
                                	<label>USER ID</label>
                                	<input name="uid" maxlength="6" onclick="hide_det()" id="uid" value="<?php echo $xuid1;?>" onkeyup="check_value()" type="number" placeholder="USER ID" class="w3-input w3-border w3-round"> 
									<input type="submit" id="sbmt" name="sbmt" class="display-none" />
                                </div>
                        	</div>
                        </form>
						<?php
						}
						if(isset($_POST['sbmt']))
						{
							include_once('zf-User.php');
							include_once('zf-Level.php');
							include_once('zf-WalletDistributed.php');
							$uid=$_POST['uid'];
							$unm=show_user_name($uid);
							$utp=show_user_type($uid);
							$utp=show_level_name($utp);
							$ubals=show_user_balance($uid);
							if($unm!="")
							{
						?>
                        <form class="wh w3-left" id="show-det" method="post">
                        	<div class="w3-row-padding w3-margin-bottom">                                 
                                <div class="w3-col m12 l12 w3-margin-top">
                                	<?php echo $msg; ?>                  
                                </div>                                                                    
                                <div class="w3-col m6 l3 w3-margin-top">
                                	<label>ID</label>
                                	<input type="text" value="<?php echo $uid;?>" disabled placeholder="ID" class="w3-input w3-border w3-round">                    
                                </div>      
								
                                <div class="w3-col m6 l3 w3-margin-top">
                                	<label>NAME</label>
                                	<input type="text" value="<?php echo $unm;?>" disabled placeholder="NAME" class="w3-input w3-border w3-round">                    
                                </div>    
								
                                <div class="w3-col m6 l3 w3-margin-top">
                                	<label>DESIGNATION</label>
                                	<input type="text" value="<?php echo $utp;?>" disabled placeholder="DESIGNATION" class="w3-input w3-border w3-round">                    
                                </div>          
								
                                <div class="w3-col m6 l3 w3-margin-top">
                                	<label>WALLET BALANCE</label>
                                	<input type="text" value="<?php echo $ubals;?>" disabled placeholder="DESIGNATION" class="w3-input w3-border w3-round">                    
                                </div>                         
                                
                                <div class="w3-col m6 l3 w3-margin-top">
                                	<label>AMOUNT</label>
									<input type="hidden" id="fromuser" name="fromuser" value="<?php echo $uid;?>" />
                                	<input type="text" id="amount" name="amount" placeholder="AMOUNT" class="w3-input w3-border w3-round">                                    
                                </div>
                                
                                <div class="w3-col m6 l6 w3-margin-top">
                                	<label>REMARKS</label>
                                	<input type="text" id="remarks" name="remarks" placeholder="REMARKS" class="w3-input w3-border w3-round">                                    
                                </div>
                                
                                <div class="w3-col m6 l3 w3-margin-top">
                                	<label>T-PIN</label>
                                	<input type="password" id="tpin" name="tpin" placeholder="Your T-PIN" class="w3-input w3-border w3-round">                                    
                                </div>
                                   
                                <div class="w3-col m12 w3-margin-top w3-right-align">
									<button onclick="check_values()" name="WithdrawWallet" id="WithdrawWallet" class="w3-button w3-round-small w3-right w3-blue display-none">WithdrawWallet</button>
                                	<a class="w3-button w3-round w3-blue" onclick="check_values()">WITHDRAW WALLET</a>
                                </div>                              
                        	</div>
                        </form>
						<?php
							}
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
        <span onclick="document.getElementById('error-box').style.display='none';" class="w3-button w3-display-topright"><img src="img/close.png" style="margin-bottom:0px;"></span>
        <h3 class="w3-center" id="error-title">Confirm</h3> 
      </header> 
      <div class="w3-container w3-center">
      	<p id="error-message">Do you want to withdraw?</p>
      </div>  
        <div class="w3-container" style="margin-bottom:10px;">
            <div class="w3-bar w3-center">
                <a id="ViewServlet" onclick="withdraw_wallet()" class="w3-button w3-green w3-round">Accept &amp; Confirm</a>
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
