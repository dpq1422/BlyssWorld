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
						include_once('zf-Plan.php');
						$planid=0;
						if(isset($_REQUEST['plan']))
							$planid=$_REQUEST['plan'];
						/**************************/
						$num_rec_per_page=25;
						if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
						$start_from = ($page-1) * $num_rec_per_page;
						/**************************/
						$s1=$s2=$s3=$s4=$s5="";
						$cond=" where 1=1 and plan_id='$planid' ";
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
						$total_records=show_plans_count_mt($cond);
						$user_result=show_plans_data_mt($cond, $start_from, $num_rec_per_page);
						$qr="&s1=$s1&s2=$s2&s3=$s3&s4=$s4&s5=$s5&search=search";
						$i=0;
						if(isset($_POST['UpdateMtDistribution']))
						{
							include_once('zc-session-admin.php');
							include_once('zf-Plan.php');
							
							$plans=$_POST['plan'];
							$sources=$_POST['source'];
							$methods=$_POST['method'];
							$m1s=$_POST['m1'];
							$m2s=$_POST['m2'];
							$m3s=$_POST['m3'];
							$m4s=$_POST['m4'];
							$m5s=$_POST['m5'];
							for($aa=0;$aa<count($plans);$aa++)
							{
								$plan=mysql_real_escape_string($plans[$aa]);
								$source=mysql_real_escape_string($sources[$aa]);
								$method=mysql_real_escape_string($methods[$aa]);
								if($method=="NEFT")
									$method=1;
								else if($method=="IMPS")
									$method=2;
								$m1=mysql_real_escape_string($m1s[$aa]);
								$m2=mysql_real_escape_string($m2s[$aa]);
								$m3=mysql_real_escape_string($m3s[$aa]);
								$m4=mysql_real_escape_string($m4s[$aa]);
								$m5=mysql_real_escape_string($m5s[$aa]);
								update_mt_rate($plan,$source,$method,$m1,$m2,$m3,$m4,$m5);
							}
							echo "<script>window.location.href='PlanMtServlet?plan=$plan';</script>";
						}
						?>
                    	<div class="box-head wh w3-left">
                                <h3 class="wh w3-left">MT Distribution (<?php echo "PLAN $planid : ".show_plan_name($planid);?>)<span class="w3-right w3-blue w3-center badges"><?php echo $total_records;?></span></h3>
                        </div>
                        <div class="table-div wh w3-left">
							<form method="post">
                        	<ul>
                            	<li class="table-div-head">
                                	<span>Sr.No.</span>
                                	<span>SOURCE</span>
                                    <span>METHOD</span>
                                    <span>0-1000</span>
                                    <span>1001-2000</span>
                                    <span>2001-3000</span>
                                    <span>3001-4000</span>
                                    <span>4001-5000</span>
                                </li>
								<?php
								while($user_row=mysql_fetch_array($user_result))
								{
									$i++;		
									
									$payment_method=$user_row['payment_method'];
									if($payment_method==1)
										$payment_method="NEFT";
									else if($payment_method==2)
										$payment_method="IMPS";
								?>
                                <li>
                                	<span><?php echo $i;?></span>
                                	<span><?php echo "Channel ".$user_row['source_id'];?></span>
                                    <span><?php echo $payment_method;?></span>
                                    <span>
										<input type="hidden" name="plan[]" value="<?php echo $planid;?>"/>
										<input type="hidden" name="source[]" value="<?php echo $user_row['source_id'];?>"/>
										<input type="hidden" name="method[]" value="<?php echo $payment_method;?>"/>
										<?php
										echo "<select name='m1[]' style='width:60px;height:34px;' class='w3-select w3-border w3-round'>";
										for($p1=8;$p1<=35;$p1=$p1+0.50)
										{
											if($p1==$user_row['m_01000'])
												echo "<option selected>$p1</option>";
											else
												echo "<option>$p1</option>";
										}
										echo "<select>";
										?>
									</span>
                                    <span>
										<?php
										echo "<select name='m2[]' style='width:60px;height:34px;' class='w3-select w3-border w3-round'>";
										for($p2=8;$p2<=35;$p2=$p2+0.50)
										{
											if($p2==$user_row['m_02000'])
												echo "<option selected>$p2</option>";
											else
												echo "<option>$p2</option>";
										}
										echo "<select>";
										?>
									</span>
                                    <span>
										<?php
										echo "<select name='m3[]' style='width:60px;height:34px;' class='w3-select w3-border w3-round'>";
										for($p3=8;$p3<=35;$p3=$p3+0.50)
										{
											if($p3==$user_row['m_03000'])
												echo "<option selected>$p3</option>";
											else
												echo "<option>$p3</option>";
										}
										echo "<select>";
										?>
									</span>
                                    <span>
										<?php
										echo "<select name='m4[]' style='width:60px;height:34px;' class='w3-select w3-border w3-round'>";
										for($p4=8;$p4<=35;$p4=$p4+0.50)
										{
											if($p4==$user_row['m_04000'])
												echo "<option selected>$p4</option>";
											else
												echo "<option>$p4</option>";
										}
										echo "<select>";
										?>
									</span>
                                    <span>
										<?php
										echo "<select name='m5[]' style='width:60px;height:34px;' class='w3-select w3-border w3-round'>";
										for($p5=8;$p5<=35;$p5=$p5+0.50)
										{
											if($p5==$user_row['m_05000'])
												echo "<option selected>$p5</option>";
											else
												echo "<option>$p5</option>";
										}
										echo "<select>";
										?>
									</span>
                                </li>
								<?php
								}
								?>
								<li>
									<div class="w3-row-padding w3-margin-bottom w3-margin-top w3-right-align">
										<button name="UpdateMtDistribution" class="w3-button w3-round w3-blue">Update Rates</button>
									</div>    
								</li>
                            </ul>
							</form>
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
