
	<style>
	*{font-size:16px;font-family:"Arial";}
	b{color:green;} 
	a{color:black;}
	</style>
	<body>
		<form method="post">
			tid<br>
			<input type="text" name="tid" /><br><br>
			
			<input type="submit" name="add" /><br><br>
		</form>
	</body>
</html>
		<?php
		if(isset($_POST['add']))
		{
			$url="http://mentor-india.co.in/api-payoneonline.com/rc_ap_live.php?";
			$bankapi_user_id="100001";
			$bankapi_user_pass="9729877577";
			$bankapi_method="STTS";
			$order_number=$_POST['tid'];
			$url = $url . "bankapi_user_id=" . $bankapi_user_id;
			$url = $url . "&bankapi_user_pass=" . $bankapi_user_pass;
			$url = $url . "&bankapi_method=" . $bankapi_method;
			$url = $url . "&order_number=" . $order_number;
						   
			$curl = curl_init();
			//curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);//eko
			//curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);//eko
			curl_setopt($curl, CURLOPT_URL, $url);
			//curl_setopt($curl, CURLOPT_TIMEOUT, $request_timeout);//rech
			//curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $request_timeout);//rech
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			
			$response = curl_exec($curl); // Contains the response from server
			//$curl_error = curl_errno($curl);
			//$getserver= curl_getinfo($curl);
			
			$err = curl_error($curl);
			
			curl_close($curl);
			
			if ($err) {
				$err=str_replace("eko","",$err);
				//$err=str_replace("_","",$err);
				echo "cURL Error : " . $err;
			}
			else
			{
				//$response=str_replace("eko","",$response);
				//$response=str_replace("_","",$response);
				echo $response;
				//$result= json_decode($response, true);
			}
		}
		?>