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
                        	<h3>ADD NEW USER</h3>
                        </div>
                        <form class="wh w3-left">
                        	<div class="w3-row-padding w3-margin-bottom">  
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>Date</label>	
                                	<input type="date" class="w3-input w3-border w3-round"  disabled>                                   
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>Time</label>	
                                	<input type="time" class="w3-input w3-border w3-round"  disabled>                                   
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>User Type</label>
                                	<select class="w3-select w3-border w3-round" name="option">
                                        <option value="" disabled selected>Choose your option</option>
                                        <option value="1">Admin</option>
                                        <option value="2">User</option>
                                    </select>
                                </div>
                            	                      	
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>Name</label>	
                                	<input type="text" placeholder="Name" class="w3-input w3-border w3-round">                                    
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>Email</label>
                                	<input type="text" placeholder="Email" class="w3-input w3-border w3-round">                                    
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>Mobile</label>
                                	<input type="text" placeholder="Mobile" class="w3-input w3-border w3-round">                                    
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top" style="position:relative">
                                	<label>Password</label>
                                	<input type="password" id="password" placeholder="Password" class="w3-input w3-border w3-round">
                                    <img src="img/eye.png" class="eye" onclick="myFunction()">
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top" style="position:relative">
                                	<label>Confirm Password</label>
                                	<input type="password" id="confirm-password" placeholder="Confirm Password" class="w3-input w3-border w3-round">
                                    <img src="img/eye.png" class="eye" onclick="myFunction2()">
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>Address</label>
                                	<input type="text" placeholder="Address" class="w3-input w3-border w3-round">                                    
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>State</label>
                                	<select class="w3-select w3-border w3-round" name="option">
                                        <option value="" disabled selected>Choose your option</option>
                                    </select>
                                </div>
                                
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>District</label>
                                	<select class="w3-select w3-border w3-round" name="option">
                                        <option value="" disabled selected>Choose your option</option>
                                    </select>
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>City</label>
                                	<input type="text" placeholder="City" class="w3-input w3-border w3-round">                                    
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>Area Pincode</label>	
                                	<input type="text" placeholder="Area Pincode" class="w3-input w3-border w3-round">
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top gender-w">
                                	<label>Department</label>
                                    <div>
                                        <input class="w3-check" type="checkbox">
                                        <label>Services</label>
                                    </div>
                                    <div>
                                    	<input class="w3-check" type="checkbox">
                                    	<label>Client</label>
                                    </div>
                                    <div>
                                        <input class="w3-check" type="checkbox">
                                        <label>Wallet</label>
                                    </div>
                                    <div>
                                        <input class="w3-check" type="checkbox">
                                        <label>Transactions</label>
                                    </div>
                                    <div>
                                        <input class="w3-check" type="checkbox">
                                        <label>Support</label>
                                    </div>
                                    <div>
                                        <input class="w3-check" type="checkbox">
                                        <label>Audit</label>
                                    </div>
                                    <div>
                                        <input class="w3-check" type="checkbox">
                                        <label>Marketing</label>
                                    </div>
                                </div> 
                                
                                <div class="w3-col m6 l4 w3-margin-top gender-w">
                                	<label>Gender</label>
                                    <div>
                                        <input class="w3-radio" type="radio" name="gender" value="male" checked>
                                        <label>Male</label>
                                    </div>
                                    <div>
                                    	<input class="w3-radio" type="radio" name="gender" value="female">
                                    	<label>Female</label>
                                    </div>
                                    <div>
                                       <input class="w3-radio" type="radio" name="gender" value="trans gender">
                                        <label>Trans Gender</label>
                                    </div>
                                </div>
                                   
                                <div class="w3-col m12 w3-margin-top w3-right-align">
                                	<a class="w3-button w3-round w3-blue" onclick="document.getElementById('id01').style.display='block'">SAVE</a>
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
      	<p>Do you want to save.?</p>
      </div>  
        <div class="w3-container" style="margin-bottom:10px;">
            <div class="w3-bar w3-center">
                <a href="UsersServlet" class="w3-button w3-blue w3-round">Yes</a>
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
