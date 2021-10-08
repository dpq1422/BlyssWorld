<?php
function show_user_type_name($user_type_id)
{
	include_once('zf-Level.php');
	$user_type_name=show_level_name($user_type_id);
	return $user_type_name;
}
?>