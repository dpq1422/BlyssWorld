<!DOCTYPE html>
<html>
<head>
<?php include_once('_all-inner-pages-html-title.php'); ?>
<!--date picker-->
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js"></script> 
<link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet"> -->
<!--date picker-->  
<script>
var click=0;
function update_client_charge()
{
	click++;
	if(click==1)
	$("#UpdateClientCharges").click();
}
function show_source_price(row_num)
{
	var source = $("#sources"+row_num).val();
	if(source!=0)
	{
		sources=source.split("@#@");
		$("#selected_service"+row_num).val(sources[0]);
		$("#margin_in_amt"+row_num).html(sources[1]);
	}
	else
	{
		$("#selected_service"+row_num).val('0');
		$("#margin_in_amt"+row_num).html('');
	}
}
</script>

</head>
<body>

	<?php include_once('_header.php'); ?>
    
    <section class="boxes wh w3-left">
        <!--<div class="w3-container">-->
            <!--<div class="w3-row-padding">
                <div class="w3-col m12">
                	<h4 class="heading wh w3-left"><span>Submit Form</span></h4>
                </div>
            </div>-->
            <div class="w3-row-padding w3-margin-top">
            	<div class="w3-col m12 wow bounceIn">
                	<div class="table-box wh w3-left">
						<?php
						include_once('zf-Client.php');
						include_once('zf-Service.php');
						include_once('zf-Operator.php');
						include_once('zf-Source.php');
						include_once('zf-Margin.php');
						include_once('zf-ClientCharges.php');
						include_once('AjaxShowSourceOperatorPriceServlet.php');
						
						$client_id=$_REQUEST['id'];
						$client_name=show_client_name($client_id);
						$client_type=show_client_type($client_id);
						$client_type_id=show_client_type_id($client_id);
						$service_id=102;
						$is_service_allocated=is_service_allocated($client_id,$service_id);
						if($is_service_allocated==0)
							header("location: ClientsServlet");
						$service_name=show_service_name($service_id);						
						$operator_result=show_operators_data(" where service_id=$service_id and operator_status=1");
						
						if(isset($_POST['UpdateClientCharges']))
						{
							include_once('zc-session-admin.php');
							$val1=$_POST['client'];
							$val2=$_POST['service'];
							$val3=$_POST['operator'];
							$val4=$_POST['source'];
							$val5=$_POST['charges_type'];
							$val6=$_POST['from'];
							$val7=$_POST['to'];
							$val8=$_POST['fix'];
							$val9=$_POST['percent'];
							for($aa=0;$aa<count($val1);$aa++)
							{
								$client=mysql_real_escape_string($val1[$aa]);
								$service=mysql_real_escape_string($val2[$aa]);
								$operator=mysql_real_escape_string($val3[$aa]);
								$source=mysql_real_escape_string($val4[$aa]);
								$charges_type=mysql_real_escape_string($val5[$aa]);		
								$from=mysql_real_escape_string($val6[$aa]);		
								$to=mysql_real_escape_string($val7[$aa]);			
								$fix=mysql_real_escape_string($val8[$aa]);
								$percent=mysql_real_escape_string($val9[$aa]);	
								if($aa==0)
									delete_clients_charges($client,$service);
								if($source!=0)
								{
									$clienttype=show_client_type_id($client);
									store_clients_charges($client, $service, $operator, $charges_type, $from, $to, $fix, $percent, $logged_user_typename, $logged_user_id, $logged_user_name, $source, $clienttype);
								}
							}
							echo "<script>window.location.href='ClientsServlet';</script>";
						}
						
						?>
                    	<div class="box-head">
                        	<h3>Set Prepaid Mobile Recharge Commissions for Client</h3>
                        </div>
                        <form class="wh w3-left" action="" method="post">
                        	<div class="w3-row-padding w3-margin-bottom">  
                            	                      	
                            	<div class="w3-col m6 l3 w3-margin-top">
                                	<label>Client ID</label>	
                                	<input type="text" value="<?php echo $client_id;?>" placeholder="Client ID" class="w3-input w3-border w3-round" disabled>                                    
                                </div>
                                
                                <div class="w3-col m6 l3 w3-margin-top">
                                	<label>Client Name</label>
                                	<input type="text" value="<?php echo $client_name;?>" placeholder="Client Name" class="w3-input w3-border w3-round" disabled>                                    
                                </div>
                                
                                <div class="w3-col m6 l3 w3-margin-top">
                                	<label>Client Type</label>
                                	<input type="text" value="<?php echo $client_type;?>" placeholder="Client Type" class="w3-input w3-border w3-round" disabled>                                    
                                </div>
                                
                                <div class="w3-col m6 l3 w3-margin-top">
                                	<label>Service Name</label>
                                	<input type="text" value="<?php echo $service_name;?>" placeholder="Service Name" class="w3-input w3-border w3-round" disabled>               
                                </div>                       
                        	</div>
								
							<div class="w3-responsive">
								<table class="w3-table-all" id="myTable" style="border:none;">
									<tr class="w3-blue">
									  <th>ID</th>
									  <th>OPERATOR</th>
									  <th>AVAILABLE SOURCE</th>
									  <th>ALLOCATED SOURCE</th>
									  <th>TYPE</th>
									  <th>GETTING</th>
									  <th>GIVING</th>
									</tr>      
								<?php
								$i=0;
								while($operator_row=mysql_fetch_array($operator_result))
								{
									$i++;
									$opr_id=$operator_row['operator_id'];
									$opr=show_operator_name($opr_id);
									$margin_result=show_margins_data(" where operator_id=$opr_id ");
									$margin_source="";
									$x=0;
									while($margin_row=mysql_fetch_array($margin_result))
									{
										if($x!=0)
										$margin_source.=",";
										$margin_source.=$margin_row['source_id'];
										$x++;
									}
								
									$charges_type="Commission in percentage";
									$allocated_source_id="";
									$allocated_source="-";
									$allocated_price="";
								?>
									<tr>
									  <td><?php echo $i;?></td>
									  <td><?php echo $opr;?></td>
									  <td>
										<select style='width:120px;height:35px;' class="w3-select w3-border w3-round" id="sources<?php echo $i;?>" name="sources" onchange="show_source_price('<?php echo $i;?>')">
										<option value='0'>Select Source</option>
										<?php
										$source_result=show_sources_data(" where source_id in($margin_source)  and source_status=1");
										while($source_row=mysql_fetch_array($source_result))
										{
											$sel="";
											$price=0;
											$val="";
											$price=show_margin_by_source_of_operator($source_row['source_id'],$opr_id);
											$sel=show_selected_source_of_operator_of_client($client_id,$opr_id);
											if($sel==$source_row['source_id'])
											{
												$sel=" selected ";
												$allocated_source=$source_row['source_name'];
												$allocated_source_id=$source_row['source_id'];
												$allocated_price=$price;
											}
											$val=$source_row['source_id']."@#@".$price;
											echo "<option value='$val' $sel>".$source_row['source_name']." - ".$price."</option>";
										}
										$charges_out_amt=show_price_of_selected_source_of_operator_of_client($client_id,$opr_id,$allocated_source_id);
										?>
										</select>
									  </td>
									  <td><?php echo $allocated_source;?></td>
									  <td><?php echo $charges_type;?></td>
									  <td id="margin_in_amt<?php echo $i;?>"><?php echo $allocated_price;?></td>
									  <td>
										<input type="hidden" class="text" name="client[]" value="<?php echo $client_id;?>"/>
										<input type="hidden" class="text" name="service[]" value="<?php echo $service_id;?>"/>
										<input type="hidden" class="text" name="operator[]" value="<?php echo $opr_id;?>"/>
										<input type="hidden" class="text" id="selected_service<?php echo $i;?>" name="source[]" value="<?php echo $allocated_source_id;?>"/>
										<input type="hidden" class="text" name="charges_type[]" value="1"/>
										<input type="hidden" class="text" name="from[]" value="0"/>
										<input type="hidden" class="text" name="to[]" value="0"/>
										<input type="hidden" class="text" name="fix[]" value="0"/>
										<input type="text" style='width:120px;height:30px;' class="w3-input w3-border w3-round" name="percent[]" value="<?php echo $charges_out_amt;?>" />
									  </td>
									</tr>    
								<?php
								}
								?>
									<tr>
									  <td colspan='7' class='w3-right-align'><a class="w3-button w3-round w3-blue" onclick="document.getElementById('id01').style.display='block'">Update Client RC Charges</a>
										<button name="UpdateClientCharges" id="UpdateClientCharges" class="w3-button w3-round-small w3-right w3-blue display-none">UPDATE</button>
									  </td>
									</tr>
								</table>	
							</div>
                        </form>
                    </div>
                </div>
          	 </div>                       
        <!--</div>-->
    </section>
    
  <div id="id01" class="w3-modal">
    <div class="w3-modal-content w3-animate-zoom w3-card-4 w3-round list-pop">
      <header class="w3-container w3-blue"> 
        <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright"><img src="img/close.png" style="margin-bottom:0px;"></span>
        <h3 class="w3-center">Confirm</h3> 
      </header> 
      <div class="w3-container w3-center">
      	<p>Do you want to update.?</p>
      </div>  
        <div class="w3-container" style="margin-bottom:10px;">
            <div class="w3-bar w3-center">
                <a onclick="update_client_charge()" class="w3-button w3-blue w3-round">Yes</a>
                <a  onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-blue w3-round">No</a>
            </div> 
        </div> 
    </div>
  </div>
       
    <?php include_once('_footer.php');?>

<!--date picker-->
<!--<script type="text/javascript">
    $( "#datepicker" ).datepicker();
	$( "#timepicker" ).timepicker();
</script>-->
<!--date picker-->
</body>
</html> 
