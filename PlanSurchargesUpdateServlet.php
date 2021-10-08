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
						include_once('zf-Service.php');
						include_once('zf-Operator.php');
						/**************************/
						$num_rec_per_page=100;
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
						$total_records=show_plans_count_surcharges($cond);
						$user_result=show_plans_data_surcharges($cond, $start_from, $num_rec_per_page);
						$qr="&s1=$s1&s2=$s2&s3=$s3&s4=$s4&s5=$s5&search=search";
						$i=0;
						if(isset($_POST['UpdateSurcharges']))
						{
							include_once('zc-session-admin.php');
							include_once('zf-Plan.php');
							
							$oprs=$_POST['opr'];
							$p1s=$_POST['p1'];
							$p2s=$_POST['p2'];
							$p3s=$_POST['p3'];
							$p4s=$_POST['p4'];
							$p5s=$_POST['p5'];
							for($aa=0;$aa<count($oprs);$aa++)
							{
								$opr=mysql_real_escape_string($oprs[$aa]);
								$p1=mysql_real_escape_string($p1s[$aa]);
								$p2=mysql_real_escape_string($p2s[$aa]);
								$p3=mysql_real_escape_string($p3s[$aa]);
								$p4=mysql_real_escape_string($p4s[$aa]);
								$p5=mysql_real_escape_string($p5s[$aa]);
								update_surcharges_amt($opr,$p1,$p2,$p3,$p4,$p5);
							}
							echo "<script>window.location.href='PlanSurchargesServlet';</script>";
						}
						?>
                    	<div class="box-head wh w3-left">
                                <h3 class="wh w3-left">Surcharges Distribution <span class="w3-right w3-blue w3-center badges"><?php echo $total_records;?></span></h3>
                        </div>
                        <div class="table-div wh w3-left">
							<form method="post">
                        	<ul>
                            	<li class="table-div-head">
                                	<span>Sr.No.</span>
                                	<span>SERVICE</span>
                                    <span>OPERATOR</span>
                                    <span>SURCHARGES RECEIVED</span>
                                    <span>Plan 1<br>(<?php echo show_plan_name(1);?>)</span>
                                    <span>Plan 2<br>(<?php echo show_plan_name(2);?>)</span>
                                    <span>Plan 3<br>(<?php echo show_plan_name(3);?>)</span>
                                    <span>Plan 4<br>(<?php echo show_plan_name(4);?>)</span>
                                    <span>Plan 5<br>(<?php echo show_plan_name(5);?>)</span>
                                </li>
								<?php
								while($user_row=mysql_fetch_array($user_result))
								{
									$i++;		
									
									$srvc=$user_row['service_id'];
									$oprt=$user_row['operator_id'];
									$type=0;
									$chg=0;
									$type=show_operator_charges($oprt)[0];
									$chg=show_operator_charges($oprt)[1];
									$srvc=show_service_name($srvc);
									$oprt=show_operator_name($oprt);
									if($type==0)
										$type="";
									else if($type==1)
										$type="Percent ";
									else if($type==-1)
										$type="Flat ";
								?>
                                <li>
                                	<span><?php echo $i;?></span>
                                	<span><?php echo $srvc;?></span>
                                    <span><?php echo $oprt;?></span>
                                    <span><?php echo $type.$chg;?><input type="hidden" name="opr[]" value="<?php echo $user_row['operator_id'];?>"/></span>
                                    <span><input name="p1[]" type="text" style="width:60px;height:30px;" class="w3-input w3-round w3-border" value="<?php echo $user_row['plan_1'];?>"/></span>
                                    <span><input name="p2[]" type="text" style="width:60px;height:30px;" class="w3-input w3-round w3-border" value="<?php echo $user_row['plan_2'];?>"/></span>
                                    <span><input name="p3[]" type="text" style="width:60px;height:30px;" class="w3-input w3-round w3-border" value="<?php echo $user_row['plan_3'];?>"/></span>
                                    <span><input name="p4[]" type="text" style="width:60px;height:30px;" class="w3-input w3-round w3-border" value="<?php echo $user_row['plan_4'];?>"/></span>
                                    <span><input name="p5[]" type="text" style="width:60px;height:30px;" class="w3-input w3-round w3-border" value="<?php echo $user_row['plan_5'];?>"/></span>
                                </li>
								<?php
								}
								?>
								<li>
									<div class="w3-row-padding w3-margin-bottom w3-margin-top w3-right-align">
										<button name="UpdateSurcharges" class="w3-button w3-round w3-blue">Update Surcharges</button>
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
