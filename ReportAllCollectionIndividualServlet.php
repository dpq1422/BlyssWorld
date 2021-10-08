<!DOCTYPE html>
<html>
<head>
<?php include_once('_all-inner-pages-html-title.php'); ?>
<script type="text/javascript" src="js/admin-validation-functions.js"></script>
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
                    	<div class="box-head">
                        	<h3>PROGRESS REPORT 16-SEP-2018 (Individual Team)</h3>
                        </div>
						<?php
						$dt1="";
						$dt2="";
						$usid="";
						
						if(isset($_POST['from_date']))
							$dt1=$_POST['from_date'];
						if(isset($_POST['to_date']))
							$dt2=$_POST['to_date'];
						if(isset($_POST['userid']))
							$usid=$_POST['userid'];
						
						if($dt1=="")
							$dt1="$datetime_date";
						if($dt2=="")
							$dt2="$datetime_date";
						if($usid=="")
							$usid="";
						
						$qr="&dt1=$dt1&dt2=$dt2&usid=$usid";
						?>
						<div class="table-search-filter wh w3-left">
							<form class="wh w3-left" method="post">
								<ul>
                                    <li>
										<label>From Date</label>
										<input name="from_date" id="from_date" value="<?php echo $dt1;?>" type="date" placeholder="From Date" required class="w3-input w3-border w3-round">
                                    </li>
                                    <li>
										<label>To Date</label>
										<input name="to_date" id="to_date" value="<?php echo $dt2;?>" type="date" placeholder="To Date" required class="w3-input w3-border w3-round">
                                    </li>
                                    <li>
										<label>User ID (Ex: 200001)</label>
										<input name="userid" id="userid" required maxlength="6" value="<?php echo $usid;?>" type="number" placeholder="User ID" class="w3-input w3-border w3-round">
                                    </li>
                                    <li>
										<label>&nbsp;</label>
										<button name="search" value="search" class="w3-button w3-blue w3-round">Show Collection</button>
                                    </li>    
									<?php if($dt1!="" && $dt2!="" && $usid!="" && strlen($usid)==6) { ?>
                                    <li>
										<label>&nbsp;</label>
										<a href="ReportAllCollectionIndividualServlets?q=q<?php echo $qr;?>" class="w3-button w3-green w3-round">Download Excel</a>
                                    </li>   
									<?php } ?>                                
                                </ul>
                            </form>
                        </div>
                    </div>
                </div>               
                
            </div>
        <!--</div>-->
    </section>
	
	<div id="error-box2" class="w3-modal">
		<div class="w3-modal-content w3-animate-zoom w3-card-4 w3-round list-pop">
		  <header class="w3-container w3-blue"> 
			<span onclick="document.getElementById('error-box2').style.display='none';" class="w3-button w3-display-topright"><img src="img/close.png" style="margin-bottom:0px;"></span>
			<h3 class="w3-center" id="error-title2">Processing Report</h3> 
		  </header> 
		  <div class="w3-container w3-center">
			<p id="error-message2" class='w3-left-align'><img src='img/refresh.gif' height='50' align='right' />Please wait few seconds...<br>while we process and reconcile report</p>
		  </div>  
		</div>
	  </div>
	  
	  <div id="error-box" class="w3-modal">
		<div class="w3-modal-content w3-animate-zoom w3-card-4 w3-round list-pop">
		  <header class="w3-container w3-blue"> 
			<span onclick="document.getElementById('error-box').style.display='none';" class="w3-button w3-display-topright"><img src="img/close.png" style="margin-bottom:0px;"></span>
			<h3 class="w3-center" id="error-title">Confirm</h3> 
		  </header> 
		  <div class="w3-container w3-center">
			<p id="error-message">Do you want to process report?</p>
		  </div>  
			<div class="w3-container" style="margin-bottom:10px;">
				<div class="w3-bar w3-center">
					<a id="ViewServlet" onclick="update_pass()" class="w3-button w3-green w3-round">Accept &amp; Confirm</a>
					<a id="ButtonFirst" onclick="document.getElementById('error-box').style.display='none';" class="w3-button w3-blue w3-round">OK</a>
					<a id="ButtonSecond" onclick="document.getElementById('error-box').style.display='none';" class="w3-button w3-orange w3-round">Do it later</a>
				</div> 
			</div> 
		</div>
	  </div>
       
    <?php include_once('_footer.php');?>

</body>
</html> 
