<?php 

require('../app/config/connect.php');
require_once('../app/session.php');
require_once('../app/getSYSem.php');

$subject = $_POST['subject'];
$student = $_POST['student'];
$sem = $_POST['sem'];
$sy = $_POST['sy'];
$drop = $_POST['drop'];
$grade = $_POST['grade'];


$array = (object)array();



$queryStudent = "SELECT * from studentenrollment where student_id=? and sem = ? and school_year = ?";
$getStudent = $conn->prepare($queryStudent);
$getStudent->execute(array($student,$sem,$sy));
$srow = $getStudent->fetch(PDO::FETCH_ASSOC);
$coursec = $srow['course_code'];
$year = $srow['year_level'];


/*
if($drop=="Incomplete"){

	if($grade>=75){
		$remarks = "Passed";
	}else{
		$remarks = "Failed";
	}
	
	$array->remarks = $remarks;
}
else{
	$remarks = $drop;
	
}
*/

$remarks = $drop;

$query = "UPDATE grade set remarks = ? where student_id = ? and subject_id = ? and sem = ? and school_year = ?";
$post = $conn->prepare($query);




if($post->execute(array($remarks,$student,$subject,$sem,$sy))){
	$array->remarks = $drop;	
}
else{
	$array->remarks = "error";
}
	


$data = json_encode($array);
echo $data;
?>
