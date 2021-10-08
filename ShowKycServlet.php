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
						include_once('zf-User.php');
						include_once('zf-Level.php');
						include_once('zf-UserWalletKyc.php');
						$userid=$_REQUEST['uid'];
						$username=show_user_name($userid);
						$usertype=show_user_type($userid);
						$usertypename=show_level_name($usertype);
						$kyc_data=show_kyc_data($userid);
						$kyc_files=show_kyc_files($userid);
						$total_records=mysql_num_rows($kyc_files);
						?>
                    	<div class="box-head">
                        	<h3>USER KYC DETAILS</h3>
                        </div>					
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
						
                    	<div class="box-head">
                        	<h3>KYC DOCUMENTS <span class="w3-right w3-blue w3-center badges"><?php echo $total_records;?></span></h3>
                        </div>						
                        <div class="w3-responsive">
                            <table class="w3-table-all" id="myTable" style="border:none;">
                                <tr class="w3-blue">
									<th>S.No.</th>
									<th>Date Time</th>
									<th>Remarks</th>
									<th>Link</th>
                                </tr>      
								<?php
								while($kyc_row=mysql_fetch_array($kyc_files))
								{
									$i++;
									$file="";
									if(isset($kyc_row['doc_1']))
									$file=$kyc_row['doc_1'];
									if(isset($kyc_row['doc_2']))
									$file=$kyc_row['doc_2'];
									if(isset($kyc_row['doc_3']))
									$file=$kyc_row['doc_3'];
									if(isset($kyc_row['doc_4']))
									$file=$kyc_row['doc_4'];
								
									$file="<a href='kyc/$file.jpg' style='color:#cc5801;' target='_blank'>$file</a>";
								?>                          
                                <tr>
                                  <td><?php echo $i;?></td>
                                  <td><?php echo $kyc_row['uploaded_at'];?></td>
                                  <td><?php echo $kyc_row['remarks'];?></td>
                                  <td><?php echo $file;?></td>
                                </tr>
								<?php
								}
								?>
                            </table>	
                        </div>
						<form class="wh w3-left" method="post">		
                        	<div class="w3-row-padding w3-margin-bottom"> 								
                            	<div class="w3-col m12 l12 w3-margin-top">
									<b class='w3-text-blue w3-medium'>USER INFORMATION</b>                               
                                </div>						
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>NAME</label>	
                                	<input type="text" value="<?php echo $kyc_data[0];?>" placeholder="User ID" class="w3-input w3-border w3-round">                                    
                                </div>
                            	                      	
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>E-MAIL</label>
                                	<input type="text" value="<?php echo $kyc_data[1];?>" placeholder="User Name" class="w3-input w3-border w3-round">                                    
                                </div>
                                
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>CONTACT NUMBER</label>	
                                	<input type="text" value="<?php echo $kyc_data[3];?>" placeholder="User Type" class="w3-input w3-border w3-round">                                    
                                </div>				
                                
                            	<div class="w3-col m12 l12 w3-margin-top">
                                	<label>ADDRESS</label>	
                                	<input type="text" value="<?php echo $kyc_data[2];?>" placeholder="User Type" class="w3-input w3-border w3-round">                                    
                                </div>		
                                
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>STATE</label>	
                                	<input type="text" value="<?php echo $kyc_data[6];?>" placeholder="User Type" class="w3-input w3-border w3-round">                                    
                                </div>		
                                
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>DISTRICT</label>	
                                	<input type="text" value="<?php echo $kyc_data[5];?>" placeholder="User Type" class="w3-input w3-border w3-round">                                    
                                </div>		
                                
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>CITY</label>	
                                	<input type="text" value="<?php echo $kyc_data[4];?>" placeholder="User Type" class="w3-input w3-border w3-round">                                    
                                </div>			
                                
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>PINCODE</label>	
                                	<input type="text" value="<?php echo $kyc_data[7];?>" placeholder="User Type" class="w3-input w3-border w3-round">                                    
                                </div>			
                                
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>GEO LOCATION</label>	
                                	<input type="text" value="<?php echo $kyc_data[12];?>" placeholder="User Type" class="w3-input w3-border w3-round">                                    
                                </div>		
                                
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>AADHAR CARD NO</label>	
                                	<input type="text" value="<?php echo $kyc_data[9];?>" placeholder="User Type" class="w3-input w3-border w3-round">                                    
                                </div>		
                                
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>PAN CARD NO</label>	
                                	<input type="text" value="<?php echo $kyc_data[10];?>" placeholder="User Type" class="w3-input w3-border w3-round">                                    
                                </div>		
                                
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>DATE OF BIRTH</label>	
                                	<input type="date" value="<?php echo $kyc_data[11];?>" placeholder="User Type" class="w3-input w3-border w3-round">                                    
                                </div>		
                                
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>GENDER</label>	
                                	<select name="a1" class="w3-input w3-border w3-round">
										<?php
											$gensel="";
											$malesel="";
											$femalesel="";
											$transgensel="";
											if($kyc_data[8]==3)
												$gensel="selected";
											else if($kyc_data[8]==1)
												$malesel="selected";
											else if($kyc_data[8]==0)
												$femalesel="selected";
											else if($kyc_data[8]==-1)
												$transgensel="selected";
											echo "<option value='' $gensel>Gender</option>";
											echo "<option value='1' $malesel>Male</option>";
											echo "<option value='0' $femalesel>Female</option>";
											echo "<option value='-1' $transgensel>Trans Gender</option>";
										?>
										
									</select>                                                                  
                                </div>		
								
                            	<div class="w3-col m12 l12 w3-margin-top">
									<b class='w3-text-blue w3-medium'>BUSINESS INFORMATION</b>                               
                                </div>		
								
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>BUSINESS NAME</label>	
                                	<input type="text" value="<?php echo $kyc_data[13];?>" placeholder="User ID" class="w3-input w3-border w3-round">                                    
                                </div>
                                
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>BUSINESS LOGO</label>	
                                	<input type="text" value="<?php echo $kyc_data[15];?>" placeholder="User Type" class="w3-input w3-border w3-round">                                    
                                </div>			
                                
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>GST NO</label>	
                                	<input type="text" value="<?php echo $kyc_data[16];?>" placeholder="User Type" class="w3-input w3-border w3-round">                                    
                                </div>	
                            	                      	
                                <div class="w3-col m6 l12 w3-margin-top">
                                	<label>BUSINESS ADDRESS</label>
                                	<input type="text" value="<?php echo $kyc_data[14];?>" placeholder="User Name" class="w3-input w3-border w3-round">                                    
                                </div>	
								
                            	<div class="w3-col m12 l12 w3-margin-top">
									<b class='w3-text-blue w3-medium'>BANK ACCOUNT INFORMATION</b>                               
                                </div>		
								
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>BANK NAME</label>	
                                	<input type="text" value="<?php echo $kyc_data[17];?>" placeholder="User ID" class="w3-input w3-border w3-round">                                    
                                </div>
                            	                      	
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>IFSC CODE</label>
                                	<input type="text" value="<?php echo $kyc_data[19];?>" placeholder="User Name" class="w3-input w3-border w3-round">                                    
                                </div>
                                
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>ACCOUNT NUMBER</label>	
                                	<input type="text" value="<?php echo $kyc_data[18];?>" placeholder="User Type" class="w3-input w3-border w3-round">                                    
                                </div>			
								
                            	<div class="w3-col m12 l12 w3-margin-top">
									<b class='w3-text-blue w3-medium'>KYC STATUS</b>                               
                                </div>			
								
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>UPDATED STATUS </label>	
                                	<select name="a1" class="w3-input w3-border w3-round">
									<?php
									$kveri="";
									$kincomp="";
									if($kyc_data[20]==3)
										$kveri="selected";
									else
										$kincomp="selected";
									
									echo "<option value=''>KYC STATUS</option>";
									echo "<option value='4' $kincomp>Documents In-complete</option>";
									echo "<option value='3' $kveri>KYC Verified</option>";
									?> 
									</select>                                                                 
                                </div> 
								<!--
								<div class="w3-col m6 l4 w3-margin-top">
                                	<label>&nbsp;</label>
									<input type="button" onclick="check_values()" value="Update KYC" class="w3-input w3-border w3-round w3-button w3-blue w3-w150">
									<button onclick="check_values()" name="CreateUser" id="CreateUser" class="w3-button w3-round-small w3-right w3-blue display-none">CreateUser</button>
                                </div>-->
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
