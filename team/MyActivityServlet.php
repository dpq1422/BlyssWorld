<!DOCTYPE html>
<html>
<head>
<?php include_once('_all-inner-pages-html-title.php'); ?>
<script type="text/javascript" src="js/admin-validation-functions.js"></script>
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
                        	<h3>My Activity</h3>
                        </div>
                        <form class="wh w3-left">
                        	<div class="w3-row-padding w3-margin-bottom"> 								
                            	<div class="w3-col m6 l12 w3-margin-top">
                                	<p>Here you can see that when (date/time) you visited which page by which ip address ?<br>We are trying to provide you highly secure platform to make your transactions safe and tension-free, So that you can focus on your business growth and goal.</p>	   
                                	<!--<p>If any thing found wrong then you can report to our support team. So that we can take an action about the report.</p>-->
                                </div>        
								
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>User ID</label>	
                                	<input type="text" value="<?php echo $logged_user_id;?>" placeholder="User ID" disabled class="w3-input w3-border w3-round">                                    
                                </div>
                            	                      	
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>User Name</label>
                                	<input type="text" value="<?php echo $logged_user_name;?>" placeholder="User Name" disabled class="w3-input w3-border w3-round">                                    
                                </div>
                                
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>User Type</label>	
                                	<input type="text" value="<?php echo $logged_user_typename;?>" placeholder="User Type" disabled class="w3-input w3-border w3-round">                                    
                                </div>                    
                        	</div>
                        </form>
						<?php
						include_once('../zf-User.php');
						/**************************/
						$num_rec_per_page=50;
						if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
						$start_from = ($page-1) * $num_rec_per_page;
						/**************************/
						$s1=$s2=$s3=$s4=$s5="";
						$cond=" where user_id='$logged_user_id' order by log_id desc ";
						$total_records=show_my_activity_count($cond);
						$user_result=show_my_activity_data($cond, $start_from, $num_rec_per_page);
						$qr="&s1=$s1&s2=$s2&s3=$s3&s4=$s4&s5=$s5&search=search";
						$i=0;
						?>
                        <div class="table-div wh w3-left">
                        	<ul>
                            	<li class="table-div-head">
                                	<span>DATE TIME</span>
                                    <span>IP ADDRESS</span>
                                    <span>PAGE VISITED</span>
                                </li>
								<?php
								while($user_row=mysql_fetch_array($user_result))
								{
									//$mydt=date('Y-m-d', strtotime($user_row['date_time']));
									//$mytm=date('g:i:s', strtotime($user_row['date_time']));
									$myip="";
									$myip=explode("<br>",$user_row['user_ip'])[0];
								?>
                                <li>
                                    <span><?php echo $user_row['date_time'];?></span>
                                    <span><?php echo $myip;?></span>
                                    <span><?php echo $user_row['visited_page'];?></span>
                                </li>
								<?php
								}
								?>
                            </ul>
                        </div>                        
                        
                    </div>
                </div>               
                
            </div>
        <!--</div>-->
    </section>
    
    <section class="wh w3-left w3-center w3-margin-top <?php if($total_records==0) echo "display-none";?>">
    	<div class="w3-row-padding">
        	<div class="w3-col m12">
            	<div class="w3-bar">
                  <a title="Jump to First Page" href='?page=1<?php echo $qr;?>' class='w3-button'><img src='../img/pre-icon.png' style='margin-bottom:0px;'></a>
				<?php
				$total_pages = ceil($total_records / $num_rec_per_page);
				$pager=1;
				$cur_pos=$page;
				if($page-$pager>=2 && $page-$pager<=0)
					$pager=1;
				else
					$pager=$page-2;
				if($pager<0)
					$pager=1;
				
				$pre_pager=$pager-3;
				if($pre_pager>0)
				echo "<a title='Jump to Previous 5 Pages' href='?page=$pre_pager$qr' class='w3-button'><img src='../img/pres-icon.png' style='margin-bottom:0px;'></a>";
				for(;$pager<=$total_pages && $pager<=$page+2;$pager++) 
				{ 
						$selection="";
						if($page==$pager)
							$selection=" w3-green";
						if($pager>0)
						echo "<a href='?page=$pager$qr' class='w3-button $selection'>$pager</a>";
				};
				$post_pager=$pager+2;
				if($post_pager<$total_pages)
				echo "<a title='Jump to Next 5 Pages' href='?page=$post_pager$qr' class='w3-button'><img src='../img/nexts-icon.png' style='margin-bottom:0px;'></a>";
				?>
                  <a title="Jump to Last Page" href='?page=<?php echo $total_pages.$qr;?>' class='w3-button'><img src='../img/next-icon.png' style='margin-bottom:0px;'></a>
                </div>
            </div>
    	</div>
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
