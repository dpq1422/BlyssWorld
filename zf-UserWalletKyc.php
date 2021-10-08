<?php
function show_walletkyc_count($cond)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_base.child_userinfo_walletkyc $cond and user_type in(2,3,4,5,6,7,8,9,10,11,12) ";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	return $total_records;
}
function show_walletkyc_data($cond, $start_from=0, $num_rec_per_page=0)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$start_from=mysql_real_escape_string($start_from);
	$num_rec_per_page=mysql_real_escape_string($num_rec_per_page);
	if($start_from==0 && $num_rec_per_page==0)
	$query="select * from $bankapi_child_base.child_userinfo_walletkyc $cond and user_type in(2,3,4,5,6,7,8,9,10,11,12) order by wallet_balance desc, user_id desc ";
	else
	$query="select * from $bankapi_child_base.child_userinfo_walletkyc $cond and user_type in(2,3,4,5,6,7,8,9,10,11,12) order by wallet_balance desc, user_id desc LIMIT $start_from, $num_rec_per_page";
	$result=mysql_query($query);
	return $result;
}
function show_kycwallet_count($cond)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_base.child_userinfo_walletkyc $cond and user_type in(2,3,4,5,6,7,8,9,10,11,12) ";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	return $total_records;
}
function show_kycwallet_data($cond, $start_from=0, $num_rec_per_page=0)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$start_from=mysql_real_escape_string($start_from);
	$num_rec_per_page=mysql_real_escape_string($num_rec_per_page);
	if($start_from==0 && $num_rec_per_page==0)
	$query="select * from $bankapi_child_base.child_userinfo_walletkyc $cond and user_type in(2,3,4,5,6,7,8,9,10,11,12) order by kyc_status, user_id ";
	else
	$query="select * from $bankapi_child_base.child_userinfo_walletkyc $cond and user_type in(2,3,4,5,6,7,8,9,10,11,12) order by kyc_status, user_id LIMIT $start_from, $num_rec_per_page";
	$result=mysql_query($query);
	return $result;
}
function show_bank_count($cond)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_base.child_userinfo_walletkyc $cond and user_type in(2,3,4,5,6,7,8,9,10,11,12) ";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	return $total_records;
}
function show_bank_data($cond, $start_from=0, $num_rec_per_page=0)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$start_from=mysql_real_escape_string($start_from);
	$num_rec_per_page=mysql_real_escape_string($num_rec_per_page);
	if($start_from==0 && $num_rec_per_page==0)
	$query="select * from $bankapi_child_base.child_userinfo_walletkyc $cond and user_type in(2,3,4,5,6,7,8,9,10,11,12) order by bank_verified, user_id ";
	else
	$query="select * from $bankapi_child_base.child_userinfo_walletkyc $cond and user_type in(2,3,4,5,6,7,8,9,10,11,12) order by bank_verified, user_id LIMIT $start_from, $num_rec_per_page";
	$result=mysql_query($query);
	return $result;
}
function show_wallet_balance($user_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$wbal=0;
	$query="select * from $bankapi_child_base.child_userinfo_walletkyc where user_id='$user_id' ";
	$result=mysql_query($query);
	if(isset($result))
	{
		$rs=mysql_fetch_array($result);
		$wbal=$rs['wallet_balance'];
	}
	return $wbal;
}
function show_kyc_info($user_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$kinfo=0;
	$query="select * from $bankapi_child_base.child_userinfo_walletkyc where user_id='$user_id' ";
	$result=mysql_query($query);
	if(isset($result))
	{
		$rs=mysql_fetch_array($result);
		$kinfo=$rs['kyc_status'];
	}
	return $kinfo;
}
function show_bank_info($user_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$binfo=0;
	$query="select * from $bankapi_child_base.child_userinfo_walletkyc where user_id='$user_id' ";
	$result=mysql_query($query);
	if(isset($result))
	{
		$rs=mysql_fetch_array($result);
		$binfo=$rs['bank_verified'];
	}
	return $binfo;
}
function show_kyc_data($user_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$name=$email=$address=$mobile=$city=$dist=$state=$pincode=$gender="";
	$aadhar=$pancard=$dob=$geo=$bsname=$bsadd=$bslogo=$bsgst=$mybname=$mybaccno=$mybifsc=$kst="";
	$query1="select * from $bankapi_child_base.child_user where user_id='$user_id';";
	$result1=mysql_query($query1);
	$result1=mysql_fetch_array($result1);
	$name=$result1['user_name'];
	$email=$result1['e_mail'];
	$address=$result1['address'];
	$mobile=$result1['user_contact_no'];
	$city=$result1['city_name'];
	$dist=$result1['distt_id'];
	$state=$result1['state_id'];
	$pincode=$result1['area_pin_code'];
	$gender=$result1['gender'];
	
	$query2="select * from $bankapi_child_base.child_userinfo_walletkyc where user_id='$user_id';";
	$result2=mysql_query($query2);
	$result2=mysql_fetch_array($result2);
	$aadhar=$result2['aadhar_no'];
	$pancard=$result2['pancard_no'];
	$dob=$result2['date_of_birth'];
	$geo=$result2['geo_location'];
	$bsname=$result2['business_name'];
	$bsadd=$result2['business_address'];
	$bslogo=$result2['business_logo'];
	$bsgst=$result2['gst'];
	$mybname=$result2['bank'];
	$mybaccno=$result2['account'];
	$mybifsc=$result2['ifsc'];
	$kst=$result2['kyc_status'];
	$bst=$result2['bank_verified'];
	$kinfo=array($name,$email,$address,$mobile,$city,$dist,$state,$pincode,$gender,$aadhar,$pancard,$dob,$geo,$bsname,$bsadd,$bslogo,$bsgst,$mybname,$mybaccno,$mybifsc,$kst,$bst);
	return $kinfo;
}
function show_kyc_files($user_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_base.child_user_kyc_uploads where user_id=$user_id ";
	$result=mysql_query($query);
	return $result;
}
function update_user_bank($user_id,$mybname,$mybaccno,$mybifsc,$bst)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	echo $query2="update $bankapi_child_base.child_userinfo_walletkyc set bank='$mybname', account='$mybaccno', ifsc='$mybifsc', bank_verified='$bst' where user_id='$user_id';";
	mysql_query($query2);
}
function update_my_bank($user_id,$mybname,$mybaccno,$mybifsc,$bst)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query2="update $bankapi_child_base.child_userinfo_walletkyc set bank='$mybname', account='$mybaccno', ifsc='$mybifsc', bank_verified='$bst' where user_id='$user_id';";
	mysql_query($query2);
	return mysql_affected_rows();
}
function update_user_kyc($user_id,$name,$email,$address,$mobile,$city,$dist,$state,$pincode,$gender,$aadhar,$pancard,$dob,$geo,$bsname,$bsadd,$bsgst,$kst)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query1="update $bankapi_child_base.child_user set user_name='$name', e_mail='$email', address='$address', user_contact_no='$mobile', city_name='$city', distt_id='$dist', state_id='$state', area_pin_code='$pincode', gender='$gender' where user_id='$user_id';";
	mysql_query($query1);
	$query2="update $bankapi_child_base.child_userinfo_walletkyc set aadhar_no='$aadhar', pancard_no='$pancard', date_of_birth='$dob', geo_location='$geo', business_name='$bsname', business_address='$bsadd', gst='$bsgst', kyc_status='$kst' where user_id='$user_id';";
	mysql_query($query2);
}


function update_my_kyc($user_id,$address,$state,$dist,$city,$pincode,$email,$gender,
$dob,$bsname,$bsadd,$bsgst,$filepan,$filepic,$fileaadharfront,$fileaadharback,$kst)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query1="update $bankapi_child_base.child_user set e_mail='$email', address='$address', city_name='$city', distt_id='$dist', state_id='$state', area_pin_code='$pincode', gender='$gender' where user_id='$user_id';";
	mysql_query($query1);
	$query2="update $bankapi_child_base.child_userinfo_walletkyc set date_of_birth='$dob', business_name='$bsname', business_address='$bsadd', gst='$bsgst', kyc_status='$kst' where user_id='$user_id';";
	mysql_query($query2);
	
	$client_id=$clientdbid;
	$kycuid=$user_id;
	$unqtm=date_timestamp_get(date_create());
	$doc_1="$client_id-$kycuid-$unqtm-panc";
	$doc_2="$client_id-$kycuid-$unqtm-ppic";
	$doc_3="$client_id-$kycuid-$unqtm-add1";
	$doc_4="$client_id-$kycuid-$unqtm-add2";
	
	$file1="";
	$kycerror="";
	if(isset($filepan))
	{
		$file1=$filepan;
		$kycerror=upload_kyc($file1,$doc_1);
		if($kycerror=="")
		{
			$target_dir = "../kyc/";
			//$imageFileType = pathinfo(basename($file4["name"]),PATHINFO_EXTENSION);
			$imageFileType = "jpg";
			$target_file = $target_dir . $doc_1 . "." . $imageFileType;
			$file1=move_uploaded_file($filepan["tmp_name"], $target_file);
		}
	}
	$file2="";
	if(isset($filepic))
	{
		$file2=$filepic;
		$kycerror=upload_kyc($file2,$doc_2);
		if($kycerror=="")
		{
			$target_dir = "../kyc/";
			//$imageFileType = pathinfo(basename($file4["name"]),PATHINFO_EXTENSION);
			$imageFileType = "jpg";
			$target_file = $target_dir . $doc_2 . "." . $imageFileType;
			$file2=move_uploaded_file($filepic["tmp_name"], $target_file);
		}
	}
	$file3="";
	if(isset($fileaadharfront))
	{
		$file3=$fileaadharfront;
		$kycerror=upload_kyc($file3,$doc_3);
		if($kycerror=="")
		{
			$target_dir = "../kyc/";
			//$imageFileType = pathinfo(basename($file4["name"]),PATHINFO_EXTENSION);
			$imageFileType = "jpg";
			$target_file = $target_dir . $doc_3 . "." . $imageFileType;
			$file3=move_uploaded_file($fileaadharfront["tmp_name"], $target_file);
		}
	}
	$file4="";
	if(isset($fileaadharback))
	{
		$file4=$fileaadharback;
		$kycerror=upload_kyc($file4,$doc_4);
		if($kycerror=="")
		{
			$target_dir = "../kyc/";
			//$imageFileType = pathinfo(basename($file4["name"]),PATHINFO_EXTENSION);
			$imageFileType = "jpg";
			$target_file = $target_dir . $doc_4 . "." . $imageFileType;
			$file4=move_uploaded_file($fileaadharback["tmp_name"], $target_file);
		}
	}
	$result4=0;
	if($file1==1)
	{
		$query4a="INSERT INTO $bankapi_child_base.child_user_kyc_uploads(user_id,uploaded_at,status,uploaded_by_user_id,remarks,doc_1)
		VALUES ('$kycuid','$datetime_datetime','1','$user_id','PAN Card	uploaded at $datetime_datetime','$doc_1');";
		$result4+=mysql_query($query4a);
	}
	if($file2==1)
	{
		$query4a="INSERT INTO $bankapi_child_base.child_user_kyc_uploads(user_id,uploaded_at,status,uploaded_by_user_id,remarks,doc_2)
		VALUES ('$kycuid','$datetime_datetime','1','$user_id','Passport Size Photo uploaded at $datetime_datetime','$doc_2');";
		$result4+=mysql_query($query4a);
	}
	if($file3==1)
	{
		$query4a="INSERT INTO $bankapi_child_base.child_user_kyc_uploads(user_id,uploaded_at,status,uploaded_by_user_id,remarks,doc_3)
		VALUES ('$kycuid','$datetime_datetime','1','$user_id','Address Proof 1 uploaded $datetime_datetime','$doc_3');";
		$result4+=mysql_query($query4a);
	}
	if($file4==1)
	{
		$query4a="INSERT INTO $bankapi_child_base.child_user_kyc_uploads(user_id,uploaded_at,status,uploaded_by_user_id,remarks,doc_4)
		VALUES ('$kycuid','$datetime_datetime','1','$user_id','Address Proof 2 uploaded $datetime_datetime','$doc_4');";
		$result4+=mysql_query($query4a);
	}
	$returnresult="";
	if($kycerror!="")
		$returnresult=$kycerror;
	else
		$returnresult=$result4;
	return $returnresult;
}


function upload_kyc($file,$doc_1)
{
	$kyc_error="";
	$imageFileType = pathinfo(basename($file["name"]),PATHINFO_EXTENSION);
	$target_dir = "../kyc/";
	$target_file = $target_dir . $doc_1 . "." . $imageFileType;
	$uploadOk = 1;
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
		$check = getimagesize($file["tmp_name"]);
		if($check !== true) {        
			$kyc_error .= " File is not an image.";
			$uploadOk = 0;
		}
	}
	// Check if file already exists
	if (file_exists($target_file)) {
		$kyc_error .= " Sorry, file already exists.";
		$uploadOk = 0;
	}
	// Check file size
	if ($file["size"] > 1048576) {
		$kyc_error .= " Sorry, your file is too large it should not be larger than 250 KB each. ";
		$uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
		$kyc_error .= " Sorry, only JPG, JPEG, PNG & GIF files are allowed. [$imageFileType] file is not allowed. ";
		$uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		$kyc_error .= " Sorry, your file is not uploaded.";
		
	// if everything is ok, try to upload file
	} 
	return $kyc_error;
}
?>