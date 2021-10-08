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
function myFunction() {
    var x = document.getElementById("password");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
function myFunction2() {
    var x = document.getElementById("confirm-password");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
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
                    	<div class="box-head">
                        	<h3>COMPANY INFO (Display)</h3>
                        </div>
						<?php
						include_once('zf-Company.php');
						include_once('zf-State.php');
						include_once('zf-Districts.php');
						$company_result=show_company_info(1);
						$company_row=mysql_fetch_array($company_result);
						?>
                        <form class="wh w3-left">
                        	<div class="w3-row-padding w3-margin-bottom">  
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>Company Name</label>	
                                	<input type="text" placeholder="Name" class="w3-input w3-border w3-round" 
									value="<?php echo $company_row['company_name'];?>" disabled>                                    
                                </div>                           
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>Mobile</label>
                                	<input type="text" placeholder="Mobile" class="w3-input w3-border w3-round" 
									value="<?php echo $company_row['contact_no'];?>" disabled>                                    
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>Email</label>
                                	<input type="text" placeholder="Email" class="w3-input w3-border w3-round" 
									value="<?php echo $company_row['e_mail'];?>" disabled>                                    
                                </div>   
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>Address</label>
                                	<input type="text" placeholder="Address" class="w3-input w3-border w3-round" 
									value="<?php echo $company_row['address'];?>" disabled>                                    
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>State</label>
                                	<input type="text" placeholder="State" class="w3-input w3-border w3-round" value="<?php echo show_state_name($company_row['state_id']);?>" disabled>
                                </div>
                                
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>District</label>
                                	<input type="text" placeholder="District" class="w3-input w3-border w3-round" value="<?php echo show_district_name($company_row['distt_id']);?>" disabled>
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>City</label>
                                	<input type="text" placeholder="City" class="w3-input w3-border w3-round" 
									value="<?php echo $company_row['city_name'];?>" disabled>                                    
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>Area Pincode</label>	
                                	<input type="text" placeholder="Area Pincode" class="w3-input w3-border w3-round" 
									value="<?php echo $company_row['area_pin_code'];?>" disabled>
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>Website</label>
                                	<input type="text" placeholder="Website" class="w3-input w3-border w3-round" 
									value="<?php echo $company_row['web_site'];?>" disabled>                                    
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>Pan Card (for Invoicing)</label>
                                	<input type="text" placeholder="Pan Card" class="w3-input w3-border w3-round" 
									value="<?php echo $company_row['pan_no'];?>" disabled>                                    
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>GST No. (for Invoicing)</label>
                                	<input type="text" placeholder="GST No." class="w3-input w3-border w3-round" 
									value="<?php echo $company_row['gst_no'];?>" disabled>                                    
                                </div> 
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>Estd. in (for Website Footer)</label>
                                	<input type="text" placeholder="&copy; &amp; &reg; 2012. All rights are reserved." class="w3-input w3-border w3-round" 
									value="<?php echo $company_row['estd_in'];?>" disabled>                                    
                                </div> 
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>Footer Note (for Website Footer)</label>
                                	<input type="text" placeholder="Powered by Mentor India" class="w3-input w3-border w3-round" 
									value="<?php echo $company_row['powered_by'];?>" disabled>                                    
                                </div>
                                
                                <div class="w3-col m6 l12 w3-margin-top">
                                	<label>Remarks</label>
                                	<textarea type="text" rows="10" placeholder="Remarks" class="w3-input w3-border w3-round" disabled><?php echo str_replace("<br>","\n",$company_row['company_remarks']);?></textarea>
                                </div>
                                   
								<?php
								if($logged_user_type==1)
								{
								?>                                   
                                <div class="w3-col m12 w3-margin-top w3-right-align">
                                	<a class="w3-button w3-round w3-blue" onclick="document.getElementById('id01').style.display='block'">Edit Info</a>
                                </div>       
								<?php
								}
								?>                                 
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
      	<p>Do you want to edit?</p>
      </div>  
        <div class="w3-container" style="margin-bottom:10px;">
            <div class="w3-bar w3-center">
                <a href="CompanyInfoEditServlet" class="w3-button w3-blue w3-round">Yes</a>
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
