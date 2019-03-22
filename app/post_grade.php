<?php

require('../app/config/connect.php');
require_once('../app/session.php');
require_once('../app/getSYSem.php');

$subject = $_POST['subject'];
$student = $_POST['student'];
$sem = $_POST['sem'];
$sy = $_POST['sy'];
$mode = $_POST['mode'];
$score = $_POST['score'];

//$midterms = $_POST['midterms'];
//$finals = $_POST['finals'];

$array = (object)array();

$queryStudent = "SELECT * from studentenrollment where student_id=?";
$getStudent = $conn->prepare($queryStudent);
$getStudent->execute(array($student));
$srow = $getStudent->fetch(PDO::FETCH_ASSOC);
$course = $srow['course_code'];
$year = $srow['year_level'];

$queryGrade = "SELECT * from grade where student_id = ? and subject_id = ? and sem = ? and school_year = ?";
$getGrade = $conn->prepare($queryGrade);
$getGrade->execute(array($student,$subject,$sem,$sy));
$grow = $getGrade->fetch(PDO::FETCH_ASSOC);

if(empty($grow)){
	$none = "not found";
}

if($mode=="pre"){
	$fin = $grow['finals'];	
	$mid = $grow['midterms'];
	$pre = $score;

	/*$sp = $pre * 0.30;
	$sf = $fin * 0.40;
	$sm = $mid * 0.30;
	$grade = $sp + $sm + $sf;
	$grade = round($grade, 2);


	if($grade > 1.00 && $grade < 1.10){
		$grade = 1.00;
	}else if($grade >= 1.10 && $grade < 1.25){
		$grade = 1.25;
	}else 
	if($grade > 1.25 && $grade < 1.50){
		$grade = 1.50;
	}else 
	if($grade > 1.50 && $grade < 1.75){
		$grade = 1.75;
	}else 
	if($grade > 1.75 && $grade < 2.00){
		$grade = 2.00;
	}else 
	if($grade > 2.00 && $grade < 2.25){
		$grade = 2.25;
	}else 
	if($grade > 2.25 && $grade < 2.75){
		$grade = 2.75;
	}else if($grade > 2.75 && $grade < 3.00){
		$grade = 3.00;
	}else if($grade >= 3.01){
		$grade = 5.00;
	}


	//echo $sum;

	
	if($grade>3.00 || $grade < 1 || $pre < 1 || $mid < 1 || $fin < 1){
		$remarks = "Failed";		
	}else{
		$remarks = "Passed";		
	}*/



}
else if($mode=="mid"){
	$fin = $grow['finals'];	
	$pre = $grow['prelims'];	
	$mid = $score;

	/*$sp = $pre * 0.30;
	$sf = $fin * 0.40;
	$sm = $mid * 0.30;
	$grade = $sp + $sm + $sf;
	$grade = round($grade, 2);
	//echo $sum;

	if($grade > 1.00 && $grade < 1.10){
		$grade = 1.00;
	}else if($grade >= 1.10 && $grade < 1.25){
		$grade = 1.25;
	}else 
	if($grade > 1.25 && $grade < 1.50){
		$grade = 1.50;
	}else 
	if($grade > 1.50 && $grade < 1.75){
		$grade = 1.75;
	}else 
	if($grade > 1.75 && $grade < 2.00){
		$grade = 2.00;
	}else 
	if($grade > 2.00 && $grade < 2.25){
		$grade = 2.25;
	}else 
	if($grade > 2.25 && $grade < 2.75){
		$grade = 2.75;
	}else if($grade > 2.75 && $grade < 3.00){
		$grade = 3.00;
	}else if($grade >= 3.01){
		$grade = 5.00;
	}
	
	if($grade>3.00 || $grade  < 1 || $pre < 1 || $mid < 1 || $fin < 1){
		$remarks = "Failed";		
	}else{
		$remarks = "Passed";		
	}*/


}else{
	$pre = $grow['prelims'];
	$mid = $grow['midterms'];	
	$fin = $score;

	/*$sp = $pre * 0.30;
	$sf = $fin * 0.40;
	$sm = $mid * 0.30;
	$grade = $sp + $sm + $sf;
	$grade = round($grade, 2);

	if($grade > 1.00 && $grade < 1.10){
		$grade = 1.00;
	}else if($grade >= 1.10 && $grade < 1.25){
		$grade = 1.25;
	}else 
	if($grade > 1.25 && $grade < 1.50){
		$grade = 1.50;
	}else 
	if($grade > 1.50 && $grade < 1.75){
		$grade = 1.75;
	}else 
	if($grade > 1.75 && $grade < 2.00){
		$grade = 2.00;
	}else 
	if($grade > 2.00 && $grade < 2.25){
		$grade = 2.25;
	}else 
	if($grade > 2.25 && $grade < 2.75){
		$grade = 2.75;
	}else if($grade > 2.75 && $grade < 3.00){
		$grade = 3.00;
	}else if($grade >= 3.01){
		$grade = 5.00;
	}

	
	if($grade>3.00 || $grade  < 1 || $pre < 1 || $mid < 1 || $fin < 1){
		$remarks = "Failed";		
	}else{
		$remarks = "Passed";		
	}*/


}

$sp = $pre * 0.30;
$sf = $fin * 0.40;
$sm = $mid * 0.30;
$grade = $sp + $sm + $sf;
$grade = round($grade, 2);


if($grade > 1.00 && $grade < 1.10){
	$grade = 1.00;
}else if($grade >= 1.10 && $grade < 1.25){
	$grade = 1.25;
}else 
if($grade > 1.25 && $grade < 1.50){
	$grade = 1.50;
}else 
if($grade > 1.50 && $grade < 1.75){
	$grade = 1.75;
}else 
if($grade > 1.75 && $grade < 2.00){
	$grade = 2.00;
}else 
if($grade > 2.00 && $grade < 2.25){
	$grade = 2.25;
}else 
if($grade > 2.25 && $grade < 2.75){
	$grade = 2.75;
}else if($grade > 2.75 && $grade < 3.00){
	$grade = 3.00;
}else if($grade >= 3.01){
	$grade = 5.00;
}


//echo $sum;


if($grade>3.00 || $grade < 1 || $pre < 1 || $mid < 1 || $fin < 1){
	$remarks = "Failed";		
}else{
	$remarks = "Passed";		
}

$query = "UPDATE grade set midterms = ?, finals = ?, prelims = ?, grade = ?, remarks = ? where student_id = ? and subject_id = ? and sem = ? and school_year = ?";
	$post = $conn->prepare($query);
	$post->execute(array($mid,$fin,$pre,$grade,$remarks,$student,$subject,$sem,$sy));

$array->grade = $grade;
$array->x = $val." ".$none;
$array->remarks = $remarks;
$data = json_encode($array);
echo $data;

?>