<!DOCTYPE html>
<html>
<head>
<?php include_once('_all-inner-pages-html-title.php'); ?>
<script>
function prints(multiple)
{
		window.open('prints.php?result='+multiple,'Print Receipt','directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=600,height=800');
}
function printers(multiple)
{
		window.open('prints.php?result='+multiple,'Print Receipt','directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=600,height=800');
		//window.open('printers.php?result='+multiple,'Print Receipt','directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=600,height=800');
}
function expand(exp_no)
{
	$(".address"+exp_no).slideToggle();
	$(".add"+exp_no).toggleClass("add-show");
}
function recheck5(order,txnst,row)
{
	$("#error-message").html($("#error-message").html()+"<br>for <b>order no. : "+order+"</b>");
	$("#error-box").show();
	var loc=document.location.href;
	loc=loc.split("&selectedrow=")[0];
	$.ajax({
		type: "POST",
		url: "../AjaxCheckOrderStatus5.php",
		data: {'order': order , 'txnst': txnst },
		dataType: "json",
	 
		//if received a response from the server
		success: function( data, textStatus, jqXHR) {
			locs=loc.split("?");
			if(locs.length==1)
				window.location.href=loc+'?1=1&selectedrow='+row;
			else
				window.location.href=loc+'&selectedrow='+row;
		}	 
	});
}
</script>
<script>
$(document).ready(function(){
	var locs=document.location.href;
	locs=locs.split('&selectedrow=');
	if(locs.length!=1)
	{
		expand(locs[1]);
	}
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
						include_once('../zf-TxnService1Retailer.php');
						/**************************/
						$num_rec_per_page=10;
						if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
						$start_from = ($page-1) * $num_rec_per_page;
						/**************************/
						$s1=$s2=$s3=$s4=$s5="";
						$cond=" where 1=1 and retailer_id='$logged_user_id' ";
						if(isset($_REQUEST['search']))
						{
							if(isset($_REQUEST['s1'])) $s1=mysql_real_escape_string($_REQUEST['s1']);
							if(isset($_REQUEST['s2'])) $s2=mysql_real_escape_string($_REQUEST['s2']);
							if(isset($_REQUEST['s3'])) $s3=mysql_real_escape_string($_REQUEST['s3']);
							if(isset($_REQUEST['s4'])) $s4=mysql_real_escape_string($_REQUEST['s4']);
							if(isset($_REQUEST['s5'])) $s5=mysql_real_escape_string($_REQUEST['s5']);
							if($s1!=""){$cond.=" and txn_id='$s1' ";}
							if($s2!=""){$cond.=" and txn_id in(select txn_id from $bankapi_child_txn.txn_mt_child where order_id='$s2' and user_id='$logged_user_id') ";}
							if($s3!=""){$cond.=" and date(date_time) ='$s3' ";}
							if($s4!=""){$cond.=" and sender='$s4' ";}
							if($s5!=""){$cond.=" and racc='$s5' ";}
						}
						$total_records=show_txn_count($cond);
						$user_result=show_txn_data($cond, $start_from, $num_rec_per_page);
						$qr="&s1=$s1&s2=$s2&s3=$s3&s4=$s4&s5=$s5&search=search";
						$i=0;
						?>
                    	<div class="box-head">
                        	<h3>TRANSACTIONS - Domestic Money Transfer <span class="w3-right w3-blue w3-center badges"><?php echo $total_records;?></span></h3>
                        </div>
						<div class="table-search-filter wh w3-left">
							<form class="wh w3-left" method="get">
								<ul>
                                    <li>
										<label>Txn ID</label>
                                        <input name="s1" id="s1" onclick="clrval()" value="<?php echo $s1;?>" type="number" placeholder="Txn ID" class="w3-input w3-border w3-round">
                                    </li>
                                    <li>
										<label>Order Id</label>
                                        <input name="s2" id="s2" onclick="clrval()" value="<?php echo $s2;?>" type="number" placeholder="Order Id" class="w3-input w3-border w3-round">
                                    </li>
                                    <li>
										<label>Date</label>
                                        <input name="s3" id="s3" onclick="clrval()" value="<?php echo $s3;?>" type="date" placeholder="Date" class="w3-input w3-border w3-round">
                                    </li>
                                    <li>
										<label>Sender No</label>
                                        <input name="s4" id="s4" onclick="clrval()" value="<?php echo $s4;?>" type="number" placeholder="Sender No" class="w3-input w3-border w3-round">
                                    </li>
                                    <li>
										<label>Account No</label>
                                        <input name="s5" id="s5" onclick="clrval()" value="<?php echo $s5;?>" type="number" placeholder="Account No" class="w3-input w3-border w3-round">
                                    </li>
                                    <li>
										<label>&nbsp;</label>
										<button name='search' value='search' class="w3-button w3-blue w3-round">Search</button>
                                    </li> 
                                    <li>
										<label>&nbsp;</label>
										<a href="DownloadUserTxnDmtServlet?1=1<?php echo $qr;?>" class="w3-button w3-green w3-round">Download Excel</a>
                                    </li>                                       
                                </ul>
                            </form>
                        </div>
                        <div class="table-div wh w3-left">
                        	<ul>
                            	<li class="table-div-head">
                                	<span>TXN ID</span>
                                    <span>DATE</span>
                                    <span>TXN TYPE</span>
                                    <span>SENDER</span>
                                    <span>PRE BAL</span>
                                    <span>AMOUNT</span>
                                    <span>CHARGES</span>
                                    <span>BALANCE</span>
                                    <span>ACTION</span>
                                </li>
								<?php
								while($user_row=mysql_fetch_array($user_result))
								{
									
									$i++;
									$channel=$user_row['source'];
									$method=$user_row['method'];
									$txn_type="";
									$channel="Channel $channel";
									if($user_row['amount']==5 && $user_row['charges']==0)
										$txn_type="<b class='w3-text-orange'>Account Verification</b>";
									else
										$txn_type="<b class='w3-text-green'>Money Transfer</b>";
									if($method==1)
										$method="NEFT";
									else
										$method="IMPS";
									$txn_id=$user_row['txn_id'];
								?>
                                <li>
                                	<span><?php echo $txn_id;?></span>
                                    <span><?php echo $user_row['date_time'];?></span>
                                    <span><?php echo $txn_type;?></span>
                                    <span><?php echo $user_row['sender'];?></span>
                                    <span><?php echo $user_row['pre_bal'];?></span>
                                    <span><?php if($user_row['type']=="1")echo $user_row['amount']; else echo $user_row['com_charged'];?></span>
                                    <span><?php if($user_row['type']=="1")echo $user_row['com_charged']; else echo $user_row['amount'];?></span>
                                    <span><?php echo $user_row['post_bal'];?></span>
                                    <span><a onclick="expand('<?php echo $txn_id;?>')" class="add-icon add<?php echo $txn_id;?>"></a></span>
                                </li>
                                <li>
                                	<div class="address<?php echo $txn_id;?> inner-add wh w3-left">
                                        <p><strong>DETAILS:-</strong></p>
										<table width='100%'>
											<tr>
												<th width='15%'>Sender Number:- </th>
												<td width='15%'><?php echo $user_row['sender'];?></td>
												<td width='5%'></td>
												<th width='15%'>Receiver Name:- </th>
												<td width='15%'><?php echo $user_row['rname'];?></td>
												<td width='5%'></td>
												<th width='15%'>Bank Name:- </th>
												<td width='15%'><?php echo $user_row['rbname'];?></td>
											</tr>
											<tr>
												<th>Sender Name:- </th>
												<td><?php echo $user_row['sname'];?></td>
												<td></td>
												<th>Method:- </th>
												<td><?php echo $method;?></td>
												<td></td>
												<th>Account Number:- </th>
												<td><?php echo $user_row['racc'];?></td>
											</tr>
											<tr><td colspan="8"><hr></td></tr>
											<tr>
												<th>Order ID</th>
												<th>Amount</th>
												<td></td>
												<th>Charges</th>
												<th>TID<?php if($mycrpl==6) echo "/UR ID";?></th>
												<td></td>
												<th>STATUS</th>
												<th>Bank Ref.No.</th>
											</tr>
											<?php
											$txn_result=show_txn_order_data(" where txn_id='$txn_id' ");
											while($txn_row=mysql_fetch_array($txn_result))
											{
												$txn_status2=$txn_status=$txn_row['order_status'];
												$bank_ref_no="";
												if($txn_status==0)
												{
													$txn_status="Not Initiated";
												}
												else if($txn_status==1)
												{
													$txn_status="<b class='w3-text-blue'>Initiated</b>";
												}
												else if($txn_status==2)
												{
													$txn_status="<b class='w3-text-green'>Success</b>";
													$bank_ref_no=$txn_row['bank_ref_no'];
												}
												else if($txn_status==3)
												{
													$txn_status="<b class='w3-text-blue'>Response Awaited</b>";
												}
												else if($txn_status==4 || $txn_status==-4)
												{
													$txn_status="<b class='w3-text-red'>Refund Pending</b>";
												}
												else if($txn_status==5)
												{
													$txn_status="<b class='w3-text-blue'>Refunded</b>";
												}
												else
												{
													$txn_status="<b class='w3-text-blue'>In Progress</b>";
												}
												$recheck="";
												$dt1=strtotime($txn_row['created_on']);
												$dt2=time();
												$oidcheck=$txn_row['order_id'];
												if($txn_row['source']==5 && $txn_status2>-3 && $txn_status2!=5 && $dt2-$dt1<=2592000 && $txn_row['bank_ref_no']!=4321)
												{
													$oidcheck=$txn_row['order_id'];
													$recheck=" &nbsp;<img title='Re-Check Status of Order $oidcheck' src='../img/refresh-icon.png' onclick='recheck5(\"$oidcheck\",\"$txn_status2\",\"$txn_id\")'>";
												}
											?>
											<tr>
												<td><?php echo $txn_row['order_id'];?></td>
												<td><?php if($txn_row['type']=="1")echo $txn_row['amount']; else echo $txn_row['com_charged'];?></td>
												<td></td>
												<td><?php if($txn_row['type']=="1")echo $txn_row['com_charged']; else echo $txn_row['amount'];?></td>
												<td><?php echo $txn_row['mid'];?><?php if($mycrpl=="6") {echo "/<b class='w3-text-green'>".$txn_row['api_txn_no']."</b>";}?></td>
												<td></td>
												<td><?php echo $txn_status.$recheck;?> </td>
												<td><?php echo $bank_ref_no;?></td>
											</tr>
											<?php
											}
											?>
											<tr>
												<td colspan='7'></td>
												<td align='left'>
												<?php
												if($user_row['pre_bal']!=$user_row['post_bal'] && $user_row['amount']>51)
												{
													if($user_row['charges']!=0 && $user_row['com_earned']==$user_row['charges'])
													{
												?>
															<img src='../img/print.png' 
															onclick='printers("<?php echo $user_row['txn_id'];?>")' style='margin:-2px 0px;' height='16' title='Print'/>
												<?php
													}
													else
													{
												?>
															<img src='../img/print.png' 
															onclick='prints("<?php echo $user_row['txn_id'];?>")' style='margin:-2px 0px;' height='16' title='Print'/>
												<?php
													}
												}
												?>
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
                  <a title="Jump to First Page" href='?page=1<?php echo $qr;?>' class='w3-button'><img src='../img/pre-icon.png' style='margin-bottom:0px;'></a>
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
				echo "<a title='Jump to Previous 5 Pages' href='?page=$pre_pager$qr' class='w3-button'><img src='../img/pres-icon.png' style='margin-bottom:0px;'></a>";
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
				echo "<a title='Jump to Next 5 Pages' href='?page=$post_pager$qr' class='w3-button'><img src='../img/nexts-icon.png' style='margin-bottom:0px;'></a>";
				?>
                  <a title="Jump to Last Page" href='?page=<?php echo $total_pages.$qr;?>' class='w3-button'><img src='../img/next-icon.png' style='margin-bottom:0px;'></a>
                </div>
            </div>
    	</div>
    </section>
	
   <div id="error-box" class="w3-modal">
    <div class="w3-modal-content w3-animate-zoom w3-card-4 w3-round list-pop">
      <header class="w3-container w3-blue"> 
        <span onclick="document.getElementById('error-box').style.display='none';" class="w3-button w3-display-topright"><img src="../img/close.png" style="margin-bottom:0px;"></span>
        <h3 class="w3-center" id="error-title">Re-Check Transaction Status</h3> 
      </header> 
      <div class="w3-container w3-center">
      	<p id="error-message" class='w3-left-align'><img src='../img/refresh.gif' height='50' align='right' />Please wait few seconds...<br>while we re-check transaction status</p>
      </div>  
    </div>
  </div>
       
    <?php include_once('_footer.php');?>

</body>
</html> 
