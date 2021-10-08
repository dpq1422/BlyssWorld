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
						$total_records=rd3_count();
						$result_rd=rd3_show();
						$qr="&s1=$s1&s2=$s2&s3=$s3&s4=$s4&s5=$s5&search=search";
						$i=0;
						?>
                    	<div class="box-head">
                        	<h3>SONAR REPORT DATE WISE (Prepaid Mobile Recharge / DTH Recharge) <span class="w3-right w3-blue w3-center badges"><?php echo $total_records;?></span></h3>
                        </div>
                        <div class="w3-responsive">
                        	<table class="w3-table-all" id="myTable" style="border:none;">
                            	<tr class="w3-blue">
                                    <th>Date</th>
                                    <th class='w3-text-right'>RC Unit</th>
                                    <th class='w3-text-right'>RC Amount</th>
                                    <th class='w3-text-right'>RC Deducted</th>
                                    <th class='w3-text-right'>Not Initiated</th>
                                    <th class='w3-text-right'>Success</th>
                                    <th class='w3-text-right'>In Progress</th>
                                    <th class='w3-text-right'>Refund Pending</th>
                                    <th class='w3-text-right'>Failed</th>
                                    <th class='w3-text-right'>Refunded</th>
                                    <th class='w3-text-right'>Total</th>
                                    <th>&nbsp;</th>
                                </tr>
								<?php
								while($rs_rd=mysql_fetch_array($result_rd))
								{
									if($rs_rd['total']!=0)
									{
								?>
                                <tr>
                                    <td><?php echo $rs_rd['report_date'];?></td>
                                	<td class='w3-text-right'><?php if($rs_rd['recharge_unit']!=0){echo $rs_rd['recharge_unit'];}?></td>
                                    <td class='w3-text-right'><?php if($rs_rd['recharge_amount']!=0){echo $rs_rd['recharge_amount'];}?></td>
                                    <td class='w3-text-right'><?php if($rs_rd['recharge_deducted']!=0){echo $rs_rd['recharge_deducted'];}?></td>
                                    <td class='w3-text-right'><?php if($rs_rd['noti']!=0){echo $rs_rd['noti'];}?></td>
                                    <td class='w3-text-right'><?php if($rs_rd['succ']!=0){echo $rs_rd['succ'];}?></td>
                                    <td class='w3-text-right'><b class='w3-text-blue'><?php if($rs_rd['inpro']!=0){echo $rs_rd['inpro'];}?></b></td>
                                    <td class='w3-text-right'><?php if($rs_rd['rpsrc']!=0){echo $rs_rd['rpsrc'];}?></td>
                                    <td class='w3-text-right'><b class='w3-text-blue'><?php if($rs_rd['rpown']!=0){echo $rs_rd['rpown'];}?></b></td>
                                    <td class='w3-text-right'><?php if($rs_rd['refunded']!=0){echo $rs_rd['refunded'];}?></td>
                                    <td class='w3-text-right'><?php if($rs_rd['total']!=0){echo $rs_rd['total'];}?></td>
                                    <td>&nbsp;</td>
                                </tr>
								<?php
									}
								}
								?>
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
