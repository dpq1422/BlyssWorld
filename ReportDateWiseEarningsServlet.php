<!DOCTYPE html>
<html>
<head>
<?php include_once('_all-inner-pages-html-title.php'); ?>
<script>
function expand(exp_no)
{
	$(".address"+exp_no).slideToggle();
	$(".add"+exp_no).toggleClass("add-show");
}
</script>
<script>
$(document).ready(function(){
	$(".search-data").click(function(){
		$(".table-search-filter").slideToggle();
	});
});
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
						include_once('zf-Earnings.php');
						include_once('zf-Source.php');
						include_once('zf-Client.php');
						/**************************/
						$num_rec_per_page=8;
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
							if($s1!=""){$cond.=" and date(date_time)='$s1' ";}
							if($s2!=""){$cond.=" and source='$s2' ";}
							if($s3!=""){$cond.=" and client_id='$s3' ";}
						}
						$total_records=show_datewise_earning_count($cond);
						$user_result=show_datewise_earning_data($cond, $start_from, $num_rec_per_page);
						$qr="&s1=$s1&s2=$s2&s3=$s3&s4=$s4&search=search";
						$i=0;
						?>
                    	<div class="box-head wh w3-left">
                        	<h3>My EARNING REPORT <span class="w3-right w3-blue w3-center badges"><?php echo $total_records;?></span></h3>
                        </div>
						<div class="table-search-filter wh w3-left">
							<form class="wh w3-left" method="get">
								<ul>
                                    <li>
										<label>Date</label>
                                        <input name="s1" value="<?php echo $s1;?>" type="date" class="w3-input w3-border w3-round">
                                    </li>
                                    <li>
										<label>Source</label>
                                        <select name="s2" class="w3-input w3-border w3-round">
											<option value=''>Select Source</option>
									<?php
									$state_result=show_sources_data(" where 1=1 ");
									while($state_row=mysql_fetch_array($state_result))
									{
									?>
										<option value='<?php echo $state_row['source_id'];?>' <?php if($s2==$state_row['source_id']) echo "selected";?>><?php echo $state_row['source_name'];?></option>
									<?php
									}
									?>
                                        </select>
                                    </li>
                                    <li>
										<label>Client</label>
                                        <select name="s3" class="w3-input w3-border w3-round">
											<option value=''>Select Client</option>
									<?php
									$state_result=show_clients_data(" where client_status=1");
									while($state_row=mysql_fetch_array($state_result))
									{
									?>
										<option value='<?php echo $state_row['client_id'];?>' <?php if($s3==$state_row['client_id']) echo "selected";?>><?php echo $state_row['client_name'];?></option>
									<?php
									}
									?>
                                        </select>
                                    </li>
                                    <li>
										<label>&nbsp;</label>
										<button name='search' value='search' class="w3-button w3-blue w3-round">Search</button>
                                    </li>                                    
                                </ul>
                                
                            </form>
                        </div>
                        <div class="table-div wh w3-left">
                        	<ul>
                            	<li class="table-div-head">
                                    <span>DATE</span>
                                    <span>SOURCE</span>
                                    <span>CLIENT</span>
                                    <span>CR</span>
                                    <span>DR</span>
                                </li>
								<?php
								while($user_row=mysql_fetch_array($user_result))
								{
									$i++;	
								?>
								<li>
                                    <span><?php echo $user_row['dt'];?></span>
                                	<span><?php echo show_source_name($user_row['source']);?></span>
                                	<span><?php echo show_client_name($user_row['cl']);?></span>
                                	<span><?php echo $user_row['cr'];?></span>
                                	<span><?php if($user_row['dr']!=0){echo $user_row['dr'];}?></span>
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
