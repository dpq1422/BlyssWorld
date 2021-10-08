<!DOCTYPE html>
<html>
<head>
<?php include_once('_all-inner-pages-html-title.php'); ?>
<script>
$(document).ready(function(){
	$("#welcome-message").show();
	//$("#it-head").show();
});
</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-126322670-12"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-126322670-12');
</script>
<!--
<script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script type="text/javascript">
window.onload = function () {
	var chart = new CanvasJS.Chart("chartContainer",
	{
		theme: "theme2",		
		data: [
		{       
			type: "pie", //pie//bar//line
			showInLegend: true,
			toolTipContent: "#percent % : {y}",
			yValueFormatString: "#/-",
			legendText: "{indexLabel}",
			dataPoints: [
				{  y: 4181563, indexLabel: "Haryana" },
				{  y: 2175498, indexLabel: "Punjab" },
				{  y: 3125844, indexLabel: "Jammu & Kashmir" },
				{  y: 1176121, indexLabel: "Himachal"},
				{  y: 1727161, indexLabel: "Chandigarh" },
			]
		}
		]
	});
	chart.render();
	
	var chart = new CanvasJS.Chart("chartContainer2",
	{
		theme: "theme2",		
		data: [
		{       
			type: "pie",
			showInLegend: true,
			toolTipContent: "#percent % : {y}",
			yValueFormatString: "#/-",
			legendText: "{indexLabel}",
			dataPoints: [
				{  y: 4181563, indexLabel: "State Bank of India" },
				{  y: 3125844, indexLabel: "ICICI Bank" },
				{  y: 2175498, indexLabel: "Punjab Natioal Bank" },
			]
		}
		]
	});
	chart.render();
	
	var chart = new CanvasJS.Chart("chartContainer3",
	{
		theme: "theme2",		
		data: [
		{       
			type: "pie",
			showInLegend: true,
			toolTipContent: "#percent % : {y}",
			yValueFormatString: "#/-",
			legendText: "{indexLabel}",
			dataPoints: [
				{  y: 4181563, indexLabel: "Cash" },
				{  y: 2175498, indexLabel: "IMPS" },
				{  y: 1158948, indexLabel: "NEFT/RTGS" },
				{  y: 1128454, indexLabel: "CDM" },
				{  y: 825844, indexLabel: "Cheque" },
				{  y: 525844, indexLabel: "DD" },
			]
		}
		]
	});
	chart.render();
}
</script>
-->
</head>
<body>

	<div id="it-head" class="w3-modal">
		<div class="w3-modal-content w3-animate-zoom w3-card-4 w3-round list-pop">
		  <header class="w3-container w3-blue"> 
			<span onclick="document.getElementById('it-head').style.display='none'" class="w3-button w3-display-topright"><img src="img/close.png" style="margin-bottom:0px;"></span>
			<h3 class="w3-center">Message from IT Head (Kuldeep)</h3> 
		  </header> 
		  <div class="w3-container w3-center">
			<p>Sonar reports are ready. ;-)</p>
		  </div>  
			<div class="w3-container" style="margin-bottom:10px;">
				<div class="w3-bar w3-center">
					<a onclick="document.getElementById('it-head').style.display='none'" class="w3-button w3-blue w3-round">Ok</a>
				</div> 
			</div> 
		</div>
	</div>

	<?php include_once('_header.php'); ?>

	<?php
		if(!isset($_REQUEST["u-$logged_user_id"]))
		{
			$dash_unm=explode(" ",$logged_user_name)[0];
			echo "<script>window.location.href='DashboardServlet?u-".$logged_user_id."=".$dash_unm."';</script>";
		}
//include_once('zf-remCom.php');
//remove_comm_all();
	?>
	
	<section class="boxes wh w3-left">
        
            <div class="w3-row-padding">
                <div class="w3-col m12">
                	<h4 class="heading wh w3-left"><span>NOTIFICATIONS</span></h4>
                </div>
            </div>
            <div class="w3-row-padding w3-margin-top">
            	<div class="w3-col m6 wow bounceIn">
                	<div class="table-box wh w3-left">
						<?php
						include_once('zf-TicketReceived.php');
						include_once('zf-User.php');
						$cond1=" where ticket_status in(1,2,3) ";
						$total_records1=show_tickets_count($cond1);
						$user_result1=show_tickets_data($cond1);
						?>
                    	<div class="box-head">
                        	<h3>OPEN SUPPORT TICKETS <span class="w3-right w3-blue w3-center badges"><?php echo $total_records1;?></span></h3>
                        </div>
                        <div class="w3-responsive">
                            <table class="w3-table-all" id="myTable">
                                <tr class="table-head">
                                  <th onclick="sortTable(0)">Ticket No</th>
                                  <th onclick="sortTable(1)">Date/Time</th>
                                  <th onclick="sortTable(2)">User Name</th>
                                  <th onclick="sortTable(3)">Subject</th>
                                  <!--<th onclick="sortTable(4)">Status</th>-->
                                </tr>
								<?php
								$i=0;
								while($user_row1=mysql_fetch_array($user_result1))
								{
									$i++;	
									$ticket_status=$user_row1['ticket_status'];
									$ticket_type=$user_row1['ticket_type'];
									if($ticket_status==1)
									{
										$ticket_status="<b class='w3-text-orange'>Opened</b>";
									}
									else if($ticket_status==2)
									{
										$ticket_status="<b class='w3-text-blue'>In-Progress</b>";
									}
									else if($ticket_status==3)
									{
										$ticket_status="<b class='w3-text-red'>Re-Opened</b>";
									}
									else if($ticket_status==4)
									{
										$ticket_status="<b class='w3-text-green'>Closed</b>";
									}
									
									if($ticket_type==1)
									{
										$ticket_type="Money Transfer Dispute";
									}
									else if($ticket_type==2)
									{
										$ticket_type="Technical Support";
									}
									else if($ticket_type==3)
									{
										$ticket_type="Sales Enquiry";
									}
									else if($ticket_type==4)
									{
										$ticket_type="Billing Enquiry";
									}
									else if($ticket_type==5)
									{
										$ticket_type="Commission Issue";
									}
									
									$uid1="";
									$uid1=show_user_name($user_row1['user_id']);
									$uid1=$uid1."<br>(".$user_row1['user_id'].")";
								?>
                                <tr>
                                  <td><?php echo $user_row1['ticket_id'];?></td>
                                  <td><?php echo $user_row1['date_time'];?></td>
                                  <td><?php echo $uid1;?></td>
                                  <td><?php echo $ticket_type;?></td>
                                  <!--<td><?php echo $ticket_status;?></td>-->
                                </tr>
								<?php
								}
								?>
								<tr><td colspan='4'><a class='w3-button w3-round w3-right w3-green' href="TicketsReceivedServlet">Show All</a></td></tr>
                            </table>	
                        </div>

                    </div>
                </div>
                
                <div class="w3-col m6 wow bounceIn">
                	<div class="table-box wh w3-left">
						<?php
						include_once('zf-WalletRequestReceived.php');
						include_once('zf-User.php');
						include_once('zf-Bank.php');
						$cond2=" where request_status=1 ";
						$total_records2=show_requests_count($cond2);
						$user_result2=show_requests_data($cond2);
						?>
                    	<div class="box-head">
                        	<h3>OPEN WALLET REQUESTS <span class="w3-right w3-blue w3-center badges"><?php echo $total_records2;?></span></h3>
                        </div>
                        <div class="w3-responsive">
                            <table class="w3-table-all">
                                <tr class="table-head">
                                  <th>Request No</th>
                                  <th>Date/Time</th>
                                  <th>User Name</th>
                                  <th>Bank/Method</th>
                                  <th>Amount</th>
                                </tr>
								<?php
								$i=0;
								while($user_row2=mysql_fetch_array($user_result2))
								{
									$i++;	
									$request_status=$user_row2['request_status'];
									$st_link="";
									if($request_status==1)
									{
										$request_status="<b class='w3-text-orange'>Received</b>";
									}
									else if($request_status==2)
									{
										$request_status="<b class='w3-text-green'>Transferred</b>";
									}
									else if($request_status==3)
									{
										$request_status="<b class='w3-text-red'>Rejected</b>";
									}	
									
									$payment_mode=$user_row2['payment_mode'];
									if($payment_mode==1)
									{
										$payment_mode="<b class='w3-text-orange'>DD</b>";
									}
									else if($payment_mode==2)
									{
										$payment_mode="<b class='w3-text-orange'>Cheque</b>";
									}
									else if($payment_mode==3)
									{
										$payment_mode="<b class='w3-text-green'>NEFT/RTGS</b>";
									}
									else if($payment_mode==4)
									{
										$payment_mode="<b class='w3-text-green'>IMPS</b>";
									}
									else if($payment_mode==5)
									{
										$payment_mode="<b class='w3-text-red'>Cash</b>";
									}
									else if($payment_mode==6)
									{
										$payment_mode="<b class='w3-text-red'>CDM</b>";
									}
									
									$uid2="";
									$uid2=show_user_name($user_row2['user_id']);
									$uid2=$uid2."<br>(".$user_row2['user_id'].")";
									
									$bm="";
									$bm=show_bank_name($user_row2['bank_id']);
									$bm=$bm."<br>".$payment_mode;
								?>
                                <tr>
                                  <td><?php echo $user_row2['request_id'];?></td>
                                  <td><?php echo $user_row2['request_date']." ".$user_row2['request_time'];?></td>
                                  <td><?php echo $uid2;?></td>
                                  <td><?php echo $bm;?></td>
                                  <td><?php echo $user_row2['deposit_amount'];?></td>
                                </tr>
								<?php
								}
								?>
								<tr><td colspan='5'><a class='w3-button w3-round w3-right w3-green' href="WalletRequestsReceivedServlet">Show All</a></td></tr>
                            </table>	
                        </div>

                    </div>
                </div>
            </div>
        
    </section>
    
    <section class="boxes wh w3-left">
        
            <div class="w3-row-padding">
                <div class="w3-col m12">
                	<h4 class="heading wh w3-left"><span>ADMIN WALLET STATUS</span></h4>
                </div>
            </div>
			<?php
			include_once('zf-DashboardAdmin.php');
			$aws=admin_wallet_status();
			?>
            <div class="w3-row-padding w3-margin-top">
            	<div class="w3-col m3  wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left">
                        	<h3>OPENING BALANCE</h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span class="font-24"><?php echo $aws[0];?></span>
                        </div>
                    </div>
                </div>  
                
                <div class="w3-col m3 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left">
                        	<h3>WALLET UPDATE</h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span class="font-24"><?php echo $aws[1];?></span>
                        </div>
                    </div>
                </div>         
                
                <div class="w3-col m3 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left">
                        	<h3>WALLET TRANSFER</h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span class="font-24"><?php echo $aws[2];?></span>
                        </div>
                    </div>
                </div>   
                
                <div class="w3-col m3 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left">
                        	<h3>CURRENT BALANCE</h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span class="font-24"><?php echo $aws[3];?></span>
                        </div>
                    </div>
                </div>              
            </div>
    </section>
	
	<?php
	if($logged_user_id==$main_admin)
	{
	?>
    <section class="boxes wh w3-left">
        
            <div class="w3-row-padding">
                <div class="w3-col m12">
                	<h4 class="heading wh w3-left"><span>REALTIME ADMIN & USER WALLET</span></h4>
                </div>
            </div>
			<?php
			//update_all_wallet();
			$realtime_bal=show_rt_balances();
			$realtime_bal=number_format((float)$realtime_bal, 2, '.', '');
			$dummy_bal=show_dummy_balances();
			$dummy_bal=number_format((float)$dummy_bal, 2, '.', '');
			$admin_bal=$dist_bal;
			$admin_bal=number_format((float)$admin_bal, 2, '.', '');
			$team_bal=show_team_balances();
			$team_bal=number_format((float)$team_bal, 2, '.', '');
			$retailer_bal=show_retailer_balances();
			$retailer_bal=number_format((float)$retailer_bal, 2, '.', '');
			$distribution_bal=show_dist_balances();
			$comp_wallet=show_user_balance($wallet_gsttopay)+show_user_balance($wallet_tdstopay);
			$distribution_bal+=$comp_wallet;
			$distribution_bal=number_format((float)$distribution_bal, 2, '.', '');
			$difference_bal=$realtime_bal-$admin_bal-$team_bal-$retailer_bal-$distribution_bal;
			$difference_bal=number_format((float)$difference_bal, 2, '.', '');
			
			$realtime_bal2=$realtime_bal-$dummy_bal;
			$realtime_bal2=number_format((float)$realtime_bal2, 2, '.', '');
			$dummy_bal2=$dummy_bal/100000;
			
			$rf_txn=rf_txn();
			
			$ip_txn=ip_txn();
			
			$gapper=$rf_txn[1]+$rf_txn[4]+$ip_txn[1]+$ip_txn[4];
			$gapper=number_format((float)$gapper, 2, '.', '');
			
			$string_class="";
			$gapper_diff=$difference_bal-$gapper;
			$gapper_diff=number_format((float)$gapper_diff, 2, '.', '');
			if($gapper_diff==0)
			$string_class=" w3-green ";
			else
			$string_class=" w3-red ";
		
			if($gapper_diff!=0)
				$gapper_diff=" <b class='w3-small'>($gapper_diff)</b> ";
			else
				$gapper_diff="";
			
			$gapper_diff="";///////////make it comment later
			?>
            <div class="w3-row-padding w3-margin-top">
            	<div class="w3-col m2 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left">
                        	<h3>REALTIME</h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span class="font-24"><?php echo $dummy_bal2."L ".$realtime_bal2;?></span>
                        </div>
                    </div>
                </div>  
                
                <div class="w3-col m2 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left">
                        	<h3>ADMIN</h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span class="font-24"><?php echo $admin_bal;?></span>
                        </div>
                    </div>
                </div>      
                
                <div class="w3-col m2 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left">
                        	<h3>TEAM</h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span class="font-24"><?php echo $team_bal;?></span>
                        </div>
                    </div>
                </div>          
                
                <div class="w3-col m2 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left">
                        	<h3>RETAILERS</h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span class="font-24"><?php echo $retailer_bal;?></span>
                        </div>
                    </div>
                </div>          
                
                <div class="w3-col m2 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left">
                        	<h3>DISTRIBUTION</h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span class="font-24 w3-text-green"><?php echo $distribution_bal;?></span>
                        </div>
                    </div>
                </div>          
                
                <div class="w3-col m2 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left">
                        	<h3>DIFFERENCE</h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center <?php echo $string_class;?>">
                        	<span class="font-24 w3-text-white"><?php echo $difference_bal.$gapper_diff;?></span>
                        </div>
                    </div>
                </div>        
            </div>
       
    </section>
	<?php
	}
	?>
	
	<?php include_once('_DashboardWelcomeMessage.php');?>
       
    <?php include_once('_footer.php');?>
    
	<?php
	//if($logged_user_id!=$main_admin)
	echo "<meta http-equiv='refresh' content='15'>";
	?>

</body>
</html> 
