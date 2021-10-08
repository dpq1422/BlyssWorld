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
			echo "<script>window.location.href='DashboardServlet?u-".$logged_user_id."=".$dash_unm."';</script>";
		}
//include_once('../zf-remCom.php');
//remove_comm();
	?>
    <!-- https://developers.google.com/chart/interactive/docs/gallery/piechart#fullhtml -->
   
    <section class="boxes wh w3-left<?php if($my_current_plan==6) { echo " display-none"; } ?>">
			<?php
			include_once('../zf-Commission.php');
			calculate_payout($logged_user_id);
			//$unpaid=show_unpaid_comm_non_aff($logged_user_id);
			$unpaid=show_unpaid_comm($logged_user_id);
			//$paid=show_paid_comm_non_aff($logged_user_id);
			$paid=show_paid_comm($logged_user_id);
			$generated=$unpaid+$paid;
			$generated=number_format((float)$generated, 5, '.', '');
			$paid=number_format((float)$paid, 5, '.', '');
			$unpaid=number_format((float)$unpaid, 5, '.', '');
			?>
        
            <div class="w3-row-padding">
                <div class="w3-col m12">
                	<h4 class="heading wh w3-left"><span>MY EARNING</span></h4>
                </div>
            </div>
            <div class="w3-row-padding w3-margin-top">
            	<div class="w3-col m4 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left">
                        	<h3>TOTAL GENERATED COMM.</h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span class="w3-text-blue"><?php echo $generated;?></span>
                        </div>
                    </div>
                </div>
				
            	<div class="w3-col m4 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left">
                        	<h3>TOTAL PAID COMM.</h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span class="w3-text-green"><?php echo $paid;?></span>
                        </div>
                    </div>
                </div>
                
                <div class="w3-col m4 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left">
                        	<h3>TOTAL UNPAID COMM.</h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span class="w3-text-orange"><?php echo $unpaid;?></span>
                        </div>
                    </div>
                </div>
			</div>
       
    </section>
	
    <section class="boxes wh w3-left">
			<?php
			include_once('../zf-DashboardRetailer.php');
			$mt_success=show_mt_success($logged_user_id);
			$mt_in_progress=show_mt_in_progress($logged_user_id);
			$mt_pending_refund=show_mt_pending_refund($logged_user_id);
			$mt_refunded=show_mt_refunded($logged_user_id);
			?>
            <div class="w3-row-padding">
                <div class="w3-col m12">
                	<h4 class="heading wh w3-left"><span>MONEY REMITTANCE</span></h4>
                </div>
            </div>
            <div class="w3-row-padding w3-margin-top">
                
                <div class="w3-col m6 l3 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left">
                        	<h3>SUCCESS</h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span class="w3-text-green"><?php echo $mt_success;?></span>
                        </div>
                    </div>
                </div>      
                
                <div class="w3-col m6 l3 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left">
                        	<h3>INITIATED/IN PROGRESS</h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span class="w3-text-blue"><?php echo $mt_in_progress;?></span>
                        </div>
                    </div>
                </div>  
                
                <div class="w3-col m6 l3 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left">
                        	<h3>PENDING REFUND</h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span class="w3-text-red"><?php echo $mt_pending_refund;?></span>
                        </div>
                    </div>
                </div>  
                
                <div class="w3-col m6 l3 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left">
                        	<h3>REFUNDED</h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span class="w3-text-orange"><?php echo $mt_refunded;?></span>
                        </div>
                    </div>
                </div> 
            </div>
    </section>
    
    <section class="boxes wh w3-left">
			<?php
			$rc_success=show_rc_success($logged_user_id);
			$rc_in_progress=show_rc_in_progress($logged_user_id);
			$rc_pending_refund=show_rc_pending_refund($logged_user_id);
			$rc_refunded=show_rc_refunded($logged_user_id);
			?>
            <div class="w3-row-padding">
                <div class="w3-col m12">
                	<h4 class="heading wh w3-left"><span>RECHARGE</span></h4>
                </div>
            </div>
            <div class="w3-row-padding w3-margin-top">
                
                <div class="w3-col m6 l3 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left">
                        	<h3>SUCCESS</h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span class="w3-text-green"><?php echo $rc_success;?></span>
                        </div>
                    </div>
                </div>      
                
                <div class="w3-col m6 l3 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left">
                        	<h3>INITIATED/IN PROGRESS</h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span class="w3-text-blue"><?php echo $rc_in_progress;?></span>
                        </div>
                    </div>
                </div>  
                
                <div class="w3-col m6 l3 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left">
                        	<h3>PENDING REFUND</h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span class="w3-text-red"><?php echo $rc_pending_refund;?></span>
                        </div>
                    </div>
                </div>  
                
                <div class="w3-col m6 l3 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left">
                        	<h3>REFUNDED</h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span class="w3-text-orange"><?php echo $rc_refunded;?></span>
                        </div>
                    </div>
                </div> 
            </div>
    </section>
	
	<?php if($my_current_plan!=6) { include_once('_DashboardWelcomeMessage.php'); } ?>
       
    <?php include_once('_footer.php');?>

</body>
</html> 
