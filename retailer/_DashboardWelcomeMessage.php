	<?php
	if($welcomenote<=10)
	{
		include_once('../zf-Branding-Welcome.php');
		$welcomemessage_result=show_welcomemessage();
		while($welcomemessage_row=mysql_fetch_array($welcomemessage_result))
		{
			$welcomemessage_type=$welcomemessage_row['message_type'];
			$welcomemessage="";
			if($welcomemessage_type==1)
				$welcomemessage="<img src='../".$welcomemessage_row['welcome_file']."'/>";
			else if($welcomemessage_type==0)
				$welcomemessage=$welcomemessage_row['welcome_message'];
	?>
  <div id="welcome-message" class="w3-modal">
    <div style='width:670px;' class="w3-modal-content w3-animate-zoom w3-card-4 w3-round list-pop">
      <header class="w3-container w3-blue"> 
        <span onclick="document.getElementById('welcome-message').style.display='none'" class="w3-button w3-display-topright"><img src="../img/close.png" style="margin-bottom:0px;"></span>
        <h3 class="w3-center"><?php echo $welcomemessage_row['welcome_name'];?></h3> 
      </header> 
      <div class="w3-container w3-center">
      	<p><?php echo $welcomemessage;?></p>
      </div>  
        <div class="w3-container" style="margin-bottom:10px;">
            <div class="w3-bar w3-center">
                <a onclick="document.getElementById('welcome-message').style.display='none'" class="w3-button w3-blue w3-round">Ok</a>
            </div> 
        </div> 
    </div>
  </div>
	<?php
		}
	}
	?>