<?php 

require_once("config/connect.php");
require_once("functions.php");
//require_once("session.php");
/*
if($role!="admin"){
	ob_start();
	header("location: ../index.php");
	ob_end_flush();
}*/

$sem = $_POST['sem'];
$sy = $_POST['sy'];
$eid = $_POST['eid'];
$tclass = $_POST['tclass'];
//$sem = $_POST['sem'];
$array=(object)array();
$checkDuplicateClass = "select * from teacher_classes where sem=? and school_year=? and class_code=? and emp_id=?";
$duplicateClass = $conn->prepare($checkDuplicateClass);
$duplicateClass->execute(array($sem,$sy,$tclass,$eid));
$row = $duplicateClass->fetch(PDO::FETCH_ASSOC);

//echo $eid." ".$tclass;

if(!empty($row)){
	/*$array->status = "error";
	$data = json_encode($array);
	echo $data;*/
	echo "error";
}
else{
	$unit = getTeacherUnit($conn, $sem, $sy, $tclass);
	$tu = getTeacherUnits($conn, $sem, $sy, $eid);
	$units = $unit+$tu;
	if($units > 29){
		/*
		$array->status = "full";
		$data = json_encode($array);
		echo $data;*/
		echo "full";
	}else{
		$query = "insert into teacher_classes (emp_id,class_code,sem,school_year) values(?,?,?,?)";
		$pdo = $conn->prepare($query);
		$pdo->execute(array($eid,$tclass,$sem,$sy));
		if($pdo){
			/*
			$array->status = "success";
			$data = json_encode($array);
			echo $data;
			*/
			echo "success";
		}
		else{
			/*
			$array->status = "failed";
			$data = json_encode($array);
			echo $data;*/
			echo "failed";
		}
	}
}

?>