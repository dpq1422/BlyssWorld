<!DOCTYPE html>
<html>
<head>
<?php include_once('_all-inner-pages-html-title.php'); ?>
<script>
$(document).ready(function(){
	$(".search-data").click(function(){
		$(".table-search-filter").slideToggle();
	});
});

</script>
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
						<?php
						include_once('zf-User.php');
						include_once('zf-Level.php');
						include_once('zf-WalletDistributed.php');
						/**************************/
						$num_rec_per_page=25;
						if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
						$start_from = ($page-1) * $num_rec_per_page;
						/**************************/
						$s1=$s2=$s3=$s4=$s5="";
						$cond=" where 1=1 ";
						if(isset($_REQUEST['search']))
						{
							if(isset($_REQUEST['s1'])) $s1=mysql_real_escape_string($_REQUEST['s1']);
							if(isset($_REQUEST['s2'])) $s2=mysql_real_escape_string($_REQUEST['s2']);
							if(isset($_REQUEST['s3'])) $s3=mysql_real_escape_string($_REQUEST['s3']);
							if(isset($_REQUEST['s4'])) $s4=mysql_real_escape_string($_REQUEST['s4']);
							if(isset($_REQUEST['s5'])) $s5=mysql_real_escape_string($_REQUEST['s5']);
							if($s1!=""){$cond.=" and user_id='$s1' ";}
							if($s2!=""){$cond.=" and user_name like '%$s2%' ";}
							if($s3!=""){$cond.=" and user_type='$s3' ";}
							if($s4!=""){$cond.=" ";}
							if($s5!=""){$cond.=" ";}
						}
						$total_records=show_users_counts($cond);
						$user_result=show_users_datas($cond);
						$qr="&s1=$s1&s2=$s2&s3=$s3&s4=$s4&s5=$s5&search=search";
						$i=0;
						
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
								echo "<script>window.location.href='SmsAllServlet?all=done$qr';</script>";
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
                    	<div class="box-head wh w3-left">
                                <h3 class="wh w3-left">LIST OF USERS <a href="#" class="search-data w3-right w3-green w3-center badges">Search</a> <span class="w3-right w3-blue w3-center badges"><?php echo $total_records;?></span></h3>
                        </div>
						<div class="table-search-filter wh w3-left">
							<form class="wh w3-left" method="get">
								<ul>
                                    <li>
										<label>User ID</label>
                                        <input name="s1" value="<?php echo $s1;?>" type="number" placeholder="User Id" class="w3-input w3-border w3-round">
                                    </li>
                                    <li>
										<label>User Name</label>
                                        <input name="s2" value="<?php echo $s2;?>" type="text" placeholder="User Name" class="w3-input w3-border w3-round">
                                    </li>
                                    <li>
										<label>User Type</label>
                                        <select name="s3" class="w3-input w3-border w3-round">
											<option value=''>Select User</option>
                                            <option value='2' <?php if($s3==2) echo "selected";?>><?php echo show_level_name(2);?></option>
                                            <option value='3' <?php if($s3==3) echo "selected";?>><?php echo show_level_name(3);?></option>
                                            <option value='4' <?php if($s3==4) echo "selected";?>><?php echo show_level_name(4);?></option>
                                            <option value='5' <?php if($s3==5) echo "selected";?>><?php echo show_level_name(5);?></option>
                                            <option value='12' <?php if($s3==12) echo "selected";?>><?php echo show_level_name(12);?></option>
                                        </select>
                                    </li>
                                    <li>
										<label>&nbsp;</label>
										<button name='search' value='search' class="w3-button w3-blue w3-round">Search</button>
                                    </li>                                    
                                </ul>
                            </form>
                        </div>
						<form class="wh w3-left" method="post">
							<div class="table-div wh w3-left">
								<ul>
									<li class="table-div-head">
										<span>Sr.No.</span>
										<span>USER TYPE</span>
										<span>ID</span>
										<span>NAME</span>
										<span>WALLET BALANCE</span>
										<span><input type="checkbox" onclick="all_call_me()" style="height:13px;" name="usernums" id="usernums" value="<?php echo $user_row['user_contact_no'];?>" /> ACTION</span>
									</li>
									<?php
									while($user_row=mysql_fetch_array($user_result))
									{
										$i++;		
										
										$user_type=$user_row['user_type'];
											$user_type=show_level_name($user_type);
											
										$wtl=0;
										$wlt=show_user_balance($user_row['user_id']);
									?>
									<li>
										<span><?php echo $i;?></span>
										<span><?php echo $user_type;?></span>
										<span><?php echo $user_row['user_id'];?></span>
										<span><?php echo $user_row['user_name'];?></span>
										<span><?php echo $wlt;?></span>
										<span><input type="checkbox" style="height:13px;" name="usernum[]" class="usernum" value="<?php echo $user_row['user_contact_no'];?>" /></span>
									</li>
									<?php
									}
									?>
								</ul>
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
