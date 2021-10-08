<!DOCTYPE html>
<html>
<head>
<?php include_once('_all-inner-pages-html-title.php'); ?> 
<script>
var click=0;
function updateFeeDistributionLevels(nums)
{
	var sum=0;
	for(i=1;i<=nums;i++)
	{
		if($("#lvl"+i).prop("checked"))
		sum+=parseInt($("#rto"+i).val());
	}
	if(sum!=100)
	{
		$("#ButtonFirst").show();
		$("#error-box").show();
	}
	else
	{
		click++;
		if(click==1)
		$("#UpdateFeeDistributions").click();
	}
}
function chk(row_num)
{
	var lvl=$("#lvl"+row_num).prop("checked");
	if(lvl)
	{
		$("#rto"+row_num).val(0);
		$("#rto"+row_num).prop('disabled', false);
	}
	else
	{
		$("#rto"+row_num).val(0);
		$("#rto"+row_num).prop('disabled', true);
	}
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
						include_once('zf-Level.php');
						/**************************/
						$num_rec_per_page=50;
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
						$lid=$_REQUEST['id'];
						$level_name=show_level_name($lid);
						$total_records=show_levels_count(" where level_id<$lid and level_status=1 ");
						$level_result=show_levels_data(" where level_id<$lid and level_status=1 ", $start_from, $num_rec_per_page);
						$qr="";//"&s1=$s1&s2=$s2&s3=$s3&s4=$s4&search=search";
						$i=0;
						$dist_levels=explode(",",show_dist_level($lid));
						$dist_ratios=explode(",",show_dist_ratio($lid));
						
						if(isset($_POST['UpdateFeeDistributions']))
						{
							include_once('zc-session-admin.php');
							$filled_level=$_POST['filled_level'];
							$filled_levels=implode(",", $_POST['filled_levels']);
							$filled_ratios=implode(",", $_POST['filled_ratios']);

							$filled_level=mysql_real_escape_string($filled_level);
							$filled_levels=mysql_real_escape_string($filled_levels);
							$filled_ratios=mysql_real_escape_string($filled_ratios);
							update_software_distribution_levels($filled_level,$filled_levels,$filled_ratios);
							echo "<script>window.location.href='LevelsServlet';</script>";
						}
						?>
                    	<div class="box-head">
                        	<h3>DISTRIBUTION OF SOFTWARE FEE IN UPPER LEVELS <span class="w3-right w3-blue w3-center badges"><?php echo $total_records;?></span></h3>
                        </div>
						<div class="w3-row-padding w3-margin-bottom">  
													
							<div class="w3-col m6 l4 w3-margin-top">
								<label>Level Name</label>	
								<input type="text" value="<?php echo $level_name;?>" class="w3-input w3-border w3-round" disabled>                                    
							</div>
						</div>
                        <div class="table-div wh w3-left">
                        	<ul>
								<form class="wh w3-left" method="post">
                            	<li class="table-div-head">
                                	<span>ID</span>
                                    <span>LEVEL TYPE</span>
                                    <span>LEVEL NAME</span>
                                    <span>SELECTION</span>
                                    <span>PERCENT</span>
                                </li>
								<?php
								while($level_row=mysql_fetch_array($level_result))
								{
									$i++;			
									
									$level_type=$level_row['level_type'];
									$level_id=$level_row['level_id'];
									if($level_type==1)
										$level_type="Main Admin";
									else if($level_type==2)
										$level_type="Team Member";
									else if($level_type==3)
										$level_type="Retailer";
									else if($level_type==4)
										$level_type="Affiliate Partner";
									
									$level_name=$level_row['level_name'];
								?>
                                <li>
                                	<span><?php echo $level_row['level_id'];?></span>
                                    <span><?php echo $level_type;?></span>
                                    <span><?php echo $level_name;?></span>
	<?php
	$selected_level=0;
	for($aa=0;$aa<count($dist_levels);$aa++)
	{
		$dist_level=$dist_levels[$aa];
		$dist_ratio=$dist_ratios[$aa];
		if($dist_level==$level_id)
		{
			$selected_level++;
	?>
				<span><input id="lvl<?php echo $i;?>" onclick="chk(<?php echo $i;?>)" name="filled_levels[]" class="w3-check" checked type="checkbox" value="<?php echo $dist_level;?>"></span>
				<span><input style="width:50px;" id="rto<?php echo $i;?>" name="filled_ratios[]" class="w3-input w3-round w3-border" type="text" value="<?php echo $dist_ratio;?>"></span>
	<?php
			break;
		}
	}
	if($selected_level==0)
	{
		?>
				<span><input id="lvl<?php echo $i;?>" onclick="chk(<?php echo $i;?>)" name="filled_levels[]" class="w3-check" type="checkbox" value="<?php echo $level_row['level_id'];?>"></span>
				<span><input style="width:50px;" id="rto<?php echo $i;?>" name="filled_ratios[]" disabled class="w3-input w3-round w3-border" type="text" value="0"></span>
	<?php
	}
	?>
                                    
                                </li>
								<?php
								}
								?>
                                <li>
                                	<span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span>
                                	<input type="hidden" value="<?php echo $lid;?>" name="filled_level" >
									<a class="w3-button w3-round w3-blue" onclick="updateFeeDistributionLevels(<?php echo $i;?>)">Update Distribution</a>
									<input id="UpdateFeeDistributions" name="UpdateFeeDistributions" class="display-none" type="submit"/>
									</span>
                                </li>
								</form>
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
	
	<div id="error-box" class="w3-modal">
    <div class="w3-modal-content w3-animate-zoom w3-card-4 w3-round list-pop">
      <header class="w3-container w3-blue"> 
        <span onclick="document.getElementById('error-box').style.display='none';" class="w3-button w3-display-topright"><img src="img/close.png" style="margin-bottom:0px;"></span>
        <h3 class="w3-center" id="error-title">WARNING</h3> 
      </header> 
      <div class="w3-container w3-center">
      	<p id="error-message">Sum of total distribution (percent) should be 100.</p>
      </div>  
        <div class="w3-container" style="margin-bottom:10px;">
            <div class="w3-bar w3-center">
                <a id="ButtonFirst" onclick="document.getElementById('error-box').style.display='none';" class="w3-button w3-blue w3-round">OK</a>
            </div> 
        </div> 
    </div>
  </div>
       
    <?php include_once('_footer.php');?>

</body>
</html> 
