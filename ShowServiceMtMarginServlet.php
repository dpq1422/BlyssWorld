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
						include_once('zf-ServiceMarginMt.php');
						include_once('zf-Service.php');
						/**************************/
						$num_rec_per_page=100;
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
						$sid=101;
						$total_records=show_margins_count(" where user_id=$logged_user_id ");
						$margin_result=show_margins_data(" where user_id=$logged_user_id ", $start_from, $num_rec_per_page);
						$qr="";//"&s1=$s1&s2=$s2&s3=$s3&s4=$s4&search=search";
						$i=0;
						$sname=show_service_name($sid);
						?>
                    	<div class="box-head">
                        	<h3>Margins of Service (<?php echo $sname;?>) <span class="w3-right w3-blue w3-center badges"><?php echo $total_records;?></span></h3>
                        </div>
						
                        <div class="w3-responsive">
                            <table class="w3-table-all" id="myTable" style="border:none;">
                                <tr class="w3-blue">
                                  <th>Channel</th>
                                  <th>Txn Type</th>
                                  <th>0-1000</th>
                                  <th>1001-2000</th>
                                  <th>2001-3000</th>
                                  <th>3001-4000</th>
                                  <th>4001-5000</th>
                                  <!--<th>5001-10000</th>
                                  <th>10001-15000</th>
                                  <th>15001-20000</th>
                                  <th>20001-25000</th>-->
                                </tr>      
								<?php
								while($margin_row=mysql_fetch_array($margin_result))
								{
									$i++;
									$source_id=$margin_row['source_id'];
									$payment_method=$margin_row['payment_method'];
									if($source_id==1)
										$source_id="Channel 1";
									if($payment_method==1)
										$payment_method="NEFT";
									if($payment_method==2)
										$payment_method="IMPS";
									$amt_01000=0;
									$amt_02000=0;
									$amt_03000=0;
									$amt_04000=0;
									$amt_05000=0;
									$amt_10000=0;
									$amt_15000=0;
									$amt_20000=0;
									$amt_25000=0;
									$amt_01000=$margin_row['m_01000'];
									$amt_02000=$margin_row['m_02000'];
									$amt_03000=$margin_row['m_03000'];
									$amt_04000=$margin_row['m_04000'];
									$amt_05000=$margin_row['m_05000'];
									$amt_10000=$margin_row['m_10000'];
									$amt_15000=$margin_row['m_15000'];
									$amt_20000=$margin_row['m_20000'];
									$amt_25000=$margin_row['m_25000'];
									if($amt_01000==0)
										$amt_01000="-";
									if($amt_02000==0)
										$amt_02000="-";
									if($amt_03000==0)
										$amt_03000="-";
									if($amt_04000==0)
										$amt_04000="-";
									if($amt_05000==0)
										$amt_05000="-";
									if($amt_10000==0)
										$amt_10000="-";
									if($amt_15000==0)
										$amt_15000="-";
									if($amt_20000==0)
										$amt_20000="-";
									if($amt_25000==0)
										$amt_25000="-";
								?>                          
                                <tr>
                                  <td><?php echo $source_id;?></td>
                                  <td><?php echo $payment_method;?></td>
                                  <td><?php echo $amt_01000;?></td>
                                  <td><?php echo $amt_02000;?></td>
                                  <td><?php echo $amt_03000;?></td>
                                  <td><?php echo $amt_04000;?></td>
                                  <td><?php echo $amt_05000;?></td>
                                  <!--<td><?php echo $amt_10000;?></td>
                                  <td><?php echo $amt_15000;?></td>
                                  <td><?php echo $amt_20000;?></td>
                                  <td><?php echo $amt_25000;?></td>-->
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
