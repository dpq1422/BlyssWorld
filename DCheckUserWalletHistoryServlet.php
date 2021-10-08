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
						include_once('zf-WalletUser.php');
						include_once('zf-User.php');
						$total_records=0;
						/**************************/
						$num_rec_per_page=10;
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
							$total_records=show_wallet_count2($cond);
							$user_result=show_wallet_data2($cond, $start_from, $num_rec_per_page);
						}
						$qr="&s1=$s1&s2=$s2&s3=$s3&s4=$s4&s5=$s5&search=search";
						$i=0;
						?>
                    	<div class="box-head">
                        	<h3>WALLET HISTORY OF INDIVIDUAL USER <span class="w3-right w3-blue w3-center badges"><?php echo $total_records;?></span></h3>
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
                                </ul>
								<ul>
						<?php
						if($total_records>0)
						{
							$user_curbal=show_user_balance($s1);
							$user_cr_dr=show_user_balance_check($s1);
							$user_diff=$user_cr_dr-$user_curbal;
							$user_diff=number_format((float)$user_diff, 2, '.', '');
						?>
                                    <li>
										<label>User Name</label>
                                        <input name="s1" value="<?php echo show_user_name($s1);?>" disabled readonly class="w3-input w3-border w3-round">
                                    </li>
                                    <li>
										<label>User Type</label>
                                        <input name="s1" value="<?php echo show_user_type_name(show_user_type($s1));?>" disabled readonly class="w3-input w3-border w3-round">
                                    </li>
                                    <li>
										<label>Current Balance</label>
                                        <input name="s1" value="<?php echo $user_curbal;?>" disabled readonly class="w3-input w3-border w3-round">
                                    </li>
							<?php
							if($user_diff<0)
							{
							?>
                                    <li>
										<label>All Cr-Dr</label>
                                        <input name="s1" value="<?php echo $user_cr_dr;?>" disabled readonly class="w3-input w3-border w3-round">
                                    </li>
                                    <li>
										<label>Difference</label>
                                        <input name="s1" value="<?php echo $user_diff;?>" disabled readonly class="w3-input w3-border w3-round">
                                    </li>
									
                                </ul>
								<ul>
                                    <li>
										<label>&nbsp;</label>
										<a href="AjaxCheckUpdateUserWallet.php?1=1<?php echo $qr;?>" class="w3-button w3-blue w3-round">Update Balance</a>
                                    </li>  
						<?php
							}
						}
						?>
                                </ul>
                            </form>
                        </div>
                        
                    </div>
                </div>               
                
            </div>
        <!--</div>-->
    </section>
       
    <?php include_once('_footer.php');?>

</body>
</html> 
