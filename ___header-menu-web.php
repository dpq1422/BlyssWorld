        <div class="menu-bar wh">
				
            	<div class="w3-row-padding">
                	<div class="w3-col">
                    	<ul class="menu">
                            <li><a href="DashboardServlet"><img src="img/home-icon.png"></a></li>
							<?php
							$pos = strpos($user_department_info, "1");
							if ($pos !== false) 
							{
							?>
                            <li><a href="">Master <img src="img/drop-arrow.png" class="drop-arrow-icon"></a>
                                <ul>
                                    <li><a href="CompanyInfoViewServlet">Company Info</a></li>
									<li><a href="LevelsServlet">List of Levels</a></li>
                                    <li><a href="">User Info</a><img src="img/drop-arrow-r.png" style="margin:0px;">
                                        <ul>
                                            <li><a href="UsersServlet">List of Users</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="ServicesMarginInvoiceServlet">Service / Margin / Invoice</a></li>
                                    <!--<li><a href="">Login Sliders</a><img src="img/drop-arrow-r.png" style="margin:0px;">
                                        <ul>
                                            <li><a href="BrandingLoginSlidersServlet">List of Login Sliders</a></li>
                                            <li><a href="BrandingLoginSliderServlet">Add New Login Slider</a></li>
                                        </ul>
                                    </li>-->
                                    <li><a href="">Welcome Message</a><img src="img/drop-arrow-r.png" style="margin:0px;">
                                        <ul>
                                            <li><a href="BrandingWelcomeMessagesServlet">List of Welcome Messages</a></li>
                                            <li><a href="BrandingWelcomeMessageServlet">Add New Welcome Message</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
							<?php
							}
							$pos = strpos($user_department_info, "2");
							if ($pos !== false) 
							{
							?>
                            <li><a href="">Team <img src="img/drop-arrow.png" class="drop-arrow-icon"></a>
                                <ul>
                                    <li><a href="TeamsMembersServlet">List of Members</a></li>
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
                            <li><a href="">Wallet <img src="img/drop-arrow.png" class="drop-arrow-icon"></a>
                                <ul>
                                    <li><a href="WalletStatusServlet">Wallet Status</a></li>
                                    <li><a href="WalletRequestsReceivedServlet">Wallet Requests Received</a></li>
                                    <li><a href="WalletHistoryUserServlet">Wallet History User</a></li>
                                    <li class="line"><a href="">Wallet Transfer</a><img src="img/drop-arrow-r.png" style="margin:0px;">
                                        <ul>
											<?php
											if($logged_user_id==$sub_admin2)
											{
											?>
											<li><a href="WalletTransferAdminAddServlet">Transfer to User Wallet</a></li>
											<li><a href="WalletTransferAdminWithdrawServlet">Withdraw from User Wallet</a></li>
											<?php
											}
											?>
											<li><a href="WalletTransferAdminServlet">Wallet Transferred by Admin</a></li>
											<li><a href="WalletTransferTeamServlet">Wallet Transferred by Team</a></li>
											<li class="line"><a href="WalletTransferTeamUserToUserServlet">Wallet Transfer User to User</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="">Wallet Request (Sent)</a><img src="img/drop-arrow-r.png" style="margin:0px;">
                                        <ul>
											<li><a href="WalletSentRequestsServlet">Wallet Requests Sent</a></li>
											<li><a href="WalletSendRequestServlet">Send New Wallet Request</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
							<?php
							}
							$pos = strpos($user_department_info, "4");
							if ($pos !== false) 
							{
							?>
                            <li><a href="">Transaction <img src="img/drop-arrow.png" class="drop-arrow-icon"></a>
                                <ul>
                                    <li><a href="">Domestic Money Transfer</a><img src="img/drop-arrow-r.png" style="margin:0px;">
                                        <ul>
											<li><a href="TxnServiceDmtServlet">All Txns with Search</a></li>
											<li><a href="TxnInProgressServiceDmtServlet">In Progress</a></li>
											<li><a href="TxnRefundPendingServiceDmtServlet">Refund Pending</a></li>
											<li><a href="TxnRefundedServiceDmtServlet">Refunded</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="">Recharge</a><img src="img/drop-arrow-r.png" style="margin:0px;">
                                        <ul>
											<li><a href="TxnServiceRcServlet">Prepaid Mobile Recharge</a></li>
											<li><a href="TxnServiceDthServlet">DTH Recharge</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="">Bill Payments</a><img src="img/drop-arrow-r.png" style="margin:0px;">
                                        <ul>
											<li><a href="TxnServicePostpaidServlet">PostPaid Mobile Payment</a></li>
											<li><a href="TxnServiceLandlineServlet">Landline / Broadband Payment</a></li>
											<li><a href="TxnServiceDatacardServlet">Datacard Payment</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="">Utility Bills</a><img src="img/drop-arrow-r.png" style="margin:0px;">
                                        <ul>
											<li><a href="TxnServiceElecServlet">Electricity Payment</a></li>
											<li><a href="TxnServiceWaterServlet">Water Payment</a></li>
											<li><a href="TxnServiceGasServlet">Gas Payment</a></li>
                                        </ul>
                                    </li>
									<li><a href="TxnServiceInsuranceServlet">Insurance Premium Payments</a></li>
                                </ul>
                            </li>
							<?php
							}
							$pos = strpos($user_department_info, "5");
							if ($pos !== false) 
							{
							?>
                            <li><a href="">Support <img src="img/drop-arrow.png" class="drop-arrow-icon"></a>
                                <ul>
                                    <li><a href="">Bank</a><img src="img/drop-arrow-r.png" style="margin:0px;">
                                        <ul>
                                            <li><a href="BanksServlet">List of Banks</a></li>
											<?php
											if($logged_user_id==$main_admin)
											{
											?>
                                            <!--<li><a href="BankServlet">Add New Bank</a></li>-->
											<?php
											}
											?>
                                        </ul>
                                    </li>
                                    <li><a href="TicketsReceivedServlet">List of Tickets (Received)</a></li>
											<?php
											if($logged_user_id==$main_admin)
											{
											?>
                                    <li><a href="CompanyContactViewServlet">Contact Info</a></li>
											<?php
											}
											?>
									<!--
                                    <li><a href="ProviderContactBankInfoServlet">Provider Info</a></li>
                                    <li><a href="TicketsSentServlet">List of Tickets (Sent to provider)</a></li>
                                    <li><a href="TicketSendNewServlet">Generate Ticket (to provider)</a></li>-->
                                </ul>
                            </li>
							<?php
							}
							$pos = strpos($user_department_info, "6");
							if ($pos !== false) 
							{
							?>
                            <li><a href="">Commission <img src="img/drop-arrow.png" class="drop-arrow-icon"></a>
                                <ul>
                                    <li><a href="CommissionTeamUnPaidServlet">Team Commission</a></li>
                                </ul>
                            </li>
							<?php
							}
							$pos = strpos($user_department_info, "7");
							if ($pos !== false) 
							{
							?>
                            <!--<li><a href="">Audit <img src="img/drop-arrow.png" class="drop-arrow-icon"></a>
                                <ul>
                                    <li><a href="AuditUploadBankStatementServlet">Upload Bank Statement</a></li>
                                    <li><a href="AuditShowWalletRequestsServlet">Show Wallet Requests</a></li>
                                    <li><a href="AuditShowBankTransactionsServlet">Show Bank Transactions</a></li>
                                    <li><a href="">Unidentified Records</a><img src="img/drop-arrow-r.png" style="margin:0px;">
                                        <ul>
											<li><a href="AuditUnidentifiedWalletRequestsServlet">Unidentified Wallet Requests</a></li>
											<li><a href="AuditUnidentifiedBankTxnsCreditServlet">Unidentified Bank Txns Credit</a></li>
											<li><a href="AuditUnidentifiedBankTxnsDebitServlet">Unidentified Bank Txns Debit</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>-->
							<?php
							}
							$pos = strpos($user_department_info, "8");
							if ($pos !== false) 
							{
							?>
                            <li><a href="">Report <img src="img/drop-arrow.png" class="drop-arrow-icon"></a>
                                <ul>
                                    <li><a href="ReportAllCollectionServlet">Team's Work</a></li>
                                    <li><a href="ReportAllSonarServlet">Sonar Report</a></li>
                                    <li><a href="ReportInActivityServlet">In-activity Report</a></li>
									<?php
									if($logged_user_id==$sub_admin2)
									{
									?>
									<li><a href="SmsAllServlet">SMS to All</a></li>
									<li><a href="SmsInactiveServlet">SMS to Inactive</a></li>
									<?php
									}
									?>
                                </ul>
                            </li>
							<?php
							}
							?>
                            <li><a href="">My Account <img src="img/drop-arrow.png" class="drop-arrow-icon"></a>
                                <ul>
                                    <li><a href="MyProfileServlet">My Profile</a></li>
                                    <li><a href="MyChangePasswordServlet">Change Password</a></li>
                                    <li><a href="MyChangeTpinServlet">Change T-PIN</a></li>
                                </ul>
                            </li>
                            <li><a href="LogoutServlet">Logout</a></li>
                    	</ul>
						<!--
                        <form class="search-main w3-right">
                            <a href="#"><img src="img/search-icon.png" class="search-icon"></a>
                            <div class="search-show">
                            	<input type="text" placeholder="Order by TxnId">
                            </div>
                        </form>
						-->
                    </div>
                </div>
            </div>