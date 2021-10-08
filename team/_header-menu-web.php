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
                            <li><a href="">Team <img src="../img/drop-arrow.png" class="drop-arrow-icon"></a>
                                <ul>
									<?php
									if($logged_user_type!=5)
									{
									?>
                                    <li><a href="">Member</a><img src="../img/drop-arrow-r.png" style="margin:0px;">
                                        <ul>
											<li><a href="TeamsMembersServlet">List of Members</a></li>
											<li><a href="TeamsMemberServlet">Add New Member</a></li>
										</ul>
									</li>
									<?php
									}
									?>
                                    <li><a href="">Retailer</a><img src="../img/drop-arrow-r.png" style="margin:0px;">
                                        <ul>
											<li><a href="TeamsRetailersServlet">List of Retailers</a></li>
											<li><a href="TeamsRetailerServlet">Add New Retailer</a></li>
										</ul>
									</li>
									<li><a href="KycStatusServlet">KYC Status</a></li>
                                </ul>
                            </li>
                            <li><a href="">Wallet <img src="../img/drop-arrow.png" class="drop-arrow-icon"></a>
                                <ul>
                                    <li><a href="WalletStatusServlet">Wallet Status</a></li>
                                    <li class='line'><a href="WalletHistoryUserServlet">My Ledger</a></li>
									<li><a href="WalletSendRequestServlet">Wallet Request to Company</a></li>
                                    <li class='line'><a href="WalletSentRequestsServlet">Payment History</a></li>
						<?php if($its_my_parent!=0 && $logged_user_id!="200265") { ?>
									<li><a href="WalletSendRequestTeamServlet">Wallet Request to Distributor</a></li>
                                    <li class='line'><a href="WalletSentRequestsTeamServlet">Wallet History</a></li>
						<?php } ?>
									<li><a href="WalletReceivedRequestsServlet">Wallet Requests Received</a></li>
									<li><a href="WalletCompanyRequestsServlet">Team Requests To Company</a></li>
                                </ul>
                            </li>
                            <li><a href="">History <img src="../img/drop-arrow.png" class="drop-arrow-icon"></a>
                                <ul>
									<li><a href="TxnServiceDmtServlet">Domestic Money Transfer</a></li>
									<li><a href="TxnServiceOtherServlet">Prepaid and Bills</a></li>
                                </ul>
                            </li>
                            <li><a href="">Support <img src="../img/drop-arrow.png" class="drop-arrow-icon"></a>
                                <ul>
                                    <li><a href="BankContactServlet">Bank &amp; Contact Info</a></li>
                                    <li><a href="TicketsSentServlet">List of Tickets (Sent)</a></li>
                                    <li><a href="TicketSendNewServlet">Generate New Ticket</a></li>
                                </ul>
                            </li>
                            <li><a href="">Commission <img src="../img/drop-arrow.png" class="drop-arrow-icon"></a>
                                <ul>
                                    <li><a href="CommissionMyEarning">My Earning</a></li>
									<li><a href="CommissionReport">Commission Receipt</a></li>
                                </ul>
                            </li>
                            <li><a href="">Report <img src="../img/drop-arrow.png" class="drop-arrow-icon"></a>
                                <ul>
                                    <li><a href="ReportTeamCollectionServlet">Team Work</a></li>
                                    <li><a href="ReportInActivityServlet">In-activity Report</a></li>
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