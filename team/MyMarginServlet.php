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
						include_once('../zf-ServiceMarginMt.php');
						include_once('../zf-Service.php');
						/**************************/
						$num_rec_per_page=100;
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
						$sid=101;
						$total_records=show_margins_count(" where user_id=$logged_user_id ");
						$margin_result=show_margins_data(" where user_id=$logged_user_id ", $start_from, $num_rec_per_page);
						$qr="";//"&s1=$s1&s2=$s2&s3=$s3&s4=$s4&search=search";
						$i=0;
						$sname=show_service_name($sid);
						?>
                    	<div class="box-head">
                        	<h3>My margin (<?php echo $sname;?>) <span class="w3-right w3-blue w3-center badges"><?php echo $total_records;?></span></h3>
                        </div>
						
                        <div class="w3-responsive">
                            <table class="w3-table-all" id="myTable" style="border:none;">
                                <tr class="w3-blue">
                                  <th>Channel</th>
                                  <th>Txn Type</th>
                                  <th>0-1000</th>
                                  <th>1001-2000</th>
                                  <th>2001-3000</th>
                                  <th>3001-4000</th>
                                  <th>4001-5000</th>
                                </tr>      
								<?php
								while($margin_row=mysql_fetch_array($margin_result))
								{
									$i++;
									$source_id=$margin_row['source_id'];
									$payment_method=$margin_row['payment_method'];
									if($source_id==1)
										$source_id="Channel 1";
									if($payment_method==1)
										$payment_method="NEFT";
									if($payment_method==2)
										$payment_method="IMPS";
									$amt_01000=0;
									$amt_02000=0;
									$amt_03000=0;
									$amt_04000=0;
									$amt_05000=0;
									$amt_10000=0;
									$amt_15000=0;
									$amt_20000=0;
									$amt_25000=0;
									$amt_01000=$margin_row['m_01000'];
									$amt_02000=$margin_row['m_02000'];
									$amt_03000=$margin_row['m_03000'];
									$amt_04000=$margin_row['m_04000'];
									$amt_05000=$margin_row['m_05000'];
									$amt_10000=$margin_row['m_10000'];
									$amt_15000=$margin_row['m_15000'];
									$amt_20000=$margin_row['m_20000'];
									$amt_25000=$margin_row['m_25000'];
									if($amt_01000==0)
										$amt_01000="-";
									if($amt_02000==0)
										$amt_02000="-";
									if($amt_03000==0)
										$amt_03000="-";
									if($amt_04000==0)
										$amt_04000="-";
									if($amt_05000==0)
										$amt_05000="-";
									if($amt_10000==0)
										$amt_10000="-";
									if($amt_15000==0)
										$amt_15000="-";
									if($amt_20000==0)
										$amt_20000="-";
									if($amt_25000==0)
										$amt_25000="-";
								?>                          
                                <tr>
                                  <td><?php echo $source_id;?></td>
                                  <td><?php echo $payment_method;?></td>
                                  <td><?php echo $amt_01000;?></td>
                                  <td><?php echo $amt_02000;?></td>
                                  <td><?php echo $amt_03000;?></td>
                                  <td><?php echo $amt_04000;?></td>
                                  <td><?php echo $amt_05000;?></td>
                                </tr>
								<?php
								}
								?>
                            </table>	
                        </div>
                    </div>
                </div>  
            </div>
			
			<div class="w3-row-padding w3-margin-top">
            	<div class="w3-col m12 wow bounceIn">
                	<div class="table-box wh w3-left">
						<?php
						include_once('../zf-ServiceMarginRc.php');
						include_once('../zf-Service.php');
						/**************************/
						$num_rec_per_page=100;
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
						$sid=102;
						$field="";
						$field2="";
						$field3="";
						$log2=$logged_user_type+1;
						$log3=$logged_user_type+2;
						if($logged_user_type>=2 && $logged_user_type<=9)
						{
							$field="id_0$logged_user_type";
						}
						else
						{
							$field="id_$logged_user_type";
						}
						if($log2>=2 && $log2<=9)
						{
							$field2="id_0$log2";
						}
						else
						{
							$field2="id_$log2";
						}
						if($log3>=2 && $log3<=9)
						{
							$field3="id_0$log3";
						}
						else
						{
							$field3="id_$log3";
						}
						$total_records=show_margins_rc_count(" where service_id='$sid' ");
						$margin_result=show_margins_rc_data(" where service_id='$sid' ", $start_from, $num_rec_per_page);
						$qr="";//"&s1=$s1&s2=$s2&s3=$s3&s4=$s4&search=search";
						$i=0;
						$sname=show_service_name($sid);
						?>
                    	<div class="box-head">
                        	<h3>My Margin (<?php echo $sname;?>) <span class="w3-right w3-blue w3-center badges"><?php echo $total_records;?></span></h3>
                        </div>
						
                        <div class="w3-responsive">
                            <table class="w3-table-all" id="myTable" style="border:none;">
                                <tr class="w3-blue">
                                  <th>Sr.No.</th>
                                  <th>Operator</th>
                                  <th>Txn Type</th>
                                  <th>Direct Retailer</th>
								  <?php
								  if($logged_user_type==2 || $logged_user_type==3 || $logged_user_type==4)
								  {
								  ?>
                                  <th>Through Distributor</th>
								  <?php
								  }
								  if($logged_user_type==2 || $logged_user_type==3)
								  {
								  ?>
                                  <th>Through Super Distributor</th>
								  <?php
								  }
								  ?>
								  <th>To Retailer</th>
                                </tr>      
								<?php
								$field_val=0;
								$field_val2=0;
								$field_val3=0;
								while($margin_row=mysql_fetch_array($margin_result))
								{
									$i++;
									$field_val=0;
									$field_val2=0;
									$field_val3=0;
									$field_val12=0;
									$operator_id=$margin_row['operator_id'];
									$field_val=$margin_row["$field"];
									$field_val2=$margin_row["$field2"];
									$field_val3=$margin_row["$field3"];
									$field_val12=$margin_row["id_12"];
									
									$field_val3=$field_val+$field_val2+$field_val3;
									$field_val2=$field_val+$field_val2;
									
									$field_val=number_format((float)$field_val, 2, '.', '');
									$field_val2=number_format((float)$field_val2, 2, '.', '');
									$field_val3=number_format((float)$field_val3, 2, '.', '');
									
									if($field_val==0)
										$field_val="-";
									if($field_val2==0)
										$field_val2="-";
									if($field_val3==0)
										$field_val3="-";
									if($field_val12==0)
										$field_val12="-";
									
								?>                          
                                <tr>
                                  <td><?php echo $i;?></td>
                                  <td><?php echo show_operator_name($operator_id);?></td>
                                  <td><?php echo "Commission in Percent";?></td>
								  <?php
								  if($logged_user_type==2 || $logged_user_type==3 || $logged_user_type==4)
								  {
								  ?>
                                  <td><?php echo $field_val3;?></td>
								  <?php
								  }
								  if($logged_user_type==2 || $logged_user_type==3)
								  {
								  ?>
                                  <td><?php echo $field_val2;?></td>
								  <?php
								  }
								  ?>
                                  <td><?php echo $field_val;?></td>
								  <td><?php echo $field_val12;?></td>
                                </tr>
								<?php
								}
								?>
                            </table>	
                        </div>
                    </div>
                </div>  
            </div>
			
			<div class="w3-row-padding w3-margin-top">
            	<div class="w3-col m12 wow bounceIn">
                	<div class="table-box wh w3-left">
						<?php
						include_once('../zf-ServiceMarginRc.php');
						include_once('../zf-Service.php');
						/**************************/
						$num_rec_per_page=100;
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
						$sid=103;
						$field="";
						$field2="";
						$field3="";
						$log2=$logged_user_type+1;
						$log3=$logged_user_type+2;
						if($logged_user_type>=2 && $logged_user_type<=9)
						{
							$field="id_0$logged_user_type";
						}
						else
						{
							$field="id_$logged_user_type";
						}
						if($log2>=2 && $log2<=9)
						{
							$field2="id_0$log2";
						}
						else
						{
							$field2="id_$log2";
						}
						if($log3>=2 && $log3<=9)
						{
							$field3="id_0$log3";
						}
						else
						{
							$field3="id_$log3";
						}
						$total_records=show_margins_rc_count(" where service_id='$sid' ");
						$margin_result=show_margins_rc_data(" where service_id='$sid' ", $start_from, $num_rec_per_page);
						$qr="";//"&s1=$s1&s2=$s2&s3=$s3&s4=$s4&search=search";
						$i=0;
						$sname=show_service_name($sid);
						?>
                    	<div class="box-head">
                        	<h3>My Margin (<?php echo $sname;?>) <span class="w3-right w3-blue w3-center badges"><?php echo $total_records;?></span></h3>
                        </div>
						
                        <div class="w3-responsive">
                            <table class="w3-table-all" id="myTable" style="border:none;">
                                <tr class="w3-blue">
                                  <th>Sr.No.</th>
                                  <th>Operator</th>
                                  <th>Txn Type</th>
                                  <th>Direct Retailer</th>
								  <?php
								  if($logged_user_type==2 || $logged_user_type==3 || $logged_user_type==4)
								  {
								  ?>
                                  <th>Through Distributor</th>
								  <?php
								  }
								  if($logged_user_type==2 || $logged_user_type==3)
								  {
								  ?>
                                  <th>Through Super Distributor</th>
								  <?php
								  }
								  ?>
								  <th>To Retailer</th>
                                </tr>      
								<?php
								$field_val=0;
								$field_val2=0;
								$field_val3=0;
								while($margin_row=mysql_fetch_array($margin_result))
								{
									$i++;
									$field_val=0;
									$field_val2=0;
									$field_val3=0;
									$field_val12=0;
									$operator_id=$margin_row['operator_id'];
									$field_val=$margin_row["$field"];
									$field_val2=$margin_row["$field2"];
									$field_val3=$margin_row["$field3"];
									$field_val12=$margin_row["id_12"];
									
									$field_val3=$field_val+$field_val2+$field_val3;
									$field_val2=$field_val+$field_val2;
									
									$field_val=number_format((float)$field_val, 2, '.', '');
									$field_val2=number_format((float)$field_val2, 2, '.', '');
									$field_val3=number_format((float)$field_val3, 2, '.', '');
									
									if($field_val==0)
										$field_val="-";
									if($field_val2==0)
										$field_val2="-";
									if($field_val3==0)
										$field_val3="-";
									if($field_val12==0)
										$field_val12="-";
									
								?>                          
                                <tr>
                                  <td><?php echo $i;?></td>
                                  <td><?php echo show_operator_name($operator_id);?></td>
                                  <td><?php echo "Commission in Percent";?></td>
								  <?php
								  if($logged_user_type==2 || $logged_user_type==3 || $logged_user_type==4)
								  {
								  ?>
                                  <td><?php echo $field_val3;?></td>
								  <?php
								  }
								  if($logged_user_type==2 || $logged_user_type==3)
								  {
								  ?>
                                  <td><?php echo $field_val2;?></td>
								  <?php
								  }
								  ?>
                                  <td><?php echo $field_val;?></td>
								  <td><?php echo $field_val12;?></td>
                                </tr>
								<?php
								}
								?>
                            </table>
                        </div>
                    </div>
                </div>  
            </div>
			
			<div class="w3-row-padding w3-margin-top">
            	<div class="w3-col m12 wow bounceIn">
                	<div class="table-box wh w3-left">
						<?php
						include_once('../zf-ServiceMarginRc.php');
						include_once('../zf-Service.php');
						/**************************/
						$num_rec_per_page=100;
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
						$sid=106;
						$field="";
						$field2="";
						$field3="";
						$log2=$logged_user_type+1;
						$log3=$logged_user_type+2;
						if($logged_user_type>=2 && $logged_user_type<=9)
						{
							$field="id_0$logged_user_type";
						}
						else
						{
							$field="id_$logged_user_type";
						}
						if($log2>=2 && $log2<=9)
						{
							$field2="id_0$log2";
						}
						else
						{
							$field2="id_$log2";
						}
						if($log3>=2 && $log3<=9)
						{
							$field3="id_0$log3";
						}
						else
						{
							$field3="id_$log3";
						}
						$total_records=show_margins_rc_count(" where service_id='$sid' ");
						$margin_result=show_margins_rc_data(" where service_id='$sid' ", $start_from, $num_rec_per_page);
						$qr="";//"&s1=$s1&s2=$s2&s3=$s3&s4=$s4&search=search";
						$i=0;
						$sname=show_service_name($sid);
						?>
                    	<div class="box-head">
                        	<h3>My Margin (<?php echo $sname;?>) <span class="w3-right w3-blue w3-center badges"><?php echo $total_records;?></span></h3>
                        </div>
						
                        <div class="w3-responsive">
                            <table class="w3-table-all" id="myTable" style="border:none;">
                                <tr class="w3-blue">
                                  <th>Sr.No.</th>
                                  <th>Operator</th>
                                  <th>Txn Type</th>
                                  <th>Direct Retailer</th>
								  <?php
								  if($logged_user_type==2 || $logged_user_type==3 || $logged_user_type==4)
								  {
								  ?>
                                  <th>Through Distributor</th>
								  <?php
								  }
								  if($logged_user_type==2 || $logged_user_type==3)
								  {
								  ?>
                                  <th>Through Super Distributor</th>
								  <?php
								  }
								  ?>
								  <th>To Retailer</th>
                                </tr>      
								<?php
								$field_val=0;
								$field_val2=0;
								$field_val3=0;
								while($margin_row=mysql_fetch_array($margin_result))
								{
									$i++;
									$field_val=0;
									$field_val2=0;
									$field_val3=0;
									$field_val12=0;
									$operator_id=$margin_row['operator_id'];
									$field_val=$margin_row["$field"];
									$field_val2=$margin_row["$field2"];
									$field_val3=$margin_row["$field3"];
									$field_val12=$margin_row["id_12"];
									
									$field_val3=$field_val+$field_val2+$field_val3;
									$field_val2=$field_val+$field_val2;
									
									$field_val=number_format((float)$field_val, 2, '.', '');
									$field_val2=number_format((float)$field_val2, 2, '.', '');
									$field_val3=number_format((float)$field_val3, 2, '.', '');
									
									if($field_val==0)
										$field_val="-";
									if($field_val2==0)
										$field_val2="-";
									if($field_val3==0)
										$field_val3="-";
									if($field_val12==0)
										$field_val12="-";
									
								?>                          
                                <tr>
                                  <td><?php echo $i;?></td>
                                  <td><?php echo show_operator_name($operator_id);?></td>
                                  <td><?php echo "Commission in Percent";?></td>
								  <?php
								  if($logged_user_type==2 || $logged_user_type==3 || $logged_user_type==4)
								  {
								  ?>
                                  <td><?php echo $field_val3;?></td>
								  <?php
								  }
								  if($logged_user_type==2 || $logged_user_type==3)
								  {
								  ?>
                                  <td><?php echo $field_val2;?></td>
								  <?php
								  }
								  ?>
                                  <td><?php echo $field_val;?></td>
								  <td><?php echo $field_val12;?></td>
                                </tr>
								<?php
								}
								?>
                            </table>
                        </div>
                    </div>
                </div>  
            </div>
        <!--</div>-->
    </section>
       
    <?php include_once('_footer.php');?>

</body>
</html> 
