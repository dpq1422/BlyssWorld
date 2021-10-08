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
                        	<h3>Update MP</h3>
                        </div>
						<?php
						include_once('zf-Company.php');
						$company_result=show_mpip_info(1000);
						$company_row=mysql_fetch_array($company_result);
						if(isset($_POST['UpdateMpIp']))
						{
							include_once('zc-session-admin.php');
							include_once('zf-Company.php');
							$pmp=mysql_real_escape_string($_POST['pmp']);
							$cmp=mysql_real_escape_string($_POST['cmp']);
							$aip=mysql_real_escape_string($_POST['aip']);
							update_mpip_info(1000,$pmp,$cmp,$aip);
							echo "<script>window.location.href='AdminUpdateMpIp';</script>";
						}
						?>
                        <form class="wh w3-left" method="post">
                        	<div class="w3-row-padding w3-margin-bottom">    	
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>Parent MP Name</b></label>	
                                	<input type="text" maxlength="4" name="pmp" id="pmp" placeholder="Name" class="w3-input w3-border w3-round" value="<?php echo $company_row['mntr_mp'];?>">                                    
                                </div>    	
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>Child MP Name</b></label>	
                                	<input type="text" maxlength="8" name="cmp" id="cmp" placeholder="Name" class="w3-input w3-border w3-round" value="<?php echo $company_row['wl_mp'];?>">                                    
                                </div>    	
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>AIP Name</b></label>	
                                	<input type="text" maxlength="15" name="aip" id="aip" placeholder="Name" class="w3-input w3-border w3-round" value="<?php echo $company_row['ip'];?>">                                    
                                </div>  
                                   
                                <div class="w3-col m12 w3-margin-top w3-right-align">
                                	<button name="UpdateMpIp" class="w3-button w3-round w3-blue">Update</button>
                                </div>
                        	</div>
                        </form>
                    </div>
                </div>
          	 </div>                       
        <!--</div>-->
    </section>
       
    <?php include_once('_footer.php');?>

<!--date picker-->
<!--<script type="text/javascript">
    $( "#datepicker" ).datepicker();
	$( "#timepicker" ).timepicker();
</script>-->
<!--date picker-->
</body>
</html> 
