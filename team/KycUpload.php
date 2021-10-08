<!DOCTYPE html>
<html>
<head>
<?php include_once('_all-inner-pages-html-title.php'); ?>
<script type="text/javascript" src="../js/admin-validation-functions.js"></script>
<script>
function expand(exp_no)
{
	$(".address"+exp_no).slideToggle();
	$(".add"+exp_no).toggleClass("add-show");
}
</script>
<script>
$(document).ready(function(){
	$(".search-data").click(function(){
		$(".table-search-filter").slideToggle();
	});
});
</script>
<script>
function checkfiletype(file) {
	
	var checkfile=0;
	var _validFileExtensions = [".jpg", ".jpeg", ".png"];
    
	if (file.length > 0) {
		
		var blnValid = false;
		for (var j = 0; j < _validFileExtensions.length; j++) {
			var sCurExtension = _validFileExtensions[j];
			if (file.substr(file.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
				blnValid = true;
				break;
			}
		}
		if (!blnValid) {
			checkfile++;
		}
	}
    return checkfile;
}
function checkfilesize1(){
	var sizeinbytes=0;
    if(window.ActiveXObject){
        var fso = new ActiveXObject("Scripting.FileSystemObject");
        var filepath = document.getElementById('filepan').value;
        var thefile = fso.getFile(filepath);
        sizeinbytes = thefile.size;
    }else{
        sizeinbytes = document.getElementById('filepan').files[0].size;
    }
	return sizeinbytes;
}
function checkfilesize2(){
	var sizeinbytes=0;
    if(window.ActiveXObject){
        var fso = new ActiveXObject("Scripting.FileSystemObject");
        var filepath = document.getElementById('filepic').value;
        var thefile = fso.getFile(filepath);
        sizeinbytes = thefile.size;
    }else{
        sizeinbytes = document.getElementById('filepic').files[0].size;
    }
	return sizeinbytes;
}
function checkfilesize3(){
	var sizeinbytes=0;
    if(window.ActiveXObject){
        var fso = new ActiveXObject("Scripting.FileSystemObject");
        var filepath = document.getElementById('fileaadharfront').value;
        var thefile = fso.getFile(filepath);
        sizeinbytes = thefile.size;
    }else{
        sizeinbytes = document.getElementById('fileaadharfront').files[0].size;
    }
	return sizeinbytes;
}
function checkfilesize4(){
	var sizeinbytes=0;
    if(window.ActiveXObject){
        var fso = new ActiveXObject("Scripting.FileSystemObject");
        var filepath = document.getElementById('fileaadharback').value;
        var thefile = fso.getFile(filepath);
        sizeinbytes = thefile.size;
    }else{
        sizeinbytes = document.getElementById('fileaadharback').files[0].size;
    }
	return sizeinbytes;
}
function show_dist()
{
	var states = $("#states").val();
	//make the AJAX request, dataType is set to json
	//meaning we are expecting JSON data in response from the server
	$.ajax({
		type: "POST",
		url: "../AjaxShowDistServlet",
		data: {'states': states},
		dataType: "json",
	 
		//if received a response from the server
		success: function( data, textStatus, jqXHR) {
			//our country code was correct so we have some information to display/
			$("#districts").html(data);
		}	 
	});
}
var click=0;
function updatekyc()
{
	click++;
	if(click==1)
	$("#UpdateKYC").click();
}
function check_values() {
	
	var padd=$("#padd").val();
	
	var states=$("#states").val();
	var districts=$("#districts").val();
	var pcity=$("#pcity").val();
	
	var pincode=$("#pincode").val();
	var pemail=$("#pemail").val();
	var pdob=$("#pdob").val();
	var pgender=$("#pgender").val();
	
	var filepan=$("#filepan").val();
	var filepic=$("#filepic").val();
	var fileaadharfront=$("#fileaadharfront").val();
	var fileaadharback=$("#fileaadharback").val();
	
	var error_message="";
	
	
	
	if(isEmpty(padd)==1)
		error_message+="<li>User Address should not be blank.</li>";
	
	
	
	if(isEmpty(states)==1)
		error_message+="<li>Select State.</li>";
	if(isEmpty(districts)==1)
		error_message+="<li>Select District.</li>";
	if(isEmpty(pcity)==1)
		error_message+="<li>City should not be blank.</li>";
	
	
	
	if(isEmpty(pincode)==1)
		error_message+="<li>Area pincode should not be blank.</li>";	
	if(isNumeric(pincode)==1)
		error_message+="<li>Area pincode should has Numeric Only.</li>";
	if(isSize(pincode,6,6)==1)
		error_message+="<li>Area pincode should has 6 digits.</li>";	
	if(isEmpty(pemail)==1)
		error_message+="<li>Email should not be blank.</li>";	
	if(isEmail(pemail)==1)
		error_message+="<li>Email format should be valid and proper.</li>";
	if(isEmpty(pdob)==1)
		error_message+="<li>Select Date of Birth.</li>";
	if(isEmpty(pgender)==1)
		error_message+="<li>Select Gender.</li>";
	
	if(isEmpty(filepan)==1)
		error_message+="<li>Upload Pan Card.</li>";
	if(isEmpty(filepic)==1)
		error_message+="<li>Upload Passport Size Pic.</li>";
	if(isEmpty(fileaadharfront)==1)
		error_message+="<li>Upload Aadhar Card Front.</li>";
	if(isEmpty(fileaadharback)==1)
		error_message+="<li>Upload Aadhar Card Back.</li>";
	if(isEmpty(filepan)!=1 && checkfiletype(filepan)!=0)
		error_message+="<li>PANCARD : Only JPG / JPEG / PNG file is allowed to upload.</li>";
	if(isEmpty(filepic)!=1 && checkfiletype(filepic)!=0)
		error_message+="<li>PASSPORT PIC : Only JPG / JPEG / PNG file is allowed to upload.</li>";
	if(isEmpty(fileaadharfront)!=1 && checkfiletype(fileaadharfront)!=0)
		error_message+="<li>AADHAR FRONT : Only JPG / JPEG / PNG file is allowed to upload.</li>";
	if(isEmpty(fileaadharback)!=1 && checkfiletype(fileaadharback)!=0)
		error_message+="<li>AADHAR BACK : Only JPG / JPEG / PNG file is allowed to upload.</li>";
	//262144
	if(isEmpty(filepan)!=1 && checkfilesize1()>262144)
		error_message+="<li>PANCARD : Max file is 250KB is allowed.</li>";
	if(isEmpty(filepic)!=1 && checkfilesize2()>262144)
		error_message+="<li>PASSPORT PIC : Max file is 250KB is allowed.</li>";
	if(isEmpty(fileaadharfront)!=1 && checkfilesize3()>262144)
		error_message+="<li>AADHAR FRONT : Max file is 250KB is allowed.</li>";
	if(isEmpty(fileaadharback)!=1 && checkfilesize4()>262144)
		error_message+="<li>AADHAR BACK : Max file is 250KB is allowed.</li>";
	
	if(error_message!="")
	{
		error_message="<ul class='error-message'>"+error_message+"</ul>";
		$("#error-title").html("Required Fileds/Values");
		$("#error-message").html(error_message);
		$("#ButtonFirst").show();
		$("#ButtonSecond").hide();
		$("#ViewServlet").hide();
		$("#error-box").show();
		return false;
	}
	else
	{
		$("#error-title").html("Confirm");
		$("#error-message").html("Do you want to update KYC Info?");
		$("#ButtonFirst").hide();
		$("#ButtonSecond").show();
		$("#ViewServlet").show();
		$("#error-box").show();
		return true;
	}
}
</script>

</head>
<body>

	<?php include_once('_header.php'); ?>
    
    <section class="boxes wh w3-left">
        <!--<div class="w3-container">-->
            <!--<div class="w3-row-padding">
                <div class="w3-col m12">
                	<h4 class="heading wh w3-left"><span>Transactions</span></h4>
                </div>
            </div>-->
            <div class="w3-row-padding w3-margin-top">
            	<div class="w3-col m12 wow bounceIn">
                	<div class="table-box wh w3-left">
						<?php
						if($kinf!=0 && $kinf!=-4)
							echo "<script>window.location.href='MyProfileServlet';</script>";
						$userid=$logged_user_id;
						if(isset($_POST['UpdateKYC']))
						{
							include_once('../zc-session-admin.php');
							include_once('../zf-UserWalletKyc.php');
							$address=mysql_real_escape_string($_POST['padd']);
							
							$state=mysql_real_escape_string($_POST['states']);
							$dist=mysql_real_escape_string($_POST['districts']);
							$city=mysql_real_escape_string($_POST['pcity']);
							
							$pincode=mysql_real_escape_string($_POST['pincode']);
							$email=mysql_real_escape_string($_POST['pemail']);
							$dob=mysql_real_escape_string($_POST['pdob']);
							$gender=mysql_real_escape_string($_POST['pgender']);
							
							$bsname=mysql_real_escape_string($_POST['bsname']);
							$bsgst=mysql_real_escape_string($_POST['bsgst']);
							$bsadd=mysql_real_escape_string($_POST['bsadd']);
							
							$mybname=mysql_real_escape_string($_POST['bname']);
							$mybifsc=mysql_real_escape_string($_POST['bifsc']);
							$mybaccno=mysql_real_escape_string($_POST['bacc']);
							
							$filepan=$_FILES["filepan"];
							$filepic=$_FILES["filepic"];
							$fileaadharfront=$_FILES["fileaadharfront"];
							$fileaadharback=$_FILES["fileaadharback"];
							
							$kst=1;
							
							$resultupload=update_my_kyc($userid,$address,$state,$dist,$city,$pincode,$email,$gender,$dob,$bsname,$bsadd,$bsgst,$mybname,$mybaccno,$mybifsc,$filepan,$filepic,$fileaadharfront,$fileaadharback,$kst);
							if($resultupload>0)
							{
								echo "<script>window.location.href='MyProfileServlet';</script>";
							}
							else
							{
								echo "<script>window.location.href='KycUpload?msg=$resultupload';</script>";
							}
						}
						include_once('../zf-User.php');
						include_once('../zf-Level.php');
						include_once('../zf-UserWalletKyc.php');
						$userid=$logged_user_id;
						$username=show_user_name($userid);
						$usertype=show_user_type($userid);
						$usertypename=show_level_name($usertype);
						$kyc_data=show_kyc_data($userid);
						?>
                    	<div class="box-head">
                        	<h3>USER KYC DETAILS</h3>
                        </div>					
						<div class="w3-row-padding w3-margin-bottom"> 								
							<div class="w3-col m6 l3 w3-margin-top">
								<label>User ID</label>	
								<input type="text" value="<?php echo $userid;?>" placeholder="User ID" disabled class="w3-input w3-border w3-round">                                    
							</div>
													
							<div class="w3-col m6 l3 w3-margin-top">
								<label>User Name</label>
								<input type="text" value="<?php echo $username;?>" placeholder="User Name" disabled class="w3-input w3-border w3-round">                                    
							</div>
							
							<div class="w3-col m6 l3 w3-margin-top">
								<label>User Type</label>	
								<input type="text" value="<?php echo $usertypename;?>" placeholder="User Type" disabled class="w3-input w3-border w3-round">                                    
							</div>
                                
							<div class="w3-col m6 l3 w3-margin-top">
								<label>MOBILE NUMBER</label>	
								<input type="text" disabled value="<?php echo $kyc_data[3];?>" placeholder="Mobile Number" class="w3-input w3-border w3-round">                                    
							</div>		
							
							<div class="w3-col m6 l4 w3-margin-top display-none">
								<label>AADHAR CARD NO</label>	
								<input type="text" disabled value="<?php echo $kyc_data[9];?>" placeholder="Aadhar No" class="w3-input w3-border w3-round">                                    
							</div>		
							
							<div class="w3-col m6 l4 w3-margin-top display-none">
								<label>PAN CARD NO</label>	
								<input type="text" disabled value="<?php echo $kyc_data[10];?>" placeholder="Pan No" class="w3-input w3-border w3-round">                                    
							</div>		
						</div>
						<form class="wh w3-left" method="post" enctype="multipart/form-data">		
                        	<div class="w3-row-padding w3-margin-bottom"> 								
                            	<div class="w3-col m12 l12 w3-margin-top">
									<b class='w3-text-blue w3-medium'>UPDATE INFORMATION</b>                               
                                </div>		
                                
                            	<div class="w3-col m12 l12 w3-margin-top">
                                	<label>RESIDENTIAL ADDRESS</label>	
                                	<input type="text" id="padd" name="padd" value="<?php echo $kyc_data[2];?>" placeholder="Address" class="w3-input w3-border w3-round">                                    
                                </div>		
                                
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>STATE</label>	
                                	<select class="w3-select w3-border w3-round" id="states" name="states" onchange="show_dist()">
									<option value='' disabled>Select state</option>
									<?php
									include_once('../zf-State.php');
									$state_result=show_all_states();
									while($state_row=mysql_fetch_array($state_result))
									{
										if($kyc_data[6]==$state_row['state_id'])
										{
											echo "<option value='".$state_row['state_id']."' selected>".$state_row['state_name']."</option>";
										}
										else
										{
											echo "<option value='".$state_row['state_id']."'>".$state_row['state_name']."</option>";
										}
									}
									?>
                                    </select>                               
                                </div>	
                                
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>DISTRICT</label>	
                                	<select class="w3-select w3-border w3-round" id="districts" name="districts">
										<option value='' disabled>Select district</option>
									<?php
									include_once('../zf-Districts.php');
									$district_result=show_all_districts_of_state($kyc_data[6]);
									while($district_row=mysql_fetch_array($district_result))
									{
										if($kyc_data[5]==$district_row['distt_id'])
										{
											echo "<option value='".$district_row['distt_id']."' selected>".$district_row['distt_name']."</option>";
										}
										else
										{
											echo "<option value='".$district_row['distt_id']."'>".$district_row['distt_name']."</option>";
										}
									}
									?>
                                    </select>                                
                                </div>		
                                
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>CITY</label>	
                                	<input type="text" id="pcity" name="pcity" value="<?php echo $kyc_data[4];?>" placeholder="City" class="w3-input w3-border w3-round">                                    
                                </div>		
                                		
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>AREA PINCODE</label>	
                                	<input type="text" onkeyup="getGEO()" value="<?php echo $kyc_data[7];?>" placeholder="Pincode" name="pincode" id="pincode" class="w3-input w3-border w3-round">                                    
                                </div>			
                            	                      	
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>E-MAIL</label>
                                	<input type="text" id="pemail" name="pemail" value="<?php echo $kyc_data[1];?>" placeholder="E-Mail" class="w3-input w3-border w3-round">                                    
                                </div>	
                                
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>DATE OF BIRTH</label>	
                                	<input type="date" id="pdob" name="pdob" value="<?php echo $kyc_data[11];?>" placeholder="Date of Birth" class="w3-input w3-border w3-round">                                    
                                </div>		
                                
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>GENDER</label>	
                                	<select id="pgender" name="pgender" class="w3-input w3-border w3-round">
										<?php
											$gensel="";
											$malesel="";
											$femalesel="";
											$transgensel="";
											if($kyc_data[8]==1)
												$malesel="selected";
											else if($kyc_data[8]==0)
												$femalesel="selected";
											else if($kyc_data[8]==-1)
												$transgensel="selected";
											else
												$gensel="selected";
											
											echo "<option value='' $gensel>Gender</option>";
											echo "<option value='1' $malesel>Male</option>";
											echo "<option value='0' $femalesel>Female</option>";
											echo "<option value='-1' $transgensel>Trans Gender</option>";
										?>
										
									</select>                                                                  
                                </div>		
								
                            	<div class="w3-col m12 l12 w3-margin-top">
									<b class='w3-text-blue w3-medium'>BUSINESS INFORMATION </b><b class='w3-text-red w3-medium'>(optional)</b>
                                </div>	
								
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>BUSINESS NAME</label>	
                                	<input type="text" id="bsname" name="bsname" value="<?php echo $kyc_data[13];?>" placeholder="Business Name" class="w3-input w3-border w3-round">                                    
                                </div>
                                
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>GST NO</label>	
                                	<input type="text" id="bsgst" name="bsgst" value="<?php echo $kyc_data[16];?>" placeholder="GST No" class="w3-input w3-border w3-round">                                    
                                </div>	
                            	                      	
                                <div class="w3-col m6 l12 w3-margin-top">
                                	<label>BUSINESS ADDRESS</label>
                                	<input type="text" id="bsadd" name="bsadd" value="<?php echo $kyc_data[14];?>" placeholder="Business Address" class="w3-input w3-border w3-round">                                    
                                </div>	
								
                            	<div class="w3-col m12 l12 w3-margin-top">
									<b class='w3-text-blue w3-medium'>UPLOAD KYC DOCS</b><b class='w3-text-red w3-medium'>(JPG/JPEG/PNG only less than 250 KB each)</b>
                                </div>	
                                
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>PAN CARD NO</label>	
                                	<input type="file" id="filepan" name="filepan" class="w3-input w3-border w3-round">
                                </div>	
                                
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>PASSPORT SIZE PIC</label>	
                                	<input type="file" id="filepic" name="filepic" class="w3-input w3-border w3-round">
                                </div>	
                                
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>AADHAR CARD FRONT</label>	
                                	<input type="file" id="fileaadharfront" name="fileaadharfront" class="w3-input w3-border w3-round">
                                </div>	
                                
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>AADHAR CARD BACK</label>	
                                	<input type="file" id="fileaadharback" name="fileaadharback" class="w3-input w3-border w3-round">
                                </div>	
								
								<div class="w3-col m6 l12 w3-margin-top">
                                	<label>&nbsp;</label>
									<input type="button" onclick="check_values()" value="Update KYC" class="w3-input w3-border w3-round w3-button w3-blue w3-w150 w3-right">
									<button onclick="check_values()" name="UpdateKYC" id="UpdateKYC" class="w3-button w3-round-small w3-right w3-blue display-none">UpdateKYC</button>
                                </div>
							</div>
						</form>
                    </div>
                </div>  
            </div>
        <!--</div>-->
    </section>
	
  <div id="error-box" class="w3-modal">
    <div class="w3-modal-content w3-animate-zoom w3-card-4 w3-round list-pop">
      <header class="w3-container w3-blue"> 
        <span onclick="document.getElementById('error-box').style.display='none';" class="w3-button w3-display-topright"><img src="../img/close.png" style="margin-bottom:0px;"></span>
        <h3 class="w3-center" id="error-title"></h3> 
      </header> 
      <div class="w3-container w3-center">
      	<p id="error-message" class='w3-left-align'></p>
      </div> 
        <div class="w3-container" style="margin-bottom:10px;">
            <div class="w3-bar w3-center">
                <a id="ViewServlet" onclick="updatekyc()" class="w3-button w3-green w3-round">Accept &amp; Confirm</a>
                <a id="ButtonFirst" onclick="document.getElementById('error-box').style.display='none';" class="w3-button w3-blue w3-round">OK</a>
                <a id="ButtonSecond" onclick="document.getElementById('error-box').style.display='none';" class="w3-button w3-orange w3-round">Do it later</a>
            </div> 
        </div> 
    </div>
  </div>
       
    <?php include_once('_footer.php');?>

</body>
</html> 
