<!DOCTYPE html>
<html>
<head>
<title>Locate :: Blyss Fintech Pvt Ltd</title>
<?php include_once('_header-pre.php');?>
<script src="https://maps.googleapis.com/maps/api/js"></script>
<script>
window.location.href='index.php';
/*
var locations = [
  ['145001', '3'],
  ['175001', '4'],
  ['146001', '3'],
  ['144034', '5'],
  ['140603', '6'],
  ['160017', '3'],
  ['144001', '4'],
  ['141001', '3'],
  ['143001', '5'],
];

var geocoder;
var map;
var bounds = new google.maps.LatLngBounds();

function initialize() {
  map = new google.maps.Map(
	document.getElementById("map_canvas"), {
	  center: new google.maps.LatLng(37.4419, -122.1419),//23.5222622,80.4162296,5z
	  zoom: 5,
	  mapTypeId: google.maps.MapTypeId.ROADMAP
	});
  geocoder = new google.maps.Geocoder();

  for (i = 0; i < locations.length; i++) {
	geocodeAddress(locations, i);
  }
}
google.maps.event.addDomListener(window, "load", initialize);

function geocodeAddress(locations, i) {
  var postalCode = locations[i][0];
  var counters = locations[i][1];
  geocoder.geocode({
	  componentRestrictions: {
		country: 'IN',
		postalCode: postalCode
	  }
	},

	function(results, status) {
	  if (status == google.maps.GeocoderStatus.OK) {
		var marker = new google.maps.Marker({
		  icon: 'http://maps.google.com/mapfiles/ms/icons/red.png',
		  map: map,
		  position: results[0].geometry.location,
		  postalCode: postalCode,
		  animation: google.maps.Animation.DROP,
		  counters: counters,
		})
		infoWindow(marker, map, postalCode, counters, results[0].formatted_address);
		bounds.extend(marker.getPosition());
		map.fitBounds(bounds);
	  } else {
		alert("geocode of " + postalCode + " failed:" + status);
	  }
	});
}

function infoWindow(marker, map, postalCode, counters, adrs) {
  google.maps.event.addListener(marker, 'click', function() {
	//var html = "<div><h3>Location : " + adrs + "</h3><h3>Pincode : " + postalCode + "</h3><p>Outlets : " + counters + "<br></div>";
	var html = "<div><h3>Pincode : " + postalCode + "</h3><h4>No of Outlets : " + counters + "</h4></div>";
	iw = new google.maps.InfoWindow({
	  content: html,
	  maxWidth: 350
	});
	iw.open(map, marker);
  });
}

function createMarker(results) {
  var marker = new google.maps.Marker({
	icon: 'https://maps.google.com/mapfiles/ms/icons/red.png',
	map: map,
	position: results[0].geometry.location,
	title: title,
	animation: google.maps.Animation.DROP,
	address: address,
	url: url
  })
  bounds.extend(marker.getPosition());
  map.fitBounds(bounds);
  infoWindow(marker, map, title, address, url);
  return marker;
}
*/
</script>
</head>
<body>
	
   <div class="w3-display-container">  
   
        <?php include_once('_header-top.php');?>
        
        <div class="inner-top-bg money-trans-bg wh w3-left">        	
        	<!--<div class="my-center">
            	<div class="w3-row-padding">
                	<div class="w3-col l12">
                    	<div class="inner-top-text w3-text-white w3-animate-zoom">
                            <h1>Send money to Nepal</h1>
                            <h3>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</h3>                    
                        </div>
                    </div>
                </div>
            </div>-->
        </div>
                    
	</div>
    
    <section class="wh w3-left w3-padding-64">
        <div class="my-center">
            <div class="w3-row-padding">
                <div class="heading wh w3-left w3-center w3-margin-bottom">
                    <h2 class="w3-text-black">Our Retail Points @ Different Locations in India</h2>
                    <span style="background:#3f51b5;"></span>
                </div>
            </div>
            
            <div class="w3-row-padding w3-margin-bottom w3-margin-top">
            	<div class="w3-col l12">
                	<div class="nepal-txt wh w3-justify">
                        <table class='w3-table'>
							<tr class="w3-blues">
								<th>Sr. No.</th>
								<th>&nbsp;&nbsp;&nbsp;</th>
								<th>State Name of India</th>
								<th>&nbsp;&nbsp;&nbsp;</th>
								<th>Retail Points in State</th>
							</tr>
							<?php
							echo "<script>window.location.href='index.php';</script>";
							/*
							$i=0;
							$total=0;
							// Create connection
							$conn=@mysql_connect("localhost","bankatyf_master","mse!@#123") or mysql_error(); 
							mysql_select_db("bankatyf_common",$conn) or mysql_error(); 
							$query="SELECT state_id,sum(outlet) num FROM bankatyf_common.facts_figures where state_id!=0 group by state_id";
							$result=mysql_query($query);
							while($rs=mysql_fetch_array($result))
							{
								$state_name=$rs['state_id'];
								if($state_name==0 || $state_name=="0")
									continue;
								$query2="select state_name from bankatyf_common.common_state where state_id='$state_name';";
								$result2=mysql_query($query2);
								while($rs2=mysql_fetch_array($result2))
								{
									$state_name=$rs2['state_name'];
								}
								$i++;
								$total+=$rs['num'];
							?>
							<tr <?php if($i%2==0) {echo " bgcolor='#e5e5e5' ";} ?>>
								<td><?php echo $i;?></td>
								<td>&nbsp;&nbsp;&nbsp;</td>
								<td><?php echo $state_name;?></td>
								<td>&nbsp;&nbsp;&nbsp;</td>
								<td align='right'><?php echo $rs['num'];?></td>
							</tr>
							<?php
							}*/
							?>
							<tr class="w3-blues">
								<th colspan='4'>TOTAL RETAIL POINTS IN INDIA</th>
								<th align='right'><?php echo $total;?></th>
							</tr>
						</table>
                    </div>
                </div>
            </div>
		</div>
                    
	</section>
    
	<!--<div id="map_canvas" style="border:none;margin-top:-200px!important;"></div>-->
	
	<?php include_once('_footer-bottom.php');?>

</body>
</html> 
