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
function hide_det1()
{
	$("#uid1").val('');
	$("#show-det").hide();
}
function hide_det2()
{
	$("#uid2").val('');
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
	//$("#show-det").hide();
	var uid1=$("#uid1").val();
	var uid2=$("#uid2").val();
	
	if(isSize(uid1,6,6)==0 && isSize(uid2,6,6)==0)
	{
		search_user();
	}
}
var click2=0;
function transfer_wallet()
{
	click2++;
	if(click2==1)
	$("#TransferWallet").click();
}
function check_values() {
	var fromuser=$("#fromuser").val();
	var touser=$("#touser").val();
	var amount=$("#amount").val();
	var remarks=$("#remarks").val();
	var tpin=$("#tpin").val();
	
	var error_message="";
	
	if(isEmpty(fromuser)==1)
		error_message+="<li>From User ID should not be blank.</li>";
	if(isEmpty(touser)==1)
		error_message+="<li>To User ID should not be blank.</li>";
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
		$("#error-message").html("Do you want to transfer?");
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
                        	<h3>Transfer Amount User Wallet To User Wallet</h3>
                        </div>
						<?php
						$msg="";
						if(isset($_POST['TransferWallet']))
						{
							include_once('zc-session-admin.php');
							include_once('zf-WalletDistributed.php');
							$fromuser=mysql_real_escape_string($_POST['fromuser']);
							$touser=mysql_real_escape_string($_POST['touser']);
							$amount=mysql_real_escape_string($_POST['amount']);
							$remarks=mysql_real_escape_string($_POST['remarks']);
							$tpin=mysql_real_escape_string($_POST['tpin']);
							if($tpin==$logged_tpin)
							{
								$remarks_admin="amount transferred by $logged_user_typename ($logged_user_id - $logged_user_name)";
								if($amount>0)
								{
									transfer_user_to_user($fromuser, $touser, $amount, $remarks, $remarks_admin);
								}
								echo "<script>window.location.href='WalletTransferTeamServlet';</script>";
							}
							else
							{
								$msg="<b class='w3-text-red'>T-PIN is not matched</b>";
							}
						}
						$xuid1="";
						if(isset($_POST['uid1']))
						$xuid1=$_POST['uid1'];
						$xuid2="";
						if(isset($_POST['uid2']))
						$xuid2=$_POST['uid2'];
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
                                	<label>FROM USER ID</label>
                                	<input name="uid1" maxlength="6" onclick="hide_det1()" id="uid1" value="<?php echo $xuid1;?>" onkeyup="check_value()" type="number" placeholder="USER ID" class="w3-input w3-border w3-round"> 
                                </div>                                 
                                <div class="w3-col m6 l3 w3-margin-top">
                                	<label>TO USER ID</label>
                                	<input name="uid2" maxlength="6" onclick="hide_det2()" id="uid2" value="<?php echo $xuid2;?>" onkeyup="check_value()" type="number" placeholder="USER ID" class="w3-input w3-border w3-round"> 
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
							include_once('zf-UserLevel.php');
							include_once('zf-WalletDistributed.php');
							$uid1=$_POST['uid1'];
							$unm1=show_user_name($uid1);
							$utp1n=show_user_type($uid1);
							$utp1=show_level_name($utp1n);
							$ubals1=show_user_balance($uid1);
							$uid2=$_POST['uid2'];
							$unm2=show_user_name($uid2);
							$utp2n=show_user_type($uid2);
							$utp2=show_level_name($utp2n);
							$ubals2=show_user_balance($uid2);
							$is_my_team=isMyTeam($uid1,$uid2);
							$is_my_team2=isMyTeam($uid2,$uid1);
							if($unm1!="" && $unm2!="" && ($is_my_team==1 || $is_my_team2==1))
							{
						?>
                        <form class="wh w3-left" id="show-det" method="post">
                        	<div class="w3-row-padding w3-margin-bottom">                                   
                                <div class="w3-col m12 l12 w3-margin-top">
                                	<?php echo $msg; ?>                  
                                </div>                                                                  
                                <div class="w3-col m6 l3 w3-margin-top">
                                	<label>ID (FROM)</label>
                                	<input type="text" value="<?php echo $uid1;?>" disabled placeholder="ID" class="w3-input w3-border w3-round">                    
                                </div>      
								
                                <div class="w3-col m6 l3 w3-margin-top">
                                	<label>NAME (FROM)</label>
                                	<input type="text" value="<?php echo $unm1;?>" disabled placeholder="NAME" class="w3-input w3-border w3-round">                    
                                </div>    
								
                                <div class="w3-col m6 l3 w3-margin-top">
                                	<label>DESIGNATION (FROM)</label>
                                	<input type="text" value="<?php echo $utp1;?>" disabled placeholder="DESIGNATION" class="w3-input w3-border w3-round">                    
                                </div>                  
								
                                <div class="w3-col m6 l3 w3-margin-top">
                                	<label>WALLET BALANCE (FROM)</label>
                                	<input type="text" value="<?php echo $ubals1;?>" disabled placeholder="DESIGNATION" class="w3-input w3-border w3-round">                    
                                </div>      
								
                                <div class="w3-col m6 l3 w3-margin-top">
                                	<label>ID (TO)</label>
                                	<input type="text" value="<?php echo $uid2;?>" disabled placeholder="ID" class="w3-input w3-border w3-round">                    
                                </div>      
								
                                <div class="w3-col m6 l3 w3-margin-top">
                                	<label>NAME (TO)</label>
                                	<input type="text" value="<?php echo $unm2;?>" disabled placeholder="NAME" class="w3-input w3-border w3-round">                    
                                </div>    
								
                                <div class="w3-col m6 l3 w3-margin-top">
                                	<label>DESIGNATION (TO)</label>
                                	<input type="text" value="<?php echo $utp2;?>" disabled placeholder="DESIGNATION" class="w3-input w3-border w3-round">                    
                                </div>                   
								
                                <div class="w3-col m6 l3 w3-margin-top">
                                	<label>WALLET BALANCE (TO)</label>
                                	<input type="text" value="<?php echo $ubals2;?>" disabled placeholder="DESIGNATION" class="w3-input w3-border w3-round">                    
                                </div>                               
                                
                                <div class="w3-col m6 l3 w3-margin-top">
                                	<label>AMOUNT</label>
                                	<input type="hidden" name="fromuser" id="fromuser" value="<?php echo $uid1;?>" />
                                	<input type="hidden" name="touser" id="touser" value="<?php echo $uid2;?>" />
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
									<button onclick="check_values()" name="TransferWallet" id="TransferWallet" class="w3-button w3-round-small w3-right w3-blue display-none">TransferWallet</button>
                                	<a class="w3-button w3-round w3-blue" onclick="check_values()">TRANSFER WALLET</a>
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
      	<p id="error-message">Do you want to transfer?</p>
      </div>  
        <div class="w3-container" style="margin-bottom:10px;">
            <div class="w3-bar w3-center">
                <a id="ViewServlet" onclick="transfer_wallet()" class="w3-button w3-green w3-round">Accept &amp; Confirm</a>
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
