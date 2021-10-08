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
                                    <li><a href="">Invoice Info</a><img src="img/drop-arrow-r.png" style="margin:0px;">
                                        <ul>
                                            <li><a href="InvoicesServlet">List of Invoices</a></li>
                                            <li><a href="InvoiceServlet">Add New Invoice</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="">User Info</a><img src="img/drop-arrow-r.png" style="margin:0px;">
                                        <ul>
                                            <li><a href="UsersServlet">List of Users</a></li>
                                            <li><a href="UserServlet">Add New User</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="">Source Info</a><img src="img/drop-arrow-r.png" style="margin:0px;">
                                        <ul>
                                            <li><a href="SourcesServlet">List of Source</a></li>
                                            <li><a href="SourceServlet">Add New Source</a></li>
                                        </ul>
                                    </li>
                                    <!--<li><a href="">Branding Login Sliders</a><img src="img/drop-arrow-r.png" style="margin:0px;">
                                        <ul>
                                            <li><a href="BrandingLoginSlidersServlet">List of Login Sliders</a></li>
                                            <li><a href="BrandingLoginSliderServlet">Add New Login Slider</a></li>
                                        </ul>
                                    </li>-->
                                    <li><a href="">Branding Welcome Message</a><img src="img/drop-arrow-r.png" style="margin:0px;">
                                        <ul>
                                            <li><a href="BrandingWelcomeMessagesServlet">List of Welcome Messages</a></li>
                                            <li><a href="BrandingWelcomeMessageServlet">Add New Welcome Message</a></li>
                                        </ul>
                                    </li>
									<li><a href="AdminUpdateMp">Update MP</a></li>
                                </ul>
                            </li>
							<?php
							}
							$pos = strpos($user_department_info, "2");
							if ($pos !== false) 
							{
							?>
                            <li><a href="">Setup <img src="img/drop-arrow.png" class="drop-arrow-icon"></a>
                                <ul>
									<li><a href="LevelsServlet">List of Levels</a></li>
                                    <li><a href="">Service</a><img src="img/drop-arrow-r.png" style="margin:0px;">
                                        <ul>
                                            <li><a href="ServicesServlet">List of Services</a></li>
                                            <li><a href="ServiceServlet">Add New Service</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="">Operator</a><img src="img/drop-arrow-r.png" style="margin:0px;">
                                        <ul>
                                            <li><a href="OperatorsServlet">List of Operators</a></li>
                                            <li><a href="OperatorServlet">Add New Operator</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="">Margin</a><img src="img/drop-arrow-r.png" style="margin:0px;">
                                        <ul>
                                            <li><a href="MarginsServlet">List of Margins</a></li>
                                            <li><a href="MarginServlet">Add New Margin</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
							<?php
							}
							$pos = strpos($user_department_info, "3");
							if ($pos !== false) 
							{
							?>
                            <li><a href="">Client <img src="img/drop-arrow.png" class="drop-arrow-icon"></a>
                                <ul>
                                    <li><a href="ClientsServlet">List of Clients</a></li>
                                    <li><a href="ClientServlet">Add New Client</a></li>
                                </ul>
                            </li>
							<?php
							}
							$pos = strpos($user_department_info, "4");
							if ($pos !== false) 
							{
							?>
                            <li><a href="">Wallet <img src="img/drop-arrow.png" class="drop-arrow-icon"></a>
                                <ul>
                                    <?php if($logged_user_id==5678){?><li><a href="WalletClientStatusServlet">Client Wallet Status</a></li><?php } ?>
                                    <li><a href="WalletClientRequestsReceivedServlet">Wallet Requests Received</a></li>
                                    <?php if($logged_user_id==5678){?><li><a href="WalletClientWithdrawServlet">Withdraw from Client Wallet</a></li><?php } ?>
                                    <li><a href="">Distributed Wallet</a><img src="img/drop-arrow-r.png" style="margin:0px;">
                                        <ul>
											<li><a href="WalletDistributedUpdateServlet">Distributed Wallet Update</a></li>
											<li><a href="WalletDistributedServlet">Distributed Wallet Transactions</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="">Real Time Wallet</a><img src="img/drop-arrow-r.png" style="margin:0px;">
                                        <ul>
											<!--<li><a href="WalletRealTimeSourceOneServlet">RT Wallet - EKO</a></li>
											<li><a href="WalletRealTimeSourceTwoServlet">RT Wallet - AQUA</a></li>
											<li><a href="WalletRealTimeSourceThreeServlet">RT Wallet - Shri4PayoneOnly</a></li>
											<li><a href="WalletRealTimeSourceFourServlet">RT Wallet - RECHARGE</a></li>-->
											<li><a href="WalletRealTimeSourceFiveServlet">RT Wallet - Acharya4Blyss</a></li>
											<li><a href="WalletRealTimeSourceSixServlet">RT Wallet - Rech4Blyss</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="">Queued Transactions</a><img src="img/drop-arrow-r.png" style="margin:0px;">
                                        <ul>
											<!--<li><a href="TxnQueuedServiceDmtServlet">QUE - EKO</a></li>
											<li><a href="TxnQueuedServiceDmtServlet2">QUE - Shri4PayoneOnly</a></li>-->
											<li><a href="TxnQueuedServiceDmtServlet3">QUE - Acharya4Blyss</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
							<?php
							}
							$pos = strpos($user_department_info, "5");
							if ($pos !== false) 
							{
							?>
							<li><a href="">Transaction <img src="img/drop-arrow.png" class="drop-arrow-icon"></a>
                                <ul>
                                    <li><a href="">Domestic Money Transfer</a><img src="img/drop-arrow-r.png" style="margin:0px;">
                                        <ul>
											<li><a href="TxnServiceDmtServlet">All Txns with Search</a></li>
											<li><a href="TxnInProgressServiceDmtServlet">In Progress</a></li>
											<!--<li><a href="TxnRefundPendingServiceDmtServlet">Refund Pending</a></li>-->
											<li><a href="TxnFailedServiceDmtServlet">Failed</a></li>
											<li><a href="TxnRefundedServiceDmtServlet">Refunded</a></li>
											<!--<li><a href="TxnQueuedServiceDmtServlet">QUE - EKO</a></li>
											<li><a href="TxnQueuedServiceDmtServlet2">QUE - Shri4PayoneOnly</a></li>-->
											<li><a href="TxnQueuedServiceDmtServlet3">QUE - Acharya4Blyss</a></li>
											<li><a href="TxnUpdateServiceDmtServlet">UpdateTxn</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="TxnServiceOtherServlet">Prepaid and Bills</a></li>
                                </ul>
                            </li>
							<?php
							}
							$pos = strpos($user_department_info, "6");
							if ($pos !== false) 
							{
							?>
                            <li><a href="">Support <img src="img/drop-arrow.png" class="drop-arrow-icon"></a>
                                <ul>
                                    <li><a href="">Bank</a><img src="img/drop-arrow-r.png" style="margin:0px;">
                                        <ul>
                                            <li><a href="BanksServlet">List of Banks</a></li>
                                            <li><a href="BankServlet">Add New Bank</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="TicketsServlet">List of Tickets</a></li>
                                    <li><a href="CompanyContactViewServlet">Contact Info</a></li>
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
											<li><a href="AuditUnidentifiedWalletRequestsServlets">Unidentified Wallet Requests</a></li>
											<li><a href="AuditUnidentifiedBankTxnsCreditServlets">Unidentified Bank Txns Credit</a></li>
											<li><a href="AuditUnidentifiedBankTxnsDebitServlets">Unidentified Bank Txns Debit</a></li>
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
                                    <li><a href="ReportDateWiseEarningsServlet">My Earnings</a></li>
                                </ul>
                            </li>
							<?php
							}
							?>
                            <li><a href="">My Account <img src="img/drop-arrow.png" class="drop-arrow-icon"></a>
                                <ul>
                                    <li><a href="MyProfileServlet">My Profile</a></li>
                                    <li><a href="MyChangePasswordServlet">Change Password</a></li>
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