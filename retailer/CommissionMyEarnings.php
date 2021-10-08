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
						$dt="";
						if(isset($_REQUEST['dt']))
							$dt=$_REQUEST['dt'];
						
						include_once('../zf-Commission.php');
						include_once('../zf-User.php');
						calculate_payout($logged_user_id);
						/**************************/
						$num_rec_per_page=25;
						if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
						$start_from = ($page-1) * $num_rec_per_page;
						/**************************/
						$s1=$s2=$s3=$s4=$s5="";
						$cond=" where 1=1  ";
						if($dt!="")
							$cond=" $cond and date(date_time)='$dt' and user_id='$logged_user_id' ";
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
						$total_records=show_payout_detail_count($cond);
						$user_result=show_payout_detail_data($cond, $start_from, $num_rec_per_page);
						$qr="&s1=$s1&s2=$s2&s3=$s3&s4=$s4&s5=$s5&dt=$dt&search=search";
						$i=0;
						?>
                    	<div class="box-head">
                        	<h3>Detailed Earnings <span class="w3-right w3-blue w3-center badges"><?php echo $total_records;?></span></h3>
                        </div>
                        <div class="table-div wh w3-left">
                        	<ul>
                            	<li class="table-div-head">
									<span>Date Time</span>
									<span>Order No</span>
									<span>Product Name</span>
									<span>Earning/Payout</span>
									<!--<span>TDS</span>
									<span>Income</span>-->
                                </li>
								<?php
								$i=0;
								while($user_row=mysql_fetch_array($user_result))
								{
									$i++;
									$amt=$user_row['cr'];
									if($amt!=0)
									{
										$prd_name="";
										$prd_source="";
										$order_details=show_order_details($user_row['order_id']);
										$prd_name=$order_details[2];
										$prd_source=$order_details[1];
										
										if($prd_name==1)
										$prd_name="Money Transfer";
										else if($prd_name==2)
										$prd_name="Account Verification";
										else if($prd_name==3)
										$prd_name="Prepaid Mobile Recharge";
										else if($prd_name==4)
										$prd_name="DTH Recharge";
										else if($prd_name==5)
										$prd_name="Postpaid Bill";
										else if($prd_name==6)
										$prd_name="Electricity Bill";
										else if($prd_name==7)
										$prd_name="Water Bill";
										else if($prd_name==8)
										$prd_name="Gas Bill";
										else if($prd_name==9)
										$prd_name="Landline/Broadband Bill";
										else if($prd_name==10)
										$prd_name="Datacard Bill";
										else if($prd_name==11)
										$prd_name="Insurance Premium";
										else
										$prd_name="";
										
										if($prd_name=="")
										{
											$order_details=show_order_details2($user_row['order_id']);
											$prd_name=$order_details[2];
											$prd_source=$order_details[1];
											
											if($prd_name==1)
											$prd_name="Money Transfer";
											else if($prd_name==2)
											$prd_name="Account Verification";
											else if($prd_name==3)
											$prd_name="Prepaid Mobile Recharge";
											else if($prd_name==4)
											$prd_name="DTH Recharge";
											else if($prd_name==5)
											$prd_name="Postpaid Bill";
											else if($prd_name==6)
											$prd_name="Electricity Bill";
											else if($prd_name==7)
											$prd_name="Water Bill";
											else if($prd_name==8)
											$prd_name="Gas Bill";
											else if($prd_name==9)
											$prd_name="Landline/Broadband Bill";
											else if($prd_name==10)
											$prd_name="Datacard Bill";
											else if($prd_name==11)
											$prd_name="Insurance Premium";
											else
											$prd_name="";
										}
									
										$prd_details=$prd_name;
							
										/*$amt=$amt*100/95;
										$tds=$amt*.05;
										$tds=($tds*100)/100;
										$amt=number_format($amt, 2, '.', '');
										$tds=number_format($tds, 2, '.', '');
										$net=$amt-$tds;*/
								?>
                                <li>
									<span><?php echo $user_row['date_time'];?></span>
									<span><?php echo $user_row['order_id'];?></span>
									<span><?php echo $prd_details;?></span>
									<span class='w3-right-align'><?php echo $amt;?> Cr</span>
									<!--<span><?php echo $tds;?></span>
									<span><?php echo $net;?></span>-->
                                </li>
								<?php
									}
									else
									{
								?>
                                <li>
									<span><?php echo $user_row['date_time'];?></span>
									<span><?php echo $user_row['details'];?></span>
									<span class='w3-right-align'><?php echo $user_row['dr'];?> Dr </span>
                                </li>
								<?php
									}
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
