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
						include_once('zf-Sonar.php');
						/**************************/
						$num_rec_per_page=25;
						if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
						$start_from = ($page-1) * $num_rec_per_page;
						/**************************/
						$s1=$s2=$s3=$s4=$s5="";
						$cond=" where 1=1 ";
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
						$total_records=md1_count();
						$result_md=md1_show();
						$qr="&s1=$s1&s2=$s2&s3=$s3&s4=$s4&s5=$s5&search=search";
						$i=0;
						?>
                    	<div class="box-head">
                        	<h3>SONAR REPORT MONTH WISE (Wallet Balance / Member Registrations / Wallet Requests / Tickets Raised) <span class="w3-right w3-blue w3-center badges"><?php echo $total_records;?></span></h3>
                        </div>
                        <div class="w3-responsive">
                        	<table class="w3-table-all" id="myTable" style="border:none;">
                            	<tr class="w3-blue">
                                    <th>Date</th>
                                    <th class='w3-text-right'>Wal.Upd</th>
                                    <th class='w3-text-right'>Wal.Trf</th>
                                    <th class='w3-text-right'>Stf.Reg</th>
                                    <th class='w3-text-right'>Team.Reg</th>
                                    <th class='w3-text-right'>Ret.Reg</th>
                                    <th class='w3-text-right'>Total</th>
                                    <th class='w3-text-right'>Req.Rcv</th>
                                    <th class='w3-text-right'>Req.Acpt</th>
                                    <th class='w3-text-right'>Tkt.Rcv</th>
                                    <th class='w3-text-right'>Tkt.Closed</th>
                                    <th>&nbsp;</th>
                                </tr>
								<?php
								$a=$b=$c=$d=$e=$f=$g=$h=$i=$j=$k=$l=$m=$n=0;
								while($rs_rd=mysql_fetch_array($result_md))
								{
									$a+=$rs_rd['wallet_received'];
									$b+=$rs_rd['wallet_transfer'];
									$c+=$rs_rd['reg_user'];
									$d+=$rs_rd['reg_team'];
									$e+=$rs_rd['reg_retailer'];
									$f+=$rs_rd['reg_total'];
									$g+=$rs_rd['wallet_request_received_amount'];
									$h+=$rs_rd['wallet_request_received_unit'];
									$i+=$rs_rd['wallet_request_accepted_amount'];
									$j+=$rs_rd['wallet_request_accepted_unit'];
									$k+=$rs_rd['ticket_received'];
									$l+=$rs_rd['ticket_closed'];
								?>
                                <tr>
                                    <td><?php echo $rs_rd['report_month'];?></td>
                                    <td class='w3-text-right'><?php echo $rs_rd['wallet_received'];?></td>
                                    <td class='w3-text-right'><?php echo $rs_rd['wallet_transfer'];?></td>
                                    <td class='w3-text-right'><?php if($rs_rd['reg_user']!=0){echo $rs_rd['reg_user'];}?></td>
                                    <td class='w3-text-right'><?php if($rs_rd['reg_team']!=0){echo $rs_rd['reg_team'];}?></td>
                                    <td class='w3-text-right'><?php if($rs_rd['reg_retailer']!=0){echo $rs_rd['reg_retailer'];}?></td>
                                    <td class='w3-text-right'><?php if($rs_rd['reg_total']!=0){echo $rs_rd['reg_total'];}?></td>
                                    <td class='w3-text-right'><?php echo $rs_rd['wallet_request_received_amount']." <br>(".$rs_rd['wallet_request_received_unit'].")";?></td>
                                    <td class='w3-text-right'><?php echo $rs_rd['wallet_request_accepted_amount']." <br>(".$rs_rd['wallet_request_accepted_unit'].")";?></td>
                                    <td class='w3-text-right'><?php if($rs_rd['ticket_received']!=0){echo $rs_rd['ticket_received'];}?></td>
                                    <td class='w3-text-right'><?php if($rs_rd['ticket_closed']!=0){echo $rs_rd['ticket_closed'];}?></td>
                                    <td>&nbsp;</td>
                                </tr>
								<?php
								}
								?>
                            	<tr class="w3-green">
                                    <th>GRAND TOTAL</th>
                                    <th class='w3-text-right'><?php echo $a;?></th>
                                    <th class='w3-text-right'><?php echo $b;?></th>
                                    <th class='w3-text-right'><?php echo $c;?></th>
                                    <th class='w3-text-right'><?php echo $d;?></th>
                                    <th class='w3-text-right'><?php echo $e;?></th>
                                    <th class='w3-text-right'><?php echo $f;?></th>
                                    <th class='w3-text-right'><?php echo $g." <br>($h)";?></th>
                                    <th class='w3-text-right'><?php echo $i." <br>($j)";?></th>
                                    <th class='w3-text-right'><?php echo $k;?></th>
                                    <th class='w3-text-right'><?php echo $l;?></th>
                                    <th>&nbsp;</th>
                                </tr>
                            </table>
                        </div>
                        
                    </div>
                </div>               
                
            </div>
        <!--</div>-->
    </section>
    <!--
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
    -->
    <?php include_once('_footer.php');?>

</body>
</html> 
