<!DOCTYPE html>
<html>
<head>
<?php include_once('_all-inner-pages-html-title.php'); ?>

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
						include_once('zf-WalletDistributed.php');
						include_once('zf-Client.php');
						include_once('zf-Source.php');
						include_once('zf-Bank.php');
						/**************************/
						$num_rec_per_page=10;
						if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
						$start_from = ($page-1) * $num_rec_per_page;
						/**************************/
						$s1=$s2=$s3=$s4="";
						$cond=" where 1=1 ";
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
						$total_records=show_distributed_count($cond);
						$distributed_result=show_distributed_data($cond, $start_from, $num_rec_per_page);
						$qr="&s1=$s1&s2=$s2&s3=$s3&s4=$s4&search=search";
						$i=0;
						?>
                    	<div class="box-head">
                        	<h3>Distributed Wallet History <span class="w3-right w3-blue w3-center badges"><?php echo $total_records;?></span></h3>
                        </div>
                        <div class="w3-responsive">
							<table class="w3-table-all" id="myTable" style="border:none;">
								<tr class="w3-blue">
								  <th>ID</th>
								  <th>DATE</th>
								  <th>TIME</th>
								  <th>CLIENT/SOURCE</th>
								  <th>REQ.NO/BANK</th>
								  <th>TXN TYPE</th>
								  <th>CR</th>
								  <th>DR</th>
								  <th class="w3-right">BALANCE</th>
								</tr> 
								<?php
								while($distributed_row=mysql_fetch_array($distributed_result))
								{
									$i++;	
									$type=$distributed_row['transaction_type'];
									$name="";
									$req="";
									if($type==0)
										$type="Account Opened";
									else if($type==1)
									{
										$type="<b class='w3-text-green'>Wallet Received</b>";
										$name="<b class='w3-text-green'>".show_source_name($distributed_row['client_id'])."</b>";
										$req=show_bank_name($distributed_row['request_id']);
									}
									else if($type==2)
									{
										$type="<b class='w3-text-blue'>Wallet Transferred</b>";
										$name="<b class='w3-text-blue'>".show_client_name($distributed_row['client_id'])."</b>";
										$req=$distributed_row['request_id'];
									}
									else if($type==3)
									{
										$type="<b class='w3-text-red'>Wallet Withdraw</b>";
										$name="<b class='w3-text-blue'>".show_client_name($distributed_row['client_id'])."</b>";
										$req="";
									}
									else if($type==4)
									{
										$type="<b class='w3-text-orange'>Chargeback</b>";
										$name="<b class='w3-text-blue'>".show_client_name($distributed_row['client_id'])."</b>";
										$req="";
									}
								?>
                                <tr>
                                	<td><?php echo $distributed_row['wallet_id'];?></td>
                                	<td><?php echo $distributed_row['wallet_date'];?></td>
                                	<td><?php echo $distributed_row['wallet_time'];?></td>
                                	<td><?php echo $name;?></td>
                                	<td><?php echo $req;?></td>
                                	<td><?php echo $type;?></td>
                                	<td><?php echo $distributed_row['amount_cr'];?></td>
                                	<td><?php echo $distributed_row['amount_dr'];?></td>
                                	<td class="w3-right"><?php echo $distributed_row['amount_bal'];?></td>
                                </tr>
								<?php
								}
								?>
                            </table>
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
