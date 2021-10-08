<div class="header-main wh w3-left w3-white">
        	
            	<div class="w3-row-padding">
                	<div class="w3-col">
                    	<div class="logo w3-left">
                    		<a href="DashboardServlet"><img src="img/logos.png" height="55"></a>
                    	</div>
                        <div class="header-main-right w3-right">
                            <div class="header-main-right-top wh w3-right">
                                <div class="wh w3-right w3-right-align">
                                    <span><a ><img src="img/refresh-icon.png" onclick="window.location.reload();" class="refresh w3-right-align"></a>Real Time : <strong><?php echo $rt_bal;?></strong></span>
                                </div>
                                <div class="wh w3-right w3-right-align">
                                    <span>Admin Wallet : <strong><?php echo $dist_bal;?></strong></span>
                                </div>
                            </div>
                            <div class="header-main-right-bott wh w3-right">
                                <ul class="welcome-txt">
                                    <li>Welcome : <a href="MyProfileServlet"><?php echo $logged_user_name;?> (<?php echo $logged_user_id." - ".$logged_user_typename;?>)</a></li>
									<!--
                                    <li><a href="MyChangePasswordServlet">Change Password</a></li>
                                    <li><a href="LogoutServlet">Logout</a></li>
									-->
                                </ul>
                            </div>
                        </div>
                    
                        <div class="news-main wh w3-left">
                            <div class="news w3-left">
                                <marquee scrolldelay="150"><strong>SERVICES : </strong> We deal in Money Transfer, Prepaid Mobile Recharge, DTH Recharge, Postpaid Mobile Bill Payment, Electricity Bill Payment. <strong>COMING SOON : </strong> AEPS, mPOS, Airline Ticketing, Hotel Reservation, Bus Ticketing, Railway Ticketing.</marquee>
                                <!--<p class="w3-animate-fading"><strong>SERVICES : </strong> We deals in Money Transfer, Prepaid Mobile Recharge, DTH Recharge. <strong>SOON WE WILL LAUNCH : </strong> mPOS, Postpaid Mobile Bill Payment, Electricity Bill Payment, Airline Ticketing, Hotel Reservation, Bus Ticketing, Railway Ticketing, etc.</p>-->
                            </div>
                            <!--<form class="translate w3-right">
                                <select>                            	
                                    <option>English</option>
                                    <option>Hindi</option>
                                </select>
                            </form>-->
                        </div>
                    </div>                    
                </div>
        </div>