<!DOCTYPE html>
<html>
<head>
<?php include_once('_all-inner-pages-html-title.php'); ?>
<script>
var click=0;
function abcd(row_no)
{
	var req=$("#req"+row_no).val();
	var status=$("#status"+row_no).val();
	var remarks=$("#remarks"+row_no).val();
	var client=$("#client"+row_no).val();
	var amt=$("#amt"+row_no).val();
	
	click++;
	if(click==1)
	{
		$.ajax({
			type: "POST",
			url: "AjaxWalletClientRequestUpdateServlet",
			data: {'req': req , 'status': status , 'remarks': remarks , 'client': client , 'amt': amt },
			dataType: "json",
		 
			//if received a response from the server
			success: function( data, textStatus, jqXHR) {
				//our country code was correct so we have some information to display/
				//alert(data);
				window.location.reload();
				//window.location.href='WalletClientRequestsReceivedServlet';
			}	 
		});
	}
	else
	{
		alert("already processed");
	}
}
</script>
<script>
function expand(exp_no)
{
	$(".address"+exp_no).slideToggle();
	$(".add"+exp_no).toggleClass("add-show");
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

	<?php include_once('_header.php'); ?><meta http-equiv='refresh' content='30'>
    
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
						include_once('zf-WalletRequests.php');
						include_once('zf-Client.php');
						include_once('zf-Bank.php');
						/**************************/
						$num_rec_per_page=10;
						if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
						$start_from = ($page-1) * $num_rec_per_page;
						/**************************/
						$s1=$s2=$s3=$s4="";
						$cond=" where 1=1 and client_id!=1001 ";
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
						$total_records=show_requests_count($cond);
						$user_result=show_requests_data($cond, $start_from, $num_rec_per_page);
						$qr="&s1=$s1&s2=$s2&s3=$s3&s4=$s4&search=search";
						$i=0;
						?>
                    	<div class="box-head">
                        	<h3>WALLET REQUESTS RECEIVED FROM CLIENT <span class="w3-right w3-blue w3-center badges"><?php echo $total_records;?></span></h3>
                        </div>
                        <div class="table-div wh w3-left">
                        	<ul>
                            	<li class="table-div-head">
                                	<span>ID</span>
                                    <span>DEPOSIT DATE</span>
                                    <span>CLIENT NAME</span>
                                    <span>BANK NAME</span>
                                    <span>PAYMENT METHOD</span>
                                    <span>AMOUNT</span>
                                    <span>STATUS</span>
                                    <span>ACTION</span>
                                </li>
								<?php
								while($user_row=mysql_fetch_array($user_result))
								{
									$i++;	
									$request_status=$user_row['request_status'];
									$st_link="";
									if($request_status==1)
									{
										$request_status="<b class='w3-text-orange'>Received</b>";
										if($dist_bal>=$user_row['deposit_amount'])
										{
										$st_link="<input type='hidden' id='req$i' value='".$user_row['request_id']."' /><input type='hidden' id='client$i' value='".$user_row['client_id']."' /><input type='hidden' id='amt$i' value='".$user_row['deposit_amount']."' />
										<select class='w3-select w3-border w3-round' required id='status$i'>
											<option value=''>Choose your option</option>
											<option value='2'>Transferred</option>
											<option value='3'>Rejected</option>
										</select><br><br><br><input type='text' placeholder='REMARKS' class='w3-input w3-border w3-round' required id='remarks$i' /><br>
										<button id='updt$i' onclick=\"abcd($i)\" class=\"w3-button w3-blue w3-round\">Update Request</button>";
										}
										else
										{
											$st_link="<h1 class='w3-text-red'>Insufficient Funds</h1>";
										}
									}
									else if($request_status==2)
									{
										$request_status="<b class='w3-text-green'>Transferred</b>";
									}
									else if($request_status==3)
									{
										$request_status="<b class='w3-text-red'>Rejected</b>";
									}	
									else if($request_status==4)
									{
										$request_status="<b class='w3-text-blue'>Cancelled</b>";
									}	
									
									$payment_mode=$user_row['payment_mode'];
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
									
								?>
                                <li>
                                	<span><?php echo $user_row['request_id'];?></span>
                                	<span><?php echo $user_row['deposite_date'];?></span>
                                	<span><?php echo show_client_name($user_row['client_id']);?></span>
                                	<span><?php echo show_bank_name($user_row['bank_id']);?></span>
                                	<span><?php echo $payment_mode;?></span>
                                	<span><?php echo $user_row['deposit_amount'];?></span>
                                	<span><?php echo $request_status;?></span>
                                    <span><a onclick="expand('<?php echo $i;?>')" class="add-icon add<?php echo $i;?>"></a></span>
                                </li>
                                <li>
                                	<div class="address<?php echo $i;?> inner-add wh w3-left">
										<table class="wh">
											<tr>
												<td width="35%"valign="top">
													<p><strong>REQUEST DATE & TIME:-</strong> <?php echo $user_row['request_date'];?> at <?php echo $user_row['request_time'];?></p>
													<p><strong>CLIENT REMARKS:-</strong> <?php echo $user_row['client_remarks'];?></p>
													<p><strong>CLIENT TIME:-</strong> <?php echo $user_row['client_updates'];?></p>
												</td>
												<td width="35%" valign="top">
													<p><strong>REF NO:-</strong> <?php echo $user_row['ref_no'];?></p>
													<p><strong>SYSTEM REMARKS:-</strong> <?php echo $user_row['admin_remarks'];?></p>
													<p><strong>SYSTEM TIME:-</strong> <?php echo $user_row['admin_updates'];?></p>
												</td>
												<td class="w3-text-right" width="30%"valign="top">
													<?php echo $st_link;?>
												</td>
											</tr>
										</table>
                                    </div>
                                </li>
								<?php
								}
								?>
                            </ul>
                        </div>                        
                        
                    </div>
                </div>               
                
            </div>
        <!--</div>-->
    </section>
    
    <section class="wh w3-left w3-center w3-margin-top <?php if($total_records==0) echo "display-none";?>">
    	<div class="w3-row-padding">
        	<div class="w3-col m12">
            	<div class="w3-bar">
                  <a title="Jump to First Page" href='?page=1<?php echo $qr;?>' class='w3-button'><img src='img/pre-icon.png' style='margin-bottom:0px;'></a>
				<?php
				$total_pages = ceil($total_records / $num_rec_per_page);
				$pager=1;
				$cur_pos=$page;
				if($page-$pager>=2 && $page-$pager<=0)
					$pager=1;
				else
					$pager=$page-2;
				if($pager<0)
					$pager=1;
				
				$pre_pager=$pager-3;
				if($pre_pager>0)
				echo "<a title='Jump to Previous 5 Pages' href='?page=$pre_pager$qr' class='w3-button'><img src='img/pres-icon.png' style='margin-bottom:0px;'></a>";
				for(;$pager<=$total_pages && $pager<=$page+2;$pager++) 
				{ 
						$selection="";
						if($page==$pager)
							$selection=" w3-green";
						if($pager>0)
						echo "<a href='?page=$pager$qr' class='w3-button $selection'>$pager</a>";
				};
				$post_pager=$pager+2;
				if($post_pager<$total_pages)
				echo "<a title='Jump to Next 5 Pages' href='?page=$post_pager$qr' class='w3-button'><img src='img/nexts-icon.png' style='margin-bottom:0px;'></a>";
				?>
                  <a title="Jump to Last Page" href='?page=<?php echo $total_pages.$qr;?>' class='w3-button'><img src='img/next-icon.png' style='margin-bottom:0px;'></a>
                </div>
            </div>
    	</div>
    </section>
       
    <?php include_once('_footer.php');?>

</body>
</html> 
