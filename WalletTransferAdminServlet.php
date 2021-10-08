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
						include_once('zf-WalletDistributed.php');
						include_once('zf-User.php');
						/**************************/
						$num_rec_per_page=10;
						if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
						$start_from = ($page-1) * $num_rec_per_page;
						/**************************/
						$s1=$s2=$s3=$s4=$s5="$main_admin";
						$cond=" where user_id=$main_admin ";
						if(isset($_REQUEST['search']))
						{
							if(isset($_REQUEST['s1'])) $s1=mysql_real_escape_string($_REQUEST['s1']);
							//if(isset($_REQUEST['s2'])) $s2=mysql_real_escape_string($_REQUEST['s2']);
							//if(isset($_REQUEST['s3'])) $s3=mysql_real_escape_string($_REQUEST['s3']);
							//if(isset($_REQUEST['s4'])) $s4=mysql_real_escape_string($_REQUEST['s4']);
							//if(isset($_REQUEST['s5'])) $s5=mysql_real_escape_string($_REQUEST['s5']);
							if($s1!=""){$cond.=" and (user_id='$s1' or user_id2='$s1') ";}
							//if($s2!=""){$cond.=" and user_name like '%$s2%' ";}
							//if($s3!=""){$cond.=" and user_type='$s3' ";}
							//if($s4!=""){$cond.=" and user_department_info like '%$s4%' ";}
							//if($s5!=""){$cond.=" and user_status='$s5' ";}
						}
						$total_records=show_distributed_count($cond);
						$user_result=show_distributed_data($cond, $start_from, $num_rec_per_page);
						$qr="&s1=$s1&s2=$s2&s3=$s3&s4=$s4&s5=$s5&search=search";
						$i=0;
						?>
                    	<div class="box-head">
                        	<h3>Wallet Transferred by Admin <span class="w3-right w3-blue w3-center badges"><?php echo $total_records;?></span></h3>
                        </div>
						<div class="table-search-filter wh w3-left">
							<form class="wh w3-left" method="get">
								<ul>
                                    <li>
										<label>User ID</label>
                                        <input name="s1" value="<?php echo $s1;?>" type="number" placeholder="User Id" class="w3-input w3-border w3-round">
                                    </li>
                                    <li>
										<label>&nbsp;</label>
										<button name='search' value='search' class="w3-button w3-blue w3-round">Search</button>
                                    </li>  
						<?php
						if($total_records>0)
						{
						?>
                                    <li>
										<label>User Name</label>
                                        <input name="s1" value="<?php echo show_user_name($s1);?>" disabled readonly class="w3-input w3-border w3-round">
                                    </li>
                                    <li>
										<label>User Type</label>
                                        <input name="s1" value="<?php echo show_user_type_name(show_user_type($s1));?>" disabled readonly class="w3-input w3-border w3-round">
                                    </li>
						<?php
						}
						?>
                                </ul>
                            </form>
                        </div>
                        <div class="table-div wh w3-left">
                        	<ul>
                            	<li class="table-div-head">
                                	<span>ID</span>
                                    <span>DATE TIME</span>
                                    <span>TXN TYPE</span>
                                    <span>USER ID</span>
                                    <span>PRE BAL</span>
                                    <span>CR</span>
                                    <span>DR</span>
                                    <span>POST BAL</span>
                                    <span>ACTION</span>
                                </li>
								<?php
								while($user_row=mysql_fetch_array($user_result))
								{
									$i++;	
									
									$tr_tp=$user_row['transaction_type'];
									if($tr_tp=="0") 
									$tr_tp="Account Opened"; 
									else if($tr_tp=="1") 
									$tr_tp="Wallet Amount Received";
									else if($tr_tp=="2")
									$tr_tp="Wallet Transeferred Manual by Admin"; 
									else if($tr_tp=="3")
									$tr_tp="Wallet Transfer on Request by Admin"; 
									else if($tr_tp=="4")
									$tr_tp="Wallet Transferred by Team"; 
									else if($tr_tp=="5")
									$tr_tp="Wallet Withdraw Manual by Admin";
									else if($tr_tp=="6")
									$tr_tp="Order Generated";
									else if($tr_tp=="7")
									$tr_tp="Failed Order Refunded";
									else if($tr_tp=="8" || $tr_tp=="9")
									$tr_tp="Commission";
									else if($tr_tp=="10" || $tr_tp=="11")
									$tr_tp="Surcharges";
									else if($tr_tp=="12" || $tr_tp=="13")
									$tr_tp="Chargeback";
									else if($tr_tp=="14" || $tr_tp=="15")
									$tr_tp="Other";
									else if($tr_tp=="16")
									$tr_tp="Software Amount";
									else if($tr_tp=="17")
									$tr_tp="Security Amuount";
									else if($tr_tp=="18")
									$tr_tp="Created Commission";
									else if($tr_tp=="21")
									$tr_tp="Distribution Wallet Received";
								
									$to="";
									if($user_row['user_id2']==100000)
										$to="";
									else if($user_row['user_id2']!=0)
										$to=show_user_name($user_row['user_id2'])."<br>(".$user_row['user_id2'].")";
								?>
                                <li>
                                	<span><?php echo $user_row['wallet_id'];?></span>
                                    <span><?php echo $user_row['wallet_date']." ".$user_row['wallet_time'];?></span>
                                    <span><?php echo $tr_tp;?></span>
                                    <span><?php echo $to;?></span>
                                	<span><?php echo $user_row['amount_pre'];?></span>
                                    <span><?php if($user_row['amount_cr']!=0)echo $user_row['amount_cr'];?></span>
                                    <span><?php if($user_row['amount_dr']!=0)echo $user_row['amount_dr'];?></span>
                                    <span><?php echo $user_row['amount_bal'];?></span>
                                    <span><a onclick="expand('<?php echo $i;?>')" class="add-icon add<?php echo $i;?>"></a></span>
                                </li>
                                <li>
                                	<div class="address<?php echo $i;?> inner-add wh w3-left">
                                        <p><strong>TRANSACTION DESCRIPTION:- </strong><?php echo $user_row['transaction_description'];?></p>
                                        <p><strong>TRANSACTION BY:- </strong><?php echo $user_row['remarks'];?></p>
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
