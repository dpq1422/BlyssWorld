<div class="responsive_menu w3-sidebar w3-animate-left" id="LeftMenu" style="display:none; overflow:inherit;">
    	<div class="res_logo2 wh w3-left">
        	<img src="../img/logos.png">
            <a class="close-icon2 w3-right" onclick="closeNavigationMenu()"><img src="../img/close2.png"></a>
        </div> 
        <div class="menu_scroll wh w3-left">
            <div class="wallet2 wh w3-left">
            	<img src="../img/wallet-icon2.png"><span><img src="../img/doller-icon2.png"><?php echo $wbal;?></span>
            </div>
            <ul>
            	<li><a href="DashboardServlet">Home</a></li>
                <li><a>My Account <span class="res_arrow"></span></a>
                	<ul>
						<li><a href="MyProfileServlet">My Profile</a></li>
						<li><a href="MyChangePasswordServlet">Change Password</a></li>
						<li><a href="MyChangeTpinServlet">Change T-PIN</a></li>
                    </ul>
                </li>
                <li><a>Wallet <span class="res_arrow"></span></a>
                	<ul>
						<li><a href="WalletHistoryUserServlet">My Ledger</a></li>
						<li><a href="WalletSendRequestServlet">Send New Wallet Request</a></li>
						<li><a href="WalletSentRequestsServlet">Payment History</a></li>
                    </ul>
                </li>
				<?php if($my_current_plan!=6) { ?>
                <li><a>Transactions <span class="res_arrow"></span></a>
                	<ul>
						<li><a href="ServiceDmtServlet">Domestic Money Transfer</a></li>
						<li><a>Recharge <span class="res_arrow"></span></a>
							<ul>
								<li><a href="ServiceRcMobServlet">Prepaid Mobile Recharge</a></li>
								<li><a href="ServiceRcDthServlet">DTH Recharge</a></li>
							</ul>
						</li>
						<li><a>Bill Payments <span class="res_arrow"></span></a>
							<ul>
								<li><a href="ServicePostpaidMobServlet">Postpaid Mobile Payment</a></li>
								<?php /* ?><li><a href="ServiceDatacardServlet">Datacard Payment</a></li><?php */ ?>
						<?php
						if($logged_user_id==$testing2 || $logged_user_id==$testing1)
						{
						?>
								<?php /* ?><li><a href="ServiceLandlineServlet">Landline / Broadband Payment</a></li><?php */ ?>
						<?php
						}
						?>
							</ul>
						</li>
						<?php /* ?><li><a>Utility Bills <span class="res_arrow"></span></a>
							<ul>
								<li><a href="ServiceElecServlet">Electricity Payment</a></li>
								<li><a href="ServiceWaterServlet">Water Payment</a></li><?php */ ?>
								<?php /* ?><li><a href="ServiceGasServlet">Gas Payment</a></li>
							</ul>
						</li><?php */ ?>
						<?php /* ?><li><a href="ServiceInsuranceServlet">Insurance Premium Renewals</a></li><?php */ ?>
					</ul>
                </li>
				<?php } ?>
                <li><a>History <span class="res_arrow"></span></a>
                	<ul>
						<li><a href="TxnServiceDmtServlet">Domestic Money Transfer</a></li>
						<li><a href="TxnServiceRcServlet">Prepaid / DTH Recharge</a></li>
						<li><a href="TxnServicePostpaidServlet">Postpaid / Datacard / Landline</a></li>
						<li><a href="TxnServiceUtilityServlet">Electricity / Water / Gas</a></li>
						<li><a href="TxnServiceInsuranceServlet">Insurance Premium Renewals</a></li>
                    </ul>
                </li>
                <li><a>Support <span class="res_arrow"></span></a>
                	<ul>
						<li><a href="BankContactServlet">Bank &amp; Contact Info</a></li>
						<li><a href="TicketsSentServlet">List of Tickets (Sent)</a></li>
						<li><a href="TicketSendNewServlet">Generate New Ticket</a></li>
                    </ul>
                </li>
				<li><a href="LogoutServlet">Logout</a></li>
            </ul>             
        </div>  	
    </div>