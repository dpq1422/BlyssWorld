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
						include_once('zf-Client.php');
						include_once('zf-State.php');
						include_once('zf-Districts.php');
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
							if($s1!=""){$cond.=" and user_id='$s1' ";}
							if($s2!=""){$cond.=" and user_name like '%$s2%' ";}
							if($s3!=""){$cond.=" and user_type='$s3' ";}
							if($s4!=""){$cond.=" and user_status='$s4' ";}
						}
						$total_records=show_clients_count($cond);
						$client_result=show_clients_data($cond, $start_from, $num_rec_per_page);
						$qr="";//"&s1=$s1&s2=$s2&s3=$s3&s4=$s4&search=search";
						$i=0;
						?>
                    	<div class="box-head">
                        	<h3>WALLET STATUS OF CLIENT <span class="w3-right w3-blue w3-center badges"><?php echo $total_records;?></span></h3>
                        </div>
                        <div class="table-div wh w3-left">
                        	<ul>
                            	<li class="table-div-head">
                                	<span>ID</span>
                                	<span>TYPE</span>
                                    <span>NAME</span>
                                    <span>CITY</span>
                                    <span class="w3-right-align">WALLET BALANCE</span>
                                    <span>STATUS</span>
                                    <span>ACTION</span>
                                </li>
								<?php
								while($client_row=mysql_fetch_array($client_result))
								{
									$i++;	
									$client_type=$client_row['client_type'];
									$client_types="";
									if($client_type==3)
										$client_types="<b class='w3-text-green'>API with Fixed Rate</b>";
									else if($client_type==2)
										$client_types="<b class='w3-text-blue'>Portal with Fixed Rate</b>";
									else if($client_type==1)
										$client_types="<b class='w3-text-orange'>Portal with Dynamic Rate</b>";
									$client_status=$client_row['client_status'];
									if($client_status==1)
									{
										$client_status="<b class='w3-text-green'>Active</b>";
									}
									else if($client_status==0)
									{
										$client_status="<b class='w3-text-red'>Blocked</b>";
									}
									$client_id=$client_row['client_id'];
									$clientdb=$bankapi_child.$client_type."_".$client_id;
									$client_row['bal_amt']=update_client_rt_balancessss($clientdb,$client_id);
								?>
                                <li>
                                	<span><?php echo $client_row['client_id'];?></span>
                                	<span><?php echo $client_types;?></span>
                                    <span><?php echo $client_row['client_name'];?></span>
                                    <span><?php echo $client_row['city_name'];?></span>
                                    <span class="w3-right-align"><?php echo $client_row['bal_amt'];?></span></b></span>
                                    <span><?php echo $client_status;?></span>
                                    <span><a onclick="expand('<?php echo $i;?>')" class="add-icon add<?php echo $i;?>"></a></span>
                                </li>
                                <li>
                                	<div class="address<?php echo $i;?> inner-add wh w3-left">
										<p><strong>Contact No:-</strong> <?php echo $client_row['contact_no'];?></p>
										<p><strong>Email:-</strong> <?php echo $client_row['e_mail'];?></p>
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
    
    <section class="wh w3-left w3-center w3-margin-top">
    	<div class="w3-row-padding">
        	<div class="w3-col m12">
            	<div class="w3-bar">
                  <a  class="w3-button"><img src="img/pre-icon.png" style="margin-bottom:0px;"></a>
                  <a  class="w3-button w3-green">1</a>
                  <a  class="w3-button">2</a>
                  <a  class="w3-button">3</a>
                  <a  class="w3-button">4</a>
                  <a  class="w3-button"><img src="img/next-icon.png" style="margin-bottom:0px;"></a>
                </div>
            </div>
    	</div>
    </section> 
       
    <?php include_once('_footer.php');?>

<script>
function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("myTable");
  switching = true;
  //Set the sorting direction to ascending:
  dir = "asc"; 
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.getElementsByTagName("TR");
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /*check if the two rows should switch place,
      based on the direction, asc or desc:*/
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      //Each time a switch is done, increase this count by 1:
      switchcount ++;      
    } else {
      /*If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again.*/
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
</script>

</body>
</html> 
