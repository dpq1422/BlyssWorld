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
						include_once('../zf-User.php');
						include_once('../zf-Level.php');
						include_once('../zf-UserLevel.php');
						$userid=$_REQUEST['uid'];
						$username=show_user_name($_REQUEST['uid']);
						$usertype=show_user_type($_REQUEST['uid']);
						$usertypename=show_level_name($usertype);
						
						$is_my_team=isMyTeam($myid,$userid);
						if($is_my_team==0)
						{
							echo "<script>window.location.href='TeamsMembersServlet';</script>";
						}						
						?>
                    	<div class="box-head">
                        	<h3>USER DETAILS</h3>
                        </div>					
						<form class="wh w3-left" method="post">
                        	<div class="w3-row-padding w3-margin-bottom"> 								
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>User ID</label>	
                                	<input type="text" value="<?php echo $userid;?>" placeholder="User ID" disabled class="w3-input w3-border w3-round">                                    
                                </div>
                            	                      	
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>User Name</label>
                                	<input type="text" value="<?php echo $username;?>" placeholder="User Name" disabled class="w3-input w3-border w3-round">                                    
                                </div>
                                
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>User Type</label>	
                                	<input type="text" value="<?php echo $usertypename;?>" placeholder="User Type" disabled class="w3-input w3-border w3-round">                                    
                                </div>
							</div>
						</form><!--
					</div>
				</div>
			</div>
            <div class="w3-row-padding w3-margin-top">
            	<div class="w3-col m12 wow bounceIn">
                	<div class="table-box wh w3-left">-->
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
						$total_records=show_margins_count(" where user_id=$userid ");
						$margin_result=show_margins_data(" where user_id=$userid ", $start_from, $num_rec_per_page);
						$qr="";//"&s1=$s1&s2=$s2&s3=$s3&s4=$s4&search=search";
						$i=0;
						$sname=show_service_name($sid);
						?>
                    	<div class="box-head">
                        	<h3>USER margin (<?php echo $sname;?>) <span class="w3-right w3-blue w3-center badges"><?php echo $total_records;?></span></h3>
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
                        </div><!--
                    </div>
                </div>  
            </div>
			
			<div class="w3-row-padding w3-margin-top">
            	<div class="w3-col m12 wow bounceIn">
                	<div class="table-box wh w3-left">-->
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
						if($usertype>=2 && $usertype<=9)
							$field="id_0$usertype";
						else
							$field="id_$usertype";
						$total_records=show_margins_rc_count(" where service_id='$sid' ");
						$margin_result=show_margins_rc_data(" where service_id='$sid' ", $start_from, $num_rec_per_page);
						$qr="";//"&s1=$s1&s2=$s2&s3=$s3&s4=$s4&search=search";
						$i=0;
						$sname=show_service_name($sid);
						?>
                    	<div class="box-head">
                        	<h3>USER Margin (<?php echo $sname;?>) <span class="w3-right w3-blue w3-center badges"><?php echo $total_records;?></span></h3>
                        </div>
						
                        <div class="w3-responsive">
                            <table class="w3-table-all" id="myTable" style="border:none;">
                                <tr class="w3-blue">
                                  <th>Sr.No.</th>
                                  <th>Operator</th>
                                  <th>Txn Type</th>
                                  <th>Margin</th>
                                </tr>      
								<?php
								while($margin_row=mysql_fetch_array($margin_result))
								{
									$i++;
									$operator_id=$margin_row['operator_id'];
									$field_val=$margin_row["$field"];
									/*
									if($field_val==0)
										$field_val="-";
									*/
								?>                          
                                <tr>
                                  <td><?php echo $i;?></td>
                                  <td><?php echo show_operator_name($operator_id);?></td>
                                  <td><?php echo "Commission in Percent";?></td>
                                  <td><?php echo $field_val;?></td>
                                </tr>
								<?php
								}
								?>
                            </table>	
                        </div><!--
                    </div>
                </div>  
            </div>
			
			<div class="w3-row-padding w3-margin-top">
            	<div class="w3-col m12 wow bounceIn">
                	<div class="table-box wh w3-left">-->
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
						if($usertype>=2 && $usertype<=9)
							$field="id_0$usertype";
						else
							$field="id_$usertype";
						$total_records=show_margins_rc_count(" where service_id='$sid' ");
						$margin_result=show_margins_rc_data(" where service_id='$sid' ", $start_from, $num_rec_per_page);
						$qr="";//"&s1=$s1&s2=$s2&s3=$s3&s4=$s4&search=search";
						$i=0;
						$sname=show_service_name($sid);
						?>
                    	<div class="box-head">
                        	<h3>USER Margin (<?php echo $sname;?>) <span class="w3-right w3-blue w3-center badges"><?php echo $total_records;?></span></h3>
                        </div>
						
                        <div class="w3-responsive">
                            <table class="w3-table-all" id="myTable" style="border:none;">
                                <tr class="w3-blue">
                                  <th>Sr.No.</th>
                                  <th>Operator</th>
                                  <th>Txn Type</th>
                                  <th>Margin</th>
                                </tr>      
								<?php
								while($margin_row=mysql_fetch_array($margin_result))
								{
									$i++;
									$operator_id=$margin_row['operator_id'];
									$field_val=$margin_row["$field"];
									/*
									if($field_val==0)
										$field_val="-";
									*/
								?>                          
                                <tr>
                                  <td><?php echo $i;?></td>
                                  <td><?php echo show_operator_name($operator_id);?></td>
                                  <td><?php echo "Commission in Percent";?></td>
                                  <td><?php echo $field_val;?></td>
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
