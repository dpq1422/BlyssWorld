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
						include_once('zf-Client.php');
						/**************************/
						$num_rec_per_page=10;
						if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
						$start_from = ($page-1) * $num_rec_per_page;
						/**************************/
						$s1=$s2=$s3=$s4="";
						$cond=" where 1=1 and mmt_status=5 ";
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
						$total_records=show_txn_count($cond);
						$mmt_result=show_txn_data($cond, $start_from, $num_rec_per_page);
						$qr="&s1=$s1&s2=$s2&s3=$s3&s4=$s4&search=search";
						$i=0;
						?>
                    	<div class="box-head">
                        	<h3>REFUNDED TRANSACTIONS - Domestic Money Transfer <span class="w3-right w3-blue w3-center badges"><?php echo $total_records;?></span></h3>
                        </div>
                        <div class="table-div wh w3-left">
                        	<ul>
                            	<li class="table-div-head">
                                	<span>TID</span>
                                    <span>DATE</span>
                                    <span>TIME</span>
                                    <span>CLIENT ID</span>
                                    <span>ORDER ID</span>
                                    <span>TXN ID</span>
                                    <span>TXN TYPE</span>
                                    <span>PRE BAL</span>
                                    <span>AMOUNT</span>
                                    <span>CHARGES</span>
                                    <span>BALANCE</span>
                                    <span>STATUS</span>
                                    <span>ACTION</span>
                                </li>
								<?php
								while($mmt_row=mysql_fetch_array($mmt_result))
								{
									$i++;	
									
									$mmt_type=$mmt_row['type'];
									if($mmt_type==1)
										$mmt_type="<b class='w3-text-blue'>Money Transfer</b>";
									else if($mmt_type==2)
										$mmt_type="<b class='w3-text-green'>Account Verification</b>";
									
									$mmt_status=$mmt_row['mmt_status'];
									$otp=$mmt_row['refund_otp'];
									if($mmt_status==-2)
										$mmt_status="<b class='w3-text-red'>In-Progress(s)</b>";
									else if($mmt_status==-1)
										$mmt_status="<b class='w3-text-red'>In-Progress</b>";
									else if($mmt_status==0)
										$mmt_status="<b class='w3-text-black'>Not Initiated</b>";
									else if($mmt_status==1)
										$mmt_status="<b class='w3-text-blue'>Initiated</b>";
									else if($mmt_status==2)
										$mmt_status="<b class='w3-text-green'>Success</b>";
									else if($mmt_status==3)
										$mmt_status="<b class='w3-text-blue'>Response Awaited</b>";
									else if($mmt_status==4 || $mmt_status==-4)
										$mmt_status="<b class='w3-text-orange'>Pending Refund</b>";
									else if($mmt_status==5 && $otp==0)
										$mmt_status="<b class='w3-text-green'>Refunded</b>";
									else if($mmt_status==5 && $otp!=0)
										$mmt_status="<b class='w3-text-green'>Refunded(s)</b>";
									else
										$mmt_status="<b class='w3-text-red'>Scheduled/Hold</b>";
									
									$mmt_method=$mmt_row['method'];
									if($mmt_method==1)
										$mmt_method="NEFT";
									else if($mmt_method==2)
										$mmt_method="IMPS";
									
									$response=str_replace(","," , ",$mmt_row['response']);
								?>
                                <li>
                                	<span><?php echo $mmt_row['mmt_id'];?></span>
                                    <span><?php echo explode(" ",$mmt_row['created_on'])[0];?></span>
                                    <span><?php echo explode(" ",$mmt_row['created_on'])[1];?></span>
                                    <span><?php echo show_client_name($mmt_row['client_id']);?></span>
                                    <span><?php echo $mmt_row['order_id'];?></span>
                                    <span><?php echo $mmt_row['txn_id'];?></span>
                                    <span><?php echo $mmt_type;?></span>
                                    <span><?php echo $mmt_row['bal_before'];?></span>
                                    <span><?php echo $mmt_row['amount'];?></span>
                                    <span><?php echo $mmt_row['charges'];?></span>
                                    <span><?php echo $mmt_row['bal_after'];?></span>
                                    <span><?php echo $mmt_status;?></span>
                                    <span><a onclick="expand('<?php echo $i;?>')" class="add-icon add<?php echo $i;?>"></a></span>
                                </li>
                                <li>
                                	<div class="address<?php echo $i;?> inner-add wh w3-left">
                                        <p><strong>DETAILS:-</strong></p>
										<table width='100%'>
											<tr>
												<th width='15%'>Channel:- </th>
												<td width='15%'><?php echo $mmt_row['source'];?></td>
												<td width='5%'></td>
												<th width='15%'>Method:- </th>
												<td width='15%'><?php echo $mmt_method;?></td>
												<td width='5%'></td>
												<th width='15%'>Status:- </th>
												<td width='15%'><?php echo $mmt_status;?></td>
											</tr>
											<tr>
												<th>Sender Number:- </th>
												<td><?php echo $mmt_row['sender_number'];?></td>
												<td></td>
												<th>Sender Name:- </th>
												<td><?php echo $mmt_row['sname'];?></td>
												<td></td>
												<th>Updated On:- </th>
												<td><?php echo $mmt_row['updated_on'];?></td>
											</tr>
											<tr>
												<th>Receiver Number:- </th>
												<td><?php echo $mmt_row['receiver_number'];?></td>
												<td></td>
												<th>Receiver Name:- </th>
												<td><?php echo $mmt_row['rname'];?></td>
												<td></td>
												<th>Source TID:- </th>
												<td><?php echo $mmt_row['tid'];?></td>
											</tr>
											<tr>
												<th>Bank Name:- </th>
												<td><?php echo $mmt_row['rbname'];?></td>
												<td></td>
												<th>Account Number:- </th>
												<td><?php echo $mmt_row['racc'];?></td>
												<td></td>
												<th>Bank Ref No.:- </th>
												<td><?php echo $mmt_row['bank_ref_no'];?></td>
											</tr>
											<tr><td colspan='8'>&nbsp;</td></tr>
											<tr><td colspan='8'><?php echo $response;?></td></tr>
											<tr><td colspan='8'>&nbsp;</td></tr>
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
