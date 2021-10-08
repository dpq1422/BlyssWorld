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
						include_once('zf-TxnService1.php');
						include_once('zf-User.php');
						/**************************/
						$num_rec_per_page=8;
						if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
						$start_from = ($page-1) * $num_rec_per_page;
						/**************************/
						$s1=$s2=$s3=$s4=$s5="";
						$cond=" where 1=1 and order_status in(-1) ";
						if(isset($_REQUEST['search']))
						{
							if(isset($_REQUEST['s1'])) $s1=mysql_real_escape_string($_REQUEST['s1']);
							if(isset($_REQUEST['s2'])) $s2=mysql_real_escape_string($_REQUEST['s2']);
							if(isset($_REQUEST['s3'])) $s3=mysql_real_escape_string($_REQUEST['s3']);
							if(isset($_REQUEST['s4'])) $s4=mysql_real_escape_string($_REQUEST['s4']);
							if(isset($_REQUEST['s5'])) $s5=mysql_real_escape_string($_REQUEST['s5']);
							if($s1!=""){$cond.=" and user_id='$s1' ";}
							if($s2!=""){$cond.=" and user_name like '%$s2%' ";}
							if($s3!=""){$cond.=" and user_type='$s3' ";}
							if($s4!=""){$cond.=" and user_department_info like '%$s4%' ";}
							if($s5!=""){$cond.=" and user_status='$s5' ";}
						}
						$total_records=show_orders_count($cond);
						$user_result=show_orders_data($cond, $start_from, $num_rec_per_page);
						$qr="&s1=$s1&s2=$s2&s3=$s3&s4=$s4&s5=$s5&search=search";
						$i=0;
						?>
                    	<div class="box-head">
                        	<h3>QUEUED TRANSACTIONS BY RETAILERS - Domestic Money Transfer <span class="w3-right w3-blue w3-center badges"><?php echo $total_records;?></span></h3>
                        </div>
                        <div class="table-div wh w3-left">
                        	<ul>
                            	<li class="table-div-head">
                                	<span>TXN ID</span>
                                	<span>ORDER ID</span>
                                    <span>DATE</span>
                                    <span>USER ID</span>
                                    <span>USER NAME</span>
                                    <span>TXN TYPE</span>
                                    <span>AMOUNT</span>
                                    <span>CHARGES</span>
                                    <span>STATUS</span>
                                    <span>ACTION</span>
                                </li>
								<?php
								while($user_row=mysql_fetch_array($user_result))
								{
									$i++;
									$channel=$user_row['source'];
									$method=$user_row['channel'];
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
									$order_id=$user_row['order_id'];
									
									$txn_status=$user_row['order_status'];
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
										$bank_ref_no=$user_row['bank_ref_no'];
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
								?>
                                <li>
                                	<span><?php echo $txn_id;?></span>
                                	<span><?php echo $order_id;?></span>
                                    <span><?php echo $user_row['created_on'];?></span>
                                    <span><?php echo $user_row['user_id'];?></span>
                                    <span><?php echo show_user_name($user_row['user_id']);?></span>
                                    <span><?php echo $txn_type;?></span>
                                    <span><?php echo $user_row['amount'];?></span>
                                    <span><?php echo $user_row['com_charged'];?></span>
                                    <span><?php echo $txn_status;?></span>
                                    <span><a onclick="expand('<?php echo $i;?>')" class="add-icon add<?php echo $i;?>"></a></span>
                                </li>
                                <li>
                                	<div class="address<?php echo $i;?> inner-add wh w3-left">
                                        <p><strong>DETAILS:-</strong></p>
										<table width='100%'>
											<tr>
												<th width='15%'>Channel:- </th>
												<td width='15%'><?php echo $channel;?></td>
												<td width='5%'></td>
												<th width='15%'>Sender Number:- </th>
												<td width='15%'><?php echo $user_row['sender_number'];?></td>
												<td width='5%'></td>
												<th width='15%'>Sender Name:- </th>
												<td width='15%'><?php echo $user_row['sname'];?></td>
											</tr>
											<tr>
												<th>Method:- </th>
												<td><?php echo $method;?></td>
												<td></td>
												<th>Receiver Number:- </th>
												<td><?php echo $user_row['receiver_number'];?></td>
												<td></td>
												<th>Receiver Name:- </th>
												<td><?php echo $user_row['rname'];?></td>
											</tr>
											<tr>
												<th></th>
												<td></td>
												<td></td>
												<th>Bank Name:- </th>
												<td><?php echo $user_row['rbname'];?></td>
												<td></td>
												<th>Account Number:- </th>
												<td><?php echo $user_row['racc'];?></td>
											</tr>
											<tr><td colspan="8"><hr></td></tr>
											<tr>
												<th>Pre Balance</th>
												<th>Deducted Amount</th>
												<td></td>
												<th>Wallet Balance</th>
												<th>TID</th>
												<td></td>
												<th>STATUS</th>
												<th>Bank Ref.No.</th>
											</tr>
											<tr>
												<td><?php echo $user_row['bal_before'];?></td>
												<td><?php echo $user_row['amount']+$user_row['com_charged'];?></td>
												<td></td>
												<td><?php echo $user_row['bal_after'];?></td>
												<td><?php echo $user_row['tid'];?></td>
												<td></td>
												<td><?php echo $txn_status;?></td>
												<td><?php echo $bank_ref_no;?></td>
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
