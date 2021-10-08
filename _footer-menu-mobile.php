<div class="responsive_menu w3-sidebar w3-animate-left" id="LeftMenu" style="display:none; overflow:inherit;">
    	<div class="res_logo2 wh w3-left">
        	<img src="img/logo.png">
            <a  class="close-icon2 w3-right" onclick="closeNavigationMenu()"><img src="img/close2.png"></a>
        </div> 
        <div class="menu_scroll wh w3-left">
            <div class="wallet2 wh w3-left">
            	<img src="img/wallet-icon2.png"><span><img src="img/doller-icon2.png"><?php echo $dist_bal;?> (DST:WLT)</span>
            </div>
            <div class="wallet2 wh w3-left">
            	<img src="img/wallet-icon2.png"><span><img src="img/doller-icon2.png"><?php echo $rt5;?> (RT:ACH)</span>
            </div>
            <div class="wallet2 wh w3-left">
            	<img src="img/wallet-icon2.png"><span><img src="img/doller-icon2.png"><?php echo $rt6;?> (RT:RCH)</span>
            </div>
            <ul>
            	<li><a href="DashboardServlet">Home</a></li><?php if($logged_user_id==5678){?>
                <li><a>Master <span class="res_arrow"></span></a>
                	<ul>
                    	<li><a href="CompanyInfoViewServlet">Company Info</a></li>
						<li><a>Invoice Info <span class="res_arrow"></span></a>
							<ul>
								<li><a href="InvoicesServlet">List of Invoices</a></li>
								<li><a href="InvoiceServlet">Add New Invoice</a></li>
							</ul>
						</li>
						<li><a>User Info <span class="res_arrow"></span></a>
							<ul>
								<li><a href="UsersServlet">List of Mentor Users</a></li>
								<li><a href="UserServlet">Add New Mentor User</a></li>
							</ul>
						</li>
						<li><a>Source Info <span class="res_arrow"></span></a>
							<ul>
								<li><a href="SourcesServlet">List of Source</a></li>
								<li><a href="SourceServlet">Add New Source</a></li>
							</ul>
						</li>
						<li><a>Branding <span class="res_arrow"></span></a>
							<ul>
								<li><a href="BrandingLoginSlidersServlet">Login Sliders</a></li>
								<li><a href="BrandingWelcomeMessagesServlet">Welcome Message</a></li>
							</ul>
						</li>
						<li><a href="AdminUpdateMp">Update MP</a></li>
                    </ul>
                </li>
                <li><a>Setup <span class="res_arrow"></span></a>
                	<ul>
						<li><a href="LevelsServlet">List of Levels</a></li>
						<li><a>Service <span class="res_arrow"></span></a>
							<ul>
								<li><a href="ServicesServlet">List of Services</a></li>
								<li><a href="ServiceServlet">Add New Service</a></li>
							</ul>
						</li>
						<li><a>Operator <span class="res_arrow"></span></a>
							<ul>
								<li><a href="OperatorsServlet">List of Operators</a></li>
								<li><a href="OperatorServlet">Add New Operator</a></li>
							</ul>
						</li>
						<li><a>Margin <span class="res_arrow"></span></a>
							<ul>
								<li><a href="MarginsServlet">List of Margins</a></li>
								<li><a href="MarginServlet">Add New Margin</a></li>
							</ul>
						</li>
                    </ul>
                </li>
                <li><a>Client <span class="res_arrow"></span></a>
                	<ul>
						<li><a href="ClientsServlet">List of Clients</a></li>									
						<li><a href="ClientServlet">Add New Client</a></li>
                    </ul>
                </li>
                <li><a>Wallet <span class="res_arrow"></span></a>
                	<ul>
                        <?php if($logged_user_id==5674){?><li><a href="WalletClientStatusServlet">Client Wallet Status</a></li><?php } ?>
                        <li><a href="WalletClientRequestsReceivedServlet">Wallet Requests Received</a></li>
                        <?php if($logged_user_id==5674){?><li><a href="WalletClientWithdrawServlet">Withdraw from Client Wallet</a></li><?php } ?>
						<li><a>Distributed Wallet <span class="res_arrow"></span></a>
							<ul>
								<li><a href="WalletDistributedUpdateServlet">Distributed Wallet Update</a></li>
								<li><a href="WalletDistributedServlet">Distributed Wallet Transactions</a></li>
							</ul>
						</li>
						<li><a>Real Time Wallet <span class="res_arrow"></span></a>
							<ul>
								<!--<li><a href="WalletRealTimeSourceOneServlet">RT Wallet - EKO</a></li>
								<li><a href="WalletRealTimeSourceTwoServlet">RT Wallet - AQUA</a></li>
								<li><a href="WalletRealTimeSourceThreeServlet">RT Wallet - Shri4PayoneOnly</a></li>
								<li><a href="WalletRealTimeSourceFourServlet">RT Wallet - RECHARGE</a></li>-->
								<li><a href="WalletRealTimeSourceFiveServlet">RT Wallet - Acharya4Blyss</a></li>
								<li><a href="WalletRealTimeSourceSixServlet">RT Wallet - Rech4Blyss</a></li>
							</ul>
						</li>
                    </ul>
                </li>
                <li><a>Transaction <span class="res_arrow"></span></a>
					<ul>
						<li><a>Domestic Money Transfer <span class="res_arrow"></span></a>
							<ul>
								<li><a href="TxnServiceDmtServlet">All Txns with Search</a></li>
								<li><a href="TxnInProgressServiceDmtServlet">In Progress</a></li>
								<!--<li><a href="TxnRefundPendingServiceDmtServlet">Refund Pending</a></li>-->
								<li><a href="TxnFailedServiceDmtServlet">Failed</a></li>
								<li><a href="TxnRefundedServiceDmtServlet">Refunded</a></li>
								<!--<li><a href="TxnQueuedServiceDmtServlet">QUE - EKO</a></li>
								<li><a href="TxnQueuedServiceDmtServlet2">QUE - Shri4PayoneOnly</a></li>-->
								<li><a href="TxnQueuedServiceDmtServlet3">QUE - Acharya4Blyss</a></li>
							</ul>
						</li>
						<li><a href="TxnServiceOtherServlet">Prepaid and Bills</a></li>
					</ul>
                </li>
                <li><a>Support <span class="res_arrow"></span></a>
                	<ul>
						<li><a>Bank <span class="res_arrow"></span></a>
							<ul>
								<li><a href="BanksServlet">List of Banks</a></li>
								<li><a href="BankServlet">Add New Bank</a></li>
							</ul>
						</li>
						<li><a href="TicketsServlet">List of Tickets</a></li>
						<li><a href="CompanyContactViewServlet">Contact Info</a></li>
                    </ul>
                </li>
				<!--
                <li><a>Audit <span class="res_arrow"></span></a>
                	<ul>
						<li><a href="AuditUploadBankStatementServlet">Upload Bank Statement</a></li>
						<li><a href="AuditShowWalletRequestsServlet">Show Wallet Requests</a></li>
						<li><a href="AuditShowBankTransactionsServlet">Show Bank Transactions</a></li>
						<li><a>Unidentified Records <span class="res_arrow"></span></a>
							<ul>
								<li><a href="AuditUnidentifiedWalletRequestsServlets">Unidentified Wallet Requests</a></li>
								<li><a href="AuditUnidentifiedBankTxnsCreditServlets">Unidentified Bank Txns Credit</a></li>
								<li><a href="AuditUnidentifiedBankTxnsDebitServlets">Unidentified Bank Txns Debit</a></li>
							</ul>
						</li>
                    </ul>
                </li>
				<li><a>Report <span class="res_arrow"></span></a>
					<ul>
						<li><a href="ReportDateWiseTransactionsServlet">Date Wise Transactions</a></li>
						<li><a href="ReportDateWiseEarningsServlet">Date Wise Earnings</a></li>
						<li><a href="ReportServiceWiseTurnoverServlet">Service Wise Turnover</a></li>
						<li><a href="ReportClientWiseTurnoverServlet">Client Wise Turnover</a></li>
					</ul>
				</li>--><?php } ?>
                <li><a>My Account <span class="res_arrow"></span></a>
                	<ul>
						<li><a href="MyProfileServlet">My Profile</a></li>
						<li><a href="MyChangePasswordServlet">Change Password</a></li>
                    </ul>
                </li>
				<li><a href="LogoutServlet">Logout</a></li>
            </ul>             
        </div>  	
    </div>