        <div class="menu-bar wh">
        	
            	<div class="w3-row-padding">
                	<div class="w3-col">
                    	<ul class="menu">
                            <li><a href="DashboardServlet"><img src="../img/home-icon.png"></a></li>
                            <li><a href="">My Account <img src="../img/drop-arrow.png" class="drop-arrow-icon"></a>
                                <ul>
                                    <li><a href="MyProfileServlet">My Profile</a></li>
                                    <li><a href="MyChangePasswordServlet">Change Password</a></li>
                                    <li><a href="MyChangeTpinServlet">Change T-PIN</a></li>
									<!--<li><a href="MyActivityServlet">My Activity</a></li>-->
                                    <li><a href="MyMarginServlet">My Margin</a></li>
									<?php
									if($kinf==0 || $kinf==-4)
									{
										echo '<li><a href="KycUpload">Update KYC</a></li>';
									}
									if($binf==0 || $binf==-4)
									{
										//echo '<li><a href="BankUpdate">Update Bank Details</a></li>';
									}
									?>
                                </ul>
                            </li>
                            <li><a href="">Wallet <img src="../img/drop-arrow.png" class="drop-arrow-icon"></a>
                                <ul>
                                    <li class='line'><a href="WalletHistoryUserServlet">My Ledger</a></li>
									<li><a href="WalletSendRequestServlet">Wallet Request to Company</a></li>
                                    <li class='line'><a href="WalletSentRequestsServlet">Payment History</a></li>
									<?php if($its_my_parent!=0) { ?>
									<li><a href="WalletSendRequestTeamServlet">Wallet Request to Distributor</a></li>
                                    <li><a href="WalletSentRequestsTeamServlet">Wallet History</a></li>
									<?php } ?>
                                </ul>
                            </li>
                            <li><a href="">Transaction <img src="../img/drop-arrow.png" class="drop-arrow-icon"></a>
                                <ul>
									<li><a href="ServiceDmtServlet">Domestic Money Transfer</a></li>
									<li><a href="">Recharge</a><img src="../img/drop-arrow-r.png" style="margin:0px;">
										<ul>
											<li><a href="ServiceRcMobServlet">Prepaid Mobile Recharge</a></li>
											<li><a href="ServiceRcDthServlet">DTH Recharge</a></li>
										</ul>
									</li>
									<li><a href="">Bill Payment</a><img src="../img/drop-arrow-r.png" style="margin:0px;">
										<ul>
											<li><a href="ServicePostpaidMobServlet">Postpaid Mobile Payment</a></li>
											<?php /* ?><li><a href="ServiceElecServlet">Electricity Bill Payment</a></li><?php */ ?>
									<?php
									if($logged_user_id==$testing2 || $logged_user_id==$testing1)
									{
									?>
											<li><a href="ServiceLandlineServlet">Landline / Broadband Payment</a></li>
									<?php
									}
									?>
										</ul>
									</li>
                                </ul>
                            </li>
                            <li><a href="">Services <img src="../img/new.gif" /> <img src="../img/drop-arrow.png" class="drop-arrow-icon"></a>
                                <ul>
                                    <li><a href="">Donation</a><img src="../img/drop-arrow-r.png" style="margin:0px;">
                                        <ul>
											<li><a href="https://bharatkeveer.gov.in/" target="_blank">Bharat Ke Veer (Govt Site)</a></li>
                                        </ul>                                    </li>
                                    <li><a href="">Insurance</a><img src="../img/drop-arrow-r.png" style="margin:0px;">
                                        <ul>
											<li><a href="InsuranceServlet">Buy Now</a></li>
                                        </ul>                                    </li>
                                    <li><a href="">Account Opening</a><img src="../img/drop-arrow-r.png" style="margin:0px;">
                                        <ul>
											<li><a href="https://oaa.onlinesbi.com/sao/onlineaccapp.htm" target="_blank">SBI Bank</a></li>
											<li><a href="https://digital.axisbank.co.in/AxisDigitalBanking/html_pages/main.html" target="_blank">Axis Bank</a></li>
											<li><a href="https://savingsaccount.icicibank.com/SBAOF/new.jsp" target="_blank">ICICI Bank</a></li>
											<li><a href="https://www.yesbank.in/open-an-account" target="_blank">YES Bank</a></li>
											<li><a href="https://www.centralbank.net.in/servlet/ibs.onlineAccountOpening.servlets.IBSOnlineACOpeningServlet?HandleID=NewUser" target="_blank">Central Bank</a></li>
											<li><a href="https://www.pnbnet.org.in/OOSA/CustomerEntry.jsp" target="_blank">Punjab National Bank</a></li>
											<li><a href="https://www.idfcbank.com/personal-banking/common-apply-now.html" target="_blank">IDFC Bank</a></li>
											<li><a href="https://www.kotak.com/811-savingsaccount-ZeroBalanceAccount/811/ahome2.action?Source=Website&Banner=811PP-HB&pubild=generic" target="_blank">Kotak Bank</a></li>
                                        </ul>                                    </li>
                                    <li><a href="">M-POS</a><img src="../img/drop-arrow-r.png" style="margin:0px;">
                                        <ul>
											<li><a href="#" target="_blank">Apply New M-POS</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="">Govt Services</a><img src="../img/drop-arrow-r.png" style="margin:0px;">
                                        <ul>			
                                            <li><a href="https://www.onlineservices.nsdl.com/paam/endUserRegisterContact.html" target="_blank">Pan Card</a></li>
											<li><a href="https://www.nvsp.in/Forms/Forms/form6" target="_blank">Voter card</a></li>
											<li><a href="https://reg.gst.gov.in/registration/" target="_blank">GST Registration</a></li>
											<li><a href="https://portal2.passportindia.gov.in/AppOnlineProject/user/RegistrationBaseAction" target="_blank">Passport</a></li>
											<li><a href="https://rtionline.gov.in/registration.php" target="_blank">RTI</a></li>
											<li><a href="https://udyogaadhaar.gov.in/UA/UAM_Registration.aspx" target="_blank">Udyog Adhar</a></li>	
                                        </ul>
                                    </li>
                                    <li><a href="">New Gas Connection</a><img src="../img/drop-arrow-r.png" style="margin:0px;">
                                        <ul>
											<li><a href="https://indane.co.in/new_connection.php" target="_blank">Indane Gas</a></li>
											<li><a href="https://myhpgas.in/myHPGas/NewConsumerRegistration.aspx" target="_blank">HP Gas</a></li>
											<li><a href="https://my.ebharatgas.com/bharatgas/LPGServices/ApplyNewConnection" target="_blank">Bharat Gas</a></li>
                                        </ul>
                                    </li>
								</ul>
                            </li>
                            <li><a href="">History <img src="../img/drop-arrow.png" class="drop-arrow-icon"></a>
                                <ul>
                                    <li><a href="">Domestic Money Transfer</a><img src="../img/drop-arrow-r.png" style="margin:0px;">
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
                            <li><a href="">Support <img src="../img/drop-arrow.png" class="drop-arrow-icon"></a>
                                <ul>
                                    <li><a href="BankContactServlet">Bank &amp; Contact Info</a></li>
                                    <li><a href="TicketSendNewServlet">Generate New Ticket</a></li>
                                    <li><a href="TicketsSentServlet">List of Tickets (Sent)</a></li>
                                </ul>
                            </li>
                            <li><a href="">Commission <img src="../img/drop-arrow.png" class="drop-arrow-icon"></a>
                                <ul>
                                    <li><a href="CommissionMyEarning">My Earning</a></li>
									<li><a href="CommissionReport">Commission Receipt</a></li>
                                </ul>
                            </li>
                            <li><a href="LogoutServlet">Logout</a></li>
                    	</ul>
						<!--
                        <form class="search-main w3-right">
                            <a href=""><img src="../img/search-icon.png" class="search-icon"></a>
                            <div class="search-show">
                            	<input type="text" placeholder="Order by TxnId">
                            </div>
                        </form>
						-->
                    </div>
                </div>
            </div>