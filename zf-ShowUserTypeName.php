<?php
function show_user_type_name($user_type_id)
{
	include_once('zf-Level.php');
	$user_type_name=show_level_name($user_type_id);
	if($user_type_id==-2)
	$user_type_name="CSM";
	if($user_type_id==-3)
	$user_type_name="SM";
	if($user_type_id==-4)
	$user_type_name="ASM";
	return $user_type_name;
}
?>