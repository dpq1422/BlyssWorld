<!DOCTYPE html>
<html>
<head>
<?php 
include_once('_all-inner-pages-html-title.php');
//header("location: ServiceDmtServlet");
 ?>
<script>
$(document).ready(function(){
	$("#welcome-message").show();
	
	$(".search-icon").click(function(){
	$(".search-show").toggleClass("s-show");
	});
	
	$(".them").click(function(){
	$(".them ul").toggleClass("them-top");
	});
});
</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-126322670-11"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-126322670-11');
</script>
</head>
<body>

	<?php include_once('_header.php'); ?>

	<?php
		//echo "<meta http-equiv='refresh' content='15'>";
		if(!isset($_REQUEST["u-$logged_user_id"]))
		{
			$dash_unm=explode(" ",$logged_user_name)[0];
			echo "<script>window.location.href='ServicesServlet?u-".$logged_user_id."=".$dash_unm."';</script>";
		}
//include_once('../zf-remCom.php');
//remove_comm();
	?>
    <!-- https://developers.google.com/chart/interactive/docs/gallery/piechart#fullhtml -->
   
    <section class="boxes wh w3-left">
            <div class="w3-row-padding">
                <div class="w3-col m12">
                	<h4 class="heading wh w3-left"><span>ACCOUNT OPENING</span></h4>
                </div>
            </div>
            <div class="w3-row-padding w3-margin-top">
            	<div class="w3-col m4 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left w3-text-white">
                        	<h3>SBI Bank</h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center w3-blue">
                        	<span class="w3-text-white"><a href="#">Open A/C</a></span>
                        </div>
                    </div>
                </div>
				
            	<div class="w3-col m4 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left w3-text-white">
                        	<h3>Axis Bank</h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center w3-pink">
                        	<span class="w3-text-white"><a href="#">Open A/C</a></span>
                        </div>
                    </div>
                </div>
                
                <div class="w3-col m4 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left w3-text-white">
                        	<h3>Kotak Bank</h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center w3-red">
                        	<span class="w3-text-white"><a href="#">Open A/C</a></span>
                        </div>
                    </div>
                </div>
			</div>
       
    </section>
	
    <section class="boxes wh w3-left">
            <div class="w3-row-padding">
                <div class="w3-col m12">
                	<h4 class="heading wh w3-left"><span>M-POS Device</span></h4>
                </div>
            </div>
            <div class="w3-row-padding w3-margin-top">
            	<div class="w3-col m4 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left w3-text-white">
                        	<h3>Apply New M-Pos</h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center w3-grey">
                        	<span class="w3-text-white"><a href="#">Apply Now</a></span>
                        </div>
                    </div>
                </div>
			</div>
       
    </section>
	
    <section class="boxes wh w3-left">
            <div class="w3-row-padding">
                <div class="w3-col m12">
                	<h4 class="heading wh w3-left"><span>Govt. Services</span></h4>
                </div>
            </div>
            <div class="w3-row-padding w3-margin-top">
            	<div class="w3-col m4 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left w3-text-white">
                        	<h3>Udyog Aadhar</h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span class="w3-text-orange"><a href="#">Apply Now</a></span>
                        </div>
                    </div>
                </div>
            	<div class="w3-col m4 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left w3-text-white">
                        	<h3>Passport</h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span class="w3-text-purple"><a href="#">Apply Now</a></span>
                        </div>
                    </div>
                </div>
            	<div class="w3-col m4 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left w3-text-white">
                        	<h3>RTI</h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span class="w3-text-red"><a href="#">Apply Now</a></span>
                        </div>
                    </div>
                </div>
            	<div class="w3-col m4 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left w3-text-white">
                        	<h3>Pan Card</h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span class="w3-text-blue"><a href="#">Apply Now</a></span>
                        </div>
                    </div>
                </div>
            	<div class="w3-col m4 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left w3-text-white">
                        	<h3>Voter Card</h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span class="w3-text-green"><a href="#">Apply Now</a></span>
                        </div>
                    </div>
                </div>
			</div>
       
    </section>
	
    <section class="boxes wh w3-left">
            <div class="w3-row-padding">
                <div class="w3-col m12">
                	<h4 class="heading wh w3-left"><span>New Gas Connection</span></h4>
                </div>
            </div>
            <div class="w3-row-padding w3-margin-top">
            	<div class="w3-col m4 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left w3-text-white">
                        	<h3>Indane Gas</h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span class="w3-text-red"><a href="#">Apply Now</a></span>
                        </div>
                    </div>
                </div>
            	<div class="w3-col m4 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left w3-text-white">
                        	<h3>HP Gas</h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span class="w3-text-green"><a href="#">Apply Now</a></span>
                        </div>
                    </div>
                </div>
            	<div class="w3-col m4 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left w3-text-white">
                        	<h3>Bharat Gas</h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span class="w3-text-orange"><a href="#">Apply Now</a></span>
                        </div>
                    </div>
                </div>
			</div>       
    </section>
	
    <?php include_once('_footer.php');?>

</body>
</html> 
