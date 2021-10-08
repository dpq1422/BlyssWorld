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
   
    <section class="boxes wh w3-left">
        
            <div class="w3-row-padding">
                <div class="w3-col m12">
                	<h4 class="heading wh w3-left"><span>TARGETS</span></h4>
                </div>
            </div>
            <div class="w3-row-padding w3-margin-top">
				
            	<div class="w3-col m4 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left">
                        	<h3>TARGETED TXNS</h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span class="w3-text-blue"><?php echo 0;?></span>
                        </div>
                    </div>
                </div>  
				
            	<div class="w3-col m4 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left">
                        	<h3>ARCHIEVED TXNS</h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span class="w3-text-green"><?php echo 0;?></span>
                        </div>
                    </div>
                </div>  
                
                <div class="w3-col m4 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left">
                        	<h3>REMAIN TXNS</h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span class="w3-text-red"><?php echo 0;?></span>
                        </div>
                    </div>
                </div>      
			</div>
			
            <div class="w3-row-padding w3-margin-top">
				
            	<div class="w3-col m4 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left">
                        	<h3>TARGETED JOININGS</h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span class="w3-text-blue"><?php echo 0;?></span>
                        </div>
                    </div>
                </div>  
				
            	<div class="w3-col m4 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left">
                        	<h3>ARCHIEVED JOININGS</h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span class="w3-text-green"><?php echo 0;?></span>
                        </div>
                    </div>
                </div>  
                
                <div class="w3-col m4 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left">
                        	<h3>REMAIN JOINGINS</h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span class="w3-text-red"><?php echo 0;?></span>
                        </div>
                    </div>
                </div>      
			</div>
    </section>
	
	<?php include_once('_DashboardWelcomeMessage.php');?>
       
    <?php include_once('_footer.php');?>

</body>
</html> 
