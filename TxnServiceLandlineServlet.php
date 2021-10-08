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
function recheck(order,txnst,row)
{
	$("#error-message").html($("#error-message").html()+"<br>for <b>order no. : "+order+"</b>");
	$("#error-box").show();
	var loc=document.location.href;
	loc=loc.split("&selectedrow=")[0];
	$.ajax({
		type: "POST",
		url: "AjaxCheckRcStatus4.php",
		data: {'order': order , 'txnst': txnst },
		dataType: "json",
	 
		//if received a response from the server
		success: function( data, textStatus, jqXHR) {
			locs=loc.split("?");
			if(locs.length==1)
				window.location.href=loc+'?1=1&selectedrow='+row;
			else
				window.location.href=loc+'&selectedrow='+row;
		}	 
	});
}
</script>
<script>
$(document).ready(function(){
	var locs=document.location.href;
	locs=locs.split('&selectedrow=');
	if(locs.length!=1)
	{
		expand(locs[1]);
	}
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
						echo "<script>window.location.href='TxnServiceOtherServlet';</script>";
						include_once('zf-TxnService2.php');
						include_once('zf-Client.php');
						include_once('zf-Source.php');
						/**************************/
						$num_rec_per_page=10;
						if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
						$start_from = ($page-1) * $num_rec_per_page;
						/**************************/
						$s1=$s2=$s3=$s4="";
						$cond=" where 1=1 and type in(9) ";
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
						$total_records=show_txn_count($cond);
						$mrc_result=show_txn_data($cond, $start_from, $num_rec_per_page);
						$qr="&s1=$s1&s2=$s2&s3=$s3&s4=$s4&search=search";
						$i=0;
						?>
                    	<div class="box-head">
                        	<h3>TRANSACTIONS - LANDLINE/BROADBAND BILL PAYMENTS <span class="w3-right w3-blue w3-center badges"><?php echo $total_records;?></span></h3>
                        </div>
                        <div class="table-div wh w3-left">
                        	<ul>
                            	<li class="table-div-head">
                                	<span>TID</span>
                                    <span>DATE</span>
                                    <span>TIME</span>
                                    <span>CLIENT ID</span>
                                    <span>ORDER ID</span>
                                    <span>TXN TYPE</span>
                                    <span>PRE BAL</span>
                                    <span>AMOUNT</span>
                                    <span>BALANCE</span>
                                    <span>STATUS</span>
                                    <span>ACTION</span>
                                </li>
								<?php
								while($mrc_row=mysql_fetch_array($mrc_result))
								{
									$i++;	
									
									$mmt_type=$mrc_row['type'];
									if($mmt_type==6)
										$mmt_type="<b class='w3-text-green'>ELECTRICITY</b>";
									else if($mmt_type==7)
										$mmt_type="<b class='w3-text-blue'>WATER</b>";
									else if($mmt_type==8)
										$mmt_type="<b class='w3-text-orange'>GAS</b>";
									else if($mmt_type==9)
										$mmt_type="<b class='w3-text-green'>LANDLINE / BROADBAND</b>";
									else if($mmt_type==10)
										$mmt_type="<b class='w3-text-blue'>DATACARD</b>";
									
									$mmt_status2=$mmt_status=$mrc_row['mrc_status'];
									if($mmt_status==-2)
										$mmt_status="<b class='w3-text-red'>In-Progress(s)</b>";
									else if($mmt_status==-1)
										$mmt_status="<b class='w3-text-red'>In-Progress</b>";
									else if($mmt_status==0)
										$mmt_status="<b class='w3-text-black'>Not Initiated</b>";
									else if($mmt_status==1)
										$mmt_status="<b class='w3-text-blue'>Initiated</b>";
									else if($mmt_status==2)
										$mmt_status="<b class='w3-text-green'>Success</b>";
									else if($mmt_status==3)
										$mmt_status="<b class='w3-text-blue'>Response Awaited</b>";
									else if($mmt_status==4 || $mmt_status==-4)
										$mmt_status="<b class='w3-text-orange'>Refund Pending</b>";
									else if($mmt_status==5)
										$mmt_status="<b class='w3-text-green'>Refunded</b>";
									else
										$mmt_status="<b class='w3-text-red'>Scheduled/Hold</b>";
									
									$response=str_replace(","," , ",$mrc_row['response']);
									
									$recheck="";
									$dt1=strtotime($mrc_row['created_on']);
									$dt2=time();
									$oidcheck=$mrc_row['mrc_id'];
									if($mrc_row['source']==4 && $mmt_status2!=5 && $dt2-$dt1<=864000)
									{
										$oidcheck=$mrc_row['mrc_id'];
										$recheck=" &nbsp;<img title='Re-Check Status of Order $oidcheck' src='img/refresh-icon.png' onclick='recheck(\"$oidcheck\",\"$mmt_status2\",\"$i\")'>";
									}
								?>
                                <li>
                                	<span><?php echo $mrc_row['mrc_id'];?></span>
                                    <span><?php echo explode(" ",$mrc_row['created_on'])[0];?></span>
                                    <span><?php echo explode(" ",$mrc_row['created_on'])[1];?></span>
                                    <span><?php echo show_client_name($mrc_row['client_id']);?></span>
                                    <span><?php echo $mrc_row['order_id'];?></span>
                                    <span><?php echo $mmt_type;?></span>
                                    <span><?php echo $mrc_row['pre_bal'];?></span>
                                    <span><?php echo $mrc_row['deducted_amt'];?></span>
                                    <span><?php echo $mrc_row['post_bal'];?></span>
                                    <span><?php echo $mmt_status.$recheck;?></span>
                                    <span><a onclick="expand('<?php echo $i;?>')" class="add-icon add<?php echo $i;?>"></a></span>
                                </li>
                                <li>
                                	<div class="address<?php echo $i;?> inner-add wh w3-left">
                                        <p><strong>DETAILS:-</strong></p>
										<table width='100%'>
											<tr>
												<th width='15%'>Source:- </th>
												<td width='15%'><?php echo show_source_name($mrc_row['source']);?></td>
												<td width='5%'></td>
												<th width='15%'>Mobile:- </th>
												<td width='15%'><?php echo $mrc_row['mobile_number'];?></td>
												<td width='5%'></td>
												<th width='15%'>Operator:- </th>
												<td width='15%'><?php echo $mrc_row['operator'];?></td>
											</tr>
											<tr>
												<th>Amount:- </th>
												<td><?php echo $mrc_row['amount'];?></td>
												<td></td>
												<th>TID:- </th>
												<td><?php echo $mrc_row['result'];?></td>
												<td></td>
												<th>Ref.No.:- </th>
												<td><?php echo $mrc_row['tid'];?></td>
											</tr>
											<tr><td colspan='8'>&nbsp;</td></tr>
											<tr><td colspan='8'><?php echo $response;?></td></tr>
											<tr><td colspan='8'>&nbsp;</td></tr>
										</table>
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
	
   <div id="error-box" class="w3-modal">
    <div class="w3-modal-content w3-animate-zoom w3-card-4 w3-round list-pop">
      <header class="w3-container w3-blue"> 
        <span onclick="document.getElementById('error-box').style.display='none';" class="w3-button w3-display-topright"><img src="img/close.png" style="margin-bottom:0px;"></span>
        <h3 class="w3-center" id="error-title">Re-Check Transaction Status</h3> 
      </header> 
      <div class="w3-container w3-center">
      	<p id="error-message" class='w3-left-align'><img src='img/refresh.gif' height='50' align='right' />Please wait few seconds...<br>while we re-check transaction status</p>
      </div>  
    </div>
  </div>
       
    <?php include_once('_footer.php');?>

</body>
</html> 
