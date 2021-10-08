<div class="responsive_menu w3-sidebar w3-animate-left" id="LeftMenu" style="display:none; overflow:inherit;">
    	<div class="res_logo2 wh w3-left">
        	<img src="img/logos.png">
            <a  class="close-icon2 w3-right" onclick="closeNavigationMenu()"><img src="img/close2.png"></a>
        </div> 
        <div class="menu_scroll wh w3-left">
            <div class="wallet2 wh w3-left">
            	<img src="img/wallet-icon2.png"><span><img src="img/doller-icon2.png"><?php echo $rt_bal;?> (RT)</span>
            </div>
            <div class="wallet2 wh w3-left">
            	<img src="img/wallet-icon2.png"><span><img src="img/doller-icon2.png"><?php echo $dist_bal;?> (AW)</span>
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
							<?php
							$pos = strpos($user_department_info, "1");
							if ($pos !== false) 
							{
							?>
                <li><a>Welcome Message <span class="res_arrow"></span></a>
                	<ul>
						<li><a href="BrandingWelcomeMessagesServlet">List of Welcome Messages</a></li>
						<li><a href="BrandingWelcomeMessageServlet">Add New Welcome Message</a></li>
                    </ul>
                </li>
							<?php
							}
							$pos = strpos($user_department_info, "2");
							if ($pos !== false) 
							{
							?>
                <li><a>Team <span class="res_arrow"></span></a>
                	<ul>
						<li><a href="TeamsEmployeesServlet">List of Employee</a></li>
						<li><a href="TeamsRetailersServlet">List of Retailers</a></li>
						<li><a href="KycStatusServlet">KYC Status</a></li>
						<li><a href="BankStatusServlet">Member Bank Status</a></li>
                    </ul>
                </li>
							<?php
							}
							$pos = strpos($user_department_info, "3");
							if ($pos !== false) 
							{
							?>
                <li><a>Wallet <span class="res_arrow"></span></a>
                	<ul>
						<li><a href="WalletStatusServlet">Wallet Status</a></li>
						<li><a href="WalletRequestsReceivedServlet">Wallet Requests Received</a></li>
						<li class="line"><a href="WalletHistoryUserServlet">Wallet History User</a></li>
						<!--<li><a href="WalletTransferAdminAddServlet">Transfer to User Wallet</a></li>-->
						<li><a href="WalletTransferAdminWithdrawServlet">Withdraw from User Wallet</a></li>
						<!--<li class="line"><a href="WalletTransferTeamUserToUserServlet">Wallet Transfer User to User</a></li>-->
						<li><a href="WalletTransferAdminServlet">Wallet Transferred by Admin</a></li>
						<!--<li class="line"><a href="WalletTransferTeamServlet">Wallet Transferred by Team</a></li>-->
						<li><a href="WalletSentRequestsServlet">Wallet Requests Sent</a></li>
						<li><a href="WalletSendRequestServlet">Send New Wallet Request</a></li>
                    </ul>
                </li>
							<?php
							}
							$pos = strpos($user_department_info, "4");
							if ($pos !== false) 
							{
							?>
                <li><a>History <span class="res_arrow"></span></a>
					<ul>
						<li><a>Domestic Money Transfer <span class="res_arrow"></span></a>
							<ul>
								<li><a href="TxnServiceDmtServlet">All Txns with Search</a></li>
								<li><a href="TxnInProgressServiceDmtServlet">In Progress</a></li>
								<li><a href="TxnRefundPendingServiceDmtServlet">Refund Pending</a></li>
								<li><a href="TxnRefundedServiceDmtServlet">Refunded</a></li>
							</ul>
						</li>
						<li><a href="TxnServiceOtherServlet">Prepaid and Bills</a></li>
					</ul>
                </li>
							<?php
							}
							$pos = strpos($user_department_info, "5");
							if ($pos !== false) 
							{
							?>
				<li><a>Support <span class="res_arrow"></span></a>
					<ul>
						<li><a href="BanksServlet">List of Banks</a></li>
						<li><a href="TicketsReceivedServlet">List of Tickets (Received)</a></li>
						<li><a href="CompanyContactViewServlet">Contact Info</a></li>
                    </ul>
                </li>
							<?php
							}
							$pos = strpos($user_department_info, "6");
							if ($pos !== false) 
							{
							?>
				<li><a>Commission <span class="res_arrow"></span></a>
					<ul>
						<li><a href="CommissionTeamUnPaidServlet">Team Commission</a></li>
                    </ul>
                </li>
							<?php
							}
							$pos = strpos($user_department_info, "6");
							if ($pos !== false) 
							{/*
							?>
				<li><a>Audit <span class="res_arrow"></span></a>
					<ul>
						<li><a href="CommissionTeamUnPaidServlet">Team Commission</a></li>
                    </ul>
                </li>
							<?php*/
							}
							$pos = strpos($user_department_info, "8");
							if ($pos !== false) 
							{
							?>
				<li><a>Report <span class="res_arrow"></span></a>
					<ul>
						<li><a href="ReportAllCollectionServlet">Team's Work</a></li>
						<li><a href="ReportAllSonarServlet">Sonar Report</a></li>
						<li><a href="ReportInActivityServlet">In-activity Report</a></li>
                    </ul>
                </li>
							<?php
							}
							?>
				<li><a href="LogoutServlet">Logout</a></li>
            </ul>             
        </div>  	
    </div>