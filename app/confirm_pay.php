<?php 

require_once('config/connect.php');
require_once('getSYSem.php');
require_once('session.php');

$id = $_POST['sid'];
$ref = $_POST['ref'];
$pass = $_POST['pass'];

$queryUser = "SELECT * from users where user_id = ? and pass = ?";
$getUser = $conn->prepare($queryUser);
$getUser->execute(array($user,$pass));
$userRow = $getUser->fetch(PDO::FETCH_ASSOC);

$queryAss = "SELECT * from assessment where id=?";
$getAss = $conn->prepare($queryAss);
$getAss->execute(array($assID));
$assRow = $getAss->fetch(PDO::FETCH_ASSOC);
//$net = $assRow['net_payable'];


$queryEnrollment = "SELECT * from enrollment where student_id = ? order by id DESC limit 1";
$getEnrollment = $conn->prepare($queryEnrollment);
$getEnrollment->execute(array($id));
$enRow = $getEnrollment->fetch(PDO::FETCH_ASSOC);

$queryCashier = "SELECT * from cashier where student_id = ? and ref_no = ?";
$getCashier = $conn->prepare($queryCashier);
$getCashier->execute(array($id,$ref));
$cashRow = $getCashier->fetch(PDO::FETCH_ASSOC);
if(!empty($userRow)){
	if(!empty($cashRow)){
		$get_date = new DateTime();
		$net = $cashRow['bal'];
		$date = date_format($get_date, 'Y-m-d'); 
		$bal = $net - $cashRow['amount'];
		echo $date." bal ".$bal." amount ".$cashRow['amount']." net : ".$net." ".$id."ref: ".$ref;
		$query = "UPDATE cashier set status = ?, confirm_date = ?, bal = ? where student_id = ? and ref_no=?";
		$pdo = $conn->prepare($query);
		$pdo->execute(array("Confirmed",$date,$bal,$id,$ref));


		if($enRow['sem']==$sem && $enRow['schoo_year']==$sy){
			$queryUpdate = "UPDATE enrollment set enrollment_date = ? where student_id=? and sem = ? and school_year = ?";
			$pdoUpdate = $conn->prepare($queryUpdate);
			$pdoUpdate->execute(array($date,$id,$sem,$sy));
		}else{
			$queryInsert = "INSERT into enrollment (student_id,school_year,sem,year_level,course_code,enrollment_date,status) values(?,?,?,?,?,?,?)";
			$insert = $conn->prepare($queryInsert);
			$insert->execute(array($id,$sy,$sem,$enRow['year_level'],$enRow['course_code'],$date,"REGULAR"));
		}
		//header('location: success.php?ref='.$ref);
		echo "subccess";
	}
}else{
	echo "Password Error!";
}

?>