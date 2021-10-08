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
                        	<h3>Affiliate Commission PAY NOW</h3>
                        </div>
                        <form class="wh w3-left">
                        	<div class="w3-row-padding w3-margin-bottom">    	
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>USER NAME</label>	
                                	<input type="text" placeholder="Name" class="w3-input w3-border w3-round" disabled>                                    
                                </div>  
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>GENERATED COMMISSION</label>
                                	<input type="text" placeholder="GENERATED COMMISSION" class="w3-input w3-border w3-round" disabled>                                    
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>PAID COMMISSION</label>
                                	<input type="text" placeholder="PAID COMMISSION" class="w3-input w3-border w3-round" disabled>                                    
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>REMAIN COMMISSION</label>
                                	<input type="text" placeholder="REMAIN COMMISSION" class="w3-input w3-border w3-round" disabled>                                    
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>AMOUNT (Paid via Bank Transfer)</label>
                                	<input type="text" placeholder="AMOUNT (Paid via Bank Transfer)" class="w3-input w3-border w3-round">                                    
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>REMARKS</label>
                                	<input type="text" placeholder="REMARKS" class="w3-input w3-border w3-round">                                    
                                </div>
                                   
                                <div class="w3-col m12 w3-margin-top w3-right-align">
                                	<a class="w3-button w3-round w3-blue" onclick="document.getElementById('id01').style.display='block'">UPDATE</a>
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
      	<p>Do you want to UPDATE.?</p>
      </div>  
        <div class="w3-container" style="margin-bottom:10px;">
            <div class="w3-bar w3-center">
                <a href="CommissionAffiliatesUnPaid" class="w3-button w3-blue w3-round">Yes</a>
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
