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
<script>
function check(fields,row)
{
	var your=$("#r"+row+"-c0").val();
	if(your==NaN || your=="NaN" || your=="" || your==".")
	{
		your=0.;
		$("#r"+row+"-c0").val(your);
	}
	var ret=$("#r"+row+"-c12").val();
	if(ret==NaN || ret=="NaN" || ret=="" || ret==".")
	{
		ret=0.;
		$("#r"+row+"-c12").val(ret);
	}
	var adm=ret-your;
	var res=0;
	for(i=fields-1;i>1;i--)
	{
		res=$("#r"+row+"-c"+i+"").val();
		//alert(res);
		if(res==NaN || res=="NaN" || res=="" || res==".")
		{
			res=0.;
			$("#r"+row+"-c"+i+"").val(res);
		}
		adm=adm-res;
	}
	adm=(adm).toFixed(2);
	$("#r"+row+"-c1").val(adm);
	//document.getElementById("r-c1").value=adm;
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
						echo "<script>window.location.href='DashboardServlet';</script>";
						if(isset($_POST['UpdateDistribution']))
						{
							include_once('zf-ServiceMargin.php');
							$service_id=$_POST['filled_service'];
							$operator_id=$_POST['filled_operator'];
							$id_00=$id_02=$id_03=$id_04=$id_05=$id_06=$id_07=$id_08=$id_09=$id_10=$id_11=$id_12=array(0);
							if(isset($_POST['id_00']))
							$id_00=$_POST['id_00'];
							if(isset($_POST['id_01']))
							$id_01=$_POST['id_01'];
							if(isset($_POST['id_02']))
							$id_02=$_POST['id_02'];
							if(isset($_POST['id_03']))
							$id_03=$_POST['id_03'];
							if(isset($_POST['id_04']))
							$id_04=$_POST['id_04'];
							if(isset($_POST['id_05']))
							$id_05=$_POST['id_05'];
							if(isset($_POST['id_06']))
							$id_06=$_POST['id_06'];
							if(isset($_POST['id_07']))
							$id_07=$_POST['id_07'];
							if(isset($_POST['id_08']))
							$id_08=$_POST['id_08'];
							if(isset($_POST['id_09']))
							$id_09=$_POST['id_09'];
							if(isset($_POST['id_10']))
							$id_10=$_POST['id_10'];
							if(isset($_POST['id_11']))
							$id_11=$_POST['id_11'];
							if(isset($_POST['id_12']))
							$id_12=$_POST['id_12'];
							update_margin_distribution_levels($service_id,$operator_id,$id_00,$id_01,$id_02,$id_03,$id_04,$id_05,$id_06,$id_07,$id_08,$id_09,$id_10,$id_11,$id_12);
							echo "<script>window.location.href='ShowServiceElecMarginServlet';</script>";
						}
						
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
						$sid=105;
						$total_records=show_margins_count(" where service_id=$sid ");
						$margin_result=show_margins_data(" where service_id=$sid ", $start_from, $num_rec_per_page);
						$qr="";//"&s1=$s1&s2=$s2&s3=$s3&s4=$s4&search=search";
						$i=0;
						$sname=show_service_name($sid);
						$level_total=show_levels_count(" where level_id<=12 ");
						$level_result=show_levels_data_desc(" where level_id<=12 ");
						?>
                    	<div class="box-head">
                        	<h3>Distribution Margins of Service (<?php echo $sname;?>) <span class="w3-right w3-blue w3-center badges"><?php echo $total_records;?></span></h3>
                        </div>
                        <div class="w3-responsive">
							<form class="wh w3-left" method="post">
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
									$fldids="r$i-c0";
								?>
                                <tr>
                                	<td><?php echo $i;?></td>
                                    <td><?php echo show_operator_name($margin_row['operator_id']);?></td>
                                    <td><?php echo $charges_type;?></td>
                                    <td>
										<input type="hidden" value="<?php echo $sid;?>" name="filled_service[]" >
										<input type="hidden" value="<?php echo $margin_row['operator_id'];?>" name="filled_operator[]" />
										<input id="<?php echo $fldids;?>" name="id_00[]" style="width:60px;height:30px;" readonly type="text" value="<?php echo $id_00;?>" class="w3-input w3-round w3-border"/>
									</td>
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
										
										$redis="";
										if($field=="id_01")
											$redis=" readonly ";
										$fldids="r$i-c".$level_row['level_id'];
									?>
                                    <td>
										<input name="<?php echo $field;?>[]" onkeyup="check(<?php echo $level_total;?>,<?php echo $i;?>)" id="<?php echo $fldids;?>" style="width:60px;height:30px;" <?php echo $redis;?> type="text" value="<?php echo $field_val;?>" class="w3-input w3-round w3-border"/>
									</td>
									<?php
									}
									?>
                                </tr>
								<?php
								}
								?>
                            </table>
							<div class="w3-row-padding w3-margin-bottom w3-margin-top w3-right-align">
								<button name="UpdateDistribution" class="w3-button w3-round w3-blue">Update Distribution</button>
							</div>
							</form>
                        </div>
                    </div>
                </div>               
                
            </div>
        <!--</div>-->
    </section>
       
    <?php include_once('_footer.php');?>

</body>
</html> 
