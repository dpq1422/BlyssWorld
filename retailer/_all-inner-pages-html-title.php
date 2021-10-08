<title>BlyssPay.in</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
<link rel="stylesheet" href="../css/w3.css" type="text/css">
<link rel="stylesheet" href="../css/style.css" type="text/css">
<link rel="stylesheet" href="../css/animation.css" type="text/css">
<script src="../js/jquery.min.js"></script>
<?php 
ini_set('expose_php',0);
header("X-Powered-By: CentOS"); 
header("X-Powered-By: Ubuntu"); 
header("X-Powered-By: Servlet"); 
//header("X-Powered-By: Tomcat"); 
//header("X-Powered-By: Coyote"); 
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
		document.location.href='LogoutServlet';
	}
	else if(abcd[1]<60)
	{
		document.location.href='LogoutServlet';
	}
}
</script>
<script type="text/javascript">
window.oncontextmenu = function () { return false; }
function killCopy(e) { return false; }
function reEnable() { return true; }
document.onselectstart=new Function ("return false");
if (window.sidebar) { document.onmousedown=killCopy; document.onclick=reEnable; }
</script>
<script>if(window.Polymer==window.Polymer){}</script>
<script src="../js/angular.min.js"></script>
<script src="../js/node.js"></script>
<script src="../js/backbone.js"></script>
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
$(document).ready(function() {
  $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });
});
</script>