<?php 
ob_start();


require('config/connect.php');
require_once('session.php');

$uname = str_replace("-", "", $user);

$fname = $_POST["first"];
$lname = $_POST["last"];
$mi = $_POST["mi"];
$bdate = $_POST["bdate"];
$gender = $_POST["gender"];
$contact = $_POST["contact"];
$email = $_POST["email"];
$reg = $_POST["reg"];
$aPass = $_POST['adminPass'];
$role = $_POST['urole'];
//$guardian = $_POST['guardian'];
//$ecn = $_POST['ecn'];
$id = $_POST['id'];
$sid = $_POST['sid'];


$queryPass = "select * from users where uname=? and pass=?";
$pass = $conn->prepare($queryPass);
$pass->execute([$uname,$aPass]);
$row = $pass->fetch(PDO::FETCH_ASSOC);

if(empty($row)){
	echo "Invalid access!";
}
else{

//echo $newID." ".$ID." ".$row['hire_year'];
	if($role=="student"){
		$course = $_POST['course'];
		$yl = $_POST['yl'];

		$sql = "update students set fname=?, mi=?, lname=?, bdate=?, gender=?, email=?, contact=?, reg_date=? where id=?";
		$stmt = $conn->prepare($sql);
		$stmt->execute(array($fname,$mi,$lname,$bdate,$gender,$email,$contact,$reg,$id));

		$queryUpdate = "update enrollment set course_code = ?, year_level = ? where student_id = ?";
		$update = $conn->prepare($queryUpdate);
		$update->execute(array($course, $yl, $sid));
		echo $id;
		header("location: ../admin/student_view.php?sid=".$id);
		ob_end_flush();
	}
	else{
		$sql = "update employees set fname=?, mi=?, lname=?, bdate=?, gender=?, email=?, contact=?, hire_date=? where id=?";
		$stmt = $conn->prepare($sql);
		$stmt->execute(array($fname,$mi,$lname,$bdate,$gender,$email,$contact,$reg,$id));
		header("location: ../admin/teacher_profile.php?id=".$id);
		ob_end_flush();
	}
}
?>