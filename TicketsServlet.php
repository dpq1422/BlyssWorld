<!DOCTYPE html>
<html>
<head>
<?php include_once('_all-inner-pages-html-title.php'); ?>
<script>
function abcd(row_no)
{
	var req=$("#req"+row_no).val();
	var status=$("#status"+row_no).val();
	var remarks=$("#remarks"+row_no).val();
	//alert(status);
	$.ajax({
		type: "POST",
		url: "AjaxTicketUpdateServlet",
		data: {'req': req , 'status': status , 'remarks': remarks },
		dataType: "json",
	 
		//if received a response from the server
		success: function( data, textStatus, jqXHR) {
			//our country code was correct so we have some information to display/
			window.location.reload();
			//window.location.href='TicketsServlet';
		}	
	});
}
</script>
<script>
function expand(exp_no)
{
	$(".address"+exp_no).slideToggle();
	$(".add"+exp_no).toggleClass("add-show");
}
</script>
<script>
/*
$(document).ready(function(){
	$(".search-data").click(function(){
		$(".table-search-filter").slideToggle();
	});
});
*/
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
						include_once('zf-Ticket.php');
						include_once('zf-Client.php');
						/**************************/
						$num_rec_per_page=10;
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
						$total_records=show_tickets_count($cond);
						$user_result=show_tickets_data($cond, $start_from, $num_rec_per_page);
						$qr="&s1=$s1&s2=$s2&s3=$s3&s4=$s4&search=search";
						$i=0;
						?>
                    	<div class="box-head">
                        	<h3>LIST OF TICKETS RECEIVED FROM CLIENTS <span class="w3-right w3-blue w3-center badges"><?php echo $total_records;?></span></h3>
                        </div>
                        <div class="table-div wh w3-left">
                        	<ul>
                            	<li class="table-div-head">
                                	<span>ID</span>
                                    <span>DATE TIME</span>
                                    <span>CLIENT ID</span>
                                    <span>SUBJECT</span>
                                    <span>LAST UPDATED ON</span>
                                    <span>STATUS</span>
                                    <span>ACTION</span>
                                </li>
								<?php
								while($user_row=mysql_fetch_array($user_result))
								{
									$i++;	
									$ticket_status=$user_row['ticket_status'];
									$ticket_type=$user_row['ticket_type'];
									$st_link="";
									if($ticket_status==1)
									{
										$ticket_status="<b class='w3-text-orange'>Opened</b>";
										$st_link="<input type='hidden' id='req$i' value='".$user_row['ticket_id']."' />
										<select class='w3-select w3-border w3-round' required id='status$i'>
											<option value=''>Choose your option</option>
											<option value='2'>In-Progress</option>
											<option value='4'>Closed</option>
										</select><br><br><br><input type='text' placeholder='REMARKS' class='w3-input w3-border w3-round' required id='remarks$i' /><br>
										<button id='updt$i' onclick=\"abcd($i)\" class=\"w3-button w3-blue w3-round\">Update Request</button>";
									}
									else if($ticket_status==2)
									{
										$ticket_status="<b class='w3-text-blue'>In-Progress</b>";
										$st_link="<input type='hidden' id='req$i' value='".$user_row['ticket_id']."' />
										<select class='w3-select w3-border w3-round' required id='status$i'>
											<option value=''>Choose your option</option>
											<option value='2'>In-Progress</option>
											<option value='4'>Closed</option>
										</select><br><br><br><input type='text' placeholder='REMARKS' class='w3-input w3-border w3-round' required id='remarks$i' /><br>
										<button id='updt$i' onclick=\"abcd($i)\" class=\"w3-button w3-blue w3-round\">Update Request</button>";
									}
									else if($ticket_status==3)
									{
										$ticket_status="<b class='w3-text-red'>Re-Opened</b>";
										$st_link="<input type='hidden' id='req$i' value='".$user_row['ticket_id']."' />
										<select class='w3-select w3-border w3-round' required id='status$i'>
											<option value=''>Choose your option</option>
											<option value='2'>In-Progress</option>
											<option value='4'>Closed</option>
										</select><br><br><br><input type='text' placeholder='REMARKS' class='w3-input w3-border w3-round' required id='remarks$i' /><br>
										<button id='updt$i' onclick=\"abcd($i)\" class=\"w3-button w3-blue w3-round\">Update Request</button>";
									}
									else if($ticket_status==4)
									{
										$ticket_status="<b class='w3-text-green'>Closed</b>";
									}
									
									if($ticket_type==1)
									{
										$ticket_type="Money Transfer Dispute";
									}
									else if($ticket_type==2)
									{
										$ticket_type="Technical Support";
									}
									else if($ticket_type==3)
									{
										$ticket_type="Sales Enquiry";
									}
									else if($ticket_type==4)
									{
										$ticket_type="Billing Enquiry";
									}
									else if($ticket_type==5)
									{
										$ticket_type="Commission Issue";
									}
								?>
                                <li>
                                	<span><?php echo $user_row['ticket_id'];?></span>
                                	<span><?php echo $user_row['date_time'];?></span>
                                	<span><?php echo show_client_name($user_row['client_id']);?></span>
                                    <span><?php echo $ticket_type;?></span>
                                    <span><?php echo $user_row['admin_updates'];?></span>
                                    <span><?php echo $ticket_status;?></span>
                                    <span><a onclick="expand('<?php echo $i;?>')" class="add-icon add<?php echo $i;?>"></a></span>
                                </li>
                                <li>
                                	<div class="address<?php echo $i;?> inner-add wh w3-left">
										<table class="wh">
											<tr>
												<td width="35%"valign="top">
													<p><strong>REQUEST DATE & TIME:-</strong> <?php echo $user_row['request_date'];?> at <?php echo $user_row['request_time'];?></p>
													<p><strong>CLIENT REMARKS:-</strong> <?php echo $user_row['client_remarks'];?></p>
													<p><strong>CLIENT TIME:-</strong> <?php echo $user_row['client_updates'];?></p>
												</td>
												<td width="35%" valign="top">
													<p>&nbsp;</p>
													<p><strong>SYSTEM REMARKS:-</strong> <?php echo $user_row['admin_remarks'];?></p>
													<p><strong>SYSTEM TIME:-</strong> <?php echo $user_row['admin_updates'];?></p>
												</td>
												<td class="w3-text-right" width="30%"valign="top">
													
													<?php echo $st_link;?>
													
												</td>
											</tr>
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
       
    <?php include_once('_footer.php');?>

</body>
</html> 
