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
	$("#JoinProgram").click();
}
function check_values() {
	var utype = document.getElementById("aggree");
	var error_message="";
	
	if(utype.checked!=true)	
	var error_message="Please accept terms and conditions to join Refer and Earn Loyalty Program.";
	
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
		$("#error-message").html("Have you carefully read terms and conditions?");
		$("#ButtonFirst").hide();
		$("#ButtonSecond").show();
		$("#ViewServlet").show();
		$("#error-box").show();
		return true;
	}
}
</script>  
<script>
function accept_btn()
{
	var utype = document.getElementById("aggree");
	if(utype.checked)
	{
		$('#acpt-btn').show();
	}
	else
	{
		$('#acpt-btn').hide();
	}
}
</script>

</head>
<body>

	<?php include_once('_header.php'); ?>
	<?php if($kinf!=3) { echo "<script>window.location.href='DashboardServlet';</script>"; }?>
    
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
                        	<h3>Refer and Earn Loyalty Program</h3>
                        </div>
						<?php
						if(isset($_POST['JoinProgram']))
						{
							include_once('../zc-session-admin.php');
							include_once('../zf-User.php');
							join_affiliate_program($logged_user_id);
							echo "<script>window.location.href='ReferAndEarn';</script>";
						}
						include_once('../zf-User.php');
						$ref_val=show_affiliate_program($logged_user_id);
						if($ref_val==0)
						{
						?>
                        <form class="wh w3-left" method="post">
                        	<div class="w3-row-padding w3-margin-bottom"> 
								
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>User ID</label>	
                                	<input type="text" value="<?php echo $logged_user_id;?>" placeholder="User ID" disabled class="w3-input w3-border w3-round">                                    
                                </div>
                            	                      	
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>User Name</label>
                                	<input type="text" value="<?php echo $logged_user_name;?>" placeholder="User Name" disabled class="w3-input w3-border w3-round">                                    
                                </div>
                                
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>User Type</label>	
                                	<input type="text" value="<?php echo $logged_user_typename;?>" placeholder="User Type" disabled class="w3-input w3-border w3-round">                                    
                                </div>
                                
                                <div class="w3-col m6 l12 w3-margin-top">
                                	<h3>Refer and Earn Loyalty Program : Terms and Conditions</h3>
									<p>
Blyss Refer & Earn Loyalty programme is proven Game Changer in the B2B Service Industry. <br><br>

Blyss Fintech Gives an opportunity to all its precious retailers to Earn Monthly Incentive up to Rs. 2,50,000/-  while working with your Mainstream work. After signing up with Refer & Earn Loyalty programme, you will get a Referral Code. <br><br>

You can invite your friends & other retailers through this referral code, any of your friends when signed up through this referral code will associate under you. These Referral friends after joining will be called Affiliates & earn you incentive on transactions performed by them. <br><br>

<b>Incentive Scheme:</b><br>
Affiliates at Level 1 -&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 10 % of Service Charge<br>
Affiliates at Level 2 -&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 5  % of Service Charge<br>
Affiliates at Level 3 -&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 2.5 % of Service Charge<br>
Affiliates at Level 4 -&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 2.5 % of Service Charge<br><br>

Start vetting your Referral Network Today. Earn Huge Incentives!!!
									</p>
                                </div>
                                
                                <div class="w3-col m6 l12 w3-margin-top">
                                	<input type="checkbox" onchange="accept_btn()" name="aggree" id="aggree" class="w3-check w3-border w3-round"> I here by accept all terms and conditions to join Refer and Earn Loyalty Program.
                                </div>
                                   
                                <div id="acpt-btn" class="w3-col m12 w3-margin-top w3-right-align display-none">
									<button onclick="check_values()" name="JoinProgram" id="JoinProgram" class="w3-button w3-round-small w3-right w3-blue display-none">JOIN</button>
                                	<a class="w3-button w3-round w3-blue" onclick="check_values()">Join Program</a>
                                </div>                              
                        	</div>
                        </form>
						<?php
						}
						else
						{
							include_once('../zf-DashboardRetailerAffiliate.php');
							$joined_level_1=show_joined_level($logged_user_id,1);
							$joined_level_2=show_joined_level($logged_user_id,2);
							$joined_level_3=show_joined_level($logged_user_id,3);
							$joined_level_4=show_joined_level($logged_user_id,4);
							$totalj=$joined_level_1+$joined_level_2+$joined_level_3+$joined_level_4;
							
							$txn_level_1=show_txn_level($logged_user_id,1)+show_txn_level2($logged_user_id,1);
							$txn_level_2=show_txn_level($logged_user_id,2)+show_txn_level2($logged_user_id,2);
							$txn_level_3=show_txn_level($logged_user_id,3)+show_txn_level2($logged_user_id,3);
							$txn_level_4=show_txn_level($logged_user_id,4)+show_txn_level2($logged_user_id,4);
							$totalt=$txn_level_1+$txn_level_2+$txn_level_3+$txn_level_4;
							
							$earn_level_1=show_earn_level($logged_user_id,1)+show_earn_level2($logged_user_id,1);
							$earn_level_2=show_earn_level($logged_user_id,2)+show_earn_level2($logged_user_id,2);
							$earn_level_3=show_earn_level($logged_user_id,3)+show_earn_level2($logged_user_id,3);
							$earn_level_4=show_earn_level($logged_user_id,4)+show_earn_level2($logged_user_id,4);
							$totale=$earn_level_1+$earn_level_2+$earn_level_3+$earn_level_4;
							
							$joined_level_1=number_format((float)$joined_level_1, 0, '.', '');
							$joined_level_2=number_format((float)$joined_level_2, 0, '.', '');
							$joined_level_3=number_format((float)$joined_level_3, 0, '.', '');
							$joined_level_4=number_format((float)$joined_level_4, 0, '.', '');
							$totalj=number_format((float)$totalj, 0, '.', '');
							
							$txn_level_1=number_format((float)$txn_level_1, 0, '.', '');
							$txn_level_2=number_format((float)$txn_level_2, 0, '.', '');
							$txn_level_3=number_format((float)$txn_level_3, 0, '.', '');
							$txn_level_4=number_format((float)$txn_level_4, 0, '.', '');
							$totalt=number_format((float)$totalt, 0, '.', '');
							
							$earn_level_1=number_format((float)$earn_level_1, 2, '.', '');
							$earn_level_2=number_format((float)$earn_level_2, 2, '.', '');
							$earn_level_3=number_format((float)$earn_level_3, 2, '.', '');
							$earn_level_4=number_format((float)$earn_level_4, 2, '.', '');
							$totale=number_format((float)$totale, 2, '.', '');
							/*
							$earn_level_1=number_format((float)$earn_level_1, 5, '.', '');
							$earn_level_2=number_format((float)$earn_level_2, 5, '.', '');
							$earn_level_3=number_format((float)$earn_level_3, 5, '.', '');
							$earn_level_4=number_format((float)$earn_level_4, 5, '.', '');
							$totale=number_format((float)$totale, 5, '.', '');
							*/
						?>
                        	<div class="w3-row-padding w3-margin-bottom"> 
								<div class="w3-col m6 l4 w3-margin-top mycolor">
									This is your referal link to join other users.
								</div>
								<div class="w3-col m6 l4 w3-margin-top mycolor">
									<a class='w3-text-black' target='_blank' href='https://blysspay.com/RegisterServlet?join=<?php echo $logged_user_id;?>'><b>https://blysspay.com/RegisterServlet?join=<?php echo $logged_user_id;?></b></a>
								</div>
								<div class="w3-col m6 l4 w3-margin-top mycolor">
									Please select this link and share with your friend circle.
								</div>
								<div class="w3-col m6 l4 w3-margin-top">
									<table class="w3-table-all" id="myTable">
										<tr class="table-head"><th colspan='2'>JOININGS</th></tr>
										<tr>
											<td>Retailers joined at level 1</td>
											<td align='right'><?php echo $joined_level_1;?></td>
										</tr>
										<tr>
											<td>Retailers joined at level 2</td>
											<td align='right'><?php echo $joined_level_2;?></td>
										</tr>
										<tr>
											<td>Retailers joined at level 3</td>
											<td align='right'><?php echo $joined_level_3;?></td>
										</tr>
										<tr>
											<td>Retailers joined at level 4</td>
											<td align='right'><?php echo $joined_level_4;?></td>
										</tr>
										<tr class='table-head'>
											<th align='left'>TOTAL</th>
											<td align='right'><?php echo $totalj;?></td>
										</tr>
									</table>
								</div>
								<div class="w3-col m6 l4 w3-margin-top">
									<table class="w3-table-all" id="myTable">
										<tr class="table-head"><th colspan='2'>TRANSACTIONS</th></tr>
										<tr>
											<td>Transactions at level 1</td>
											<td align='right'><?php echo $txn_level_1;?></td>
										</tr>
										<tr>
											<td>Transactions at level 2</td>
											<td align='right'><?php echo $txn_level_2;?></td>
										</tr>
										<tr>
											<td>Transactions at level 3</td>
											<td align='right'><?php echo $txn_level_3;?></td>
										</tr>
										<tr>
											<td>Transactions at level 4</td>
											<td align='right'><?php echo $txn_level_4;?></td>
										</tr>
										<tr class='table-head'>
											<th align='left'>TOTAL</th>
											<td align='right'><?php echo $totalt;?></td>
										</tr>
									</table>
								</div>
								<div class="w3-col m6 l4 w3-margin-top">
									<table class="w3-table-all" id="myTable">
										<tr class="table-head"><th colspan='2'>EARNINGS</th></tr>
										<tr>
											<td>Earnings from level 1</td>
											<td align='right'><?php echo $earn_level_1;?></td>
										</tr>
										<tr>
											<td>Earnings from level 2</td>
											<td align='right'><?php echo $earn_level_2;?></td>
										</tr>
										<tr>
											<td>Earnings from level 3</td>
											<td align='right'><?php echo $earn_level_3;?></td>
										</tr>
										<tr>
											<td>Earnings from level 4</td>
											<td align='right'><?php echo $earn_level_4;?></td>
										</tr>
										<tr class='table-head'>
											<th align='left'>TOTAL</th>
											<td align='right'><?php echo $totale;?></td>
										</tr>
									</table>
								</div>
							</div>
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
      	<p id="error-message">Do you want to change password?</p>
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
