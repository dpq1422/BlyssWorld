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
						include_once('zf-User.php');
						include_once('zf-State.php');
						include_once('zf-Districts.php');
						/**************************/
						$num_rec_per_page=8;
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
						$total_records=show_users_count($cond);
						$user_result=show_users_data($cond, $start_from, $num_rec_per_page);
						$qr="&s1=$s1&s2=$s2&s3=$s3&s4=$s4&search=search";
						$i=0;
						?>
                    	<div class="box-head wh w3-left">
                                <h3 class="wh w3-left">LIST OF USERS <a href="DownloadUserServlet?q=q<?php echo $qr;?>" class="down-excel w3-right w3-green w3-center badges">Download Excel</a> <a href="#" class="search-data w3-right w3-green w3-center badges">Search</a> <span class="w3-right w3-blue w3-center badges"><?php echo $total_records;?></span></h3>
                        </div>
						<div class="table-search-filter wh w3-left">
							<form class="wh w3-left" method="get">
								<ul>
                                    <li>
										<label>User ID</label>
                                        <input name="s1" value="<?php echo $s1;?>" type="number" placeholder="User Id" class="w3-input w3-border w3-round">
                                    </li>
                                    <li>
										<label>User Name</label>
                                        <input name="s2" value="<?php echo $s2;?>" type="text" placeholder="User Name" class="w3-input w3-border w3-round">
                                    </li>
                                    <li>
										<label>User Type</label>
                                        <select name="s3" class="w3-input w3-border w3-round">
											<option value=''>Select User</option>
                                            <option value='1' <?php if($s3==1) echo "selected";?>>Application Admin</option>
                                            <option value='2' <?php if($s3==2) echo "selected";?>>Service Manager</option>
                                            <option value='3' <?php if($s3==3) echo "selected";?>>Tariff Manager</option>
                                            <option value='4' <?php if($s3==4) echo "selected";?>>Client Manager</option>
                                            <option value='5' <?php if($s3==5) echo "selected";?>>Order Manager</option>
                                        </select>
                                    </li>
                                    <li>
										<label>Status</label>
                                        <select name="s4" class="w3-input w3-border w3-round">
											<option value=''>Select Status</option>
                                            <option value='1' <?php if($s4==1) echo "selected";?>>Active</option>
                                            <option value='2' <?php if($s4==2) echo "selected";?>>Blocked</option>
                                            <option value='3' <?php if($s4==3) echo "selected";?>>Suspended</option>
                                            <option value='4' <?php if($s4==4) echo "selected";?>>Terminated</option>
                                        </select>
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
                                    <span>DATE OF JOINING</span>
                                    <span>USER TYPE</span>
                                    <span>NAME</span>
                                    <span>GENDER</span>
                                    <span>CITY</span>
                                    <span>STATUS</span>
                                    <span>ACTION</span>
                                </li>
								<?php
								while($user_row=mysql_fetch_array($user_result))
								{
									$i++;			
									
									$user_type=$user_row['user_type'];
									if($user_type==1)
										$user_type="Application Admin";
									else if($user_type==2)
										$user_type="Service Manager";
									else if($user_type==3)
										$user_type="Tariff Manager";
									else if($user_type==4)
										$user_type="Client Manager";
									else if($user_type==5)
										$user_type="Order Manager";
									
									$user_gender=$user_row['gender'];
									if($user_gender==1)
										$user_gender="Male";
									else if($user_gender==0)
										$user_gender="Female";
									else if($user_gender==-1)
										$user_gender="Trans Gender";
									
									$user_status=$user_row['user_status'];
									$st_link="";
									if($user_status==1)
									{
										$user_status="<b class='w3-text-green'>Active</b>";
										$st_link="<button class='w3-button w3-red w3-round'>Mark As Block</button>
										<button class='w3-button w3-orange w3-round'>Mark As Suspend</button>
										<button class='w3-button w3-blue w3-round'>Mark As Terminate</button>";
									}
									else if($user_status==2)
									{
										$st_link="";
										$user_status="<b class='w3-text-red'>Blocked</b>";
										$st_link="<button class='w3-button w3-green w3-round'>Mark As Active</button>
										<button class='w3-button w3-orange w3-round'>Mark As Suspend</button>
										<button class='w3-button w3-blue w3-round'>Mark As Terminate</button>";
									}
									else if($user_status==3)
									{
										$st_link="";
										$user_status="<b class='w3-text-orange'>Suspended</b>";
										$st_link="<button class='w3-button w3-green w3-round'>Mark As Active</button>
										<button class='w3-button w3-red w3-round'>Mark As Block</button>
										<button class='w3-button w3-blue w3-round'>Mark As Terminate</button>";
									}
									else if($user_status==4)
									{
										$st_link="";
										$user_status="<b class='w3-text-blue'>Terminated</b>";
										$st_link="<button class='w3-button w3-green w3-round'>Mark As Active</button>
										<button class='w3-button w3-red w3-round'>Mark As Block</button>
										<button class='w3-button w3-orange w3-round'>Mark As Suspend</button>";
									}
									$usrdpt=check_user_department($user_row['user_id']);
									$usrdpts=explode(",",$usrdpt);
									$usrdpt2="";
									for($udi=0;$udi<count($usrdpts);$udi++)
									{
										if($usrdpts[$udi]==0)
										{
											$usrdpt2.="<b class='w3-text-red'>Not Allocated</b>";
										}
										else if($usrdpts[$udi]==1)
										{
											if($usrdpt2!="")
											$usrdpt2.=", ";
											$usrdpt2.="Master";
										}
										else if($usrdpts[$udi]==2)
										{
											if($usrdpt2!="")
											$usrdpt2.=", ";
											$usrdpt2.="Setup";
										}
										else if($usrdpts[$udi]==3)
										{
											if($usrdpt2!="")
											$usrdpt2.=", ";
											$usrdpt2.="Client";
										}
										else if($usrdpts[$udi]==4)
										{
											if($usrdpt2!="")
											$usrdpt2.=", ";
											$usrdpt2.="Wallet";
										}
										else if($usrdpts[$udi]==5)
										{
											if($usrdpt2!="")
											$usrdpt2.=", ";
											$usrdpt2.="Transactions";
										}
										else if($usrdpts[$udi]==6)
										{
											if($usrdpt2!="")
											$usrdpt2.=", ";
											$usrdpt2.="Support";
										}
										else if($usrdpts[$udi]==7)
										{
											if($usrdpt2!="")
											$usrdpt2.=", ";
											$usrdpt2.="Audit";
										}
										else if($usrdpts[$udi]==8)
										{
											if($usrdpt2!="")
											$usrdpt2.=", ";
											$usrdpt2.="Report";
										}
									}
								?>
                                <li>
                                	<span><?php echo $user_row['user_id'];?></span>
                                    <span><?php echo $user_row['join_date'];?></span>
                                    <span><?php echo $user_type;?></span>
                                    <span><?php echo $user_row['user_name'];?></span>
                                    <span><?php echo $user_gender;?></span>
                                    <span><?php echo $user_row['city_name'];?></span>
                                    <span><?php echo $user_status;?></span>
                                    <span><a onclick="expand('<?php echo $i;?>')" class="add-icon add<?php echo $i;?>"></a></span>
                                </li>
                                <li>
                                	<div class="address<?php echo $i;?> inner-add wh w3-left">
                                        <p><strong>Department:</strong> <?php echo $usrdpt2;?></p>
                                        <p><strong>Email:</strong> <?php echo $user_row['e_mail'];?></p>
                                        <p><strong>Contact No:</strong> <?php echo $user_row['user_contact_no'];?></p>
                                        <p><strong>Address:</strong> <?php echo $user_row['address'];?></p>
                                        <p><strong>District:</strong> <?php echo show_district_name($user_row['distt_id']);?></p>
                                        <p><strong>State:-</strong> <?php echo show_state_name($user_row['state_id']);?></p>
                                        <p><strong>Pin Code:</strong> <?php echo $user_row['area_pin_code'];?></p>
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
