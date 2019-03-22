<?php
require_once('config/connect.php');

	$days = $_POST['days'];
	$ssy = $_POST['sy'];
	$sem = $_POST['sem'];

	$timeStart = $_POST['timeStart'];
	$timeEnd = $_POST['timeEnd'];
	$roomCode = $_POST['roomCode'];
	$class_code = $_REQUEST['classCode'];

	$esy = $ssy+1;
	$sy = $ssy."-".$esy;
	$status = "Open";

	$day = explode("-", $days);
	$x=0;

	$stmt1 = "";
	$stmt2 = "";
	$stmt3 = "";
	$array = (object)array();
	//$array = [];

	$querySectionFromClass = "select * from classes where class_code=?";
	$getSectionFromClass = $conn->prepare($querySectionFromClass);
	$getSectionFromClass->execute(array($class_code));
	$getSectionFromClassRow = $getSectionFromClass->fetch(PDO::FETCH_ASSOC);
	$section = $getSectionFromClassRow['section_code'];
	
	while ($x<count($day)) {
		$y=$day[$x];
		//echo $y." ";
		$stmt=[];
		$queryClassSched = "select * from classes where sched_day like ? and sem = ? and school_year = ?";
		$getClassSched = $conn->prepare($queryClassSched);
		$getClassSched->execute(array("%".$y."%",$sem, $sy));
		while($row2=$getClassSched->fetch(PDO::FETCH_ASSOC)){
			$timeStart2 = strtotime($timeStart);
			$timeEnd2 = strtotime($timeEnd);
			$start = strtotime($row2['sched_time_start']);
			$end = strtotime($row2['sched_time_end']);
			$room = $row2['room'];
			$sec = $row2['section_code'];
			if( ($roomCode==$room) || ($section==$sec) ){
				if( $timeStart2 >= $end){
					//return false;\
					//echo " success 1";
					array_push($stmt,"true");
				}
				else if( ($timeStart2 <= $start) && ( $timeEnd2 <= $start)){
					//return false;
					//echo " success 2";
					array_push($stmt,"true");
				}
				//else if( ($timeStart < $start) && ( $timeEnd > $start) )
				else{
					//return true;
					//echo " fail";
					array_push($stmt,"false");
				}
			}
		}
		
		$x++;
	}
	if(in_array("false", $stmt)){
		//$sql = "select * from classes where sched_day like ? and sem = ? and school_year = ? and room = ? and sched_time_start between ? and ? and sched_time_end between ? and ?";
		//$pdo = $conn->prapare($sql);

		$array->status =  "Cannot add schedule! Conflicting schedule with other class from ".$timeStart." to ".$timeEnd.".";
		//return false;
	}
	else{
		$isSchedUploaded = editSched($conn,$days,$timeStart,$timeEnd,$roomCode,$status,$class_code,$sem,$sy);
		//$isSchedUploaded = true;
		if($isSchedUploaded){
			$array->status =  "Schedule successfully added!";
			//return true;
		}
		else{
			$array->status =  "An error occurred while trying to insert class schedule";
			//return false;
		}

	}

	$array->sy=$sy;
	$array->sem = $sem;
	$array->room = $roomCode;
	$array->days = $days;
	$array->start = $timeStart;
	$array->end = $timeEnd;

	$data = json_encode($array);
	echo $data;


	function editSched($conn,$days,$timeStart,$timeEnd,$roomCode,$status,$class_code,$sem,$sy){
		$queryInsertSched = "update classes set sched_day=?,sched_time_start=?,sched_time_end=?,room=?,status=?, sem=?,school_year =? where class_code=?";
		$insertSched=$conn->prepare($queryInsertSched);
		$insertSched->execute(array($days,$timeStart,$timeEnd,$roomCode,$status,$sem,$sy,$class_code));
		if($insertSched){
			return true;
		}
	}
?>