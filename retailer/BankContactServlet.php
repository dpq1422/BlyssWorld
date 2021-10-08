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
                    	<div class="box-head">
                        	<h3>COMPANY CONTACT INFO (Display)</h3>
                        </div>
						<?php
						include_once('../zf-Company.php');
						$company_result=show_company_info(1);
						$company_row=mysql_fetch_array($company_result);
						?>
                        	<div class="w3-row-padding w3-margin-bottom">    	
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>Company Name</label>	
                                	<input type="text" placeholder="Name" class="w3-input w3-border w3-round" 
									value="<?php echo $company_row['company_name'];?>" disabled>                                    
                                </div>  
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>Mobile</label>
                                	<input type="text" placeholder="Mobile" class="w3-input w3-border w3-round" 
									value="<?php echo $company_row['contact_no'];?>" disabled>                                    
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>Email</label>
                                	<input type="text" placeholder="Email" class="w3-input w3-border w3-round" 
									value="<?php echo $company_row['e_mail'];?>" disabled>                                    
                                </div>        
                        	</div>
                        </form>
                    </div>
				</div>
			</div>
            <div class="w3-row-padding w3-margin-top">
            	<div class="w3-col m12 wow bounceIn">
                	<div class="table-box wh w3-left">
						<?php
						include_once('../zf-Bank.php');
						/**************************/
						$num_rec_per_page=8;
						if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
						$start_from = ($page-1) * $num_rec_per_page;
						/**************************/
						$s1=$s2=$s3=$s4="";
						$cond=" where 1=1 and bank_status=1 ";
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
						$total_records=show_banks_count($cond);
						$bank_result=show_banks_data($cond, $start_from, $num_rec_per_page);
						$qr="";//"&s1=$s1&s2=$s2&s3=$s3&s4=$s4&search=search";
						$i=0;
						?>
                    	<div class="box-head">
                        	<h3>LIST OF BANKS <span class="w3-right w3-blue w3-center badges"><?php echo $total_records;?></span></h3>
                        </div>
                        <div class="table-div wh w3-left">
                        	<ul>
                            	<li class="table-div-head">
                                    <span>ACCOUNT NAME</span>
                                    <span>BANK NAME</span>
                                    <span>ACCOUNT NO.</span>
                                    <span>BRANCH NAME</span>                                    
                                    <span>IFSC CODE</span>
                                </li>
								<?php
								while($bank_row=mysql_fetch_array($bank_result))
								{
									$i++;	
								?>
                                <li>
                                    <span><?php echo $bank_row['account_name'];?></span>
                                    <span><?php echo $bank_row['bank_name'];?></span>
                                    <span><?php echo $bank_row['account_no'];?></span>
                                    <span><?php echo $bank_row['branch_name'];?></span>
                                    <span><?php echo $bank_row['ifsc_code'];?></span>
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
       
    <?php include_once('_footer.php');?>

</body>
</html> 