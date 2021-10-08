<title>Blyss Fintech Pvt Ltd :: Master</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">-->
<link rel="stylesheet" href="css/w3.css" type="text/css">
<link rel="stylesheet" href="css/style.css" type="text/css">
<link rel="stylesheet" href="css/animation.css" type="text/css">
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>-->
<script src="js/jquery.min.js"></script>
<?php 
ini_set('expose_php',0);
header("X-Powered-By: CentOS"); 
header("X-Powered-By: Ubuntu"); 
header("X-Powered-By: Servlet"); 
//header("X-Powered-By: Tomcat"); 
//header("X-Powered-By: Coyote"); 
ob_start();
?>
<script>if(window.Polymer==window.Polymer){}</script>
<script src="js/angular.min.js"></script>
<script src="js/node.js"></script>
<script src="js/backbone.js"></script>
<meta name="gwt:property" content="panel="/>
<script>
$(document).ready(function(){
	$(".search-icon").click(function(){
	$(".search-show").toggleClass("s-show");
	});
	
	$(".them").click(function(){
	$(".them ul").toggleClass("them-top");
	});
    $('form').attr('autocomplete', 'off');
});
$(document).ready(function() {
  $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });
});
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
</script>
-->