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
						include_once('zf-remCom.php');
						remove_comm_all();
						include_once('zf-Commission.php');
						include_once('zf-User.php');
						include_once('zf-Level.php');
						/**************************/
						$num_rec_per_page=500;
						if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
						$start_from = ($page-1) * $num_rec_per_page;
						/**************************/
						$s1=$s2=$s3=$s4=$s5="";
						if(isset($_REQUEST['s2']))
							$s2=$_REQUEST['s2'];
						if(isset($_REQUEST['s3']))
							$s3=$_REQUEST['s3'];
						
						if($s2=="")
							$s2="2018-09-16";
						if($s3=="")
							$s3="$datetime_date";
						$cond=" where 1=1 and user_id not in(1,200000) and date(date_time) between '$s2' and '$s3' ";
						if(isset($_REQUEST['search']))
						{
							if(isset($_REQUEST['s1'])) $s1=mysql_real_escape_string($_REQUEST['s1']);
							//if(isset($_REQUEST['s2'])) $s2=mysql_real_escape_string($_REQUEST['s2']);
							//if(isset($_REQUEST['s3'])) $s3=mysql_real_escape_string($_REQUEST['s3']);
							//if(isset($_REQUEST['s4'])) $s4=mysql_real_escape_string($_REQUEST['s4']);
							//if(isset($_REQUEST['s5'])) $s5=mysql_real_escape_string($_REQUEST['s5']);
							if($s1!=""){$cond.=" and user_id='$s1' ";}
							//if($s2!=""){$cond.=" and user_name like '%$s2%' ";}
							//if($s3!=""){$cond.=" and user_type='$s3' ";}
							//if($s4!=""){$cond.=" and user_department_info like '%$s4%' ";}
							//if($s5!=""){$cond.=" and user_status='$s5' ";}
						}
						$total_records=show_team_commission_count($cond);
						$user_result=show_team_commission_data($cond, $start_from, $num_rec_per_page);
						$qr="&s1=$s1&s2=$s2&s3=$s3&s4=$s4&s5=$s5&search=search";
						$i=0;
						?>
                    	<div class="box-head">
                        	<h3>Team Commission <span class="w3-right w3-blue w3-center badges"><?php echo $total_records;?></span></h3>
                        </div>
						<div class="table-search-filter wh w3-left">
							<form class="wh w3-left" method="get">
								<ul>
                                    <li>
										<label>From Date</label>
                                        <input name="s2" id="s2" value="<?php echo $s2;?>" type="date" placeholder="From Date" class="w3-input w3-border w3-round">
                                    </li>
                                    <li>
										<label>To Date</label>
                                        <input name="s3" id="s3" value="<?php echo $s3;?>" type="date" placeholder="To Date" class="w3-input w3-border w3-round">
                                    </li>
                                    <li>
										<label>User Id</label>
                                        <input name="s1" id="s1" value="<?php echo $s1;?>" type="number" placeholder="User Id" class="w3-input w3-border w3-round">
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
                                    <span>SR.NO.</span>
                                    <span>USER ID</span>
                                    <span>USER NAME</span>
                                    <span>DESIGNATION</span>
                                    <!--<span>LOCATION</span>
                                    <span>PARENT NAME</span>
                                    <span>DESIGNATION</span>-->
                                    <span class='w3-right-align'>GENERATED COMMISSION</span>
                                    <span class='w3-right-align'>PAID COMMISSION</span>
                                    <span class='w3-right-align'>REMAIN COMMISSION</span>
                                    <span>ACTION</span>
                                </li>
								<?php
								$a1=$a2=$a3=0;
								while($user_row=mysql_fetch_array($user_result))
								{
									$uids=$user_row['user_id'];
									$links="<button class='w3-button w3-blue w3-round' onclick='location.href=\"CommissionUserEarning?uid=$uids\";'>Show Details</button>";
									if($user_row['dr']!=0)
									$links.=" <button class='w3-button w3-green w3-round' onclick='location.href=\"CommissionUserPaid.php?uid=$uids\";'>Show Paid Commissions</button>";
									//if($user_row['bal']>100 || $uids==$main_admin)
									if($uids!=$main_admin)
									$links.=" <button class='w3-button w3-orange w3-round' onclick='location.href=\"CommissionTeamPayNowServlet?userid=$uids&dt1=$s2&dt2=$s3\";'>PAY NOW</button>";
									if($uids==$main_admin)
									$links.=" <button class='w3-button w3-orange w3-round' onclick='location.href=\"CommissionTeamPayNowServlets?userid=$uids&dt1=$s2&dt2=$s3\";'>PAY NOW</button>";
								
									$un=show_user_name($uids);
									//if($un=="")
										//continue;
									$i++;	
									$utp=show_user_type($uids);
									$utpn=show_level_name($utp);
									if($utp==1)
										$utpn="<b class='w3-text-orange'>$utpn</b>";
									if($utp>1 && $utp<12)
										$utpn="<b class='w3-text-blue'>$utpn</b>";
									if($utp==12)
										$utpn="<b class='w3-text-green'>$utpn</b>";
									$a1+=$user_row['cr'];
									$a2+=$user_row['dr'];
									$a3+=$user_row['bal'];
								?>
                                <li>
                                    <span><?php echo $i;?></span>
                                    <span><?php echo $uids;?></span>
                                    <span><?php echo $un;?></span>
                                    <span><?php echo $utpn;;?></span>
                                    <!--<span></span>
                                    <span></span>
                                    <span></span>-->
                                    <span class='w3-right-align'><?php echo $user_row['cr'];?></span>
                                    <span class='w3-right-align'><?php if($user_row['dr']!=0) echo $user_row['dr'];?></span>
                                    <span class='w3-right-align'><?php echo $user_row['bal'];?></span>
                                    <span><a onclick="expand('<?php echo $i;?>')" class="add-icon add<?php echo $i;?>"></a></span>
                                </li>
                                <li>
                                	<div class="address<?php echo $i;?> inner-add wh w3-left">
                                        <div class="w3-bar w3-right-align">
                                            <?php echo $links;?>
                                        </div>
                                    </div>
                                </li>
								<?php
								}	
								?>
                            	<li class="table-div-head">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <!--<span>LOCATION</span>
                                    <span>PARENT NAME</span>
                                    <span>DESIGNATION</span>-->
                                    <span class='w3-right-align'><?php echo $a1;?></span>
                                    <span class='w3-right-align'><?php echo $a2;?></span>
                                    <span class='w3-right-align'><?php echo $a3;?></span>
                                    <span></span>
                                </li>
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
