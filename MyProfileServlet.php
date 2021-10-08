<!DOCTYPE html>
<html>
<head>
<?php include_once('_all-inner-pages-html-title.php'); ?>
<!--date picker-->
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js"></script> 
<link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet"> -->
<!--date picker--> 

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
                        	<h3>MY PROFILE</h3>
                        </div>
						<?php
						include_once('zf-User.php');
						include_once('zf-Districts.php');
						include_once('zf-State.php');
						$result=show_user_profile($logged_user_id);
						$user_data=mysql_fetch_array($result);
						$distt_id=show_district_name($user_data['distt_id']);
						$state_id=show_state_name($user_data['state_id']);
						$malesel="";
						$femalesel="";
						$transel="";
						if($user_data['gender']==1)
							$malesel="checked";
						else if($user_data['gender']==0)
							$femalesel="checked";
						else if($user_data['gender']==-1)
							$transel="checked";
						?>
                        <form class="wh w3-left">
                        	<div class="w3-row-padding w3-margin-bottom">  
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>Date of Joining</label>	
                                	<input type="text" value="<?php echo $user_data['join_date'];?>" class="w3-input w3-border w3-round"  disabled>                                   
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>Time of Joining</label>	
                                	<input type="text" value="<?php echo $user_data['join_time'];?>" class="w3-input w3-border w3-round"  disabled>                                   
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>User Type</label>
                                	<input type="text" value="<?php echo $logged_user_typename;?>" class="w3-input w3-border w3-round"  disabled>
                                </div>
                            	                      	
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>Name</label>	
                                	<input type="text" value="<?php echo $user_data['user_name'];?>" placeholder="Name" class="w3-input w3-border w3-round"  disabled>                                    
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>Email</label>
                                	<input type="text" value="<?php echo $user_data['e_mail'];?>" placeholder="Email" class="w3-input w3-border w3-round"  disabled>                                    
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>Mobile</label>
                                	<input type="text" value="<?php echo $user_data['user_contact_no'];?>" placeholder="Mobile" class="w3-input w3-border w3-round"  disabled>                                    
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>Address</label>
                                	<input type="text" value="<?php echo $user_data['address'];?>" placeholder="Address" class="w3-input w3-border w3-round"  disabled>                                    
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>City</label>
                                	<input type="text" value="<?php echo $user_data['city_name'];?>" placeholder="City" class="w3-input w3-border w3-round"  disabled>                                    
                                </div>
                                
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>District</label>
                                	<input type="text" value="<?php echo $distt_id;?>" class="w3-input w3-border w3-round"  disabled>
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>State</label>
                                	<input type="text" value="<?php echo $state_id;?>" class="w3-input w3-border w3-round"  disabled>
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>Area Pincode</label>	
                                	<input type="text" value="<?php echo $user_data['area_pin_code'];?>" placeholder="Area Pincode" class="w3-input w3-border w3-round"  disabled>
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top gender-w">
                                	<label>Gender</label>
                                    <div>
                                        <input class="w3-radio" type="radio" <?php echo $malesel;?> disabled name="gender" value="male">
                                        <label>Male</label>
                                    </div>
                                    <div>
                                    	<input class="w3-radio" type="radio" <?php echo $femalesel;?> disabled name="gender" value="female">
                                    	<label>Female</label>
                                    </div>
                                    <div>
                                       <input class="w3-radio" type="radio" <?php echo $transel;?> disabled name="gender" value="trans gender">
                                        <label>Trans Gender</label>
                                    </div>
                                </div>                  
                        	</div>
                        </form>
                    </div>
                </div>
          	 </div>                       
        <!--</div>-->
    </section>
    
  <div id="id01" class="w3-modal">
    <div class="w3-modal-content w3-animate-zoom w3-card-4 w3-round list-pop">
      <header class="w3-container"> 
        <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright"><img src="img/close-red.png" style="margin-bottom:0px;"></span>
        <h3 class="w3-center">Confirm</h3> 
      </header> 
      <div class="w3-container w3-center">
      	<p>Do you want to go back to dashboard.?</p>
      </div>  
        <div class="w3-container" style="margin-bottom:10px;">
            <div class="w3-bar w3-center">
                <a href="DashboardServlet" class="w3-button w3-blue w3-round">Yes</a>
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
