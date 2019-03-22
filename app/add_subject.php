<?php 

require_once('config/connect.php');

$subject_code = $_POST['subj_code'];
$subject = $_POST['subject'];
$course_code = $_POST['course_code'];
$year_level = $_POST['year_level'];
$subject_type = $_POST['subject_type'];
$units = $_POST['units'];
$other_units = $_POST['other_units'];
$prereq = $_POST['pre_req'];
$req = $_POST['req'];
$sem = $_POST['sem'];
$cid = $_POST['cid'];


$checkSubject = "select * from subjects where subject_code = ? and subject = ? and course_code=?";
$validateSubject = $conn->prepare($checkSubject);
$validateSubject->execute(array($subject_code, $subject, $course_code));
$count = $validateSubject->rowCount();

if($count){
	echo "Subject already exists";
}
else{
	$querySubject = "insert into subjects (subject_code, subject, course_code, year_level, subject_type, total_units, other_units, pre_req, req,sem) values (?,?,?,?,?,?,?,?,?,?)";
	$addSubject = $conn->prepare($querySubject);
	$addSubject->execute(array($subject_code, $subject, $course_code, $year_level, $subject_type, $units, $other_units, $prereq,$req,$sem));
	if($addSubject){
		if(!empty($_POST['cid'])){
			header('Location: ../admin/showContentByCourse.php?cid='.$cid.'&tab=Subjects');
		}else{
			header('Location: ../admin/admin.php?page=Academics');
		}
		
	}
}

?>
