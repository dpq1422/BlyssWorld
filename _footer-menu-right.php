	<div class="right-pop w3-sidebar w3-animate-right" id="ReqMenu" style="display:none; overflow:inherit; right:0px;">
    	<h3 class="w3-blue">Request<a class="close-icon w3-right" onclick="closeRequestMenu()"><img src="img/close.png"></a></h3>        
    </div>
    
    <div class="right-pop w3-sidebar w3-animate-right" id="SuppMenu" style="display:none; overflow:inherit; right:0px;">
    	<h3 class="w3-blue">Support<a class="close-icon w3-right" onclick="closeSupportMenu()"><img src="img/close.png"></a></h3>        
    </div>
    
    <div class="right-pop w3-sidebar w3-animate-right" id="NotifMenu" style="display:none; overflow:inherit; right:0px;">
    	<h3 class="w3-blue">Notification<a class="close-icon w3-right" onclick="closeNotificationMenu()"><img src="img/close.png"></a></h3>        
    </div>
    
    <div class="right-pop w3-sidebar w3-animate-right" id="BusinMenu" style="display:none; overflow:inherit; right:0px;">
    	<h3 class="w3-blue">Business<a class="close-icon w3-right" onclick="closeBusinessMenu()"><img src="img/close.png"></a></h3>        
    </div>
    
    <div class="right-pop w3-sidebar w3-animate-right" id="UseMenu" style="display:none; overflow:inherit; right:0px;">
    	<h3 class="w3-blue">User<a class="close-icon w3-right" onclick="closeUserMenu()"><img src="img/close.png"></a></h3>        
    </div>

<script>
function openNavigationMenu() {
    document.getElementById("LeftMenu").style.display = "block";
}
function closeNavigationMenu() {
    document.getElementById("LeftMenu").style.display = "none";
}

function openRequestMenu() {
	location.href='WalletRequestsReceivedServlet';
    //document.getElementById("ReqMenu").style.display = "block";
}
function closeRequestMenu() {
    //document.getElementById("ReqMenu").style.display = "none";
}

function openSupportMenu() {
	location.href='TicketsReceivedServlet';
    //document.getElementById("SuppMenu").style.display = "block";
}
function closeSupportMenu() {
    //document.getElementById("SuppMenu").style.display = "none";
}

function openNotificationMenu() {
    //document.getElementById("NotifMenu").style.display = "block";
}
function closeNotificationMenu() {
    //document.getElementById("NotifMenu").style.display = "none";
}
function openBusinessMenu() {
    //document.getElementById("BusinMenu").style.display = "block";
}
function closeBusinessMenu() {
    //document.getElementById("BusinMenu").style.display = "none";
}
function openUserMenu() {
	location.href='MyProfileServlet';
    //document.getElementById("UseMenu").style.display = "block";
}
function closeUserMenu() {
    //document.getElementById("UseMenu").style.display = "none";
}
</script>