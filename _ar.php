<?php
	include('zc-gyan-info-admin.php');
	include('zc-commons-admin.php');
	include('zc-session-admin.php');
	if($logged_user_id==100001)
	{
?>
		<table border=1>
			<tr>
				<th>Sr. No.</th>
				<th>User Id</th>
				<th>Date Time</th>
				<th>Sent Response</th>
			</tr>
		<?php
		$res=mysql_query("select * from $bankapi_child_txn.api_response order by id desc limit 0,50");
		while($rs=mysql_fetch_array($res))
		{
		?>
		<tr>
			<td><?php echo $rs['id'];?></td>
			<td><?php echo $rs['uid'];?></td>
			<td><?php echo $rs['dt'];?></td>
			<td><?php echo $rs['response'];?></td>
		</tr>
		<?php
		}
		?>
		</table>
<?php
	}
?>