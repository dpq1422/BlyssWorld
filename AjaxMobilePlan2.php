<?php
include('zc-session-admin.php');
$type="";
$operator="";
$circle="";
$resulted_data=$result="";
if(isset($_POST['type']))
{
	$type=$_POST['type'];
}
if(isset($_POST['operator']))
{
	$operator=$_POST['operator'];
}
if(isset($_POST['circle']))
{
	$circle=$_POST['circle'];
}
if($type!="" && $operator!="" && $circle!="")
{
	$ch = curl_init();
	$timeout = 30; // set to zero for no timeout
	$myurl = "https://joloapi.com/api/findplan.php?userid=mentor&key=244540181419379&$operator=28&cir=$circle&typ=$type&max=&amt=";
	curl_setopt ($ch, CURLOPT_URL, $myurl);
	curl_setopt ($ch, CURLOPT_HEADER, 0);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	$jsonxx = curl_exec($ch);
	$curl_error = curl_errno($ch);
	curl_close($ch);
	$someArray = json_decode($jsonxx, true);
	$resulted_data="";
	if (count($someArray) > 0) 
	{
		$resulted_data.="<table><thead><tr>
		<th>Detail</th>
		<th>Amount (Rs.)</th>
		<th>Validity (days)</th>
		</tr></thead><tbody>";
		foreach ($someArray as $key => $value) 
		{
			$resulted_data.=" <tr><td>" .$value["Detail"] . "</td> <td>" .$value["Amount"] . "</td> <td>" .$value["Validity"] . "</td> </tr>";
		}
		$resulted_data.="</tbody></table><br/>";
	}
	else
	{
		$resulted_data.="<p class='w3-center'><b class='w3-text-red'>No offer details available for this category</b></p>";
	}
}
echo json_encode("$resulted_data");
?>