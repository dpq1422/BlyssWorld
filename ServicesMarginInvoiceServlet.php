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
						include_once('zf-Service.php');
						include_once('zf-Invoice.php');
						/**************************/
						$num_rec_per_page=25;
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
						$total_records=show_services_count($cond);
						$service_result=show_services_data($cond, $start_from, $num_rec_per_page);
						$qr="";//"&s1=$s1&s2=$s2&s3=$s3&s4=$s4&search=search";
						$i=0;
						?>
                    	<div class="box-head wh w3-left">
                                <h3 class="wh w3-left">LIST OF services <span class="w3-right w3-blue w3-center badges"><?php echo $total_records;?></span></h3>
                        </div>
                        <div class="table-div wh w3-left">
                        	<ul>
                            	<li class="table-div-head">
                                	<span>ID</span>
                                    <span>SERVICE NAME</span>
                                    <span>IS DEFAULT SERVICE</span>
                                    <span>INVOICE PREFIX</span>
                                    <span>INVOICE SIZE</span>
                                    <span>STATUS</span>
                                    <span>ACTION</span>
                                </li>
								<?php
								while($service_row=mysql_fetch_array($service_result))
								{
									$i++;			
									
									$sid=$service_row['service_id'];
									$service_status=$service_row['service_status'];
									$st_link="";
									if($service_status==1)
									{
										$service_status="<b class='w3-text-green'>Active</b>";
									}
									else if($service_status==0)
									{
										$service_status="<b class='w3-text-red'>Blocked</b>";
									}
									if($sid==101)
									{
										$st_link="$st_link<button onclick='location.href=\"ShowServiceMtMarginServlet\";' class='w3-button w3-blue w3-round'>Show Surcharges</button>";
									}
									else if($sid==102)
									{
										$st_link="$st_link<button onclick='location.href=\"ShowServiceRcMarginServlet\";' class='w3-button w3-blue w3-round'>Show Commission</button>";
										//$st_link.="<button onclick='location.href=\"SetServiceRcMarginServlet\";' class='w3-button w3-blue w3-round'>Update Commission for Team</button>";
									}
									else if($sid==103)
									{
										$st_link="$st_link<button onclick='location.href=\"ShowServiceDthMarginServlet\";' class='w3-button w3-blue w3-round'>Show Commission</button>";
										//$st_link.="<button onclick='location.href=\"SetServiceDthMarginServlet\";' class='w3-button w3-blue w3-round'>Update Commission for Team</button>";
									}/*
									else if($sid==105)
									{
										$st_link="$st_link<button onclick='location.href=\"ShowServiceElecMarginServlet\";' class='w3-button w3-blue w3-round'>Show Surcharges</button>
										<button onclick='location.href=\"SetServiceElecMarginServlet\";' class='w3-button w3-blue w3-round'>Update Surcharges</button>";
									}*/
									else if($sid==106)
									{
										$st_link="$st_link<button onclick='location.href=\"ShowServicePostpaidMarginServlet\";' class='w3-button w3-blue w3-round'>Show Commission</button>";
										//$st_link.="<button onclick='location.href=\"SetServicePostpaidMarginServlet\";' class='w3-button w3-blue w3-round'>Update Commission for Team</button>";
									}
									
									//$st_link="$st_link
									//<button class='w3-button w3-blue w3-round'>Update Invoice Format</button>";
									$is_default=$service_row['is_default'];
									if($is_default==1)
									{
										$is_default="<b class='w3-text-green'>Yes</b>";
										/*$st_link="<button class='w3-button w3-orange w3-round'>Remove as Default Service</button>
										$st_link";*/
									}
									else if($is_default==0)
									{
										$is_default="<b class='w3-text-red'>No</b>";
										/*$st_link="<button class='w3-button w3-green w3-round'>Mark as Default Service</button>
										$st_link";*/
									}
									$invoice_result=show_invoices_data(" where service_id='$sid' ");
									$invoice_row=mysql_fetch_array($invoice_result);
								?>
                                <li>
                                	<span><?php echo $service_row['service_id'];?></span>
                                    <span><?php echo $service_row['service_name'];?></span>
                                    <span><?php echo $is_default;?></span>
                                    <span><?php echo $invoice_row['bill_prefix'];?></span>
                                    <span><?php echo $invoice_row['bill_size'];?></span>
                                    <span><?php echo $service_status;?></span>
                                    <span><a onclick="expand('<?php echo $i;?>')" class="add-icon add<?php echo $i;?>"></a></span>
                                </li>
                                <li>
                                	<div class="address<?php echo $i;?> inner-add wh w3-left">
										<!--<p><strong>Invoice Prefix :- </strong><?php echo $invoice_row['bill_prefix'];?></p>
										<p><strong>Invoice Size :- </strong><?php echo $invoice_row['bill_size'];?></p>-->
										<p><strong>Sample invoice will be like :- </strong><?php echo $invoice_row['bill_example'];?></p>
                                        <div class="w3-bar w3-right-align">
                                            <?php echo $st_link;?>
                                        </div>
                                    </div>
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
