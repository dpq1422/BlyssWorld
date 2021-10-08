<!DOCTYPE html>
<html>
<head>
<?php include_once('_all-inner-pages-html-title.php'); ?>
<script type="text/javascript" src="js/admin-validation-functions.js"></script>
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
                    	<div class="box-head">
                        	<h3>TEAM WORK REPORT </h3>
                        </div>
						<?php
						$dt1="";
						$dt2="";
						
						if(isset($_POST['dt1']))
						{
							$dt1=$_POST['dt1'];
						}
						
						if(isset($_POST['dt2']))
						{
							$dt2=$_POST['dt2'];
						}
						
						if($dt1=="")
						{
							$dt1="$datetime_date";
						}
						
						if($dt2=="")
						{
							$dt2="$datetime_date";
						}
						$total1=$total2=0;
						?>
						<div class="table-search-filter wh w3-left">
							<form class="wh w3-left" method="post">
								<ul>
                                    <li>
										<label>Date</label>
										<input name="dt1" id="dt1" value="<?php echo $dt1;?>" type="date" placeholder="Date" class="w3-input w3-border w3-round">
                                    </li>
                                    <li>
										<label>Date</label>
										<input name="dt2" id="dt2" value="<?php echo $dt2;?>" type="date" placeholder="Date" class="w3-input w3-border w3-round">
                                    </li>
                                    <li>
										<label>&nbsp;</label>
										<button name="search" value="search" class="w3-button w3-blue w3-round">Show Collection</button>
                                    </li>                                    
                                </ul>
                            </form>
                        </div>
						<div class="table-search-filter wh w3-left">
                            <table class="w3-table-all" id="myTable">
                                <tr class="w3-blue">
                                	<th>DMT</th>
                                	<th>RETAILER ID</th>
                                    <th>RETAILER NAME</th>
                                    <th>TXNs</th>
                                    <th>AMOUNT</th>
                                    <th>PARENT ID</th>
                                    <th>PARENT NAME</th>
                                    <th>PARENT DESIGNATION</th>
                                </tr>
								<?php
								include_once('../zf-User.php');
								include_once('../zf-Level.php');
								include_once('../zf-UserLevel.php');
								include_once('../zf-Commission.php');
								include_once('../zc-commons-admin.php');
								gen_elec_report();
								
								$collection_result=show_my_team_collection_type($logged_user_id,$dt1,$dt2,1);
								$i=0;
								$a=$b=0;
								while($collection_row=mysql_fetch_array($collection_result))
								{
									$i++;	
									$userid=$collection_row['user_id'];
									$username=show_user_name($userid);
									
									$parent_id=$parent_name=$parent_level_id=$parent_level_name=$main_admin;
									$parent_id=show_parent_id($userid);
									$parent_name=show_user_name($parent_id);
									$parent_level_id=show_user_type($parent_id);
									
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
									$rowval="";
									if($i%2==1)
										$rowval="class='w3-light-grey'";
									$a+=$collection_row['nums'];
									$b+=$collection_row['amt'];
								?>
                                <tr <?php echo $rowval;?>>
                                	<td><?php echo $i;?></td>
                                	<td><?php echo $userid;?></td>
                                    <td><?php echo $username;?></td>
                                    <td><?php echo $collection_row['nums'];?></td>
                                    <td><?php echo $collection_row['amt'];?></td>
                                    <td><?php echo $parent_id;?></td>
                                    <td><?php echo $parent_name;?></td>
                                    <td><?php echo $parent_level_name;?></td>
                                </tr>
								<?php
								}
								$total1+=$a;
								$total2+=$b;
								?>
                                <tr>
                                	<td></td>
                                	<td></td>
                                    <td></td>
                                    <td><b><?php echo $a;?></b></td>
                                    <td><b><?php echo $b;?></b></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </table>
                        </div>
						<div class="table-search-filter wh w3-left">
                            <table class="w3-table-all" id="myTable">
                                <tr class="w3-blue">
                                	<th>PREPAID</th>
                                	<th>RETAILER ID</th>
                                    <th>RETAILER NAME</th>
                                    <th>TXNs</th>
                                    <th>AMOUNT</th>
                                    <th>PARENT ID</th>
                                    <th>PARENT NAME</th>
                                    <th>PARENT DESIGNATION</th>
                                </tr>
								<?php
								include_once('../zf-User.php');
								include_once('../zf-Level.php');
								include_once('../zf-UserLevel.php');
								include_once('../zf-Commission.php');
								include_once('../zc-commons-admin.php');
								$collection_result=show_my_team_collection_type($logged_user_id,$dt1,$dt2,3);
								$i=0;
								$a=$b=0;
								while($collection_row=mysql_fetch_array($collection_result))
								{
									$i++;	
									$userid=$collection_row['user_id'];
									$username=show_user_name($userid);
									
									$parent_id=$parent_name=$parent_level_id=$parent_level_name=$main_admin;
									$parent_id=show_parent_id($userid);
									$parent_name=show_user_name($parent_id);
									$parent_level_id=show_user_type($parent_id);
									
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
									$rowval="";
									if($i%2==1)
										$rowval="class='w3-light-grey'";
									$a+=$collection_row['nums'];
									$b+=$collection_row['amt'];
								?>
                                <tr <?php echo $rowval;?>>
                                	<td><?php echo $i;?></td>
                                	<td><?php echo $userid;?></td>
                                    <td><?php echo $username;?></td>
                                    <td><?php echo $collection_row['nums'];?></td>
                                    <td><?php echo $collection_row['amt'];?></td>
                                    <td><?php echo $parent_id;?></td>
                                    <td><?php echo $parent_name;?></td>
                                    <td><?php echo $parent_level_name;?></td>
                                </tr>
								<?php
								}
								$total1+=$a;
								$total2+=$b;
								?>
                                <tr>
                                	<td></td>
                                	<td></td>
                                    <td></td>
                                    <td><b><?php echo $a;?></b></td>
                                    <td><b><?php echo $b;?></b></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </table>
                        </div>  
						<div class="table-search-filter wh w3-left">
                            <table class="w3-table-all" id="myTable">
                                <tr class="w3-blue">
                                	<th>DTH</th>
                                	<th>RETAILER ID</th>
                                    <th>RETAILER NAME</th>
                                    <th>TXNs</th>
                                    <th>AMOUNT</th>
                                    <th>PARENT ID</th>
                                    <th>PARENT NAME</th>
                                    <th>PARENT DESIGNATION</th>
                                </tr>
								<?php
								include_once('../zf-User.php');
								include_once('../zf-Level.php');
								include_once('../zf-UserLevel.php');
								include_once('../zf-Commission.php');
								include_once('../zc-commons-admin.php');
								$collection_result=show_my_team_collection_type($logged_user_id,$dt1,$dt2,4);
								$i=0;
								$a=$b=0;
								while($collection_row=mysql_fetch_array($collection_result))
								{
									$i++;	
									$userid=$collection_row['user_id'];
									$username=show_user_name($userid);
									
									$parent_id=$parent_name=$parent_level_id=$parent_level_name=$main_admin;
									$parent_id=show_parent_id($userid);
									$parent_name=show_user_name($parent_id);
									$parent_level_id=show_user_type($parent_id);
									
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
									$rowval="";
									if($i%2==1)
										$rowval="class='w3-light-grey'";
									$a+=$collection_row['nums'];
									$b+=$collection_row['amt'];
								?>
                                <tr <?php echo $rowval;?>>
                                	<td><?php echo $i;?></td>
                                	<td><?php echo $userid;?></td>
                                    <td><?php echo $username;?></td>
                                    <td><?php echo $collection_row['nums'];?></td>
                                    <td><?php echo $collection_row['amt'];?></td>
                                    <td><?php echo $parent_id;?></td>
                                    <td><?php echo $parent_name;?></td>
                                    <td><?php echo $parent_level_name;?></td>
                                </tr>
								<?php
								}
								$total1+=$a;
								$total2+=$b;
								?>
                                <tr>
                                	<td></td>
                                	<td></td>
                                    <td></td>
                                    <td><b><?php echo $a;?></b></td>
                                    <td><b><?php echo $b;?></b></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </table>
                        </div>  
						<div class="table-search-filter wh w3-left">
                            <table class="w3-table-all" id="myTable">
                                <tr class="w3-blue">
                                	<th>POSTPAID</th>
                                	<th>RETAILER ID</th>
                                    <th>RETAILER NAME</th>
                                    <th>TXNs</th>
                                    <th>AMOUNT</th>
                                    <th>PARENT ID</th>
                                    <th>PARENT NAME</th>
                                    <th>PARENT DESIGNATION</th>
                                </tr>
								<?php
								include_once('../zf-User.php');
								include_once('../zf-Level.php');
								include_once('../zf-UserLevel.php');
								include_once('../zf-Commission.php');
								include_once('../zc-commons-admin.php');
								$collection_result=show_my_team_collection_type($logged_user_id,$dt1,$dt2,5);
								$i=0;
								$a=$b=0;
								while($collection_row=mysql_fetch_array($collection_result))
								{
									$i++;	
									$userid=$collection_row['user_id'];
									$username=show_user_name($userid);
									
									$parent_id=$parent_name=$parent_level_id=$parent_level_name=$main_admin;
									$parent_id=show_parent_id($userid);
									$parent_name=show_user_name($parent_id);
									$parent_level_id=show_user_type($parent_id);
									
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
									$rowval="";
									if($i%2==1)
										$rowval="class='w3-light-grey'";
									$a+=$collection_row['nums'];
									$b+=$collection_row['amt'];
								?>
                                <tr <?php echo $rowval;?>>
                                	<td><?php echo $i;?></td>
                                	<td><?php echo $userid;?></td>
                                    <td><?php echo $username;?></td>
                                    <td><?php echo $collection_row['nums'];?></td>
                                    <td><?php echo $collection_row['amt'];?></td>
                                    <td><?php echo $parent_id;?></td>
                                    <td><?php echo $parent_name;?></td>
                                    <td><?php echo $parent_level_name;?></td>
                                </tr>
								<?php
								}
								$total1+=$a;
								$total2+=$b;
								?>
                                <tr>
                                	<td></td>
                                	<td></td>
                                    <td></td>
                                    <td><b><?php echo $a;?></b></td>
                                    <td><b><?php echo $b;?></b></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </table>
                        </div>  
						<div class="table-search-filter wh w3-left">
                            <table class="w3-table-all" id="myTable">
                                <tr class="w3-blue">
                                	<th>ELECTRICITY</th>
                                	<th>RETAILER ID</th>
                                    <th>RETAILER NAME</th>
                                    <th>TXNs</th>
                                    <th>AMOUNT</th>
                                    <th>PARENT ID</th>
                                    <th>PARENT NAME</th>
                                    <th>PARENT DESIGNATION</th>
                                </tr>
								<?php
								include_once('../zf-User.php');
								include_once('../zf-Level.php');
								include_once('../zf-UserLevel.php');
								include_once('../zf-Commission.php');
								include_once('../zc-commons-admin.php');
								$collection_result=show_my_team_collection_type($logged_user_id,$dt1,$dt2,6);
								$i=0;
								$a=$b=0;
								while($collection_row=mysql_fetch_array($collection_result))
								{
									$i++;	
									$userid=$collection_row['user_id'];
									$username=show_user_name($userid);
									
									$parent_id=$parent_name=$parent_level_id=$parent_level_name=$main_admin;
									$parent_id=show_parent_id($userid);
									$parent_name=show_user_name($parent_id);
									$parent_level_id=show_user_type($parent_id);
									
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
									$rowval="";
									if($i%2==1)
										$rowval="class='w3-light-grey'";
									$a+=$collection_row['nums'];
									$b+=$collection_row['amt'];
								?>
                                <tr <?php echo $rowval;?>>
                                	<td><?php echo $i;?></td>
                                	<td><?php echo $userid;?></td>
                                    <td><?php echo $username;?></td>
                                    <td><?php echo $collection_row['nums'];?></td>
                                    <td><?php echo $collection_row['amt'];?></td>
                                    <td><?php echo $parent_id;?></td>
                                    <td><?php echo $parent_name;?></td>
                                    <td><?php echo $parent_level_name;?></td>
                                </tr>
								<?php
								}
								$total1+=$a;
								$total2+=$b;
								?>
                                <tr>
                                	<td></td>
                                	<td></td>
                                    <td></td>
                                    <td><b><?php echo $a;?></b></td>
                                    <td><b><?php echo $b;?></b></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr class="w3-blue">
                                	<th></th>
                                	<th></th>
                                    <th>GRAND TOTAL</th>
                                    <th><?php echo $total1;?></th>
                                    <th><?php echo $total2;?></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </table>
                        </div>  
                    </div>
                </div>               
                
            </div>
        <!--</div>-->
    </section>
	
	<div id="error-box2" class="w3-modal">
		<div class="w3-modal-content w3-animate-zoom w3-card-4 w3-round list-pop">
		  <header class="w3-container w3-blue"> 
			<span onclick="document.getElementById('error-box2').style.display='none';" class="w3-button w3-display-topright"><img src="img/close.png" style="margin-bottom:0px;"></span>
			<h3 class="w3-center" id="error-title2">Processing Report</h3> 
		  </header> 
		  <div class="w3-container w3-center">
			<p id="error-message2" class='w3-left-align'><img src='img/refresh.gif' height='50' align='right' />Please wait few seconds...<br>while we process and reconcile report</p>
		  </div>  
		</div>
	  </div>
	  
	  <div id="error-box" class="w3-modal">
		<div class="w3-modal-content w3-animate-zoom w3-card-4 w3-round list-pop">
		  <header class="w3-container w3-blue"> 
			<span onclick="document.getElementById('error-box').style.display='none';" class="w3-button w3-display-topright"><img src="img/close.png" style="margin-bottom:0px;"></span>
			<h3 class="w3-center" id="error-title">Confirm</h3> 
		  </header> 
		  <div class="w3-container w3-center">
			<p id="error-message">Do you want to process report?</p>
		  </div>  
			<div class="w3-container" style="margin-bottom:10px;">
				<div class="w3-bar w3-center">
					<a id="ViewServlet" onclick="update_pass()" class="w3-button w3-green w3-round">Accept &amp; Confirm</a>
					<a id="ButtonFirst" onclick="document.getElementById('error-box').style.display='none';" class="w3-button w3-blue w3-round">OK</a>
					<a id="ButtonSecond" onclick="document.getElementById('error-box').style.display='none';" class="w3-button w3-orange w3-round">Do it later</a>
				</div> 
			</div> 
		</div>
	  </div>
       
    <?php include_once('_footer.php');?>

</body>
</html> 
