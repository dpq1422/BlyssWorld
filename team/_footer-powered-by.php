<?php
include_once('../zf-Company.php');
$company_result_footer=show_company_info(1);
$company_row_footer=mysql_fetch_array($company_result_footer);
?>
	<footer class="footer wh w3-left w3-center">
    	<p><?php echo $company_row_footer['estd_in'];?><br><?php echo $company_row_footer['powered_by'];?></p>
		<p id="resulted-ip">GEO</p>
    </footer>