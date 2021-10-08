<?php
require('zc-session-admin.php');
require('zf-Branding-Welcome.php');

$result=stop_welcome_msg();

header("location: BrandingWelcomeMessagesServlet");
?>