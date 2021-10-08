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
						
						$client_id=$_REQUEST['id'];
						$client_name=show_client_name($client_id);
						$client_type=show_client_type($client_id);
						$client_type_id=show_client_type_id($client_id);
						$service_id=116;
						$is_service_allocated=is_service_allocated($client_id,$service_id);
						if($is_service_allocated==0)
							header("location: ClientsServlet");
						$service_name=show_service_name($service_id);						
						$margin_result=show_margins($service_id);
						
						if(isset($_POST['UpdateClientCharges']))
						{
							include_once('zc-session-admin.php');
							$val1=$_POST['client'];
							$val2=$_POST['service'];
							$val3=$_POST['operator'];
							$val4=$_POST['source'];
							$val5=$_POST['charges'];
							$val6=$_POST['from'];
							$val7=$_POST['to'];
							$val8=$_POST['percent'];
							$val9=$_POST['fix'];
							for($aa=0;$aa<count($val1);$aa++)
							{
								$client=mysql_real_escape_string($val1[$aa]);
								$service=mysql_real_escape_string($val2[$aa]);
								$operator=mysql_real_escape_string($val3[$aa]);
								$source=mysql_real_escape_string($val4[$aa]);
								$charges=mysql_real_escape_string($val5[$aa]);		
								$from=mysql_real_escape_string($val6[$aa]);		
								$to=mysql_real_escape_string($val7[$aa]);		
								$percent=mysql_real_escape_string($val8[$aa]);		
								$fix=mysql_real_escape_string($val9[$aa]);
								if($aa==0)
									delete_clients_charges($client,$service);
								if($source!=0)
								{
									$clienttype=show_client_type_id($client);
									store_clients_charges($client, $service, $operator, $charges, $from, $to, $fix, $percent, $logged_user_typename, $logged_user_id, $logged_user_name, $source, $clienttype);
								}
							}
							echo "<script>window.location.href='ClientsServlet';</script>";
						}
						?>
                    	<div class="box-head">
                        	<h3>Set Datacard Charges for Client</h3>
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
									  <th>ALLOCATED SOURCE</th>
									  <th>OPERATOR</th>
									  <th>SLAB</th>
									  <th>TYPE</th>
									  <th>GETTING</th>
									  <th>GIVING</th>
									</tr>  
								<?php
								include_once('zc-session-admin.php');
								$i=0;
								while($margin_row=mysql_fetch_array($margin_result))
								{
									$i++;
									$opr=show_operator_name($margin_row['operator_id']);
									$src=show_source_name($margin_row['source_id']);
									$slab_from=$margin_row['slab_from'];
									$slab_to=$margin_row['slab_to'];
									$slab="$slab_from - $slab_to";
									$charges_type=$margin_row['charges_type'];
									$charges_type_id=$charges_type;
									if($charges_type<0)
										$charges_type="Surcharge";
									else if($charges_type==0)
										$charges_type="";
									else if($charges_type>0)
										$charges_type="Commission";
									
								$margin_in_amt=0;
								$margin_fix=$margin_row['surcharges_fix'];
								if($margin_fix!=0)
								{
									$charges_type="Fix $charges_type";
									$margin_in_amt="$margin_fix";
								}
								$margin_percent=$margin_row['surcharges_percent'];
								if($margin_percent!=0)
								{
									$charges_type="$charges_type in Percentage";
									$margin_in_amt="$margin_percent";
								}
								if($margin_in_amt==0)
									$charges_type="Not any $charges_type";
								$charges_out_result=show_clients_charges_data($client_id,$service_id,$margin_row['operator_id'],$margin_row['slab_from'],$margin_row['slab_to'],$margin_row['source_id']);
								$surcharges_percent = mysql_result($charges_out_result, 0, 'surcharges_percent');
								$surcharges_fix = mysql_result($charges_out_result, 0, 'surcharges_fix');
								$charges_out_amt=0;
								if($surcharges_percent!=0)
								{
									$charges_out_amt="<input type='text' required name='percent[]' value='$surcharges_percent' style='width:80px;height:25px;' class='w3-input w3-border w3-round' />
									    <input type='hidden' name='fix[]' value='$surcharges_fix' style='width:80px;height:25px;' class='w3-input w3-border w3-round' />";
								}
								else if($surcharges_fix!=0)
								{
									$charges_out_amt="<input type='hidden' name='percent[]' value='$surcharges_percent' style='width:80px;height:25px;' class='w3-input w3-border w3-round' />
									    <input type='text' name='fix[]' required value='$surcharges_fix' style='width:80px;height:25px;' class='w3-input w3-border w3-round' />";
								}
								else
								{
									$charges_out_amt="<input type='hidden' name='percent[]' value='0' style='width:80px;height:25px;' class='w3-input w3-border w3-round' />
									    <input type='text' name='fix[]' required value='0' style='width:80px;height:25px;' class='w3-input w3-border w3-round' />";
								}
								?>
									<tr>
									  <td><?php echo $margin_row['charges_in_id'];?></td>
									  <td><?php echo $src;?></td>
									  <td><?php echo $opr;?></td>
									  <td><?php echo $slab;?></td>
									  <td><?php echo $charges_type;?></td>
									  <td><?php echo $margin_in_amt;?></td>
									  <td>
										<input type="hidden" class="text" name="client[]" value="<?php echo $client_id;?>"/>
										<input type="hidden" class="text" name="service[]" value="<?php echo $service_id;?>"/>
										<input type="hidden" class="text" name="operator[]" value="<?php echo $margin_row['operator_id'];?>"/>
										<input type="hidden" class="text" name="source[]" value="<?php echo $margin_row['source_id'];?>"/>
										<input type="hidden" class="text" name="charges[]" value="<?php echo $charges_type_id;?>"/>
										<input type="hidden" class="text" name="from[]" value="<?php echo $slab_from;?>"/>
										<input type="hidden" class="text" name="to[]" value="<?php echo $slab_to;?>"/>
										<?php echo $charges_out_amt;?>
									  </td>
									</tr>    
								<?php
								}
								?>
									<tr>
									  <td colspan='7' class='w3-right-align'><a class="w3-button w3-round w3-blue" onclick="document.getElementById('id01').style.display='block'">Update Client Charges</a>
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
</body>
</html> 
