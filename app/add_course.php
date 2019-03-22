<?php 

require_once('config/connect.php');

$code=$_POST['course_code'];
$course=$_POST['course'];
$desc=$_POST['desc'];
$major=$_POST['major'];
$req_units=$_POST['req_units'];



$checkCode = "select * from courses where course_code = ?";
$validateCode = $conn->prepare($checkCode);
$validateCode->execute(array($code));
$count = $validateCode->rowCount();
if($count){
	echo "Course already exist";
	echo $crow['course']." - ".$course;
}


else{
	$checkMajor = "select * from courses where course = ? and major =?";
	$validateMajor = $conn->prepare($checkMajor);
	$validateMajor->execute(array($course,$major));
	$count2 = $validateMajor->rowCount();
	if($count2){
		echo "error";
	}else{
		insertCourse($conn,$code, $course, $desc, $major, $req_units);
		header('location: https://chcc.ga/admin/admin.php?pageAcademics');
	}
	//
	
}


function insertCourse($conn,$code, $course, $desc, $major, $req_units){
	$query = "insert into courses (course_code, course, description, major, req_units) values(?,?,?,?,?)";
		$addCourse = $conn->prepare($query);
		$addCourse->execute(array($code, $course, $desc, $major, $req_units));
}
?>