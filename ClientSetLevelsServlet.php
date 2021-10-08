<!DOCTYPE html>
<html>
<head>
<?php include_once('_all-inner-pages-html-title.php'); ?> 
<script>
var click=0;
function updateClientLevels()
{
	click++;
	if(click==1)
	$("#UpdateLevels").click();
}
</script>
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
						<?php
						include_once('zf-Level.php');
						include_once('zf-Client.php');
						/**************************/
						$num_rec_per_page=50;
						if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
						$start_from = ($page-1) * $num_rec_per_page;
						/**************************/
						$s1=$s2=$s3=$s4="";
						$cond=" where 1=1 ";
						if(isset($_REQUEST['search']))
						{
							if(isset($_REQUEST['s1'])) $s1=mysql_real_escape_string($_REQUEST['s1']);
							if(isset($_REQUEST['s2'])) $s2=mysql_real_escape_string($_REQUEST['s2']);
							if(isset($_REQUEST['s3'])) $s3=mysql_real_escape_string($_REQUEST['s3']);
							if(isset($_REQUEST['s4'])) $s4=mysql_real_escape_string($_REQUEST['s4']);
							if($s1!=""){$cond.=" and user_id='$s1' ";}
							if($s2!=""){$cond.=" and user_name like '%$s2%' ";}
							if($s3!=""){$cond.=" and user_type='$s3' ";}
							if($s4!=""){$cond.=" and user_status='$s4' ";}
						}
						$total_records=show_levels_count($cond);
						$level_result=show_levels_data($cond, $start_from, $num_rec_per_page);
						$qr="";//"&s1=$s1&s2=$s2&s3=$s3&s4=$s4&search=search";
						$i=0;
						
						$client_id=$_REQUEST['id'];
						$client_name=show_client_name($client_id);
						$client_type=show_client_type($client_id);
						$client_type_id=show_client_type_id($client_id);
						$level_ids=show_client_levels($client_id);
						$level_ids=explode(",",$level_ids);
						
						if(isset($_POST['UpdateLevels']))
						{
							include_once('zc-session-admin.php');
							$filled_client_type=$_POST['filled_client_type'];
							$filled_client=$_POST['filled_client'];
							$filled_levels=implode(",", $_POST['filled_levels']);

							$filled_client_type=mysql_real_escape_string($filled_client_type);
							$filled_client=mysql_real_escape_string($filled_client);
							$filled_levels=mysql_real_escape_string($filled_levels);
							update_client_levels($filled_client_type,$filled_client,$filled_levels,$logged_user_typename,$logged_user_id,$logged_user_name);
							echo "<script>window.location.href='ClientsServlet';</script>";
						}
						?>
                    	<div class="box-head">
                        	<h3>LIST OF LEVELS <span class="w3-right w3-blue w3-center badges"><?php echo $total_records;?></span></h3>
                        </div>
                        <form class="wh w3-left">
                        	<div class="w3-row-padding w3-margin-bottom">  
                            	                      	
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>Client ID</label>	
                                	<input type="text" value="<?php echo $client_id;?>" placeholder="Client ID" class="w3-input w3-border w3-round" disabled>                                    
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>Client Name</label>
                                	<input type="text" value="<?php echo $client_name;?>" placeholder="Client Name" class="w3-input w3-border w3-round" disabled>                                    
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>Client Type</label>
                                	<input type="text" value="<?php echo $client_type;?>" placeholder="Client Type" class="w3-input w3-border w3-round" disabled>                                    
                                </div>
							</div>
						</form>
                        <div class="table-div wh w3-left">
                        	<ul>
								<form class="wh w3-left" method="post">
                            	<li class="table-div-head">
                                	<span>ID</span>
                                    <span>LEVEL TYPE</span>
                                    <span>LEVEL NAME</span>
                                    <span>ACTION</span>
                                </li>
								<?php
								while($level_row=mysql_fetch_array($level_result))
								{
									$i++;			
									
									$level_type=$level_row['level_type'];
									$level_id=$level_row['level_id'];
									if($level_type==1)
										$level_type="<b class='w3-text-white'>Main Admin</b>";
									else if($level_type==2)
										$level_type="Team Member";
									else if($level_type==3)
										$level_type="<b class='w3-text-white'>Retailer</b>";
									else if($level_type==4)
										$level_type="Affiliate Partner";
									
									$level_name=$level_row['level_name'];
									$color="";
									$disabled="";
									if($level_row['level_id']==1 || $level_row['level_id']==12)
									{
										$level_name="<b class='w3-text-white'>$level_name</b>";
										$color="class='w3-green'";
									}
								?>
                                <li <?php echo $color;?>>
                                	<span><?php echo $level_row['level_id'];?></span>
                                    <span><?php echo $level_type;?></span>
                                    <span><?php echo $level_name;?></span>
	<?php
	$flag=0;
	for($aa=0;$aa<count($level_ids);$aa++)
	{
		$pulled_level_id=$level_ids[$aa];
		if($pulled_level_id==$level_id)
		{
			$flag++;
	?>
				<span><input name="filled_levels[]" class="w3-check" checked type="checkbox" value="<?php echo $level_row['level_id'];?>"></span>
	<?php
			break;
		}
	}
	if($flag==0)
	{
		?>
		<span><input name="filled_levels[]" class="w3-check" type="checkbox" value="<?php echo $level_row['level_id'];?>"></span>
	<?php
	}
	?>
                                    
                                </li>
								<?php
								}
								?>
                                <li>
                                	<span></span>
                                    <span></span>
                                    <span></span>
                                    <span>
									<input type="hidden" value="<?php echo $client_id;?>" name="filled_client" />
									<input type="hidden" value="<?php echo $client_type_id;?>" name="filled_client_type" />
									<a class="w3-button w3-round w3-blue" onclick="updateClientLevels()">Update Levels</a>
									<input id="UpdateLevels" name="UpdateLevels" class="display-none" type="submit"/>
									</span>
                                </li>
								</form>
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
                  <a title="Jump to First Page" href='?page=1<?php echo $qr;?>' class='w3-button'><img src='img/pre-icon.png' style='margin-bottom:0px;'></a>
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
				echo "<a title='Jump to Previous 5 Pages' href='?page=$pre_pager$qr' class='w3-button'><img src='img/pres-icon.png' style='margin-bottom:0px;'></a>";
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
				echo "<a title='Jump to Next 5 Pages' href='?page=$post_pager$qr' class='w3-button'><img src='img/nexts-icon.png' style='margin-bottom:0px;'></a>";
				?>
                  <a title="Jump to Last Page" href='?page=<?php echo $total_pages.$qr;?>' class='w3-button'><img src='img/next-icon.png' style='margin-bottom:0px;'></a>
                </div>
            </div>
    	</div>
    </section>
       
    <?php include_once('_footer.php');?>

</body>
</html> 
