<?php
function show_user_type_name($user_type_id)
{
	$user_type_name="";
	
	if($user_type_id==1)
	$user_type_name="Application Admin";
	else if($user_type_id==2)
	$user_type_name="Service Manager";
	else if($user_type_id==3)
	$user_type_name="Tariff Manager";
	else if($user_type_id==4)
	$user_type_name="Client Manager";
	else if($user_type_id==5)
	$user_type_name="Order Manager";
	
	return $user_type_name;
}
?>