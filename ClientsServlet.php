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
						include_once('zf-Client.php');
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
						$total_records=show_clients_count($cond);
						$client_result=show_clients_data($cond, $start_from, $num_rec_per_page);
						$qr="";//"&s1=$s1&s2=$s2&s3=$s3&s4=$s4&search=search";
						$i=0;
						?>
                    	<div class="box-head wh w3-left">
							<h3 class="wh w3-left">LIST OF CLIENTS <span class="w3-right w3-blue w3-center badges"><?php echo $total_records;?></span></h3>
                        </div>
                        <div class="table-div wh w3-left">
                        	<ul>
                            	<li class="table-div-head">
                                	<span>ID</span>
                                    <span>DATE OF JOINING</span>
                                    <span>CLIENT TYPE</span>
                                    <span>CLIENT NAME</span>
                                    <span>CITY</span>
                                    <span>WALLET BALANCE</span>
                                    <span>STATUS</span>
                                    <span>ACTION</span>
                                </li>
								<?php
								while($client_row=mysql_fetch_array($client_result))
								{
									$i++;			
									
									$client_types=$client_type=$client_row['client_type'];
									$cid=$client_row['client_id'];
									$st_link="";
									if($client_type==3)
									{
										$client_type="<b class='w3-text-green'>API with Fixed Rate</b>";
										$st_link="<button onclick='location.href=\"ClientSetAllocateServiceServlet?id=$cid\";' class='w3-button w3-blue w3-round'>ALLOCATE SERVICE</button>";
									}
									else if($client_type==2)
									{
										$client_type="<b class='w3-text-blue'>Portal with Fixed Rate</b>";
										$st_link="<button onclick='location.href=\"ClientSetAllocateServiceServlet?id=$cid\";' class='w3-button w3-blue w3-round'>ALLOCATE SERVICE</button>
                                        <button onclick='location.href=\"ClientSetLevelsServlet?id=$cid\";' class='w3-button w3-blue w3-round'>SET LEVELS</button>";
									}
									else if($client_type==1)
									{
										$client_type="<b class='w3-text-orange'>Portal with Dynamic Rate</b>";
										$st_link="<button onclick='location.href=\"ClientSetAllocateServiceServlet?id=$cid\";' class='w3-button w3-blue w3-round'>ALLOCATE SERVICE</button>
										<button onclick='location.href=\"ClientSetLevelsServlet?id=$cid\";' class='w3-button w3-blue w3-round'>SET LEVELS</button>";
									}
									
									$st_link="$st_link
										<button onclick='location.href=\"ClientAddAdvanceServlet?id=$cid\";' class='w3-button w3-green w3-round'>Add Advance</button>
										<button onclick='location.href=\"ClientWithdrawAdvanceServlet?id=$cid\";' class='w3-button w3-orange w3-round'>Withdraw Advance</button>";
									
									$client_status=$client_row['client_status'];
									if($client_status==1)
									{
										$client_status="<b class='w3-text-green'>Active</b>";
										$st_link="$st_link
										<button class='w3-button w3-red w3-round'>Mark As Block</button>";
									}
									else if($client_status==0)
									{
										$client_status="<b class='w3-text-red'>Blocked</b>";
										$st_link="$st_link
										<button class='w3-button w3-green w3-round'>Mark As Active</button>";
									}
									
									$client_services=$client_row['service_id'];
									$charges_links="<b>SET COMMISSION/CHARGES</b>&nbsp;&nbsp;&nbsp;";
									$pos = strpos($client_services, "101");//MT
									if ($pos !== false) 
									{
										$charges_links.="<button title='101' onclick='location.href=\"ClientSetMtMarginServlet?id=$cid\";' class='w3-button w3-blue w3-round'>MT</button>
										";
									}
									$pos = strpos($client_services, "102");//PREPAID
									if ($pos !== false) 
									{
										$charges_links.="<button title='102' onclick='location.href=\"ClientSetRcMarginServlet?id=$cid\";' class='w3-button w3-blue w3-round'>PREPAID</button>
										";
									}
									$pos = strpos($client_services, "103");//DTH
									if ($pos !== false) 
									{
										$charges_links.="<button title='103' onclick='location.href=\"ClientSetDthMarginServlet?id=$cid\";' class='w3-button w3-blue w3-round'>DTH</button>
										";
									}
									$pos = strpos($client_services, "106");//POSTPAID
									if ($pos !== false) 
									{
										$charges_links.="<button title='106' onclick='location.href=\"ClientSetPostpaidMarginServlet?id=$cid\";' class='w3-button w3-blue w3-round'>POSTPAID</button>
										";
									}
									$pos = strpos($client_services, "105");//ELECTRICITY
									if ($pos !== false) 
									{
										$charges_links.="<button title='105' onclick='location.href=\"ClientSetElecMarginServlet?id=$cid\";' class='w3-button w3-blue w3-round'>ELEC.</button>
										";
									}
									$pos = strpos($client_services, "117");//WATER
									if ($pos !== false) 
									{
										$charges_links.="<button title='117' onclick='location.href=\"ClientSetWaterMarginServlet?id=$cid\";' class='w3-button w3-blue w3-round'>WATER</button>
										";
									}
									$pos = strpos($client_services, "114");//GAS
									if ($pos !== false) 
									{
										$charges_links.="<button title='114' onclick='location.href=\"ClientSetGasMarginServlet?id=$cid\";' class='w3-button w3-blue w3-round'>GAS</button>
										";
									}
									$pos = strpos($client_services, "113");//LANDLINE
									if ($pos !== false) 
									{
										$charges_links.="<button title='113' onclick='location.href=\"ClientSetLandlineMarginServlet?id=$cid\";' class='w3-button w3-blue w3-round'>LANDLINE</button>
										";
									}
									$pos = strpos($client_services, "116");//DATACARD
									if ($pos !== false) 
									{
										$charges_links.="<button title='116' onclick='location.href=\"ClientSetDatacardMarginServlet?id=$cid\";' class='w3-button w3-blue w3-round'>DATACARD</button>
										";
									}
									$pos = strpos($client_services, "115");//INSURANCE
									if ($pos !== false) 
									{
										$charges_links.="<button title='115' onclick='location.href=\"ClientSetInsuranceMarginServlet?id=$cid\";' class='w3-button w3-blue w3-round'>INSURANCE</button>
										";
									}
									$clientdb="";
									$clientdb=$bankapi_child.$client_types."_".$cid;
									$client_row['bal_amt']=update_client_rt_balancessss($clientdb,$cid);
								?>
                                <li>
                                	<span><?php echo $client_row['client_id'];?></span>
                                    <span><?php echo $client_row['join_date'];?></span>
                                    <span><?php echo $client_type;?></span>
                                    <span><?php echo $client_row['client_name'];?></span>
                                    <span><?php echo $client_row['city_name'];?></span>
                                    <span class="w3-right-align"><?php echo $client_row['bal_amt'];?></span>
                                    <span><?php echo $client_status;?></span>
                                    <span><a onclick="expand('<?php echo $i;?>')" class="add-icon add<?php echo $i;?>"></a></span>
                                </li>
                                <li>
                                	<div class="address<?php echo $i;?> inner-add wh w3-left">
										<table cellpadding='10'>
											<tr>
												<td width="30%" valign="top">
													<p><h3>Contact Info</h3></p>
													<p><strong>Address:-</strong><?php echo $client_row['address'];?></p>
													<p><strong>District:-</strong> <?php echo show_district_name($client_row['distt_id']);?></p>
													<p><strong>State:-</strong> <?php echo show_state_name($client_row['state_id']);?></p>
													<p><strong>Pin Code:-</strong> <?php echo $client_row['area_pin_code'];?></p>
													<p><strong>Contact No:-</strong> <?php echo $client_row['contact_no'];?></p>
													<p><strong>Email:-</strong> <?php echo $client_row['e_mail'];?></p>
												</td>
												<td width="20%" valign="top">
													<p><h3>Wallet Info</h3></p>
													<p><strong>Wallet Balance:-</strong> <?php echo $client_row['bal_amt'];?></p>
													<p><strong>Security Amount:-</strong> <?php echo $client_row['sec_amt'];?></p>
													<p><strong>Software Amount:-</strong> <?php echo $client_row['soft_amt'];?></p>
													<p><strong>Advance Amount:-</strong> <?php echo $client_row['dummy_balance'];?></p>
												</td>
												<td width="20%" valign="top">
													<p><h3>Site / Account Info</h3></p>
													<p><strong>Website:-</strong> <?php echo $client_row['web_site'];?></p>
													<p><strong>Static IP:-</strong> <?php echo $client_row['client_static_ip'];?></p>
													<p><strong>GEO Location:-</strong> <?php echo $client_row['geo_location'];?></p>
													<p><strong>PAN No:-</strong> <?php echo $client_row['pan_no'];?></p>
													<p><strong>GST No:-</strong> <?php echo $client_row['gst_no'];?></p>
													<p><strong>Aadhar No:-</strong> <?php echo $client_row['aadhar_no'];?></p>
												</td>
												<td width="30%" valign="top">
													<p><h3>Additional Facilities</h3></p>
													<p><strong>GST Format:-</strong> <?php if($client_row['facility_gst_format']==1)echo "Yes"; else echo "No";?></p>
													<p><strong>Employee Creation by Admin:-</strong> <?php if($client_row['facility_employee_admin']==1)echo "Yes"; else echo "No";?></p>
													<p><strong>Employee Creation by Team:-</strong> <?php if($client_row['facility_employee_team']==1)echo "Yes"; else echo "No";?></p>
													<p><strong>Queue Txn by R	etailer:-</strong> <?php if($client_row['facility_queue_txn']==1)echo "Yes"; else echo "No";?></p>
													<p><strong>MAB Facility:-</strong> <?php if($client_row['facility_mab']==1)echo "Yes"; else echo "No";?></p>
													<p><strong>Holding Facility:-</strong> <?php if($client_row['facility_holding']==1)echo "Yes"; else echo "No";?></p>
												</td>
											</tr>
										</table>
                                        <div class="w3-bar w3-right-align">
                                            <p><?php echo $st_link;?></p>
                                        </div>
                                        <div class="w3-bar w3-right-align">
                                            <p><?php echo $charges_links;?></p>
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
