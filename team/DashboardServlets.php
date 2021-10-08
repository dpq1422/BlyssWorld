	<?php
	include_once('../zf-Commission.php');
	calculate_payout($logged_user_id);
	include_once('../update-level.php');
	update_com_levels();
	//today 86400//month 2592000//quarter 7776000//year 31536000
	$month=date('Y-m');
	$month=$month."-01";
	$year=date('Y');
	$quarter=date('m')-3;
	if($quarter<=0)
		$quarter="$year-01-01";
	if($quarter<=3)
		$quarter="$year-04-01";
	if($quarter<=6)
		$quarter="$year-07-01";
	if($quarter<=9)
		$quarter="$year-10-01";
	$year="2018-04-01";
	$u1_1=show_biz_today($main_team1);
	$u1_30=show_biz($main_team1, $month);
	$u1_90=show_biz($main_team1, $quarter);
	$u1_365=show_biz($main_team1, $year);
	$u2_1=show_biz_today($main_team2);
	$u2_30=show_biz($main_team2, $month);
	$u2_90=show_biz($main_team2, $quarter);
	$u2_365=show_biz($main_team2, $year);
	$u1_target=250000000;//25CR
	$u1_target=number_format((float)$u1_target, 2, '.', '');
	$u1_remain=$u1_target-$u1_365;
	$u1_remain=number_format((float)$u1_remain, 2, '.', '');
	$u2_target=250000000;//25CR
	$u2_target=number_format((float)$u2_target, 2, '.', '');
	$u2_remain=$u2_target-$u2_365;
	$u2_remain=number_format((float)$u2_remain, 2, '.', '');
	$current_month=date('m');
	if($current_month>3)
		$current_month=$current_month-3;
	if($current_month<=3)
		$current_month=$current_month+9;
	$remain_month=12-$current_month;
	$u1_cur_avg=$u1_365/$current_month;
	$u1_cur_avg=number_format((float)$u1_cur_avg, 2, '.', '');
	$u1_rem_avg=$u1_remain/$remain_month;
	$u1_rem_avg=number_format((float)$u1_rem_avg, 2, '.', '');
	$u2_cur_avg=$u2_365/$current_month;
	$u2_cur_avg=number_format((float)$u2_cur_avg, 2, '.', '');
	$u2_rem_avg=$u2_remain/$remain_month;
	$u2_rem_avg=number_format((float)$u2_rem_avg, 2, '.', '');
	
	$u1_per=number_format((float)(($u1_365*100)/$u1_target), 2, '.', '');
	$u2_per=number_format((float)(($u2_365*100)/$u2_target), 2, '.', '');
	?>
	
	<section class="boxes wh w3-left">
            <div class="w3-row-padding">
                <div class="w3-col m12">
                	<h4 class="heading wh w3-left"><span>Targets &amp; Achievements</span></h4>
                </div>
            </div>
            <div class="w3-row-padding w3-margin-top">
            	<div class="w3-col m6">
                	<div class="table-box wh w3-left">
                        <div class="w3-responsive">
                            <table class="w3-table-all">
                                <tr class="table-head">
                                  <th>DESCRIPTION</th>
                                  <th class='w3-right'>AG</th>
                                  <th></th>
                                </tr>
                                <tr>
                                  <td>Business Today</td>
                                  <td class='w3-right'><?php echo $u1_1;?></td>
                                  <td></td>
                                </tr>
                                <tr>
                                  <td>Business This Month</td>
                                  <td class='w3-right'><?php echo $u1_30;?></td>
                                  <td></td>
                                </tr>
                                <tr>
                                  <td>Business This Quarter</td>
                                  <td class='w3-right'><?php echo $u1_90;?></td>
                                  <td></td>
                                </tr>
                                <tr>
                                  <th>Business This Year (<?php echo $u1_per;?>%)</th>
                                  <th class='w3-right'><?php echo $u1_365;?></th>
                                  <td></td>
                                </tr>
                                <tr>
                                  <td>Yearly Target (25 Crore)</td>
                                  <td class='w3-right'><?php echo $u1_target;?></td>
                                  <td></td>
                                </tr>
                                <tr>
                                  <th>Remain Target</th>
                                  <th class='w3-right'><?php echo $u1_remain;?></th>
                                  <td></td>
                                </tr>
                                <?php /*?>
                                <tr>
                                  <td>Current Average Monthly Business</td>
                                  <td class='w3-right'><?php echo $u1_cur_avg;?></td>
                                  <td></td>
                                </tr>
                                <tr>
                                  <th>Required Average Monthly Business</th>
                                  <th class='w3-right'><?php echo $u1_rem_avg;?></th>
                                  <td></td>
                                </tr>
                                <?php */?>
                            </table>	
                        </div>
                    </div>
                </div>
            	<div class="w3-col m6">
                	<div class="table-box wh w3-left">
                        <div class="w3-responsive">
                            <table class="w3-table-all">
                                <tr class="table-head">
                                  <th>DESCRIPTION</th>
                                  <th class='w3-right'>KDK</th>
                                  <th></th>
                                </tr>
                                <tr>
                                  <td>Business Today</td>
                                  <td class='w3-right'><?php echo $u2_1;?></td>
                                  <td></td>
                                </tr>
                                <tr>
                                  <td>Business This Month</td>
                                  <td class='w3-right'><?php echo $u2_30;?></td>
                                  <td></td>
                                </tr>
                                <tr>
                                  <td>Business This Quarter</td>
                                  <td class='w3-right'><?php echo $u2_90;?></td>
                                  <td></td>
                                </tr>
                                <tr>
                                  <th>Business This Year (<?php echo $u2_per;?>%)</th>
                                  <th class='w3-right'><?php echo $u2_365;?></th>
                                  <td></td>
                                </tr>
                                <tr>
                                  <td>Yearly Target (25 Crore)</td>
                                  <td class='w3-right'><?php echo $u2_target;?></td>
                                  <td></td>
                                </tr>
                                <tr>
                                  <th>Remain Target</th>
                                  <th class='w3-right'><?php echo $u2_remain;?></th>
                                  <td></td>
                                </tr>
                                <?php /*?>
                                <tr>
                                  <td>Current Average Monthly Business</td>
                                  <td class='w3-right'><?php echo $u2_cur_avg;?></td>
                                  <td></td>
                                </tr>
                                <tr>
                                  <th>Required Average Monthly Business</th>
                                  <th class='w3-right'><?php echo $u2_rem_avg;?></th>
                                  <td></td>
                                </tr>
                                <?php */?>
                            </table>	
                        </div>
                    </div>
                </div>
			</div>
	</section>
