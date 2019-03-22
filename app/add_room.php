<?php 
	
	$room_type=$_POST['room_type'];
	$room_name=$_POST['room_name'];
	$room_cap=$_POST['room_cap'];
	$building=$_POST['building'];

	$room = explode(" ", $room_name);
	if(strtoupper($room[0])=="ROOM"){
		$rmAbbr = "RM";
	}
	else{
		$rmAbbr = substr($room[0], 0,4);
	}
	


?>