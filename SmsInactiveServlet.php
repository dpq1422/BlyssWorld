<!DOCTYPE html>
<html>
<head>
<?php include_once('_all-inner-pages-html-title.php'); ?>
<script type="text/javascript" src="js/admin-validation-functions.js"></script>
<script>
function all_call_me()
{
	var user_all=$("#usernums").prop("checked");
	if(user_all)
	{
		$(".usernum").prop('checked', true);
	}
	else
	{
		$(".usernum").prop('checked', false);
	}
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
                    	<div class="box-head">
                        	<h3>IN-ACTIVITY REPORT </h3>
                        </div>
						<?php
						$day=0;
						if(isset($_REQUEST['day']))
						$day=$_REQUEST['day'];
					
						$qr="&day=$day";
						
						if(isset($_POST['send']))
						{
							$usernum=$_POST['usernum'];
							$sms_text=$_POST['sms_text'];
							$usernum=implode(",", $usernum);
							$usernum=mysql_real_escape_string($usernum);
							require('zf-sms.php');
							if(isset($usernum) && $usernum!="")
							{
								zsms($usernum,$sms_text);
								echo "<script>window.location.href='SmsInactiveServlet?all=done$qr';</script>";
							}
							{
								echo "<p class='w3-center'><b class='w3-text-red'>Please select USERS</b></p>";
							}
						}
						if(isset($_REQUEST['all']))
						{
							echo "<p class='w3-center'><b class='w3-text-green'>MESSAGE SENT SUCCESSFULLY</b></p>";
						}
						?>
						<div class="table-search-filter wh w3-left">
							<form class="wh w3-left" method="post">
								<ul>
                                    <li>
										<select name="day" class="w3-input w3-border w3-round">
											<option value='0' <?php if($day==0) echo "selected";?>>Last Active On</option>
											<option value='1' <?php if($day==1) echo "selected";?>>1 to 3 Day ago</option>
											<option value='4' <?php if($day==4) echo "selected";?>>4 to 7 Days ago</option>
											<option value='8' <?php if($day==8) echo "selected";?>>8 to 15 Days ago</option>
											<option value='16' <?php if($day==16) echo "selected";?>>16 to 30 Days ago</option>
											<option value='31' <?php if($day==31) echo "selected";?>>30+ Days ago</option>
										</select>
                                    </li>
                                    <li>
										<button class="w3-button w3-blue w3-round">Show Report</button>
                                    </li>                                    
                                </ul>
                            </form>
                        </div>
						<form class="wh w3-left" method="post">
							<div class="table-search-filter wh w3-left">
								<table class="w3-table-all" id="myTable">
									<tr class="w3-blue">
										<th>SR.NO</th>
										<th>LAST TRANSCTION ON</th>
										<th>USER ID</th>
										<th>NAME</th>
										<th>WALLET BALANCE</th>
										<th><input type="hidden" name="day" value="<?php echo $day;?>"/><input type="checkbox" onclick="all_call_me()" style="height:13px;" name="usernums" id="usernums" value="<?php echo $user_row['user_contact_no'];?>" /> ACTION</th>
									</tr>
								<?php
								if($day!=0)
								{
									include_once('zc-gyan-info-admin.php');
									include_once('zc-commons-admin.php');
									include_once('zf-User.php');
									include_once('zf-WalletDistributed.php');
									include_once('zf-Level.php');
									
									//////////////////////////////
									$interval=86400;
									$val=$interval*$day;
									$val=19800-$val;
									$query1="SELECT user_id, date(max(created_on)) last_active_time FROM $bankapi_child_txn.txn_mt_child GROUP BY user_id having last_active_time<=date(DATE_ADD(sysdate(), INTERVAL ($val) SECOND)) ORDER BY max( created_on ) DESC";
									
									$val2=0;
									if($day==1)
										$val2=19800-($interval*3);
									if($day==4)
										$val2=19800-($interval*7);
									if($day==8)
										$val2=19800-($interval*15);
									if($day==16)
										$val2=19800-($interval*30);
									
									if($val2!=0)
									$query1="SELECT user_id, date(max(created_on)) last_active_time FROM $bankapi_child_txn.txn_mt_child GROUP BY user_id having last_active_time<=date(DATE_ADD(sysdate(), INTERVAL ($val) SECOND)) and last_active_time>=date(DATE_ADD(sysdate(), INTERVAL ($val2) SECOND)) ORDER BY max( created_on ) DESC";
									
									$result1=mysql_query($query1);
									//////////////////////////////
									$i=0;
									while($rs1=mysql_fetch_array($result1))
	{
									$i++;
									$user_id="";
									$last_active_time="";
									$user_id=$rs1['user_id'];
									$last_active_time=$rs1['last_active_time'];	
										$rowval="";
										if($i%2==1)
											$rowval="class='w3-light-grey'";
										
									$user_num=mysql_fetch_array(show_user_profile($user_id))['user_contact_no'];
								?>
									<tr <?php echo $rowval;?>>
										<td><?php echo $i;?></td>
										<td><?php echo $last_active_time;?></td>
										<td><?php echo $user_id;?></td>
										<td><?php echo show_user_name($user_id);?></td>
										<td><?php echo show_user_balance($user_id);?></td>
										<td><input type="checkbox" style="height:13px;" name="usernum[]" class="usernum" value="<?php echo $user_num;?>" /></td>
									</tr>
								<?php
									}
								}
								?>
								</table>
							</div>
							<div class="table-search-filter wh w3-left">
								<ul>
									<li>
										<label>Message</label>
										<textarea style="height:250px;width:600px;" name="sms_text" type="number" placeholder="Text Message To Send" required class="w3-input w3-border w3-round"></textarea>
									</li>
									<li style="margin-left:450px;margin-top:210px;">
										<label>&nbsp;</label>
										<button name='send' value='send' class="w3-button w3-blue w3-round">Send</button>
									</li>                                    
								</ul>
							</div>
						</form>
                    </div>
                </div>               
                
            </div>
        <!--</div>-->
    </section>
       
    <?php include_once('_footer.php');?>

</body>
</html> 
