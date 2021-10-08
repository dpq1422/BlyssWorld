<!DOCTYPE html>
<html>
<head>
<?php include_once('_all-inner-pages-html-title.php'); ?>
<script>
$(document).ready(function(){
	$(".search-data").click(function(){
		$(".table-search-filter").slideToggle();
	});
});
</script>
<script>
function printreports(multiple)
{
		window.open('printreports.php?result='+multiple,'Print Receipt','directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=600,height=800');
}
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
						include_once('../zf-Commission.php');
						//calculate_payout($logged_user_id);
						/**************************/
						/*
						$num_rec_per_page=7;
						if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
						$start_from = ($page-1) * $num_rec_per_page;
						$s1=$s2=$s3=$s4=$s5="";
						$cond=" where 1=1 and user_id='$logged_user_id' ";
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
						*/
						/**************************/
						$user_result=show_my_all_payout($logged_user_id);
						$qr="&s1=$s1&s2=$s2&s3=$s3&s4=$s4&s5=$s5&search=search";
						$i=0;
						?>
                    	<div class="box-head">
                        	<h3>Consolidated Commission Receipt </h3>
                        </div>
                        <div class="table-div wh w3-left">
                        	<ul>
                            	<li class="table-div-head">
                                	<span>Sr.No.</span>
                                	<span>Year-Month</span>
                                    <span>Earning</span>
                                    <span>GST</span>
                                    <span>TDS</span>
                                    <span>Total</span>
                                    <span>Paid on</span>
                                    <span>Receipt</span>
                                </li>
								<?php
								while($user_row=mysql_fetch_array($user_result))
								{
									$i++;
									$dts=explode("-",$user_row['monthof']);
									$dt=$dts[0].'-'.$dts[1];
									$status="<a>Print</a>";
								?>
                                <li>
                                	<span><?php echo $i;?></span>
                                	<span><?php echo $dt;?></span>
                                    <span><?php echo $user_row['comm'];?></span>
                                    <span><?php echo $user_row['gst'];?></span>
                                    <span><?php echo $user_row['tds'];?></span>
                                    <span><?php echo $user_row['earning'];?></span>
                                    <span><?php echo $user_row['paidon'];?></span>
                                    <span>
										<img src='../img/print.png' 
										onclick="printreports('<?php echo $dt;?>')" style='margin:-2px 0px;' height='16' title='Print'/>
									</span>
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
