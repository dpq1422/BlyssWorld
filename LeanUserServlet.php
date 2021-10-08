<!DOCTYPE html>
<html>
<head>
<?php include_once('_all-inner-pages-html-title.php'); ?>
<script type="text/javascript" src="js/admin-validation-functions.js"></script>
<script>
$(document).ready(function(){
	$(".search-data").click(function(){
		$(".table-search-filter").slideToggle();
	});
});
</script>   
<script>
var click=0;
function update_lean()
{
	click++;
	if(click==1)
	$("#UpdateLean").click();
}
function check_values() {
	var uid=$("#uid").val();
	var utype=$("#utype").val();
	var amount=$("#amount").val();
	var remarks=$("#remarks").val();
	
	
	var error_message="";
	
	if(isEmpty(uid)==1)
		error_message+="<li>User ID should not be blank.</li>";
	if(isEmpty(utype)==1)
		error_message+="<li>User Type should not be blank.</li>";
	if(isEmpty(amount)==1)
		error_message+="<li>Amount should not be blank.</li>";
	if(isNumeric(amount)==1)
		error_message+="<li>Amount should have number only.</li>";
	if(isEmpty(remarks)==1)
		error_message+="<li>Remarks should not be blank.</li>";
	
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
		$("#error-message").html("Do you want to apply lean amount to user?");
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
                	<h4 class="heading wh w3-left"><span>Transactions</span></h4>
                </div>
            </div>-->
            <div class="w3-row-padding w3-margin-top">
            	<div class="w3-col m12 wow bounceIn">
                	<div class="table-box wh w3-left">
						<?php
						if(isset($_POST['UpdateLean']))
						{
							include_once('zc-session-admin.php');
							include_once('zf-WalletDistributed.php');
							$uid=$_POST['uid'];
							$utype=$_POST['utype'];
							$amount=$_POST['amount'];
							$remarks=$_POST['remarks'];
							$uid=mysql_real_escape_string($_POST['uid']);
							$utype=mysql_real_escape_string($_POST['utype']);
							$amount=mysql_real_escape_string($_POST['amount']);
							$remarks=mysql_real_escape_string($_POST['remarks']);
							update_user_lean($uid,$amount,$remarks);
							if($utype>1 && $utype<12)
								echo "<script>window.location.href='TeamsMembersServlet';</script>";
							else if($utype==12)
								echo "<script>window.location.href='TeamsRetailersServlet';</script>";
							else
								echo "<script>window.location.href='DashboardServlet';</script>";
						}
						?>
                    	<div class="box-head">
                        	<h3>USER DETAILS</h3>
                        </div>					
						<?php
						include_once('zf-User.php');
						include_once('zf-Level.php');
						$userid=$_REQUEST['uid'];
						$username=show_user_name($userid);
						$usertype=show_user_type($userid);
						$usertypename=show_level_name($usertype);
						?>
						<form class="wh w3-left" method="post">
                        	<div class="w3-row-padding w3-margin-bottom"> 								
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>User ID</label>	
                                	<input type="text" value="<?php echo $userid;?>" placeholder="User ID" disabled class="w3-input w3-border w3-round">                                    
                                </div>
                            	                      	
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>User Name</label>
                                	<input type="text" value="<?php echo $username;?>" placeholder="User Name" disabled class="w3-input w3-border w3-round">                                    
                                </div>
                                
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>User Type</label>	
                                	<input type="text" value="<?php echo $usertypename;?>" placeholder="User Type" disabled class="w3-input w3-border w3-round">                                    
                                </div>                           
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>LEAN Amount</label>
									<input type="hidden" id="uid" name="uid" value="<?php echo $userid;?>" />
									<input type="hidden" id="utype" name="utype" value="<?php echo $usertype;?>" />
                                	<input type="text" id="amount" name="amount" placeholder="AMOUNT" class="w3-input w3-border w3-round">                                    
                                </div>
                                
                                <div class="w3-col m6 l8 w3-margin-top">
                                	<label>LEAN REMARKS (for wallet DR entry)</label>
                                	<input type="text" id="remarks" name="remarks" placeholder="REMARKS" class="w3-input w3-border w3-round">                                    
                                </div>
                                   
                                <div class="w3-col m12 w3-margin-top w3-right-align">
									<button onclick="check_values()" name="UpdateLean" id="UpdateLean" class="w3-button w3-round-small w3-right w3-blue display-none">UpdateLean</button>
                                	<a class="w3-button w3-round w3-blue" onclick="check_values()">Apply LEAN</a>
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
      	<p id="error-message">Do you want to apply lean amount to user?</p>
      </div>  
        <div class="w3-container" style="margin-bottom:10px;">
            <div class="w3-bar w3-center">
                <a id="ViewServlet" onclick="update_lean()" class="w3-button w3-green w3-round">Accept &amp; Confirm</a>
                <a id="ButtonFirst" onclick="document.getElementById('error-box').style.display='none';" class="w3-button w3-blue w3-round">OK</a>
                <a id="ButtonSecond" onclick="document.getElementById('error-box').style.display='none';" class="w3-button w3-orange w3-round">Do it later</a>
            </div> 
        </div> 
    </div>
  </div>
       
    <?php include_once('_footer.php');?>

</body>
</html> 
