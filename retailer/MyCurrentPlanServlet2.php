<!DOCTYPE html>
<html>
<head>
<?php include_once('_all-inner-pages-html-title.php'); ?>
<script>
function expand(exp_no)
{
	$(".address"+exp_no).slideToggle();
	$(".add"+exp_no).toggleClass("add-show");
}
var uids,curps,newps,inrs=0;
function upgrade_plan(userid,curp,newp,rs,wbal)
{
	if(rs<=wbal)
	{
		$("#error-title").html("Confirm Plan Upgrade");
		$("#error-message").html("Rs. "+rs+" will be deducted from your wallet as refundable security to activate this membership plan");
		$("#ButtonFirst").hide();
		$("#ButtonSecond").show();
		$("#ViewServlet").show();
		$("#error-box").show();
		uids=userid;
		curps=curp;
		newps=newp;
		inrs=rs;
	}
	else
	{
		$("#error-title").html("ALERT");
		$("#error-message").html("Insufficient Wallet Balance");
		$("#ButtonFirst").show();
		$("#ButtonSecond").hide();
		$("#ViewServlet").hide();
		$("#error-box").show();
	}
}
function upgrade_plan2()
{
	var loc=document.location.href;
	var msg="user id : "+uids+", current plan : "+curps+", new plan : "+newps+", rs: "+inrs;
	$.ajax({
		type: "POST",
		url: "../AjaxUpgradeUserPlan.php",
		data: {'userid': uids , 'curp': curps, 'newp':newps, 'rs':inrs, 'msg':msg },
		dataType: "json",
	 
		//if received a response from the server
		success: function( data, textStatus, jqXHR) {
			window.location.href=loc;
		}	 
	});
}
</script>
<script>
$(document).ready(function(){
	$(".search-data").click(function(){
		$(".table-search-filter").slideToggle();
	});
});
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
						if($my_current_plan==4 || $my_current_plan==5)
							echo "<script>window.location.href='MyCurrentPlansServlet';</script>";
						include_once('../zf-Plan.php');
						/**************************/
						$num_rec_per_page=100;
						if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
						$start_from = ($page-1) * $num_rec_per_page;
						/**************************/
						$s1=$s2=$s3=$s4="";
						$cond=" where plan_open_for_all=1 and plan_status=1 ";
						if(isset($_REQUEST['search']))
						{
							if(isset($_REQUEST['s1'])) $s1=mysql_real_escape_string($_REQUEST['s1']);
							if(isset($_REQUEST['s2'])) $s2=mysql_real_escape_string($_REQUEST['s2']);
							if(isset($_REQUEST['s3'])) $s3=mysql_real_escape_string($_REQUEST['s3']);
							if(isset($_REQUEST['s4'])) $s4=mysql_real_escape_string($_REQUEST['s4']);
							if($s1!=""){$cond.=" and user_id='$s1' ";}
							if($s2!=""){$cond.=" and user_name like '%$s2%' ";}
							if($s3!=""){$cond.=" and user_type='$s3' ";}
							if($s4!=""){$cond.=" and user_status='$s4' ";}
						}
						$total_records=show_plans_count(" $cond ");
						$plan_result=show_plans_data(" $cond ", $start_from, $num_rec_per_page);
						$qr="";//"&s1=$s1&s2=$s2&s3=$s3&s4=$s4&search=search";
						$i=0;
						$sname=show_plan_name($my_current_plan);
						$plan_1=$plan_2=$plan_3="";
						while($plan_rs=mysql_fetch_array($plan_result))
						{
							if($plan_rs['plan_id']==1)
							$plan_1=show_plan_details($plan_rs['plan_id']);
							if($plan_rs['plan_id']==2)
							$plan_2=show_plan_details($plan_rs['plan_id']);
							if($plan_rs['plan_id']==3)
							$plan_3=show_plan_details($plan_rs['plan_id']);
						}
						?>
                    	<div class="box-head">
                        	<h3>My Current Plan (<?php echo $sname;?>) <span class="w3-right w3-blue w3-center badges"><?php echo $total_records;?></span></h3>
                        </div>
						
                        <div class="w3-responsive">
                            <table class="w3-table-all" id="myTable" style="border:none;">
                                <tr class="w3-blue">
									<th>PLAN AND SERVICES</th>
									<th><?php echo $plan_1['plan_name'];?></th>
									<th><?php echo $plan_2['plan_name'];?></th>
									<th><?php echo $plan_3['plan_name'];?></th>
                                </tr>   
								<tr>
									<td>&nbsp;</td>
									<th><?php if($plan_1['plan_id']==$my_current_plan) {echo " ACTIVE ";} ?></th>
									<th>
										<?php 
										$p2=$plan_2['plan_id'];
										if($plan_2['plan_id']==$my_current_plan) {echo " ACTIVE ";} 
										else if($plan_2['plan_id']>$my_current_plan) 
										{
											$diffrs=0;
											$diffrs=$plan_2['plan_security']-$plan_1['plan_security'];
											echo "<a onclick='upgrade_plan(\"$logged_user_id\",\"$my_current_plan\",\"$p2\",\"$diffrs\")' class='w3-button w3-round w3-blue'>UPGRADE</a>";
										}
										?>
									</th>
									<th>
										<?php 
										$p3=$plan_3['plan_id'];
										if($plan_3['plan_id']==$my_current_plan) {echo " ACTIVE ";} 
										else if($plan_3['plan_id']>$my_current_plan) 
										{
											$diffrs=0;
											if($my_current_plan==$plan_1['plan_id'])
												$diffrs=$plan_3['plan_security']-$plan_1['plan_security'];
											if($my_current_plan==$plan_2['plan_id'])
												$diffrs=$plan_3['plan_security']-$plan_2['plan_security'];
											echo "<a onclick='upgrade_plan(\"$logged_user_id\",\"$my_current_plan\",\"$p3\",\"$diffrs\",\"$wbal\")' class='w3-button w3-round w3-blue'>UPGRADE</a>";
										}
										?>
									</th>
								</tr>
                                <tr>
									<td>Refundable Security</td>
									<td><?php echo $plan_1['plan_security'];?></td>
									<td><?php echo $plan_2['plan_security'];?></td>
									<td><?php echo $plan_3['plan_security'];?></td>
                                </tr>   
								<tr>
									<th colspan='4' class='w3-gray'>Money Remittence * <small>(18% GST extra)<small></th>
								</tr>
                                <tr>
									<td>Money Transfer (IMPS/NEFT)</td>
									<td><?php echo show_plan_mt_rates($plan_1['plan_id']);?></td>
									<td><?php echo show_plan_mt_rates($plan_2['plan_id']);?></td>
									<td><?php echo show_plan_mt_rates($plan_3['plan_id']);?></td>
                                </tr>   
                                <tr>
									<td>Account Verification</td>
									<td>4.24</td>
									<td>4.24</td>
									<td>4.24</td>
                                </tr>    
								<tr>
									<th colspan='4' class='w3-gray'>Prepaid Mobile Recharge <small>(Commission in %)</small></th>
								</tr>
								<?php
								$planservice_result=show_plan_com(102);
								while($planservice_rs=mysql_fetch_array($planservice_result))
								{
								?>
                                <tr>
									<td><?php echo show_operator_name2($planservice_rs['operator_id']);?></td>
									<td><?php echo $planservice_rs["plan_".$plan_1['plan_id']];?></td>
									<td><?php echo $planservice_rs["plan_".$plan_2['plan_id']];?></td>
									<td><?php echo $planservice_rs["plan_".$plan_3['plan_id']];?></td>
                                </tr>  
								<?php
								}
								?>    
								<tr>
									<th colspan='4' class='w3-gray'>DTH Recharge <small>(Commission in %)</small></th>
								</tr>
								<?php
								$planservice_result=show_plan_com(103);
								while($planservice_rs=mysql_fetch_array($planservice_result))
								{
								?>
                                <tr>
									<td><?php echo show_operator_name2($planservice_rs['operator_id']);?></td>
									<td><?php echo $planservice_rs["plan_".$plan_1['plan_id']];?></td>
									<td><?php echo $planservice_rs["plan_".$plan_2['plan_id']];?></td>
									<td><?php echo $planservice_rs["plan_".$plan_3['plan_id']];?></td>
                                </tr>  
								<?php
								}
								?>    
								<tr>
									<th colspan='4' class='w3-gray'>Postpaid Mobile Bill Payments <small>(Commission in %)</small></th>
								</tr>
								<?php
								$planservice_result=show_plan_com(106);
								while($planservice_rs=mysql_fetch_array($planservice_result))
								{
								?>
                                <tr>
									<td><?php echo show_operator_name2($planservice_rs['operator_id']);?></td>
									<td><?php echo $planservice_rs["plan_".$plan_1['plan_id']];?></td>
									<td><?php echo $planservice_rs["plan_".$plan_2['plan_id']];?></td>
									<td><?php echo $planservice_rs["plan_".$plan_3['plan_id']];?></td>
                                </tr>  
								<?php
								}/*
								?> 
								<tr>
									<th colspan='4' class='w3-gray'>Electricity Bill Payments <small>(Surcharges extra)</small></th>
								</tr>
								<?php
								$planservice_result=show_plan_sur(105);
								while($planservice_rs=mysql_fetch_array($planservice_result))
								{
								?>
                                <tr>
									<td><?php echo show_operator_name2($planservice_rs['operator_id']);?></td>
									<td><?php echo $planservice_rs["plan_".$plan_1['plan_id']];?></td>
									<td><?php echo $planservice_rs["plan_".$plan_2['plan_id']];?></td>
									<td><?php echo $planservice_rs["plan_".$plan_3['plan_id']];?></td>
                                </tr>  
								<?php
								}
								?> 
								<tr>
									<th colspan='4' class='w3-gray'>Water Bill Payments <small>(Surcharges extra)</small></th>
								</tr>
								<?php
								$planservice_result=show_plan_sur(117);
								while($planservice_rs=mysql_fetch_array($planservice_result))
								{
								?>
                                <tr>
									<td><?php echo show_operator_name2($planservice_rs['operator_id']);?></td>
									<td><?php echo $planservice_rs["plan_".$plan_1['plan_id']];?></td>
									<td><?php echo $planservice_rs["plan_".$plan_2['plan_id']];?></td>
									<td><?php echo $planservice_rs["plan_".$plan_3['plan_id']];?></td>
                                </tr>  
								<?php
								}
								?> 
								<tr>
									<th colspan='4' class='w3-gray'>Gas Bill Payments <small>(Surcharges extra)</small></th>
								</tr>
								<?php
								$planservice_result=show_plan_sur(114);
								while($planservice_rs=mysql_fetch_array($planservice_result))
								{
								?>
                                <tr>
									<td><?php echo show_operator_name2($planservice_rs['operator_id']);?></td>
									<td><?php echo $planservice_rs["plan_".$plan_1['plan_id']];?></td>
									<td><?php echo $planservice_rs["plan_".$plan_2['plan_id']];?></td>
									<td><?php echo $planservice_rs["plan_".$plan_3['plan_id']];?></td>
                                </tr>  
								<?php
								}
								?> 
								<tr>
									<th colspan='4' class='w3-gray'>Datacard Bill Payments <small>(Surcharges extra)</small></th>
								</tr>
								<?php
								$planservice_result=show_plan_sur(116);
								while($planservice_rs=mysql_fetch_array($planservice_result))
								{
								?>
                                <tr>
									<td><?php echo show_operator_name2($planservice_rs['operator_id']);?></td>
									<td><?php echo $planservice_rs["plan_".$plan_1['plan_id']];?></td>
									<td><?php echo $planservice_rs["plan_".$plan_2['plan_id']];?></td>
									<td><?php echo $planservice_rs["plan_".$plan_3['plan_id']];?></td>
                                </tr>  
								<?php
								}
								?> 
								<tr>
									<th colspan='4' class='w3-gray'>Landline/Broadband Bill Payments <small>(Surcharges extra)</small></th>
								</tr>
								<?php
								$planservice_result=show_plan_sur(113);
								while($planservice_rs=mysql_fetch_array($planservice_result))
								{
								?>
                                <tr>
									<td><?php echo show_operator_name2($planservice_rs['operator_id']);?></td>
									<td><?php echo $planservice_rs["plan_".$plan_1['plan_id']];?></td>
									<td><?php echo $planservice_rs["plan_".$plan_2['plan_id']];?></td>
									<td><?php echo $planservice_rs["plan_".$plan_3['plan_id']];?></td>
                                </tr>  
								<?php
								}
								?> 
								<tr>
									<th colspan='4' class='w3-gray'>Insurance Premium Payments <small>(Surcharges extra)</small></th>
								</tr>
								<?php
								$planservice_result=show_plan_sur(115);
								while($planservice_rs=mysql_fetch_array($planservice_result))
								{
								?>
                                <tr>
									<td><?php echo show_operator_name2($planservice_rs['operator_id']);?></td>
									<td><?php echo $planservice_rs["plan_".$plan_1['plan_id']];?></td>
									<td><?php echo $planservice_rs["plan_".$plan_2['plan_id']];?></td>
									<td><?php echo $planservice_rs["plan_".$plan_3['plan_id']];?></td>
                                </tr>  
								<?php
								}
								?> 
                                <?php */ ?>
                            </table>	
                        </div>
                    </div>
                </div>  
            </div>
        <!--</div>-->
    </section>
	
   <div id="error-box" class="w3-modal">
    <div class="w3-modal-content w3-animate-zoom w3-card-4 w3-round list-pop">
      <header class="w3-container w3-blue"> 
        <span onclick="document.getElementById('error-box').style.display='none';" class="w3-button w3-display-topright"><img src="../img/close.png" style="margin-bottom:0px;"></span>
        <h3 class="w3-center" id="error-title">Confirmation Plan Upgrade</h3> 
      </header> 
      <div class="w3-container w3-center">
      	<p id="error-message" class='w3-left-align'></p>
      	<p id="error-message2" class='w3-left-align display-none'><img src='../img/refresh.gif' height='50' align='right' />Please wait few seconds...<br>while we are upgrading your plan</p>
      </div> 
		<div class="w3-container" style="margin-bottom:10px;">
            <div class="w3-bar w3-center">
                <a id="ViewServlet" onclick="upgrade_plan2()" class="w3-button w3-green w3-round">Accept &amp; Confirm</a>
                <a id="ButtonFirst" onclick="document.getElementById('error-box').style.display='none';" class="w3-button w3-blue w3-round">OK</a>
                <a id="ButtonSecond" onclick="document.getElementById('error-box').style.display='none';" class="w3-button w3-orange w3-round">Do it later</a>
            </div> 
        </div>	  
    </div>
  </div>
       
    <?php include_once('_footer.php');?>

</body>
</html> 
