<?php 
//ob_start();
require('session.php');

$fname = $_POST["first"];
$lname = $_POST["last"];
$mi = $_POST["mi"];
$bdate = $_POST["bdate"];
$gender = $_POST["gender"];
$contact = $_POST["contact"];
$email = $_POST["email"];
$hire = $_POST["hire"];
$role = $_POST["role"];
$status = $_POST["status"];
$aspass = $_POST["pass"];

$queryPass = "select * from users where user_id=? and pass=?";
$pass = $conn->prepare($queryPass);
$pass->execute([$user,$aspass]);
$prow = $pass->fetch(PDO::FETCH_ASSOC);
echo $hire."-";
if(empty($prow)){
	echo "Error! Password did not match. Please try again.";
}else{

	$get_year = new DateTime($hire);
	$year = date_format($get_year, 'Y');

	//echo $year."<br>";

	$get_last_empID = "SELECT * FROM employees where hire_year=? ORDER BY id DESC Limit 1";
	$last_empID = $conn->prepare($get_last_empID);
	$last_empID->execute(array($year));
	$row = $last_empID->fetch(PDO::FETCH_ASSOC);


	$queryEmail = "select * from employees where id!=? and email=?";
	$checkEmail = $conn->prepare($queryEmail);
	$checkEmail->execute([$idr,$email]);
	$erow = $checkEmail->fetch(PDO::FETCH_ASSOC);

	if(!empty($erow)){
		echo "Email ".$email." is already in use by different user please user different email.";
	}
	else{

		if(!empty($row)){

		//$new_empID = substr($year, 2)."-"."0001";

			$get_id = (int) substr($row['emp_id'],3);
			$ID = $get_id+1;
			$get_start_id = substr($year,2);
			$empID = $get_start_id."-".$ID;

			echo $empID." ".$ID." ".$row['hire_year']." ".$get_id;
			$sql = "INSERT INTO employees(emp_id,lname,fname,mi,bdate,gender,email,contact,hire_date,hire_year,role,status) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
			$stmt = $conn->prepare($sql);
			//$stmt->execute([$empID,$lname,$fname,$mi,$bdate,$gender,$email,$contact,$hire,$year,$role,$status]);

			echo "success";

			//header("location: ../admin/employees.php");
			//ob_end_flush();
		}
		else{
			$ID="10001";
			$get_start_id = substr($year,2);
			$empID = $get_start_id."-".$ID;

			//echo $empID." ".$ID." ".$row['hire_year'];
			$sql = "INSERT INTO employees(emp_id,lname,fname,mi,bdate,gender,email,contact,hire_date,hire_year,role,status) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
			$stmt = $conn->prepare($sql);
			//$stmt->execute([$empID,$lname,$fname,$mi,$bdate,$gender,$email,$contact,$hire,$year,$role,$status]);
			echo "success";

			//header("location: ../admin/employees.php");
			//ob_end_flush();
		}
	}
}

?>