<!DOCTYPE html>
<html>
<head>
<?php include_once('_all-inner-pages-html-title.php'); ?>
<script type="text/javascript" src="../js/admin-validation-functions.js"></script>
<!--date picker-->
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js"></script> 
<link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet"> -->
<!--date picker-->    
<?php include_once('../zc-session-admin.php'); ?>
<?php //if($logged_tpin==1234) { header('location: MyChangeTpinServlet'); } ?>
<script>
$(document).ready(function(){
	$(".search-icon").click(function(){
	$(".search-show").toggleClass("s-show");
	});
	
	$(".them").click(function(){
	$(".them ul").toggleClass("them-top");
	});
});
</script>
<script>
$(document).ready(function(){

	$('html, body').animate({
		scrollTop: $("#SenderInfoDetails").offset().top
	}, 1500);
	
	$("#bt1").click(function() {
		$('html, body').animate({
			scrollTop: $("#ListBen").offset().top
		}, 1500);
	});
	
	$("#bt2").click(function() {
		$('html, body').animate({
			scrollTop: $("#RegBen").offset().top
		}, 1500);
	});
	
	$("#btnav").click(function() {
		$('html, body').animate({
			scrollTop: $("#SenderData").offset().top
		}, 1500);
	});
	
	$("#btnawv").click(function() {
		$('html, body').animate({
			scrollTop: $("#SenderData").offset().top
		}, 1500);
	});
	
	$("#btnawv3").click(function() {
		$('html, body').animate({
			scrollTop: $("#SenderData").offset().top
		}, 1500);
	});
	
	$("#btnmt").click(function() {
		$('html, body').animate({
			scrollTop: $("#ListTrans").offset().top
		}, 1500);
	});
/*
	for(i=1;i<=20;i++)
	{
		$('#sel'+i).click(function() {
			$('html, body').animate({
				scrollTop: $("#TransMoney").offset().top
			}, 1500);
		});
	}*/
	/*
	<?php
	for($i=1;$i<=20;$i++)
	{
	?>
		$('#sel<?php echo $i;?>').click(function() {
			$('html, body').animate({
				scrollTop: $("#TransMoney").offset().top
			}, 1500);
		});
	<?php
	}
	?>*/
	
});
</script>
<script>
var click=0;
var clickxls=0;
function pullBankType(tp)
{
	var banktype=$("#banktype").val();
	$.ajax({
		type: "POST",
		url: "../AjaxShowBankByType.php",
		data: {'banktype': banktype , 'tp': tp },
		dataType: "json",
	 
		//if received a response from the server
		success: function( data, textStatus, jqXHR) {
			//our country code was correct so we have some information to display/
			//alert(data);
			$("#bankCode").html(data);
		}	 
	});
}
function verify_acc(cno,cname,bname,acc,ifsc,benefid)
{
	clickxls++;
	if(clickxls==1)
	{
		document.getElementById("cno123").value=cno;
		document.getElementById("cname123").value=cname;
		document.getElementById("bname123").value=bname;
		document.getElementById("acc123").value=acc;
		document.getElementById("ifsc123").value=ifsc;
		document.getElementById("benefid123").value=benefid;
		$("#btnav3").click();
	}
}
function generate_transaction()
{
	var abcd=invalid_tpin();
	if(abcd==1)
	{
		click++;
		if(click==1)
		$("#TransferMoney").click();
	}
}
function selectBenTrans()
{
	$('html, body').animate({
		scrollTop: $("#TransMoney").offset().top
	}, 1500);
}
function invalid_tpin()
{
	var t1=$("#tpin1").val();
	var t2=$("#tpin2").val();
	var t3=$("#tpin3").val();
	var t4=$("#tpin4").val();
	var tpin=t1+""+t2+""+t3+""+t4;
	if(check_tpin(tpin)=="0" || tpin=="")
	{
		$("#error-box").hide();
		$("#error-title").html("Required Fileds/Values");
		$("#error-message").html("Invalid T-PIN");
		$("#ButtonFirst").hide();
		$("#ButtonSecond").hide();
		$("#ViewServlet").hide();
		$("#error-box").show();
		return 0;
	}
	else
	{
		return 1;
	}
}
function check_tpin(tpin) {
    //line added for the var that will have the result
    var result = 0;
    $.ajax({
        type: "POST",
        url: '../AjaxCheckTpin.php',
        data: ({'tpin': tpin}),
        dataType: "json",
        //line added to get ajax response in sync
        async: false,
        success: function(data) {
            //line added to save ajax response in var result
            result = data;
        },
        error: function() {
        }
    });
    //line added to return ajax response
    return result;
}
function check_values() {
	var cno=$("#cno").val();
	var cname=$("#cname").val();
	var bno=$("#bno").val();
	var bname=$("#bname").val();
	var bbname=$("#bbname").val();
	var bacc=$("#bacc").val();
	var brid=$("#brid").val();
	var transamount=$("#transamount").val();
	var method=$("#method").val();
	var charges=$("#charges").val();
	var charged=$("#charged").val();
	var transfer_value=$("#transfer_value").html();
	
	var error_message="";
	
	if(isEmpty(cno)==1)
		error_message+="<li>Select Sender.</li>";
	if(isEmpty(brid)==1)
		error_message+="<li>Select Beneficiary.</li>";
	if(isEmpty(method)==1)
		error_message+="<li>Select Transfer Method.</li>";
	if(isEmpty(transamount)==1 || transamount==0)
		error_message+="<li>Amount should not be blank/zero.</li>";
	if(isNumeric(transamount)==1)
		error_message+="<li>Mobile Number should have number only.</li>";
	if(isEmpty(charges)==1 || transamount==0)
		error_message+="<li>SurCharges should not be blank/zero.</li>";
	if(isNumeric(transamount)==1)
		error_message+="<li>SurCharges should have number only.</li>";
	if(isEmpty(charged)==1 || transamount==0)
		error_message+="<li>Commission Charged should not be blank/zero.</li>";
	if(isNumeric(transamount)==1)
		error_message+="<li>Commission Charged should have number only.</li>";
	if(transfer_value!="")
		error_message+="<li>"+transfer_value+"</li>";
	
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
		$("#error-title").html("Confirmation");
		var method_name="";
		method=$("#method").val();
		if(method==1)
			method_name="NEFT";
		if(method==2)
			method_name="IMPS";
		
		transamount=$("#transamount").val();
		charges=$("#charges").val();
		charged=$("#charged").val();
		var totals=parseFloat(transamount)+parseFloat(charged);
		/*
		var charges2=(charges/118)*100;
		charges2=freeze_2place(charges2);
		var gst2=charges-charges2;
		
		var gst=0;
		var tds=0;
		var earned=0;
		var totals=0;
		gst=charged-charges;
		gst=(gst/118)*18;
		gst2=gst2+gst;
		gst2=freeze_2place(gst2);
		tds=(charged-charges-gst)*.05;
		tds=freeze_2place(tds);
		earned=(charged-charges-gst)*.95;
		earned=freeze_2place(earned);
		
		totals=parseFloat(transamount)+parseFloat(charged)+parseFloat(charges*0.18);
		totals=transamount+charges;
		totals=freeze_2place(totals);
		charges2=charged-gst2;
		charges2=freeze_2place(charges2);
		
		var new_comm=(charged-charges)*.82;
		new_comm=freeze_2place(new_comm);
		
		var tgst=freeze_2place(parseFloat(charges*0.18));
		*/
		var conf="";
		conf+="<table cellpadding='2' cellspacing='0'>";
		conf+="<tr>";
			conf+="<td align='left'>Sender Name</td><td align='right'>"+cname+"</td>";
		conf+="</tr>";
		conf+="<tr>";
			conf+="<td align='left'>Sender Mobile</td><td align='right'>"+cno+"</td>";
		conf+="</tr>";
		conf+="<tr>";
			conf+="<td align='left'>Beneficiary Name</td><td align='right'>"+bname+"</td>";
		conf+="</tr>";
		conf+="<tr>";
			conf+="<td align='left'>Beneficiary Mobile</td><td align='right'>"+bno+"</td>";
		conf+="</tr>";
		conf+="<tr>";
			conf+="<td align='left'>Bank Name</td><td align='right'>"+bbname+"</td>";
		conf+="</tr>";
		conf+="<tr>";
			conf+="<td align='left'>Bank Account No</td><td align='right'>"+bacc+"</td>";
		conf+="</tr>";
		conf+="<tr>";
			conf+="<td align='left'>Transfer Method</td><td align='right'>"+method_name+"</td>";
		conf+="</tr>";
		conf+="<tr>";
			conf+="<td align='left'>Amount</td><td align='right'>"+transamount+"</td>";
		conf+="</tr>";
		/*
		conf+="<tr>";
			conf+="<td align='left'>SurCharges</td><td align='right'>"+charges2+"</td>";
		conf+="</tr>";
		conf+="<tr>";
			conf+="<td align='left'>GST Deducted</td><td align='right'>"+gst2+"</td>";
		conf+="</tr>";
		*/
		conf+="<tr>";
			conf+="<td align='left'>Charges</td><td align='right'>"+charged+"</td>";
		conf+="</tr>";
		/*
		conf+="<tr>";
			conf+="<td align='left'>GST</td><td align='right'>"+tgst+"</td>";
		conf+="</tr>";
		*/
		conf+="<tr bgcolor='#e5e5e5'>";
			conf+="<td align='left'><b>Total Deduction</b></td><td align='right'><b>"+totals+"</b></td>";
		conf+="</tr>";
		/*
		conf+="<tr>";
			conf+="<td align='left'>TDS Deducted</td><td align='right'>"+tds+"</td>";
		conf+="</tr>";
		conf+="<tr>";
			conf+="<td align='left'>Commission Earned</td><td align='right'>"+earned+"</td>";
		conf+="</tr>";
		conf+="<tr class='display-none'>";
			conf+="<td align='left'>Commission Earned</td><td align='right'>"+new_comm+"</td>";
		conf+="</tr>";
		*/
		conf+="<tr>";
			conf+="<td align='left'>T-PIN &nbsp;<a class='w3-tiny w3-right w3-text-blue' onclick='clear_tpin()'>Reset T-PIN</a></td><td align='right'>";
				conf+="<input id='tpin1' onclick='clear_tpin()' onkeyup='keyonechar(1,this)' type='password' required class='w3-input w3-border w3-round tpin w3-left' ";
				conf+="value='' autocomplete='off' autocomplete='false'>";
				conf+="<input id='tpin2' onkeyup='keyonechar(2,this)' type='password' required class='w3-input w3-border w3-round tpin w3-left' ";
				conf+="value='' autocomplete='off' autocomplete='false'>";
				conf+="<input id='tpin3' onkeyup='keyonechar(3,this)' type='password' required class='w3-input w3-border w3-round tpin w3-left' ";
				conf+="value='' autocomplete='off' autocomplete='false'>";
				conf+="<input id='tpin4' onkeyup='keyonechar(4,this)' type='password' required class='w3-input w3-border w3-round tpin w3-left' ";
				conf+="value='' autocomplete='off' autocomplete='false'>";
			conf+="</td>";
		conf+="</tr>";
		conf+="</table>";
		$("#error-message").html(conf);
		$("#ButtonFirst").hide();
		$("#ButtonSecond").show();
		$("#ViewServlet").show();
		$("#error-box").show();
		$("#tpin1").focus();
		return true;
	}
}
function clear_tpin()
{
	document.getElementById('tpin1').value='';
	document.getElementById('tpin2').value='';
	document.getElementById('tpin3').value='';
	document.getElementById('tpin4').value='';
	document.getElementById('tpin1').focus();
}
function keyonechar(name,obj)
{
	var value=obj.value;
	if(name==1)
	{
		if(value.length==1)
			document.getElementById('tpin2').focus();
		else
		{
			document.getElementById('tpin1').value=value.charAt(0);
			if(document.getElementById('tpin1').value!='')
			document.getElementById('tpin2').focus();
		}
	}
	if(name==2)
	{
		if(value.length==1)
			document.getElementById('tpin3').focus();
		else
		{
			document.getElementById('tpin2').value=value.charAt(0);
			if(document.getElementById('tpin2').value!='')
			document.getElementById('tpin3').focus();
		}
	}
	if(name==3)
	{
		if(value.length==1)
			document.getElementById('tpin4').focus();
		else
		{
			document.getElementById('tpin3').value=value.charAt(0);
			if(document.getElementById('tpin3').value!='')
			document.getElementById('tpin4').focus();
		}
	}
	if(name==4)
	{
		if(value.length!=1)
		{
			document.getElementById('tpin4').value=value.charAt(0);
		}
		invalid_tpin();
	}
}
function searchIFSC()
{
		window.open('search-ifsc.php','Search IFSC Code','directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=620,height=800');
}
function pullIFSC()
{
	var bid=document.getElementById("bankCode").value;
	var ifsc_status=bid.split("@")[2];
	bid=bid.split("@")[0];
	$.ajax({
		type: "POST",
		url: "../AjaxPullIfsc.php",
		data: {'bid': bid },
		dataType: "json",
	 
		//if received a response from the server
		success: function( data, textStatus, jqXHR) {
			//our country code was correct so we have some information to display/
			var vals=data.split("@");
			
			if(ifsc_status==1 || ifsc_status==3)
			{
				document.getElementById('IFSCCoder').style.display='none';
				//document.getElementById('sifsc').style.display='none';
				document.getElementById("ifscCode").value=vals[0];
				if(vals[0]=="")
				document.getElementById("ifscCode").value="ABCD1234567";
			}
			else
			{
				document.getElementById("ifscCode").value='';
				document.getElementById('IFSCCoder').style.display='block';
				//document.getElementById('sifsc').style.display='block';
			}
			
			if(vals[1]==0)
			{
				document.getElementById('verifyaccountbtn').style.display="none";
			}
			else
			{
				document.getElementById('verifyaccountbtn').style.display="block";
			}
		}	 
	});
}
function pullIFSC3()
{
	var bid=document.getElementById("bankCode").value;
	var ifsc_status=bid.split("@")[4];
	if(ifsc_status!="")
	{
		document.getElementById("ifscCode").value=ifsc_status;
		document.getElementById('IFSCCoder').style.display='block';
	}
	else
	{
		document.getElementById("ifscCode").value=ifsc_status;
		document.getElementById('IFSCCoder').style.display='block';
	}
}
function delete_beneficiary(sender,receiver)
{
	$.ajax({
		type: "POST",
		url: "../AjaxDeleteBeneficiary.php",
		data: {'sender': sender, 'receiver': receiver },
		dataType: "json",
	 
		//if received a response from the server
		success: function( data, textStatus, jqXHR) {
			//our country code was correct so we have some information to display/
			//var vals=data.split("@");
			document.location.href='ServiceDmtServlet?cno='+sender+'&channel1=Search&msg=done';
		}	 
	});
}
function delete_beneficiary3(sender,receiver,acc)
{
	$.ajax({
		type: "POST",
		url: "../AjaxDeleteBeneficiary3.php",
		data: {'sender': sender, 'receiver': receiver, 'acc': acc },
		dataType: "json",
	 
		//if received a response from the server
		success: function( data, textStatus, jqXHR) {
			//our country code was correct so we have some information to display/
			//var vals=data.split("@");
			document.location.href='ServiceDmtServlet?cno='+sender+'&channel2=Search&msg=done';
		}	 
	});
}
function transm(receiver,rname,rnum,rbank,racc)
{
	document.getElementById('bname').value=rname;
	document.getElementById('bno').value=rnum;
	document.getElementById('bbname').value=rbank;
	document.getElementById('bacc').value=racc;
	document.getElementById('brid').value=receiver;
	document.getElementById('sourcemt').value=1;
	$.ajax({
		type: "POST",
		url: "../AjaxCheckTransferMethod.php",
		data: {'receiver': receiver },
		dataType: "json",
	 
		//if received a response from the server
		success: function( data, textStatus, jqXHR) {
			var resulted="<select onchange='change_method()' required class='w3-select w3-border w3-round' id='method' name='method'><option value='' selected>Choose your option</option>";
			if(data==1)
				resulted+="<option value='1'>NEFT</option>";
			else if(data==2)
				resulted+="<option value='2'>IMPS</option>";
			else
				resulted+="<option value='2'>IMPS</option><option value='1'>NEFT</option>";
			resulted+="</select>";
			document.getElementById('method').innerHTML=resulted;
			document.getElementById('TransMoney').style.display='block';
			document.getElementById("transfer_value").innerHTML='';
		}	 
	});
	selectBenTrans();
}
function transm3(receiver,rname,rnum,rbank,racc,ifsc)
{
	document.getElementById('bname').value=rname;
	document.getElementById('bno').value=rnum;
	document.getElementById('bbname').value=rbank;
	document.getElementById('bacc').value=racc;
	document.getElementById('brid').value=receiver;
	document.getElementById('sourcemt').value=5;
	document.getElementById('benmobnomt').innerHTML="Sender's Mobile Number";
	$.ajax({
		type: "POST",
		url: "../AjaxCheckTransferMethod3.php",
		data: {'ifsc': ifsc },
		dataType: "json",
	 
		//if received a response from the server
		success: function( data, textStatus, jqXHR) {
			var resulted="<select onchange='change_method3()' required class='w3-select w3-border w3-round' id='method' name='method'>";
			resulted+="<option value='' selected>Choose your option</option>";
			if(data==1)
				resulted+="<option value='1'>NEFT</option>";
			else if(data==2)
				resulted+="<option value='2'>IMPS</option>";
			else
				resulted+="<option value='2'>IMPS</option><option value='1'>NEFT</option>";
			resulted+="</select>";
			document.getElementById('method').innerHTML=resulted;
			document.getElementById('TransMoney').style.display='block';
			document.getElementById("transfer_value").innerHTML='';
		}	 
	});
	selectBenTrans();
}
function display_rate(uid,sid,method,amount)
{
	var charged=document.getElementById("charged").value;
	$.ajax({
		type: "POST",
		url: "../AjaxUserMargin.php",
		data: {'uid': uid, 'sid': sid, 'method': method, 'amount': amount },
		dataType: "json",
	 
		//if received a response from the server
		success: function( data, textStatus, jqXHR) {
			if(amount<=1000)
			{
				charged=10;
				charges=10;
			}
			else if(amount<=2000)
			{
				charged=amount*.01;
				charges=10;
			}
			else
			{
				charged=amount*.01;
				charges=data*1.18;
			}
			document.getElementById("charges").value=charges;
			document.getElementById("tgst").value=freeze_2place(parseFloat(charged*0.18));
			document.getElementById("gtotal").value=freeze_2place(parseFloat(amount)+parseFloat(charged));
			document.getElementById("charged").value=charged;
		}	 
	});
}
function change_method()
{
	var method=document.getElementById("method").value;
	var neft=document.getElementById("neftlimit").value;
	var imps=document.getElementById("impslimit").value;
	if(method==1)
		method=2;
	neft=parseInt(neft);
	imps=parseInt(imps);
	var transfer_value="";
	if(method==1)
		transfer_value="<b class='w3-text-red'>TRANSFER LIMIT : min 100 max "+neft+"</b>";
	if(method==2)
		transfer_value="<b class='w3-text-red'>TRANSFER LIMIT : min 100 max "+imps+"</b>";
	document.getElementById("transfer_value").innerHTML=transfer_value;
	var amount=document.getElementById("transamount").value;
	var uid=document.getElementById("uid").value;
	var sid=1;
	if(amount=="")
		amount=0;
	display_rate(uid,sid,method,amount);
}
function change_method3()
{
	var method=document.getElementById("method").value;
	var neft=document.getElementById("neftlimit").value;
	var imps=document.getElementById("impslimit").value;
	if(method==1)
		method=2;
	neft=parseInt(neft);
	imps=parseInt(imps);
	if(imps<neft)
	imps=neft;
	var transfer_value="";
	if(method==1)
		transfer_value="<b class='w3-text-blue'>NEFT TRANSFER LIMIT : min 100 max "+neft+"</b>";
	if(method==2)
		transfer_value="<b class='w3-text-green'>IMPS TRANSFER LIMIT : min 100 max "+imps+"</b>";
	document.getElementById("transfer_value").innerHTML=transfer_value;
	var amount=document.getElementById("transamount").value;
	var uid=document.getElementById("uid").value;
	var sid=5;
	if(amount=="")
		amount=0;
	display_rate(uid,sid,method,amount);
}
function calc_ded()
{
    var chnl=document.getElementById("chnl").value;
    if(chnl==1)
	change_method();
    if(chnl==3)
	change_method3();
	var method=document.getElementById("method").value;
	if(method=="")
	{
		check_values();
	}
	else if(method!="")
	{
		checkLimit();
		var amount=document.getElementById("transamount").value;
		var charges=document.getElementById("charges").value;
		var charged=document.getElementById("charged").value;
		if(amount=="")
			amount=0;
		if(charged=="")
			charged=0;
		if(amount<=1000)
		{
			charged=10;
			charges=10;
		}
		else if(amount<=2000)
		{
			charged=amount*.01;
			charges=10;
		}
		else
		{
			charged=amount*.01;
			charges=charges*1.18;
		}
		document.getElementById("charges").value=charges;
		document.getElementById("tgst").value=freeze_2place(parseFloat(charged*0.18));
		document.getElementById("gtotal").value=freeze_2place(parseFloat(amount)+parseFloat(charged));
		document.getElementById("charged").value=charged;
	}
}
function calc_ded2()
{
	calc_ded();
	check_values();
}
function checkLimit()
{
	var transfer_value="";
	var amount=document.getElementById("transamount").value;
	var method=document.getElementById("method").value;
	var neft=document.getElementById("neftlimit").value;
	var imps=document.getElementById("impslimit").value;
	var chnl=document.getElementById("chnl").value;
	if(method==1)
		method=2;
	neft=parseInt(neft);
	imps=parseInt(imps);
	if(chnl==3 && imps<neft)
	imps=neft;
	if(amount=="")
		amount=0;
	if(method==2 && (amount<100 || amount>imps))
	{
		transfer_value="<b class='w3-text-red'>Please fill amount between 100 and "+imps+"</b>";
	}
	if(method==1 && (amount<100 || amount>neft))
	{
		transfer_value="<b class='w3-text-red'>Please fill amount between 100 and "+neft+"</b>";
	}
	document.getElementById("transfer_value").innerHTML=transfer_value;	
}
function freeze_2place(val_old)
{
	var val_new=val_old.toFixed(2);
	return val_new;
}
</script>

</head>
<body>

	<?php include_once('_header.php'); ?>
	<?php
	$sndrno="";
	$sndrnm="";
	$msg="";
	$msg2="";
	//if(isset($_GET['cno']))
		//$sndrno=$_GET['cno'];
	if(isset($_REQUEST['cno']))
		$sndrno=$_REQUEST['cno'];
	//if(isset($_GET['msg']))
		//$msg=$_GET['msg'];
	if(isset($_REQUEST['msg']))
		$msg=$_REQUEST['msg'];
	//if(isset($_GET['msg2']))
		//$msg2=$_GET['msg2'];
	if(isset($_REQUEST['msg2']))
		$msg2=$_REQUEST['msg2'];
	
	if(isset($_POST['btnawv']))
	{		
		$rmno=$_POST['cno'];
		$benef_rmno=$_POST['bno'];
		$benef_rmname=$_POST['bname'];
		$benef_bankaccno=$_POST['bacc'];
		$benef_bankifsccode=$_POST['bifsc'];
		
		$bnks=$_POST['bbnk'];
		$bnks=explode("@",$bnks);
		$benef_bankid=$bnks[0];
		$benef_bankcode=$bnks[1];
		$benef_ifsc_status=$bnks[2];
		$bbname=$bnks[3];
		
		$recipient_name=$benef_rmname;
		$recipient_mobile=$benef_rmno;
		$cust_id=$rmno;
		
		include_once('../zf-TxnSource1DmtApi.php');
		$result_beneficiary_add=add_beneficiary_without_verify($cust_id,$recipient_mobile,$recipient_name,$benef_bankaccno,$benef_bankifsccode,$benef_ifsc_status,$benef_bankid,$benef_bankcode);
		$msg="";
		if($result_beneficiary_add[1]==342 && $result_beneficiary_add[2]==-1 && $result_beneficiary_add[3]==0)
		{
			echo "<script>document.location.href='ServiceDmtServlet?cno=$rmno&channel1=Search'</script>";
		}
		else if($result_beneficiary_add[1]==43 && $result_beneficiary_add[3]==0)
		{
			echo "<script>document.location.href='ServiceDmtServlet?cno=$rmno&channel1=Search'</script>";
		}
		else
		{
			$msg=$result_beneficiary_add[0];
			echo "<script>document.location.href='ServiceDmtServlet?cno=$rmno&channel1=Search&msg=$msg'</script>";
		}
	}
	if(isset($_POST['btnawv3']))
	{		
		$rmno=$_POST['cno'];
		$benef_rmno=$_POST['bno'];
		$benef_rmname=$_POST['bname'];
		$benef_bankaccno=$_POST['bacc'];
		$benef_bankifsccode=$_POST['bifsc'];
		
		$bnks=$_POST['bbnk'];
		$bnks=explode("@",$bnks);
		$benef_bankcode=$bnks[1];
		
		$recipient_name=$benef_rmname;
		$recipient_mobile=$benef_rmno;
		$cust_id=$rmno;
		
		include_once('../zf-TxnSource3DmtApi.php');
		$result_beneficiary_add=add_beneficiary_without_verify2($cust_id,$recipient_name,$benef_bankaccno,$benef_bankifsccode,$benef_bankcode);
		$msg="";
		if($result_beneficiary_add[0]==0)
		{
			echo "<script>document.location.href='ServiceDmtServlet?cno=$rmno'</script>";
		}
		else
		{
			$msg=$result_beneficiary_add[1];
			echo "<script>document.location.href='ServiceDmtServlet?cno=$rmno&channel2=Search&msg=$msg'</script>";
		}
	}
	if(isset($_POST['btnav3']))
	{	
		$uid=$_SESSION['logged_user_id'];
		$cno=$_POST['cno123'];
		$cname=$_POST['cname123'];
		$bno=$cno;
		$bname=$_POST['bname123'];
		$acc=$_POST['acc123'];
		$ifsc=$_POST['ifsc123'];
		$benefid=$_POST['benefid123'];
		
		//$bnks=$_POST['bbnk'];
		//$bnks=explode("@",$bnks);
		$bbankid=0;
		//$benef_bankcode=$bnks[1];
		//$benef_ifsc_status=$bnks[2];
		$bbname=substr($ifsc,0,4);
		$pan=$user_txn_panno;
		$aadhar=$user_txn_aadhar;
		include_once('../zf-WalletTxnDmt.php');
		$is_verified_previously=is_verified($cno,$acc);
		$result_beneficiary_add=array(0,"done");
		if($is_verified_previously=="0")
		{
			$result_beneficiary_add=txn_add_benificiary($uid, $cno, $cname, $bno, $bname, $bbname, $acc, $ifsc, $bbankid, 5, 2, 2, $pan, $aadhar);//, 5, 0, 0);
			$recipient_name=$result_beneficiary_add[5];
			if($recipient_name=="" || $recipient_name=="No_Value_From_Bank")
				$recipient_name=$bname;
			$benef_bankcode=substr($ifsc,0,4);
			include_once('../zf-TxnSource3DmtApi.php');
			//remove_beneficiary2($cno,$benefid);
			//$result_beneficiary_add=add_beneficiary_without_verify2($cno,$recipient_name,$acc,$ifsc,$benef_bankcode);
		}
		else
		{
			$recipient_name=$is_verified_previously;
			if($uid=="100100")
			txn_add_benificiary_verfied_100100($uid, $cno, $cname, $bno, $recipient_name, $bbname, $acc, $ifsc, $bbankid, 5, 2, 2, $pan, $aadhar);//, 5, 0, 0);
			else
			txn_add_benificiary_verfied($uid, $cno, $cname, $bno, $recipient_name, $bbname, $acc, $ifsc, $bbankid, 5, 2, 2, $pan, $aadhar);//, 5, 0, 0);
		}
		$msg="";
		if($result_beneficiary_add[0]==0)
		{
			echo "<script>document.location.href='ServiceDmtServlet?cno=$cno'</script>";
		}
		else
		{
			$msg=$result_beneficiary_add[1];
			echo "<script>document.location.href='ServiceDmtServlet?cno=$cno&channel2=Search&msg=$msg'</script>";
		}
	}
	if(isset($_POST['btnav']))
	{
		$uid=$_POST['uid'];
		$cno=$_POST['cno'];
		$cname=$_POST['cname'];
		$bno=$_POST['bno'];
		$bname=$_POST['bname'];
		$bacc=$_POST['bacc'];
		$bifsc=$_POST['bifsc'];
		
		$bnks=$_POST['bbnk'];
		$bnks=explode("@",$bnks);
		$bbankid=$bnks[0];
		$benef_bankcode=$bnks[1];
		$benef_ifsc_status=$bnks[2];
		$bbname=$bnks[3];
		include_once('../zf-WalletTxnDmt.php');
		$result_beneficiary_add=txn_add_benificiary($uid, $cno, $cname, $bno, $bname, $bbname, $bacc, $bifsc, $bbankid, 1, 2, 2, $pan, $aadhar);//, 5, 0, 0);
		include_once('../zf-TxnSource1DmtApi.php');
		$result_beneficiary_add=add_beneficiary_without_verify($cno,$bno,$bname,$bacc,$bifsc,$benef_ifsc_status,$bbankid,$benef_bankcode);
		$msg="";
		if($result_beneficiary_add[1]==342 && $result_beneficiary_add[2]==-1 && $result_beneficiary_add[3]==0)
		{
			echo "<script>document.location.href='ServiceDmtServlet?cno=$cno&channel1=Search'</script>";
		}
		else if($result_beneficiary_add[1]==43 && $result_beneficiary_add[3]==0)
		{
			echo "<script>document.location.href='ServiceDmtServlet?cno=$cno&channel1=Search'</script>";
		}
		else
		{
			$msg=$result_beneficiary_add[0];
			echo "<script>document.location.href='ServiceDmtServlet?cno=$cno&channel1=Search&msg=$msg'</script>";
		}
	}
	if(isset($_POST['TransferMoney']))
	{
		$uid=$_POST['uid'];
		$cno=$_POST['cno'];
		$cname=$_POST['cname'];
		$brid=$_POST['brid'];
		$bno=$_POST['bno'];
		$bname=$_POST['bname'];
		$bbname=$_POST['bbname'];
		$bacc=$_POST['bacc'];
		$sourcemt=$_POST['sourcemt'];
		
		if($sourcemt==1)
		{
			include_once('../zf-BeneficiaryBankinfo.php');
			$bifsc=show_beneficiary_ifsc($brid);
			$bbankid=show_beneficiary_bankid($brid);
			
			$source=1;
			$type=1;
			$method=$_POST['method'];
			$transamount=$_POST['transamount'];
			$charges321=$_POST['charges'];//*1.18;
			$charged321=$_POST['charged'];
			
			if($charged321<$charges321)
				$charged321=$charges321;
			$doctype=$user_txn_doctype;
			$docid=$user_txn_docid;
			$areapincode=$user_txn_areapincode;
			$geo=$user_txn_geo;//.",818";
			
			include_once('../zf-WalletTxnDmt.php');
			$result_transaction=txn_fund_transfer($uid, $cno, $cname, $brid, $bno, $bname, $bbname, $bacc, $bifsc, $bbankid, $source, $type, $method, $transamount, $charges321, $charged321, $doctype, $docid, $areapincode, $geo);
			include_once('../zf-TxnSource1DmtApi.php');
			find_sender($logged_user_id,$cno);
			if($result_transaction!="")
			{
				$msg=$result_transaction;
				echo "<script>document.location.href='ServiceDmtServlet?cno=$cno&channel1=Search&msg2=$msg'</script>";
			}
			else
			{
				echo "<script>document.location.href='TxnServiceDmtServlet'</script>";
			}
		}		
		if($sourcemt==5)
		{
			include_once('../zf-BeneficiaryBankinfo.php');
			$bifsc=show_beneficiary_ifsc($brid);
			$bbankid=0;
			$bno=$cno;
			
			$source=5;
			$type=1;
			$method=$_POST['method'];
			$transamount=$_POST['transamount'];
			$charges321=$_POST['charges'];//*1.18;
			$charged321=$_POST['charged'];
			//$charged321=$charges321;
			
			if($charged321<$charges321)
				$charged321=$charges321;
			$pan=$user_txn_panno;
			$aadhar=$user_txn_aadhar;

			include_once('../zf-WalletTxnDmt.php');
			$result_transaction=txn_fund_transfer3($uid, $cno, $cname, $brid, $bno, $bname, $bbname, $bacc, $bifsc, $bbankid, $source, $type, $method, $transamount, $charges321, $charged321, $pan, $aadhar);
			include_once('../zf-TxnSource3DmtApi.php');
			find_sender2($logged_user_id,$cno);
			if($result_transaction!="")
			{
				$msg=$result_transaction;
				echo "<script>document.location.href='ServiceDmtServlet?cno=$cno&channel2=Search&msg2=$msg'</script>";
			}
			else
			{
				echo "<script>document.location.href='TxnServiceDmtServlet'</script>";
			}
		}
	}
	?>
    
    <section class="boxes wh w3-left">
		<div class="money-bg wh w3-left w3-margin-bottom">
			<div class="w3-row-padding w3-center">
				<div class="w3-col l4 w3-left-align money-left-img">
					<img src="../img/money-left1.png">
				</div>
				<div class="w3-col l4 w3-padding-32">
					<?php 
					if($logged_tpin=="1234")
					{
					?>
					<form class="wh w3-left w3-white w3-padding w3-padding-32 w3-round-large" method="post">
						<h3 class="w3-block w3-center w3-text-red">Your default T-PIN is 1234</h3>
						<h3 class="w3-block w3-center w3-text-red">Update default T-PIN to start Transaction</h3>
						<p>Click here to update default T-PIN <br><br><a class="w3-button w3-round w3-blue" href="MyChangeTpinServlet">Update T-PIN</a></p>
					</form>
					<?php 
					}
					else if($kinf!=3)// || $logged_pword=="$mp1" || $logged_pword=="$mp2")//removelx
					{
						$kdocinf="";
						if($kinf==0)
						{
							$kdocinf="<p>KYC is not uploaded.<br><br><a class='w3-button w3-round w3-blue' href='KycUpload'>Upload KYC Documents</a></p>";
						}
						else if($kinf==1 || $kinf==2)
						{
							$kdocinf="<p>Verification pending, please wait some time for KYC approval.<br><br></p>";
						}
						else if($kinf==-4 || $kinf==4)
						{
							$kdocinf="<p>KYC Documents In-complete, please upload again.<br><br><a class='w3-button w3-round w3-blue' href='KycUpload'>Re-upload KYC Documents</a></p>";
						}
					?>
					<form class="wh w3-left w3-white w3-padding w3-padding-32 w3-round-large" method="post">
						<h3 class="w3-block w3-center w3-text-red">KYC not Verified</h3>
						<?php echo $kdocinf;?>
					</form>
					<?php 
					}
					else
					{
					?>
					<form class="wh w3-left w3-white w3-padding w3-padding-32 w3-round-large" method="post">
						<h5 class="w3-block w3-center">Sender's Mobile Number</h5>
						<input type="text" name="cno" id="cno" value="<?php echo $sndrno;?>" placeholder="Mobile No." class="w3-input w3-border w3-round w3-margin-top w3-margin-bottom">
						<div class="w3-bar">
							<input class="w3-button w3-round w3-blue" value="Go" type="submit" name="channel2" style="margin:1px;" />
						</div>
					</form>
					<?php 
					}
					?>
				</div>
				<div class="w3-col l4 w3-right-align money-right-img">
					<img src="../img/money-right1.png">
				</div>
			</div>
		</div>
		<?php
		if(isset($_REQUEST['channel1']) || isset($_POST['channel1add']) || isset($_POST['channel1adds']) || isset($_POST['channel1verify']))
		{
			include_once('../zf-TxnSource1DmtApi.php');
			include_once('../zf-TxnService1Retailer.php');
			if(isset($_REQUEST['channel1']))
			$cno_result=find_sender($logged_user_id,$sndrno);
			if(isset($_POST['channel1add']) || isset($_POST['channel1adds']))
			$cno_result=add_sender($logged_user_id,$sndrno,$_POST['cname']);
			if(isset($_POST['channel1verify']))
			$cno_result=verify_sender($logged_user_id,$sndrno,$_POST['cname'],$_POST['cotp']);
			$result_beneficiary=show_beneficiary($logged_user_id,$sndrno);
			$result_transactions=show_sender_txn_datas($logged_user_id,$sndrno,1);
			$sndrnm=$cno_result[3];
			/*
			$cnoa=$cno_result[0];
			$cnob=$cno_result[1];
			$cnoc=$cno_result[2];
			$cnod=$cno_result[3];
			$cnoe=$cno_result[4];
			$cnof=$cno_result[5];
			echo "$cnoa $cnob $cnoc $cnod $cnoe $cnof";
			*/
		?>
		<div class="w3-row-padding w3-margin-top" id="SenderInfo">
			<div class="w3-col m12 wow bounceIn" id="SenderInfoDetails">
				<div class="table-box wh w3-left">
					<div class="box-head" id="SenderData">
						<h3>Sender's Info</h3>
					</div>
					<?php
						if($cno_result[0]==1 && $cno_result[1]==-1 && $cno_result[2]==463)
						{
					?>
					<form method="post">
						<div class="w3-row-padding w3-margin-bottom" id="RegSender">  
							<div class="w3-col m12 l12 w3-margin-top">
								<label>Sender is not registered with us. Fill name of Sender and complete registration for Money Remittance.</label>                                
							</div>
							
							<div class="w3-col m6 l3 w3-margin-top">
								<label>Sender's Mobile Number</label>
								<input type="text" name="cno" value="<?php echo $sndrno;?>" placeholder="Sender's Mobile Number" readonly class="w3-input w3-border w3-round">                                    
							</div>
							
							<div class="w3-col m6 l3 w3-margin-top">
								<label>Sender's Name</label>
								<input type="text" name="cname" placeholder="Sender's Name" class="w3-input w3-border w3-round">                                    
							</div>
							
							<div class="w3-col m6 l3 w3-margin-top">
								<input class="w3-button w3-round w3-blue mar-top-b" value="Get OTP" type="submit" name="channel1add" onclick="document.getElementById('RegSenderOtp').style.display='block';document.getElementById('RegSender').style.display='none';" />
							</div>
						</div>
					</form>
					<?php
						}
						else if($cno_result[0]==-1 && $cno_result[1]==37 && $cno_result[2]==0)
						{
					?>
					<form method="post">
						<div class="w3-row-padding w3-margin-bottom" id="RegSenderPending">  
							<div class="w3-col m12 l12 w3-margin-top">
								<label>Sender is registered with us but verification is pending.</label>                                
							</div>
							
							<div class="w3-col m6 l3 w3-margin-top">
								<label>Sender's Mobile Number</label>
								<input type="text" name="cno" value="<?php echo $sndrno;?>" placeholder="Sender's Mobile Number" readonly class="w3-input w3-border w3-round">                                    
							</div>
							
							<div class="w3-col m6 l3 w3-margin-top">
								<label>Sender's Name</label>
								<input type="text" name="cname" value="<?php echo $sndrnm;?>" placeholder="Sender's Name" class="w3-input w3-border w3-round">                                    
							</div>
							
							<div class="w3-col m6 l3 w3-margin-top">
								<input class="w3-button w3-round w3-blue mar-top-b" value="Get OTP" type="submit" name="channel1adds" onclick="document.getElementById('RegSenderOtp').style.display='block';document.getElementById('RegSenderPending').style.display='none';" />
							</div>                            
						</div>
					</form>
					<?php
						}
						else if($cno_result[0]==0 && $cno_result[1]==327 && $cno_result[2]==0)
						{
					?>
					<form method="post">
						<div class="w3-row-padding w3-margin-bottom" id="RegSenderOtp"> 
							<div class="w3-col m12 l12 w3-margin-top">
								<label>OTP is sent to Sender's Mobile. Verification is Pending.</label>
							</div>
							<div class="w3-col m6 l3 w3-margin-top">
								<label>Sender's Mobile Number</label>
								<input type="text" name="cno" value="<?php echo $sndrno;?>" placeholder="Sender's Mobile Number" readonly class="w3-input w3-border w3-round">                                    
							</div> 
							
							<div class="w3-col m6 l3 w3-margin-top">
								<label>Sender's Name</label>
								<input type="text" name="cname" value="<?php echo $sndrnm;?>" placeholder="Sender's Name" class="w3-input w3-border w3-round">                                    
							</div>
							
							<div class="w3-col m6 l3 w3-margin-top">
								<label>Enter OTP</label>
								<input type="text" name="cotp" value="<?php echo $cno_result[4];?>" placeholder="Enter OTP" class="w3-input w3-border w3-round">                                    
							</div>
							
							<div class="w3-col m6 l3 w3-margin-top">
								<input class="w3-button w3-round w3-blue mar-top-b" value="Submit OTP" type="submit" name="channel1verify" onclick="document.getElementById('RegSenderOtp').style.display='none';document.getElementById('RegSenderShow').style.display='block';" />
								<input class="w3-button w3-round w3-blue mar-top-b" value="Resend OTP" type="button" name="channel1resend" onclick="window.location.reload();" />
							</div>                            
						</div>
					</form>
					<?php
						}
						else if($cno_result[0]==0 && $cno_result[1]==33 && $cno_result[2]==0)
						{
					?>
					<div class="w3-row-padding w3-margin-bottom" id="RegSenderShow"> 
						<div class="w3-col m6 l3 w3-margin-top">
							<label>Sender's Mobile Number</label>
							<input type="text" value="<?php echo $sndrno;?>" placeholder="Sender's Mobile Number" disabled class="w3-input w3-border w3-round">                                    
						</div> 
						
						<div class="w3-col m6 l3 w3-margin-top">
							<label>Sender's Name</label>
							<input type="text" value="<?php echo $sndrnm;?>" disabled placeholder="Sender's Name" class="w3-input w3-border w3-round">                                    
						</div>
						
						<div class="clear-both"></div>
						
						<div class="w3-col m6 l3 w3-margin-top">
							<label>IMPS Limit</label>
							<input type="text" id="impslimit" value="<?php echo $cno_result[5];?>" disabled placeholder="IMPS Limit" class="w3-input w3-border w3-round">                                    
						</div>
						
						<div class="w3-col m6 l3 w3-margin-top">
							<label>NEFT Limit</label>
							<input type="text" id="neftlimit" value="<?php echo $cno_result[4];?>" disabled placeholder="NEFT Limit" class="w3-input w3-border w3-round">                                    
						</div>
						
						<!--<div class="w3-col m6 l3 w3-margin-top">
							<label>NEFT Limit (2)</label>
							<input type="text" id="neftlimit" value="<?php echo $cno_result[6];?>" disabled placeholder="NEFT Limit" class="w3-input w3-border w3-round">                                    
						</div>-->
						
						<div class="w3-col m6 l3 w3-margin-top">
							<a class="w3-button w3-round w3-blue mar-top-b" id="bt1" onclick="document.getElementById('ListBen').style.display='block';document.getElementById('ListTrans').style.display='block';">Proceed</a>                                
						</div>                            
					</div>
					<?php
						}
					?>
				</div>
			</div>
		</div> 
		<?php
		}
		if(isset($_REQUEST['channel2']) || isset($_POST['channel2add']) || isset($_POST['channel2adds']) || isset($_POST['channel2verify']))
		{
			include_once('../zf-TxnSource3DmtApi.php');
			include_once('../zf-TxnService1Retailer.php');
			if(isset($_REQUEST['channel2']))
			$cno_result=find_sender2($logged_user_id,$sndrno);
			if(isset($_POST['channel2add']) || isset($_POST['channel2adds']))
			$cno_result=add_sender2($logged_user_id,$sndrno,$_POST['cname']);
			if(isset($_POST['channel2verify']))
			$cno_result=verify_sender2($logged_user_id,$sndrno,$_POST['ccode'],$_POST['cotp']);
			$result_beneficiary=show_beneficiary2($logged_user_id,$sndrno);
			$result_transactions=show_sender_txn_datas($logged_user_id,$sndrno,5);
			$sndrnm=$cno_result[2];
			
			/*
			$cnoa=$cno_result[0];
			$cnob=$cno_result[1];
			$cnoc=$cno_result[2];
			$cnod=$cno_result[3];
			$cnoe=$cno_result[4];
			$cnof=$cno_result[5];
			//echo "'$cnoa' '$cnob' '$cnoc' '$cnod' '$cnoe' '$cnof'";
			*/
			
		?>
		<div class="w3-row-padding w3-margin-top" id="SenderInfo">
			<div class="w3-col m12 wow bounceIn" id="SenderInfoDetails">
				<div class="table-box wh w3-left">
					<div class="box-head" id="SenderData">
						<h3>Sender's Info</h3>
					</div>
					<?php
						if($cno_result[0]=="1" && $cno_result[1]=="Remitter Does not exist. Please register this remitter.")
						{
					?>
					<form method="post">
						<div class="w3-row-padding w3-margin-bottom" id="RegSender">  
							<div class="w3-col m12 l12 w3-margin-top">
								<label>Sender is not registered with us. Fill name of Sender and complete registration for Money Remittance.</label>                                
							</div>
							
							<div class="w3-col m6 l3 w3-margin-top">
								<label>Sender's Mobile Number</label>
								<input type="text" name="cno" value="<?php echo $sndrno;?>" placeholder="Sender's Mobile Number" readonly class="w3-input w3-border w3-round">                                    
							</div>
							
							<div class="w3-col m6 l3 w3-margin-top">
								<label>Sender's Name</label>
								<input type="text" name="cname" placeholder="Sender's Name" class="w3-input w3-border w3-round">                                    
							</div>
							
							<div class="w3-col m6 l3 w3-margin-top">
								<input class="w3-button w3-round w3-blue mar-top-b" value="Get OTP" type="submit" name="channel2add" onclick="document.getElementById('RegSenderOtp').style.display='block';document.getElementById('RegSender').style.display='none';" />
							</div>
						</div>
					</form>
					<?php
						}
						else if($cno_result[0]=="-1" && $cno_result[1]=="Invalid OTP")
						{
					?>
					<form method="post">
						<div class="w3-row-padding w3-margin-bottom" id="RegSender">  
							<div class="w3-col m12 l12 w3-margin-top">
								<label>Invalid OTP. Please Try Again</label>                                
							</div>
							
							<div class="w3-col m6 l3 w3-margin-top">
								<label>Sender's Mobile Number</label>
								<input type="text" name="cno" value="<?php echo $sndrno;?>" placeholder="Sender's Mobile Number" readonly class="w3-input w3-border w3-round">                                    
							</div>
							
							<div class="w3-col m6 l3 w3-margin-top">
								<label>Sender's Name</label>
								<input type="text" name="cname" placeholder="Sender's Name" class="w3-input w3-border w3-round">                                    
							</div>
							
							<div class="w3-col m6 l3 w3-margin-top">
								<input class="w3-button w3-round w3-blue mar-top-b" value="Get OTP" type="submit" name="channel2add" onclick="document.getElementById('RegSenderOtp').style.display='block';document.getElementById('RegSender').style.display='none';" />
							</div>
						</div>
					</form>
					<?php
						}
						else if($cno_result[0]==0 && $cno_result[1]=="A Verification OTP Sent to RemitterNo. Verify it along with OTP Code.")
						{
					?>
					<form method="post">
						<div class="w3-row-padding w3-margin-bottom" id="RegSenderOtp"> 
							<div class="w3-col m12 l12 w3-margin-top">
								<label>OTP is sent to Sender's Mobile. Verification is Pending.</label>
							</div>
							<div class="w3-col m6 l3 w3-margin-top">
								<label>Sender's Mobile Number</label>
								<input type="text" name="cno" value="<?php echo $sndrno;?>" placeholder="Sender's Mobile Number" readonly class="w3-input w3-border w3-round">                                    
							</div> 
							
							<div class="w3-col m6 l3 w3-margin-top display-none">
								<label>Sender Code</label>
								<input type="text" name="ccode" value="<?php echo $cno_result[2];?>" placeholder="Sender Code" readonly class="w3-input w3-border w3-round">                                    
							</div>
							
							<div class="w3-col m6 l3 w3-margin-top">
								<label>Enter OTP</label>
								<input type="text" name="cotp" placeholder="Enter OTP" class="w3-input w3-border w3-round">                                    
							</div>
							
							<div class="w3-col m6 l3 w3-margin-top">
								<input class="w3-button w3-round w3-blue mar-top-b" value="Submit OTP" type="submit" name="channel2verify" onclick="document.getElementById('RegSenderOtp').style.display='none';document.getElementById('RegSenderShow').style.display='block';" />
								<input class="w3-button w3-round w3-blue mar-top-b" value="Resend OTP" type="button" name="channel1resend" onclick="window.location.reload();" />
							</div>                            
						</div>
					</form>
					<?php
						}
						else if($cno_result[0]=="0" && $cno_result[1]=="")
						{
					?>
					<div class="w3-row-padding w3-margin-bottom" id="RegSenderShow"> 
						<div class="w3-col m6 l3 w3-margin-top">
							<label>Sender's Mobile Number</label>
							<input type="text" value="<?php echo $sndrno;?>" placeholder="Sender's Mobile Number" disabled class="w3-input w3-border w3-round">                                    
						</div> 
						
						<div class="w3-col m6 l3 w3-margin-top">
							<label>Sender's Name</label>
							<input type="text" value="<?php echo $sndrnm;?>" disabled placeholder="Sender's Name" class="w3-input w3-border w3-round">                                    
						</div>
						
						<div class="clear-both"></div>
						
						<div class="w3-col m6 l3 w3-margin-top">
							<label>IMPS Limit</label>
							<input type="text" id="impslimit" value="<?php echo $cno_result[4];?>" disabled placeholder="IMPS Limit" class="w3-input w3-border w3-round">                                    
						</div>
						
						<div class="w3-col m6 l3 w3-margin-top">
							<label>IMPS / NEFT Limit</label>
							<input type="text" id="neftlimit" value="<?php echo $cno_result[3];?>" disabled placeholder="NEFT Limit" class="w3-input w3-border w3-round">                                    
						</div>
						
						<div class="w3-col m6 l3 w3-margin-top">
							<a class="w3-button w3-round w3-blue mar-top-b" id="bt1" onclick="document.getElementById('ListBen').style.display='block';document.getElementById('ListTrans').style.display='block';">Proceed</a>                                
						</div>                            
					</div>
					<?php
						}
					?>
				</div>
			</div>
		</div> 
		<?php
		}
		$display="display-none";
		$display2="display-none";
		$display3="display-none";
		if($msg!="")
		{
			$display="";
		}
		if($msg!="" && $msg!="done")
		{
			$display2="";
		}
		if($msg2!="")
		{
			$display="";
			$display3="";
		}
		?>
		<div class="w3-row-padding w3-margin-top <?php echo $display;?>" id="ListBen">
			<div class="w3-col m12 wow bounceIn">
				<div class="table-box wh w3-left">
					<div class="box-head">
						<h3>Registered Beneficiary <a id="bt2" onclick="document.getElementById('RegBen').style.display='block';" class="w3-right w3-green w3-center badges">Add Beneficiary</a></h3>
					</div>
					<div class="w3-responsive">
						<table class="w3-table-all" id="myTable" style="border:none;">
							<tr class="w3-blue">
							  <th>NAME</th>
							  <th>BANK</th>
							  <th>ACCOUNT NO</th>
							  <th>VERIFICATION STATUS</th>
							  <th>ACTION</th>
							</tr>
							<?php
							$sel=0;
							if(mysql_num_rows($result_beneficiary)!=0)
							{
								while($row_beneficiary=mysql_fetch_array($result_beneficiary))
								{
									$sel++;
									$is_verified=$row_beneficiary['is_verified'];
									$is_verified2="";
									$othername=0;
									$bnm=$row_beneficiary['receiver_name'];
									if($is_verified==0 && isset($_REQUEST['channel2']))
									{
										$bankcode=$row_beneficiary['ifsc'];
										$bankcode=substr($bankcode,0,4);
										$b3_verify=show_bank_verification_availability($bankcode);
										if($b3_verify==1)
											$is_verified2="VERIFY";
										else
											$is_verified2="";
										if($is_verified==0)
											$is_verified="";
									}
									else if($is_verified==0 && !isset($_REQUEST['channel2']))
										$is_verified="Not Verified";
									else
									{
										$is_verified="<img src='../img/verified.png' height='20' />";
										$othername++;
									}
									
									if($othername==1 && isset($_REQUEST['channel2']))
									{
										include_once('../zf-WalletTxnDmt.php');
										$bnm=show_verified_name_3($sndrno,$row_beneficiary['receiver_acc_no']);
									}
								?>
								<tr>
								  <td><?php echo $bnm;?></td>
								  <td><?php echo $row_beneficiary['bank'];?></td>
								  <td><?php echo $row_beneficiary['receiver_acc_no'];?></td>
								  <td><?php echo $is_verified;?></td>
								  <td>
									  <?php
									  if($is_verified2=="VERIFY")
									  {
								      ?>
									  <a onclick="verify_acc('<?php echo $sndrno;?>','<?php echo $cno_result[2];?>','<?php echo $bnm;?>','<?php echo $row_beneficiary['receiver_acc_no'];?>','<?php echo $row_beneficiary['ifsc'];?>','<?php echo $row_beneficiary['receiver_id'];?>')" class='w3-button w3-round w3-green w3-tiny'>VERIFY</a>
									  <?php
									  }
									  else if($is_verified2!="VERIFY" && isset($_REQUEST['channel2']))
									  {
										  echo "<div style='width:68px;float:left;'>&nbsp;</div>";
									  }
									  if(isset($_REQUEST['channel1']))
									  {
									  ?>
											<a class="w3-button w3-round w3-blue w3-tiny" id="sel<?php echo $sel;?>" onclick="transm('<?php echo $row_beneficiary['receiver_id'];?>','<?php echo $bnm;?>','<?php echo $row_beneficiary['receiver_number'];?>','<?php echo $row_beneficiary['bank'];?>','<?php echo $row_beneficiary['receiver_acc_no'];?>')">SELECT</a>
											<a class="w3-button w3-round w3-red w3-tiny" onclick="delete_beneficiary('<?php echo $sndrno;?>','<?php echo $row_beneficiary['receiver_id'];?>')">DELETE</a>
									  <?php
									  }
									  if(isset($_REQUEST['channel2']))
									  {
									  ?>
											
											<a class="w3-button w3-round w3-blue w3-tiny" id="sel<?php echo $sel;?>" onclick="transm3('<?php echo $row_beneficiary['receiver_id'];?>','<?php echo $bnm;?>','<?php echo $sndrno;?>','<?php echo $row_beneficiary['bank'];?>','<?php echo $row_beneficiary['receiver_acc_no'];?>','<?php echo $row_beneficiary['ifsc'];?>')">SELECT</a>
											<a class="w3-button w3-round w3-red w3-tiny" onclick="delete_beneficiary3('<?php echo $sndrno;?>','<?php echo $row_beneficiary['receiver_id'];?>','<?php echo $row_beneficiary['receiver_acc_no'];?>')">DELETE</a>
									  <?php
									  }
									  ?>
								  </td>
								</tr>
								<?php
								}
							}
							?>
						</table>	
					</div>
				</div>
			</div> 
		</div>
		
		<div class="w3-row-padding w3-margin-top <?php echo $display;?>" id="ListTrans">
			<div class="w3-col m12 wow bounceIn">
				<div class="table-box wh w3-left">
					<div class="box-head">
						<h3>Transactions by Sender's Mobile No.</h3>
					</div>
					<div class="w3-responsive">
						<table class="w3-table-all" id="myTable" style="border:none;">
							<tr class="w3-blue">
							  <th>ORDER ID</th>
							  <th>DATE</th>
							  <th>NAME</th>
							  <th>BANK</th>
							  <th>ACCOUNT NO</th>
							  <th>METHOD</th>
							  <th>AMOUNT</th>
							  <th>CHARGES</th>
							  <th>STATUS</th>
							</tr>
							<?php
							while($row_transactions=mysql_fetch_array($result_transactions))
							{
								$txn_method=$row_transactions['method'];
								if($txn_method==1)
									$txn_method="<b class='w3-text-orange'>NEFT</b>";
								if($txn_method==2)
									$txn_method="<b class='w3-text-blue'>IMPS</b>";
								
								$txn_status=$row_transactions['order_status'];
								if($txn_status==0)
								{
									$txn_status="Not Initiated";
								}
								else if($txn_status==1)
								{
									$txn_status="<b class='w3-text-blue'>Initiated</b>";
								}
								else if($txn_status==2)
								{
									$txn_status="<b class='w3-text-green'>Success</b>";
								}
								else if($txn_status==3)
								{
									$txn_status="<b class='w3-text-blue'>Response Awaited</b>";
								}
								else if($txn_status==4 || $txn_status==-4)
								{
									$txn_status="<b class='w3-text-red'>Refund Pending</b>";
								}
								else if($txn_status==5)
								{
									$txn_status="<b class='w3-text-blue'>Refunded</b>";
								}
								else
								{
									$txn_status="<b class='w3-text-blue'>In Progress</b>";
								}
							?>
							<tr>
							  <td><?php echo $row_transactions['order_id'];?></td>
							  <td><?php echo $row_transactions['created_on'];?></td>
							  <td><?php echo $row_transactions['rname'];?></td>
							  <td><?php echo $row_transactions['rbname'];?></td>
							  <td><?php echo $row_transactions['racc'];?></td>
							  <td><?php echo $txn_method;?></td>
							  <td><?php if($row_transactions['type']=="1")echo $row_transactions['amount']; else echo $row_transactions['com_charged'];?></td>
							  <td><?php if($row_transactions['type']=="1")echo $row_transactions['com_charged']; else echo $row_transactions['amount'];?></td>
							  <td><?php echo $txn_status;?></td>
							</tr>
							<?php
							}
							?>
						</table>	
					</div>
				</div>
			</div>  
		</div>
		
		<div class="w3-row-padding w3-margin-top <?php echo $display2;?>" id="RegBen">
			<div class="w3-col m12 wow bounceIn">
				<div class="table-box wh w3-left">
					<div class="box-head">
						<h3>Register New Beneficiary</h3>
					</div>
					<div id="benxyz" class="display-none">
						<form method="post">
							<input type="hidden" name="cno123" id="cno123">
							<input type="hidden" name="cname123" id="cname123">
							<input type="hidden" name="bname123" id="bname123">
							<input type="hidden" name="acc123" id="acc123">
							<input type="hidden" name="ifsc123" id="ifsc123">
							<input type="hidden" name="benefid123" id="benefid123">
							<input type="submit" name="btnav3" id="btnav3">
						</form>
					</div>
					<?php
					if(isset($_REQUEST['channel1']))
					{
					?>
					<form class="wh w3-left" method="post">
						<div class="w3-row-padding w3-margin-bottom">  
							<div class="w3-col m12 l12 w3-margin-top">
								<b class="w3-text-red"><?php if($msg!="" && $msg!="done") {echo $msg;}?></b>
							</div>
							<div class="w3-col m6 l3 w3-margin-top">
								<input type="hidden" name="uid" id="uid" value="<?php echo $logged_user_id;?>" />
								<input type="hidden" name="cname" id="cname" value="<?php echo $sndrnm;?>" />
								<label>Beneficiary's Name</label>
								<input type="hidden" name="cno" value="<?php echo $sndrno;?>" />
								<input type="text" id="recName" autocomplete="off" name="bname" required placeholder="Beneficiary's Name" class="w3-input w3-border w3-round">                                    
							</div>
							
							<div class="w3-col m6 l3 w3-margin-top">
								<label>Beneficiary's Mobile No</label>
								<input type="text" id="recMob" autocomplete="off" name="bno" required placeholder="Beneficiary's Mobile No" class="w3-input w3-border w3-round">                                    
							</div> 
							
							<div class="w3-col m6 l3 w3-margin-top">
								<label>Select Bank Type</label>
								<?php
								$passed_val=0;
								if(isset($_REQUEST['channel1']))
									$passed_val=1;
								if(isset($_REQUEST['channel2']))
									$passed_val=3;
								?>
								<select class="w3-select w3-border w3-round" onchange="pullBankType('<?php echo $passed_val;?>')" required id="banktype">
									<option value="" disabled selected>Choose your option</option>
									<?php
									include_once("../zf-TxnSource"."$passed_val"."DmtApi.php");
									$result_bank22=show_bank_type();
									while($result_bank_row22=mysql_fetch_array($result_bank22))
									{
									?>
									<option><?php echo $result_bank_row22['btype'];?></option>
									<?php
									}
									?>
									<option>All Banks</option>
								</select>                                    
							</div>
						</div>
						<div class="w3-row-padding w3-margin-bottom">  
							
							<div class="w3-col m6 l3 w3-margin-top">
								<label>Bank Name</label>
								<select class="w3-select w3-border w3-round" name="bbnk" onchange="pullIFSC()" required id="bankCode">
									<option value="" disabled selected>Choose your option</option>
								</select>                                    
							</div>
							
							<div class="w3-col m6 l3 w3-margin-top">
								<label>Account No.</label>
								<input id="account" autocomplete="off" required name="bacc"  type="text" placeholder="Account No." class="w3-input w3-border w3-round">                                    
							</div>
							
							<div class="w3-col m6 l3 w3-margin-top" id="IFSCCoder">
								<label>IFSC Code <a class='w3-text-blue w3-bold w3-right' onclick='searchIFSC()'>Search IFSC</a></label>
								<input id="ifscCode" autocomplete="off" name="bifsc" required type="text" placeholder="IFSC Code" class="w3-input w3-border w3-round">                                    
							</div>
						</div>
						<div class="w3-row-padding w3-margin-bottom">  
							<div class="w3-col m3 l3 w3-margin-top w3-right">
								<input class="w3-button w3-round w3-green" value="ADD without Verify" type="submit" name="btnawv" id="btnawv" />
							</div>
							<div class="w3-col m3 l3 w3-margin-top w3-right" id="verifyaccountbtn">
								<input class="w3-button w3-round w3-blue" value="ADD &amp; VERIFY" type="submit" name="btnav" id="btnav" /> 
							</div>
						</div>
					</form>
					<?php
					}
					else if(isset($_REQUEST['channel2']))
					{
					?>
					<form class="wh w3-left" method="post">
						<div class="w3-row-padding w3-margin-bottom">  
							<div class="w3-col m12 l12 w3-margin-top">
								<b class="w3-text-red"><?php if($msg!="" && $msg!="done") {echo $msg;}?></b>
							</div>
							<div class="w3-col m6 l3 w3-margin-top">
								<input type="hidden" name="uid" id="uid" value="<?php echo $logged_user_id;?>" />
								<input type="hidden" name="cname" id="cname" value="<?php echo $sndrnm;?>" />
								<label>Beneficiary's Name</label>
								<input type="hidden" name="cno" value="<?php echo $sndrno;?>" />
								<input type="text" id="recName" autocomplete="off" name="bname" required placeholder="Beneficiary's Name" class="w3-input w3-border w3-round">                                    
							</div>
							
							<div class="w3-col m6 l3 w3-margin-top">
								<label>Beneficiary's Mobile No</label>
								<input type="text" id="recMob" autocomplete="off" name="bno" required placeholder="Beneficiary's Mobile No" class="w3-input w3-border w3-round">                                    
							</div> 
							
							<div class="w3-col m6 l3 w3-margin-top">
								<label>Select Bank Type</label>
								<?php
								$passed_val=0;
								if(isset($_REQUEST['channel1']))
									$passed_val=1;
								if(isset($_REQUEST['channel2']))
									$passed_val=3;
								?>
								<select class="w3-select w3-border w3-round" onchange="pullBankType('<?php echo $passed_val;?>')" required id="banktype">
									<option value="" disabled selected>Choose your option</option>
									<?php
									include_once("../zf-TxnSource"."$passed_val"."DmtApi.php");
									$result_bank22=show_bank_type();
									while($result_bank_row22=mysql_fetch_array($result_bank22))
									{
									?>
									<option><?php echo $result_bank_row22['btype'];?></option>
									<?php
									}
									?>
									<option>All Banks</option>
								</select>                                    
							</div>
						</div>
						<div class="w3-row-padding w3-margin-bottom">  
							
							<div class="w3-col m6 l3 w3-margin-top">
								<label>Bank Name</label>
								<select class="w3-select w3-border w3-round" name="bbnk" onchange="pullIFSC3()" required id="bankCode">
									<option value="" disabled selected>Choose your option</option>
								</select>                                    
							</div>
							
							<div class="w3-col m6 l3 w3-margin-top">
								<label>Account No.</label>
								<input id="account" autocomplete="off" required name="bacc"  type="text" placeholder="Account No." class="w3-input w3-border w3-round">                                    
							</div>
							
							<div class="w3-col m6 l3 w3-margin-top display-none" id="IFSCCoder">
								<label>IFSC Code <a class='w3-text-blue w3-bold w3-right' onclick='searchIFSC()'>Search IFSC</a></label>
								<input id="ifscCode" autocomplete="off" name="bifsc" required type="text" placeholder="IFSC Code" class="w3-input w3-border w3-round">                                    
							</div>
							<div class="w3-col m3 l3 w3-margin-top w3-right">
								<label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
								<input class="w3-button w3-round w3-green" value="Add Beneficiary" type="submit" name="btnawv3" id="btnawv3" />
							</div>
						</div>
					</form>
					<?php
					}
					?>
				</div>
			</div>
		</div>
		   
		<div class="w3-row-padding w3-margin-top <?php echo $display3;?>" id="TransMoney">
			<div class="w3-col m12 wow bounceIn">
				<div class="table-box wh w3-left">
					<div class="box-head">
						<h3>Start Money Transfer</h3>
					</div>
					<form class="wh w3-left" method="post">
						<div class="w3-row-padding w3-margin-bottom">  
							<div class="w3-col m12 l12 w3-margin-top">
								<p><?php if($msg2!="" && $msg2=="repeated") {echo "<b class='w3-text-red'>Repeated Transaction</b>:: You already had performed same transaction with same amount to this beneficiary today. If you still want to continue, kindly change transaction amount.";}
								else if($msg2!="") {echo "<b class='w3-text-red'>$msg2</b>";}
								?></p>
							</div> 
							<div class="w3-col m6 l4 w3-margin-top">
								<label id="benmobnomt">Beneficiary's Mobile No</label>
								<input type="hidden" name="uid" id="uid" value="<?php echo $logged_user_id;?>" />
								<input type="hidden" name="cno" id="cno" value="<?php echo $sndrno;?>" />
								<input type="hidden" name="brid" id="brid" />
								<input type="hidden" name="sourcemt" id="sourcemt" value="1" />
								<input type="text" name="bno" id="bno" readonly placeholder="Beneficiary's Mobile No" class="w3-input w3-border w3-round">                                    
							</div>
							
							<div class="w3-col m6 l4 w3-margin-top">
								<label>Beneficiary's Name</label>
								<input type="hidden" name="cname" id="cname" value="<?php echo $sndrnm;?>" />
								<input type="text" name="bname" id="bname" readonly placeholder="Beneficiary's Name" class="w3-input w3-border w3-round">                                    
							</div>
						</div>
						<div class="w3-row-padding w3-margin-bottom">  
							<div class="w3-col m6 l4 w3-margin-top">
								<label>Bank Name</label>
								<input type="text" name="bbname" id="bbname" readonly placeholder="Bank Name" class="w3-input w3-border w3-round">                                    
							</div>
							
							<div class="w3-col m6 l4 w3-margin-top">
								<label>Account No.</label>
								<input type="text" name="bacc" id="bacc" readonly placeholder="Account No." class="w3-input w3-border w3-round">                                    
							</div>
						</div>
						<div class="w3-row-padding w3-margin-bottom">  
							<div class="w3-col m12 l12 w3-margin-top" id="transfer_value">
							</div>
							<div class="w3-col m6 l4 w3-margin-top">
								<label>Transfer Method</label>
								<?php
								if($_POST['channel1'])
								{
								?>
								<input type='hidden' id='chnl' value='1' />
								<select onchange="change_method()" required class="w3-select w3-border w3-round" id="method" name="method">
									<option value='' selected>Choose your option</option>
								</select>
								<?php
								}
								else if($_POST['channel2'])
								{
								?>
								<input type='hidden' id='chnl' value='3' />
								<select onchange="change_method3()" required class="w3-select w3-border w3-round" id="method" name="method">
									<option value='' selected>Choose your option</option>
								</select>
								<?php
								}
								?>
							</div>
							
							<div class="w3-col m6 l4 w3-margin-top">
								<label>Amount</label>
								<input type="text" name="transamount" id="transamount" placeholder="Amount" class="w3-input w3-border w3-round" onkeyup="calc_ded()">
							</div>
							
							
						</div>
						<div class="w3-row-padding w3-margin-bottom">  
							
							<div class="w3-col m6 l2 w3-margin-top display-none">
								<label>Actual Charges</label>
								<input type="text" name="charges" id="charges" readonly placeholder="Charges" class="w3-input w3-border w3-round">                                    
							</div>
							<div class="w3-col m6 l4 w3-margin-top">
								<label>Charges</label>
								<input type="text" readonly name="charged" id="charged" placeholder="Charges" class="w3-input w3-border w3-round">                                    
							</div>	
							<div class="w3-col m6 l2 w3-margin-top display-none">
								<label>GST</label>
								<input type="text" readonly value="0" id="tgst" placeholder="GST" class="w3-input w3-border w3-round">                                    
							</div>		
							
							<div class="w3-col m6 l4 w3-margin-top">
								<label>Total Deducted</label>
								<input type="text" readonly name="gtotal" id="gtotal" placeholder="Total Deducted" class="w3-input w3-border w3-round">                                    
							</div>						
						</div>
						<div class="w3-row-padding w3-margin-bottom"> 
							
							<div class="w3-col m6 l12 w3-margin-top">
								<a id="btnmt" class="w3-button w3-round w3-blue w3-right" onclick="calc_ded2()">Transfer</a>
								<input type="hidden" id="tpin" name="tpin" />
								<input type="submit" class="display-none" value="TransferMoney" name="TransferMoney" id="TransferMoney" />
							</div>                            
						</div>
					</form>
				</div>
			</div>
		</div>      
    </section>
    
  <div id="error-box" class="w3-modal">
    <div class="w3-modal-content w3-animate-zoom w3-card-4 w3-round list-pop">
      <header class="w3-container w3-blue"> 
        <span onclick="document.getElementById('error-box').style.display='none';" class="w3-button w3-display-topright"><img src="../img/close.png" style="margin-bottom:0px;"></span>
        <h3 class="w3-center" id="error-title">Confirm</h3> 
      </header> 
      <div class="w3-container w3-center">
      	<p id="error-message">Do you want to continue?</p>
      </div>  
        <div class="w3-container" style="margin-bottom:10px;">
            <div class="w3-bar w3-center">
                <a id="ViewServlet" onclick="generate_transaction()" class="w3-button w3-green w3-round">Accept &amp; Confirm</a>
                <a id="ButtonFirst" onclick="document.getElementById('error-box').style.display='none';" class="w3-button w3-blue w3-round">OK</a>
                <a id="ButtonSecond" onclick="document.getElementById('error-box').style.display='none';" class="w3-button w3-orange w3-round">Do it later</a>
            </div> 
        </div> 
    </div>
  </div>
       
    <?php include_once('_footer.php');?>

<!--date picker-->
<!--<script type="text/javascript">
    $( "#datepicker" ).datepicker();
	$( "#timepicker" ).timepicker();
</script>-->
<!--date picker-->
</body>
</html> 
