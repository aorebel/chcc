<?php 
	require_once('config/connect.php');

	$days = $_POST['days'];
	$ssy = $_POST['sy'];
	$sem = $_POST['sem'];
	$section = $_POST['section'];
	$subject = $_POST['subject'];

	$timeStart = $_POST['timeStart'];
	$timeEnd = $_POST['timeEnd'];
	$roomCode = $_POST['roomCode'];

	
	$withLab = $_POST['withLab'];

	$querySubjectCode="select subject_code from subjects where id=?";
	$getSubjectCode = $conn->prepare($querySubjectCode);
	$getSubjectCode->execute(array($subject));
	$row = $getSubjectCode->fetch(PDO::FETCH_ASSOC);

	$subject_code = $row['subject_code'];
	$code=explode(' ', $subject_code);
	$abbr=$code[0];

	$y=substr($ssy,2);

	$class_code = strtoupper($abbr)."".$y."".$subject;
	$clasCode = strtoupper($abbr)."".$y."".$subject."L";
	//$string = str_replace("-", " ", $string);
	//$days = str_replace("-", ",", $days);

	$esy = $ssy+1;
	$sy = $ssy."-".$esy;
	$status = "Close";

	if($withLab=="Yes"){
		$timeStartLab = $_POST['timeStartLab'];
		$timeEndLab = $_POST['timeEndLab'];
		$roomCodeLab = $_POST['roomCodeLab'];
		$labDays = $_POST['lab'];


		$labday = explode("-", $labDays);
		$i=0;
		while ($i<count($labday)) {
			$isRoomSchedLabFree = checkRoomSched($conn,$roomCodeLab,$timeStartLab,$timeEndLab,$labDay[$i]);
			$i++;
		}
		
		if($isRoomSchedLabFree){
			//$isSchedLabUploaded = insertSched($conn,$classCode,$sy,$sem,$subject,$labDays,$timeStartLab,$timeEndLab,$roomCodeLab,$section,$status);
			$isSchedLabUploaded = true;
			if($isSchedLabUploaded){
				echo $classCode." ".$labDays." ".$sy." ".$sem." ".$section." ".$subject." - ".$subject_code." ".$timeStartLab." ".$timeEndLab." ".$roomCodeLab." with Lab ".$withLab."<br>";
			}
			else{
				echo "An error occurred while trying to insert class schedule";
			}
		}
		else{
			echo "Room ".$roomCodeLab."is already occupied for the for ".$labDays." from ".$timeStartLab." to ".$timeEndLab."!";
		}
		
		

		
	}


	$day = explode("-", $days);
	$x=0;

	$stmt1 = "";
	$stmt2 = "";
	$stmt3 = "";
	
	while ($x<count($day)) {
		$y=$day[$x];
		echo $y." ";

		$queryClassSched = "select * from classes where room=? and sched_day like ? limit 1";
		$getClassSched = $conn->prepare($queryClassSched);
		$getClassSched->execute(array($roomCode,"%".$y."%"));
		while($row2=$getClassSched->fetch(PDO::FETCH_ASSOC)){
			$timeStart = strtotime($timeStart);
			$timeEnd = strtotime($timeEnd);
			$start = strtotime($row2['sched_time_start']);
			$end = strtotime($row2['sched_time_end']);
			if( $timeStart >= $end){
				//return false;\
				echo " success 1";
				$stmt1 = "true";
			}
			else if( ($timeStart <= $start) && ( $timeEnd <= $start)){
				//return false;
				echo " success 2";
				$stmt2 = "true";
			}
			//else if( ($timeStart < $start) && ( $timeEnd > $start) )
			else{
				//return true;
				echo " fail";
				$stmt3 = "false";
			}
			//echo "end field = ".$end."start field = ".$start."time end = ".$timeEnd."time start = ".$timeStart;
			//echo $end."=".$start."-".$timeEnd."-".$timeStart;
		}
		//$isRoomSchedFree = checkRoomSched($conn,$roomCode,$timeStart,$timeEnd,$day[$x]);



		$x++;
	}
	if(($stmt1=="false") || ($stmt2=="false") || ($stmt3=="false")){
			echo "cannot add schedule on ".$roomCode;
		}
		else{
			$isSchedUploaded = insertSched($conn,$class_code,$sy,$sem,$subject,$days,$timeStart,$timeEnd,$roomCode,$section,$status);
			$isSchedUploaded = true;
			if($isSchedUploaded){
				echo $class_code." ".$days." ".$sy." ".$sem." ".$section." ".$subject." - ".$subject_code." ".$roomCode." ".$timeStart." ".$timeEnd." with Lab ".$withLab;
			}
			else{
				echo "An error occurred while trying to insert class schedule";
			}

		}
	/*

	if($isRoomSchedFree){
		//$isSchedUploaded = insertSched($conn,$class_code,$sy,$sem,$subject,$days,$timeStart,$timeEnd,$roomCode,$section,$status);
		$isSchedUploaded = true;
		if($isSchedUploaded){
			echo $class_code." ".$days." ".$sy." ".$sem." ".$section." ".$subject." - ".$subject_code." ".$roomCode." ".$timeStart." ".$timeEnd." with Lab ".$withLab;
		}
		else{
			echo "An error occurred while trying to insert class schedule";
		}
	}else{
		echo "Room ".$roomCode."is already occupied for the for ".$days." from ".$timeStart." to ".$timeEnd."!";
	}
	
*/
	
	//$days = implode(",",$days);

	function insertSched($conn,$class_code,$sy,$sem,$subject,$days,$timeStart,$timeEnd,$roomCode,$section,$status){
		$queryInsertSched = "insert into classes (class_code,school_year,sem,subject_id,sched_day,sched_time_start,sched_time_end,room,section_code,status) values(?,?,?,?,?,?,?,?,?,?)";
		$insertSched=$conn->prepare($queryInsertSched);
		$insertSched->execute(array($class_code,$sy,$sem,$subject,$days,$timeStart,$timeEnd,$roomCode,$section,$status));
		if($insertSched){
			return true;
		}
	}

	function checkRoomSched($conn,$room,$timeStart,$timeEnd,$days){
		$queryClassSched="select * from classes where sched_day like ?";
		$getClassSched = $conn->prepare($queryClassSched);
		$getClassSched->execute(array("%$days%"));
		$row=$getClassSched->fetch(PDO::FETCH_ASSOC);
		while(!empty($row)){
			$daysField = $row['sched_day'];
			$roomField = $row['room'];
			$timeStart = strtotime($timeStart);
			$timeEnd = strtotime($timeEnd);
			$start = strtotime($row['sched_time_start']);
			$end = strtotime($row['sched_time_end']);

			if($roomField==$room){
				if( ($timeStart > $start) && $timeEnd < $end ){
					return false;
				}
				else if( ($timeStart < $start) && $timeEnd < $end ){
					return false;
				}
				else if( ($timeStart < $start) && $timeEnd > $end ){
					return false;
				}
				else{
					return true;
				}
			}
			else{
				return true;
			}
		}
		return true;

	}


?>
