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
						$total_records=show_levels_count($cond);
						$level_result=show_levels_data($cond, $start_from, $num_rec_per_page);
						$qr="";//"&s1=$s1&s2=$s2&s3=$s3&s4=$s4&search=search";
						$i=0;
						?>
                    	<div class="box-head">
                        	<h3>LIST OF LEVELS <span class="w3-right w3-blue w3-center badges"><?php echo $total_records;?></span></h3>
                        </div>
                        <div class="table-div wh w3-left">
                        	<ul>
                            	<li class="table-div-head">
                                	<span>SR.NO.</span>
                                    <span>LEVEL TYPE</span>
                                    <span>LEVEL NAME</span>
                                    <span>REG.USERS</span>
                                    <span>SECURITY FEE MIN MAX</span>
                                    <span>SOFTWARE FEE MIN MAX</span>
                                    <span>IS SOFTWARE FEE DISTRIBUTED</span>
                                    <span>ACTION</span>
                                </li>
								<?php
								while($level_row=mysql_fetch_array($level_result))
								{
									$i++;			
									
									$level_type=$level_row['level_type'];
									if($level_type==1)
										$level_type="Main Admin";
									else if($level_type==2)
										$level_type="Team Member";
									else if($level_type==3)
										$level_type="Retailer";
									else if($level_type==4)
										$level_type="Affiliate Partner";
									
									$st_link="";
									
									$dist_fee=$level_row['is_soft_dist'];
									if($dist_fee==1)
										$dist_fee="Yes";
									else if($dist_fee==0)
										$dist_fee="No";
									
									$dist_level=explode(",",$level_row['dist_level']);
									$dist_ratio=explode(",",$level_row['dist_ratio']);
									$dist_levels="";
									$dist_ratios="";
									$dist="";
									for($udi=0;$udi<count($dist_level);$udi++)
									{
											/*
											if($dist_levels!="")
											$dist_levels.=" / ";
											$dist_levels.=show_level_name($dist_level[$udi]);
											
											if($dist_ratios!="")
											$dist_ratios.=" / ";
											$dist_ratios.=$dist_ratio[$udi]."%";
											*/
											if($dist_level[$udi]!=0)
											{
												$dist_levels=show_level_name($dist_level[$udi]);
												$dist_ratios=$dist_ratio[$udi];
												if($dist_levels!="")
												$dist.="<br>$dist_levels : $dist_ratios %";
											}
									}
									$level_id=$level_row['level_id'];
									if($dist_fee=="No")
									{
										$dist="Distribution not applied.";
										$st_link="";
									}
									else if($dist=="" && $dist_fee=="Yes")
									{
										$dist="Distribution applied but not set.";
										$st_link.="
										&nbsp;<button onclick='location.href=\"LevelSetDistributionServlet?id=$level_id\";' class='w3-button w3-blue w3-round'>Set Distribution</button>";
									}
									else
									{
										$st_link.="
										&nbsp;<button onclick='location.href=\"LevelSetDistributionServlet?id=$level_id\";' class='w3-button w3-blue w3-round'>Modify Distribution</button>";
									}
									$joined=show_level_user_count($level_row['level_id']);
									$sec_fee=$level_row['security_min']." - ".$level_row['security_max'];
									$reg_fee=$level_row['software_min']." - ".$level_row['software_max'];
									if($sec_fee=="0 - 0")
										$sec_fee="-";
									if($reg_fee=="0 - 0")
										$reg_fee="-";
								?>
                                <li>
                                	<span><?php echo $i;?></span>
                                    <span><?php echo $level_type;?></span>
                                    <span><?php echo $level_row['level_name'];?></span>
                                    <span><?php echo $joined;?></span>
                                    <span><?php echo $sec_fee;?></span>
                                    <span><?php echo $reg_fee;?></span>
                                    <span><?php echo $dist_fee;?></span>
                                    <span><a onclick="expand('<?php echo $i;?>')" class="add-icon add<?php echo $i;?>"></a></span>
                                </li>
                                <li>
                                	<div class="address<?php echo $i;?> inner-add wh w3-left">
										<!--
                                        <p><strong>Distribution Level:</strong> <?php echo $dist_levels;?></p>
                                        <p><strong>Distribution Ratio:</strong> <?php echo $dist_ratios;?></p>-->
										<p><strong>Distribution level for software fee:</strong> <?php echo $dist;?></p>
                                        <div class="w3-bar w3-right-align">
                                            <?php echo $st_link;?>
                                        </div>
                                    </div>
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
