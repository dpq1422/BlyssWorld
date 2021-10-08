<!DOCTYPE html>
<html>
<head>
<?php include_once('_all-inner-pages-html-title.php'); ?>
<script>
var click=0;
function updateClientServices()
{
	click++;
	if(click==1)
	$("#UpdateServices").click();
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
						include_once('zf-Service.php');
						include_once('zf-Client.php');
						
						$client_id=$_REQUEST['id'];
						$client_name=show_client_name($client_id);
						$client_type=show_client_type($client_id);
						$client_type_id=show_client_type_id($client_id);
						//$service_ids=show_client_services($client_id);
						//$service_ids=explode(",",$service_ids);
						
						if(isset($_POST['UpdateServices']))
						{
							include_once('zc-session-admin.php');
							$filled_client_type=$_POST['filled_client_type'];
							$filled_client=$_POST['filled_client'];
							$filled_services=implode(",", $_POST['filled_services']);

							$filled_client_type=mysql_real_escape_string($filled_client_type);
							$filled_client=mysql_real_escape_string($filled_client);
							$filled_services=mysql_real_escape_string($filled_services);
							update_client_services($filled_client_type,$filled_client,$filled_services,$logged_user_typename,$logged_user_id,$logged_user_name);
							echo "<script>window.location.href='ClientsServlet';</script>";
						}
						?>
                    	<div class="box-head">
                        	<h3>Allocate Services To Client</h3>
                        </div>
                        <form class="wh w3-left" method="post">
                        	<div class="w3-row-padding w3-margin-bottom">  
                            	                      	
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>Client ID</label>	
                                	<input type="text" value="<?php echo $client_id;?>" placeholder="Client ID" class="w3-input w3-border w3-round" disabled>                                    
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>Client Name</label>
                                	<input type="text" value="<?php echo $client_name;?>" placeholder="Client Name" class="w3-input w3-border w3-round" disabled>                                    
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>Client Type</label>
                                	<input type="text" value="<?php echo $client_type;?>" placeholder="Client Type" class="w3-input w3-border w3-round" disabled>                                    
                                </div>
                                
                                <div class="w3-col m3 l4 w3-margin-top">
                                	<label>Services without KYC</label>
                                    <div>
                                    	<input class="w3-check" value="102" name="filled_services[]" 
										<?php if(is_service_allocated($client_id,102)==1) echo "checked"; ?>
										type="checkbox">
                                    	<label>Prepaid Mobile Recharge</label>
                                    </div>
                                    <div>
                                        <input class="w3-check" value="103" name="filled_services[]" 
										<?php if(is_service_allocated($client_id,103)==1) echo "checked"; ?>
										type="checkbox">
                                        <label>DTH Recharge</label>
                                    </div>
                                    <div>
                                        <input class="w3-check" value="105" name="filled_services[]"  
										<?php if(is_service_allocated($client_id,105)==1) echo "checked"; ?>
										type="checkbox">
                                        <label>Electricity Bill Payments</label>
                                    </div>
                                    <div>
                                        <input class="w3-check" value="106" name="filled_services[]"  
										<?php if(is_service_allocated($client_id,106)==1) echo "checked"; ?>
										type="checkbox">
                                        <label>Postpaid Mobile Bill Payments</label>
                                    </div>
                                    <div>
                                        <input class="w3-check" value="113" name="filled_services[]"  
										<?php if(is_service_allocated($client_id,113)==1) echo "checked"; ?>
										type="checkbox">
                                        <label>Landline Bill Payments</label>
                                    </div>
                                    <div>
                                        <input class="w3-check" value="114" name="filled_services[]"  
										<?php if(is_service_allocated($client_id,114)==1) echo "checked"; ?>
										type="checkbox">
                                        <label>Gas Bill Payments</label>
                                    </div>
                                    <div>
                                        <input class="w3-check" value="116" name="filled_services[]"  
										<?php if(is_service_allocated($client_id,116)==1) echo "checked"; ?>
										type="checkbox">
                                        <label>Data Card Bill Payments</label>
                                    </div>
                                    <div>
                                        <input class="w3-check" value="117" name="filled_services[]"  
										<?php if(is_service_allocated($client_id,117)==1) echo "checked"; ?>
										type="checkbox">
                                        <label>Water Bill Payments</label>
                                    </div>
                                    <div>
                                        <input class="w3-check" value="115" name="filled_services[]"   
										<?php if(is_service_allocated($client_id,115)==1) echo "checked"; ?>
										type="checkbox">
                                        <label>Insurance Premium</label>
                                    </div>
                                </div>
                                
                                <div class="w3-col m3 l4 w3-margin-top">
                                	<label>Services with KYC</label>
                                    <div>
                                        <input class="w3-check" value="101" name="filled_services[]"  
										<?php if(is_service_allocated($client_id,101)==1) echo "checked"; ?>
										type="checkbox">
                                        <label>Domestic Money Remittance</label>
                                    </div>
                                    <div>
                                        <input class="w3-check" value="104" name="filled_services[]" disabled  
										<?php if(is_service_allocated($client_id,104)==1) echo "checked"; ?>
										type="checkbox">
                                        <label>Indo Nepal Money Transfer</label>
                                    </div>
                                    <div>
                                        <input class="w3-check" value="107" name="filled_services[]" disabled  
										<?php if(is_service_allocated($client_id,107)==1) echo "checked"; ?>
										type="checkbox">
                                        <label>mPOS</label>
                                    </div>
                                    <div>
                                        <input class="w3-check" value="119" name="filled_services[]" disabled  
										<?php if(is_service_allocated($client_id,119)==1) echo "checked"; ?>
										type="checkbox">
                                        <label>AEPS</label>
                                    </div>
                                    <div>
                                        <input class="w3-check" value="112" name="filled_services[]" disabled  
										<?php if(is_service_allocated($client_id,112)==1) echo "checked"; ?>
										type="checkbox">
                                        <label>Pan Card Services</label>
                                    </div>
                                </div>
                                
                                <div class="w3-col m3 l4 w3-margin-top">
                                	<label>Services Add-on (in Future)</label>
                                    <div>
                                        <input class="w3-check" value="108" name="filled_services[]" disabled  
										<?php if(is_service_allocated($client_id,108)==1) echo "checked"; ?>
										type="checkbox">
                                        <label>Air Ticketing</label>
                                    </div>
                                    <div>
                                        <input class="w3-check" value="109" name="filled_services[]" disabled  
										<?php if(is_service_allocated($client_id,109)==1) echo "checked"; ?>
										type="checkbox">
                                        <label>Hotel Reservation</label>
                                    </div>
                                    <div>
                                        <input class="w3-check" value="110" name="filled_services[]" disabled  
										<?php if(is_service_allocated($client_id,110)==1) echo "checked"; ?>
										type="checkbox">
                                        <label>Bus Ticketing</label>
                                    </div>
                                    <div>
                                        <input class="w3-check" value="111" name="filled_services[]" disabled  
										<?php if(is_service_allocated($client_id,111)==1) echo "checked"; ?>
										type="checkbox">
                                        <label>Railway Ticketing</label>
                                    </div>
                                    <div>
                                        <input class="w3-check" value="118" name="filled_services[]" disabled 
										<?php if(is_service_allocated($client_id,118)==1) echo "checked"; ?>
										type="checkbox">
                                        <label>Gift Voucher</label>
                                    </div>
                                </div>
                                   
                                <div class="w3-col m12 w3-margin-top w3-right-align">
									<input type="hidden" value="<?php echo $client_id;?>" name="filled_client" />
									<input type="hidden" value="<?php echo $client_type_id;?>" name="filled_client_type" />
									<a class="w3-button w3-round w3-blue" onclick="updateClientServices()">Update Services</a>
									<input id="UpdateServices" name="UpdateServices" class="display-none" type="submit"/>
                                </div>                              
                        	</div>
                        </form>
                    </div>
                </div>
          	 </div>                       
        <!--</div>-->
    </section>
       
    <?php include_once('_footer.php');?>
</body>
</html> 
