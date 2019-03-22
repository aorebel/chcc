<?php 

require('config/connect.php');
require('session.php');
ob_start();

$fname = $_POST["first"];
$lname = $_POST["last"];
$mi = $_POST["mi"];
$bdate = $_POST["bdate"];
$gender = $_POST["gender"];
$contact = $_POST["contact"];
$email = $_POST["email"];
$reg = $_POST["reg"];
$status = $_POST['isRegular'];
//$guardian = $_POST['guardian'];
//$ecn = $_POST['ecn'];
$guardian = "";
$ecn = "";
$isRegular = $_POST['isRegular'];
$course = $_POST['course_code'];
$yearlevel = $_POST['year_level'];

$aspass = $_POST["pass"];

$queryPass = "select * from users where user_id=? and pass=?";
$pass = $conn->prepare($queryPass);
$pass->execute([$user,$aspass]);
$prow = $pass->fetch(PDO::FETCH_ASSOC);

if(!empty($prow)){

	if($isRegular=="Yes"){
		$status = "REGULAR";
	}
	else{
		$status = "IRREGULAR";	
	}


	$get_year = new DateTime($reg);
	$year = date_format($get_year, 'Y');

	//echo $year."<br>";


	$checkEmailQuery = "select * from students where email=? ";
	$checkEmail = $conn->prepare($checkEmailQuery);
	$checkEmail->execute(array($email));
	$checkRow = $checkEmail->fetch(PDO::FETCH_ASSOC);
	
	if(!empty($checkRow)){
		echo "Detected duplicate email please use another active email to activate Student's account!";
	}
	else{

		$yd = substr($year, -2);
		//echo $yd;
		$get_last_empID = "SELECT * FROM students where student_id like ? ORDER BY id DESC Limit 1";
		$last_empID = $conn->prepare($get_last_empID);
		$last_empID->execute(array($yd."%"));
		$row = $last_empID->fetch(PDO::FETCH_ASSOC);


		if(empty($row)){
			$newID = $yd."-0001";
		}else{
			$student_id = $row['student_id'];
			//echo $student_id;
			$get_id =  substr($student_id, -4);
			//echo $get_id;
			$ID = $get_id+10001;
			$get_start_id = substr($ID, -4);
			$newID = $yd."-".$get_start_id;
			//echo " ".$newID;
		}
		//echo $reg;
		//$new_ID = substr($year, 2)."-"."0001";
		//echo substr($row['student_id'],3);
		
		//echo " ".$newID." ".$ID." ".$row['reg_date'];
	
		$sql = "INSERT INTO students(student_id,lname,fname,mi,bdate,gender,email,contact,emergency_person,emergency_contact,reg_date,reg_year,course_code,year_level,status) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		$stmt = $conn->prepare($sql);
		$stmt->execute([$newID,$lname,$fname,$mi,$bdate,$gender,$email,$contact,$guardian,$ecn,$reg,$year,$course,$yearlevel,$status]);


		$query = "INSERT INTO enrollment(student_id,course_code,year_level,status) VALUES (?,?,?,?)";
		$enrollment = $conn->prepare($query);
		$enrollment->execute([$newID,$course,$yearlevel,$status]);
		if($enrollment){
		 	//header("location: ../admin/admin.php?page=Students");
			//ob_end_flush();
		 echo "success";
		}
	//header("location: ../admin/admin.php?page=Students");
	//ob_end_flush();
	}
}else{
	echo "Entered wrong password! Cannot add student. Please try again...".$aspass."".$prow['uname'];
}
?>