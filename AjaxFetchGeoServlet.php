<?php
$pincode="";
$result="";
$latitude=0;
$longitude=0;
if(isset($_POST['pincode']))
{
	$pincode = $_POST['pincode']; // PinCode

	// Get JSON results from this request
	$geo = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($pincode).'&sensor=false');
	$geo = json_decode($geo, true); // Convert the JSON to an array

	if ($geo['status'] == 'OK') {
	  $latitude = $geo['results'][0]['geometry']['location']['lat']; // Latitude
	  $longitude = $geo['results'][0]['geometry']['location']['lng']; // Longitude
	}
	$result="$latitude,$longitude";
	$result=json_encode($result);
}
echo $result;
?>