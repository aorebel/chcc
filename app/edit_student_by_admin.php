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
$urole = $_POST['urole'];
$role = $_POST['role'];
//$guardian = $_POST['guardian'];
//$ecn = $_POST['ecn'];
$id = $_POST['id'];
$sid = $_POST['sid'];


$queryPass = "select * from users where uname=? and pass=?";
$pass = $conn->prepare($queryPass);
$pass->execute([$uname,$aPass]);
$row = $pass->fetch(PDO::FETCH_ASSOC);

if($role == "student"){

$queryEmail = "select * from students where student_id!=? and email=?";
$checkEmail = $conn->prepare($queryEmail);
$checkEmail->execute([$user,$email]);
$erow = $checkEmail->fetch(PDO::FETCH_ASSOC);

}else{

	if($urole=="student"){
		$queryEmail = "select * from students where id!=? and email=?";
		$checkEmail = $conn->prepare($queryEmail);
		$checkEmail->execute([$id,$email]);
		$erow = $checkEmail->fetch(PDO::FETCH_ASSOC);

	}
	else{
		$queryEmail = "select * from employees where id!=? and email=?";
		$checkEmail = $conn->prepare($queryEmail);
		$checkEmail->execute([$idr,$email]);
		$erow = $checkEmail->fetch(PDO::FETCH_ASSOC);

	}

}



if(empty($row)){
	echo "Invalid access!";
}
else{
	if(!empty($erow)){
		echo "Email ".$email." is already in use by different user please user different email.";
	}else{
//echo $newID." ".$ID." ".$row['hire_year'];
		if($role=="admin"){
			if($urole=="student"){
				$course = $_POST['course'];
				$status = $_POST['status'];
				$yl = $_POST['yl'];

				$sql = "update students set fname=?, mi=?, lname=?, bdate=?, gender=?, email=?, contact=?, reg_date=?,course_code=?,year_level=?,status=? where id=?";
				$stmt = $conn->prepare($sql);
				$stmt->execute(array($fname,$mi,$lname,$bdate,$gender,$email,$contact,$reg,$course,$yl,$status,$id));

				$queryUpdate = "update enrollment set course_code = ?, year_level = ? where student_id = ?";
				$update = $conn->prepare($queryUpdate);
				$update->execute(array($course, $yl, $sid));
				echo $id;
				header("location: ../admin/student_view.php?sid=".$id."&tab=Profile");
				ob_end_flush();
			}
			else{
				$status = $_POST['status'];
				$sql = "update employees set fname=?, mi=?, lname=?, bdate=?, gender=?, email=?, contact=?, hire_date=?, status=? where id=?";
				$stmt = $conn->prepare($sql);
				$stmt->execute(array($fname,$mi,$lname,$bdate,$gender,$email,$contact,$reg,$status,$id));
				if($role=="teacher"){

				}
				header("location: ../admin/employee_view.php?id=".$id."&role=".$urole."&tab=Profile");
				ob_end_flush();
			}
		}
		else if($role=="student"){
			$course = $_POST['course'];
			$yl = $_POST['yl'];

			$sql = "update students set fname=?, mi=?, lname=?, bdate=?, gender=?, email=?, contact=?, reg_date=? where id=?";
			$stmt = $conn->prepare($sql);
			$stmt->execute(array($fname,$mi,$lname,$bdate,$gender,$email,$contact,$reg,$id));

			$queryUpdate = "update enrollment set course_code = ?, year_level = ? where student_id = ?";
			$update = $conn->prepare($queryUpdate);
			$update->execute(array($course, $yl, $sid));
			echo $id;
			header("location: ../student/?page=Home");
			ob_end_flush();
		}
		else if($role=="teacher"){
			$status = $_POST['status'];
			$sql = "update employees set fname=?, mi=?, lname=?, bdate=?, gender=?, email=?, contact=?, hire_date=?, status=? where id=?";
			$stmt = $conn->prepare($sql);
			$stmt->execute(array($fname,$mi,$lname,$bdate,$gender,$email,$contact,$reg,$status,$id));
			if($role=="teacher"){

			}
			header("location: ../teacher/?page=Home");
			ob_end_flush();
		}
		else if($role=="cashier"){
			$status = $_POST['status'];
			$sql = "update employees set fname=?, mi=?, lname=?, bdate=?, gender=?, email=?, contact=?, hire_date=?, status=? where id=?";
			$stmt = $conn->prepare($sql);
			$stmt->execute(array($fname,$mi,$lname,$bdate,$gender,$email,$contact,$reg,$status,$id));
			if($role=="teacher"){

			}
			header("location: ../cashier/?page=Home");
			ob_end_flush();
		}
	}
}
?>