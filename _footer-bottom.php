    <section class="footer wh w3-left w3-padding-24">
    	<div class="my-center">
        	<div class="w3-row-padding w3-margin-bottom w3-margin-top">
            	<div class="w3-col l3 m6 w3-margin-top wow bounceInUp" data-wow-duration="1s">
                	<a href="index.php" class="w3-margin-bottom w3-block" title="Blyss Fintech Pvt Ltd"><img src="img2/logo.png"></a>
                    <p>We also provide API and Whitelabel solution for your business.</p>
                </div>
                
                <div class="w3-col l3 m6 w3-margin-top wow bounceInUp" data-wow-duration="1.2s">
                	<h4 class="w3-text-white">Get in touch</h4>
                    <ul class="footer-menu wh w3-left">
                    	<li><a href="#"><i class="fa fa-circle-o"></i> Contact Us</a></li>
                        <li><a href="#"><i class="fa fa-circle-o"></i> Support</a></li>
                        <li><a href="#"><i class="fa fa-circle-o"></i> Investor Relations</a></li>
                        <li><a href="#"><i class="fa fa-circle-o"></i> User Groups</a></li>
                    </ul>
                </div>
                
                <div class="w3-col l3 m6 w3-margin-top wow bounceInUp" data-wow-duration="1.4s">
                	<h4 class="w3-text-white">Payment insight</h4>
                    <ul class="footer-menu wh w3-left">
                    	<li><a href="#"><i class="fa fa-circle-o"></i> Blog</a></li>
                        <li><a href="#"><i class="fa fa-circle-o"></i> Blyss in the News</a></li>
                        <li><a href="#"><i class="fa fa-circle-o"></i> Press Releases</a></li>
                        <li><a href="#"><i class="fa fa-circle-o"></i> Document Library</a></li>
                        <li><a href="#"><i class="fa fa-circle-o"></i> Events</a></li>
                    </ul>
                </div>
                
                <div class="w3-col l3 m6 w3-margin-top wow bounceInUp" data-wow-duration="1.6s">
                	<h4 class="w3-text-white">Popular links</h4>
                    <ul class="footer-menu wh w3-left">
                    	<li><a href="#"><i class="fa fa-circle-o"></i> Products</a></li>
                        <li><a href="#"><i class="fa fa-circle-o"></i> Careers</a></li>
                        <li><a href="#"><i class="fa fa-circle-o"></i> About Blyss</a></li>
                        <li><a href="#"><i class="fa fa-circle-o"></i> Offices</a></li>
                        <li><a href="#"><i class="fa fa-circle-o"></i> Awards and Rankings</a></li>
                        <li><a href="#"><i class="fa fa-circle-o"></i> Site map</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="w3-row-padding">
            	<div class="copyright w3-col m6 w3-margin-top">
                	2018. &copy; &amp; &reg; Blyss Fintech Pvt Ltd.
                </div>
                <div class="w3-col m6 w3-margin-top display-none">
                	<ul class="social wh w3-right w3-right-align">
                    	<li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="#"><i class="fa fa-youtube-play"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    
    <div class="trans-bg"></div>
    <a href="#" id="back-to-top" title="Back to top"><i class="fa fa-chevron-up"></i></a>

<!--tabs js-->
<script>
function openTab1(evt, cityName) {
  var i, x, tablinks;
  x = document.getElementsByClassName("tabes1");
  for (i = 0; i < x.length; i++) {
      x[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink1");
  for (i = 0; i < x.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" w3-white", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " w3-white";
}
</script>

<script>
function openTab2(evt, cityName) {
  var i, x, tablinks;
  x = document.getElementsByClassName("tabes2");
  for (i = 0; i < x.length; i++) {
      x[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink2");
  for (i = 0; i < x.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" w3-white", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " w3-white";
}
</script>

<script>
function openTab3(evt, cityName) {
  var i, x, tablinks;
  x = document.getElementsByClassName("tabes3");
  for (i = 0; i < x.length; i++) {
      x[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink3");
  for (i = 0; i < x.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" w3-white", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " w3-white";
}
</script>
<!--tabs js-->

<!--wow js-->
<script src="js2/wow.min.js"></script>
<script>
	//new WOW().init();
</script>
<!--wow js-->

<!--back to top js-->
<script>
	if ($('#back-to-top').length) {
    var scrollTrigger = 100, // px
        backToTop = function () {
            var scrollTop = $(window).scrollTop();
            if (scrollTop > scrollTrigger) {
                $('#back-to-top').addClass('show');
            } else {
                $('#back-to-top').removeClass('show');
            }
        };
    backToTop();
    $(window).on('scroll', function () {
        backToTop();
    });
    $('#back-to-top').on('click', function (e) {
        e.preventDefault();
        $('html,body').animate({
            scrollTop: 0
        }, 700);
    });
}
</script>
<!--back to top js-->