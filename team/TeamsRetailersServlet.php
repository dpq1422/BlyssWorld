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
						<?php
						include_once('../zf-TeamData.php');
						include_once('../zf-Level.php');
						include_once('../zf-State.php');
						include_once('../zf-Districts.php');
						include_once('../zf-UserLevel.php');
						/**************************/
						$num_rec_per_page=10;
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
						$total_records=show_retailer_joined_counts($cond, $logged_user_id);
						$user_result=show_retailer_joined_datas($cond, $logged_user_id, $start_from, $num_rec_per_page);
						$qr="&s1=$s1&s2=$s2&s3=$s3&s4=$s4&s5=$s5&search=search";
						$i=0;
						?>
                	<div class="table-box wh w3-left">
                    	<div class="box-head">
                        	<h3>LIST OF RETAILERS <span class="w3-right w3-blue w3-center badges"><?php echo $total_records;?></span></h3>
                        </div>
						<div class="table-search-filter wh w3-left">
							<form class="wh w3-left" method="get">
								<ul>
                                    <li>
										<label>User ID</label>
                                        <input name="s1" value="<?php echo $s1;?>" type="number" placeholder="User Id" class="w3-input w3-border w3-round">
                                    </li>
                                    <li>
										<label>&nbsp;</label>
										<button name='search' value='search' class="w3-button w3-blue w3-round">Search</button>
                                    </li>                                    
                                </ul>
                            </form>
                        </div>
                        <div class="table-div wh w3-left">
                        	<ul>
                            	<li class="table-div-head">
                                	<span>ID</span>
                                    <span>NAME</span>
                                    <span>City</span>
                                    <span>PARENT NAME</span>
                                    <span>PARENT DESIGNATION</span>
                                    <span>STATUS</span>
                                    <span>ACTION</span>
                                </li>
								<?php
								while($user_row=mysql_fetch_array($user_result))
								{
									$i++;	
									
									$st_link="";
									$user_detail=show_user_detail($user_row['user_id']);
									$user_val=mysql_fetch_array($user_detail);
									$join_date=$user_val['join_date'];
									$user_name=$user_val['user_name'];
									$city_name=$user_val['city_name'];
									$user_status=$user_val['user_status'];
									$distt_id=$user_val['distt_id'];
									$state_id=$user_val['state_id'];
									
									if($user_status==1)
									{
										$user_status="<b class='w3-text-green'>Active</b>";
									}
									else if($user_status==2)
									{
										$st_link="";
										$user_status="<b class='w3-text-red'>Blocked</b>";
										$st_link="<button class='w3-button w3-green w3-round'>Mark As Active</button>";
									}
									else if($user_status==3)
									{
										$st_link="";
										$user_status="<b class='w3-text-orange'>Suspended</b>";
									}
									else if($user_status==4)
									{
										$st_link="";
										$user_status="<b class='w3-text-blue'>Terminated</b>";
									}
									
									$parent_id=$parent_name=$parent_level_id=$parent_level_name=0;
									$parent_id=show_parent_id($user_row['user_id']);
									$parent_detail=show_user_detail($parent_id);
									$parent_val=mysql_fetch_array($parent_detail);
									$parent_name=$parent_val['user_name'];
									$parent_level_id=$parent_val['user_type'];
									$userid=$user_row['user_id'];
									$is_my_user=isMyUser($mytype,$myid,$userid);
									$st_link="$st_link
										<button onclick='location.href=\"ShowUserMarginServlet?uid=$userid\";' class='w3-button w3-blue w3-round'>Show Margin</button>";
									if($is_my_user!=0)
									{
										$st_link="$st_link
										<button onclick='location.href=\"SetUserMarginServlet?uid=$userid\";' class='w3-button w3-green w3-round'>Edit Margin</button>";
									}
									
									if($parent_level_id==1)
									{
										$parent_level_name="<b class='w3-text-green'>".show_level_name($parent_level_id)."</b>";
									}
									if($parent_level_id==2)
									{
										$parent_level_name="<b class='w3-text-red'>".show_level_name($parent_level_id)."</b>";
									}
									if($parent_level_id==3)
									{
										$parent_level_name="<b class='w3-text-blue'>".show_level_name($parent_level_id)."</b>";
									}
									if($parent_level_id==4)
									{
										$parent_level_name="<b class='w3-text-orange'>".show_level_name($parent_level_id)."</b>";
									}
									if($parent_level_id==5)
									{
										$parent_level_name="<b class='w3-text-brown'>".show_level_name($parent_level_id)."</b>";
									}
								?>
                                <li>
                                	<span><?php echo $user_row['user_id'];?></span>
                                    <span><?php echo $user_name;?></span>
                                    <span><?php echo $city_name;?></span>
                                    <span><?php echo $parent_name;?></span>
                                    <span><?php echo $parent_level_name;?></span>
                                    <span><?php echo $user_status;?></span>
                                    <span><a onclick="expand('<?php echo $i;?>')" class="add-icon add<?php echo $i;?>"></a></span>
                                </li>
                                <li>
                                	<div class="address<?php echo $i;?> inner-add wh w3-left">
                                        <p><strong>District:</strong> <?php echo show_district_name($distt_id);?></p>
                                        <p><strong>State:-</strong> <?php echo show_state_name($state_id);?></p>
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
       
    <?php include_once('_footer.php');?>

</body>
</html> 
