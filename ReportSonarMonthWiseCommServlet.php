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
						$total_records=md4_count();
						$result_md=md4_show();
						$qr="&s1=$s1&s2=$s2&s3=$s3&s4=$s4&s5=$s5&search=search";
						$i=0;
						?>
                    	<div class="box-head">
                        	<h3>SONAR REPORT MONTH WISE (GST / Commissions / TDS / Earnings) <span class="w3-right w3-blue w3-center badges"><?php echo $total_records;?></span></h3>
                        </div>
                        <div class="w3-responsive">
                        	<table class="w3-table-all" id="myTable" style="border:none;">
                            	<tr class="w3-blue">
                                    <th>Date</th>
                                    <th class='w3-text-right'>Money Remittance</th>
                                    <th class='w3-text-right'>Recharge</th>
                                    <th class='w3-text-right'>Taken Charges.GST</th>
                                    <th class='w3-text-right'>Paid Charges.GST</th>
                                    <th class='w3-text-right'>Remain Charges.GST</th>
                                    <th class='w3-text-right'>Comm Retailer.Team</th>
                                    <th class='w3-text-right'>TDS Retailer.Team</th>
                                    <th class='w3-text-right'>Earn Retailer.Team</th>
                                    <th class='w3-text-right'>AVF SFF</th>
                                    <th class='w3-text-right'>Total</th>
                                    <th class='w3-text-right'>SCF</th>
                                    <th>&nbsp;</th>
                                </tr>
								<?php
								$a=$b=$c=$d=$e=$f=$g=$h=$i=$j=$k=$l=$m=$n=$o=$p=$q=$r=$s=$t=0;
								while($rs_rd=mysql_fetch_array($result_md))
								{
									$total=0;
									$total=$rs_rd['fee_taken']+$rs_rd['rc_deducted']-$rs_rd['fee_admin']-$rs_rd['gst_taken']-$rs_rd['com_r']-$rs_rd['com_t']+$rs_rd['avfee']+$rs_rd['swfee'];
									$a+=$rs_rd['mt_amount'];
									$b+=$rs_rd['mt_unit'];
									$c+=$rs_rd['rc_amount'];
									$d+=$rs_rd['rc_unit'];
									$e+=$rs_rd['fee_taken']+$rs_rd['rc_deducted'];
									$f+=$rs_rd['gst_taken']+$rs_rd['gst_admin'];
									$g+=$rs_rd['fee_admin'];
									$h+=$rs_rd['gst_admin'];
									$i+=$rs_rd['fee_taken']+$rs_rd['rc_deducted']-$rs_rd['fee_admin'];
									$j+=$rs_rd['gst_taken'];
									$k+=$rs_rd['com_r'];
									$l+=$rs_rd['com_t'];
									$m+=$rs_rd['tds_r'];
									$n+=$rs_rd['tds_t'];
									$o+=$rs_rd['earn_r'];
									$p+=$rs_rd['earn_t'];
									$q+=$rs_rd['avfee'];
									$r+=$rs_rd['swfee'];
									$s+=$total;
									$t+=$rs_rd['scfee'];
									if($rs_rd['mt_amount']!=0 || $rs_rd['rc_amount']!=0)
									{
								?>
                                <tr>
                                    <td><?php echo $rs_rd['report_month'];?></td>
                                    <td class='w3-text-right'><u><?php echo $rs_rd['mt_amount'];?></u><br>(<?php echo $rs_rd['mt_unit'];?>)</td>
                                    <td class='w3-text-right'><u><?php echo $rs_rd['rc_amount'];?></u><br>(<?php echo $rs_rd['rc_unit'];?>)</td>
                                    <td class='w3-text-right'><u><?php echo $rs_rd['fee_taken']+$rs_rd['rc_deducted'];?></u><br><?php echo $rs_rd['gst_taken']+$rs_rd['gst_admin'];?></td>
                                    <td class='w3-text-right'><u><?php echo $rs_rd['fee_admin'];?></u><br><?php echo $rs_rd['gst_admin'];?></td>
                                    <td class='w3-text-right'><b><u><?php echo $rs_rd['fee_taken']+$rs_rd['rc_deducted']-$rs_rd['fee_admin'];?></u></b><br><b class='w3-text-green'><?php echo $rs_rd['gst_taken'];?></b></td>
                                    <td class='w3-text-right'><u><?php echo $rs_rd['com_r'];?></u><br><?php echo $rs_rd['com_t'];?></td>
                                    <td class='w3-text-right'><b class='w3-text-blue'><u><?php echo $rs_rd['tds_r'];?></u><br><?php echo $rs_rd['tds_t'];?></b></td>
                                    <td class='w3-text-right'><b class='w3-text-orange'><u><?php echo $rs_rd['earn_r'];?></u><br><?php echo $rs_rd['earn_t'];?></b></td>
                                    <td class='w3-text-right'><u><?php echo $rs_rd['avfee'];?></u><br><?php echo $rs_rd['swfee'];?></td>
                                    <td class='w3-text-right'><b><?php echo $total;?></b></td>
                                    <td class='w3-text-right'><?php echo $rs_rd['scfee'];?></td>
                                    <td>&nbsp;</td>
                                </tr>
								<?php
									}
								}
								?>
                            	<tr class="w3-green">
                                    <th>GRAND TOTAL</th>
                                    <th class='w3-text-right'><u><?php echo $a;?></u><br>(<?php echo $b;?>)</th>
                                    <th class='w3-text-right'><u><?php echo $c;?></u><br>(<?php echo $d;?>)</th>
                                    <th class='w3-text-right'><u><?php echo $e;?></u><br><?php echo $f;?></th>
                                    <th class='w3-text-right'><u><?php echo $g;?></u><br><?php echo $h;?></th>
                                    <th class='w3-text-right'><u><?php echo $i;?></u><br><?php echo $j;?></th>
                                    <th class='w3-text-right'><u><?php echo $k;?></u><br><?php echo $l;?></th>
                                    <th class='w3-text-right'><u><?php echo $m;?></u><br><?php echo $n;?></th>
                                    <th class='w3-text-right'><u><?php echo $o;?></u><br><?php echo $p;?></th>
                                    <th class='w3-text-right'><u><?php echo $q;?></u><br><?php echo $r;?></th>
                                    <th class='w3-text-right'><u><?php echo $s;?></u></th>
                                    <th class='w3-text-right'><u><?php echo $t;?></u></th>
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
