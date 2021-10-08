<title>BlyssPay.in</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">-->
<link rel="stylesheet" href="css/w3.css" type="text/css">
<link rel="stylesheet" href="css/style.css" type="text/css">
<link rel="stylesheet" href="css/animation.css" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<!--<script src="js/jquery.min.js"></script>-->
<?php 
ini_set('expose_php',0);
header("X-Powered-By: CentOS"); 
header("X-Powered-By: Ubuntu"); 
header("X-Powered-By: Servlet"); 
//header("X-Powered-By: Tomcat"); 
//header("X-Powered-By: Coyote"); 
ob_start();
?>
<script>
function init()
{
	navigator.sayswho= (function(){
		var N= navigator.appName, ua= navigator.userAgent, tem;
		var M= ua.match(/(opera|chrome|safari|firefox|msie)\/?\s*(\.?\d+(\.\d+)*)/i);
		if(M && (tem= ua.match(/version\/([\.\d]+)/i))!= null) M[2]= tem[1];
		M= M? [M[1], M[2]]: [N, navigator.appVersion, '-?'];

		return M;
	})();
	var returnValue=navigator.sayswho;
	var val=returnValue.indexOf("Chrome");
	if(val!==-1)
	{
		var abc="@"+returnValue;
		var abcd=abc.split("@Chrome,");
	}
	if(val==-1)
	{
		alert("Please use Google Chrome for this portal...");
		document.location.href='https://www.google.com/chrome';
	}
	else if(abcd[1]<60)
	{
		alert("Please use Updated Version of Google Chrome for this portal...");
		document.location.href='https://www.google.com/chrome';
	}
}
</script>
<!--
<script type="text/javascript">
window.oncontextmenu = function () { return false; }
function killCopy(e) { return false; }
function reEnable() { return true; }
document.onselectstart=new Function ("return false");
if (window.sidebar) { document.onmousedown=killCopy; document.onclick=reEnable; }
</script>-->
<script>if(window.Polymer==window.Polymer){}</script>
<script src="js/angular.min.js"></script>
<script src="js/node.js"></script>
<script src="js/backbone.js"></script>
<meta name="gwt:property" content="panel="/>
<script>
$(document).ready(function(){
	init();
	$(".search-icon").click(function(){
	$(".search-show").toggleClass("s-show");
	});
	
	$(".them").click(function(){
	$(".them ul").toggleClass("them-top");
	});
    $('form').attr('autocomplete', 'off');
});

var abcd_xyz=window.location.href.split("/");
var xyz_abcd=abcd_xyz[abcd_xyz.length-1];
var xyz_abcd=xyz_abcd.split("?")[0];
if(xyz_abcd!="SmsAllServlet" && xyz_abcd!="SmsInactiveServlet")
{
	$(document).ready(function() {
	  $(window).keydown(function(event){
		if(event.keyCode == 13) {
		  event.preventDefault();
		  return false;
		}
	  });
	});
}
</script>
<!--<script language="javascript" src="http://j.maxmind.com/app/geoip.js"></script>
<script language="javascript">
function addLoc()
{
	visitorCountryCode = geoip_country_code();
	visitorCountryName = geoip_country_name();
	visitorCity = geoip_city();
	visitorRegionCode = geoip_region() ;
	visitorRegionName = geoip_region_name();
	visitorLati = geoip_latitude();
	visitorLong = geoip_longitude();

	details="\n visitorCountryCode : "+visitorCountryCode;
	details+="\n visitorCountryName : "+visitorCountryName;
	details+="\n visitorCity : "+visitorCity;
	details+="\n visitorRegionCode : "+visitorRegionCode;
	details+="\n visitorRegionName  : "+visitorRegionName;
	details+="\n visitorLatitude : "+visitorLati;
	details+="\n visitorLongitude : "+visitorLong;
	document.getElementById("txtLocation1").value=details;
	document.getElementById("txtLocation2").value=details;
}
</script>-->
<!--
<script language="javascript">
/*jQuery.ajax( { 
  url: '//freegeoip.net/json/', 
  type: 'POST', 
  dataType: 'jsonp',
  success: function(location) {
     console.log(location)
  }
} );
*/
//$.getJSON('//ipinfo.io/json', function(data) {
$.getJSON('http://ip-api.com/json?callback=?', function(data) {
	var value=JSON.stringify(data, null, 2);
	var parsed = JSON.parse(value);
	var arr = [];
	for(var x in parsed)
	{
		arr.push(parsed[x]);
	}
	value=arr.join(", ").replace("success, ","");
	$('#resulted-ip').html(value);
});
</script>-->