<!DOCTYPE html>
<html>
<head>
<?php include_once('_all-inner-pages-html-title.php'); ?>
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
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-126322670-12"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-126322670-12');
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
	<?php
	include_once('../zf-Commission.php');
	calculate_payout($logged_user_id);
	if($mytype==2)
	{
		//include_once('DashboardServlets.php');
	}
	?>
   
    <section class="boxes wh w3-left">
			<?php
			calculate_payout($logged_user_id);
			$unpaid=show_unpaid_comm($logged_user_id);
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
			include_once("../zf-DashboardTeam.php");
			$opening_balance=opening_balance($logged_user_id);
			$wallet_update=wallet_update($logged_user_id);
			$wallet_update=number_format((float)$wallet_update, 2, '.', '');
			$wallet_transfer=wallet_transfer($logged_user_id);
			$closing_balance=$opening_balance+$wallet_update-$wallet_transfer;
			$closing_balance=number_format((float)$closing_balance, 2, '.', '');
			?>
        
            <div class="w3-row-padding">
                <div class="w3-col m12">
                	<h4 class="heading wh w3-left"><span>WALLET STATUS</span></h4>
                </div>
            </div>
            <div class="w3-row-padding w3-margin-top">
            	<div class="w3-col m3  wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left">
                        	<h3>OPENING BALANCE</h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span class="w3-text-blue"><?php echo $opening_balance;?></span>
                        </div>
                    </div>
                </div>  
                
                <div class="w3-col m3 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left">
                        	<h3>WALLET UPDATE</h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span class="w3-text-orange"><?php echo $wallet_update;?></span>
                        </div>
                    </div>
                </div>         
                
                <div class="w3-col m3 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left">
                        	<h3>WALLET TRANSFER</h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span class="w3-text-green"><?php echo $wallet_transfer;?></span>
                        </div>
                    </div>
                </div>   
                
                <div class="w3-col m3 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left">
                        	<h3>CURRENT BALANCE</h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span class="w3-text-blue"><?php echo $closing_balance;?></span>
                        </div>
                    </div>
                </div>              
            </div>
    </section>
   
    <section class="boxes wh w3-left">
			<?php
			$member_count=show_member_count($logged_user_id);
			$member_balance=show_member_balance($logged_user_id);
			$retailer_count=show_retailer_count($logged_user_id);
			$retailer_balance=show_retailer_balance($logged_user_id);
			?>
        
            <div class="w3-row-padding">
                <div class="w3-col m12">
                	<h4 class="heading wh w3-left"><span>QUICK STATS</span></h4>
                </div>
            </div>
            <div class="w3-row-padding w3-margin-top">
            	<div class="w3-col m3 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left">
                        	<h3>TOTAL MEMBERS</h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span class="w3-text-green"><?php echo $member_count;?></span>
                        </div>
                    </div>
                </div>  
                
                <div class="w3-col m3 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left">
                        	<h3>MEMBER's BALANCE</h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span class="w3-text-orange"><?php echo $member_balance;?></span>
                        </div>
                    </div>
                </div>      
                
                <div class="w3-col m3 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left">
                        	<h3>TOTAL RETAILERS</h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span class="w3-text-green"><?php echo $retailer_count;?></span>
                        </div>
                    </div>
                </div>          
                
                <div class="w3-col m3 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left">
                        	<h3>RETAILER'S BALANCE</h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span class="w3-text-orange"><?php echo $retailer_balance;?></span>
                        </div>
                    </div>
                </div>  
			</div>
    </section>
	
	<?php include_once('_DashboardWelcomeMessage.php');?>
       
    <?php include_once('_footer.php');?>

</body>
</html> 
