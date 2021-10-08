<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">-->
<!--<link rel="icon" href="img2/favicon-icon.png">--> 
<link rel="stylesheet" href="css2/w3.css" type="text/css">
<link rel="stylesheet" href="css2/style.css" type="text/css">
<link rel="stylesheet" href="css2/animation.css" type="text/css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet"> 
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-126322670-13"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-126322670-13');
</script>

<!--responsive menu js start-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
  $(".menu-icon").click(function() {
    $(".responsive-bg").slideToggle()
  }); 
  $( ".arrow" ).click(function() {
  $( this ).toggleClass( "arrow-open" );
});
});
</script>
<script>
function myFunction(id) {
    var x = document.getElementById(id);
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else { 
        x.className = x.className.replace(" w3-show", "");
    }
}
</script>
<!--responsive menu js end-->

<!--menu tab js start-->
<script>
jQuery(document).ready(function () {
    jQuery('.menu-main ul li a').click(function () {
        var tab_id = jQuery(this).attr('data-tab');

        jQuery('.menu-main ul li a').not('[data-tab='+tab_id+']').removeClass('current');
        jQuery('.tab-bg:not(#'+tab_id+')').removeClass('current');

        jQuery(this).toggleClass('current');
        jQuery("#" + tab_id).toggleClass('current');		
    })
})
</script>
<!--menu tab js end-->