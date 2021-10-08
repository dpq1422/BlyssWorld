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
                        	<h3>COLLECTION REPORT 24-JUL-2018</h3>
                        </div>
						<?php
						$dt1="";
						$dt2="";
						
						if(isset($_POST['from_date']))
							$dt1=$_POST['from_date'];
						if(isset($_POST['to_date']))
							$dt2=$_POST['to_date'];
						
						if($dt1=="")
							$dt1="$datetime_date";
						if($dt2=="")
							$dt2="$datetime_date";
						
						$mr1=$mr2=$mr3=$mr4=$mr5=$mr6=0;
						?>
						<div class="table-search-filter wh w3-left">
							<form class="wh w3-left" method="post">
								<ul>
                                    <li>
										<label>From Date</label>
										<input name="from_date" id="from_date" value="<?php echo $dt1;?>" type="date" placeholder="From Date" class="w3-input w3-border w3-round">
                                    </li>
                                    <li>
										<label>To Date</label>
										<input name="to_date" id="to_date" value="<?php echo $dt2;?>" type="date" placeholder="To Date" class="w3-input w3-border w3-round">
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
                                	<th>MT.SR.NO.</th>
                                	<th>RETAILER ID</th>
                                    <th>RETAILER NAME</th>
                                    <th>MEMBERSHIP PLAN</th>
                                    <th>TXNs</th>
                                    <th>AMOUNT</th>
                                    <th>AVG TXN AMOUNT</th>
									<?php
									if($logged_user_id==$main_admin)
									{
									?>
                                    <th>CHARGES</th>
                                    <th>COLLECTION</th>
									<?php
									}
									?>
                                    <!--<th>PARENT ID</th>
                                    <th>PARENT NAME</th>
                                    <th>PARENT DESIGNATION</th>-->
                                </tr>
								<?php
								include_once('zf-User.php');
								include_once('zf-Plan.php');
								include_once('zf-Level.php');
								include_once('zf-UserLevel.php');
								include_once('zf-Commission.php');
								include_once('zc-commons-admin.php');
								$collection_result=show_collection1($dt1,$dt2);
								$i=0;
								$a=$b=$c=$d=$e=0;
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
									$avg=$collection_row['amt']/$collection_row['nums'];
									$avg=number_format((float)$avg, 2, '.', '');
									
									$plan_id=show_user_current_plan($userid);
									$plan_name=show_plan_name($plan_id);
									if($plan_id==1)
										$plan_name="$plan_name";
									if($plan_id==2)
										$plan_name="<b class='w3-text-orange'>$plan_name</b>";
									if($plan_id==3)
										$plan_name="<b class='w3-text-green'>$plan_name</b>";
									if($plan_id==4)
										$plan_name="<b class='w3-text-blue'>$plan_name</b>";
								?>
                                <tr <?php echo $rowval;?>>
                                	<td><?php echo $i;?></td>
                                	<td><?php echo $userid;?></td>
                                    <td><?php echo $username;?></td>
                                    <td><?php echo $plan_name;?></td>
                                    <td align='right'><?php echo $collection_row['nums'];?></td>
                                    <td align='right'><?php echo $collection_row['amt'];?></td>
                                    <td align='right'><?php echo $avg;?></td>
									<?php
									if($logged_user_id==$main_admin)
									{
									?>
                                    <td align='right'><?php echo $collection_row['chgd'];?></td>
                                    <td align='right'><?php echo $collection_row['chgd']-($collection_row['nums']*5);?></td>
									<?php
									}
									?>
                                    <!--<td><?php echo $parent_id;?></td>
                                    <td><?php echo $parent_name;?></td>
                                    <td><?php echo $parent_level_name;?></td>-->
                                </tr>
								<?php
								$a+=$collection_row['nums'];
								$b+=$collection_row['amt'];
								$c+=$avg;
								$d+=$collection_row['chgd'];
								$e+=$collection_row['chgd']-($collection_row['nums']*5);
								}
								if($a==0)
								$c=0;
								else
								$c=$b/$a;
								$c=number_format((float)$c, 2, '.', '');
								$mr1+=$a;
								$mr2+=$b;
								$mr3+=$c;
								$mr4+=$d;
								$mr5+=$e;
								$mr6+=0;
								?>
                                <tr>
                                	<th></th>
                                	<th></th>
                                    <th></th>
                                    <th></th>
                                    <th align='right' title="Qty"><?php echo $a;?></td>
                                    <th align='right' title="Amt"><?php echo $b;?></td>
                                    <th align='right' title="Avg"><?php echo $c;?></td>
									<?php
									if($logged_user_id==$main_admin)
									{
									?>
                                    <th align='right' title="Chg"><?php echo $d;?></td>
                                    <th align='right' title="Col"><?php echo $e;?></td>
									<?php
									}
									?>
                                    <!--<th></th>
                                    <th></th>
                                    <th></th>-->
                                </tr>
                            </table>
                        </div>  
						<div class="table-search-filter wh w3-left">
                            <table class="w3-table-all" id="myTable">
                                <tr class="w3-blue">
                                	<th>AV.SR.NO.</th>
                                	<th>RETAILER ID</th>
                                    <th>RETAILER NAME</th>
                                    <th>MEMBERSHIP PLAN</th>
                                    <th>TXNs</th>
                                    <th>AMOUNT</th>
                                    <th>AVG TXN AMOUNT</th>
									<?php
									if($logged_user_id==$main_admin)
									{
									?>
                                    <th>CHARGES</th>
                                    <th>COLLECTION</th>
									<?php
									}
									?>
                                    <!--<th>PARENT ID</th>
                                    <th>PARENT NAME</th>
                                    <th>PARENT DESIGNATION</th>-->
                                </tr>
								<?php
								$collection_result=show_collection2($dt1,$dt2);
								$i=0;
								$a=$b=$c=$d=$e=0;
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
									$avg=$collection_row['amt']/$collection_row['nums'];
									$avg=number_format((float)$avg, 2, '.', '');
									
									$plan_id=show_user_current_plan($userid);
									$plan_name=show_plan_name($plan_id);
									if($plan_id==1)
										$plan_name="$plan_name";
									if($plan_id==2)
										$plan_name="<b class='w3-text-orange'>$plan_name</b>";
									if($plan_id==3)
										$plan_name="<b class='w3-text-green'>$plan_name</b>";
									if($plan_id==4)
										$plan_name="<b class='w3-text-blue'>$plan_name</b>";
								?>
                                <tr <?php echo $rowval;?>>
                                	<td><?php echo $i;?></td>
                                	<td><?php echo $userid;?></td>
                                    <td><?php echo $username;?></td>
                                    <td><?php echo $plan_name;?></td>
                                    <td align='right'><?php echo $collection_row['nums'];?></td>
                                    <td align='right'><?php echo $collection_row['amt'];?></td>
                                    <td align='right'><?php echo $avg;?></td>
									<?php
									if($logged_user_id==$main_admin)
									{
									?>
                                    <td align='right'><?php echo $collection_row['chgd'];?></td>
                                    <td align='right'><?php echo $collection_row['amt']-($collection_row['nums']*3);?></td>
									<?php
									}
									?>
                                    <!--<td><?php echo $parent_id;?></td>
                                    <td><?php echo $parent_name;?></td>
                                    <td><?php echo $parent_level_name;?></td>-->
                                </tr>
								<?php
								$a+=$collection_row['nums'];
								$b+=$collection_row['amt'];
								$c+=$avg;
								$d+=$collection_row['chgd'];
								$e+=$collection_row['amt']-($collection_row['nums']*3);
								}
								if($a==0)
								$c=0;
								else
								$c=$b/$a;
								$c=number_format((float)$c, 2, '.', '');
								$mr1+=$a;
								$mr2+=$b;
								$mr3+=$c;
								$mr4+=$d;
								$mr5+=$e;
								$mr6+=0;
								?>
                                <tr>
                                	<th></th>
                                	<th></th>
                                    <th></th>
                                    <th></th>
                                    <th align='right' title="Qty"><?php echo $a;?></td>
                                    <th align='right' title="Amt"><?php echo $b;?></td>
                                    <th align='right' title="Avg"><?php echo $c;?></td>
									<?php
									if($logged_user_id==$main_admin)
									{
									?>
                                    <th align='right' title="Chg"><?php echo $d;?></td>
                                    <th align='right' title="Col"><?php echo $e;?></td>
									<?php
									}
									?>
                                    <!--<th></th>
                                    <th></th>
                                    <th></th>-->
                                </tr>
                            </table>
                        </div>  
						<div class="table-search-filter wh w3-left">
                            <table class="w3-table-all" id="myTable">
                                <tr class="w3-blue">
                                	<th>DB.SR.NO.</th>
                                	<th>RETAILER ID</th>
                                    <th>RETAILER NAME</th>
                                    <th>MEMBERSHIP PLAN</th>
                                    <th>TXNs</th>
                                    <th>AMOUNT</th>
                                    <th>AVG TXN AMOUNT</th>
									<?php
									if($logged_user_id==$main_admin)
									{
									?>
                                    <th>CHARGES</th>
                                    <th>COLLECTION</th>
									<?php
									}
									?>
                                    <!--<th>PARENT ID</th>
                                    <th>PARENT NAME</th>
                                    <th>PARENT DESIGNATION</th>-->
                                </tr>
								<?php
								$collection_result=show_collection3($dt1,$dt2);
								$i=0;
								$a=$b=$c=$d=$e=0;
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
									$avg=$collection_row['amt']/$collection_row['nums'];
									$avg=number_format((float)$avg, 2, '.', '');
									
									$plan_id=show_user_current_plan($userid);
									$plan_name=show_plan_name($plan_id);
									if($plan_id==1)
										$plan_name="$plan_name";
									if($plan_id==2)
										$plan_name="<b class='w3-text-orange'>$plan_name</b>";
									if($plan_id==3)
										$plan_name="<b class='w3-text-green'>$plan_name</b>";
									if($plan_id==4)
										$plan_name="<b class='w3-text-blue'>$plan_name</b>";
								?>
                                <tr <?php echo $rowval;?>>
                                	<td><?php echo $i;?></td>
                                	<td><?php echo $userid;?></td>
                                    <td><?php echo $username;?></td>
                                    <td><?php echo $plan_name;?></td>
                                    <td align='right'><?php echo $collection_row['nums'];?></td>
                                    <td align='right'><?php echo $collection_row['amt'];?></td>
                                    <td align='right'><?php echo $avg;?></td>
									<?php
									if($logged_user_id==$main_admin)
									{
									?>
                                    <td align='right'><?php echo $collection_row['chgd'];?></td>

                                    <td align='right'><?php echo $collection_row['amt'];?></td>									<?php
									}
									?>
                                    <!--<td><?php echo $parent_id;?></td>
                                    <td><?php echo $parent_name;?></td>
                                    <td><?php echo $parent_level_name;?></td>-->
                                </tr>
								<?php
								$a+=$collection_row['nums'];
								$b+=$collection_row['amt'];
								$c+=$avg;
								$d+=$collection_row['chgd'];
								$e+=$collection_row['amt'];
								}
								if($a==0)
								$c=0;
								else
								$c=$b/$a;
								$c=number_format((float)$c, 2, '.', '');
								$mr1+=$a;
								$mr2+=$b;
								$mr3+=$c;
								$mr4+=$d;
								$mr5+=$e;
								$mr6+=0;
								?>
                                <tr>
                                	<th></th>
                                	<th></th>
                                    <th></th>
                                    <th></th>
                                    <th align='right' title="Qty"><?php echo $a;?></td>
                                    <th align='right' title="Amt"><?php echo $b;?></td>
                                    <th align='right' title="Avg"><?php echo $c;?></td>
									<?php
									if($logged_user_id==$main_admin)
									{
									?>
                                    <th align='right' title="Chg"><?php echo $d;?></td>
                                    <th align='right' title="Col"><?php echo $e;?></td>
									<?php
									}
									?>
                                    <!--<th></th>
                                    <th></th>
                                    <th></th>-->
                                </tr>
                            </table>
                        </div>   
						<div class="table-search-filter wh w3-left">
                            <table class="w3-table-all" id="myTable">
                                <tr class="w3-blue">
                                	<th>RC.SR.NO.</th>
                                	<th>RETAILER ID</th>
                                    <th>RETAILER NAME</th>
                                    <th>MEMBERSHIP PLAN</th>
                                    <th>TXNs</th>
                                    <th>AMOUNT</th>
                                    <th>AVG TXN AMOUNT</th>
									<?php
									if($logged_user_id==$main_admin)
									{
									?>
                                    <th>DEDUCTED</th>
                                    <th>COLLECTION</th>
									<?php
									}
									?>
                                    <!--<th>PARENT ID</th>
                                    <th>PARENT NAME</th>
                                    <th>PARENT DESIGNATION</th>-->
                                </tr>
								<?php
								$collection_result=show_collection4($dt1,$dt2);
								$i=0;
								$a=$b=$c=$d=$e=$f=0;
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
									$avg=$collection_row['amt']/$collection_row['nums'];
									$avg=number_format((float)$avg, 2, '.', '');
									
									$plan_id=show_user_current_plan($userid);
									$plan_name=show_plan_name($plan_id);
									if($plan_id==1)
										$plan_name="$plan_name";
									if($plan_id==2)
										$plan_name="<b class='w3-text-orange'>$plan_name</b>";
									if($plan_id==3)
										$plan_name="<b class='w3-text-green'>$plan_name</b>";
									if($plan_id==4)
										$plan_name="<b class='w3-text-blue'>$plan_name</b>";
									$adm_ded=show_collection4b($userid,$dt1,$dt2);
									$adm_ern=$collection_row['chgd']-$adm_ded;
									$adm_ern=number_format((float)$adm_ern, 2, '.', '');
								?>
                                <tr <?php echo $rowval;?>>
                                	<td><?php echo $i;?></td>
                                	<td><?php echo $userid;?></td>
                                    <td><?php echo $username;?></td>
                                    <td><?php echo $plan_name;?></td>
                                    <td align='right'><?php echo $collection_row['nums'];?></td>
                                    <td align='right'><?php echo $collection_row['amt'];?></td>
                                    <td align='right'><?php echo $avg;?></td>
									<?php
									if($logged_user_id==$main_admin)
									{
									?>
                                    <td align='right'><?php echo $collection_row['chgd']." / ".$adm_ded;?></td>
									<td align='right'><?php echo $adm_ern;?></td>
									<?php
									}
									?>
                                    <!--<td><?php echo $parent_id;?></td>
                                    <td><?php echo $parent_name;?></td>
                                    <td><?php echo $parent_level_name;?></td>-->
                                </tr>
								<?php
								$a+=$collection_row['nums'];
								$b+=$collection_row['amt'];
								$c+=$avg;
								$d+=$collection_row['chgd'];
								$e+=$adm_ern;
								$f+=$adm_ded;
								}
								if($a==0)
								$c=0;
								else
								$c=$b/$a;
								$c=number_format((float)$c, 2, '.', '');
								$e=number_format((float)$e, 2, '.', '');
								$f=number_format((float)$f, 2, '.', '');
								$mr1+=$a;
								$mr2+=$b;
								$mr3+=$c;
								$mr4+=$d;
								$mr5+=$e;
								$mr6+=$f;
								?>
                                <tr>
                                	<th></th>
                                	<th></th>
                                    <th></th>
                                    <th></th>
                                    <th align='right' title="Qty"><?php echo $a;?></td>
                                    <th align='right' title="Amt"><?php echo $b;?></td>
                                    <th align='right' title="Avg"><?php echo $c;?></td>
									<?php
									if($logged_user_id==$main_admin)
									{
									?>
                                    <th align='right' title="Chg"><?php echo $d." / ".$f;?></td>
                                    <th align='right' title="Col"><?php echo $e;?></td>
									<?php
									}
									?>
                                    <!--<th></th>
                                    <th></th>
                                    <th></th>-->
                                </tr>
                            </table>
                        </div>    
						<div class="table-search-filter wh w3-left">
                            <table class="w3-table-all" id="myTable">
                                <tr class="w3-blue">
                                	<th>UT.SR.NO.</th>
                                	<th>RETAILER ID</th>
                                    <th>RETAILER NAME</th>
                                    <th>MEMBERSHIP PLAN</th>
                                    <th>TXNs</th>
                                    <th>AMOUNT</th>
                                    <th>AVG TXN AMOUNT</th>
									<?php
									if($logged_user_id==$main_admin)
									{
									?>
                                    <th>DEDUCTED</th>
                                    <th>COLLECTION</th>
									<?php
									}
									?>
                                    <!--<th>PARENT ID</th>
                                    <th>PARENT NAME</th>
                                    <th>PARENT DESIGNATION</th>-->
                                </tr>
								<?php
								$collection_result=show_collection5($dt1,$dt2);
								$i=0;
								$a=$b=$c=$d=$e=0;
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
									$avg=$collection_row['amt']/$collection_row['nums'];
									$avg=number_format((float)$avg, 2, '.', '');
									
									$plan_id=show_user_current_plan($userid);
									$plan_name=show_plan_name($plan_id);
									if($plan_id==1)
										$plan_name="$plan_name";
									if($plan_id==2)
										$plan_name="<b class='w3-text-orange'>$plan_name</b>";
									if($plan_id==3)
										$plan_name="<b class='w3-text-green'>$plan_name</b>";
									if($plan_id==4)
										$plan_name="<b class='w3-text-blue'>$plan_name</b>";
								?>
                                <tr <?php echo $rowval;?>>
                                	<td><?php echo $i;?></td>
                                	<td><?php echo $userid;?></td>
                                    <td><?php echo $username;?></td>
                                    <td><?php echo $plan_name;?></td>
                                    <td align='right'><?php echo $collection_row['nums'];?></td>
                                    <td align='right'><?php echo $collection_row['amt'];?></td>
                                    <td align='right'><?php echo $avg;?></td>
									<?php
									if($logged_user_id==$main_admin)
									{
										$xx=$collection_row['chgd']-$collection_row['amt']-($collection_row['nums']*2);
								$xx=number_format((float)$xx, 2, '.', '');
									?>
                                    <td align='right'><?php echo $collection_row['chgd'];?></td>
									<td align='right'><?php echo $xx;?></td>
									<?php
									}
									?>
                                    <!--<td><?php echo $parent_id;?></td>
                                    <td><?php echo $parent_name;?></td>
                                    <td><?php echo $parent_level_name;?></td>-->
                                </tr>
								<?php
								$a+=$collection_row['nums'];
								$b+=$collection_row['amt'];
								$c+=$avg;
								$d+=$collection_row['chgd'];
								$e+=$collection_row['chgd']-$collection_row['amt']-($collection_row['nums']*2);
								}
								if($a==0)
								$c=0;
								else
								$c=$b/$a;
								$c=number_format((float)$c, 2, '.', '');
								$e=number_format((float)$e, 2, '.', '');
								$mr1+=$a;
								$mr2+=$b;
								$mr3+=$c;
								$mr4+=$d;
								$mr5+=$e;
								$mr6+=0;
								?>
                                <tr>
                                	<th></th>
                                	<th></th>
                                    <th></th>
                                    <th></th>
                                    <th align='right' title="Qty"><?php echo $a;?></td>
                                    <th align='right' title="Amt"><?php echo $b;?></td>
                                    <th align='right' title="Avg"><?php echo $c;?></td>
									<?php
									if($logged_user_id==$main_admin)
									{
									?>
                                    <th align='right' title="Chg"><?php echo $d;?></td>
                                    <th align='right' title="Col"><?php echo $e;?></td>
									<?php
									}
									?>
                                    <!--<th></th>
                                    <th></th>
                                    <th></th>-->
                                </tr>
                                <tr class="w3-blue">
                                	<th></th>
                                	<th></th>
                                    <th></th>
                                    <th></th>
                                    <th><?php echo $mr1;?></th>
                                    <th><?php echo $mr2;?></th>
                                    <th><?php echo $mr3;?></th>
									<?php
									if($logged_user_id==$main_admin)
									{
									?>
                                    <th><?php echo $mr4." / ".$mr6;?></th>
                                    <th><?php echo $mr5;?></th>
									<?php
									}
									?>
                                    <!--<th>PARENT ID</th>
                                    <th>PARENT NAME</th>
                                    <th>PARENT DESIGNATION</th>-->
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
