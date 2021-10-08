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
						include_once('zf-ServiceMargin.php');
						include_once('zf-Service.php');
						include_once('zf-Level.php');
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
						$total_records=show_margins_count(" where service_id=$sid ");
						$margin_result=show_margins_data(" where service_id=$sid ", $start_from, $num_rec_per_page);
						$qr="";//"&s1=$s1&s2=$s2&s3=$s3&s4=$s4&search=search";
						$i=0;
						$sname=show_service_name($sid);
						$level_total=show_levels_count(" where level_id<=12 ");
						$level_result=show_levels_data_desc(" where level_id<=12 ");
						?>
                    	<div class="box-head">
                        	<h3>Margins of Service (<?php echo $sname;?>) <span class="w3-right w3-blue w3-center badges"><?php echo $total_records;?></span></h3>
                        </div>
                        <div class="w3-responsive">
                            <table class="w3-table-all" id="myTable" style="border:none;">
                                <tr class="w3-blue">
                                	<th>Sr.No.</th>
                                    <th>Operator Name</th>
                                    <th>Margin Type</th>
                                    <th>Received Margin</th>
									<?php
									while($level_row=mysql_fetch_array($level_result))
									{
										echo "<th>".show_level_name($level_row['level_id'])." Margin</th>";
									}
									?>
                                </tr>
								<?php
								while($margin_row=mysql_fetch_array($margin_result))
								{
									$i++;
									$id_00=$margin_row['id_00'];
									$charges_type=$id_00;
									if($charges_type>0)
									{
										$charges_type="<b class='w3-text-green'>Comm. in Percent</b>";
									}
									else
									{
										$charges_type="<b class='w3-text-orange'>No Comm.</b>";
									}
									if($id_00==0)
										$id_00="-";
								?>
                                <tr>
                                	<td><?php echo $i;?></td>
                                    <td><?php echo show_operator_name($margin_row['operator_id']);?></td>
                                    <td><?php echo $charges_type;?></td>
                                    <td><?php echo $id_00;?></td>
									<?php
									$field="";									
									$level_result=show_levels_data_desc(" where level_id<=12 ");
									while($level_row=mysql_fetch_array($level_result))
									{
										$field="";	
										if($level_row['level_id']>=1 && $level_row['level_id']<=9)
											$field="id_0".$level_row['level_id'];
										else
											$field="id_".$level_row['level_id'];
										
										$field_val=$margin_row["$field"];
										if($field_val==0)
											$field_val="-";
									?>
                                    <td><?php echo $field_val;?></td>
									<?php
									}
									?>
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
